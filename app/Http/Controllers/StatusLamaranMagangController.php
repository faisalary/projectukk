<?php

namespace App\Http\Controllers;

use App\Models\Industri;
use App\Helpers\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\PendaftaranMagang;
use App\Enums\PendaftaranMagangStatusEnum;
use App\Enums\PendaftaranMagangStatusStepEnum;

class StatusLamaranMagangController extends Controller
{
    public function __construct(){
        $this->valid_step = [
            PendaftaranMagangStatusEnum::SELEKSI_TAHAP_1 => 0,
            PendaftaranMagangStatusEnum::APPROVED_SELEKSI_TAHAP_1 => 1,
            PendaftaranMagangStatusEnum::APPROVED_SELEKSI_TAHAP_2 => 2,
            PendaftaranMagangStatusEnum::APPROVED_SELEKSI_TAHAP_3 => 3,
            PendaftaranMagangStatusEnum::APPROVED_PENAWARAN => 4
        ];
        $this->rejected_step = [
            PendaftaranMagangStatusEnum::REJECTED_SCREENING => 0,
            PendaftaranMagangStatusEnum::REJECTED_SELEKSI_TAHAP_1 => 1,
            PendaftaranMagangStatusEnum::REJECTED_SELEKSI_TAHAP_2 => 2,
            PendaftaranMagangStatusEnum::REJECTED_SELEKSI_TAHAP_3 => 3,
            PendaftaranMagangStatusEnum::REJECTED_PENAWARAN => 4,
        ];
    }

    public function index(Request $request) {

        if ($request->ajax()) {
            return self::getDataCard($request);
        }

        $this->getDataLamaran()->setUpBadgeDataLamaran();

        $proses_seleksi = $this->lamaran_magang->whereIn('current_step',
            array_diff(PendaftaranMagangStatusEnum::getConstants(), [
                'rejected_by_doswal', 'rejected_by_kaprodi', 'rejected_seleksi_tahap_1', 'rejected_seleksi_tahap_2',
                'rejected_seleksi_tahap_3', 'rejected_penawaran'
            ])
        );

        $penawaran = $this->lamaran_magang->filter(function ($data) {
            return isset($this->valid_step[$data->current_step]) && ($data->tahapan_seleksi + 1) == $this->valid_step[$data->current_step];
        });

        $approved = $this->lamaran_magang->where('current_step', PendaftaranMagangStatusEnum::APPROVED_PENAWARAN);

        $rejected = [
            PendaftaranMagangStatusEnum::REJECTED_BY_DOSWAL,
            PendaftaranMagangStatusEnum::REJECTED_BY_KAPRODI,
            PendaftaranMagangStatusEnum::REJECTED_SELEKSI_TAHAP_1,
            PendaftaranMagangStatusEnum::REJECTED_SELEKSI_TAHAP_2,
            PendaftaranMagangStatusEnum::REJECTED_SELEKSI_TAHAP_3,
            PendaftaranMagangStatusEnum::REJECTED_PENAWARAN,
        ];

        $rejected = $this->lamaran_magang->filter(function ($data) use ($rejected) {

            return in_array($data->current_step, $rejected);
        });

        return view('kegiatan_saya/lamaran_saya/index', compact('proses_seleksi', 'penawaran', 'approved', 'rejected'));
    }

    public function tolakLamaran(Request $request) {
        $mahasiswa = auth()->user()->mahasiswa;

        $id_lowongan = $request->lowongan;
        $nim = $request->nim;
        $pendaftaran = PendaftaranMagang::where('id_lowongan', $id_lowongan)->where('nim', $nim)->first();

        if (!$pendaftaran) {
            return Response::error([
                'status' => 'error',
                'message' => 'Data tidak ditemukan'
            ], 'Gagal');
        }

        $pendaftaran->current_step = PendaftaranMagangStatusEnum::REJECTED_PENAWARAN;
        $pendaftaran->save();

        return Response::success([
            'status' => 'success',
            'message' => 'Berhasil menolak lamaran'
        ], 'Successed');
    }

    public function detail($id) {
        $mahasiswa = auth()->user()->mahasiswa;

        $pelamar = $this->getDataLamaran(function ($query) use ($id) {
            return $query->where('pendaftaran_magang.id_pendaftaran', $id);
        })->setUpStepStatusLamaran()->setUpBadgeDataLamaran()->lamaran_magang->first();

        $pelamar->lowongan_tersedia = ($pelamar->enddate > Carbon::now()) ? true : false;

        return view('kegiatan_saya.lamaran_saya.detail', compact('pelamar'));
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
                        return $query;
                    }
                })->setUpBadgeDataLamaran()->lamaran_magang;

                return Response::success([
                    'view' => view('kegiatan_saya.lamaran_saya.components.proses_seleksi', compact('proses_seleksi'))->render()
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
                $data[0]['active'] = true;
                break;
            case PendaftaranMagangStatusEnum::APPROVED_BY_KAPRODI:
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
