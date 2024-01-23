<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Lokasi;
use App\Models\Industri;
use App\Models\JenisMagang;
use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use App\Models\LowonganMagang;
use Illuminate\Support\Carbon;
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

            $lowongan->transform(function ($item) {
                $item->kandidat = $item->total_pelamar->count();
                $item->screening = $item->total_pelamar->where('applicant_status', 'screening')->count();
                $item->penawaran = $item->total_pelamar->where('applicant_status', 'penawaran')->count();
                $item->diterima = $item->total_pelamar->where('applicant_status', 'diterima')->count();
                $item->ditolak = $item->total_pelamar->where('applicant_status', 'ditolak')->count();
                return $item;
            });

            return view('lowongan_magang.informasi_lowongan.lowongan_card', compact('lowongan'))->render();
        }
        $lowongan = LowonganMagang::where('id_industri', $id)->get();
        $magang = LowonganMagang::where('id_industri', $id)->with('industri')->first();

        $industri = Industri::where('id_industri', $id)->with('total_lowongan')->first();
        $pelamar =
            PendaftaranMagang::where('id_lowongan', $magang->id_lowongan ?? "")->with('lowonganMagang')->first();
        $lowongan_count = $lowongan->count();
        $pendaftar_count = $pelamar?->count() ?? "0";
        $urlGetCard = url('informasi/lowongan', $id);
        // dd($lowongan_count);
        return view('lowongan_magang.informasi_lowongan.informasi_lowongan', compact('industri', 'urlGetCard', 'lowongan_count', 'pendaftar_count', 'magang', 'lowongan'));
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
    public function date(Request $request, string $id_lowongan)
    {
        try {
            $date = LowonganMagang::where('id_lowongan', $id_lowongan)->first();

            if (is_null($date->date_confirm_closing)) {
                $date->date_confirm_closing = Carbon::parse($request->date)->format('Y-m-d');
            }
            $date->save();


            return response()->json([
                'error' => false,
                'message' => 'Confirmation cutoff date added successfully!!',
                'modal' => '#modalKonfirmasi',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
