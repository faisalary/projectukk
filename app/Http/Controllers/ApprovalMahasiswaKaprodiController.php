<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\PendaftaranMagang;
use Illuminate\Support\Facades\Validator;
use App\Enums\PendaftaranMagangStatusEnum;

class ApprovalMahasiswaKaprodiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('approval_mahasiswa/index', [
            'urlGetData' => route('approval_mahasiswa_kaprodi.get_data'),
            'urlApproval' => route('approval_mahasiswa_kaprodi.approval', ['id' => ':id'])
        ]);
    }

    /**
     * Get data for datatable.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request) {
        // Validate the request
        $request->validate(['section' => 'required|in:approval,sudah-approval']);

        // Get the authenticated user's dosen
        $dosen = auth()->user()->dosen;

        // Mengirim query ke database untuk mendapatkan data
        $data = Mahasiswa::select(
            'mahasiswa.nim', 'mahasiswa.namamhs', 'pendaftaran_magang.tanggaldaftar', 'industri.namaindustri', 
            'lowongan_magang.intern_position', 'mahasiswa.nohpmhs', 'users.email', 'pendaftaran_magang.current_step',
            'pendaftaran_magang.id_pendaftaran', 'mahasiswa.kode_dosen'
        )
        ->join('pendaftaran_magang', 'mahasiswa.nim', '=', 'pendaftaran_magang.nim')
        ->join('lowongan_magang', 'lowongan_magang.id_lowongan', '=', 'pendaftaran_magang.id_lowongan')
        ->join('industri', 'industri.id_industri', '=', 'lowongan_magang.id_industri')
        ->join('users', 'mahasiswa.id_user', '=', 'users.id')
        ->where('mahasiswa.id_fakultas', $dosen->id_fakultas);

        // Filter data berdasarkan parameter tiap bagian/section
        if ($request->section == 'approval') $data = $data->where('pendaftaran_magang.current_step', PendaftaranMagangStatusEnum::APPROVED_BY_DOSWAL);

        $array_status = [];
        if ($request->section == 'sudah-approval') {
            $array_status = array_diff(PendaftaranMagangStatusEnum::getConstants(), ['pending', 'approved_by_doswal', 'rejected_by_doswal']);
            $data = $data->whereIn('pendaftaran_magang.current_step', $array_status);
        }

        // Mengembalikan data dalam format tabel
        return datatables()->of($data->get())
        ->addIndexColumn()
        ->editColumn('namamhs', function ($data) {
            // Format the 'namamhs' column
            $result = '<div class="text-unwrap">';
            $result .= '<span class="fw-bolder text-unwrap">' .$data->namamhs. '</span><br>';
            $result .= '<span>' .$data->nim. '</span><br>';
            $result .= '<small>' .$data->email. '</small>';
            $result .= '</div>';

            return $result;
        })
        ->editColumn('tanggaldaftar', fn ($data) => '<div class="text-center">' . Carbon::parse($data->tanggaldaftar)->format('d M Y') . '</div>')
        ->editColumn('current_step', function ($data) use ($array_status) {
            // Format the 'current_step' column
            $result = '<div class="text-center">';

            $getStatusLabel = PendaftaranMagangStatusEnum::getWithLabel($data->current_step);
            $result .= '<span class="badge bg-label-' .$getStatusLabel['color']. '">' .$getStatusLabel['title']. '</span>';

            $result .= '</div>';
            return $result;
        })
        ->addColumn('action', function ($data) {
            // Format the 'action' column
            $result = '<div class="d-flex justify-content-center">';
            $result .= "<a href='".route('approval_mahasiswa_kaprodi.detail', $data->id_pendaftaran)."' class='mx-1 text-primary cursor-pointer'><i class='ti ti-file-invoice'></i></a>";
            if ($data->current_step == PendaftaranMagangStatusEnum::APPROVED_BY_DOSWAL) {
                $result .= "<a onclick='approved($(this))' class='mx-1 text-success cursor-pointer' data-status='approved' data-id='$data->id_pendaftaran'><i class='ti ti-file-check'></i></a>";
                $result .= "<a onclick='rejected($(this))' class='mx-1 text-danger cursor-pointer' data-status='rejected' data-id='$data->id_pendaftaran'><i class='ti ti-file-x'></i></a>";
            }
            $result .= '</div>';

            return $result;
        })
        ->rawColumns(['namamhs', 'tanggaldaftar', 'current_step', 'action'])
        ->make(true);
    }

    public function detail($id) {
        $data['data'] = Mahasiswa::with('education', 'experience', 'sertifikat')->select(
            'mahasiswa.*', 'pendaftaran_magang.tanggaldaftar', 'industri.namaindustri', 
            'lowongan_magang.intern_position', 'users.email', 'pendaftaran_magang.current_step',
            'pendaftaran_magang.id_pendaftaran', 'universitas.namauniv', 'fakultas.namafakultas'
        )
        ->join('pendaftaran_magang', 'mahasiswa.nim', '=', 'pendaftaran_magang.nim')
        ->join('lowongan_magang', 'lowongan_magang.id_lowongan', '=', 'pendaftaran_magang.id_lowongan')
        ->join('industri', 'industri.id_industri', '=', 'lowongan_magang.id_industri')
        ->join('users', 'mahasiswa.id_user', '=', 'users.id')
        ->join('universitas', 'universitas.id_univ', '=', 'mahasiswa.id_univ')
        ->join('fakultas', 'fakultas.id_fakultas', '=', 'mahasiswa.id_fakultas')
        ->where('pendaftaran_magang.id_pendaftaran', $id)->first();

        $data['urlBack'] = route('approval_mahasiswa_kaprodi');

        return view('approval_mahasiswa/detail', $data);
    }

    public function approval(Request $request, $id) {
        try {
            $validate = Validator::make($request->all(), [
                'status' => 'required|in:approved,rejected',
                'reason' => 'required_if:status,rejected'
            ], ['reason.required_if' => 'Alasan harus diisi.']);
    
            if ($validate->fails()) {
                if ($validate->errors()->has('status')) {
                    return Response::error(null, 'Invalid.');
                } else {
                    return Response::errorValidate($validate->errors(), 'Invalid.');
                }
            };

            $pendaftaranMahasiswa = PendaftaranMagang::where('id_pendaftaran', $id)->first();
            if (!$pendaftaranMahasiswa) return Response::error(null, 'Pendaftaran mahasiswa tidak ditemukan.');

            $message = 'Pendaftaran mahasiswa approved.';
            if ($request->status == 'approved') $pendaftaranMahasiswa->current_step = PendaftaranMagangStatusEnum::APPROVED_BY_KAPRODI;
            else {
                $pendaftaranMahasiswa->current_step = PendaftaranMagangStatusEnum::REJECTED_BY_KAPRODI;
                $pendaftaranMahasiswa->reason_reject = $request->reason;
                $message = 'Pendaftaran mahasiswa rejected.';
            }
            $pendaftaranMahasiswa->save();

            return Response::success(null, $message);
        } catch (\Exception $e) {
            return Response::errorCatch($e);
        }
    }
}