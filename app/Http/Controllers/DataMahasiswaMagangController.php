<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\MhsMagang;
use App\Models\MhsMandiri;
use App\Models\PendaftaranMagang;
use App\Models\PengajuanMandiri;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DataMahasiswaMagangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // indeks Mahasiswa Fakultas
    public function index()
    {
        return view('admin_kandidat.data_mhs_magang');
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

        $mhs_magang = MhsMagang::orderBy('id_pendaftaran', 'asc');
        $pelamar = PendaftaranMagang::orderBy('id_pendaftaran', 'asc');

        if ($request->type) {
            $mhs_magang = $pelamar->where('current_step', $request->type)
                ->with(
                    'mahasiswa_magang',
                    'mahasiswa_magang.peg_industri',
                    'mahasiswa_magang.dosen',
                    'mahasiswa',
                    'mahasiswa.prodi',
                    'lowongan_magang',
                    'lowongan_magang.industri'
                );
        }


        return DataTables::of($mhs_magang->get())
            ->addIndexColumn()
            ->addColumn('tgl_magang', function ($item) {
                $time = '<span class="text-muted">Tanggal Mulai</span> <br> <span>' . Carbon::parse($item->mahasiswa_magang->startdate_magang)->format('d F Y') . '</span><br> <span class="text-muted">Tanggal Berakhir</span><br> <span>' . Carbon::parse($item->mahasiswa_magang->enddate_magang)->format('d F Y') . '</span>';
                return $time;
            })
            ->addColumn('doc_terima', function ($item) {
                $doc = "<a class='text-success' href='magang-fakultas/doc/{$item->bukti_doc}' target='_blank'>Bukti Penerimaan.pdf</a>";
                return $doc;
            })
            ->rawColumns(['tgl_magang', 'doc_terima'])

            ->make(true);
    }

    // public function showMandiri(Request $request)
    // {

    //     $mhs_mandiri = MhsMandiri::orderBy('id_pengajuan', 'asc');
    //     $pelamar = PengajuanMandiri::orderBy('id_pengajuan', 'asc');

    //     if ($request->type) {
    //         $mhs_mandiri = $pelamar->where('status_terima', $request->type)
    //             ->with(
    //                 'mahasiswa_mandiri',
    //                 'mahasiswa_mandiri.pbb',
    //                 'mahasiswa_mandiri.dosen',
    //                 'mahasiswa',
    //                 'mahasiswa.prodi'
    //             );
    //     }


    //     return DataTables::of($mhs_mandiri->get())
    //         ->addIndexColumn()
    //         ->addColumn('tgl_magang', function ($item) {
    //             $time = '<span class="text-muted">Tanggal Mulai</span> <br> <span>' . Carbon::parse($item->startdate)->format('d F Y') . '</span><br> <span class="text-muted">Tanggal Berakhir</span><br> <span>' . Carbon::parse($item->enddate)->format('d F Y') . '</span>';
    //             return $time;
    //         })
    //         ->addColumn('doc_terima', function ($item) {
    //             $doc = "<a class='text-success' href='magang-mandiri/doc/{$item->bukti_doc}' target='_blank'>Bukti Penerimaan.pdf</a>";
    //             return $doc;
    //         })
    //         ->rawColumns(['tgl_magang', 'doc_terima'])

    //         ->make(true);
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    public function doc($file)
    {
        $path = storage_path($file);

        return response()->file($path);
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
