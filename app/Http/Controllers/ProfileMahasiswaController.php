<?php

namespace App\Http\Controllers;

use App\Http\Requests\InfoPribRequest;
use App\Http\Requests\InformasiKeahlianReq;
use App\Http\Requests\InformasiPendidikanReq;
use App\Http\Requests\InformasiPengalamanReq;
use App\Http\Requests\InformasiTambahanReq;
use App\Models\Education;
use App\Models\Experience;
use App\Models\InformasiPribadi;
use App\Models\Mahasiswa;
use App\Models\Sertifikat;
use App\Models\Skill;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProfileMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id) { 
        $dokumen = Sertifikat::where('nim', $id)->first();
        $dokumen1 = Sertifikat::where('nim', $id)->orderby('id_sertif', 'asc')->get();
        $pengalaman = Experience::where('nim', $id)->first();
        $pengalaman1 = Experience::where('nim', $id)->get();
        $skill = Mahasiswa::where('nim', $id)->first();  
        $skill1 = Mahasiswa::where('nim', $id)->get();  
        $pendidikan = Education::where('nim' ,$id)->first();
        $informasiprib = InformasiPribadi::where('nim', $id)->first();
        $informasitambahan = Mahasiswa::where('nim', $id)->first();
        $mahasiswa = Mahasiswa::where('nim', $id)->with('informasiprib', 'fakultas', 'univ', 'prodi', 'informasitambahan')->first();
        return view('profile.informasi_pribadi', 
        compact('skill1', 'pengalaman1', 'dokumen', 'dokumen1', 'pengalaman', 'skill', 'informasiprib', 'mahasiswa', 'informasitambahan', 'pendidikan'));
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
        $mahasiswa = InformasiPribadi::where('id_infoprib', $id)->first();
        return $mahasiswa;
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InfoPribRequest $request, $id)
    {
        
        try {
            $informasiprib = InformasiPribadi::where('id_infoprib', $id)->first();
            $file = null;
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
                $informasiprib->ipk = $request->ipk;    
                $informasiprib->eprt = $request->eprt;    
                $informasiprib->TAK = $request->TAK;    
                $informasiprib->tgl_lahir = $request->tgl_lahir;    
                $informasiprib->headliner = $request->headliner;    
                $informasiprib->deskripsi_diri = $request->deskripsi_diri;    
                $informasiprib->gender = $request->gender;  
                $informasiprib->profile_picture = $file;  
                $informasiprib->save();

            } else {
                $data['nim'] = $id;
                InformasiPribadi::create($data);
            }

            
            return response()->json([
                'error' => false,
                'message' => 'Data Successfully Updated!',
                'url' => Auth::user()->nim
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function updateinformasitambahan(InformasiTambahanReq $request, $id) { 

        try{
            $informasitambahan = Mahasiswa::where('nim', $id)->first();
            
            $data1 = [
                'lok_magang' => $request->lok_magang,
                'sosmed' => $request->sosmed,
                'bahasa'=> $request->bahasa,
                'url_sosmed' => $request->url_sosmed,
            ];
            if ($informasitambahan) {
                $informasitambahan->update($data1);
            } else {
                Mahasiswa::create($data1);
            }

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

   

    public function updatependidikan(InformasiPendidikanReq $request, $id) { 
            try{
            $pendidikan = Education::where('nim', $id)->first();
            
            $data2 = [
                'name_intitutions' => $request->name_intitutions,
                'tingkat' => $request->tingkat,
                'startdate'=> $request->startdate . '-01',
                'enddate' => $request->enddate . '-01',
                'nilai' => $request->nilai,
            ];

            if ($pendidikan) {
                $pendidikan->update($data2);
            } else {
                $data2['nim'] = $id;
                Education::create($data2);
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
    public function updateskill(InformasiKeahlianReq $request, $id) { 

        try{
            $skill = Mahasiswa::where('nim', $id)->first();
            
            $keahlian = [
                'skills' => $request->skills                
            ];

            if ($skill) {
                $skill->update($keahlian);
            } else {
                Mahasiswa::create($keahlian);
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

    public function store(InformasiPengalamanReq $request, $id) { 
        
        try {
            $pengalaman = Experience::where('nim', $id)->first();
            Experience::create([
                'nim' => $id,
                'posisi' => $request->posisi,
                'jenis' => $request->jenis,
                'name_intitutions' => $request->name_institutions,
                'startdate' => $request->startdate . '-01',
                'enddate' => $request->enddate . '-01',
                'deskripsi' => $request->deskripsi,
            ]);

            return response()->json([
                'error' => false,
                'message' => 'Data Successfully Created!',
            ]);
            
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
        
    }

    public function updatepengalaman(InformasiPengalamanReq $request, $id) {


        try {
            $pengalaman = Experience::where('id_experience', $id)->first();

            $pengalaman->update([
                'posisi' => $request->posisi,
                'jenis' => $request->jenis,
                'name_intitutions' => $request->name_institutions,
                'startdate' => $request->startdate . '-01',
                'enddate' => $request->enddate . '-01',
                'deskripsi' => $request->deskripsi,
            ]);

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

    public function detailpengalaman(Request $request, $id) { 

        $pengalaman = Experience::where('nim', $id)->get();
        $skill = Skill::where('nim', $id)->get();
        return view('profile.pengalaman', compact('pengalaman', 'skill'));
    }

    public function deletepengalaman(Request $request, $id) { 

        //
    }
    
    public function storedokumen(Request $request, $id) { 

        try {
            $dokumen = Sertifikat::where('nim', $id)->first();
            // $file = $dokumen->file_sertif;
            $file = null; 
            if ($request->file('file_sertif')) {
                $file = Storage::put('file_sertif' , $request->file('file_sertif'));
            }

            Sertifikat::create([
                'nim' => $id,
                'nama_sertif' => $request->sertifikat,
                'penerbit' => $request->penerbit,
                'startdate' => $request->startdate . '-01',
                'enddate' => $request->enddate . '-01',
                'file_sertif' => $file,
                'link_sertif' => $request->link_sertif,
                'deskripsi' => $request->deskripsi,
            ]);
            
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }
    
    public function updatedokumen(Request $request, $id) { 

        $this->validate($request,[
            'file_sertif'  =>  'required|file|max:10000|mimes:doc,docx,pdf,png,jpeg,jpg',
            'link_sertif' => 'required|url',
            'deskripsi' => 'required|max:255|string'
        ]);

        try {
            $dokumen = Sertifikat::where('id_sertif', $id)->first();
                $dokumen->update([
                'nama_sertif' => $request->sertifikat,
                'penerbit' => $request->penerbit,
                'startdate' => Carbon::createFromFormat('Y-m-d', $request->startdate),
                'enddate' => Carbon::createFromFormat('Y-m-d', $request->enddate),
                'file_sertif' => $request->file_sertif,
                'link_sertif' => $request->link_sertif,
                'deskripsi' => $request->deskripsi,
            ]);
        
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
    public function detail(Request $request, $id) { 
        $dokumen = Sertifikat::where('nim', $id)->first();
        $dokumen1 = Sertifikat::where('nim', $id)->get();
        return view('profile.dokumen', compact('dokumen1', 'dokumen'));
    }

    public function deletedok(Request $request, $id) { 
        try {
            $sertifikat = Sertifikat::findOrFail($id);
            $sertifikat->delete();

            return response()->json([
                'error' => false,
                'message' => 'Sertifikat berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }
    
}
