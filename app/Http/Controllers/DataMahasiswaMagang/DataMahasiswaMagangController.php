<?php

namespace App\Http\Controllers\DataMahasiswaMagang;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\PendaftaranMagang;
use App\Http\Controllers\Controller;
use App\Enums\PendaftaranMagangStatusEnum;

class DataMahasiswaMagangController extends Controller
{

    public function __construct()
    {
        $this->valid_steps = [
            PendaftaranMagangStatusEnum::APPROVED_SELEKSI_TAHAP_1 => 1,
            PendaftaranMagangStatusEnum::APPROVED_SELEKSI_TAHAP_2 => 2,
            PendaftaranMagangStatusEnum::APPROVED_SELEKSI_TAHAP_3 => 3,
            PendaftaranMagangStatusEnum::APPROVED_PENAWARAN => 4,
        ];

        $this->reject_steps = [
            PendaftaranMagangStatusEnum::REJECTED_SCREENING,
            PendaftaranMagangStatusEnum::REJECTED_SELEKSI_TAHAP_1,
            PendaftaranMagangStatusEnum::REJECTED_SELEKSI_TAHAP_2,
            PendaftaranMagangStatusEnum::REJECTED_SELEKSI_TAHAP_3
        ];
    }

    public function index() {
        $view = $this->getViewDesign();

        return view('data_mahasiswa_magang.index', compact('view'));
    }

    public function getDataTable(Request $request) {
        if ($request->type == 'diterima') {
            $this->getPendaftaranMagang(function ($query) {
                return $query->join('program_studi', 'mahasiswa.id_prodi', '=', 'program_studi.id_prodi')
                    ->join('jenis_magang', 'lowongan_magang.id_jenismagang', '=', 'jenis_magang.id_jenismagang')
                    ->where('pendaftaran_magang.current_step', PendaftaranMagangStatusEnum::APPROVED_PENAWARAN);
            });
        } else if ($request->type == 'belum_magang') {
            $this->getPendaftaranMagang(function ($query) {
                return $query->join('program_studi', 'mahasiswa.id_prodi', '=', 'program_studi.id_prodi')
                    ->join('jenis_magang', 'lowongan_magang.id_jenismagang', '=', 'jenis_magang.id_jenismagang')
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

            if (isset($this->valid_steps[$data->current_step]) && ($data->tahapan_seleksi + 1) <= $this->valid_steps[$data->current_step]) {
                $result .= '<a href="' .asset('storage/' . $data->file_document_mitra). '" target="_blank" class="text-nowrap">Bukti Penerimaan.pdf</a>';
            } elseif (in_array($data->current_step, $this->reject_steps)) {
                $result .= '<a href="' .asset('storage/' . $data->file_document_mitra). '" target="_blank" class="text-nowrap">Bukti Penolakan.pdf</a>';
            } elseif ($data->file_document_mitra == null) {
                $result .= '<span>-</span>';
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

    protected function getPendaftaranMagang($additional = null) {
        $this->pendaftaran_magang = PendaftaranMagang::join('mahasiswa', 'mahasiswa.nim', '=', 'pendaftaran_magang.nim')
        ->join('lowongan_magang', 'lowongan_magang.id_lowongan', '=', 'pendaftaran_magang.id_lowongan')
        ->join('industri', 'industri.id_industri', '=', 'lowongan_magang.id_industri')
        ->leftJoin('mhs_magang', 'pendaftaran_magang.id_pendaftaran', '=', 'mhs_magang.id_pendaftaran')
        ->leftJoin('pegawai_industri', 'mhs_magang.id_peg_industri', '=', 'pegawai_industri.id_peg_industri')
        ->leftJoin('dosen', 'mhs_magang.nip', '=', 'dosen.nip');

        if($additional != null) $this->pendaftaran_magang = $additional($this->pendaftaran_magang);

        $this->pendaftaran_magang = $this->pendaftaran_magang->get();

        return $this;
    }

    private function getViewDesign() {
        $title = 'Data Mahasiswa Magang';

        $urlGetData = route('data_mahasiswa.get_data');

        $diterima = [
            '<th class="text-nowrap">No</th>',
            '<th class="text-nowrap">Nama/Nim</th>',
            '<th class="text-nowrap">Program Studi</th>',
            '<th class="text-nowrap">Jenis Magang</th>',
            '<th class="text-nowrap">Nama Perusahaan</th>',
            '<th class="text-nowrap">Posisi Magang</th>',
            '<th class="text-nowrap">Tanggal Magang</th>',
            '<th class="text-nowrap text-center">Dokumen</th>',
            '<th class="text-nowrap">Pembimbing Lapangan</th>',
            '<th class="text-nowrap">Pembimbing Akademik</th>',
            '<th class="text-nowrap">Nilai Akhir</th>',
            '<th class="text-nowrap">Indeks Nilai</th>'
        ];

        $belum_magang = [
            '<th class="text-nowrap">No</th>',
            '<th class="text-nowrap">Nama/Nim</th>',
            '<th class="text-nowrap">Program Studi</th>',
            '<th class="text-nowrap">Jenis Magang</th>',
            '<th class="text-nowrap">Nama Perusahaan</th>',
            '<th class="text-nowrap">Posisi Magang</th>',
            '<th class="text-nowrap text-center">Dokumen</th>'
        ];

        $columnsDiterima = "[
            {data: 'DT_RowIndex'},
            {data: 'namamhs'},
            {data: 'namaprodi'},
            {data: 'namajenis'},
            {data: 'namaindustri'},
            {data: 'intern_position'},
            {data: 'tanggalmagang'},
            {data: 'file_document_mitra'},
            {data: 'pembimbing_lapangan'},
            {data: 'pembimbing_akademik'},
            {data: 'nilai_akhir_magang'},
            {data: 'indeks_nilai_akhir'}
        ]";

        $columnsBelumMagang = "[
            {data: 'DT_RowIndex'},
            {data: 'namamhs'},
            {data: 'namaprodi'},
            {data: 'namajenis'},
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
