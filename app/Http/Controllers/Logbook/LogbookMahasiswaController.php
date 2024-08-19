<?php

namespace App\Http\Controllers\Logbook;

use App\Enums\LogbookWeeklyStatus;
use App\Models\Logbook;
use Carbon\CarbonPeriod;
use App\Helpers\Response;
use App\Models\LogbookDay;
use App\Models\LogbookWeek;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class LogbookMahasiswaController extends LogbookController
{
    public function __construct() {
        parent::__construct();
    }

    public function index(Request $request)
    {
        $this->getMyPendaftaranMagang(function ($query) {
            return $query->select('industri.image', 'lowongan_magang.intern_position', 'industri.namaindustri', 'mhs_magang.id_mhsmagang', 'mhs_magang.startdate_magang', 'mhs_magang.enddate_magang', 'pendaftaran_magang.id_pendaftaran')
            ->join('lowongan_magang', 'lowongan_magang.id_lowongan', '=', 'pendaftaran_magang.id_lowongan')
            ->join('industri', 'industri.id_industri', '=', 'lowongan_magang.id_industri')
            ->join('mhs_magang', 'pendaftaran_magang.id_pendaftaran', '=', 'mhs_magang.id_pendaftaran');
        });

        $data['data'] = $this->pendaftaran->first();
        if ($data['data'] == null) return abort(403);

        $logbook = Logbook::where([
            'id_mhsmagang' => $data['data']->id_mhsmagang,
            'id_pendaftaran' => $data['data']->id_pendaftaran,
        ])->first();

        $current_month = ($request->current_month)? ($request->current_month + 1) : Carbon::now()->month;
        $data['logbook_week'] = [];
        if ($logbook) {
            $data['logbook_week'] = LogbookWeek::with('logbookDay')->where('id_logbook', $logbook->id_logbook)
            ->where(function ($query) use ($current_month) {
                $query->whereMonth('start_date', $current_month)->orWhereMonth('end_date', $current_month);
            })
            ->orderBy('start_date', 'asc')
            ->get()->transform(function ( $logbookWeek) {
                $logbookWeek->status = $this->getStatusLogbookWeek($logbookWeek);
                return $logbookWeek;
            });
        }

        if ($request->ajax()) {
            $result = null;
            if ($request->section == 'get_logbook_week') {
                $result['view_card_weekly'] = view('logbook/components/card_weekly', $data)->render();
            } else {
                return Response::error(null, 'Invalid');
            }
            return Response::success($result, 'Success');
        }

        $data['list_month'] = [];
        for ($i = 1; $i <= 12; $i++) {
            $data['list_month'][] = date('F', mktime(0, 0, 0, $i, 1));
        }

        return view('logbook.logbook', $data);
    }

    public function detail(Request $request, $id)
    {
        $data['data'] = LogbookWeek::where('id_logbook_week', $id)->first();
        if ($data['data'] == null) return abort(403);

        if ($request->ajax()) {
            if ($request->section == 'get_logbook_daily') {
                $request->validate(['data_id' => 'required']);

                $logbook = LogbookDay::select('emoticon', 'activity', 'date')->where('id_logbook_day', $request->data_id)->first();
                if (!$logbook) return Response::error(null, 'Logbook daily tidak ditemukan.');

                return Response::success($logbook, 'Success');
            } else {
                return Response::error(null, 'Invalid Request', 400);
            }
        }
        
        $this->getMyPendaftaranMagang(function ($query) {
            return $query->select('mahasiswa.namamhs', 'mahasiswa.nim', 'program_studi.namaprodi', 'universitas.namauniv', 'mahasiswa.profile_picture')
            ->join('lowongan_magang', 'lowongan_magang.id_lowongan', '=', 'pendaftaran_magang.id_lowongan')
            ->join('universitas', 'universitas.id_univ', '=', 'mahasiswa.id_univ')
            ->join('program_studi', 'program_studi.id_prodi', '=', 'mahasiswa.id_prodi')
            ->join('industri', 'industri.id_industri', '=', 'lowongan_magang.id_industri');
        });

        $data['mahasiswa'] = $this->pendaftaran->first();

        $logbook_daily = $this->getLogbookDaily($data['data']);
        $data['logbook_day'] = $logbook_daily['logbook_day'];
        $data['can_apply'] = $logbook_daily['can_apply'];

        $data['data']->label_status = $this->getStatusLogbookWeek($data['data']);;
        
        return view('logbook.logbook_detail', $data);
    }

    public function storeCreateLogbook(Request $request)
    {
        $request->validate([
            'range_date' => ['required', function ($attribute, $value, $fail) {
                $value = explode(' to ', $value);
                $startDate = Carbon::parse($value[0]);
                if (count($value) > 1) {
                    $endDate = Carbon::parse($value[1]);
                }

                if (isset($endDate) && $startDate->gt($endDate)) $fail('Range date tidak valid');
            }],
            'current_month' => ['required', 'numeric', 'min:0', 'max:11']
        ]);

        try {
            $this->getMyPendaftaranMagang(function ($query) {
                return $query->select('mhs_magang.id_mhsmagang', 'pendaftaran_magang.id_pendaftaran')
                ->join('mhs_magang', 'pendaftaran_magang.id_pendaftaran', '=', 'mhs_magang.id_pendaftaran');
            });

            DB::beginTransaction();

            $value = explode(' to ', $request->range_date);
            $startDate = Carbon::parse($value[0]);
            $endDate = Carbon::parse($value[0]);
            if (count($value) > 1) {
                $endDate = Carbon::parse($value[1]);
            }

            $pendaftaran = $this->pendaftaran->first();

            $logbook = Logbook::firstOrCreate([
                'id_mhsmagang' => $pendaftaran->id_mhsmagang,
                'id_pendaftaran' => $pendaftaran->id_pendaftaran,
            ]);

            $dateUsed = CarbonPeriod::create($startDate, $endDate)->toArray();
            $dateUsed = array_map(function($date) {
                return $date->toDateString();
            }, $dateUsed);

            $logbookWeek = LogbookWeek::where('id_logbook', $logbook->id_logbook)
            ->where(function($query) use ($dateUsed) {
                foreach ($dateUsed as $date) {
                    $query->orWhere(function($q) use ($date) {
                        $q->whereDate('start_date', '<=', $date)
                          ->whereDate('end_date', '>=', $date);
                    });
                }
            })->count();

            if ($logbookWeek > 0) return Response::error(null, 'Logbook sudah ada');

            $week = LogbookWeek::where('id_logbook', $logbook->id_logbook)
            ->orderBy('week', 'desc')
            ->first()?->week + 1 ?: 1;

            $logbookWeek = LogbookWeek::create([
                'id_logbook' => $logbook->id_logbook,
                'week' => $week,
                'start_date' => $startDate->format('Y-m-d'),
                'end_date' => $endDate->format('Y-m-d')
            ]);
            
            DB::commit();

            $logbook_week = LogbookWeek::where('id_logbook', $logbook->id_logbook)
            ->where(function ($query) use ($request) {
                $query->whereMonth('start_date', ($request->current_month + 1))->orWhereMonth('end_date', ($request->current_month + 1));
            })
            ->orderBy('start_date', 'asc')
            ->get()->transform(function ($item) {
                $item->status = $this->getStatusLogbookWeek($item);
                return $item;
            });
            return Response::success([
                'view' => view('logbook/components/card_weekly', compact('logbook_week'))->render()
            ], 'Berhasil membuat logbook');
        } catch (\Exception $e) {
            DB::rollBack();
            return Response::errorCatch($e);
        }
    }

    public function storeLogbookDaily(Request $request, $id_logbook_week)
    {
        $request->validate([
            'activity' => ['required', 'string'],
        ], ['activity.required' => 'Aktivitas harus diisi']);

        try {
            $user = auth()->user();
            $mahasiswa = $user->mahasiswa;

            $logbookWeek = LogbookWeek::where('id_logbook_week', $id_logbook_week)->first();

            $date = Carbon::parse($request->date);
            if (!$logbookWeek) return Response::error(null, 'Logbook Week Not Found');
            if ($date->lt($logbookWeek->start_date) || $date->gt($logbookWeek->end_date)) return Response::error(null, 'Tidak valid');
            if (!in_array($request->emoticon, [1, 2, 3, 4, 5])) return Response::error(null, 'Pilih mood anda pada hari ini.');

            LogbookDay::create([
                'id_logbook_week' => $id_logbook_week,
                'date' => $date->format('Y-m-d'),
                'emoticon' => $request->emoticon,
                'activity' => $request->activity
            ]);

            $logbookWeek->label_status = $this->getStatusLogbookWeek($logbookWeek);
            $logbookWeek = $logbookWeek->load('logbookDay');

            $logbook_daily = $this->getLogbookDaily($logbookWeek);
            
            $logbook_day = $logbook_daily['logbook_day'];
            $can_apply = $logbook_daily['can_apply'];

            return Response::success([
                'view' => view('logbook/components/card_daily', ['data' => $logbookWeek, 'logbook_day' => $logbook_day, 'can_apply' => $can_apply])->render(),
                'view_left_card' => view('logbook/components/left_card_detail', ['data' => $logbookWeek])->render()
            ], 'Logbook daily ditambahkan');
        } catch (\Exception $e) {
            return Response::errorCatch($e);
        }
    }

    public function updateLogbookDaily(Request $request, $id)
    {
        $request->validate([
            'activity' => ['required', 'string'],
        ], ['activity.required' => 'Aktivitas harus diisi']);

        try {
            if (!in_array($request->emoticon, [1, 2, 3, 4, 5])) return Response::error(null, 'Pilih mood anda.');

            $logbookDaily = LogbookDay::with('logbookWeek')->where('id_logbook_day', $id)->first();
            if (!$logbookDaily) return Response::error(null, 'Logbook Daily Not Found');

            $logbookDaily->activity = $request->activity;
            $logbookDaily->emoticon = $request->emoticon;
            $logbookDaily->save();

            $logbookWeek = $logbookDaily->logbookWeek;
            $logbookWeek->label_status = $this->getStatusLogbookWeek($logbookWeek);
            $logbook_daily = $this->getLogbookDaily($logbookWeek->load('logbookDay'));

            $logbook_day = $logbook_daily['logbook_day'];
            $can_apply = $logbook_daily['can_apply'];

            return Response::success([
                'view' => view('logbook/components/card_daily', ['data' => $logbookWeek, 'logbook_day' => $logbook_day, 'can_apply' => $can_apply])->render(),
                'view_left_card' => view('logbook/components/left_card_detail', ['data' => $logbookWeek])->render()
            ], 'Logbook daily diupdate');
        } catch (\Exception $e) {
            return Response::errorCatch($e);
        }
    }

    public function applyLogbook($id_logbook_week)
    {
        try {
            $logbookWeekly = LogbookWeek::with('logbookDay')->where('id_logbook_week', $id_logbook_week)->first();
            if (!$logbookWeekly) return Response::error(null, 'Logbook Daily Not Found');

            $dateUsed = CarbonPeriod::create($logbookWeekly->start_date, $logbookWeekly->end_date)->toArray();
            $dateUsed = array_map(function($date) {
                return $date->toDateString();
            }, $dateUsed);

            $dateInLogbookDaily = $logbookWeekly->logbookDay->pluck('date')->toArray();

            if (
                !empty(array_diff($dateInLogbookDaily, $dateUsed)) || 
                !empty(array_diff($dateUsed, $dateInLogbookDaily))
            ) {
                return Response::error(null, 'Logbook belum diisi semuanya');
            }

            $logbookWeekly->status = 1;
            $logbookWeekly->save();

            $logbookWeekly->label_status = $this->getStatusLogbookWeek($logbookWeekly);
            return Response::success([
                'view_left_card' => view('logbook/components/left_card_detail', ['data' => $logbookWeekly])->render(),
                'view_detail' => view('logbook.components.card_daily', ['data' => $logbookWeekly, 'logbook_day' => $logbookWeekly->logbookDay, 'can_apply' => false])->render()
            ], 'Logbook successfully applied!');
        } catch (\Exception $e) {
            return Response::errorCatch($e);
        }
    }

    private function getMyPendaftaranMagang($additional = null)
    {
        $user = auth()->user();
        $mahasiswa = $user->mahasiswa;

        $this->getPendaftaranMagang(function ($query) use ($additional, $mahasiswa) {
            $query = $query->where('mahasiswa.nim', $mahasiswa->nim);
            if ($additional != null) $query = $additional($query);
            return $query;
        });

        return $this;
    }

    private function getLogbookDaily($logbookWeek)
    {
        $dateArray = CarbonPeriod::create($logbookWeek->start_date, $logbookWeek->end_date)->toArray();

        $dateArray = array_map(function($date) {
            return $date->toDateString();
        }, $dateArray);
        

        $logbook_day = [];
        $canApply = true;
        foreach ($dateArray as $key => $value) {
            $logbookDay =  $logbookWeek->logbookDay->where('date', $value)->first();
            if ($logbookDay == null) {
                $canApply = false;
                $logbookDay = new LogbookDay();
                $logbookDay->date = $value;
            }

            $logbook_day[] = $logbookDay;
        }

        if (in_array($logbookWeek->status, [LogbookWeeklyStatus::PENDING, LogbookWeeklyStatus::APPROVED])) $canApply = false;

        return [
            'logbook_day' => collect($logbook_day)->sortBy('date'),
            'can_apply' => $canApply
        ];
    }

    private function getStatusLogbookWeek(LogbookWeek $logbook) {
        $status = LogbookWeeklyStatus::getWithLabel($logbook->status);
        return '<span class="badge bg-label-' .$status['color']. '">' .$status['title']. '</span>';
    }
}
