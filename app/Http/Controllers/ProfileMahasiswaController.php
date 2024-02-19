<?php

namespace App\Http\Controllers;

use App\Models\Bahasa;
use App\Models\Education;
use App\Models\InformasiPribadi;
use App\Models\InformasiTamabahan;
use App\Models\Mahasiswa;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProfileMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id) {   
        $pendidikan = Education::where('nim' ,$id)->first();
        $informasiprib = InformasiPribadi::where('nim', $id)->first();
        $informasitambahan = InformasiTamabahan::where('nim', $id)->first();
        $mahasiswa = Mahasiswa::where('nim', $id)->with('informasiprib', 'fakultas', 'univ', 'prodi', 'informasitambahan')->first();
        return view('profile.informasi_pribadi', compact('informasiprib', 'mahasiswa', 'informasitambahan', 'pendidikan'));
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
    public function edit(Request $id)
    {
        $mahasiswa = Mahasiswa::where('nim', $id)->first();
        return $mahasiswa;
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'tgl_lahir' => 'required|before:today'
        ]);
        try {
            $informasiprib = InformasiPribadi::where('nim', $id)->first();
            $file = $informasiprib->profile_picture;
            if ($request->file('profile_picture')) {
                $file = Storage::put('profile-image' , $request->file('profile_picture'));
            }

            $data = [
                'ipk' => $request->ipk,
                'eprt' => $request->eprt,
                'TAK' => $request->TAK,
                'tgl_lahir' => $request->tgl_lahir,
                'headliner' => $request->headliner,
                'deskripsi_diri' => $request->deskripsi_diri,
                'profile_picture' => $file,
                'gender' => $request->gender,
            ];

            if ($informasiprib) {
                $informasiprib->update($data);
            } else {
                $data['nim'] = $id;
                InformasiPribadi::create($data);
            }
            
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

    public function editinformasi(Request $request, $id) { 

        $mahasiswa = Mahasiswa::where('nim', $id)->first();
        return $mahasiswa;
        
    }

    public function updateinformasitambahan(Request $request, $id) { 

        $this->validate($request, [
            'url_sosmed' => 'required|active_url'
        ]);
        
        try{
            DB::beginTransaction();
            $informasitambahan = InformasiTamabahan::where('nim', $id)->with('bahasa')->first();
            
            $data1 = [
                'lok_kerja' => $request->lok_kerja,
                'sosmed' => $request->sosmed,
                'id_bahasa'=> $request->bahasa,
                'url_sosmed' => $request->url_sosmed,
            ];
            if ($informasitambahan) {
                $informasitambahan->update($data1);
            } else {
                $data1['nim'] = $id;
                InformasiTamabahan::create($data1);
            }
        } catch (Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function editpedidikan(Request $request, $id) { 

        $mahasiswa = Mahasiswa::where('nim', $id)->first();
        return $mahasiswa;
        
    }

    public function updatependidikan(Request $request, $id) { 

        try{
            $pendidikan = Education::where('nim', $id)->first();
            
            $data2 = [
                'name_intitutions' => $request->namasekolah,
                'tingkat' => $request->tingkat,
                'startdate'=> $request->startdate . '-01',
                'enddate' => $request->enddate . '-01',
                'ipk' => $request->ipk,
            ];

            if ($pendidikan) {
                $pendidikan->update($data2);
            } else {
                $data2['nim'] = $id;
                Education::create($data2);
            }
        } catch (Exception $e) {
            
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
        
    }
    

}
