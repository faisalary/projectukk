<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengajuanMandiri;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Support\Facades\DB;
use App\Models\Mahasiswa;

class ApproveMandiriController extends Controller
{
    public function __construct()
    {
       
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mandiri = PengajuanMandiri::all();
        $mahasiswa = Mahasiswa::all();
        return view('mandiri.approve_mandiri.index', compact('mandiri','mahasiswa'));
    }

    // public function show(Request $request)
    // {
    //     $mandiri = PengajuanMandiri::with("mahasiswa", "mahasiswa.prodi")->orderBy('id_pengajuan', "asc");
        
    //     if($request->type){
    //         $mandiri = $mandiri->where('status', $request->type);
    //     }
       

    // return DataTables::of($mandiri->get())
    //     ->addIndexColumn()
    //     ->make(true);
    // }

    public function show($statusapprove)
    {
        $mandiri = PengajuanMandiri::where("statusapprove",$statusapprove)->orderBy("nama_industri")->get();
        $mandiri = PengajuanMandiri::with("mahasiswa", "mahasiswa.prodi")->orderBy('id_pengajuan', "asc");
        

    return DataTables::of($mandiri)
        ->addIndexColumn()
        ->addColumn('aksi', function ($id) {
            $btn = "<a onclick='approved($(this))' class='btn-icon' data-id='{$id->id_pengajuan}' data-statusapprove='{$id->statusapprove}'>
                    <i class='btn-icon ti ti-file-check text-success'></i>
                    </a>
                    <a onclick='rejected($(this))' class='btn-icon' data-id='{$id->id_pengajuan}' data-statusrejected='{$id->rejected}'>
                    <i class='btn-icon ti ti-file-x text-danger'></i>
                    </a>";
            return $btn;
        })
        ->rawColumns(['aksi'])
        ->make(true);
    }

    
    public function approved($id)
    {
        try {
            DB::beginTransaction(); 
            $data = PengajuanMandiri::find($id);
            

            if (!$data) {
                throw new \Exception('Data not found.');
            }
            $data->statusapprove = 1;
            $data->save();

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
        $data=PengajuanMandiri::find($id);
        $data->statusapprove='2';
        $data->save();
        $alasan = $request->input('alasan');
        return redirect()->back();
    }

}