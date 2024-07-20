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
        $this->lamaran_magang = null;
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

        $validSteps = [
            PendaftaranMagangStatusEnum::APRROVED_SELEKSI_TAHAP_1 => 1,
            PendaftaranMagangStatusEnum::APRROVED_SELEKSI_TAHAP_2 => 2,
            PendaftaranMagangStatusEnum::APRROVED_SELEKSI_TAHAP_3 => 3,
        ];

        $penawaran = $this->lamaran_magang->filter(function ($data) use ($validSteps) {

            return isset($validSteps[$data->current_step]) && ($data->tahapan_seleksi + 1) == $validSteps[$data->current_step];
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
                        return $query->where('current_step', PendaftaranMagangStatusEnum::APRROVED_SELEKSI_TAHAP_1);
                    } else if ($request->filter == 'Tahap 2') {
                        return $query->where('current_step', PendaftaranMagangStatusEnum::APRROVED_SELEKSI_TAHAP_2);
                    } else if ($request->filter == 'Tahap 3') {
                        return $query->where('current_step', PendaftaranMagangStatusEnum::APRROVED_SELEKSI_TAHAP_3);
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
            ['title' => '1', 'desc' => 'Pra-seleksi oleh internal', 'active' => false],
            ['title' => '2', 'desc' => 'Screening', 'active' => false],
            ['title' => '3', 'desc' => 'Seleksi', 'active' => false],
            ['title' => '4', 'desc' => 'Penawaran', 'active' => false],
            ['title' => '5', 'desc' => 'Diterima/Ditolak', 'active' => false]
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
            case PendaftaranMagangStatusEnum::APRROVED_SELEKSI_TAHAP_1:
            case PendaftaranMagangStatusEnum::APRROVED_SELEKSI_TAHAP_2:
                $data[2]['active'] = true;
                break;
            case PendaftaranMagangStatusEnum::APRROVED_SELEKSI_TAHAP_3:
                $data[3]['active'] = true;
                break;
            case PendaftaranMagangStatusEnum::REJECTED_BY_DOSWAL:
            case PendaftaranMagangStatusEnum::REJECTED_BY_KAPRODI:
            case PendaftaranMagangStatusEnum::REJECTED_SELEKSI_TAHAP_1:
            case PendaftaranMagangStatusEnum::REJECTED_SELEKSI_TAHAP_2:
            case PendaftaranMagangStatusEnum::REJECTED_SELEKSI_TAHAP_3:
            case PendaftaranMagangStatusEnum::REJECTED_PENAWARAN:
                $data[4]['active'] = true;
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
            $getLabel = PendaftaranMagangStatusEnum::getWithLabel($item->current_step);
            $item->status_badge = '<span class="badge bg-label-' . $getLabel['color'] . ' text-end">' . $getLabel['title'] . '</span>';
            return $item;
        });

        return $this;
    }
}
