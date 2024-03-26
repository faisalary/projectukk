<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use Dompdf\Dompdf;
use App\Models\Industri;
use App\Models\Mahasiswa;
use App\Models\MhsMagang;
use App\Models\MhsMandiri;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\LowonganMagang;
use App\Models\PengajuanMandiri;
use App\Models\PendaftaranMagang;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\KonfirmasiMagangRequest;

class KonfirmasiMagangController extends Controller
{
    public function __construct()
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd($nim);
        $nim = Auth::user()->nim;

        if ($request->ajax() && $request->type == "navs-pills-justified-magang-fakultas") {

            $pendaftar = PendaftaranMagang::query();
            if ($request->status == "all") {
                $pendaftar->where('nim', $nim);
            } else if ($request->status == "screening") {
                $pendaftar->where('nim', $nim)->get();
                $pendaftar->where('current_step', 'screening');
            } else if ($request->status == "tahap1") {
                $pendaftar->where('nim', $nim)->get();
                $pendaftar->where('current_step', 'tahap1');
            } else if ($request->status == "tahap2") {
                $pendaftar->where('nim', $nim)->get();
                $pendaftar->where('current_step', 'tahap2');
            } else if ($request->status == "tahap3") {
                $pendaftar->where('nim', $nim)->get();
                $pendaftar->where('current_step', 'tahap3');
            } else if ($request->status == "diterima") {
                $pendaftar->where('nim', $nim)->get();
                $pendaftar->where('konfirmasi_status', 1);
            } else if ($request->status == "ditolak") {
                $pendaftar->where('nim', $nim)->get();
                $pendaftar->where('konfirmasi_status', 2);
            } else if ($request->status == "penawaran") {
                $pendaftar->where('nim', $nim)->get();
                $pendaftar->where('konfirmasi_status', 3);
            } else {
                $pendaftar->where('nim', $nim);
            }

            $pendaftar = $pendaftar->with('lowonganMagang')->orderBy('tanggaldaftar', "asc")->get();

            // $pendaftar = PendaftaranMagang::where('nim', $nim)->with('lowonganMagang')->get();
            $card_count = $pendaftar->count() ?? 0;
            $now = Carbon::now();

            $penawaran =  $pendaftar->where('konfirmasi_status', 3);
            $diterima =  $pendaftar->where('konfirmasi_status', 1);
            $ditolak =  $pendaftar->where('konfirmasi_status', 2);

            $pendaftar->transform(function ($pendaftar) {
                $now = Carbon::now();

                if ($now->greaterThan($pendaftar->lowonganMagang->date_confirm_closing)) {
                    if ($pendaftar->where('konfirmasi_status', 3)) {
                        $pendaftar->konfirmasi_status = 2;
                        $pendaftar->current_step = 'ditolak';
                    } elseif ($pendaftar->where('konfirmasi_status', 2)) {
                        $pendaftar->current_step = 'ditolak';
                    } elseif (empty($pendaftar->bukti_doc)) {
                        $pendaftar->konfirmasi_status = 2;
                        $pendaftar->current_step = 'ditolak';
                    }
                }
                $pendaftar->save();

                $industri = Industri::where('id_industri', $pendaftar->lowonganMagang->id_industri)->first();
                $picture = $industri?->image ? url('assets/images/' . $industri->image) : '\assets\images\no-pictures';
                $pendaftar->img = $picture . '.png';

                if ($pendaftar->current_step == "screening") {
                    $pendaftar->step = 'Screening';
                    $pendaftar->color = 'warning';
                } elseif ($pendaftar->current_step == "tahap1") {
                    $pendaftar->step = 'Tahap 1';
                    $pendaftar->color = 'primary';
                } elseif ($pendaftar->current_step == "tahap2") {
                    $pendaftar->step = 'Tahap 2';
                    $pendaftar->color = 'primary';
                } elseif ($pendaftar->current_step == "tahap3") {
                    $pendaftar->step = 'Tahap 3';
                    $pendaftar->color = 'primary';
                } elseif ($pendaftar->konfirmasi_status == 1) {
                    $pendaftar->step = 'Diterima';
                    $pendaftar->color = 'success';
                } elseif ($pendaftar->konfirmasi_status == 2) {
                    $pendaftar->step = 'Ditolak';
                    $pendaftar->color = 'danger';
                } elseif ($pendaftar->konfirmasi_status == 3) {
                    $pendaftar->step = 'Penawaran';
                    $pendaftar->color = 'info';
                }
                // note: 1 = diterima, 2 = ditolak, 3 = penawaran.

                if ($pendaftar->current_step == "screening") {
                    $pendaftar->screening = 'success';
                } elseif ($pendaftar->current_step == "tahap1" || $pendaftar->current_step == "tahap2" || $pendaftar->current_step == "tahap3") {
                    $pendaftar->tahap = 'success';
                } elseif ($pendaftar->current_step == "penawaran" || $pendaftar->konfirmasi_status == 3) {
                } elseif ($pendaftar->current_step == "screening") {
                }

                return $pendaftar;
            });

            if ($card_count == 0) {
                $nothing = '<img src="\assets\images\nothing.svg" alt="no-data" style="display: flex; margin-left: 
                    auto; margin-right: auto; margin-top: 5%; margin-bottom: 5%;  width: 35%;"><div class="sec-title mt-5 mb-4 text-center">
                    <h4>Anda belum mengirim Lamaran Magang</h4>
                </div>';
                return $nothing;
            } else {
                return view('kegiatan_saya.lamaran_saya.fakultas_card', compact('pendaftar', 'card_count', 'penawaran', 'diterima', 'ditolak', 'now'))->render();
            }
        } elseif ($request->ajax() && $request->type == "navs-pills-justified-magang-mandiri") {
            $mandiri = PengajuanMandiri::where("nim", $nim)->get();
            $mahasiswa = Mahasiswa::all();
            $file = MhsMandiri::with('PengajuanMandiri')->get();
            $file = MhsMagang::with('PengajuanMandiri')->get();

            $nim = Mahasiswa::find($nim);
            // $nim = $nim->nim;

            $mandiri_nim = $mandiri->pluck('nim')->toArray();

            $card_count = $mandiri->count() ?? 0;

            if ($card_count == 0) {
                $nothing = '<img src="\assets\images\nothing.svg" alt="no-data" style="display: flex; margin-left: 
                    auto; margin-right: auto; margin-top: 5%; margin-bottom: 5%;  width: 35%;"><div class="sec-title mt-5 mb-4 text-center">
                    <h4>Anda belum mengajukan Surat Pengantar Magang</h4>
                </div>';
                return $nothing;
            } else {
                return view('kegiatan_saya.lamaran_saya.mandiri_card', compact('mandiri', 'mahasiswa', 'file', 'nim', 'mandiri_nim'))->render();
            }
        }

        // $mandiri = PengajuanMandiri::where("nim", $user->nim)->get();
        // $mahasiswa = Mahasiswa::all();
        // $file = MhsMandiri::with('PengajuanMandiri')->get();
        // $file = MhsMagang::with('PengajuanMandiri')->get();

        // $nim = Mahasiswa::find($user->nim);
        // // $nim = $nim->nim;

        // $mandiri_nim = $mandiri->pluck('nim')->toArray();

        $pendaftar = PendaftaranMagang::where('nim', $nim)->get();
        $diterima =  $pendaftar->where('konfirmasi_status', 1);

        $urlGetCard = url('kegiatan-saya/lamaran-saya');

        return view('kegiatan_saya.lamaran_saya.index',  compact('urlGetCard', 'diterima'));
    }

    public function store($request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mandiri = PengajuanMandiri::where('id_pengajuan', $id)->first();
        return $mandiri;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {

            $mandiri = PengajuanMandiri::where('id_pengajuan', $id)->first();

            $mandiri->nim = $request->nim;
            $mandiri->nama_industri = $request->nama_industri;
            $mandiri->posisi_magang = $request->posisi_magang;
            $mandiri->startdate = $request->startdate;
            $mandiri->enddate = $request->enddate;
            if (!empty($request->bukti_doc)) {
                $mandiri->bukti_doc = $request->bukti_doc->store('post');
            }
            $mandiri->status_terima = 1;
            $mandiri->save();

            MhsMandiri::create([
                'id_pengajuan' => $id,
                'status' => true
            ]);

            return response()->json([
                'error' => false,
                'message' => 'Data successfully Updated!',
                'modal' => '#modalDiterima',
                'status_terima' => 1
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function updateDitolak(Request $request, string $id)
    {
        try {

            $mandiri = PengajuanMandiri::where('id_pengajuan', $id)->first();
            if (!empty($request->bukti_doc)) {
                $mandiri->bukti_doc = $request->bukti_doc->store('post');
            }
            $mandiri->status_terima = 2;
            $mandiri->save();

            MhsMagang::create([
                'id_pengajuan' => $id,
                'status' => false
            ]);

            return response()->json([
                'error' => false,
                'message' => 'Data successfully Updated!',
                'modal' => '#modalDitolak',
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
    public function status($id)
    {
    }

    public function porto($file)
    {
        $path = storage_path($file);
        // $pdf = PDF::loadFile(storage_path('file.pdf'));

        // Convert to PDF
        // $dompdf = new Dompdf();
        // $dompdf->loadHtml($path);

        // $dompdf->setPaper('A4', 'portrait');
        // $dompdf->render();

        // Output file
        // return $dompdf->stream($file, [
        //     'Attachment' => true
        // ]);

        return response()->file($path);
    }

    public function detail($id)
    {
        $nim = Auth::user()->nim;
        $now = Carbon::now();

        $pelamar = PendaftaranMagang::where('nim', $nim)->with('lowonganMagang')->get();
        $pendaftar = $pelamar->where('id_lowongan', $id)->first();

        $industri = Industri::where('id_industri', $pendaftar->lowonganMagang->id_industri)->first();
        $picture = $industri?->image ? url('assets/images/' . $industri->image) : '\assets\images\no-pictures';
        $img = $picture . '.png';

        if ($pendaftar->current_step == "screening") {
            $step = 'Screening';
            $color = 'warning';
        } elseif ($pendaftar->current_step == "tahap1") {
            $step = 'Tahap 1';
            $color = 'primary';
        } elseif ($pendaftar->current_step == "tahap2") {
            $step = 'Tahap 2';
            $color = 'primary';
        } elseif ($pendaftar->current_step == "tahap3") {
            $step = 'Tahap 3';
            $color = 'primary';
        } elseif ($pendaftar->konfirmasi_status == 1) {
            $step = 'Diterima';
            $color = 'success';
        } elseif ($pendaftar->konfirmasi_status == 2) {
            $step = 'Ditolak';
            $color = 'danger';
        } elseif ($pendaftar->konfirmasi_status == 3) {
            $step = 'Penawaran';
            $color = 'info';
        }
        // note: 1 = diterima, 2 = ditolak, 3 = penawaran.

        // $pendaftar->transform(function ($item) {



        //     return $item;
        // });

        return view('kegiatan_saya.lamaran_saya.status_lamaran', compact('pendaftar', 'img', 'step', 'color', 'now'));
    }

    public function ambil(Request $request, $nim)
    {
        try {
            $pelamar = PendaftaranMagang::where('nim', $nim)->get();

            $diterima =  $pelamar->where('konfirmasi_status', 1)->all();
            $lowongan = $pelamar->where('id_lowongan', $request->lowongan)->first();

            $count = count($diterima) ?? 0;

            if ($count == 0) {
                $lowongan->konfirmasi_status = 1;
                $lowongan->save();
            }

            return response()->json([
                'error' => false
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function tolak(Request $request, $nim)
    {
        try {
            $pelamar = PendaftaranMagang::where('nim', $nim)->get();

            $lowongan = $pelamar->where('id_lowongan', $request->lowongan)->first();

            $lowongan->konfirmasi_status = 2;
            $lowongan->save();

            return response()->json([
                'error' => false
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function editMulai(string $id)
    {
        $pelamar = PendaftaranMagang::where('id_pendaftaran', $id)->first();
        return $pelamar;
    }

    public function mulai(KonfirmasiMagangRequest $request, $id)
    {
        try {

            $pendaftar = PendaftaranMagang::where('id_pendaftaran', $id)->with('lowonganMagang')->first();

            if (!empty($request->bukti_doc)) {
                $pendaftar->bukti_doc = $request->bukti_doc->store('post');
            }
            $pendaftar->konfirmasi_status = 1;
            $pendaftar->current_step = 'diterima';
            $pendaftar->save();

            MhsMagang::create([
                'id_pendaftaran' => $id,
                'startdate_magang' => $request->mulai,
                'enddate_magang' => $request->akhir
            ]);

            return response()->json([
                'error' => false,
                'message' => 'Data berhasil dibuat!',
                'url' => url('kegiatan-saya/lamaran-saya'),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
