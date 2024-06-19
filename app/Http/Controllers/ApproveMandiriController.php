<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengajuanMandiri;
use Yajra\DataTables\Facades\DataTables;
use Exception;

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

    public function show(Request $request)
    {
        $mandiri = PengajuanMandiri::with("mahasiswa", "mahasiswa.prodi");
        if ($request->status == 'tertunda') $mandiri = $mandiri->where('status_approve', '0');
        elseif ($request->status == 'disetujui') $mandiri = $mandiri->where('status_approve', '1');
        elseif ($request->status == 'ditolak') $mandiri = $mandiri->where('status_approve', '2');

        return DataTables::of($mandiri->orderBy('id_pengajuan', "asc")->get())
            ->addIndexColumn()
            ->addColumn('aksi', function ($id) {
                $btn = "<a onclick='approved($(this))' class='btn-icon' data-id='{$id->id_pengajuan}' data-statusapprove=''>
                        <i class='btn-icon ti ti-file-check text-success'></i>
                        </a>
                        <a onclick='rejected($(this))' class='btn-icon' data-id='{$id->id_pengajuan}' data-statusrejected=''>
                        <i class='btn-icon ti ti-file-x text-danger'></i>
                        </a>";
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    
    // public function approved($id)
    // {
    //     try {
    //         DB::beginTransaction(); 
    //         $data = PengajuanMandiri::find($id);
            

    //         if (!$data) {
    //             throw new \Exception('Data not found.');
    //         }
    //         $data->statusapprove = 1;
    //         $data->save();

    //         return response()->json([
    //             'error' => false,
    //             'message' => 'Persetujuan berhasil.',
    //         ]);
    //         } catch (\Exception $e) {
    //             DB::rollBack();

    //             return response()->json([
    //                 'error' => true,
    //                 'message' => $e->getMessage(),
    //         ]);
    //     }
    // }
    
    public function approved(Request $request, $id)
    {
        // $request->file('dokumen_spm')->store('post');
        try {

            if (!empty($request->file('dokumen_spm'))){
                $file = $request->file('dokumen_spm');
                $filename = $file->getClientOriginalName();
                $file->move(public_path('public/post'),$filename);
                $dokumen_spm['dokumen_spm'] = $filename;
                
                $spm = PengajuanMandiri::findorfail($id);
                $spm->dokumen_spm = $filename;
                $spm->statusapprove = 1;
                $spm->save();
                
            }

            

            return response()->json([
                'error' => false,
                'message' => 'Template successfully Created!',
                
            ]);
             
            
        } catch (Exception $e) {
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