<?php

namespace App\Http\Controllers;

use stdClass;
use Exception;
use App\Helpers\Response;
use App\Models\JenisMagang;
use App\Models\ProgramStudi;
use App\Models\SeleksiTahap;
use Illuminate\Http\Request;
use App\Models\LowonganMagang;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Enums\LowonganMagangStatusEnum;
use Yajra\DataTables\Facades\DataTables;
use App\Enums\PendaftaranMagangStatusEnum;
use App\Http\Requests\LowonganMagangRequest;

class LowonganMagangController extends Controller
{

    public function __construct(){
        $this->my_lowongan_magang = null;
    }

    public function indexInformasi(Request $request) {
        return view('company.lowongan_magang.informasi_lowongan.informasi_lowongan');
    }

    public function showInformasi(Request $request) {
        $this->getLowonganMagang(function ($query) {
            return $query->where('statusaprove', LowonganMagangStatusEnum::APPROVED);
        });

        $lowonganMagang = $this->my_lowongan_magang;

        $validSteps = [
            PendaftaranMagangStatusEnum::APRROVED_SELEKSI_TAHAP_1 => 1,
            PendaftaranMagangStatusEnum::APRROVED_SELEKSI_TAHAP_2 => 2,
            PendaftaranMagangStatusEnum::APRROVED_SELEKSI_TAHAP_3 => 3,
        ];

        $lowongan_magang = $lowonganMagang->map(function ($item) use ($validSteps) {
            $total_pelamar = $item->total_pelamar;

            $item->total_pelamar = $total_pelamar->count();
            $item->screening = $total_pelamar->where('current_step', PendaftaranMagangStatusEnum::APPROVED_BY_KAPRODI)->count();
            $item->proses_seleksi = $total_pelamar->whereIn('current_step', 
                array_diff(PendaftaranMagangStatusEnum::getConstants(), [
                    'rejected_by_doswal', 'rejected_by_kaprodi', 'rejected_seleksi_tahap_1', 'rejected_seleksi_tahap_2',
                    'rejected_seleksi_tahap_3', 'rejected_penawaran'
                ])
            )->count();
    
            $item->penawaran = $total_pelamar->filter(function ($data) use ($validSteps) {
                return isset($validSteps[$data->current_step]) && ($data->tahapan_seleksi + 1) == $validSteps[$data->current_step];
            })->count();

            $item->approved = $total_pelamar->where('current_step', PendaftaranMagangStatusEnum::APPROVED_PENAWARAN)->count();
            $rejected = [
                PendaftaranMagangStatusEnum::REJECTED_BY_DOSWAL,
                PendaftaranMagangStatusEnum::REJECTED_BY_KAPRODI,
                PendaftaranMagangStatusEnum::REJECTED_SELEKSI_TAHAP_1,
                PendaftaranMagangStatusEnum::REJECTED_SELEKSI_TAHAP_2,
                PendaftaranMagangStatusEnum::REJECTED_SELEKSI_TAHAP_3,
                PendaftaranMagangStatusEnum::REJECTED_PENAWARAN,
            ];
    
            $item->rejected = $total_pelamar->filter(function ($data) use ($rejected) {
                return in_array($data->current_step, $rejected);
            })->count();

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
            $this->getLowonganMagang(function ($query) use ($id) {
                return $query->where('id_lowongan', $id);
            });

            if (!$this->my_lowongan_magang) return Response::error(null, 'Lowongan Magang Not Found');

            $this->my_lowongan_magang->first()->update([
                'date_confirm_closing' => Carbon::parse($request->date)->format('Y-m-d')
            ]);

            return Response::success(null, 'Berhasil memperbarui Tanggal Batas Konfirmasi!');
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

        $id_industri = auth()->user()->pegawai_industri->id_industri;
        $lowongan = LowonganMagang::with("jenismagang", "lokasi", "prodi", "fakultas", "industri")->where('id_industri', $id_industri);

        if ($request->type != 'total') {
            $lowongan =  $lowongan->where('statusaprove', $request->type);
        }

        $lowongan = $lowongan->orderBy('id_jenismagang', 'asc')->get();
        
        return DataTables::of($lowongan)
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
                        <a data-status='{$row->status}' data-id='{$row->id_lowongan}' data-url='/kelola/lowongan/mitra/status' class='cursor-pointer mx-1 update-status text-{$color}'><i class='tf-icons ti {$icon}'></i></a></div>";
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
        $lowongan = LowonganMagang::with(['jenisMagang'])->where('id_lowongan', $id)->first();
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
        $lowongan = LowonganMagang::where('id_lowongan', $id)->with('seleksi_tahap', 'industri')->first()->dataTambahan('jenjang_pendidikan', 'program_studi');
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

            $lowongan = LowonganMagang::where('id_lowongan', $id)->first();

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
            $lowongan = LowonganMagang::where('id_lowongan', $id)->first();
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
}
