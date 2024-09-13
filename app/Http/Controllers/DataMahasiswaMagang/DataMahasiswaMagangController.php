<?php

namespace App\Http\Controllers\DataMahasiswaMagang;

use App\Helpers\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\PendaftaranMagang;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Enums\PendaftaranMagangStatusEnum;
use App\Models\MhsMagang;

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
        $request->validate(['type' => ['required', 'in:diterima,belum_magang,belum_spm']]);

        $this->getPendaftaranMagang(function ($query) use ($request) {
            $query = $query->select(
                'pendaftaran_magang.id_pendaftaran', 'pendaftaran_magang.current_step', 'lowongan_magang.tahapan_seleksi', 'mahasiswa.namamhs', 'mahasiswa.nim', 'program_studi.namaprodi', 'jenis_magang.namajenis', 'industri.namaindustri', 
                'lowongan_magang.intern_position', 'mhs_magang.startdate_magang', 'mhs_magang.enddate_magang', 'pendaftaran_magang.file_document_mitra', 
                'pendaftaran_magang.dokumen_spm', 'pegawai_industri.namapeg', 'pegawai_industri.emailpeg', 'dosen.namadosen', 'dosen.nip', 'mhs_magang.nilai_akhir_magang', 'mhs_magang.indeks_nilai_akhir'
            )
                ->join('program_studi', 'mahasiswa.id_prodi', '=', 'program_studi.id_prodi')
                ->join('jenis_magang', 'lowongan_magang.id_jenismagang', '=', 'jenis_magang.id_jenismagang');
                
            if ($request->type == 'diterima') {
                $query = $query->where('pendaftaran_magang.current_step', PendaftaranMagangStatusEnum::APPROVED_PENAWARAN);
            } else if ($request->type == 'belum_magang') {
                $query = $query->where('pendaftaran_magang.current_step', '!=', PendaftaranMagangStatusEnum::APPROVED_PENAWARAN);
            } else if ($request->type == 'belum_spm') {
                $query = $query->where('pendaftaran_magang.current_step', PendaftaranMagangStatusEnum::APPROVED_PENAWARAN)
                ->whereNull('pendaftaran_magang.dokumen_spm');
            }
            return $query;
        });

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
        ->addColumn('file_document', function ($data) {
            $result = '<div class="d-flex flex-column align-items-center">';

            if (isset($this->valid_steps[$data->current_step]) && ($data->tahapan_seleksi + 1) <= $this->valid_steps[$data->current_step]) {
                $result .= '<a href="' .asset('storage/' . $data->file_document_mitra). '" target="_blank" class="text-nowrap text-primary">Bukti Penerimaan.pdf</a>';
            } elseif (in_array($data->current_step, $this->reject_steps)) {
                $result .= '<a href="' .asset('storage/' . $data->file_document_mitra). '" target="_blank" class="text-nowrap text-primary">Bukti Penolakan.pdf</a>';
            } elseif ($data->file_document_mitra == null) {
                $result .= '<span>-</span>';
            }

            if ($data->dokumen_spm) {
                $result .= '<a href="' .url('storage/' . $data->dokumen_spm). '" target="_blank" class="text-nowrap text-primary">Dokumen SPM.pdf</a>';
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
            'namamhs', 'namaindustri', 'intern_position', 'file_document', 'tanggalmagang', 
            'pembimbing_lapangan', 'pembimbing_akademik'
        ])->make(true);
    }

    public function uploadSPM(Request $request) {
        $request->validate([
            'id_pendaftaran' => 'required|array|exists:pendaftaran_magang,id_pendaftaran',
            'dokumen' => ['required', 'mimes:pdf'],
            'mulai_magang' => ['required'],
            'selesai_magang' => ['required', function ($attribute, $value, $fail) use ($request) {
                if (isset($request->mulai_magang) && isset($value)) {
                    $startDate = Carbon::parse($request->mulai_magang);
                    $endDate = Carbon::parse($value);
                    if ($startDate->gt($endDate)) {
                        $fail('Tanggal Selesai Magang harus setelah tanggal Mulai Magang');
                    }
                }
            }]
        ], [
            'id_pendaftaran.required' => 'Pendaftaran harus dipilih',
            'dokumen.mimes' => 'File harus berformat PDF',
            'dokumen.required' => 'File harus diunggah',
            'mulai_magang.required' => 'Mulai Magang harus diisi',
            'selesai_magang.required' => 'Selesai Magang harus diisi'
        ]);

        try {
            DB::beginTransaction();

            $file = null;
            if ($request->hasFile('dokumen')) {
                $file = Storage::put('dokumen_spm', $request->dokumen);
            }

            PendaftaranMagang::whereIn('id_pendaftaran', $request->id_pendaftaran)->update([
                'dokumen_spm' => $file, 
            ]);

            MhsMagang::whereIn('id_pendaftaran', $request->id_pendaftaran)->update([
                'startdate_magang' => Carbon::parse($request->mulai_magang)->format('Y-m-d'),
                'enddate_magang' => Carbon::parse($request->selesai_magang)->format('Y-m-d'),
            ]);

            DB::commit();
            return Response::success(null, 'Berhasil mengunggah dokumen SPM');
        } catch (\Exception $e) {
            DB::rollBack();
            return Response::errorCatch($e);
        }
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
        $isLKM = true;

        $listTable = ['diterima', 'belum_magang', 'belum_spm'];
        $listTab = [
            '<li class="nav-item" role="presentation">
                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-diterima" aria-controls="navs-pills-diterima" aria-selected="true">
                    <i class="ti ti-user-check"></i>
                    Diterima
                </button>
            </li>',
            '<li class="nav-item" role="presentation">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-belum_magang" aria-controls="navs-pills-belum_magang" aria-selected="false" tabindex="-1">
                    <i class="ti ti-user-x"></i>
                    Belum Magang
                </button>
            </li>',
            '<li class="nav-item" role="presentation">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-belum_spm" aria-controls="navs-pills-belum_spm" aria-selected="false" tabindex="-1">
                    <i class="ti ti-upload"></i>
                    Belum Upload SPM
                </button>
            </li>'
        ];

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

        $belum_spm = [
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
            {data: 'file_document'},
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
            {data: 'file_document'}
        ]";

        $columnsBelumSPM = "[
            {data: 'DT_RowIndex'},
            {data: 'namamhs'},
            {data: 'namaprodi'},
            {data: 'namajenis'},
            {data: 'namaindustri'},
            {data: 'intern_position'},
            {data: 'file_document'}
        ]";

        $columnDefs = "
        {
            targets: 0,
            searchable: false,
            orderable: false,
            render: function (data, type, row, meta) {
                return `<input type='checkbox' class='dt-checkboxes form-check-input' value='` + row.id_pendaftaran + `'>`;
            },
            checkboxes: {
                selectRow: false,
                selectAllRender: `<input type='checkbox' class='form-check-input'>`
            }
        }";

        return compact(
            'title',
            'urlGetData',
            'isLKM',
            'listTable',
            'listTab',
            'diterima', 
            'belum_magang', 
            'belum_spm', 
            'columnsDiterima', 
            'columnsBelumMagang',
            'columnsBelumSPM',
            'columnDefs'
        );
    }
 
}
