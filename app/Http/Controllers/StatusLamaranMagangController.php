<?php

namespace App\Http\Controllers;

use App\Models\Industri;
use App\Helpers\Response;
use App\Models\MhsMagang;
use Illuminate\Http\Request;
use App\Models\LowonganMagang;
use Illuminate\Support\Carbon;
use App\Models\PendaftaranMagang;
use Illuminate\Support\Facades\DB;
use App\Enums\PendaftaranMagangStatusEnum;
use App\Enums\PendaftaranMagangStatusStepEnum;

class StatusLamaranMagangController extends Controller
{
    public function __construct(){
        $this->valid_step = [
            PendaftaranMagangStatusEnum::APPROVED_BY_DOSWAL => 0,
            PendaftaranMagangStatusEnum::APPROVED_BY_KAPRODI => 0,
            PendaftaranMagangStatusEnum::SELEKSI_TAHAP_1 => 0,
            PendaftaranMagangStatusEnum::APPROVED_SELEKSI_TAHAP_1 => 1,
            PendaftaranMagangStatusEnum::APPROVED_SELEKSI_TAHAP_2 => 2,
            PendaftaranMagangStatusEnum::APPROVED_SELEKSI_TAHAP_3 => 3,
            PendaftaranMagangStatusEnum::APPROVED_PENAWARAN => 4
        ];

        $this->rejected_step = [
            PendaftaranMagangStatusEnum::REJECTED_BY_DOSWAL,
            PendaftaranMagangStatusEnum::REJECTED_BY_KAPRODI,
            PendaftaranMagangStatusEnum::REJECTED_SCREENING,
            PendaftaranMagangStatusEnum::REJECTED_SELEKSI_TAHAP_1,
            PendaftaranMagangStatusEnum::REJECTED_SELEKSI_TAHAP_2,
            PendaftaranMagangStatusEnum::REJECTED_SELEKSI_TAHAP_3,
            PendaftaranMagangStatusEnum::REJECTED_PENAWARAN
        ];
    }

    public function index(Request $request) {

        if ($request->ajax()) {
            return self::getDataCard($request);
        }

        $this->getDataLamaran()->setUpBadgeDataLamaran();

        $proses_seleksi = [];
        $penawaran = [];
        $approved = [];
        $rejected = [];

        foreach ($this->lamaran_magang as $key => $value) {
            if (isset($this->valid_step[$value->current_step]) && ($value->tahapan_seleksi + 1) > $this->valid_step[$value->current_step]) {
                $proses_seleksi[] = $value;
            } else if (isset($this->valid_step[$value->current_step]) && ($value->tahapan_seleksi + 1) == $this->valid_step[$value->current_step]) {
                $penawaran[] = $value;
            } else if ($value->current_step == PendaftaranMagangStatusEnum::APPROVED_PENAWARAN) {
                $approved[] = $value;
            } else if (in_array($value->current_step, $this->rejected_step)) {
                $rejected[] = $value;
            }
        }

        $proses_seleksi = collect($proses_seleksi);
        $penawaran = collect($penawaran);
        $approved = collect($approved);
        $rejected = collect($rejected);

        return view('kegiatan_saya/lamaran_saya/index', compact('proses_seleksi', 'penawaran', 'approved', 'rejected'));
    }

    public function approvalPenawaran(Request $request, $id) {
        $request->validate([
            'status' => 'required|in:approved,rejected' 
        ]);

        try {
            $this->getDataLamaran(function ($query) use ($id) {
                return $query->where('pendaftaran_magang.id_pendaftaran', $id);
            });
    
            $pendaftaran = $this->lamaran_magang->first();
    
            if (!$pendaftaran) {
                return Response::error(null, 'Pendaftaran Not Found.');
            }
    
            DB::beginTransaction();
            $pendaftaran->current_step = ($request->status == 'approved') ? PendaftaranMagangStatusEnum::APPROVED_PENAWARAN : PendaftaranMagangStatusEnum::REJECTED_PENAWARAN;
            $pendaftaran->save();

            if ($request->status == 'approved') {
                MhsMagang::create(['id_pendaftaran' => $pendaftaran->id_pendaftaran]);
            }

            DB::commit();
            return Response::success(null, 'Success');
        } catch (\Exception $e) {
            DB::rollBack();
            return Response::errorCatch($e);
        }
    }

    public function detail($id) {
        $mahasiswa = auth()->user()->mahasiswa;

        $pelamar = $this->getDataLamaran(function ($query) use ($id) {
            return $query->where('pendaftaran_magang.id_pendaftaran', $id);
        })->setUpStepStatusLamaran()->setUpBadgeDataLamaran()->lamaran_magang->first();

        $pelamar->lowongan_tersedia = ($pelamar->enddate > Carbon::now()) ? true : false;

        return view('kegiatan_saya.lamaran_saya.detail', compact('pelamar'));
    }

    public function detailLowongan($id) {
        $pendaftar = PendaftaranMagang::where('id_pendaftaran', $id)->first();
        $lowongan = LowonganMagang::select(
            'id_lowongan', 'intern_position', 'industri.namaindustri', 'industri.image', 'industri.description as deskripsi_industri',
            'pelaksanaan', 'durasimagang', 'lokasi', 'nominal_salary', 'created_at', 'jenjang', 'kuota',
            'gender', 'statusaprove', 'keterampilan', 'deskripsi', 'requirements', 'benefitmagang',
            'tahapan_seleksi'
        )
        ->join('industri', 'industri.id_industri', '=', 'lowongan_magang.id_industri')
        ->where('id_lowongan', $pendaftar->id_lowongan)->first()->dataTambahan('program_studi');
        if (!$lowongan) abort(404);

        $urlBack = route('lamaran_saya.detail', $id);
        return view('kegiatan_saya/lamaran_saya/detail_lowongan', compact('lowongan', 'urlBack'));
    }

    private function getDataLamaran($additionalBeforeGet = null)
    {
        $user = auth()->user();
        $mahasiswa = $user->mahasiswa;
        $this->lamaran_magang = PendaftaranMagang::join('lowongan_magang', 'lowongan_magang.id_lowongan', '=', 'pendaftaran_magang.id_lowongan')
        ->join('industri', 'industri.id_industri', '=', 'lowongan_magang.id_industri')
        ->where('nim', $mahasiswa->nim);

        if ($additionalBeforeGet != null) $this->lamaran_magang = $additionalBeforeGet($this->lamaran_magang);

        $this->lamaran_magang = $this->lamaran_magang->get();
        return $this;
    }

    private function getDataCard(Request $request) {
        switch ($request->component) {
            case 'proses-seleksi':
                $proses_seleksi = $this->getDataLamaran(function ($query) use ($request) {
                    if ($request->filter == 'Pending') {
                        return $query->whereIn('current_step', [
                            PendaftaranMagangStatusEnum::PENDING,
                            PendaftaranMagangStatusEnum::APPROVED_BY_DOSWAL
                        ]);
                    } else if ($request->filter == 'Screening') {
                        return $query->where('current_step', PendaftaranMagangStatusEnum::APPROVED_BY_KAPRODI);
                    } else if ($request->filter == 'Tahap 1') {
                        return $query->where('current_step', PendaftaranMagangStatusEnum::SELEKSI_TAHAP_1);
                    } else if ($request->filter == 'Tahap 2') {
                        return $query->where('current_step', PendaftaranMagangStatusEnum::APPROVED_SELEKSI_TAHAP_1);
                    } else if ($request->filter == 'Tahap 3') {
                        return $query->where('current_step', PendaftaranMagangStatusEnum::APPROVED_SELEKSI_TAHAP_2);
                    } else {
                        return $query->whereIn('current_step', [
                            PendaftaranMagangStatusEnum::APPROVED_BY_DOSWAL,
                            PendaftaranMagangStatusEnum::APPROVED_BY_KAPRODI,
                            PendaftaranMagangStatusEnum::SELEKSI_TAHAP_1,
                            PendaftaranMagangStatusEnum::APPROVED_SELEKSI_TAHAP_1,
                            PendaftaranMagangStatusEnum::APPROVED_SELEKSI_TAHAP_2,
                            PendaftaranMagangStatusEnum::APPROVED_SELEKSI_TAHAP_3
                        ]);
                    }
                })->setUpBadgeDataLamaran()->lamaran_magang->filter(function ($value) use ($request) {
                    if (!in_array($request->filter, ['Pending', 'Screening'])) {
                        return isset($this->valid_step[$value->current_step]) && ($value->tahapan_seleksi + 1) > $this->valid_step[$value->current_step];
                    }
                    return true;
                });

                return Response::success([
                    'view' => view('kegiatan_saya.lamaran_saya.components.proses_seleksi', compact('proses_seleksi'))->render()
                ], 'Successed');
                break;
            case 'penawaran':
                $penawaran = $this->getDataLamaran(function ($query) {
                    return $query->whereIn('current_step', [
                        PendaftaranMagangStatusEnum::APPROVED_SELEKSI_TAHAP_1,
                        PendaftaranMagangStatusEnum::APPROVED_SELEKSI_TAHAP_2,
                        PendaftaranMagangStatusEnum::APPROVED_SELEKSI_TAHAP_3,
                    ]);
                })->setUpBadgeDataLamaran()->lamaran_magang->filter(function ($value) {
                    return isset($this->valid_step[$value->current_step]) && ($value->tahapan_seleksi + 1) == $this->valid_step[$value->current_step];
                });
                
                return Response::success([
                    'view' => view('kegiatan_saya.lamaran_saya.components.penawaran', compact('penawaran'))->render()
                ], 'Successed');
                break;
            case 'diterima':
                $approved = $this->getDataLamaran(function ($query) {
                    return $query->where('current_step', PendaftaranMagangStatusEnum::APPROVED_PENAWARAN);
                })->setUpBadgeDataLamaran()->lamaran_magang;
                
                return Response::success([
                    'view' => view('kegiatan_saya.lamaran_saya.components.diterima', compact('approved'))->render()
                ], 'Successed');
                break;
            case 'ditolak':
                $rejected = $this->getDataLamaran(function ($query) {
                    return $query->whereIn('current_step', $this->rejected_step);
                })->setUpBadgeDataLamaran()->lamaran_magang;
                
                return Response::success([
                    'view' => view('kegiatan_saya.lamaran_saya.components.ditolak', compact('rejected'))->render()
                ], 'Successed');
                break;

            default:
                # code...
                break;
        }
    }

    private function setUpStepStatusLamaran()
    {
        $data = [
            ['title' => '1', 'desc' => 'Pra-seleksi oleh internal', 'active' => false, 'isReject' => false],
            ['title' => '2', 'desc' => 'Screening', 'active' => false, 'isReject' => false],
            ['title' => '3', 'desc' => 'Seleksi', 'active' => false, 'isReject' => false],
            ['title' => '4', 'desc' => 'Penawaran', 'active' => false, 'isReject' => false],
            ['title' => '5', 'desc' => 'Diterima/Ditolak', 'active' => false, 'isReject' => false],
        ];

        switch ($this->lamaran_magang[0]->current_step) {
            case PendaftaranMagangStatusEnum::PENDING:
            case PendaftaranMagangStatusEnum::APPROVED_BY_DOSWAL:
                case PendaftaranMagangStatusEnum::APPROVED_BY_KAPRODI:
                $data[0]['active'] = true;
                break;
            case PendaftaranMagangStatusEnum::APPROVED_BY_LKM:
                $data[1]['active'] = true;
                break;
            case PendaftaranMagangStatusEnum::SELEKSI_TAHAP_1:
            case PendaftaranMagangStatusEnum::APPROVED_SELEKSI_TAHAP_1:
            case PendaftaranMagangStatusEnum::APPROVED_SELEKSI_TAHAP_2:
            case PendaftaranMagangStatusEnum::APPROVED_SELEKSI_TAHAP_3:
                if ($this->lamaran_magang[0]->current_step == array_search(($this->lamaran_magang[0]->tahapan_seleksi + 1), $this->valid_step)) {
                    $data[3]['active'] = true;
                } else {
                    $data[2]['active'] = true;
                }
                break;
            case PendaftaranMagangStatusEnum::APPROVED_PENAWARAN:
                $data[4]['active'] = true;
                break;
            case PendaftaranMagangStatusEnum::REJECTED_BY_DOSWAL:
            case PendaftaranMagangStatusEnum::REJECTED_BY_KAPRODI:
            case PendaftaranMagangStatusEnum::REJECTED_BY_LKM:
                $data[0]['active'] = true;
                $data[0]['isReject'] = true;
                break;
            case PendaftaranMagangStatusEnum::REJECTED_SCREENING:
                $data[1]['active'] = true;
                $data[1]['isReject'] = true;
                break;
            case PendaftaranMagangStatusEnum::REJECTED_SELEKSI_TAHAP_1:
            case PendaftaranMagangStatusEnum::REJECTED_SELEKSI_TAHAP_2:
            case PendaftaranMagangStatusEnum::REJECTED_SELEKSI_TAHAP_3:
                $data[2]['active'] = true;
                $data[2]['isReject'] = true;
                break;
            case PendaftaranMagangStatusEnum::REJECTED_PENAWARAN:
                $data[4]['active'] = true;
                $data[4]['isReject'] = true;
            break;
            default:
                # code...
                break;
        }

        $this->lamaran_magang[0]->step_status = view('kegiatan_saya/lamaran_saya/components/step_status', ['data' => $data])->render();
        return $this;
    }

    private function setUpBadgeDataLamaran() {

        $this->lamaran_magang->transform(function ($item) {
            if ($item->current_step == array_search(($item->tahapan_seleksi + 1), $this->valid_step)) {
                $getLabel = ['title' => 'Penawaran', 'color' => 'info'];
            } else {
                $getLabel = PendaftaranMagangStatusEnum::getWithLabel($item->current_step);
            }

            $item->status_badge = '<span class="badge bg-label-' . $getLabel['color'] . ' text-end">' . $getLabel['title'] . '</span>';
            return $item;
        });

        return $this;
    }
}
