<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Industri;
use App\Helpers\Response;
use App\Models\Education;
use App\Models\Mahasiswa;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\LowonganProdi;
use App\Models\DocumentSyarat;
use App\Models\LowonganMagang;
use App\Models\InformasiPribadi;
use App\Models\PendaftaranMagang;
use Illuminate\Support\Facades\Auth;
use App\Models\JenisMagang;
use App\Models\PekerjaanTersimpan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\DokumenPendaftaranMagang;
use App\Enums\PendaftaranMagangStatusEnum;

class ApplyLowonganFakultasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $auth = auth()->user();
        if ( $auth && $auth->hasRole('Mahasiswa')) {
            $data['lowongan_tersimpan'] = PekerjaanTersimpan::select('id_lowongan')->where('nim', auth()->user()->mahasiswa->nim)
            ->get()->pluck('id_lowongan')->toArray();
            $data['isMahasiswa'] = true;
        }else{
            $data['lowongan_tersimpan'] = [];
            $data['isMahasiswa'] = false;
        }

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
        $data['kota'] = DB::table('reg_regencies')->get();
        $data['filtered'] = $request->all();
        $data['jenisMagang'] = JenisMagang::all();

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

        $auth = auth()->user();
        if ( $auth && $auth->hasRole('Mahasiswa')) {
            $isMahasiswa = true;
        }else{
            $isMahasiswa = false;
        }

        $kuotaPenuh = $detailLowongan->kuota_terisi / $detailLowongan->kuota == 1;

        if (!$detailLowongan) return Response::error(null, 'Lowongan Not Found', 404);
        $data = view('perusahaan/components/detail_lowongan_fp', compact('detailLowongan','isMahasiswa','kuotaPenuh'))->render();

        return Response::success($data, 'Success');
    }

    // Detail Lowongan 
    public function lamar(Request $request, $id)
    {
        $lowongandetail = LowonganMagang::where('id_lowongan', $id)->with('industri', 'fakultas', 'seleksi_tahap', 'mahasiswa')->first();
        $kuotaPenuh = $lowongandetail->kuota_terisi / $lowongandetail->kuota == 1;

        if($kuotaPenuh){
            return redirect()->route('apply_lowongan')->with('error', 'Kuota lowongan sudah penuh');
        }

        $user = auth()->user();
        $mahasiswa = $user->mahasiswa->load('prodi', 'fakultas', 'univ');

        $registered = PendaftaranMagang::where('nim', $mahasiswa->nim)
        ->whereNotIn('current_step', [
            PendaftaranMagangStatusEnum::REJECTED_BY_DOSWAL,
            PendaftaranMagangStatusEnum::REJECTED_BY_KAPRODI,
            PendaftaranMagangStatusEnum::REJECTED_BY_LKM,
            PendaftaranMagangStatusEnum::REJECTED_SCREENING,
            PendaftaranMagangStatusEnum::REJECTED_SELEKSI_TAHAP_1,
            PendaftaranMagangStatusEnum::REJECTED_SELEKSI_TAHAP_2,
            PendaftaranMagangStatusEnum::REJECTED_SELEKSI_TAHAP_3,
            PendaftaranMagangStatusEnum::REJECTED_PENAWARAN
        ])->get();
        $registeredTwo = $registered->count() >= 2 ? true : false;
        $registeredThis = $registered->where('id_lowongan', $id)->first();

        if($registeredThis) {
            $sudahDaftar = true;
        }else{
            $sudahDaftar = false;
        }

        if($registeredTwo) {
            $daftarDua = true;
        }else{
            $daftarDua = false;
        }

        $magang = PendaftaranMagang::where('id_lowongan', $id)->where('nim', $mahasiswa->nim)->with('lowongan_magang', 'mahasiswa')->first();

        $dokumenPersyaratan = DocumentSyarat::where('id_jenismagang', $lowongandetail->id_jenismagang)->get();

        $urlBack = route('apply_lowongan');

        $urlId = $id;

        $persentase = ProfileMahasiswaController::getFullDataProfile()['percentageData']->percentage;

        return view('apply.apply', compact('urlBack', 'lowongandetail', 'mahasiswa', 'magang', 'persentase', 'urlId', 'sudahDaftar', 'daftarDua', 'dokumenPersyaratan'));
    }

    // Apply Lamran / Kirim Lamaran
    public function apply(Request $request, $id)
    {
        $user = auth()->user();
        $mahasiswa = $user->mahasiswa->load('prodi', 'fakultas', 'univ');

        $registered = PendaftaranMagang::where('nim', $mahasiswa->nim)
        ->whereNotIn('current_step', [
            PendaftaranMagangStatusEnum::REJECTED_BY_DOSWAL,
            PendaftaranMagangStatusEnum::REJECTED_BY_KAPRODI,
            PendaftaranMagangStatusEnum::REJECTED_BY_LKM,
            PendaftaranMagangStatusEnum::REJECTED_SCREENING,
            PendaftaranMagangStatusEnum::REJECTED_SELEKSI_TAHAP_1,
            PendaftaranMagangStatusEnum::REJECTED_SELEKSI_TAHAP_2,
            PendaftaranMagangStatusEnum::REJECTED_SELEKSI_TAHAP_3,
            PendaftaranMagangStatusEnum::REJECTED_PENAWARAN
        ])->get();

        if($registered->where('id_lowongan', $id)->first()) {
            return Response::error(null, 'Anda sudah mendaftar pada lowongan ini', 400);
        }

        if($registered->count() >= 2) {
            return Response::error(null, 'Anda sudah mendaftar pada 2 lowongan', 400);
        }

        $persentase = ProfileMahasiswaController::getFullDataProfile()['percentageData']->percentage;

        if($persentase < 80) {
            return Response::error(null, 'Data profil belum lengkap', 400);
        }

        $lowongandetail = LowonganMagang::where('id_lowongan', $id)->first();
        if (!$lowongandetail) return Response::error(null, 'Lowongan Not Found', 404);
        $dokumenPersyaratan = DocumentSyarat::where('id_jenismagang', $lowongandetail->id_jenismagang)->get();

        $validateData = ['reason' => 'required|string'];
        $validateMsg = [
            'reason.required' => 'Alasan pengajuan harus diisi',
        ];

        foreach ($dokumenPersyaratan as $key => $value) {
            $validateData[str_replace(' ', '_', strtolower($value->namadocument))] = 'required|mimes:pdf,jpg,jpeg,png|max:2000';
            $validateMsg[str_replace(' ', '_', strtolower($value->namadocument)) . '.required'] = 'File '.ucwords(strtolower($value->namadocument)).' harus diisi';
            $validateMsg[str_replace(' ', '_', strtolower($value->namadocument)) . '.mimes'] = 'File '.ucwords(strtolower($value->namadocument)).' harus berupa pdf,jpg,jpeg,png';
            $validateMsg[str_replace(' ', '_', strtolower($value->namadocument)) . '.max'] = 'File '.ucwords(strtolower($value->namadocument)).' melebihi 2 MB';
        }

        $request->validate($validateData, $validateMsg);

        try {
            DB::beginTransaction();

            $pendaftaran = PendaftaranMagang::create([
                'id_lowongan' => $id,
                'nim' => $mahasiswa->nim,
                'tanggaldaftar' => now(),
                'current_step' => PendaftaranMagangStatusEnum::PENDING,
                'reason_aplicant' => $request->reason
            ]);

            $dokumen_persyaratan = [];
            foreach ($dokumenPersyaratan as $key => $value) {
                $namaFile = str_replace(' ', '_', strtolower($value->namadocument));
                $file = null;
                if ($request->hasFile($namaFile)) {
                    $file = $request->file($namaFile);
                    $file = Storage::put('file_persyaratan', $file);
                }

                $dokumen_persyaratan[] = [
                    'id_doc_pendaftaran' => Str::orderedUuid(),
                    'id_pendaftaran' => $pendaftaran->id_pendaftaran,
                    'id_document' => $value->id_document,
                    'file' => $file,
                    'date_time' => now(),
                    'status' => true
                ];
            }

            DokumenPendaftaranMagang::insert($dokumen_persyaratan);

            DB::commit();
            return Response::success(null, 'Lamaran berhasil dikirim!');
        } catch (Exception $e) {
            DB::rollBack();
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

        if ($request->jenis_magang) {
            $data['lowongan'] = $data['lowongan']->where('id_jenismagang', $request->jenis_magang);
        }

        return $data;
    }
}
