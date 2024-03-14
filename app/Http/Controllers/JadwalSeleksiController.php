<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Skill;
use App\Models\Sertif;
use App\Models\Seleksi;
use App\Models\Education;
use App\Models\Mahasiswa;
use App\Models\Experience;
use Illuminate\Http\Request;
use App\Models\email_template;
use App\Models\LowonganMagang;
use App\Models\InformasiPribadi;
use App\Models\PendaftaranMagang;
use App\Models\InformasiTamabahan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Can;
use App\Http\Requests\SeleksiRequest;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Console\View\Components\Alert;

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
        $email = email_template::all();
        return view('company.jadwal_seleksi.tambah', compact('pendaftaran', 'mahasiswa', 'seleksi', 'email', 'lowongan'));
    }

    public function create()
    {
        //
    }

    public function store(SeleksiRequest $request)
    {
        try {

            $pendaftaran = PendaftaranMagang::where('current_step', $request->tahapan_seleksi)->get();
            $pesan = 'Tahap tersebut belum dapat dibuat!';
            $type = "info";
            $icon = "info";
            $title = "Info!";


            if ($pendaftaran != null) {
                foreach ($pendaftaran as $key =>  $value) {

                    list($startDateTime, $endDateTime) = explode(' to ', $request->mulai);
                    $startTimestamp = strtotime(trim($startDateTime));
                    $startDate = date('Y-m-d', $startTimestamp);
                    $startTime = date('H:i', $startTimestamp);
                    $endTimestamp = strtotime(trim($endDateTime));
                    $endDate = date('Y-m-d', $endTimestamp);
                    $endTime = date('H:i', $endTimestamp);
                    $seleksi = Seleksi::create([
                        'id_pendaftaran' => $value->id_pendaftaran,
                        'start_date' => $startDate . " " . $startTime,
                        'end_date' => $endDate . " " . $endTime,
                        'tahapan_seleksi' => $request->tahapan_seleksi,
                        'id_email_tamplate' => $request->subjek,
                        'id_lowongan' => $value->id_lowongan,
                    ]);
                    $pesan = 'Data berhasil dibuat!';
                    $type = "success";
                    $icon = "success";
                    $title = "Succeed!";
                }
            }

            $email = email_template::where('id_email_template', $request->subjek)->first();
            $user = 'Mita Mutiara';
            Mail::to('mitamutiara476@gmail.com')->send(new \App\Mail\EmailJadwalSeleksi($user, $email->subject_email));

            return response()->json([
                'error' => false,
                'message' => $pesan,
                'title' => $title,
                'icon' => $icon,
                'type' => $type,
                'modal' => '#modalTambahJadwal',
                'table' => '.table-jadwal-seleksi'
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
        $pelamar = PendaftaranMagang::where('id_lowongan', $id)->get();

        $seleksi = Seleksi::where('id_lowongan', $id)->with('pendaftar', 'pendaftar.mahasiswa');

        if ($request->type) {
            $seleksi = $seleksi->where('tahapan_seleksi', $request->type)->with('pendaftar', 'pendaftar.mahasiswa');
        }

        // return $seleksi->get();
        return DataTables::of($seleksi->get())
            ->addIndexColumn()
            ->addColumn('start_date', function ($seleksi) {
                $time = '<span class="text-muted">Tanggal Mulai</span> <br> <span>' . Carbon::parse($seleksi->start_date)->format('d F Y') . '</span><br> <span class="text-muted">Tanggal Akhir</span><br> <span>' . Carbon::parse($seleksi->end_date)->format('d F Y') . '</span>';
                return $time;
            })
            // ->editColumn('progress', function ($seleksi) {
            //     return "<div class='col-md-12'>
            //         <div class='position-relative'>
            //                 <select class='form-select select2' onchange='progress($(this))' data-type='progress' data-tahap=' " . $seleksi->pendaftar->current_step . " ' data-id='" . $seleksi->id_seleksi_lowongan . " '>
            //                 <option value='0' " . ((isset($seleksi->seleksi_status->progress) && $seleksi->seleksi_status->progress == '0') ? "selected" : '') . ">Belum Seleksi</option>
            //                 <option value='1' " . ((isset($seleksi->seleksi_status->progress) && $seleksi->seleksi_status->progress == '1') ? "selected" : '') . ">Sudah Seleksi</option>
            //             </select>
            //         </div>
            //     </div>";
            // })
            ->editColumn('status_seleksi', function ($seleksi) {
                $permission = auth()->user()->can('only.mitra');
                $status =
                    "<div class='col-md-12'>
                    <div class='position-relative'>
                            <select class='form-select select2' " . (!$permission ? "disabled" : '') . " onchange='progress($(this))' data-tahap=' " . $seleksi->pendaftar->current_step . " ' data-type='status_seleksi' data-id='" . $seleksi->id_seleksi_lowongan . "' data-placeholder='Pilih Status'>
                            <option value='' disabled selected >Pilih Status</option>
                            <option value='0' " . ((isset($seleksi->pendaftar->status_seleksi) && $seleksi->pendaftar->status_seleksi == '0') ? "selected" : '') . ">Ditolak</option>
                            <option value='1' " . ((isset($seleksi->pendaftar->status_seleksi) && $seleksi->pendaftar->status_seleksi == '1') ? "selected" : '') . ">Diterima</option>
                        </select>
                    </div>
                </div>";
                return $status;
            })
            ->addColumn('action', function ($seleksi) {
                $btn = "<a href='detail/{$seleksi->id_pendaftaran}' data-id='{$seleksi->id_seleksi_lowongan}' onclick=get($(this)) class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i></a>";
                return $btn;
            })
            ->rawColumns(['status_seleksi', 'action', 'start_date',])

            ->make(true);
    }

    public function detail(Request $request, $id)
    {
        $seleksi = Seleksi::where('id_pendaftaran', $id)->first();
        $pendaftar = PendaftaranMagang::where('id_pendaftaran', $seleksi->id_pendaftaran)->with('lowonganMagang', 'mahasiswa', 'mahasiswa.prodi', 'mahasiswa.fakultas', 'mahasiswa.univ')->first();
        $lowongan = LowonganMagang::where('id_lowongan', $pendaftar->id_lowongan)->first();
        $prib = InformasiPribadi::where('nim', $pendaftar->nim)->first();
        $infoTambah = InformasiTamabahan::where('nim', $pendaftar->nim)->get();
        $education = Education::where('nim', $pendaftar->nim)->first();
        $experience = Experience::where('nim', $pendaftar->nim)->get();
        $skills = Skill::where('nim', $pendaftar->nim)->get();
        $sertif = Sertif::where('nim', $pendaftar->nim)->get();
        $picture = $prib?->profile_picture ? url('assets/images/' . $prib->profile_picture) : '\assets\images\no-pictures';
        $img = $picture . '.png';

        // dd($img);

        return view('company.jadwal_seleksi.detail_mahasiswa', compact('pendaftar', 'lowongan', 'prib', 'img', 'education', 'experience', 'skills', 'sertif', 'infoTambah'));
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
        $seleksilowongan = Seleksi::find($id);
        // $status = StatusSeleksi::find($seleksilowongan->id_status_seleksi);
        $pendaftaran = PendaftaranMagang::find($seleksilowongan->id_pendaftaran);
        $lowongan = LowonganMagang::find($pendaftaran->id_lowongan);

        $batas_tahap = $lowongan->tahapan_seleksi;

        $tahap = filter_var($request->tahap, FILTER_SANITIZE_NUMBER_INT);
        // dd($request->tahap);

        if ($request->type == 'status_seleksi') {
            if ($request->value == 0) {
                $pendaftaran->status_seleksi = 0;
            } else {
                $pendaftaran->status_seleksi = null;

                if ($tahap == $batas_tahap) {
                    $pendaftaran->current_step = "penawaran";
                    $pendaftaran->save();
                    $seleksilowongan->tahapan_seleksi = 'tahap ' . $batas_tahap;
                } else if ($request->tahap == 'tahap2') {
                    $pendaftaran->current_step = 'tahap' . $request->value + 2;
                    $seleksilowongan->tahapan_seleksi = 'tahap ' . $request->value + 1;
                } else {
                    $pendaftaran->current_step = 'tahap' . $request->value + 1;
                    $seleksilowongan->tahapan_seleksi = 'tahap ' . $request->value;
                }

                $pendaftaran->save();
                $seleksilowongan->save();
            }
        }
        $pendaftaran->save();

        // if ($request->type == 'progress') {
        //     $status->progress = $request->value;
        // } else {
        //     $status->status_seleksi = 0;
        //     $status->progress = 0;
        //     if ($tahap == $batas_tahap) {
        //         $pendaftaran->current_step = "penawaran";
        //         $pendaftaran->save();
        //         $seleksilowongan->pendaftar->current_step = "penawaran";
        //     } else if ($request->tahap == 'tahap2') {
        //         $seleksilowongan->pendaftar->current_step = 'tahap' . $request->value + 2;
        //     } else {
        //         $seleksilowongan->pendaftar->current_step = 'tahap' . $request->value + 1;
        //     }

        //     $seleksilowongan->save();
        // }
        // $status->save();
    }
}
