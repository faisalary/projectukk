<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Lokasi;
use App\Models\JenisMagang;
use App\Models\SeleksiTahap;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Models\LowonganMagang;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\LowonganMagangRequest;
use App\Models\Fakultas;
use App\Models\Industri;
use App\Models\ProgramStudi;
use Illuminate\Support\Facades\Auth;

class LowonganMagangController extends Controller
{

    public function __construct(){

        $this->middleware(['role:admin']);
    }

    /** 
     * Display a listing of the resource.
     */
    public function index(Request $request, $id)
    {
        $lowongan = new LowonganMagang;
        $lowongan = [
            'total' => $lowongan->count(),
            'tertunda' => $lowongan->where('statusaprove', 'tertunda')->count(),
            'diterima' => $lowongan->where('statusaprove', 'diterima')->count(),
            'ditolak' => $lowongan->where('statusaprove', 'ditolak')->count(),
        ];
        $jenismagang = JenisMagang::all();
        $prodi = ProgramStudi::all();
        $fakultas = Fakultas::all();
        $industri = Industri::where('id_industri', $id)->first();
        return view('company.lowongan_magang.halaman_lowongan_magang_mitra', 
        compact('lowongan', 'jenismagang', 'prodi', 'fakultas','industri'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, $id)
    {
        $seleksi = SeleksiTahap::all();
        $jenismagang = JenisMagang::all();
        $fakultas = Fakultas::all();
        $prodi = ProgramStudi::where('id_prodi')->get();
        return view('lowongan_magang.kelola_lowongan_magang_admin.tambah_lowongan_magang', compact('jenismagang', 'seleksi', 'prodi', 'fakultas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LowonganMagangRequest $request)
    {
        DB::beginTransaction();
        try {
            $industri = Industri::where('id_industri', Auth::user()->id_industri)->first();
     
            $lowongan = LowonganMagang::create([
                'id_jenismagang' => $request->jenismagang,
                'intern_position' => $request->posisi,
                'kuota' => $request->kuota,
                'deskripsi' => $request->deskripsi,
                'requirements' => $request->kualifikasi,
                'gender' => $request->jenis,
                'jenjang' => $request->jenjang,
                'keterampilan' => $request->keterampilan,
                'nominal_salary' => $request->nominal,
                'benefitmagang' => $request->benefit,
                'id_industri' => $industri->id_industri,
                'startdate' => $request->tanggal,
                'enddate' => $request->tanggalakhir,
                'durasimagang' => $request->durasimagang,
                'tahapan_seleksi' => $request->tahapan,
                'id_fakultas' => $request->fakultas,
                'lokasi' => $request->lokasi,
                'statusaprove' => 'tertunda'
            ]);
            $i = 0;
            foreach ((array) $request->mulai as $m) {
                if ($m != null) {
                    SeleksiTahap::create([
                        'id_lowongan' => $lowongan->id_lowongan,
                        'tgl_mulai' => $request->mulai[$i],
                        'tgl_akhir' => $request->akhir[$i],
                        'deskripsi' => $request->deskripsiseleksi[$i],
                    ]);
                }
                $i++;
            }
            // dd($lowongan);
            DB::commit();

            return response()->json([
                'error' => false,
                'message' => 'Data Created!',
                'url' => url('/kelola/lowongan/mitra', Auth::user()->id_industri)
            ]);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     */

    public function show(Request $request)
    {
        $lowongan = LowonganMagang::with("jenismagang", "lokasi", "prodi", "fakultas", "industri")->where('id_industri', Auth::user()->id_industri);
        if ($request->type =="tertunda") {
            $lowongan =  $lowongan->where('statusaprove', 'tertunda');        
        } elseif ($request->type == 'diterima'){
            $lowongan =  $lowongan->where('statusaprove', 'diterima');
        }elseif ($request->type == 'ditolak'){
            $lowongan =  $lowongan->where('statusaprove', 'diterima');
        }
        $lowongan = $lowongan
        ->orderBy('id_jenismagang', 'asc')
        ->get();
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
                $color = ($row->status) ? "danger" : "success";
        
                $btn = "<a href='" . url('kelola/lowongan/mitra/edit/' . $row->id_lowongan) . "' onclick=edit($(this)) data-id='{$row->id_lowongan}' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i></a>
                        <a href='" . url('kelola/lowongan/mitra/detail/' . $row->id_lowongan) . "' onclick=detail($(this)) data-id='{$row->id_lowongan}' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i></a>
                        <a data-status='{$row->status}' data-id='{$row->id_lowongan}' data-url='/kelola/lowongan/mitra/status' class='btn-icon update-status text-{$color} waves-effect waves-light'><i class='tf-icons ti {$icon}'></i></a>";
                return $btn;
            })
            ->addColumn('tanggal', function ($row) {
                return $row->startdate . " <br> " . $row->enddate;
            })
            ->rawColumns(['action', 'status', 'tanggal'])
            ->make(true);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $lowongan = LowonganMagang::where('id_lowongan', $id)->with('jenisMagang')->first();
        $jenismagang = JenisMagang::all();
        $lokasi = Lokasi::all();
        $prodi = ProgramStudi::all();
        $fakultas = Fakultas::all();
        $seleksi = SeleksiTahap::where('id_lowongan', $id)->get();
        return view('lowongan_magang.kelola_lowongan_magang_admin.edit_lowongan_magang', compact('jenismagang', 'lokasi', 'lowongan', 'seleksi', 'prodi', 'fakultas'));
    }

    public function detail($id)
    {
        $lowongan = LowonganMagang::where('id_lowongan', $id)->with('mahasiswa', 'fakultas', 'prodi', 'lokasi', 'industri')->first();
        $seleksi = SeleksiTahap::where('id_lowongan', $id)->get();
        $fakultas = Fakultas::all();
        // $prodi = ProgramStudi::get();
        if (!$lowongan) {
            return redirect()->route('lowongan-magang.index');
        }
        return view('lowongan_magang.kelola_lowongan_magang_admin.detail_lowongan_magang', compact('lowongan', 'seleksi', 'fakultas','fakultas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $lowongan = LowonganMagang::where('id_lowongan', $id)->first();

            $lowongan->id_jenismagang = $request->id_jenismagang;
            $lowongan->intern_position = $request->posisi;
            $lowongan->kuota = $request->kuota;
            $lowongan->deskripsi = $request->deskripsi;
            $lowongan->requirements = $request->kualifikasi;
            $lowongan->jenjang = $request->jenjang;
            $lowongan->keterampilan = $request->keterampilan;
            $lowongan->gender = $request->jenis;
            $lowongan->paid = $request->gaji;
            $lowongan->nominal_salary = $request->nominal;
            $lowongan->benefitmagang = $request->benefit;
            $lowongan->id_lokasi = $request->lokasi;
            $lowongan->startdate = $request->tanggal;
            $lowongan->enddate = $request->tanggalakhir;
            $lowongan->durasimagang = $request->durasimagang;
            $lowongan->tahapan_seleksi = $request->tahapan;
            $lowongan->id_fakultas = $request->fakultas;
            if ($lowongan->save()) {
                $seleksi = SeleksiTahap::where('id_lowongan', $id)->delete();
                $i = 0;
                foreach ((array) $request->mulai as $m) {
                    if ($m != null) {
                        SeleksiTahap::create([
                            'id_lowongan' => $lowongan->id_lowongan,
                            'tgl_mulai' => $request->mulai[$i],
                            'tgl_akhir' => $request->akhir[$i],
                            'deskripsi' => $request->deskripsiseleksi[$i],
                        ]);
                    }
                    $i++;
                }
            }

            DB::commit();

            return response()->json([
                'error' => false,
                'message' => 'lowongan magang successfully Updated!',
                'url' => url('/kelola/lowongan/mitra/', Auth::user()->id_industri)

            ]);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
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
}
