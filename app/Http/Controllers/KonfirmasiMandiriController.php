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
        $nim = Mahasiswa::find($user->nim);
        $nim = $nim->nim;
        return view('pengajuan_magang.mandiri.index',  compact('mandiri','mahasiswa', 'nim'));
    }
    
    public function store(Request $request)
    {
        try {
            $mandiri = PengajuanMandiri::create([
                'nim' => $request->nim,
                'tglpeng' => $request->tglpeng,
                'nama_industri' => $request->nama_industri,
                'posisi_magang' => $request->posisi_magang,
                'jabatan' => $request->jabatan,
                'alamat_industri' => $request->alamat_industri,
                'nohp' => $request->nohp,
                'email' => $request->email,
                'startdate' => $request->startdate,
                'enddate' => $request->enddate,
                'alasan' => '-',
                'statusapprove' => false,
            ]);

            return response()->json([
                'error' => false,
                'message' => 'Data successfully Created!',
                'url' => url('pengajuan/surat')

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
    public function show($id_univ)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function status($id)
    {
        
    }

}