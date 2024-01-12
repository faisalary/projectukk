<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Lokasi;
use App\Models\JenisMagang;
use App\Models\SeleksiTahap;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Models\LowonganMagang;
use App\Models\PendaftaranMagang;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\LowonganMagangRequest;

class LowonganMagangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lowongan = new LowonganMagang;
        $lowongan = [
            'total' => $lowongan->count(),
            'tertunda' => $lowongan->where('applicant_status', 'tertunda')->count(),
            'diterima' => $lowongan->where('applicant_status', 'diterima')->count(),
            'ditolak' => $lowongan->where('applicant_status', 'ditolak')->count(),
        ];
        $jenismagang = JenisMagang::all();
        $lokasi = Lokasi::all();
        return view('lowongan_magang.kelola_lowongan_magang_admin.halaman_lowongan_magang', compact('lowongan', 'jenismagang', 'lokasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $seleksi = SeleksiTahap::all();
        $jenismagang = JenisMagang::all();
        $lokasi = Lokasi::all();
        return view('lowongan_magang.kelola_lowongan_magang_admin.tambah_lowongan_magang', compact('jenismagang', 'lokasi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LowonganMagangRequest $request)
    {
        try {
                $lowongan = LowonganMagang::create([
                    'id_jenismagang' => $request->jenismagang,
                    'intern_position' => $request->posisi,
                    'kuota' => $request->kuota,
                    'deskripsi' => $request->deskripsi,
                    'requirements' => $request->kualifikasi,
                    'gender' => $request->jenis,
                    'jenjang' => $request->jenjang,
                    'keterampilan' => $request->keterampilan,
                    'paid' => $request->gaji,
                    'nominal_salary' =>$request->nominal,
                    'benefitmagang' => $request->benefit,
                    'id_lokasi' => $request->lokasi,
                    'startdate' => $request->tanggal,
                    'enddate' => $request->tanggalakhir,
                    'durasimagang' => $request->durasimagang,
                    'tahapan_seleksi' => $request->tahapan,
                ]);

                // $i = 0;
                // foreach ((array) $request->mulai as $m) {
                //     $seleksi = SeleksiTahap::create([
                //         'tgl_mulai' => $request->mulai,
                //         'tgl_akhir' => $request->akhir,
                //         'deskripsi' => $request->deskripsiseleksi,
                //     ]);
                //     $i++;
                // }

                $i = 0;
                foreach ((array) $request->mulai1 as $m) {
                    $seleksi = SeleksiTahap::create([
                        'tgl_mulai' => $request->mulai1,
                        'tgl_akhir' => $request->akhir1,
                        'deskripsi' => $request->deskripsiseleksi1,
                    ]);
                    $i++;
                }

                // $i = 0;
                // foreach ((array) $request->mulai2 as $m) {
                //     $seleksi = SeleksiTahap::create([
                //         'tgl_mulai' => $request->mulai2,
                //         'tgl_akhir' => $request->akhir2,
                //         'deskripsi' => $request->deskripsiseleksi2,
                //     ]);
                //     $i++;
                // }



            return response()->json([
                'error' => false,
                'message' => 'Data Created!',
                'url' => url('/kelola/lowongan')
            ]);
        } catch (Exception $e) {
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
        $lowongan = LowonganMagang::query();
        if ($request->type) {
            if ($request->jenismagang != null) {
                $lowongan->where("id_jenismagang", $request->jenismagang, $request->type);
            } else if ($request->lokasi != null) {
                $lowongan->where("id_lokasi", $request->lokasi, $request->type);
            }
            $lowongan = $lowongan->with("jenismagang", "lokasi")->orderBy('id_jenismagang', 'desc')->get();
        }

        if (request()->type != 'total') {
            $lowongan = LowonganMagang::where('applicant_status', request()->type);
        } else {
            $lowongan = LowonganMagang::all();
        }

        return DataTables::of($lowongan)
            ->addIndexColumn()
            ->editColumn('status', function ($row) {
                if ($row->status == 0) {
                    return "<div class='text-center'><div class='badge rounded-pill bg-label-success'>" . "Active" . "</div></div>";
                } else {
                    return "<div class='text-center'><div class='badge rounded-pill bg-label-danger'>" . "Inactive" . "</div></div>";
                }
            })
            ->addColumn('action', function ($row) {
                $icon = ($row->status) ? "ti-circle-x" : "ti-circle-check";
                $color = ($row->status) ? "danger" : "success";

                $btn = "<a href='". url('kelola/lowongan/edit/'. $row->id_lowongan) ."' onclick=edit($(this)) data-id='{$row->id_lowongan}' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i></a>
                <a href='".url('kelola/lowongan/detail') ."' data-id='{$row->id_lowongan}' onclick=get($(this)) class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i></a>
                <a data-status='{$row->status}' data-id='{$row->id_lowongan}' data-url='/kelola/lowongan/status' class='btn-icon update-status text-{$color} waves-effect waves-light'><i class='tf-icons ti {$icon}'></i></a>";
                
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
        $seleksi = SeleksiTahap::create([
            'id_seleksi' => $request->id_seleksi,
            'tgl_mulai' => $lowongan->startdate,
            'tgl_akhir' => $lowongan->enddate,
            'deskripsi' => $lowongan->deskripsi,
            'id_lowongan' => $lowongan->id_lowongan
        ]);
        return view('lowongan_magang.kelola_lowongan_magang_admin.edit_lowongan_magang', compact('jenismagang', 'lokasi', 'lowongan','seleksi' ));
        

        // $lowongan = LowonganMagang::where('id_lowongan', $id)->with('jenisMagang')->first();
        // $magang = JenisMagang::first();
        // $seleksi = SeleksiTahap::where('id_Seleksi', $id)->with('deskripsi');
    }
    
    public function detail()
    {
        $lowongan = LowonganMagang::all();
        $jenismagang = JenisMagang::all();
        $lokasi = Lokasi::all();
        return view('lowongan_magang.kelola_lowongan_magang_admin.detail_lowongan_magang', compact('jenismagang', 'lokasi', 'lowongan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $lowongan = LowonganMagang::where($id)->first();
            // $lowongan = LowonganMagang::find($id);
           
            $lowongan->id_jenismagang = $request->id_jenismagang;
            $lowongan->intern_position = $request->posisi;
            $lowongan->kuota = $request->kuota;
            $lowongan->deskripsi = $request->deskripsi;
            $lowongan->requirements = $request->kualifikasi;
            $lowongan->jenjang = $request->jenjang;
            $lowongan->keterampilan = $request->keterampilan;
            $lowongan->gender = $request->jenis;
            $lowongan->paid = $request->gaji;
            $lowongan->nominal_salary = $request->gaji;
            $lowongan->benefitmagang = $request->benefit;
            $lowongan->id_lokasi = $request->lokasi;
            $lowongan->startdate = $request->tanggal;
            $lowongan->enddate = $request->tanggalakhir;
            $lowongan->durasimagang = $request->durasimagang;
            $lowongan->tahapan_seleksi = $request->tahapan;
    
            $lowongan->save();

            return redirect('lowongan');

            return response()->json([
                'error' => false,
                'message' => 'lowongan magang successfully Updated!',
                
                'url' => url('/kelola/lowongan')
                
            ]);
        } catch (Exception $e) {
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
            $lowongan = LowonganMagang::where($id)->first();
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
