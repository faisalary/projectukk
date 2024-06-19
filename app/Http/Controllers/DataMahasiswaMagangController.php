<?php

namespace App\Http\Controllers;

use App\Models\JenisMagang;
use Carbon\Carbon;
use App\Models\MhsMagang;
use App\Models\MhsMandiri;
use App\Models\PendaftaranMagang;
use App\Models\PengajuanMandiri;
use App\Models\ProgramStudi;
use App\Models\TahunAkademik;
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
        $jenis = JenisMagang::all();
        $prodi = ProgramStudi::all();
        $tahun_ajaran = TahunAkademik::orderBy('tahun', 'desc')->get();

        return view('admin_kandidat.data_mhs_magang', compact('jenis', 'prodi', 'tahun_ajaran'));
    }

    public function show(Request $request)
    {

        $mhs_magang = MhsMagang::orderBy('id_pendaftaran', 'asc');
        $pelamar = PendaftaranMagang::orderBy('id_pendaftaran', 'asc');

        if ($request->type) {
            $mhs_magang = $pelamar->where('current_step', $request->type)
                ->join('mahasiswa', 'pendaftaran_magang.nim', '=', 'mahasiswa.nim')
                ->join('lowongan_magang', 'pendaftaran_magang.id_lowongan', '=', 'lowongan_magang.id_lowongan')
                ->with(
                    'mahasiswa_magang',
                    'mahasiswa_magang.peg_industri',
                    'mahasiswa_magang.dosen',
                    'mahasiswa',
                    'mahasiswa.prodi',
                    'lowongan_magang',
                    'lowongan_magang.industri',
                    'lowongan_magang.jenis_magang'
                );

            if ($request->prodi != null) {
                $mhs_magang = $mhs_magang->where('mahasiswa.id_prodi', $request->prodi);
            }

            if ($request->jenis != null) {
                $mhs_magang = $mhs_magang->where('lowongan_magang.id_jenismagang', $request->jenis);
            }
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
 
}
