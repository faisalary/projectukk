<?php

namespace App\Http\Controllers;

use App\Models\InformasiPribadi;
use App\Models\InformasiTamabahan;
use App\Models\LowonganMagang;
use App\Models\LowonganProdi;
use App\Models\Mahasiswa;
use App\Models\SeleksiTahap;
use Illuminate\Http\Request;

class ApplyLowonganFakultasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $prodilo = LowonganProdi::with('prodi')->first();
        $prodilowongan = LowonganProdi::with('prodi')->get();
        $lowongan = LowonganMagang::with('industri', 'fakultas')->first();
        $lowongan2 = LowonganMagang::with('industri')->get();
        return view('perusahaan.lowongan', compact('prodilo', 'prodilowongan', 'lowongan2', 'lowongan'));
    }

    public function show($id)
    {
        $prodilo = LowonganProdi::with('prodi')->first();
        $prodilowongan = LowonganProdi::with('prodi')->get();
        $lowonganshow2 = LowonganMagang::where('id_lowongan', $id)->with('industri', 'fakultas','seleksi')->first();
        return $lowonganshow2;
    }
    public function lamar(Request $request, $id) {
        $profilemhs = InformasiPribadi::where('nim', $id)->first();
        $mahasiswaprodi = Mahasiswa::with('prodi', 'fakultas', 'univ', 'informasiprib')->first();
        $mahasiswa = auth()->user()->mahasiswa ;
        $persentase = $this->persentase($request->user()->nim);
        $lowongandetail = LowonganMagang::where('id_lowongan', $id)->with('industri', 'fakultas','seleksi', 'mahasiswa')->first();
        return view('apply.apply', compact('persentase', 'lowongandetail', 'mahasiswa', 'mahasiswaprodi', 'profilemhs'));   
    }
    public function persentase($id) {
        $totalData = 17;
        $informasipribadi = InformasiPribadi::where('id_infoprib', true)->count();
        $Infomasitambahan = Mahasiswa::where('nim', true)->count();
        if ($informasipribadi + $Infomasitambahan != 0) {
            $persentase = ($totalData / ($informasipribadi + $Infomasitambahan)) * 100;
        } else {
            $persentase = 0; 
        }

        return $persentase;
    }
}
