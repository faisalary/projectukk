<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengajuanMandiri;
use App\Models\mhs_mandiri;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use App\Models\Mahasiswa;
use Exception;
use Illuminate\Support\Facades\Auth;

class KonfirmasiMagangController extends Controller
{
    public function __construct()
    {
       
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $mandiri = PengajuanMandiri::where("nim",$user->nim)->get();
        $mahasiswa = Mahasiswa::all();
        
        $nim = Mahasiswa::find($user->nim);
        $nim = $nim->nim;

        $mandiri_nim = $mandiri->pluck('nim')->toArray();

        return view('kegiatan_saya.lamaran_saya.index',  compact('mandiri','mahasiswa', 'nim', 'mandiri_nim'));

    }
    
    public function store(Request $request)
    {
    
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mandiri = PengajuanMandiri::where('id_pengajuan', $id)->first();
        return $mandiri;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $mandiri = PengajuanMandiri::where('id_pengajuan', $id)->first();

            $mandiri->nim = $request->nim;
            $mandiri->tglpeng = $request->tglpeng;
            $mandiri->nama_industri = $request->nama_industri;
            $mandiri->posisi_magang = $request->posisi_magang;
            $mandiri->jabatan = $request->jabatan;
            $mandiri->alamat_industri = $request->alamat_industri;
            $mandiri->nohp = $request->nohp;
            $mandiri->email = $request->email;
            $mandiri->startdate = $request->startdate;
            $mandiri->enddate = $request->enddate;
            $mandiri->alasan = $request->alasan;
            $mandiri->save();

            return response()->json([
                'error' => false,
                'message' => 'Data successfully Updated!',
                'modal' => '#modalDiterima',
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
        
    }

}