<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use App\Models\Industri;
use App\Models\JenisMagang;
use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use App\Models\LowonganMagang;
use App\Models\PendaftaranMagang;

class InformasiLowonganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $id)
    {
        if ($request->ajax() && $request->component == "card") {
            $lowongan = LowonganMagang::where('id_industri', $id)->get();
            // dd($lowongan);
            return view('lowongan_magang.informasi_lowongan.lowongan_card', compact('lowongan'))->render();
        }

        $industri = Industri::with('total_lowongan')->first();
        $pendaftar =
            PendaftaranMagang::leftJoin('lowongan_magang', 'lowongan_magang.id_lowongan', '=', 'pendaftaran_magang.id_lowongan')
            ->where('id_industri', $industri->id_industri)
            ->count();
        // dd($industri);
        $lowongan_count = $industri->total_lowongan->count();
        $urlGetCard = url('informasi/lowongan', $id);
        return view('lowongan_magang.informasi_lowongan.informasi_lowongan', compact('industri', 'urlGetCard', 'lowongan_count', 'pendaftar'));
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
