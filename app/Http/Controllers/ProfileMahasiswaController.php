<?php

namespace App\Http\Controllers;

use App\Models\Bahasa;
use App\Models\Fakultas;
use App\Models\InforamasiPribadi;
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
        
        $informasiprib = InforamasiPribadi::where('nim', auth()->user()->nim)->first();
        $mahasiswa = Mahasiswa::where('nim', auth()->user()->nim)->with('informasiprib', 'fakultas', 'univ', 'prodi')->first();
        return view('profile.informasi_pribadi', compact('informasiprib', 'mahasiswa'));
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
        $informasiprib = InforamasiPribadi::where('nim', auth()->user()->nim)->first();
        $mahasiswa = Mahasiswa::where('nim', auth()->user()->nim)->with('informasiprib', 'fakultas', 'univ', 'prodi')->first();
        return view('profile.informasi_pribadi', compact('informasiprib', 'mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        
        try {
            $mahasiswa = Mahasiswa::where('nim', auth()->user()->nim)->with('informasiprib', 'fakultas', 'univ', 'prodi')->first();
            $infromasiprib = InforamasiPribadi::where('di_infoprib', $id)->first();
            
            if ($infromasiprib !== null)
                $infromasiprib = InforamasiPribadi::create([
                    'ipk' => $request->ipk,
                    'nim' => $mahasiswa->nim,
                    'eprt' => $request->eprt,
                    'TAK' => $request->TAK,
                    'tgl_lahir' => $request->tgl_lahir,
                    'headliner' => $request->headliner,
                    'deskripsi_diri' => $request->deskripsi_diri,
                    'profile_picture' => $request->profile_picture,
                    'gender' => $request->gender
                ]);
            
            $infromasiprib->ipk = $request->ipk;    
            $infromasiprib->eprt = $request->eprt;    
            $infromasiprib->TAK = $request->TAK;    
            $infromasiprib->tgl_lahir = $request->tgl_lahir;    
            $infromasiprib->headliner = $request->headliner;    
            $infromasiprib->deskripsi_diri = $request->deskripsi_diri;    
            $infromasiprib->gender = $request->gender;  
              
            if (!empty($request->profile_picture)) {
                $infromasiprib->profile_picture = $request->profile_picture->store('post');
            }
            DB::commit();
            $mahasiswa->save();
            
            return response()->json([
                'error' => false,
                'message' => 'Data Successfully Updated!',
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function informasistore(Request $request) { 

         $this->validate($request, [
            'bahasa' => 'required',
        ]);
        try{
            DB::beginTransaction();
            $bahasa = Bahasa::create([
            'bahasa' => $request->bahasa,
        ]);
        // dd($bahasa);
        $sosmed = InformasiTamabahan::create([
            'lok_kerja' => $request->lok_kerja,
            'sosmed' => $request->sosmed,
            'id_bahasa' => $bahasa->bahasa
        ]);

        } catch (Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

}
