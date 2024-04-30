<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\Industri;
use App\Models\LowonganMagang;
use App\Models\LowonganProdi;
use App\Models\SeleksiTahap;
use Illuminate\Http\Request;

class ApplyLowonganFakultasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
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
        $lowongan = LowonganMagang::where('id_lowongan', $id)->with('industri', 'fakultas','seleksi')->first();
        return $lowongan;
    }
    public function lamar($id) {
        $lowongan = LowonganMagang::where('id_lowongan', $id)->with('industri', 'fakultas','seleksi')->first();
        return view('apply.apply', compact('lowongan'));   
    }
}
