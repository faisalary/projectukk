<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\JenisMagang;
use App\Models\Lokasi;
use App\Models\LowonganMagang;
use App\Models\LowonganProdi;
use App\Models\ProgramStudi;
use App\Models\SeleksiTahap;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class LowonganMagangLkmController extends Controller
{
    public function __construct(){

    $this->middleware(['role:superadmin']);
}
     /**
     * Display a listing of the resource.
     */
    
     public function index(Request $id)
     {
         // $user = Auth::user()->id;
         $lowongan = new LowonganMagang();
         $lowongan = [
             'total' => $lowongan->count(),
             'tertunda' => $lowongan->where('statusaprove', 'tertunda')->count(),
             'diterima' => $lowongan->where('statusaprove', 'diterima')->count(),
             'ditolak' => $lowongan->where('statusaprove', 'ditolak')->count(),
         ];
         $jenismagang = JenisMagang::all();
         $prodi = ProgramStudi::all();
         $fakultas = Fakultas::all();
        
         return view('lowongan_magang.kelola_lowongan_magang_admin.halaman_lowongan_magang_admin', 
         compact('lowongan', 'jenismagang', 'prodi', 'fakultas'));
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
            } else if ($request->prodi != null) {
                $lowongan->where("id_prodi", $request->prodi, $request->type);
            } else if ($request->fakultas != null) {
                $lowongan->where("id_fakultas", $request->fakultas, $request->type);
            } else if($request->type != 'total'){
                $lowongan->where("statusaprove", $request->type);
            }
        }
        $lowongan = $lowongan->with("jenismagang", "lokasi", "prodi", "fakultas", "industri")->orderBy('id_jenismagang', 'desc')->get();


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

                $btn = "<a href='" . url('kelola/lowongan/lkm/edit/' . $row->id_lowongan) . "' onclick=edit($(this)) data-id='{$row->id_lowongan}' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i></a>
                 <a href='" . url('kelola/lowongan/lkm/detail/' . $row->id_lowongan) . "' onclick=detail($(this)) data-id='{$row->id_lowongan}' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i></a>
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

    public function detail($id)
    {
        $lowongan = LowonganMagang::where('id_lowongan', $id)->with('mahasiswa', 'fakultas', 'prodi', 'lokasi', 'industri')->first();
        $seleksi = SeleksiTahap::where('id_lowongan', $id)->get();
        $fakultas = Fakultas::all();
        $prodi = ProgramStudi::all();
        // $prodilowongan = LowonganProdi::first();
        if (!$lowongan) {
            return redirect()->route('lowongan-magang.index');
        }
        return view('lowongan_magang.kelola_lowongan_magang_admin.detail_lowongan_magang', compact('lowongan', 'seleksi', 'fakultas', 'prodi', 'fakultas'));
    }

    public function approved(Request $request, $id)
    {
        try {
            $data = LowonganMagang::find($id);
            $prodi = ProgramStudi::all();
            // dd($prodi);
            // $datahasprodi = LowonganProdi::create([
            //     'id_prodi' =>  $request->prodi[
            //         ''
            //     ],
            //     'id_lowongan' => $data->id_lowongan
            // ]);
                                
            if (!$data) {
                throw new \Exception('Lowongan tidak ditemukan.');
            }
            
            $data->statusaprove = 'diterima';

            $data->save();
            DB::commit();

            return response()->json([
                'error' => false,
                'message' => 'Persetujuan berhasil.',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function rejected($id, Request $request)
    {
        try{
            $data=LowonganMagang::find($id);
            if (!$data) {
                    throw new \Exception('Lowongan tidak ditemukan.');
                }

                $data->alasantolak = $request->alasan;
                $data->statusaprove = 'ditolak';

                $data->save();
                DB::commit();

                return response()->json([
                    'error' => false,
                    'message' => 'Penolakan berhasil.',
                ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

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
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $lokasi = Lokasi::where('id_lokasi', $id)->first();
            $prodi = ProgramStudi::where('id_prodi', $id)->first();
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
            $lowongan->lokasi = $request->$lokasi->id_lokasi;
            $lowongan->startdate = $request->tanggal;
            $lowongan->enddate = $request->tanggalakhir;
            $lowongan->durasimagang = $request->durasimagang;
            $lowongan->tahapan_seleksi = $request->tahapan;
            $lowongan->id_prodi = $prodi->namaprodi;
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
                'url' => url('/kelola/lowongan/lkm/')

            ]);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    } 
}