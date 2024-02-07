<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\JenisMagang;
use App\Models\Lokasi;
use App\Models\LowonganMagang;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LowonganMagangLkmController extends Controller
{
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
         $lokasi = Lokasi::all();
         $prodi = ProgramStudi::all();
         $fakultas = Fakultas::all();
        
         return view('lowongan_magang.kelola_lowongan_magang_admin.halaman_lowongan_magang_admin', 
         compact('lowongan', 'jenismagang', 'lokasi', 'prodi', 'fakultas'));
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

                $btn = "<a href='" . url('kelola/lowongan/edit/' . $row->id_lowongan) . "' onclick=edit($(this)) data-id='{$row->id_lowongan}' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i></a>
                 <a href='" . url('kelola/lowongan/detail/' . $row->id_lowongan) . "' onclick=detail($(this)) data-id='{$row->id_lowongan}' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i></a>
                 <a data-status='{$row->status}' data-id='{$row->id_lowongan}' data-url='/kelola/lowongan/status' class='btn-icon update-status text-{$color} waves-effect waves-light'><i class='tf-icons ti {$icon}'></i></a>";

                return $btn;
            })
            ->addColumn('tanggal', function ($row) {
                return $row->startdate . " <br> " . $row->enddate;
            })
            ->rawColumns(['action', 'status', 'tanggal'])

            ->make(true);
    }
} 
