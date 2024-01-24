<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengajuanMandiri;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use App\Models\Mahasiswa;
use Exception;
use Illuminate\Support\Facades\Auth;

class KonfirmasiMandiriController extends Controller
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
        $user = auth()->user();
        $data =[
            'mahasiswa' => Mahasiswa::find($user->nim)
            
        ];
        return view('pengajuan_magang.mandiri.index', compact('mandiri','mahasiswa', $data));
    }
    
    public function store(Request $request)
    {
        try {

            $mandiri = PengajuanMandiri::create([
                'tglpeng' => $request->tglpeng,
                'nama_industri' => $request->nama_industri,
                'posisi_magang' => $request->posisi_magang,
                'jabatan' => $request->jabatan,
                'alamat_industri' => $request->alamat_industri,
                'nohp' => $request->nohp,
                'email' => $request->email,
                'startdate' => $request->startdate,
                'enddate' => $request->enddate,
                'statusapprove' => true,
            ]);

            return response()->json([
                'error' => false,
                'message' => 'Data successfully Created!',
                'modal' => '#modalAjukan',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }
}