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

        $this->valid_step = [
            PendaftaranMagangStatusEnum::SELEKSI_TAHAP_1 => 1,
            PendaftaranMagangStatusEnum::APRROVED_SELEKSI_TAHAP_1 => 2,
            PendaftaranMagangStatusEnum::APRROVED_SELEKSI_TAHAP_2 => 3
        ];
    }

    public function index(Request $request)
    {
        return view('company.jadwal_seleksi.jadwal');
    }

    public function getData(Request $request) {

        $lowongan = $this->getLowonganMagang(function ($query) {
            return $query->with('total_pelamar');
        })->lowongan_magang->map(function ($item) {
            $item->total_kandidat = $item->total_pelamar->count();

            for ($i=1; $i <= ($item->tahapan_seleksi + 1); $i++) { 
                $item->{'seleksi_tahap_' . $i} = $item->total_pelamar->filter(function ($data) use ($i) {
                    return isset($this->valid_step[$data->current_step]) && $i == $this->valid_step[$data->current_step];
                })->count();
            }

            return $item;
        });

        return datatables()->of($lowongan)
        ->addColumn('card', function ($data) {
            $result = view('company/jadwal_seleksi/components/card_list_lowongan', compact('data'))->render();
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

        $lowongan_ = $this->lowongan_magang->first()->load('seleksi_tahap');

        $this->getPendaftaranMagang(function ($query) use ($id, $request, $lowongan_) {
            $query = $query->join('mahasiswa', 'mahasiswa.nim', '=', 'pendaftaran_magang.nim')
            ->where('pendaftaran_magang.id_lowongan', $id);

            if ($request->tahap) $query = $query->where('current_step', array_search($request->tahap, $this->valid_step));

            return $query;
        });
        $pendaftaran_magang = $this->pendaftaran_magang->transform(function ($item) use ($lowongan_, $request) {
            $item->seleksi = $lowongan_->seleksi_tahap->where('tahap', $request->tahap)->first();
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
