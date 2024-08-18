<?php

namespace App\Http\Controllers\Logbook;

use App\Helpers\Response;
use App\Models\MhsMagang;
use App\Models\LogbookDay;
use App\Models\LogbookWeek;
use App\Models\NilaiPemblap;
use Illuminate\Http\Request;
use App\Models\KomponenNilai;
use App\Enums\LogbookWeeklyStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LogbookPemLapController extends LogbookController
{
    public function viewList()
    {
        return view('kelola_mahasiswa.kelola_mahasiswa_lapangan.index');
    }

    public function getData()
    {
        $this->getMyPendaftarMagang(function ($query) {
            return $query->select('mhs_magang.id_mhsmagang', 'mahasiswa.namamhs', 'program_studi.namaprodi', 'lowongan_magang.intern_position', 'lowongan_magang.durasimagang', 'jenis_magang.namajenis')
            ->join('lowongan_magang', 'lowongan_magang.id_lowongan', '=', 'pendaftaran_magang.id_lowongan')
            ->join('program_studi', 'program_studi.id_prodi', '=', 'mahasiswa.id_prodi')
            ->leftJoin('jenis_magang', 'lowongan_magang.id_jenismagang', '=', 'jenis_magang.id_jenismagang');
        });

        return datatables()->of($this->pendaftaran)
        ->addIndexColumn()
        ->editColumn('durasimagang', fn ($x) => implode(' dan ', json_decode($x->durasimagang)))
        ->addColumn('nilai_akhir', fn ($x) => '85')
        ->addColumn('indeks', fn ($x) => 'A')
        ->addColumn('status', function () {
            $result = '<div class="d-flex justify-content-center">';
            $result .= '<span class="badge bg-label-primary">Aktif</span>';
            $result .= '</div>';

            return $result;
        })
        ->addColumn('aksi', function ($x) {
            $result = '<div class="d-flex justify-content-center">';
            $result .= '<a class="cursor-pointer mx-1 text-warning" href="'.route('kelola_magang_pemb_lapangan.input_nilai', $x->id_mhsmagang).'"><i class="ti ti-clipboard-list"></i></a>';
            $result .= '<a class="cursor-pointer mx-1 text-info" href="'.route('kelola_magang_pemb_lapangan.logbook', $x->id_mhsmagang).'"><i class="ti ti-book"></i></a>';
            $result .= '<a class="cursor-pointer mx-1 text-danger"><i class="ti ti-circle-x"></i></a>';
            $result .= '</div>';

            return $result;
        })
        ->rawColumns(['nilai_akhir', 'indeks', 'status', 'aksi'])
        ->make(true);
    }

    public function viewLogbook(Request $request, $id)
    {
        $isPembLapangan = true;
        if ($request->ajax()) {
            if ($request->section == 'get_logbook_week') {
                $data = LogbookDay::where('id_logbook_week', $request->data_id)->get();
                $logbook_week = LogbookWeek::select('week', 'id_logbook_week', 'status', 'alasan_tolak')->where('id_logbook_week', $request->data_id)->first();
                $week = $request->week;
                $result['view_content'] = view('kelola_mahasiswa/logbook/components/detail_logbook_weekly', compact('data', 'logbook_week', 'isPembLapangan', 'week'))->render();
                $result['view_rejected_reason'] = view('kelola_mahasiswa/logbook/components/rejected_reason', ['logbook_week' => $logbook_week])->render();
            } else {
                return Response::error(null, 'Invalid Request', 400);
            }

            return Response::success($result, 'Success');
        }

        $this->getMyPendaftarMagang(function ($query) use ($id) {
            return $query->select('mahasiswa.namamhs', 'mahasiswa.profile_picture', 'lowongan_magang.intern_position', 'mhs_magang.id_mhsmagang')
                ->join('lowongan_magang', 'lowongan_magang.id_lowongan', '=', 'pendaftaran_magang.id_lowongan')
                ->where('mhs_magang.id_mhsmagang', $id);
        });

        $data['mahasiswa'] = $this->pendaftaran->first();

        $data['list_week'] = LogbookWeek::select('id_logbook_week', 'week', 'status', 'start_date', 'end_date')
        ->whereHas('logbook', function ($q) use ($id) {
            $q->where('id_mhsmagang', $id);
        })
        ->where('status', '!=', LogbookWeeklyStatus::NOT_YET_APPLIED)->orderBy('start_date', 'asc')
        ->get();

        $data['isPembLapangan'] = $isPembLapangan;
        $data['url_get'] = route('kelola_magang_pemb_lapangan.logbook', $id);
        $data['urlBack'] = route('kelola_magang_pemb_lapangan');
        return view('kelola_mahasiswa.logbook.logbook', $data);
    }

    public function approval(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'rejected_reason' => 'required_if:status,rejected',
            'week' => 'required',
        ]);

        try {
            $logbookWeek = LogbookWeek::where('status', LogbookWeeklyStatus::PENDING)->where('id_logbook_week', $id)->first();
            if (!$logbookWeek) return Response::error(null, 'Logbook not found', 404);

            if ($request->status == 'approved') {
                $logbookWeek->status = LogbookWeeklyStatus::APPROVED;
            } else {
                $logbookWeek->status = LogbookWeeklyStatus::REJECTED;
                $logbookWeek->alasan_tolak = $request->rejected_reason;
            }

            $logbookWeek->save();

            $logbookWeek = $logbookWeek->load('logbook');

            $listLogbookWeek = LogbookWeek::select('id_logbook_week', 'week', 'status', 'start_date', 'end_date')
            ->whereHas('logbook', function ($q) use ($logbookWeek) {
                $q->where('id_mhsmagang', $logbookWeek->logbook->id_mhsmagang);
            })->where('status', '!=', LogbookWeeklyStatus::NOT_YET_APPLIED)->orderBy('start_date', 'asc')->get();

            $logbookDaily = LogbookDay::where('id_logbook_week', $id)->get();
            return Response::success([
                'view_left_card' => view('kelola_mahasiswa/logbook/components/left_card_week', [
                    'list_week' => $listLogbookWeek,
                    'checked' => $id
                ])->render(),
                'view_rejected_reason' => view('kelola_mahasiswa/logbook/components/rejected_reason', ['logbook_week' => $logbookWeek])->render(),
                'view_logbook' => view('kelola_mahasiswa/logbook/components/detail_logbook_weekly', [
                    'logbook_week' => $logbookWeek,
                    'data' => $logbookDaily,
                    'week' => $request->week
                ])->render()
            ], 'Berhasil menyetujui logbook');
        } catch (\Exception $e) {
            return Response::errorCatch($e);
        }
    }

    public function viewInputNilai($id)
    {
        $user = auth()->user();
        $pegawai = $user->pegawai_industri;
        $data['mhs_magang'] = MhsMagang::select('id_mhsmagang', 'jenis_magang')->where('id_peg_industri', $pegawai->id_peg_industri)->where('id_mhsmagang', $id)->first();
        if (!$data['mhs_magang']) return Response::error(null, 'Mahasiswa not found', 404);

        $data['data_nilai'] = NilaiPemblap::select('id_kompnilai', 'nilai', 'aspek_penilaian', 'deskripsi_penilaian', 'nilai_max')
        ->where('id_mhsmagang', $id)->get();

        if (empty($data['data_nilai'])) {
            $data['data_nilai'] = KomponenNilai::select('id_kompnilai', 'aspek_penilaian', 'deskripsi_penilaian', 'nilai_max')
            ->where('scored_by', 2)
            ->where('id_jenismagang', $data['mhs_magang']->jenis_magang)
            ->where('status', 1)->get();
        }
        
        return view('kelola_mahasiswa/penilaian/index', $data);
    }

    public function storeNilai(Request $request, $id)
    {
        $request->validate([
            'id.*' => 'required',
            'nilai.*' => 'required'
        ], [
            'id.*.required' => 'Invalid.',
            'nilai.*.required' => 'Nilai wajib diisi.'
        ]);

        try {
            $user = auth()->user();
            $pegawai = $user->pegawai_industri;

            $mhs_magang = MhsMagang::where('id_peg_industri', $pegawai->id_peg_industri)->where('id_mhsmagang', $id)->first();
            if (!$mhs_magang) return Response::error(null, 'Mahasiswa not found', 404);

            $kompNilai = KomponenNilai::where('scored_by', 2)
            ->where('id_jenismagang', $mhs_magang->jenis_magang)
            ->where('status', 1)->get();

            DB::beginTransaction();

            $errors = [];
            foreach ($request->id_kompnilai as $key => $value) {
                $komp_nilai = $kompNilai->where('id_kompnilai', $value)->first();
                if (!$komp_nilai) return Response::error(null, 'Invalid.');
                
                if ($komp_nilai->nilai_max < $request->nilai[$key]) {
                    $errors['nilai.' . $key] = ['Nilai tidak boleh lebih dari ' . $komp_nilai->nilai_max];
                }

                NilaiPemblap::updateOrCreate([
                    'id_mhsmagang' => $id,
                    'id_kompnilai' => $value
                ], [
                    'nilai' => $request->nilai[$key],
                    'oleh' => $user->name,
                    'dateinputnilai' => now(),
                    'aspek_penilaian' => $komp_nilai->aspek_penilaian,
                    'nilai_max' => $komp_nilai->nilai_max,
                    'deskripsi_penilaian' => $komp_nilai->deskripsi_penilaian
                ]);
            }

            if (!empty($errors)) {
                DB::rollBack();
                return Response::errorValidate($errors, 'Gagal menyimpan nilai');
            };

            // dd('masuk');
            DB::commit();
            return Response::success(null, 'Berhasil menyimpan nilai.');
        } catch (\Exception $e) {
            DB::rollBack();
            return Response::errorCatch($e);
        }
    }

    private function getMyPendaftarMagang($additional = null)
    {
        $user = auth()->user();
        $pegawai = $user->pegawai_industri;

        $this->getPendaftaranMagang(function ($query) use ($additional, $pegawai) {
            $query = $query->join('mhs_magang', 'mhs_magang.id_pendaftaran', '=', 'pendaftaran_magang.id_pendaftaran')
            ->where('mhs_magang.id_peg_industri', $pegawai->id_peg_industri);

            if ($additional != null) $query = $additional($query);

            return $query;
        });

        return $this;
    }
}

