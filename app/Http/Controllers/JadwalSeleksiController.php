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
        $a = [];
        if (request()->updateMassive == true) {
            foreach (explode(',', $request->checked[0]) as $id) {
                $a = Seleksi::find($id);
                if ($a) {
                    if ($request->hayolo == null) {
                        return response()->json([
                            'error' => true,
                            'message' => 'No Status Kandidat selected',
                        ], 422);
                    }
                    $a->statusseleksi = $request->hayolo;
                    $a->save();
                }
            }
            return response()->json([
                'error' => false,
                'message' => 'Data Updated!',
                'table' => '.table-jadwal-seleksi',
                'modal' => 'none'
            ]);
        }
        try {
            Seleksi::create([
                'id_pendaftaran' => $request->id_pendaftaran,
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
        if (request()->tahap == '0') {
            $statusseleksi = 0;
        } elseif (request()->tahap == '1') {
            $statusseleksi = 1;
        } elseif (request()->tahap == '2') {
            $statusseleksi = 2;
        }
        $seleksi = Seleksi::select('seleksi.*', 'pendaftaran_magang.tanggaldaftar', 'mahasiswa.namamhs', 'mahasiswa.nim')->join('pendaftaran_magang', 'pendaftaran_magang.id_pendaftaran', 'seleksi.id_pendaftaran')
            ->join('lowongan_magang', 'lowongan_magang.id_lowongan', 'pendaftaran_magang.id_lowongan')
            ->join('mahasiswa', 'mahasiswa.nim', 'pendaftaran_magang.nim')
            ->where('statusseleksi', $statusseleksi)
            ->get();

        return DataTables::of($seleksi)
            ->addIndexColumn()
            ->addColumn('checkbox', function ($seleksi) {
                // return '<input class="form-check-input checkbox1" type="checkbox" name="checkTerapkan[]" value="'.$seleksi->id_seleksi.'">';
                return $seleksi->id_seleksi;
            })
            ->addColumn('id_pendaftaran', function ($seleksi) {
                $data = $seleksi->namamhs . "  " . $seleksi->nim;
                return $data;
            })
            ->editColumn('proses', function ($seleksi) {
                if ($seleksi->statusseleksi == 0) {
                    return "<div class='text-center'><div class='badge bg-label-secondary'>" . "Belum di proses" . "</div></div>";
                } else {
                    return "<div class='text-center'><div class='badge bg-label-success'>" . "Sudah di proses" . "</div></div>";
                }
            })
            ->editColumn('statusseleksi', function ($seleksi) {
                if ($seleksi->statusseleksi == 0) {
                    return "<div class='text-center'><div class='badge bg-label-secondary'>" . "Belum Seleksi Tahap 1" . "</div></div>";
                } else {
                    return "<div class='text-center'><div class='badge bg-label-success'>" . "Sudah Seleksi Tahap 1" . "</div></div>";
                }
            })
            ->addColumn('action', function ($seleksi) {
                $icon = ($seleksi->statusseleksi) ? "ti-circle-x" : "ti-circle-check";
                $color = ($seleksi->statusseleksi) ? "secondary" : "success";

                $btn = "<a data-bs-toggle='modal' data-id='{$seleksi->id_seleksi}' onclick=edit($(this)) class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i>
                <a data-bs-toggle='modal' data-id='{$seleksi->id_seleksi}' data-bs-target='#modaldetail' onclick=get($(this)) class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i></a>";
                

                return $btn;
            })
            ->rawColumns(['checkbox', 'statusseleksi', 'action', 'proses'])

            // ->toJson();
            ->make(true);
    }

    public function edit($id)
    {
        $seleksi = Seleksi::where('id_seleksi', $id)->first();
        if ($seleksi->pelaksanaan == 0) {
            $seleksi->pelaksanaan = "Onsite";
        } else {
            $seleksi->pelaksanaan = "Online";
        }
        $seleksi['teks'] = $seleksi->status_seleksi_text;
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
