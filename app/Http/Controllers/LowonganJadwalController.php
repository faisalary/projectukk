<?php

namespace App\Http\Controllers;

use App\Models\LowonganMagang;
use App\Models\Seleksi;
use Illuminate\Http\Request;

class LowonganJadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $id)
    {
        if ($request->ajax() && $request->component == "card") {
            $lowongan = LowonganMagang::where('id_industri', $id)->get();
            $seleksi= Seleksi::where('id_seleksi_lowongan', $id)->get();

            // $seleksi->transform(function ($item) {
            //     // $item->kandidat = $item->total_pelamar->count();
            //     $item->tahap1 = $item->namatahap_seleksi->where('namatahap_seleksi', 'tahap1')->count();
            //     $item->tahap2 = $item->namatahap_seleksi->where('namatahap_seleksi', 'tahap2')->count();
            //     $item->tahap3 = $item->namatahap_seleksi->where('namatahap_seleksi', 'tahap3')->count();
            //     return $item;
            // });

            $seleksi = $seleksi->map(function ($item) {
                $item->tahap1 = $item->namatahap_seleksi->where('namatahap_seleksi', 'tahap1')->count();
                $item->tahap2 = $item->namatahap_seleksi->where('namatahap_seleksi', 'tahap2')->count();
                $item->tahap3 = $item->namatahap_seleksi->where('namatahap_seleksi', 'tahap3')->count();
                return $item;
            });
// dd($seleksi);            

            return view('company.jadwal_seleksi.jadwal_card ', compact('lowongan','seleksi'))->render();
        }
        $urlGetCard = url('jadwal-seleksi/lowongan', $id);
        $LMagang = LowonganMagang::where('id_industri', $id)->get();
        $lowongan_count = $LMagang->count();

        $lowongan = LowonganMagang::where('id_industri', $id)->first();
        $seleksi = Seleksi::all();
        return view('company.jadwal_seleksi.jadwal', compact('seleksi', 'lowongan', 'urlGetCard', 'lowongan_count'));
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
    public function show(string $id)
    {
        //
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
