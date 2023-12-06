<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeleksiRequest;
use App\Models\LowonganMagang;
use App\Models\Mahasiswa;
use Exception;
use App\Models\Seleksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\PendaftaranMagang;
use App\Models\MhsMagang;
use Illuminate\Routing\Route;

class JadwalSeleksiController extends Controller
{
    public function jadwal()
    {
        $seleksi = Seleksi::all();
        return view('company.jadwal_seleksi.jadwal', compact('seleksi'));
    }

    public function index()
    {
        $pendaftaran = PendaftaranMagang::select('pendaftaran_magang.*', 'lowongan_magang.intern_position', 'mahasiswa.namamhs')->join('mahasiswa', 'mahasiswa.nim', 'pendaftaran_magang.nim')->join('lowongan_magang', 'lowongan_magang.id_lowongan', 'pendaftaran_magang.id_lowongan')->where('lowongan_magang.intern_position', 'UI/UX Designer')->get();
        $mahasiswa = Mahasiswa::all();
        $lowongan = LowonganMagang::all();
        $seleksi = Seleksi::all();
        return view('company.jadwal_seleksi.index', compact('pendaftaran', 'mahasiswa', 'seleksi'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try {
            Seleksi::create([
                'id_pendaftaran' => $request->id_pendaftaran,
                'pelaksanaan' => $request->pelaksanaan,
                'tglseleksi' => $request->mulai,
                'jamseleksi' => $request->waktu,
                'detail' => $request->tempat,
                'statusseleksi' => true,
            ]);

            return response()->json([
                'error' => false,
                'message' => 'Data successfully Created!',
                'modal' => '#modalTambahJadwal',
                'table' => '#table-jadwal-seleksi'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function show()
    {
        $seleksi = Seleksi::select('seleksi.*', 'pendaftaran_magang.tanggaldaftar', 'mahasiswa.namamhs', 'mahasiswa.nim')->join('pendaftaran_magang', 'pendaftaran_magang.id_pendaftaran', 'seleksi.id_pendaftaran')
            ->join('lowongan_magang', 'lowongan_magang.id_lowongan', 'pendaftaran_magang.id_lowongan')
            ->join('mahasiswa', 'mahasiswa.nim', 'pendaftaran_magang.nim')
            ->get();

        return DataTables::of($seleksi)
            ->addIndexColumn()
            ->addColumn('id_pendaftaran', function ($seleksi) {
                $data = $seleksi->namamhs . "  " . $seleksi->nim;
                return $data;
            })
            ->addColumn('pelaksanaan', function ($seleksi) {
                if ($seleksi->pelaksanaan == 0) {
                    return "Onsite";
                } else {
                    return "Online";
                }
                return $seleksi->pelaksanaan;
            })
            ->editColumn('status', function ($seleksi) {
                if ($seleksi->status == 1) {
                    return "<div class='text-center'><div class='badge bg-label-success'>" . "Sudah Seleksi Tahap 1" . "</div></div>";
                } else {
                    return "<div class='text-center'><div class='badge bg-label-secondary'>" . "Belum Seleksi Tahap 1" . "</div></div>";
                }
            })
            ->addColumn('action', function ($seleksi) {
                $icon = ($seleksi->status) ? "ti-circle-x" : "ti-circle-check";
                $color = ($seleksi->status) ? "secondary" : "success";

                $btn = "<a data-bs-toggle='modal' data-id='{$seleksi->id_seleksi}' onclick=edit($(this)) class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i>
                <a data-bs-toggle='modal' data-id='{$seleksi->id_seleksi}' data-bs-target='#modaldetail'  class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i></a>";

                return $btn;
            })
            ->rawColumns(['status', 'action'])

            // ->toJson();
            ->make(true);
    }

    public function edit($id)
    {
        $seleksi = Seleksi::where('id_seleksi', $id)->first();
        return $seleksi;
    }

    public function update(Request $request, $id)
    {
        try {
            $seleksi = Seleksi::where('id_seleksi', $id)->first();
            $seleksi->id_pendaftaran = $request->id_pendaftaran;
            $seleksi->pelaksanaan = $request->pelaksanaan;
            $seleksi->tglseleksi = $request->mulai;
            $seleksi->jamseleksi = $request->waktu;
            $seleksi->detail = $request->tempat;
            $seleksi->save();

            return response()->json([
                'error' => false,
                'message' => 'Data successfully Updated!',
                'modal' => '#modalTambahJadwal',
                'table' => '#table-jadwal-seleksi'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function status()
    {
        //
    }
}
