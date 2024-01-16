<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\InforamasiPribadi;
use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use App\Models\Universitas;
use Exception;
use Illuminate\Http\Request;

class ProfileMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() { 
        $fakultas = Fakultas::all();
        $prodi = ProgramStudi::all();
        $universitas = Universitas::all();
        $informasiprib = InforamasiPribadi::all();
        return view('profile.informasi_pribadi', compact('fakultas', 'prodi', 'universitas', 'informasiprib'));
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
        $mahasiswa = Mahasiswa::where('nim', $id)->first();
        return $mahasiswa;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        
        try {
            
            // dd($request->all());
            // $universitas = Universitas::where('id_univ', $id);
            // $fakultas = Fakultas::where();
            // $programstudi = ProgramStudi::where();
            $infromasiprib = InforamasiPribadi::create('id_infoprib');
            $mahasiswa = Mahasiswa::where('nim', $id)->first();
            
            $mahasiswa->nim = $request->nim;
            $mahasiswa->namamhs = $request->namamhs;
            $mahasiswa->emailmhs = $request->emailmhs;
            $mahasiswa->universitas = $request->universitas;
            $mahasiswa->alamatmahasiswa = $request->alamatmahasiswa;
            $mahasiswa->description = $request->description;
            $mahasiswa->notelpon = $request->notelpon;
            if (!empty($request->image)) {
                $mahasiswa->image = $request->image->store('post');
            }
            
            $mahasiswa->save();

            return response()->json([
                'error' => false,
                'message' => 'Data Successfully Updated!',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
