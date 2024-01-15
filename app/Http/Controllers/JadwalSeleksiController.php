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
                    'start_date' => $startDate . " " . $startTime,
                    'end_date' => $endDate . " " . $endTime,
                    'namatahap_seleksi' => $request->tahap,
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

    public function show(Request $request)
    {

        $pelamar = PendaftaranMagang::first();

        $statusseleksi = $pelamar->applicant_status;
        if ($statusseleksi == 'tahap1') {
            $statusseleksi = 'tahap1';
        } elseif ($statusseleksi == 'tahap2') {
            $statusseleksi = 1;
        } elseif ($statusseleksi == 'tahap3') {
            $statusseleksi = 2;
        }

        $seleksi = Seleksi::with("seleksi_status", "seleksi_status.pendaftaran", "seleksi_status.pendaftaran.mahasiswa");

        if ($request->type) {
            $seleksi = $seleksi->where('namatahap_seleksi', $request->type);
        }
        return DataTables::of($seleksi->get())
            ->addIndexColumn()
            ->addColumn('start_date', function ($seleksi) {
                $time = '<span class="text-muted">Tanggal Mulai</span> <br> <span>' . $seleksi->start_date . '</span><br> <span class="text-muted">Tanggal Akhir</span><br> <span>' . $seleksi->end_date . '</span>';
                return $time;
            })
            ->editColumn('progress', function ($seleksi) {
                return "<div class='col-md-12'>
                    <div class='position-relative'>
                            <select class='form-select select2'>
                            <option value='1'>Belum Seleksi</option>
                            <option value='2'>Sudah Seleksi</option>
                        </select>
                    </div>
                </div>";
            })
            ->editColumn('status_seleksi', function ($seleksi) {
                return "<div class='col-md-12'>
                    <div class='position-relative'>
                            <select class='form-select select2'>
                            <option value='1'>Diterima</option>
                            <option value='2'>Ditolak</option>
                        </select>
                    </div>
                </div>";
            })
            ->addColumn('action', function ($seleksi) {
                $btn = "<a href='" . url('jadwal-seleksi/detail') . "' data-id='{$seleksi->id_seleksi_lowongan}' onclick=get($(this)) class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i></a>";
                return $btn;
            })
            ->rawColumns(['status_seleksi', 'action', 'progress', 'start_date',])

            // ->toJson();
            ->make(true);
    }

    public function detail()
    {
        return view('company.jadwal_seleksi.detail_seleksi');
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function status()
    {
        //
    }
}
