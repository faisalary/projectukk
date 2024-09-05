<?php

namespace App\Http\Controllers\BerkasAkhir;

use App\Helpers\Response;
use App\Models\Mahasiswa;
use App\Models\BerkasMagang;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\PendaftaranMagang;
use App\Http\Controllers\Controller;
use App\Enums\BerkasAkhirMagangStatus;
use Illuminate\Support\Facades\Storage;
use App\Enums\PendaftaranMagangStatusEnum;
use App\Models\BerkasAkhirMagang;
use App\Models\MhsMagang;
use App\Models\NilaiMutu;

class BerkasAkhirMagangController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:berkas_magang_fakultas.view', ['only' => ['viewMagangFakultas']]);
        $this->middleware('permission:berkas_magang_mandiri.view', ['only' => ['viewMagangMandiri']]);
    }

    public function viewMagangFakultas(Request $request)
    {
        if ($request->ajax()) { 
            if ($request->section == 'get_data_nilai') {
                $data = MhsMagang::select('nilai_akhir_magang', 'nilai_adjust', 'alasan_adjust')->where('id_mhsmagang', $request->data_id)->first();
                if (!$data) return Response::error(null, 'Not Found', 404);
            } else {
                return Response::error(null, 'Invalid');
            }

            return Response::success($data, 'Success');
        }

        $data['default_detail_mhs'] = view('berkas_akhir_magang/magang_fakultas/components/card_detail_mhs')->render();
        return view('berkas_akhir_magang.magang_fakultas.index', $data);
    }

    public function getDataFakultas(Request $request)
    {
        $request->validate(['type' => 'required|in:pending,incomplete,complete']);

        $pendaftaranMagang = $this->getPemagang(function ($q) {
            return $q->join('mahasiswa', 'mahasiswa.nim', '=', 'pendaftaran_magang.nim')
            ->join('mhs_magang', 'mhs_magang.id_pendaftaran', '=', 'pendaftaran_magang.id_pendaftaran');
        })->pemagang;

        $berkasMagang = BerkasMagang::select('berkas_magang.*', 'berkas_akhir_magang.id_berkas_akhir_magang', 'berkas_akhir_magang.id_mhsmagang', 'berkas_akhir_magang.berkas_file', 'berkas_akhir_magang.berkas_magang', 'berkas_akhir_magang.status_berkas', 'berkas_akhir_magang.tgl_upload')
        ->leftJoin('berkas_akhir_magang', 'berkas_akhir_magang.id_berkas_magang', '=', 'berkas_magang.id_berkas_magang')
        ->whereIn('berkas_magang.id_jenismagang', $pendaftaranMagang->pluck('id_jenismagang')->toArray())->get();

        return datatables()->of($pendaftaranMagang)
        ->addIndexColumn()
        ->editColumn('namamhs', function ($x) {
            $result = '<div class="d-flex flex-column align-items-start">';
            $result .= '<a class="text-nowrap text-primary text-decoration-underline cursor-pointer" onclick="viewMhs($(this))" data-id="'.$x->nim.'">' .$x->namamhs. '</a>';
            $result .= '<span>' .$x->nim. '</span>';
            $result .= '</div>';
            return $result;
        })
        ->addColumn('berkas_akhir_magang', function ($x) use ($berkasMagang) {
            $berkasPicked = $berkasMagang->where('id_mhsmagang', $x->id_mhsmagang);
            $result = '<table class="text-nowrap"><tbody>';
            foreach ($berkasPicked as $key => $value) {
                $result .= '<tr>';

                $result .= '<td style="padding: 0rem;padding-top: 0.5rem;padding-bottom: 0.5rem;">';
                if (isset($value->id_berkas_akhir_magang)) {
                    $result .= '<a href="'.route('berkas_akhir_magang.fakultas.detail_file', ['id' => $value->id_berkas_akhir_magang]).'" class="text-primary">'.$value->berkas_magang.'.'.explode('.', $value->berkas_file)[1].'</a>';
                } else {
                    $result .= '<a href="javascript: void(0)" class="text-primary">'.$value->berkas_magang.'.'.explode('.', $value->berkas_file)[1].'</a>';
                }
                $result .= '</td>';

                $result .= '<td style="padding: 0.5rem;">:</td>';

                $status_ = BerkasAkhirMagangStatus::getWithLabel($value->status_berkas);
                $status = '<span class="badge badge-pill bg-label-'.$status_['color'].'">'.$status_['title'].'</span>';

                $result .= '<td style="padding-top: 0.5rem;padding-bottom: 0.5rem;">'.$status.'</td>';
                $result .= '</tr>';
            }
            $result .= '</tbody></table>';

            return $result;
        })
        ->addColumn('timestap_pengumpulan', function ($x) use ($berkasMagang) {
            $berkasPicked = $berkasMagang->where('id_mhsmagang', $x->id_mhsmagang);
            $result = '<table class="text-nowrap"><tbody>';
            foreach ($berkasPicked as $key => $value) {
                $result .= '<tr>';

                $result .= '<td style="padding: 0rem;padding-top: 0.5rem;padding-bottom: 0.5rem;">';
                if (isset($value->id_berkas_akhir_magang)) {
                    $result .= '<a href="'.route('berkas_akhir_magang.fakultas.detail_file', ['id' => $value->id_berkas_akhir_magang]).'" class="text-primary">'.$value->berkas_magang.'.'.explode('.', $value->berkas_file)[1].'</a>';
                } else {
                    $result .= '<a href="javascript: void(0)" class="text-primary">'.$value->berkas_magang.'.'.explode('.', $value->berkas_file)[1].'</a>';
                }
                $result .= '</td>';

                $result .= '<td style="padding: 0.5rem;">:</td>';
                $result .= '<td style="padding-top: 0.5rem;padding-bottom: 0.5rem;">'.Carbon::parse($value->tgl_upload)->format('d/m/Y H:i').'</td>';
                $result .= '</tr>';
            }
            $result .= '</tbody></table>';

            return $result;
        })
        ->addColumn('ketepatan_pengumpulan', function ($x) use ($berkasMagang) {
            $berkasPicked = $berkasMagang->where('id_mhsmagang', $x->id_mhsmagang);
            $result = '<table class="text-nowrap"><tbody>';
            foreach ($berkasPicked as $key => $value) {
                $result .= '<tr>';

                $result .= '<td style="padding: 0rem;padding-top: 0.5rem;padding-bottom: 0.5rem;">';
                if (isset($value->id_berkas_akhir_magang)) {
                    $result .= '<a href="'.route('berkas_akhir_magang.fakultas.detail_file', ['id' => $value->id_berkas_akhir_magang]).'" class="text-primary">'.$value->berkas_magang.'.'.explode('.', $value->berkas_file)[1].'</a>';
                } else {
                    $result .= '<a href="javascript: void(0)" class="text-primary">'.$value->berkas_magang.'.'.explode('.', $value->berkas_file)[1].'</a>';
                }
                $result .= '</td>';

                $result .= '<td style="padding: 0.5rem;">:</td>';
                $status = '<span class="badge bg-label-success">Tepat Waktu Diserahkan</span>';
                if ($value->tgl_upload > $value->due_date) {
                    $status = '<span class="badge bg-label-danger">Terlambat Diserahkan</span>';
                }

                $result .= '<td>'.$status.'</td>';
                $result .= '</tr>';
            }
            $result .= '</tbody></table>';

            return $result;
        })
        ->addColumn('nilai_akhir', function ($x) {
            $result = $x->nilai_akhir_magang ?? '-';
            if (isset($x->nilai_adjust)) $result = $x->nilai_adjust;
            return $result;
        })
        ->addColumn('indeks', function ($x) {
            $result = $x->indeks_nilai_akhir ?? '-';
            if (isset($x->indeks_nilai_adjust)) $result = $x->indeks_nilai_adjust;
            return $result;
        })
        ->addColumn('alasan_pengurangan_nilai', fn ($x) => $x->alasan_adjust)
        ->addColumn('aksi', function ($x) {
            $result = '<div class="d-flex justify-content-center">';
            $result .= '<a href="javascript: void(0)" onclick="adjustmentNilai($(this))" data-id="'.$x->id_mhsmagang.'" class="cursor-pointer text-warning"><i class="ti ti-clipboard-list"></i></a>';
            $result .= '</div>';

            return $result;
        })
        ->rawColumns(['namamhs', 'berkas_akhir_magang', 'timestap_pengumpulan', 'ketepatan_pengumpulan', 'nilai_akhir', 'indeks', 'alasan_pengurangan_nilai', 'aksi'])
        ->make(true);
    }

    public function getDataMhs($id) {
        $data = $this->getPemagang(function ($q) use ($id) {
            return $q
            ->select(
                'mahasiswa.nim', 'mahasiswa.namamhs', 'program_studi.namaprodi', 'industri.namaindustri', 
                'lowongan_magang.intern_position', 'mhs_magang.startdate_magang', 'mhs_magang.enddate_magang', 
                'pemb_lapangan.namapeg', 'pemb_akademik.namadosen', 'pendaftaran_magang.file_document_mitra'
            )
            ->join('mahasiswa', 'mahasiswa.nim', '=', 'pendaftaran_magang.nim')
            ->join('program_studi', 'program_studi.id_prodi', '=', 'mahasiswa.id_prodi')
            ->join('mhs_magang', 'mhs_magang.id_pendaftaran', '=', 'pendaftaran_magang.id_pendaftaran')
            ->join('industri', 'industri.id_industri', 'lowongan_magang.id_industri')
            ->leftJoin('pegawai_industri as pemb_lapangan', 'pemb_lapangan.id_peg_industri', 'mhs_magang.id_peg_industri')
            ->leftJoin('dosen as pemb_akademik', 'pemb_akademik.nip', 'mhs_magang.nip')
            ->where('mahasiswa.nim', $id);
        })->pemagang->first();

        return view('berkas_akhir_magang/magang_fakultas/components/card_detail_mhs', compact('data'))->render();
    }

    public function detailFile($id) {
        $berkas = BerkasAkhirMagang::where('id_berkas_akhir_magang', $id)->first();
        if (!$berkas) return abort(403);

        $data['berkas'] = $berkas;
        $data['data'] = url('storage/' . $berkas->berkas_file);
        $data['url'] = route('berkas_akhir_magang.fakultas.approval_file', $id);
        return view('berkas_akhir_magang/magang_fakultas/detail_file', $data);
    }

    public function approvalBerkas(Request $request, $id) {
        $request->validate([
            'status' => 'required|in:approve,reject',
            'reason' => 'required_if:status,reject',
        ], [
            'reason.required_if' => 'Alasan penolakan harus diisi.',
        ]);

        try {
            $berkas = BerkasAkhirMagang::join('mhs_magang', 'mhs_magang.id_mhsmagang', '=', 'berkas_akhir_magang.id_mhsmagang')
            ->where('id_berkas_akhir_magang', $id)->first();
            if (!$berkas) return Response::error(null, 'Berkas tidak ditemukan.');

            $berkas->status_berkas = BerkasAkhirMagangStatus::APPROVED;
            if ($request->status == 'reject') {
                $berkas->status_berkas = BerkasAkhirMagangStatus::REJECTED;
                $berkas->rejected_reason = $request->reason;
            }
            $berkas->save();

            return Response::success([
                'view' => view('berkas_akhir_magang/magang_fakultas/components/right_card_detail', compact('berkas'))->render()
            ], 'Berhasil menyimpan data!');
        } catch (\Exception $e) {
            return Response::errorCatch($e);
        }
    }

    public function adjustmentNilai(Request $request, $id) 
    {
        $request->validate([
            'nilai_adjust' => 'required|numeric|min:0|max:100',
            'alasan_adjust' => 'required',
        ], [
            'nilai_adjust.required' => 'Nilai Adjustment harus diisi.',
            'nilai_adjust.numeric' => 'Nilai Adjustment harus berupa angka.',
            'nilai_adjust.min' => 'Nilai Adjustment harus >= 0.',
            'nilai_adjust.max' => 'Nilai Adjustment harus <= 100.',
            'alasan_adjust.required' => 'Alasan harus diisi.',
        ]);

        try {
            $mhsMagang = MhsMagang::where('id_mhsmagang', $id)->first();
            if (!$mhsMagang) return Response::error(null, 'Mahasiswa Not Found.');

            $mhsMagang->nilai_adjust = $request->nilai_adjust;
            $mhsMagang->alasan_adjust = $request->alasan_adjust;

            $nilaiMutu = NilaiMutu::where('nilaimin', '<=', $mhsMagang->nilai_adjust)
            ->where('nilaimax', '>=', $mhsMagang->nilai_adjust)
            ->first();

            $mhsMagang->indeks_nilai_adjust = $nilaiMutu->nilaimutu;
            $mhsMagang->save();

            return Response::success(null, 'Berhasil menyimpan data!');
        } catch (\Exception $e) {
            return Response::errorCatch($e);
        }
    }

    public function viewMagangMandiri()
    {
        return view('berkas_akhir_magang.magang_mandiri.index');
    }

    protected function getPemagang($additional = null)
    {
        $this->pemagang = PendaftaranMagang::join('lowongan_magang', 'lowongan_magang.id_lowongan', '=', 'pendaftaran_magang.id_lowongan')
        ->where('current_step', PendaftaranMagangStatusEnum::APPROVED_PENAWARAN);
        if ($additional != null) $this->pemagang = $additional($this->pemagang);
        $this->pemagang = $this->pemagang->get();
        return $this;
    }
}
