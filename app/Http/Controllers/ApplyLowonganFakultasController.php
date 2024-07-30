<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Industri;
use App\Helpers\Response;
use App\Models\Education;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\LowonganProdi;
use App\Models\LowonganMagang;
use App\Models\InformasiPribadi;
use App\Models\PendaftaranMagang;
use Illuminate\Support\Facades\Auth;
use App\Enums\PendaftaranMagangStatusEnum;
use App\Models\PekerjaanTersimpan;
use Illuminate\Support\Facades\Storage;

class ApplyLowonganFakultasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['lowongan_tersimpan'] = PekerjaanTersimpan::select('id_lowongan')->where('nim', auth()->user()->mahasiswa->nim)
        ->get()->pluck('id_lowongan')->toArray();

        $data['lowongan'] = LowonganMagang::select(
            'lowongan_magang.*', 'industri.image', 'industri.namaindustri'
        )
        ->join('industri', 'lowongan_magang.id_industri', '=', 'industri.id_industri')->where('statusaprove', 'diterima');

        $data = self::filterData($data, $request);

        $data['lowongan'] = $data['lowongan']->paginate(3)->toJson();
        $data['pagination'] = json_decode($data['lowongan'], true);
        $data['lowongan'] = $data['pagination']['data'];

        if ($request->ajax()) {
            return Response::success([
                'pagination' => view('perusahaan/components/pagination', $data)->render(),
                'view' => view('perusahaan/components/card_lowongan_fp', $data)->render(),
            ]);
        }

        $data['perusahaan'] = Industri::where('statusapprove', 1)->get();

        return view('perusahaan.lowongan', $data);
    }

    public function show($id)
    {
        $detailLowongan = LowonganMagang::select(
            'lowongan_magang.*', 'industri.image', 'industri.namaindustri',
            'industri.description as deskripsi_industri'
        )
        ->join('industri', 'lowongan_magang.id_industri', '=', 'industri.id_industri')
        ->where('id_lowongan', $id)
        ->where('statusaprove', 'diterima')->first()->dataTambahan('jenjang_pendidikan', 'program_studi');

        if (!$detailLowongan) return Response::error(null, 'Lowongan Not Found', 404);
        $data = view('perusahaan/components/detail_lowongan_fp', compact('detailLowongan'))->render();

        return Response::success($data, 'Success');
    }

    // Detail Lowongan 
    public function lamar(Request $request, $id)
    {
        $nim = Auth::user()->nim;

        $mahasiswaprodi = Mahasiswa::with('prodi', 'fakultas', 'univ')->first();
        $mahasiswa = auth()->user()->mahasiswa;
        $lowongandetail = LowonganMagang::where('id_lowongan', $id)->with('industri', 'fakultas', 'seleksi_tahap', 'mahasiswa')->first();

        $pendaftaran = PendaftaranMagang::where('id_lowongan', $id)->with('lowongan_magang', 'mahasiswa')->get();
        $magang = $pendaftaran->where('nim', $nim)->first();

        $urlBack = route('apply_lowongan.detail', ['id' => $id]);

        return view('apply.apply', compact('urlBack', 'lowongandetail', 'mahasiswa', 'mahasiswaprodi', 'nim', 'pendaftaran', 'magang'));
    }

    // Apply Lamran / Kirim Lamaran
    public function apply(Request $request, $id)
    {
        $request->validate([
            'porto' => 'required|mimes:pdf|max:5000',
            'reason' => 'required|string|max:1000'
        ], [
            'porto.mimes' => 'File harus berupa pdf',
            'porto.max' => 'File melebihi 5 MB',
            'reason.required' => 'Alasan pengajuan harus diisi',
            'reason.string' => 'Alasan pengajuan harus berupa string',
            'reason.max' => 'Alasan pengajuan maksimal 1000 karakter'
        ]);

        try {
            $mahasiswa = auth()->user()->mahasiswa;  

            $lowongandetail = LowonganMagang::where('id_lowongan', $id)->first();
            if (!$lowongandetail) return Response::error(null, 'Lowongan Not Found', 404);

            $file = null;
            if ($request->hasFile('porto')) {
                $file = Storage::put('portofolio', $request->porto);
            }

            $pendaftaran = PendaftaranMagang::create([
                'id_lowongan' => $id,
                'nim' => $mahasiswa->nim,
                'tanggaldaftar' => now(),
                'current_step' => PendaftaranMagangStatusEnum::PENDING,
                'portofolio' => $file,
                'reason_aplicant' => $request->reason
            ]);

            return Response::success(null, 'Lamaran berhasil dikirim!');
        } catch (Exception $e) {
            return Response::errorCatch($e);
        }
    }

    private static function filterData($data, $request) {
        if ($request->lowongan) {
            $data['lowongan'] = $data['lowongan']->where('intern_position', 'like', '%'.$request->lowongan.'%');
        }

        if ($request->location) {
            $data['lowongan'] = $data['lowongan']->where('lokasi', 'like', '%'.$request->location.'%');
        }
        if ($request->start_date && $request->end_date) {
            $start = Carbon::parse($request->start_date)->format('Y-m-d');
            $end = Carbon::parse($request->end_date)->format('Y-m-d');
            $data['lowongan'] = $data['lowongan']->whereBetween('lowongan_magang.created_at', [$start, $end]);
        }

        if ($request->perusahaan) {
            $data['lowongan'] = $data['lowongan']->whereIn('lowongan_magang.id_industri', $request->perusahaan);
        }

        if ($request->paymentType) {
            if ($request->paymentType == 'berbayar' && $request->nominal_minimal) {
                $data['lowongan'] = $data['lowongan']->where('nominal_salary', '>=', $request->nominal_minimal);
            } else {
                $data['lowongan'] = $data['lowongan']->whereNull('nominal_salary');
            }
        }

        if ($request->type_magang) {
            $data['lowongan'] = $data['lowongan']->where(function ($query) use ($request) {
                foreach ($request->type_magang as $key => $value) {
                    $query->orWhere('durasimagang', 'like', '%' . $value . '%');
                }
            });
        }

        if ($request->pelaksanaan) {
            $data['lowongan'] = $data['lowongan']->where(function ($query) use ($request) {
                foreach ($request->pelaksanaan as $key => $value) {
                    $query->orWhere('pelaksanaan', $value);
                }
            });
        }

        return $data;
    }
}
