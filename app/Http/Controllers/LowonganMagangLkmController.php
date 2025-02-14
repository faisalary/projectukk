<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use App\Models\LowonganMagang;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Enums\LowonganMagangStatusEnum;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class LowonganMagangLkmController extends Controller
{
    public function __construct(){

        // $this->middleware(['role:superadmin']);
    }
     /**
     * Display a listing of the resource.
     */

     public function index()
     {
         return view('lowongan_magang.kelola_lowongan_magang_admin.halaman_lowongan_magang_admin');
     }

     /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $request->validate(['type' => 'string|in:' . implode(',', LowonganMagangStatusEnum::getConstants())]);

        $lowongan = LowonganMagang::query();

        if ($request->type) {
            $lowongan = $lowongan->where("statusaprove", $request->type);
        }

        $lowongan = $lowongan->with("jenismagang", "industri")->orderBy('id_jenismagang', 'desc')->get();

        return DataTables::of($lowongan)
            ->addIndexColumn()
            ->editColumn('status', function ($row) {
                if ($row->status == 1) {
                    return "<div class='text-center'><div class='badge rounded-pill bg-label-primary'>Active</div></div>";
                } else {
                    return "<div class='text-center'><div class='badge rounded-pill bg-label-danger'>Inactive</div></div>";
                }
            })
            ->addColumn('action', function ($row) {
                $icon = ($row->status) ? "ti-circle-x" : "ti-circle-check";
                $color = ($row->status) ? "danger" : "primary";
                $btn = "
                 <div class='d-flex justify-content-center'><a href='" . route('lowongan.kelola.detail', ['id'=> $row->id_lowongan]) . "' onclick=detail($(this)) data-id='{$row->id_lowongan}' class='cursor-pointer mx-1 text-success'><i class='tf-icons ti ti-file-invoice' ></i></a>
                 <a data-status='{$row->status}' data-id='{$row->id_lowongan}' data-url='/kelola/lowongan/mitra/status' class='cursor-pointer mx-1 update-status text-{$color}'><i class='tf-icons ti {$icon}'></i></a></div>";
                return $btn;
            })
            ->addColumn('tanggal', function ($row) {
                $result = '<div class="text-start">';

                $result .= '<span class="text-muted">Publish</span><br>';
                $result .= '<span>' . Carbon::parse($row->startdate)->format('d F Y') . '</span><br>';
                $result .= '<span class="text-muted">Takedown</span><br>';
                $result .= '<span>' . Carbon::parse($row->enddate)->format('d F Y') . '</span>';

                $result .= '</div>';
                return  $result;
            })
            ->editColumn('durasimagang', function ($data) {
                $result = implode(' dan ', json_decode($data->durasimagang));
                return $result;
            })
            ->addColumn('prodi', function ($row) {
                $prodi = $row->dataTambahan('program_studi')->program_studi->pluck('namaprodi')->toArray();
                $result = '<ul  class="ps-2 ms-0 mb-0">';
                foreach ($prodi as $key => $value) {
                    $result .= '<li class="text-nowrap">' .$value. '</li>';
                }
                $result .= '</ul>';

                return $result;
            })
            ->rawColumns(['prodi', 'action', 'status', 'tanggal', 'durasimagang'])
            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function detail($id)
    {
        $lowongan = LowonganMagang::where('id_lowongan', $id)
            ->with('industri', 'seleksi_tahap')
            ->first()->dataTambahan('jenjang_pendidikan', 'program_studi');

        $prodi = ProgramStudi::all();
        $tahunAjaran = TahunAkademik::all();
        if (!$lowongan) return redirect()->route('lowongan.kelola');

        $kuotaPenuh = $lowongan->kuota_terisi / $lowongan->kuota == 1;
        $urlBack = route('lowongan.kelola');
        return view('lowongan_magang.kelola_lowongan_magang_admin.detail', compact( 'lowongan', 'prodi', 'tahunAjaran', 'urlBack', 'kuotaPenuh'));
    }

    public function approved(Request $request, $id)
    {
        try {
            $lowongan = LowonganMagang::find($id)->dataTambahan('jenjang_pendidikan');
            if (!$lowongan) return Response::error(null, 'Lowongan tidak ditemukan');

            $validate = [
                'tahun_ajaran' => 'required|exists:tahun_akademik,id_year_akademik',
                'mulai_magang' => 'required|before:selesai_magang',
                'selesai_magang' => 'required|after:mulai_magang',
            ];
            $message = [
                'tahun_ajaran.required' => 'Pilih tahun ajaran terlebih dahulu',
                'tahun_ajaran.exists' => 'Tahun ajaran tidak valid',
                'mulai_magang.required' => 'Masukkan tanggal mulai magang terlebih dahulu',
                'mulai_magang.before' => 'Masukkan tanggal mulai magang terlebih dahulu',
                'selesai_magang.required' => 'Masukkan tanggal selesai magang terlebih dahulu',
                'selesai_magang.after' => 'Masukkan tanggal selesai magang terlebih dahulu',
            ];
            foreach ($lowongan->jenjang_pendidikan as $key => $value) {
                $validate["prodi_" . $value] = 'required|array|min:1|exists:program_studi,id_prodi';

                $message["prodi_" . $value . ".required"] = 'Pilih prodi terlebih dahulu';
                $message["prodi_" . $value . ".min"] = 'Pilih prodi terlebih dahulu';
                $message["prodi_" . $value . ".exists"] = 'Prodi tidak valid';
            }

            $validator = Validator::make($request->all(), $validate, $message);
            if ($validator->fails()) {
                return Response::errorValidate($validator->errors(), 'Data tidak valid');
            }

            DB::beginTransaction();

            foreach ($lowongan->jenjang_pendidikan as $value) {
                foreach ($request->input('prodi_' . $value) as $k => $v) {
                    $result[$value][] = $v;
                }
            }

            $lowongan->id_year_akademik = $request->tahun_ajaran;
            $lowongan->jenjang = json_encode($result);
            $lowongan->mulai_magang = Carbon::parse($request->mulai_magang)->format('Y-m-d');
            $lowongan->selesai_magang = Carbon::parse($request->selesai_magang)->format('Y-m-d');
            $lowongan->statusaprove = LowonganMagangStatusEnum::APPROVED;
            $lowongan->status_user = json_encode([auth()->user()->id, auth()->user()->name]);
            $lowongan->status_time = date('H:i:s Y-m-d');
            $lowongan->save();

            DB::commit();

            return Response::success(null, 'Persetujuan berhasil.');
        } catch (\Exception $e) {
            DB::rollBack();
            return Response::errorCatch($e);
        }
    }

    public function rejected($id, Request $request)
    {
        $request->validate([
            'alasan' => 'required|string',
        ], ['alasan.required' => 'Alasan ditolak harus diisi']);

        try{
            $data = LowonganMagang::find($id);
            if (!$data) return Response::error(null, 'Lowongan tidak ditemukan.');

            $data->alasantolak = $request->alasan;
            $data->statusaprove = LowonganMagangStatusEnum::REJECTED;
            $data->date_confirm_closing = date('Y-m-d');
            $data->status_user = json_encode([auth()->user()->id, auth()->user()->name]);
            $data->status_time = date('H:i:s Y-m-d');
            $data->save();
            DB::commit();

            return Response::success(null, 'Penolakan berhasil.');
        } catch (\Exception $e) {
            DB::rollBack();
            return Response::errorCatch($e);
        }
    }
}
