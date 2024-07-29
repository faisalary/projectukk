<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Seleksi;
use App\Helpers\Response;
use Illuminate\Http\Request;
use App\Models\LowonganMagang;
use Illuminate\Support\Carbon;
use App\Models\PendaftaranMagang;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SeleksiRequest;
use App\Enums\PendaftaranMagangStatusEnum;

class JadwalSeleksiController extends Controller
{
    public function __construct()
    {
        $this->valid_step = [
            PendaftaranMagangStatusEnum::SELEKSI_TAHAP_1 => 1,
            PendaftaranMagangStatusEnum::APPROVED_SELEKSI_TAHAP_1 => 2,
            PendaftaranMagangStatusEnum::APPROVED_SELEKSI_TAHAP_2 => 3
        ];

        $this->middleware(function ($request, $next) {
            $id = $request->route()->parameters()['id'] ?? null;

            $this->getLowonganMagang(function ($query) use ($id) {
                return $query->where('id_lowongan', $id);
            });

            return $next($request);
        })->only(['detail', 'getDetailData', 'setJadwal']);
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

    public function detail(Request $request, $id)
    {
        $lowongan = $this->lowongan_magang->first();
        $urlGetData = route('jadwal_seleksi.get_data_detail', $id);
        $urlSetJadwal = route('jadwal_seleksi.set_jadwal', ['id' => $id]);

        return view('company.jadwal_seleksi.detail', compact('lowongan', 'urlGetData', 'urlSetJadwal'));
    }

    public function getDetailData(Request $request, $id) {
        $request->validate([
            'tahap' => 'required|in:1,2,3'
        ]);

        $lowongan_ = $this->lowongan_magang->first()->load('seleksi_tahap');

        $this->getPendaftaranMagang(function ($query) use ($id, $request) {
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
        ->addColumn('action', function ($x) {
            $result = '<div class="d-flex justify-content-center">';
            $result .= '<a class="mx-1 cursor-pointer text-primary"><i class="ti ti-file-check"></i></a>';
            $result .= '<a class="mx-1 cursor-pointer text-danger"><i class="ti ti-file-x"></i></a>';
            $result .= '<a class="mx-1 cursor-pointer text-info"><i class="ti ti-file-invoice"></i></a>';
            $result .= '</div>';

            return $result;
        })
        ->rawColumns(['namamhs', 'tanggalpelaksaan', 'action'])
        ->make(true);
    }

    public function setJadwal(Request $request, $id) {
        try {
            $this->getPendaftaranMagang(function ($query) use ($id, $request) {
                return $query->where('pendaftaran_magang.id_lowongan', $id)
                    ->where('current_step', array_search($request->tahapan_seleksi, $this->valid_step));
            });

            $pendaftar = $this->pendaftaran_magang;

            DB::beginTransaction();
            foreach ($pendaftar as $key => $value) {
                Seleksi::updateOrCreate(
                    [
                        'id_pendaftaran' => $value->id_pendaftaran,
                        'tahapan_seleksi' => $request->tahapan_seleksi
                    ],
                    [
                        'start_date' => Carbon::parse($request->mulai_date)->format('Y-m-d H:i:s'),
                        'end_date' => Carbon::parse($request->selesai_date)->format('Y-m-d H:i:s')
                    ]
                );
            }

            DB::commit();
            return Response::success(null, 'Berhasil menetapkan jadwal seleksi!');
        } catch (\Exception $e) {
            DB::rollBack();
            return Response::errorCatch($e);
        }
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
