<?php

namespace App\Http\Controllers;

use Exception;
use App\Helpers\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use App\Models\PendaftaranMagang;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Enums\PendaftaranMagangStatusEnum;

class ApproveMandiriController extends Controller
{
    public function __construct()
    {
       
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('mandiri.approve_mandiri.index');
    }

    public function show(Request $request)
    {
        $request->validate(['status' => 'required|in:tertunda,done']);

        $pengajuan = PendaftaranMagang::select(
                'pendaftaran_magang.*', 'mahasiswa.namamhs', 'mahasiswa.nim', 'industri.namaindustri',
                'lowongan_magang.intern_position', 'mhs_magang.startdate_magang',  'mhs_magang.enddate_magang',
                'industri.email as email_industri', 'industri.alamatindustri', 'industri.notelpon as telepon_industri', 'program_studi.namaprodi',
                'jenis_magang.namajenis'
            )
            ->leftJoin('mahasiswa', 'mahasiswa.nim', 'pendaftaran_magang.nim')
            ->leftJoin('program_studi', 'program_studi.id_prodi', 'mahasiswa.id_prodi')
            ->leftJoin('mhs_magang', 'mhs_magang.id_pendaftaran', 'pendaftaran_magang.id_pendaftaran')
            ->leftJoin('lowongan_magang', 'lowongan_magang.id_lowongan', 'pendaftaran_magang.id_lowongan')
            ->join('industri', 'industri.id_industri', 'lowongan_magang.id_industri')
            ->join('jenis_magang', 'jenis_magang.id_jenismagang', 'lowongan_magang.id_jenismagang');

        if ($request->status == 'tertunda') $pengajuan = $pengajuan->whereIn('current_step', [
            PendaftaranMagangStatusEnum::PENDING,
            PendaftaranMagangStatusEnum::APPROVED_BY_DOSWAL,
            PendaftaranMagangStatusEnum::APPROVED_BY_KAPRODI
        ]);
        else if ($request->status == 'done') $pengajuan = $pengajuan->whereNotIn('current_step', [
            PendaftaranMagangStatusEnum::PENDING,
            PendaftaranMagangStatusEnum::APPROVED_BY_DOSWAL,
            PendaftaranMagangStatusEnum::APPROVED_BY_KAPRODI
        ]);

        return datatables()->of($pengajuan->get())
            ->addIndexColumn()
            ->editColumn('namamhs', function ($x) {
                $result = '<div class="d-flex flex-column align-items-start">';
                $result .= '<span class="fw-bolder">' .$x->namamhs. '</span>';
                $result .= '<small>' .$x->nim. '</small>';
                $result .= '</div>';

                return $result;
            })
            ->editColumn('intern_position', fn ($x) => $x->namaindustri .'&ensp;-&ensp;'. $x->intern_position)
            ->addColumn('tgl_magang', function ($x) {
                $result = '<div class="d-flex flex-column align-items-start">';
                $result .= '<span class="text-nowrap">Tanggal Mulai : </span>';
                $result .= '<span class="text-nowrap fw-bolder">' . (($x->startdate_magang) ? Carbon::parse($x->startdate_magang)->format('d F Y') : '-') . '</span>';
                $result .= '<span class="text-nowrap">Tanggal Berakhir : </span>';
                $result .= '<span class="text-nowrap fw-bolder">' . (($x->enddate_magang) ? Carbon::parse($x->enddate_magang)->format('d F Y') : '-') . '</span>';
                $result .= '</div>';

                return $result;
            })
            ->addColumn('contact_perusahaan', function ($x) {
                $result = '<div class="d-flex flex-column align-items-start">';
                $result .= '<span class="fw-bolder">' .$x->email_industri. '</span>';
                $result .= '<span>' .$x->telepon_industri. '</span>';
                $result .= '</div>';

                return $result;
            })
            ->editColumn('dokumen_spm', fn ($x) => (isset($x->dokumen_spm) && $x->current_step == PendaftaranMagangStatusEnum::APPROVED_BY_LKM) ? '<a href="'.url('storage/'. $x->dokumen_spm).'" target="_blank">Dokumen SPM</a>' : '-')
            ->editColumn('current_step', function ($x) {
                $step = PendaftaranMagangStatusEnum::getWithLabel($x->current_step);
                return '<span class="badge bg-label-' . $step['color'] . '">' . $step['title'] . '</span>';
            })
            ->addColumn('action', function ($x) {
                $result = '<div class="d-flex justify-content-center">';
                $result .= '<a class="cursor-pointer mx-1 text-primary" onclick="approved($(this));" data-id="' .$x->id_pendaftaran. '"><i class="ti ti-file-check"></i></a>';
                $result .= '<a class="cursor-pointer mx-1 text-danger" onclick="rejected($(this));" data-id="' .$x->id_pendaftaran. '"><i class="ti ti-file-x"></i></a>';
                $result .= '</div>';

                return $result;
            })
            ->rawColumns(['namamhs', 'intern_position', 'tgl_magang', 'contact_perusahaan', 'dokumen_spm', 'current_step', 'action'])
            ->make(true);
    }
    
    public function approved(Request $request)
    {
        $request->validate([
            'data_id' => 'required|array||exists:pendaftaran_magang,id_pendaftaran',
            'file' => 'required|mimes:pdf,jpg,jpeg,png|max:2048'
        ], [
            'data_id.required' => 'Data harus dipilih',
            'data_id.array' => 'Data harus berupa array',
            'data_id.exists' => 'Data tidak valid',
            'file.required' => 'Surat Pengantar Magang harus diisi',
            'file.mimes' => 'Surat Pengantar Magang harus berupa PDF, JPG, JPEG, PNG',
            'file.max' => 'Surat Pengantar Magang maksimal 2 MB'
        ]);

        try {
            $data = PendaftaranMagang::whereIn('id_pendaftaran', $request->data_id)
            ->whereIn('current_step', [
                PendaftaranMagangStatusEnum::PENDING,
                PendaftaranMagangStatusEnum::APPROVED_BY_DOSWAL,
                PendaftaranMagangStatusEnum::APPROVED_BY_KAPRODI
            ])->get();

            if (count($data) <= 0) return Response::error(null, 'Invalid.');

            DB::beginTransaction();

            $file = null;
            if ($request->hasFile('file')) {
                $file = Storage::put('dokumen_spm', $request->file('file'));
            }

            $user = auth()->user();
            foreach ($data as $key => $value) {
                $value->dokumen_spm = $file;
                $value->current_step = PendaftaranMagangStatusEnum::APPROVED_BY_LKM;
                $value->saveHistoryApproval()->save();
            }

            DB::commit();
            return Response::success(null, 'Berhasil mengirim Surat Pengantar Magang.');
        } catch (Exception $e) {
            DB::rollBack();
            return Response::errorCatch($e);
        }
    }
    
    public function rejected($id, Request $request)
    {
        $request->validate([
            'alasan' => 'required|string',
        ], [
            'alasan.required' => 'Alasan ditolak harus diisi',
        ]);

        try {
            $data = PendaftaranMagang::whereIn('current_step', [
                PendaftaranMagangStatusEnum::PENDING,
                PendaftaranMagangStatusEnum::APPROVED_BY_DOSWAL,
                PendaftaranMagangStatusEnum::APPROVED_BY_KAPRODI
            ])->where('id_pendaftaran', $id)->first();

            if (!$data) return Response::error(null, 'Invalid.');

            $user = auth()->user();
            $history_approval_ = json_decode($data->history_approval, true);
            $history_approval = [
                'id_user' => $user->id,
                'name' => $user->name,
                'time' => now()->format('Y-m-d H:i:s'),
                'status' => PendaftaranMagangStatusEnum::REJECTED_BY_LKM
            ];

            array_push($history_approval_, $history_approval);

            $data->current_step = PendaftaranMagangStatusEnum::REJECTED_BY_LKM;
            $data->reason_reject = $request->alasan;
            $data->history_approval = json_encode($history_approval_);
            $data->save();

            return Response::success(null, 'Berhasil menolak pengajuan.');
        } catch (\Exception $e) {
            return Response::errorCatch($e);
        }
    }

}