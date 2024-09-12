<?php

namespace App\Http\Controllers\DataMahasiswaMagang;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Enums\PendaftaranMagangStatusEnum;

class DataMahasiswaMagangDosenController extends DataMahasiswaMagangController
{

    public function __construct()
    {
        parent::__construct();

        $this->middleware(function ( $request, $next ) {
            $user = auth()->user();
            if (!$user->can('permission:data_mahasiswa_magang_dosen.view') && count($user->dosen->mahasiswaDiampu) == 0) {
                abort(403);
            }

            return $next($request);
        })->only(['index', 'getData']);
    }

    public function index() {
        $view = $this->getViewDesign();

        return view('data_mahasiswa_magang.index', compact('view'));
    }

    public function getData(Request $request) {
        $user = auth()->user();
        $dosen = $user->dosen;

        if ($request->type == 'diterima') {
            $this->getPendaftaranMagang(function ($query) use ($dosen) {
                return $query->where('mahasiswa.kode_dosen', $dosen->kode_dosen)
                    ->where('pendaftaran_magang.current_step', PendaftaranMagangStatusEnum::APPROVED_PENAWARAN);
            });
        } else if ($request->type == 'belum_magang') {
            $this->getPendaftaranMagang(function ($query) use ($dosen) {
                return $query->where('mahasiswa.kode_dosen', $dosen->kode_dosen)
                    ->where('pendaftaran_magang.current_step', '!=', PendaftaranMagangStatusEnum::APPROVED_PENAWARAN);
            });
        }

        $datatables = datatables()->of($this->pendaftaran_magang)
        ->addIndexColumn()
        ->editColumn('namamhs', function ($data) {
            $result = '<div class="d-flex flex-column align-items-start">';
            $result .= '<span class="fw-bolder text-nowrap">' .$data->namamhs. '</span>';
            $result .= '<span>' .$data->nim. '</span>';
            $result .= '</div>';
            return $result;
        })
        ->editColumn('namaindustri', fn ($data) => '<span class="text-nowrap">'.$data->namaindustri.'</span>')
        ->editColumn('intern_position', fn ($data) => '<span class="text-nowrap">'.$data->intern_position.'</span>')
        ->editColumn('file_document_mitra', function ($data) {
            $result = '<div class="d-flex flex-column align-items-center">';

            if ($data->file_document_mitra == null) {
                $result .= '<span>-</span>';
            } elseif (isset($this->valid_steps[$data->current_step]) && ($data->tahapan_seleksi + 1) <= $this->valid_steps[$data->current_step]) {
                $result .= '<a href="' .asset('storage/' . $data->file_document_mitra). '" target="_blank" class="text-nowrap">Bukti Penerimaan.pdf</a>';
            } elseif (in_array($data->current_step, $this->reject_steps)) {
                $result .= '<a href="' .asset('storage/' . $data->file_document_mitra). '" target="_blank" class="text-nowrap">Bukti Penolakan.pdf</a>';
            }

            $result .= '</div>';
            return $result;
        });

        if ($request->type == 'diterima') {
            $datatables = $datatables
            ->addColumn('tanggalmagang', function ($data) {
                $result = '<div class="d-flex flex-column align-items-start">';
                $result .= '<span>Tanggal Mulai:</span>';
                $result .= '<span class="fw-semibold">' . ($data->startdate_magang == null ? '-' : Carbon::parse($data->startdate_magang)->format('d M Y')) . '</span>';
                $result .= '<span>Tanggal Berakhir:</span>';
                $result .= '<span class="fw-semibold">' . ($data->enddate_magang == null ? '-' : Carbon::parse($data->enddate_magang)->format('d M Y')) . '</span>';
                $result .= '</div>';
    
                return $result;
            })
            ->addColumn('pembimbing_lapangan', function ($data) {
                $result = '<div class="d-flex flex-column align-items-start">';
                $result .= (isset($data->namapeg) && isset($data->emailpeg)) ? '<span>' .$data->namapeg. '</span><span class="fw-semibold">' .$data->emailpeg. '</span>' : '<span>-</span>';
                $result .= '</div>';

                return $result;
            })
            ->addColumn('pembimbing_akademik', function ($data) {
                $result = '<div class="d-flex flex-column align-items-start">';
                $result .= (isset($data->namadosen) && isset($data->nip)) ? '<span>' .$data->namadosen. '</span><span class="fw-semibold">' .$data->nip. '</span>' : '<span>-</span>';
                $result .= '</div>';

                return $result;
            });
        }


        return $datatables->rawColumns([
            'namamhs', 'namaindustri', 'intern_position', 'file_document_mitra', 'tanggalmagang', 
            'pembimbing_lapangan', 'pembimbing_akademik'
        ])->make(true);
    }

    private function getViewDesign() {
        $title = 'Data Mahasiswa Magang';

        $urlGetData = route('mahasiswa_magang_dosen.get_data');

        $diterima = [
            '<th class="text-nowrap">No</th>',
            '<th class="text-nowrap">Nama/Nim</th>',
            '<th class="text-nowrap">Nama Perusahaan</th>',
            '<th class="text-nowrap">Posisi Magang</th>',
            '<th class="text-nowrap">Tanggal Magang</th>',
            '<th class="text-nowrap text-center">Dokumen</th>',
            '<th class="text-nowrap">Pembimbing Lapangan</th>',
            '<th class="text-nowrap">Pembimbing Akademik</th>'
        ];

        $belum_magang = [
            '<th class="text-nowrap">No</th>',
            '<th class="text-nowrap">Nama/Nim</th>',
            '<th class="text-nowrap">Nama Perusahaan</th>',
            '<th class="text-nowrap">Posisi Magang</th>',
            '<th class="text-nowrap text-center">Dokumen</th>'
        ];

        $columnsDiterima = "[
            {data: 'DT_RowIndex'},
            {data: 'namamhs'},
            {data: 'namaindustri'},
            {data: 'intern_position'},
            {data: 'tanggalmagang'},
            {data: 'file_document_mitra'},
            {data: 'pembimbing_lapangan'},
            {data: 'pembimbing_akademik'}
        ]";

        $columnsBelumMagang = "[
            {data: 'DT_RowIndex'},
            {data: 'namamhs'},
            {data: 'namaindustri'},
            {data: 'intern_position'},
            {data: 'file_document_mitra'}
        ]";

        return compact(
            'title',
            'urlGetData',
            'diterima', 
            'belum_magang', 
            'columnsDiterima', 
            'columnsBelumMagang'
        );
    }
}
