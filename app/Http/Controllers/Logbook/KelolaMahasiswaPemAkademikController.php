<?php

namespace App\Http\Controllers\Logbook;

use App\Helpers\Response;
use App\Models\LogbookDay;
use App\Models\LogbookWeek;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Enums\LogbookWeeklyStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class KelolaMahasiswaPemAkademikController extends LogbookController
{
    public function index()
    {
        return view('kelola_mahasiswa.index');
    }

    public function getData(Request $request)
    {
        try {
            $this->getMyMhsMagang(function ($query) {
                return $query->select(
                        'mhs_magang.id_mhsmagang', 'mahasiswa.namamhs', 'program_studi.namaprodi', 
                        'mhs_magang.jenis_magang', 'lowongan_magang.intern_position', 'industri.namaindustri', 
                        'lowongan_magang.durasimagang', 'mhs_magang.nilai_akhir_magang', 'mhs_magang.indeks_nilai_akhir'
                    )
                    ->join('program_studi', 'mahasiswa.id_prodi', '=', 'program_studi.id_prodi')
                    ->join('lowongan_magang', 'pendaftaran_magang.id_lowongan', '=', 'lowongan_magang.id_lowongan')
                    ->join('industri', 'lowongan_magang.id_industri', '=', 'industri.id_industri');
            });

            $response = DataTables::of($this->pendaftaran)
                ->addIndexColumn()
                ->editColumn('namamhs', function ($row) {
                    return $row->namamhs ?: '-';
                })
                ->editColumn('namaprodi', function ($row) {
                    return $row->namaprodi ?: '-';
                })
                ->editColumn('jenis_magang', function ($row) {
                    return $row->jenis_magang ?: '-';
                })
                ->editColumn('intern_position', function ($row) {
                    return $row->intern_position ?: '-';
                })
                ->editColumn('namaindustri', function ($row) {
                    return $row->namaindustri ?: '-';
                })
                ->editColumn('durasimagang', function ($row) {
                    $durasimagang = json_decode($row->durasimagang, true);
                    $durasimagangText = is_array($durasimagang) ? implode(' & ', $durasimagang) : $durasimagang;
                    return $durasimagangText ?: '-';
                })
                ->editColumn('nilai_akhir_magang', function ($row) {
                    return $row->nilai_akhir_magang ?: '-';
                })
                ->editColumn('indeks_nilai_akhir', function ($row) {
                    return $row->indeks_nilai_akhir ?: '-';
                })
                ->addColumn('berkas_akhir', function ($row) {
                    return '-'; // Set berkas_akhir to a dash
                })
                ->addColumn('aksi', function ($row) {
                    $x = "<div class='d-flex justify-content-center'>";
                    $x .= "<a href='/input/nilai/akademik' class='btn-icon text-warning'><i class='tf-icons ti ti-clipboard-list'></i></a>";
                    $x .= "<a href='" .route('kelola_mhs_pemb_akademik.logbook', $row->id_mhsmagang). "' class='btn-icon text-info'><i class='tf-icons ti ti-book'></i></a>";
                    $x .= "</div>";

                    return $x;
                })
                ->rawColumns(['aksi'])
                ->make(true);

            return $response;
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function viewLogbook(Request $request, $id)
    {
        if ($request->ajax()) {
            if ($request->section == 'get_logbook_week') {
                $data = LogbookDay::where('id_logbook_week', $request->data_id)->get();
                $logbook_week = LogbookWeek::select('week', 'id_logbook_week', 'status', 'alasan_tolak')->where('id_logbook_week', $request->data_id)->first();
                $week = $request->week;
                $result['view_content'] = view('kelola_mahasiswa/logbook/components/detail_logbook_weekly', compact('data', 'logbook_week', 'week'))->render();
                $result['view_rejected_reason'] = view('kelola_mahasiswa/logbook/components/rejected_reason', ['logbook_week' => $logbook_week])->render();
            } else {
                return Response::error(null, 'Invalid Request', 400);
            }

            return Response::success($result, 'Success');
        }

        $this->getMyMhsMagang(function ($query) use ($id) {
            return $query->select('mahasiswa.namamhs', 'mahasiswa.profile_picture', 'lowongan_magang.intern_position', 'mhs_magang.id_mhsmagang')
                ->join('lowongan_magang', 'lowongan_magang.id_lowongan', '=', 'pendaftaran_magang.id_lowongan')
                ->where('mhs_magang.id_mhsmagang', $id);
        });

        $data['mahasiswa'] = $this->pendaftaran->first();

        $data['list_week'] = LogbookWeek::select('id_logbook_week', 'week', 'status', 'start_date', 'end_date')
        ->whereHas('logbook', function ($q) use ($id) {
            $q->where('id_mhsmagang', $id);
        })
        ->where('status', '!=', LogbookWeeklyStatus::NOT_YET_APPLIED)->get();

        $data['url_get'] = route('kelola_mhs_pemb_akademik.logbook', $id);
        $data['urlBack'] = route('kelola_mhs_pemb_akademik');
        return view('kelola_mahasiswa.logbook.logbook', $data);
    }

    private function getMyMhsMagang($additional = null)
    {
        $user = auth()->user();
        $dosen = $user->dosen;

        $this->getPendaftaranMagang(function ($query) use ($additional, $dosen) {
            $query = $query->join('mhs_magang', 'mhs_magang.id_pendaftaran', '=', 'pendaftaran_magang.id_pendaftaran')
            ->where('mhs_magang.nip', $dosen->nip);

            if ($additional != null) $query = $additional($query);

            return $query;
        });

        return $this;
    }
}
