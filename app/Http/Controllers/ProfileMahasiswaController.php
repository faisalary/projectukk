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
        $mahasiswa = Mahasiswa::where('nim', auth()->user()->nim)->first();
        return $mahasiswa;
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        
        try {
            $informasiprib = InforamasiPribadi::where('nim',auth()->user()->nim)->first();
            $mahasiswa = Mahasiswa::where('nim', auth()->user()->nim)->first();
            
            if ($informasiprib !== null)
                $informasiprib = InforamasiPribadi::create([
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
            $informasiprib->ipk = $request->ipk;    
            $informasiprib->eprt = $request->eprt;    
            $informasiprib->TAK = $request->TAK;    
            $informasiprib->tgl_lahir = $request->tgl_lahir;    
            $informasiprib->headliner = $request->headliner;    
            $informasiprib->deskripsi_diri = $request->deskripsi_diri;    
            $informasiprib->gender = $request->gender;  
              
            if (!empty($request->profile_picture)) {
                $informasiprib->profile_picture = $request->profile_picture->store('post');
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
