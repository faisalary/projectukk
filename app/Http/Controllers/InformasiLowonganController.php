<?php

namespace App\Http\Controllers;

use App\Models\Industri;
use App\Models\JenisMagang;
use App\Models\Lokasi;
use App\Models\LowonganMagang;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;

class InformasiLowonganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lowongan = LowonganMagang::all();
        $industri = Industri::all();
        $thnakademik = TahunAkademik::all();
        $jenisMagang = JenisMagang::all();
        $lokasi = Lokasi::all();
        return view('lowongan_magang.informasi_lowongan.informasi_lowongan', compact('lowongan', 'industri', 'thnakademik', 'lokasi', 'jenisMagang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $lowongan = LowonganMagang::query();
        if ($request->industri != null) {
            $lowongan->where("id_industri", $request->industri);
        } else if ($request->thnakademik != null) {
            $lowongan->where("id_year_akademik", $request->thnakademik);
        } else if ($request->jenisMagang != null) {
            $lowongan->where("id_jenismagang", $request->jenisMagang);
        } else if ($request->lokasi != null) {
            $lowongan->where("id_lokasi", $request->lokasi);
        }

        $lowongan = $lowongan->with("industri", "tahunAkademik", "jenisMagang", "lokasi");

        return $lowongan;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
