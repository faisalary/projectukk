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
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Expr\New_;

class JadwalSeleksiController extends Controller
{
    public function index(Request $request, $id)
    {
        $pendaftaran = PendaftaranMagang::where('id_lowongan', $id)->with('lowonganMagang')->first();
        $mahasiswa = Mahasiswa::all();
        $lowongan = LowonganMagang::where('id_lowongan', $id)->first();
        // dd($lowongan);
        // $lowongan = new LowonganMagang();
        // $lowongan = [
        //     'tahap1' => $lowongan->where('tahapan_seleksi', 1)->cound(),
        //     'tahap2' => $lowongan->where('tahapan_seleksi', 2)->cound(),
        //     'tahap3' => $lowongan->where('tahapan_seleksi', 3)->cound(),

        // ];
        // dd($id);
        $seleksi = Seleksi::all();
        $status = StatusSeleksi::all();
        $email = email_template::all();
        return view('company.jadwal_seleksi.index', compact('pendaftaran', 'mahasiswa', 'seleksi', 'status', 'email', 'lowongan'));
    }

    public function create()
    {
        //
    }

    public function store(SeleksiRequest $request)
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

                $user = 'Mita Mutiara';
                Mail::to('mitamutiara476@gmail.com')->send(new \App\Mail\EmailJadwalSeleksi($user, $email->subject_email));
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

    public function show(Request $request, $id)
    {
        // $pelamar = PendaftaranMagang::first();

        $seleksi = Seleksi::with("seleksi_status", "seleksi_status.pendaftaran", "seleksi_status.pendaftaran.mahasiswa");

        if ($request->type) {
            $seleksi = $seleksi->where('namatahap_seleksi', $request->type);
        }

        // return $seleksi->get();
        return DataTables::of($seleksi->get())
            ->addIndexColumn()
            ->addColumn('start_date', function ($seleksi) {
                $time = '<span class="text-muted">Tanggal Mulai</span> <br> <span>' . $seleksi->start_date . '</span><br> <span class="text-muted">Tanggal Akhir</span><br> <span>' . $seleksi->end_date . '</span>';
                return $time;
            })
            ->editColumn('progress', function ($seleksi) {
                return "<div class='col-md-12'>
                    <div class='position-relative'>
                            <select class='form-select select2' onchange='progress($(this))' data-type='progress' data-tahap=' " . $seleksi->namatahap_seleksi . " ' data-id='" . $seleksi->id_seleksi_lowongan . " '>
                            <option value='0' " . ((isset($seleksi->seleksi_status->progress) && $seleksi->seleksi_status->progress == '0') ? "selected" : '') . ">Belum Seleksi</option>
                            <option value='1' " . ((isset($seleksi->seleksi_status->progress) && $seleksi->seleksi_status->progress == '1') ? "selected" : '') . ">Sudah Seleksi</option>
                        </select>
                    </div>
                </div>";
            })
            ->editColumn('status_seleksi', function ($seleksi) {
                return "<div class='col-md-12'>
                    <div class='position-relative'>
                            <select class='form-select select2'  " . ((empty($seleksi->seleksi_status->progress)) ? "disabled" : '') . " onchange='progress($(this))' data-tahap=' " . $seleksi->namatahap_seleksi . " ' data-type='status_seleksi' data-id='" . $seleksi->id_seleksi_lowongan . "'>
                            <option value='0' " . ((isset($seleksi->seleksi_status->status_seleksi) && $seleksi->seleksi_status->status_seleksi == '0') ? "selected" : '') . ">Ditolak</option>
                            <option value='1' " . ((isset($seleksi->seleksi_status->status_seleksi) && $seleksi->seleksi_status->status_seleksi == '1') ? "selected" : '') . ">Diterima</option>
                        </select>
                    </div>
                </div>";
            })
            ->addColumn('action', function ($seleksi) {
                $btn = "<a href='" . url('jadwal-seleksi/lanjutan/detail/{id}') . "' data-id='{$seleksi->id_seleksi_lowongan}' onclick=get($(this)) class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i></a>";
                return $btn;
            })
            ->rawColumns(['status_seleksi', 'action', 'progress', 'start_date',])

            // ->toJson();
            ->make(true);
    }

    public function detail()
    {
        $lowongan = LowonganMagang::all();
        return view('company.jadwal_seleksi.detail_seleksi', compact('lowongan'));
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
        $seleksilowongan = Seleksi::find($id);
        $status = StatusSeleksi::find($seleksilowongan->id_status_seleksi);
        $pendaftaran = PendaftaranMagang::find($status->id_pendaftaran);
        $lowongan = LowonganMagang::find($pendaftaran->id_lowongan);

        $batas_tahap = $lowongan->tahapan_seleksi;

        $tahap = filter_var($request->tahap, FILTER_SANITIZE_NUMBER_INT);

        if ($request->type == 'progress') {
            $status->progress = $request->value;
        } else {
            $status->status_seleksi = 0;
            $status->progress = 0;
            if ($tahap == $batas_tahap) {
                $lowongan->applicant_status = "penawaran";
                $lowongan->save();
                $seleksilowongan->namatahap_seleksi = "penawaran";
            } else if ($request->tahap == 'tahap2') {
                $seleksilowongan->namatahap_seleksi = 'tahap' . $request->value + 2;
            } else {
                $seleksilowongan->namatahap_seleksi = 'tahap' . $request->value + 1;
            }

            $seleksilowongan->save();
        }
        $status->save();
    }
}
