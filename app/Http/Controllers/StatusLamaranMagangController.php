<?php

namespace App\Http\Controllers;

use App\Models\Industri;
use App\Helpers\Response;
use Illuminate\Http\Request;
use App\Models\PendaftaranMagang;
use App\Enums\PendaftaranMagangStatusEnum;

class StatusLamaranMagangController extends Controller
{
    public function __construct(){
        $this->lamaran_magang = null;
    }

    public function index(Request $request) {

        if ($request->ajax()) {
            return self::getDataCard($request);
        }

        $lamaran_magang = $this->getDataProsesSeleksi()->setUpBadgeProsesSeleksi()->lamaran_magang;
        return view('kegiatan_saya/lamaran_saya/index', compact('lamaran_magang'));
    }

    public function detail($id) {
        $mahasiswa = auth()->user()->mahasiswa;

        $pelamar = $this->getDataProsesSeleksi(function ($query) use ($id) {
            return $query->where('pendaftaran_magang.id_pendaftaran', $id);
        })->setUpStepStatusLamaran()->setUpBadgeProsesSeleksi()->lamaran_magang->first();

        return view('kegiatan_saya.lamaran_saya.detail', compact('pelamar'));
    }

    private function getDataProsesSeleksi($additionalBeforeGet = null) 
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
                $lamaran_magang = $this->getDataProsesSeleksi(function ($query) use ($request) {
                    if ($request->filter == 'Pending') {
                        return $query->where('current_step', PendaftaranMagangStatusEnum::PENDING)
                        ->orWhere('current_step', PendaftaranMagangStatusEnum::APPROVED_BY_DOSWAL)
                        ->orWhere('current_step', PendaftaranMagangStatusEnum::APPROVED_BY_KAPRODI);
                    } else if ($request->filter == 'Screening') {
                        return $query->where('current_step', PendaftaranMagangStatusEnum::SCREENING);
                    } else if ($request->filter == 'Tahap 1') {
                        return $query->where('current_step', PendaftaranMagangStatusEnum::SELEKSI_TAHAP_1);
                    } else if ($request->filter == 'Tahap 2') {
                        return $query->where('current_step', PendaftaranMagangStatusEnum::SELEKSI_TAHAP_2);
                    } else if ($request->filter == 'Tahap 3') {
                        return $query->where('current_step', PendaftaranMagangStatusEnum::SELEKSI_TAHAP_3);
                    } else {
                        return $query;
                    }
                })->setUpBadgeProsesSeleksi()->lamaran_magang;

                return Response::success([
                    'view' => view('kegiatan_saya.lamaran_saya.components.proses_seleksi', compact('lamaran_magang'))->render()
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
            ['title' => '1', 'active' => false],
            ['title' => '2', 'active' => false],
            ['title' => '3', 'active' => false],
            ['title' => '4', 'active' => false],
            ['title' => '5', 'active' => false]
        ];

        switch ($this->lamaran_magang[0]->current_step) {
            case PendaftaranMagangStatusEnum::PENDING:
            case PendaftaranMagangStatusEnum::APPROVED_BY_DOSWAL:
            case PendaftaranMagangStatusEnum::APPROVED_BY_KAPRODI:
            case PendaftaranMagangStatusEnum::REJECTED_BY_DOSWAL:
            case PendaftaranMagangStatusEnum::REJECTED_BY_KAPRODI:
                $data[0]['active'] = true;
                break;
            case PendaftaranMagangStatusEnum::SCREENING:
                $data[1]['active'] = true;
                break;
            case PendaftaranMagangStatusEnum::SELEKSI_TAHAP_1:
            case PendaftaranMagangStatusEnum::SELEKSI_TAHAP_2:
            case PendaftaranMagangStatusEnum::SELEKSI_TAHAP_3:
            case PendaftaranMagangStatusEnum::APPROVED_BY_COMPANY:
            case PendaftaranMagangStatusEnum::REJECTED_BY_COMPANY:
                $data[2]['active'] = true;
                break;
            case PendaftaranMagangStatusEnum::PENAWARAN:
                $data[3]['active'] = true;
                break;
            case PendaftaranMagangStatusEnum::APPROVED_BY_MAHASISWA:
            case PendaftaranMagangStatusEnum::REJECTED_BY_MAHASISWA:
                $data[4]['active'] = true;
                break;
            default:
                # code...
                break;
        }

        $this->lamaran_magang[0]->step_status = view('kegiatan_saya/lamaran_saya/components/step_status', ['data' => $data])->render();
        return $this;
    }

    private function setUpBadgeProsesSeleksi() {
        $this->lamaran_magang->transform(function ($item) {
            switch ($item->current_step) {
                case PendaftaranMagangStatusEnum::PENDING:
                case PendaftaranMagangStatusEnum::APPROVED_BY_DOSWAL:
                case PendaftaranMagangStatusEnum::APPROVED_BY_KAPRODI:
                    $item->status_badge = '<span class="badge bg-label-warning text-end">Pending</span>';
                    break;
                case PendaftaranMagangStatusEnum::REJECTED_BY_DOSWAL:
                case PendaftaranMagangStatusEnum::REJECTED_BY_KAPRODI:
                    $item->status_badge = '<span class="badge bg-label-danger text-end">Rejected</span>';
                    break;
                case PendaftaranMagangStatusEnum::SCREENING:
                    $item->status_badge = '<span class="badge bg-label-info text-end">Screening</span>';
                    break;
                case PendaftaranMagangStatusEnum::SELEKSI_TAHAP_1:
                    $item->status_badge = '<span class="badge bg-label-primary text-end">Seleksi Tahap 1</span>';
                    break;
                case PendaftaranMagangStatusEnum::SELEKSI_TAHAP_2:
                    $item->status_badge = '<span class="badge bg-label-primary text-end">Seleksi Tahap 2</span>';
                    break;
                case PendaftaranMagangStatusEnum::SELEKSI_TAHAP_3:
                    $item->status_badge = '<span class="badge bg-label-primary text-end">Seleksi Tahap 3</span>';
                    break;
                default:
                    break;
            }
            return $item;
        });

        return $this;
    }
}
