<?php

namespace App\Http\Controllers;

use App\Models\Bahasa;
use App\Models\Fakultas;
use App\Models\InformasiPribadi;
use App\Models\InformasiTamabahan;
use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use App\Models\Universitas;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {   
        $informasiprib = InformasiPribadi::where('nim', auth()->user()->nim)->first();
        $informasitambahan = InformasiTamabahan::where('nim', auth()->user()->nim)->with('bahasa')->first();
        $mahasiswa = Mahasiswa::where('nim', auth()->user()->nim)->with('informasiprib', 'fakultas', 'univ', 'prodi', 'informasitambahan')->first();
        return view('profile.informasi_pribadi', compact('informasiprib', 'mahasiswa', 'informasitambahan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::where('nim', auth()->user()->nim)->first();
        return $mahasiswa;
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
           
            $mahasiswa = Mahasiswa::where('nim', auth()->user()->nim)->first();
    
            
            $informasiprib = InformasiPribadi::create([
                'ipk' => $request->ipk,
                'nim' => $mahasiswa->nim,
                'eprt' => $request->eprt,
                'TAK' => $request->TAK,
                'tgl_lahir' => $request->tgl_lahir,
                'headliner' => $request->headliner,
                'deskripsi_diri' => $request->deskripsi_diri,
                'profile_picture' => $request?->profile_picture??'',
                'gender' => $request->gender
            ]);
            
            $informasiprib->update([
                'ipk' => $request->ipk,
                'eprt' => $request->eprt,
                'TAK' => $request->TAK,
                'tgl_lahir' => $request->tgl_lahir,
                'headliner' => $request->headliner,
                'deskripsi_diri' => $request->deskripsi_diri,
                'profile_picture' => $request?->profile_picture??'',
                'gender' => $request->gender,
                
            ]);
            DB::commit();
            $mahasiswa->save();
            
            return response()->json([
                'error' => false,
                'message' => 'Data Successfully Updated!',
                'modal' => 'modalEditInformasi'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function editinformasi(Request $request) { 

        $mahasiswa = Mahasiswa::where('nim', auth()->user()->nim)->first();
        return $mahasiswa;
        
    }

    public function informasistore(Request $request) { 

        $mahasiswa = Mahasiswa::where('nim', auth()->user()->nim)->first();
        $informasitambahan = InformasiTamabahan::where('nim', auth()->user()->nim)->with('bahasa')->first();
        
        try{
            DB::beginTransaction();
         
            $informasitambahan = InformasiTamabahan::create([
                'nim' => $mahasiswa->nim,
                'lok_kerja' => $request->lok_kerja,
                'sosmed' => $request->sosmed,
                'id_bahasa' => $informasitambahan->bahasa->id_bahasa
            ]);


        } catch (Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
                'modal' => 'modalEditInformasiTambahan'
            ]);
        }
    }

}
