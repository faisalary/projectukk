<?php

namespace App\Http\Controllers;

use stdClass;
use Exception;
use App\Helpers\Response;
use App\Jobs\SendMailJob;
use App\Models\Education;
use App\Models\MhsMagang;
use App\Models\Experience;
use App\Models\JenisMagang;
use App\Models\ProgramStudi;
use App\Models\SeleksiTahap;
use Illuminate\Http\Request;
use App\Models\LowonganMagang;
use Illuminate\Support\Carbon;
use App\Models\BahasaMahasiswa;
use App\Mail\EmailJadwalSeleksi;
use App\Models\PendaftaranMagang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Enums\LowonganMagangStatusEnum;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Enums\PendaftaranMagangStatusEnum;
use App\Http\Requests\LowonganMagangRequest;

class LowonganMagangController extends Controller
{

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $id = $request->route()->parameters()['id'] ?? null;

            $this->getLowonganMagang(function ($query) use ($id) {
                return $query->where('id_lowongan', $id);
            });
            
            return $next($request);
        }, ['only' => ['setDateConfirmClosing', 'detailInformasi', 'getDataDetailInformasi', 'edit', 'detail', 'update', 'status']]);

        $this->valid_step = [
            PendaftaranMagangStatusEnum::SELEKSI_TAHAP_1 => 0,
            PendaftaranMagangStatusEnum::APPROVED_SELEKSI_TAHAP_1 => 1,
            PendaftaranMagangStatusEnum::APPROVED_SELEKSI_TAHAP_2 => 2,
            PendaftaranMagangStatusEnum::APPROVED_SELEKSI_TAHAP_3 => 3,
        ];
    }

    public function indexInformasi(Request $request) {
        return view('company.lowongan_magang.informasi_lowongan.informasi_lowongan');
    }

    public function showInformasi(Request $request) {
        $this->getLowonganMagang(function ($query) {
            return $query->where('statusaprove', LowonganMagangStatusEnum::APPROVED);
        });

        $lowonganMagang = $this->my_lowongan_magang;

        $rejected = [
            PendaftaranMagangStatusEnum::REJECTED_BY_DOSWAL,
            PendaftaranMagangStatusEnum::REJECTED_BY_KAPRODI,
            PendaftaranMagangStatusEnum::REJECTED_SELEKSI_TAHAP_1,
            PendaftaranMagangStatusEnum::REJECTED_SELEKSI_TAHAP_2,
            PendaftaranMagangStatusEnum::REJECTED_SELEKSI_TAHAP_3,
            PendaftaranMagangStatusEnum::REJECTED_PENAWARAN,
        ];

        $lowongan_magang = $lowonganMagang->map(function ($item) use ($rejected) {
            $total_pelamar = $item->total_pelamar;
            $item->screening = $total_pelamar->where('current_step', PendaftaranMagangStatusEnum::APPROVED_BY_LKM)->count();

            $countProsesSeleksi = 0;
            $countPenawaran = 0;
            $countRejected = 0;

            foreach ($total_pelamar as $key => $data) {
                if (isset($this->valid_step[$data->current_step]) && ($item->tahapan_seleksi + 1) > $this->valid_step[$data->current_step]) {
                    $countProsesSeleksi++;
                } else if (isset($this->valid_step[$data->current_step]) && ($item->tahapan_seleksi + 1) == $this->valid_step[$data->current_step]) {
                    $countPenawaran++;
                } else if (in_array($data->current_step, $rejected)) {
                    $countRejected++;
                }
            }

            $item->proses_seleksi = $countProsesSeleksi;
            $item->penawaran = $countPenawaran;

            $item->approved = $total_pelamar->where('current_step', PendaftaranMagangStatusEnum::APPROVED_PENAWARAN)->count();
            $item->rejected = $countRejected;

            $item->total_pelamar = $item->screening + $item->proses_seleksi + $item->penawaran + $item->approved + $item->rejected;

            return $item;
        });

        return datatables()->of($lowongan_magang)
        ->addColumn('data', function ($data) {
            $view = view('company/lowongan_magang/components/card_informasi_lowongan', compact('data'))->render();
            return $view;
        })
        ->rawColumns(['data'])
        ->make(true);
    }

    public function setDateConfirmClosing(Request $request, $id) {
        try {
            if (!$this->my_lowongan_magang) return Response::error(null, 'Lowongan Magang Not Found');

            $this->my_lowongan_magang->first()->update([
                'date_confirm_closing' => Carbon::parse($request->date)->format('Y-m-d')
            ]);

            return Response::success(null, 'Berhasil memperbarui Tanggal Batas Konfirmasi!');
        } catch (\Exception $e) {
            return Response::errorCatch($e);
        }
    }

    public function detailInformasi(Request $request, $id) {

        if ($request->ajax()) {
            $this->getPendaftarMagang(function ($query) use ($id, $request) {
                return $query->where('pendaftaran_magang.id_lowongan', $id)->where('pendaftaran_magang.id_pendaftaran', $request->data_id);
            }); 

            $data['pendaftar'] = $this->my_pendaftar_magang->first();
            $data['education'] = Education::where('nim', $data['pendaftar']->nim)->get();
            $data['experience'] = Experience::where('nim', $data['pendaftar']->nim)->get();
            $data['skills'] = json_decode($data['pendaftar']->skills, true);
            $data['language'] = BahasaMahasiswa::where('nim', $data['pendaftar']->nim)->orderBy('bahasa', 'asc')->get();

            $view = view('company/lowongan_magang/components/card_detail_pelamar', $data)->render();
            return Response::success([
                'view' => $view,
                'id_pendaftar' => $data['pendaftar']->id_pendaftaran,
                'current_step' => $data['pendaftar']->current_step
            ], 'Success');
        }

        $data['lowongan'] = $this->my_lowongan_magang->first();

        $data['tab'] = [
            'screening' => ['label' => 'Screening', 'icon' => 'ti ti-files', 'table' => PendaftaranMagangStatusEnum::APPROVED_BY_LKM],
        ];

        $data['listStatus'][] = ['value' => PendaftaranMagangStatusEnum::APPROVED_BY_LKM, 'label' => 'Screening'];
        for ($i = 0; $i < ($data['lowongan']->tahapan_seleksi + 1); $i++) { 
            $data['tab']['tahap_' . $i] = ['label' => 'Seleksi Tahap ' . ($i + 1), 'icon' => 'ti ti-device-desktop-analytics', 'table' => array_search($i, $this->valid_step)];
            $data['listStatus'][] = ['value' => array_search($i, $this->valid_step), 'label' => 'Seleksi Tahap ' . ($i + 1)];
        }

        $data['last_seleksi'] = array_search(($data['lowongan']->tahapan_seleksi + 1), $this->valid_step);
        array_push($data['listStatus'], 
            ['value' => $data['last_seleksi'], 'label' => 'Penawaran'],
            ['value' => 'rejected', 'label' => 'Ditolak'],
        );

        $data['tab']['penawaran'] = ['label' => 'Penawaran', 'icon' => 'ti ti-writing-sign', 'table' => array_search(($data['lowongan']->tahapan_seleksi + 1), $this->valid_step)];
        $data['tab']['diterima'] = ['label' => 'Diterima', 'icon' => 'ti ti-user-check', 'table' => PendaftaranMagangStatusEnum::APPROVED_PENAWARAN];
        $data['tab']['ditolak'] = ['label' => 'Ditolak', 'icon' => 'ti ti-user-x', 'table' => 'all_rejected'];

        $data['urlGetData'] = route('informasi_lowongan.get_data', $id);
        $data['urlDetailPelamar'] = route('informasi_lowongan.detail', $id);

        return view('company/lowongan_magang/informasi_lowongan/detail_kandidat', $data);
    }

    public function getDataDetailInformasi(Request $request, $id) {
        $lowongan = $this->my_lowongan_magang->first();

        $inArray = 'in:' . PendaftaranMagangStatusEnum::APPROVED_BY_LKM;
        for ($i=0; $i < ($lowongan->tahapan_seleksi + 1); $i++) { 
            $inArray .= ',' . array_search($i, $this->valid_step);
        }
        $inArray .= ',';
        $inArray .= implode(',', [
            array_search(($lowongan->tahapan_seleksi + 1), $this->valid_step),
            PendaftaranMagangStatusEnum::APPROVED_PENAWARAN,
            'all_rejected'
        ]);

        $request->validate(['type' => 'required|' . $inArray]);

        $this->getPendaftarMagang(function ($query) use ($id, $request) {
            $query = $query->where('pendaftaran_magang.id_lowongan', $id);

            if ($request->type == 'all_rejected') {
                $query = $query->whereIn('current_step', [
                    PendaftaranMagangStatusEnum::REJECTED_SCREENING,
                    PendaftaranMagangStatusEnum::REJECTED_SELEKSI_TAHAP_1,
                    PendaftaranMagangStatusEnum::REJECTED_SELEKSI_TAHAP_2,
                    PendaftaranMagangStatusEnum::REJECTED_SELEKSI_TAHAP_3,
                    PendaftaranMagangStatusEnum::REJECTED_PENAWARAN
                ]);
            } else {
                $query = $query->where('current_step', $request->type);
            }

            return $query;
        });

        return datatables()->of($this->my_pendaftar_magang)
        ->addIndexColumn()
        ->editColumn('namamhs', function ($data) {
            $result = '<div class="d-flex flex-column align-items-start">';
            $result .= '<span class="fw-semibold text-nowrap">' .$data->namamhs. '</span>';
            $result .= '<span class="text-nowrap">' .$data->nim. '</span>';
            $result .= '</div>';
            return $result;
        })
        ->editColumn('nohpmhs', fn ($data) => '<span class="text-nowrap">' . $data->nohpmhs . '</span>')
        ->editColumn('emailmhs', fn ($data) => '<span class="text-nowrap">' . $data->emailmhs . '</span>')
        ->editColumn('tanggaldaftar', function ($data) {
            return '<span class="text-nowrap">' . Carbon::parse($data->tanggaldaftar)->format('d F Y') . '</span>';
        })
        ->editColumn('namaprodi', fn ($data) => '<span class="text-nowrap">' . $data->namaprodi . '</span>')
        ->editColumn('namafakultas', fn ($data) => '<span class="text-nowrap">' . $data->namafakultas . '</span>')
        ->editColumn('namauniv', fn ($data) => '<span class="text-nowrap">' . $data->namauniv . '</span>')
        ->editColumn('current_step', function ($data) {
            if ($data->current_step == array_search(($data->tahapan_seleksi + 1), $this->valid_step)) {
                $status = ['title' => 'Penawaran', 'color' => 'info'];
            } else {
                $status = PendaftaranMagangStatusEnum::getWithLabel($data->current_step);
            }  

            return '<div class="d-flex justify-content-center"><span class="badge bg-label-' . $status['color'] . '">'. $status['title'] .'</span></div>';
        })
        ->addColumn('action', function ($data) {
            $result = '<div class="d-flex justify-content-center">';
            $result .= '<a class="cursor-pointer text-primary" onclick="detailInfo($(this))" data-id="'.$data->id_pendaftaran.'"><i class="ti ti-file-invoice"></i></a>';
            $result .= '</div>';

            return $result;
        })
        ->rawColumns([
            'namamhs', 'nohpmhs', 'emailmhs', 'tanggaldaftar', 'namaprodi', 'namafakultas', 'namauniv', 'current_step', 'action'
        ])
        ->make(true);
    }

    public function updateStatusPelamar(Request $request, $id) {
        try {
            $this->getPendaftarMagang(function ($query) use ($id) {
                return $query->leftJoin('industri', 'industri.id_industri', '=', 'lowongan_magang.id_industri')
                    ->where('pendaftaran_magang.id_pendaftaran', $id);
            });

            $pendaftar = $this->my_pendaftar_magang->first()->load('lowongan_magang');
            if (!$pendaftar) return Response::error(null, 'Pendaftaran Not Found');

            // $lowongan = $pendaftar->lowongan_magang;

            $listStatus[] = PendaftaranMagangStatusEnum::APPROVED_BY_LKM;
            for ($i = 0; $i < ($pendaftar->tahapan_seleksi + 1); $i++) { 
                $listStatus[] = array_search($i, $this->valid_step);
            }

            $last_seleksi = array_search(($pendaftar->tahapan_seleksi + 1), $this->valid_step);
            array_push($listStatus, 
                $last_seleksi,
                'rejected'
            );

            $validator = Validator::make($request->all(), [
                'status' => 'required|in:' . implode(',', $listStatus),
                'file' => 'required_if:status,' . $last_seleksi . '|mimes:pdf|max:2048',
            ]);

            if ($validator->fails()) {
                return Response::error($validator->errors()->all(), 'Invalid.');
            }

            $file = null;
            if ($request->hasFile('file')) {
                $file = Storage::put('berkas_mitra', $request->file('file'));
            }

            $statusPicked = $request->status;
            if ($request->status == 'rejected') {
                if ($pendaftar->current_step == PendaftaranMagangStatusEnum::APPROVED_BY_LKM) {
                    $statusPicked = PendaftaranMagangStatusEnum::REJECTED_SCREENING;
                } else if ($pendaftar->current_step == PendaftaranMagangStatusEnum::SELEKSI_TAHAP_1) {
                    $statusPicked = PendaftaranMagangStatusEnum::REJECTED_SELEKSI_TAHAP_1;
                } else if ($pendaftar->current_step == PendaftaranMagangStatusEnum::APPROVED_SELEKSI_TAHAP_1) {
                    $statusPicked = PendaftaranMagangStatusEnum::REJECTED_SELEKSI_TAHAP_2;
                } else if ($pendaftar->current_step == PendaftaranMagangStatusEnum::APPROVED_SELEKSI_TAHAP_2) {
                    $statusPicked = PendaftaranMagangStatusEnum::REJECTED_SELEKSI_TAHAP_3;
                }
            }

            $pendaftar->update([
                'current_step' => $statusPicked,
                'file_document_mitra' => $file
            ]);

            $pendaftar->label_step = PendaftaranMagangStatusEnum::getWithLabel($pendaftar->current_step)['title'];
            dispatch(new SendMailJob($pendaftar->emailmhs, new EmailJadwalSeleksi($pendaftar)));
            
            return Response::success([
                'id_pendaftar' => $pendaftar->id_pendaftaran,
                'current_step' => $pendaftar->current_step
            ], 'Success');
        } catch (\Exception $e) {
            return Response::errorCatch($e);
        }
    }

    /** 
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->element == 'id_prodi') {
            $data = ProgramStudi::select('id_prodi as id', 'namaprodi as text')->where('id_fakultas', $request->selected)->get();
            return Response::success($data, 'Success!');
        }

        return view('company.lowongan_magang.kelola_lowongan.halaman_lowongan_magang_mitra');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $jenismagang = JenisMagang::all();

        return view('company.lowongan_magang.kelola_lowongan.tambah_lowongan_magang', compact('jenismagang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LowonganMagangRequest $request)
    {
        try {
            DB::beginTransaction();
            $dataStep = Crypt::decryptString($request->data_step);
            if ($dataStep == 1) {
                return Response::success([
                    'ignore_alert' => true,
                    'data_step' => (int) ($dataStep + 1),
                ], 'Valid data!');
            }
            if ($dataStep == 2) {
                $tahap = $request->tahapan_seleksi;
                return Response::success([
                    'ignore_alert' => true,
                    'data_step' => (int) ($dataStep + 1),
                    'view' => view('company/lowongan_magang/kelola_lowongan/step/proses_seleksi', compact('tahap'))->render(),
                ], 'Valid data!');
            }

            $id_industri = auth()->user()->pegawai_industri->id_industri;

            $request->jenjang = array_map(function() {
                return [];
            }, array_flip($request->jenjang));

            $lowongan = LowonganMagang::create([
                'id_jenismagang' => $request->id_jenismagang,
                'intern_position' => $request->intern_position,
                'kuota' => $request->kuota,
                'deskripsi' => $request->deskripsi,
                'requirements' => $request->requirements,
                'gender' => $request->gender,
                'jenjang' => json_encode($request->jenjang),
                'keterampilan' => json_encode($request->keterampilan),
                'pelaksanaan' => $request->pelaksanaan,
                'nominal_salary' => $request->nominal_salary,
                'benefitmagang' => $request->benefitmagang,
                'lokasi' => json_encode($request->lokasi),
                'startdate' => Carbon::parse($request->startdate)->format('Y-m-d'),
                'enddate' => Carbon::parse($request->enddate)->format('Y-m-d'),
                'durasimagang' => json_encode($request->durasimagang),
                'tahapan_seleksi' => $request->tahapan_seleksi,
                'id_industri' => $id_industri,
                'statusaprove' => LowonganMagangStatusEnum::PENDING,
            ]);
            
            foreach ($request->proses_seleksi as $key => $value) {
                SeleksiTahap::create([
                    'id_lowongan' => $lowongan->id_lowongan,
                    'tahap' => Crypt::decryptString($value['tahap']),
                    'deskripsi' => $value['deskripsi'],
                    'tgl_mulai' => $value['tgl_mulai'],
                    'tgl_akhir' => $value['tgl_akhir'],
                ]);    
            }

            DB::commit();
            return Response::success(null, 'Lowongan magang ditambahkan!');
        } catch (Exception $e) {
            DB::rollback();
            return Response::errorCatch($e);
        }
    }

    /**
     * Display the specified resource.
     */

    public function show(Request $request)
    {
        $request->validate([
            'type' => 'required|in:total,tertunda,diterima,ditolak',
        ]);

        $this->getLowonganMagang(function ($query) use ($request) {
            $query = $query->with("jenismagang", "lokasi", "prodi", "fakultas", "industri")->orderBy('intern_position', 'asc');
            if ($request->type == 'total') return $query;
            return $query->where('statusaprove', $request->type);
        });
        
        return DataTables::of($this->my_lowongan_magang)
            ->addIndexColumn()
            ->editColumn('status', function ($row) {
                if ($row->status == 1) {
                    return "<div class='text-center'><div class='badge rounded-pill bg-label-success'>" . "Active" . "</div></div>";
                } else {
                    return "<div class='text-center'><div class='badge rounded-pill bg-label-danger'>" . "Inactive" . "</div></div>";
                }
            })
            ->addColumn('action', function ($row) {
                $icon = ($row->status) ? "ti-circle-x" : "ti-circle-check";
                $color = ($row->status) ? "danger" : "primary";

                $btn = "<div class='d-flex justify-content-center'><a href='" . route('kelola_lowongan.edit', ['id' => $row->id_lowongan]) . "' class='cursor-pointer mx-1 text-warning'><i class='tf-icons ti ti-edit' ></i></a>
                        <a href='" . route('kelola_lowongan.detail' , $row->id_lowongan) . "' class='cursor-pointer mx-1 text-primary'><i class='tf-icons ti ti-file-invoice' ></i></a>
                        <a data-function='afterUpdateStatus' data-url='".route('kelola_lowongan.change_status', ['id' => $row->id_lowongan])."' class='cursor-pointer mx-1 update-status text-{$color}'><i class='tf-icons ti {$icon}'></i></a></div>";
                return $btn;
            })
            ->addColumn('tanggal', function ($row) {
                $result = '<div class="text-start">';

                $result .= '<span class="text-muted">Publish</span><br>';
                $result .= '<span>' . Carbon::parse($row->startdate)->format('d F Y') . '</span><br>';
                $result .= '<span class="text-muted">Takedown</span><br>';
                $result .= '<span>' . Carbon::parse($row->enddate)->format('d F Y') . '</span>';

                $result .= '</div>';
                return  $result;
            })
            ->editColumn('durasimagang', function ($data) {
                $result = implode(' dan ', json_decode($data->durasimagang));
                return $result;
            })
            ->rawColumns(['action', 'status', 'tanggal', 'durasimagang'])
            ->make(true);
    }
    /**
     * Show the form for editing the specified resource.
     */ 
    public function edit(Request $request, $id)
    {
        $lowongan = $this->my_lowongan_magang->load('jenisMagang')->first();

        $jenismagang = JenisMagang::all();
        $tahap = $lowongan->tahapan_seleksi;

        foreach ($lowongan->seleksi_tahap as $key => $value) {
            $lowongan->{'proses_seleksi[' . $key . '][deskripsi]'} = $value->deskripsi;
            $lowongan->{'proses_seleksi[' . $key . '][tgl_mulai]'} = $value->tgl_mulai;
            $lowongan->{'proses_seleksi[' . $key . '][tgl_akhir]'} = $value->tgl_akhir;
        }
        
        return view('company.lowongan_magang.kelola_lowongan.tambah_lowongan_magang', compact('jenismagang', 'lowongan', 'tahap'));
    }

    public function detail($id)  
    {
        $lowongan = $this->my_lowongan_magang->load('seleksi_tahap', 'industri')->first()->dataTambahan('jenjang_pendidikan', 'program_studi');
        if (!$lowongan) return redirect()->route('kelola_lowongan');

        $urlBack = route('kelola_lowongan');
        return view('lowongan_magang.kelola_lowongan_magang_admin.detail', compact('lowongan', 'urlBack'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LowonganMagangRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $lowongan = $this->my_lowongan_magang->first();

            $dataStep = Crypt::decryptString($request->data_step);
            if ($dataStep == 1) {
                return Response::success([
                    'ignore_alert' => true,
                    'data_step' => (int) ($dataStep + 1),
                ], 'Valid data!');
            }
            if ($dataStep == 2) {
                $tahap = $request->tahapan_seleksi;
                $return = [
                    'ignore_alert' => true,
                    'data_step' => (int) ($dataStep + 1),
                ];

                if ($tahap != $lowongan->tahapan_seleksi) {
                    $return['view'] = view('company/lowongan_magang/kelola_lowongan/step/proses_seleksi', compact('tahap'))->render();
                }

                return Response::success($return, 'Valid data!');
            }

            $request->jenjang = array_map(function() {
                return [];
            }, array_flip($request->jenjang));

            $lowongan->id_jenismagang = $request->id_jenismagang;
            $lowongan->intern_position = $request->intern_position;
            $lowongan->kuota = $request->kuota;
            $lowongan->deskripsi = $request->deskripsi;
            $lowongan->requirements = $request->requirements;
            $lowongan->jenjang = $request->jenjang;
            $lowongan->keterampilan = $request->keterampilan;
            $lowongan->gender = $request->gender;
            $lowongan->nominal_salary = $request->nominal_salary;
            $lowongan->benefitmagang = $request->benefitmagang;
            $lowongan->lokasi = $request->lokasi;
            $lowongan->pelaksanaan = $request->pelaksanaan;
            $lowongan->startdate = $request->startdate;
            $lowongan->enddate = $request->enddate;
            $lowongan->durasimagang = $request->durasimagang;
            $lowongan->tahapan_seleksi = $request->tahapan_seleksi;

            $lowongan->save();

            SeleksiTahap::where('id_lowongan', $id)->delete();
            foreach ($request->proses_seleksi as $key => $value) {
                SeleksiTahap::create([
                    'id_lowongan' => $lowongan->id_lowongan,
                    'tahap' => Crypt::decryptString($value['tahap']),
                    'deskripsi' => $value['deskripsi'],
                    'tgl_mulai' => $value['tgl_mulai'],
                    'tgl_akhir' => $value['tgl_akhir'],
                ]);    
            }

            DB::commit();

            return Response::success(null, 'lowongan magang successfully Updated!');
        } catch (Exception $e) {
            DB::rollback();
            return Response::errorCatch($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function status($id)
    {
        try {
            $lowongan = $this->my_lowongan_magang->first();
            $lowongan->status = ($lowongan->status) ? false : true;
            $lowongan->save();

            return response()->json([
                'error' => false,
                'message' => 'Status Lowongan Magang successfully Updated!',
                'modal' => '#modalTambahLowongan',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    private function getLowonganMagang($additional = null){
        $user = auth()->user();
        $pegawaiIndustri = $user->pegawai_industri;

        $this->my_lowongan_magang = LowonganMagang::with('total_pelamar')->where('id_industri', $pegawaiIndustri->id_industri);
        if ($additional) $this->my_lowongan_magang = $additional($this->my_lowongan_magang);
        $this->my_lowongan_magang = $this->my_lowongan_magang->get();

        return $this;
    }

    private function getPendaftarMagang($additional = null){
        $user = auth()->user();
        $pegawaiIndustri = $user->pegawai_industri;
        
        $this->my_pendaftar_magang = PendaftaranMagang::join('mahasiswa', 'mahasiswa.nim', '=', 'pendaftaran_magang.nim')
        ->leftJoin('universitas', 'universitas.id_univ', '=', 'mahasiswa.id_univ')
        ->leftJoin('fakultas', 'fakultas.id_fakultas', '=', 'mahasiswa.id_fakultas')
        ->leftJoin('program_studi', 'program_studi.id_prodi', '=', 'mahasiswa.id_prodi')
        ->leftJoin('lowongan_magang', 'lowongan_magang.id_lowongan', '=', 'pendaftaran_magang.id_lowongan')
        ->where('lowongan_magang.id_industri', $pegawaiIndustri->id_industri);

        if ($additional) $this->my_pendaftar_magang = $additional($this->my_pendaftar_magang);
        $this->my_pendaftar_magang = $this->my_pendaftar_magang->get();
        
        return $this;
    }
}
