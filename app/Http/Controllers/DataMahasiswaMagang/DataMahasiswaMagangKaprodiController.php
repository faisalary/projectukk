<?php

namespace App\Http\Controllers\DataMahasiswaMagang;

use App\Models\Dosen;
use App\Helpers\Response;
use App\Models\MhsMagang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Enums\PendaftaranMagangStatusEnum;

class DataMahasiswaMagangKaprodiController extends DataMahasiswaMagangController
{
    public function index() {
        $view = $this->getViewDesign();

        $dosen = Dosen::whereHas('user')->get();

        return view('data_mahasiswa_magang.index', compact('view', 'dosen'));
    }

    public function getData(Request $request) {

        if ($request->type == 'diterima') {
            $this->getPendaftaranMagang(function ($query) {
                return $query->where('pendaftaran_magang.current_step', PendaftaranMagangStatusEnum::APPROVED_PENAWARAN);
            });
        } else if ($request->type == 'ditolak') {
            $this->getPendaftaranMagang(function ($query) {
                return $query->whereIn('pendaftaran_magang.current_step', [
                    PendaftaranMagangStatusEnum::REJECTED_BY_DOSWAL,
                    PendaftaranMagangStatusEnum::REJECTED_BY_KAPRODI,
                    PendaftaranMagangStatusEnum::REJECTED_SELEKSI_TAHAP_1,
                    PendaftaranMagangStatusEnum::REJECTED_SELEKSI_TAHAP_2,
                    PendaftaranMagangStatusEnum::REJECTED_SELEKSI_TAHAP_3,
                    PendaftaranMagangStatusEnum::REJECTED_PENAWARAN
                ]);
            });
        }

        $validSteps = [
            PendaftaranMagangStatusEnum::APRROVED_SELEKSI_TAHAP_1 => 1,
            PendaftaranMagangStatusEnum::APRROVED_SELEKSI_TAHAP_2 => 2,
            PendaftaranMagangStatusEnum::APRROVED_SELEKSI_TAHAP_3 => 3,
        ];

        $rejectSteps = [
            PendaftaranMagangStatusEnum::REJECTED_SELEKSI_TAHAP_1,
            PendaftaranMagangStatusEnum::REJECTED_SELEKSI_TAHAP_2,
            PendaftaranMagangStatusEnum::REJECTED_SELEKSI_TAHAP_3,
        ];

        $datatables = datatables()->of($this->pendaftaran_magang->get())
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
        ->editColumn('file_document_mitra', function ($data) use ($validSteps, $rejectSteps) {
            $result = '<div class="d-flex flex-column align-items-center">';

            if ($data->file_document_mitra == null) {
                $result .= '<span>-</span>';
            } elseif (isset($validSteps[$data->current_step]) && ($data->tahapan_seleksi + 1) == $validSteps[$data->current_step]) {
                $result .= '<a href="' .asset('storage/' . $data->file_document_mitra). '" target="_blank" class="btn btn-primary btn-sm">Bukti Penerimaan.pdf</a>';
            } elseif (in_array($data->current_step, $rejectSteps)) {
                $result .= '<a href="' .asset('storage/' . $data->file_document_mitra). '" target="_blank" class="btn btn-primary btn-sm">Bukti Penolakan.pdf</a>';
            }

            $result .= '</div>';
            return $result;
        });

        if ($request->type == 'diterima') {
            $datatables = $datatables
            ->addColumn('tanggalmagang', function ($data) {
                $result = '<div class="d-flex flex-column align-items-start">';
                $result .= '<span>Tanggal Mulai:</span>';
                $result .= '<span class="fw-semibold">' .$data->startdate. '</span>';
                $result .= '<span>Tanggal Berakhir:</span>';
                $result .= '<span class="fw-semibold">' .$data->enddate. '</span>';
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

    public function assignPemAkademik(Request $request) {

        $request->validate([
            'id_pendaftaran' => 'required|array|exists:pendaftaran_magang,id_pendaftaran',
            'dosen_pembimbing' => 'required|exists:dosen,nip'
        ], [
            'dosen_pembimbing.required' => 'Pilih dosen pembimbing akademik',
            'id_pendaftaran.array' => 'Data tidak valid',
            'dosen_pembimbing.exists' => 'Dosen tidak ditemukan',
            'id_pendaftaran.exists' => 'Data tidak ditemukan',
            'id_pendaftaran.required' => 'Data tidak valid'
        ]);

        try {
            DB::beginTransaction();

            MhsMagang::whereIn('id_pendaftaran', $request->id_pendaftaran)->update([
                'nip' => $request->dosen_pembimbing
            ]);

            DB::commit();
            return Response::success(null, 'Berhasil assign dosen pembimbing akademik.');
        } catch (\Exception $e) {
            return Response::errorCatch($e);
        }
    }

    private function getViewDesign() {
        $title = 'Data Mahasiswa Magang';
        $urlGetData = route('mahasiswa_magang_kaprodi.get_data');
        $isKaprodi = true;

        $diterima = [
            '<th></th>',
            '<th class="text-nowrap">No</th>',
            '<th class="text-nowrap">Nama/Nim</th>',
            '<th class="text-nowrap">Nama Perusahaan</th>',
            '<th class="text-nowrap">Posisi Magang</th>',
            '<th class="text-nowrap">Tanggal Magang</th>',
            '<th class="text-nowrap text-center">Dokumen</th>',
            '<th class="text-nowrap">Pembimbing Lapangan</th>',
            '<th class="text-nowrap">Pembimbing Akademik</th>'
        ];

        $ditolak = [
            '<th class="text-nowrap">No</th>',
            '<th class="text-nowrap">Nama/Nim</th>',
            '<th class="text-nowrap">Nama Perusahaan</th>',
            '<th class="text-nowrap">Posisi Magang</th>',
            '<th class="text-nowrap text-center">Dokumen</th>'
        ];

        $columnsDiterima = "[
            {data: null},
            {data: 'DT_RowIndex'},
            {data: 'namamhs'},
            {data: 'namaindustri'},
            {data: 'intern_position'},
            {data: 'tanggalmagang'},
            {data: 'file_document_mitra'},
            {data: 'pembimbing_lapangan'},
            {data: 'pembimbing_akademik'}
        ]";

        $columnsDitolak = "[
            {data: 'DT_RowIndex'},
            {data: 'namamhs'},
            {data: 'namaindustri'},
            {data: 'intern_position'},
            {data: 'file_document_mitra'}
        ]";

        $columnDefs = "
        {
            targets: 0,
            searchable: false,
            orderable: false,
            render: function (data, type, row, meta) {
                console.log(data);
                return `<input type='checkbox' class='dt-checkboxes form-check-input' value='` + data.id_pendaftaran + `'>`;
            },
            checkboxes: {
                selectRow: false,
                selectAllRender: `<input type='checkbox' class='form-check-input'>`
            }
        },";

        return compact(
            'title',
            'isKaprodi',
            'urlGetData',
            'columnDefs',
            'diterima', 
            'ditolak', 
            'columnsDiterima', 
            'columnsDitolak'
        );
    }


}
