<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeleksiRequest;
use App\Models\email_template;
use App\Models\LowonganMagang;
use App\Models\Mahasiswa;
use Exception;
use App\Models\Seleksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\PendaftaranMagang;
use App\Models\MhsMagang;
use App\Models\StatusSeleksi;
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
        $status = StatusSeleksi::all();
        $email = email_template::all();
        return view('company.jadwal_seleksi.index', compact('pendaftaran', 'mahasiswa', 'seleksi', 'status', 'email'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        // dd($request->all());
        try {
            $pendaftaran = PendaftaranMagang::where('status', '1')->get();
            foreach ($pendaftaran as $p) {
                list($startDateTime, $endDateTime) = explode(' to ', $request->mulai);
                $startTimestamp = strtotime(trim($startDateTime));
                $startDate = date('Y-m-d', $startTimestamp);
                $startTime = date('H:i', $startTimestamp);
                $endTimestamp = strtotime(trim($endDateTime));
                $endDate = date('Y-m-d', $endTimestamp);
                $endTime = date('H:i', $endTimestamp);
                $seleksi = Seleksi::create([
                    'id_pendaftaran' => $p->id_pendaftaran,
                    'start_date' => $startDate . " ". $startTime,
                    'end_date' => $endDate . " ". $endTime,
                    'namatahap_seleksi' => "",
                    // 'detail' => $request->tempat,
                    'id_email_tamplate' => $request->subjek,
                    'status_seleksi' => true,
                ]);
            }

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
        $seleksi = Seleksi::leftjoin('status_seleksi', 'status_seleksi.id_status_seleksi', 'seleksi_lowongan.id_status_seleksi')
            ->leftjoin('email_template', 'email_template.id_email_template', 'seleksi_lowongan.id_email_tamplate')
            ->leftjoin('pendaftaran_magang', 'status_seleksi.id_pendaftaran', 'pendaftaran_magang.id_pendaftaran')
            ->leftjoin('mahasiswa', 'mahasiswa.nim', 'pendaftaran_magang.nim')
            // ->where('status_seleksi', $statusseleksi)
            ->get();

        return DataTables::of($seleksi)
            ->addIndexColumn()
            ->addColumn('id_pendaftaran', function ($seleksi) {
                $data = $seleksi->namamhs . "  " . $seleksi->nim;
                return $data;
            })
            ->addColumn('start_date', function ($seleksi) {
                $time = $seleksi->start_date . "  " . $seleksi->end_date;
                return $time;
            })
            // ->editColumn('progress', function ($seleksi) {
            //     if ($seleksi->statusseleksi == 0) {
            //         return "<div class='text-center'><div class='badge bg-label-secondary'>" . "Belum di proses" . "</div></div>";
            //     } else {
            //         return "<div class='text-center'><div class='badge bg-label-success'>" . "Sudah di proses" . "</div></div>";
            //     }
            // })
            // ->editColumn('statusseleksi', function ($seleksi) {
            //     if ($seleksi->statusseleksi == 0) {
            //         return "<div class='text-center'><div class='badge bg-label-secondary'>" . "Belum Seleksi Tahap 1" . "</div></div>";
            //     } else {
            //         return "<div class='text-center'><div class='badge bg-label-success'>" . "Sudah Seleksi Tahap 1" . "</div></div>";
            //     }
            // })
            ->addColumn('action', function ($seleksi) {
                $icon = ($seleksi->statusseleksi) ? "ti-circle-x" : "ti-circle-check";
                $color = ($seleksi->statusseleksi) ? "secondary" : "success";

                $btn = "<a href='".url('jadwal-seleksi/detail') ."' data-id='{$seleksi->id_seleksi_lowongan}' onclick=get($(this)) class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i></a>";


                return $btn;
            })
            ->rawColumns(['statusseleksi', 'action', 'progress'])

            // ->toJson();
            ->make(true);
    }

    public function detail()
    {
        return view('company.jadwal_seleksi.detail_seleksi');
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
