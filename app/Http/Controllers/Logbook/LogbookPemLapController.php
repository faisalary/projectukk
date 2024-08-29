<?php

namespace App\Http\Controllers\Logbook;

use App\Helpers\Response;
use App\Models\LogbookDay;
use App\Models\LogbookWeek;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Enums\LogbookWeeklyStatus;

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
            $result .= '<a class="cursor-pointer mx-1 text-warning"><i class="ti ti-clipboard-list"></i></a>';
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

        $data['list_week'] = LogbookWeek::select('id_logbook_week', 'week', 'status', 'start_date', 'end_date')
        ->whereHas('logbook', function ($q) use ($id) {
            $q->where('id_mhsmagang', $id);
        })
        ->orderBy('start_date', 'asc');

        if ($request->ajax()) {
            if ($request->section == 'get_logbook_week') {
                if ($request->data_id == null) {
                    $result['container_detail_logbook_weekly'] = '<h4 class="text-center">Belum di pilih</h4>';
                } else {
                    $logbook_week = LogbookWeek::select('week', 'id_logbook_week', 'status', 'alasan_tolak')->where('id_logbook_week', $request->data_id)->first();
                    if ($logbook_week->status == LogbookWeeklyStatus::NOT_YET_APPLIED) {
                        $result['container_detail_logbook_weekly'] = '<h4 class="text-center">Belum diajukan</h4>';
                    } else {
                        $data = LogbookDay::where('id_logbook_week', $request->data_id)->orderBy('date', 'asc')->get();
                        $week = $request->week;
                        $result['container_detail_logbook_weekly'] = view('kelola_mahasiswa/logbook/components/detail_logbook_weekly', compact('data', 'logbook_week', 'isPembLapangan', 'week'))->render();
                    }
                }
            } elseif ($request->section == 'get_list_week') {
                $data['list_week'] = $data['list_week']->where(function ($query) use ($request) {
                    $query->whereMonth('start_date', ($request->selected_month + 1))->orWhereMonth('end_date', ($request->selected_month + 1));
                })->get();

                $data['showStatus'] = true;
                $result['container_left_card'] = view('kelola_mahasiswa/logbook/components/left_card_week', $data)->render();
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
        $data['list_week'] = $data['list_week']->where(function ($query) {
            $query->whereMonth('start_date', now()->format('m'))->orWhereMonth('end_date', now()->format('m'));
        })->get();
        $data['showStatus'] = true;

        $data['list_month'] = $this->getListMonth('M')->list_month;
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
            'selected_month' => 'required|min:0|max:11',
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
            })
            ->where(function ($query) use ($request) {
                $query->whereMonth('start_date', ($request->selected_month + 1))
                ->orWhereMonth('end_date', ($request->selected_month + 1));
            })
            ->orderBy('start_date', 'asc')->get();

            $logbookDaily = LogbookDay::where('id_logbook_week', $id)->get();
            return Response::success([
                'view_left_card' => view('kelola_mahasiswa/logbook/components/left_card_week', [
                    'list_week' => $listLogbookWeek,
                    'checked' => $id,
                    'showStatus' => true
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

    public function viewInputNilai()
    {
        return view('kelola_mahasiswa.kelola_mahasiswa_lapangan.modal');
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

