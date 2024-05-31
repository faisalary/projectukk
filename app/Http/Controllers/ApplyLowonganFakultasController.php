<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Exception;
use Carbon\Carbon;
use App\Models\Mahasiswa;
use App\Models\SeleksiTahap;
use Illuminate\Http\Request;
use App\Models\LowonganProdi;
use App\Models\LowonganMagang;
use App\Models\InformasiPribadi;
use App\Models\PendaftaranMagang;
use App\Models\InformasiTamabahan;
use Illuminate\Support\Facades\Auth;

class ApplyLowonganFakultasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $prodilo = LowonganProdi::with('prodi')->first();
        $prodilowongan = LowonganProdi::with('prodi')->get();
        // return $prodilowongan;
        $lowongan = LowonganMagang::with('industri', 'fakultas')->first();
        $lowongan2 = LowonganMagang::with('industri')->get();

        return view('perusahaan.lowongan', compact('prodilo', 'prodilowongan', 'lowongan2', 'lowongan'));
    }

    public function show($id)
    {
        $prodilo = LowonganProdi::with('prodi')->first();
        $prodilowongan = LowonganProdi::where('id_lowongan', $id)->with('prodi')->get();
        $lowonganshow2 = LowonganMagang::where('id_lowongan', $id)->with('industri', 'fakultas', 'seleksi')->first();
        $data = [
            'prodilowongan' => $prodilowongan,
            'lowonganshow2' => $lowonganshow2
        ];
        return $data;
    }

    // Detail Lowongan 
    public function lamar(Request $request, $id)
    {
        $nim = Auth::user()->nim;

        $profilemhs = InformasiPribadi::where('nim', $nim)->first();
        $mahasiswaprodi = Mahasiswa::with('prodi', 'fakultas', 'univ', 'informasiprib')->first();
        $mahasiswa = auth()->user()->mahasiswa;
        $persentase = $this->persentase($nim);
        $lowongandetail = LowonganMagang::where('id_lowongan', $id)->with('industri', 'fakultas', 'seleksi', 'mahasiswa')->first();

        $pendaftaran = PendaftaranMagang::where('id_lowongan', $id)->with('lowongan_magang', 'mahasiswa')->get();
        $magang = $pendaftaran->where('nim', $nim)->first();

        return view('apply.apply', compact('persentase', 'lowongandetail', 'mahasiswa', 'mahasiswaprodi', 'profilemhs', 'nim', 'pendaftaran', 'magang'));
    }

    // Apply Lamran / Kirim Lamaran
    public function apply(Request $request, $id)
    {
        try {
            $nim = Auth::user()->nim;

            PendaftaranMagang::create([
                'id_lowongan' => $id,
                'nim' => $nim,
                'tanggaldaftar' => Carbon::parse(now()),
                'current_step' => 'screening',
                'portofolio' =>  $request->porto?->store('post'),
            ]);

            return response()->json([
                'error' => false,
                'message' => 'Lamaran berhasil dikirim!',
                'url' => `{{url('apply-lowongan/lamar')}} /${id}`,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    // Persentase profile
    public function persentase($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        $informasiprib = InformasiPribadi::where('nim', $id)->first();
        $pendidikan = Education::where('nim', $id)->first();
        if ($mahasiswa && $pendidikan && $informasiprib) {
            $filledColumns = 0;

            $mahasiswaColumns = [
                'nim', 
                'angkatan', 
                'id_prodi', 
                'id_univ', 
                'id_fakultas', 
                'namamhs', 
                'alamatmhs', 
                'emailmhs', 
                'nohpmhs', 
                'status',
                'eprt',
                'ipk',
                'tak',
                'lok_magang',
                'skills',
                'tunggakan_bpp'
            ];

            $infropribcolumns = [
                'tgl_lahir',
                'headliner',
                'deskripsi_diri',
                'profile_picture',
                'gender',
            ];
            
            $pendidikanColumns = [
                'name_intitutions',
                'tingkat',
                'nilai',
                'startdate',
                'enddate',
            ];

            $totalColumns = count($mahasiswaColumns) + count($pendidikanColumns) + count($infropribcolumns);

            foreach ($mahasiswaColumns as $column) {
                if (!is_null($mahasiswa->$column) && $mahasiswa->$column !== '') {
                    $filledColumns++;
                }
            }

            foreach ($infropribcolumns as $column) {
                if (!is_null($informasiprib->$column) && $informasiprib->$column !== '') {
                    $filledColumns++;
                }
            }

            foreach ($pendidikanColumns as $column) {
                if (!is_null($pendidikan->$column) && $pendidikan->$column !== '') {
                    $filledColumns++;
                }
            }
            $persentase = ($filledColumns / $totalColumns) * 100;
            
        } else {
            $persentase = 0;
        }

        return $persentase;
    }
}
