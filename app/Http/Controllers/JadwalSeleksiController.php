<?php

namespace App\Http\Controllers;

use App\Enums\PendaftaranMagangStatusEnum;
use Exception;
use App\Helpers\Response;
use Illuminate\Http\Request;
use App\Http\Requests\SeleksiRequest;
use App\Models\LowonganMagang;
use App\Models\PendaftaranMagang;

class JadwalSeleksiController extends Controller
{
    public function __construct()
    {
        $this->lowongan_magang = null;
        $this->pendaftaran_magang = null;
    }

    public function index(Request $request)
    {
        return view('company.jadwal_seleksi.jadwal');
    }

    public function getData(Request $request) {
        $lowongan = $this->getLowonganMagang()->lowongan_magang;

        return datatables()->of($lowongan)
        ->addColumn('card', function ($data) {
            $result = 
            '<div class="card border cursor-pointer" onclick="window.location.href=`' . route('jadwal_seleksi.detail', $data->id_lowongan) . '`">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex justify-content-start">
                            <div class="rounded-circle text-center" style="overflow: hidden; width: 70px; height: 70px;">
                                <img src="' . asset('app-assets/img/avatars/user.png') . '" alt="user-avatar" class="d-block" width="70" id="image_industri" data-default-src="' . asset('app-assets/img/avatars/user.png') . '">
                            </div>
                            <div class="d-flex flex-column justify-content-center ms-3">
                                <h4 class="mb-1">Fullstack Developer</h4>
                                <span>IT Computer Software</span>
                            </div>
                        </div>
                        <div>
                            <span class="badge bg-label-primary">Status</span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between border-bottom pb-4 mt-4">
                        <div class="d-flex justify-content-start">
                            <span class="badge badge-center rounded-pill bg-label-primary" style="padding: 1.5rem;">
                                <i class="ti ti-users" style="font-size: 15pt"></i>
                            </span>
                            <div class="d-flex flex-column justify-content-start ms-2">
                                <span>Total Kandidat</span>
                                <h5 class="text-primary">0</h5>
                            </div>
                        </div>';

            for ($i = 1; $i <= ($data->tahapan_seleksi + 1) ; $i++) {
                $result .= 
                '<div class="d-flex justify-content-start">
                    <span class="badge badge-center rounded-pill bg-label-primary" style="padding: 1.5rem;">
                        <i class="ti ti-file-report" style="font-size: 15pt"></i>
                    </span>
                    <div class="d-flex flex-column justify-content-start ms-2">
                        <span>Seleksi Tahap ' . $i . '</span>
                        <h5 class="text-primary">0</h5>
                    </div>
                </div>';
            }

            $result .= '</div>';
            $result .= '<div class="d-flex justify-content-start mt-3">
                <div class="d-flex justify-content-start align-items-center">
                    <i class="ti ti-calendar"></i>
                    <span class="ms-3">30 Juli 2023 - 30 Juni 2024</span>
                </div>
                <div class="ms-4 d-flex justify-content-start align-items-center">
                    <i class="ti ti-users"></i>
                    <span class="ms-3">Kuota Penerimaan: 50</span>
                </div>
            </div>';

            $result .= '</div></div>';
            return $result;
        })
        ->rawColumns(['card'])
        ->make(true);
    }

    public function detail($id)
    {
        $this->getLowonganMagang(function ($query) use ($id) {
            return $query->where('id_lowongan', $id);
        });

        $lowongan = $this->lowongan_magang->first();
        $urlGetData = route('jadwal_seleksi.get_data_detail', $id);

        return view('company.jadwal_seleksi.detail', compact('lowongan', 'urlGetData'));
    }

    public function getDetailData(Request $request, $id) {
        $request->validate([
            'tahap' => 'required|in:1,2,3'
        ]);

        $this->getLowonganMagang(function ($query) use ($id) {
            return $query->where('id_lowongan', $id);
        });

        $lowongan_ = $this->lowongan_magang->first();

        $this->getPendaftaranMagang(function ($query) use ($id, $request, $lowongan_) {
            $query = $query->join('mahasiswa', 'mahasiswa.nim', '=', 'pendaftaran_magang.nim')
            ->where('pendaftaran_magang.id_lowongan', $id);
            for ($i=1; $i <= ($lowongan_->tahapan_seleksi+1); $i++) {
                if ($request->tahap == $i) $query = $query->where('current_step', constant('App\Enums\PendaftaranMagangStatusEnum::SELEKSI_TAHAP_' . $i));
            }

            return $query;
        });
        $pendaftaran_magang = $this->pendaftaran_magang->transform(function ($item) use ($lowongan_, $request) {
            $item->seleksi = $lowongan_->load('seleksi_tahap')->seleksi_tahap->where('tahap', $request->tahap)->first();
            return $item;
        });

        return datatables()->of($pendaftaran_magang)
        ->addIndexColumn()
        ->editColumn('namamhs', function ($x) {
            $result = '<div class="d-flex flex-column align-items-start">';
            $result .= '<span class="fw-bolder">' .$x->namamhs. '</span>';
            $result .= '<span>' .$x->nim. '</span>';
            $result .= '</div>';

            return $result;
        })
        ->addColumn('tanggalpelaksaan', function ($x) {
            $result = '<div class="d-flex flex-column justify-content-start">';
            $result .= '<span class="text-muted">Tanggal Mulai</span>';
            $result .= '<span>' .$x->seleksi->tgl_mulai. '</span>';
            $result .= '<span class="text-muted">Tanggal Akhir</span>';
            $result .= '<span>' .$x->seleksi->tgl_akhir. '</span>';
            $result .= '</div>';

            return $result;
        })
        ->editColumn('status', function ($x) {
            $result = '<select class="select2 form-select" id="status_select">';
            $result .= '<option value="not_yet">Belum Seleksi</option>';
            $result .= '<option value="approved">Diterima</option>';
            $result .= '<option value="rejected">Ditolak</option>';
            $result .= '</select>';

            return $result;
        })
        ->addColumn('action', function ($x) {
            $result = '<div class="d-flex justify-content-center">';
            $result .= '<a class="cursor-pointer text-primary"><i class="ti ti-file-invoice"></i></a>';
            $result .= '</div>';

            return $result;
        })
        ->rawColumns(['namamhs', 'tanggalpelaksaan', 'status', 'action'])
        ->make(true);
    }

    private function getLowonganMagang($additional = null) {
        $user = auth()->user();
        $pegawaiIndustri = $user->pegawai_industri;

        $this->lowongan_magang = LowonganMagang::where('id_industri', $pegawaiIndustri->id_industri);
        if ($additional != null) $this->lowongan_magang = $additional($this->lowongan_magang);
        $this->lowongan_magang = $this->lowongan_magang->get();
        return $this;
    }

    private function getPendaftaranMagang($addition = null) {
        $user = auth()->user();
        $pegawaiIndustri = $user->pegawai_industri;

        $this->pendaftaran_magang = PendaftaranMagang::join('lowongan_magang', 'lowongan_magang.id_lowongan', '=', 'pendaftaran_magang.id_lowongan')
        ->where('lowongan_magang.id_industri', $pegawaiIndustri->id_industri);

        if ($addition != null) $this->pendaftaran_magang = $addition($this->pendaftaran_magang);

        $this->pendaftaran_magang = $this->pendaftaran_magang->get();
        return $this;
    }
}
