<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class KelolaMahasiswaPemAkademikController extends Controller
{
    public function index()
    {
        return view('kelola_mahasiswa.index');
    }

    public function getData(Request $request)
    {
        try {
            $data = DB::table('mhs_magang')
                ->select(
                    'mhs_magang.id_pendaftaran',
                    DB::raw('COALESCE(mahasiswa.namamhs, "") as namamhs'),
                    DB::raw('COALESCE(program_studi.namaprodi, "") as namaprodi'),
                    DB::raw('COALESCE(mhs_magang.jenis_magang, "") as jenis_magang'),
                    DB::raw('COALESCE(lowongan_magang.intern_position, "") as intern_position'),
                    DB::raw('COALESCE(industri.namaindustri, "") as namaindustri'),
                    DB::raw('COALESCE(lowongan_magang.durasimagang, "") as durasimagang'),
                    DB::raw('COALESCE(mhs_magang.nilai_akhir_magang, 0) as nilai_akhir_magang'),
                    DB::raw('COALESCE(mhs_magang.indeks_nilai_akhir, "") as indeks_nilai_akhir')
                )
                ->join('pendaftaran_magang', 'mhs_magang.id_pendaftaran', '=', 'pendaftaran_magang.id_pendaftaran')
                ->join('mahasiswa', 'pendaftaran_magang.nim', '=', 'mahasiswa.nim')
                ->join('program_studi', 'mahasiswa.id_prodi', '=', 'program_studi.id_prodi')
                ->join('lowongan_magang', 'pendaftaran_magang.id_lowongan', '=', 'lowongan_magang.id_lowongan')
                ->join('industri', 'lowongan_magang.id_industri', '=', 'industri.id_industri')
                ->get();

            // Log the raw data to inspect it
            Log::info('Raw Data: ', ['data' => $data]);

            $response = DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('namamhs', function ($row) {
                    return $row->namamhs ?: '-';
                })
                ->editColumn('namaprodi', function ($row) {
                    return $row->namaprodi ?: '-';
                })
                ->editColumn('jenis_magang', function ($row) {
                    return $row->jenis_magang ?: '-';
                })
                ->editColumn('intern_position', function ($row) {
                    return $row->intern_position ?: '-';
                })
                ->editColumn('namaindustri', function ($row) {
                    return $row->namaindustri ?: '-';
                })
                ->editColumn('durasimagang', function ($row) {
                    $durasimagang = json_decode($row->durasimagang, true);
                    $durasimagangText = is_array($durasimagang) ? implode(', ', $durasimagang) : $durasimagang;
                    return $durasimagangText ?: '-';
                })
                ->editColumn('nilai_akhir_magang', function ($row) {
                    return $row->nilai_akhir_magang ?: '-';
                })
                ->editColumn('indeks_nilai_akhir', function ($row) {
                    return $row->indeks_nilai_akhir ?: '-';
                })
                ->addColumn('berkas_akhir', function ($row) {
                    return '-'; // Set berkas_akhir to a dash
                })
                ->addColumn('aksi', function ($row) {
                    return "<div class='d-flex justify-content-center'><a href='/input/nilai/akademik' class='btn-icon text-warning'><i class='tf-icons ti ti-clipboard-list'></i></a> 
                            <a href='/view/logbook' class='btn-icon text-info'><i class='tf-icons ti ti-book'></i></a></div>";
                })
                ->rawColumns(['aksi'])
                ->make(true);

            return $response;
        } catch (\Exception $e) {
            // Log the exception
            Log::error('Error: ' . $e->getMessage());

            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
