<?php

namespace App\Http\Controllers;

use App\Http\Requests\DokumenRequest;
use App\Http\Requests\InfoPribRequest;
use App\Http\Requests\InformasiKeahlianReq;
use App\Http\Requests\InformasiPendidikanReq;
use App\Http\Requests\InformasiPengalamanReq;
use App\Http\Requests\InformasiTambahanReq;
use App\Models\Education;
use App\Models\Experience;
use App\Models\InformasiPribadi;
use App\Models\Mahasiswa;
use App\Models\BahasaMahasiswa;
use App\Models\Sertif;
use App\Models\Sertifikat;
use App\Models\Skill;
use App\Models\SosmedTambahan;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
        $bahasamahasiswa = Mahasiswa::find($id);
        $mahasiswa = Mahasiswa::where('nim', $id)->with('bahasamhs','informasiprib', 'fakultas', 'univ', 'prodi', 'informasitambahan')->first();
        return view('profile.informasi_pribadi', 
        compact('skill1', 'pengalaman1', 'dokumen', 'dokumen1', 'pengalaman', 'skill', 'informasiprib', 'mahasiswa', 'informasitambahan', 'pendidikan', 'bahasamahasiswa'));
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
                $file = Storage::put('profile-picture' , $request->file('profile_picture'));
            }
            $data = [
                'ipk' => $request->ipk,
                'eprt' => $request->eprt,
                'tak' => $request->tak,
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
                dd($data);
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
            $bahasamahasiswa = BahasaMahasiswa::where('nim', $id)->first();
            $informasitambahan = Mahasiswa::where('nim', $id)->first();
            $sosialmedia = SosmedTambahan::where('nim', $id)->first();

            if ($informasitambahan) { 
                $informasitambahan->update([
                    'nim' => $id,
                    'lok_magang' => $request->lok_magang,
                ]);
            }
            
            foreach ($request->tambahan as $t) {
                BahasaMahasiswa::create([
                    'nim' => $id,
                    'bahasa' => $t['bahasa'],
                ]);
            }
            
            if ($sosialmedia){
                $sosialmedia->update();
            } else {
                foreach ($request->sosialmedia as $s) {
                    SosmedTambahan::create([
                        'nim' => $id,
                        'namaSosmed' => $s['sosmed'],
                        'urlSosmed' => $s['url_sosmed']
                    ]);
                }
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
            $pengalaman = Experience::create([
                'nim' => $id,
                'posisi' => $request->posisi,
                'jenis' => $request->jenis,
                'name_intitutions' => $request->name_intitutions,
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

    public function editpengalaman($id){
        $pengalaman = Experience::where('id_experience', $id)->first();
        return $pengalaman;
    }

    public function updatepengalaman(InformasiPengalamanReq $request, $id) {


        try {
            $pengalaman = Experience::where('id_experience', $id)->first();
            $pengalaman->posisi = $request->posisi;
            $pengalaman->posisi =$request->jenis;
            $pengalaman->posisi =$request->name_institutions;
            $pengalaman->posisi =$request->startdate . '-01';
            $pengalaman->posisi =$request->enddate . '-01';
            $pengalaman->posisi =$request->deskripsi;
            $pengalaman->save();

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

        try {
            Experience::where('id_experience', $id)->delete();
    
            return response()->json([
                'error' => false,
                'message' => 'Pengalaman berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }
    
    public function storedokumen(DokumenRequest $request, $id) { 

        try {
            $dokumen = Sertifikat::where('nim', $id)->first();
            $file = null; 
            if ($request->file('file_sertif')) {
                $file = Storage::put('file_sertif' , $request->file('file_sertif'));
            }

            $dokumen = Sertifikat::create([
                'nim' => $id,
                'nama_sertif' => $request->nama_sertif,
                'penerbit' => $request->penerbit,
                'startdate' => $request->startdate . '-01',
                'enddate' => $request->enddate . '-01',
                'file_sertif' => $file,
                'link_sertif' => $request->link_sertif,
                'deskripsi' => $request->deskripsi,
            ]);
            $dokumen->save();
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

    public function editdokumen1($id) {
        $dokumen = Sertifikat::where('id_sertif', $id)->first();
        return $dokumen;
    }

    public function updatedokumen(Request $request, $id) { 
        try {
            
            if ($request->file('file_sertif')) {
                $file = Storage::put('file_sertif' , $request->file('file_sertif'));
            }
            $dokumen = Sertifikat::where('id_sertif', $id)->first();
            $message =  [
                'nama_sertif.required' => 'nama tidak boleh kosong',
                'nama_sertif.max' => 'nama terlalu panjang',
                'nama_sertid.min' => 'nama terlalu pendek',
                'penerbit.required' => 'penerbit tidak boleh kosong',
            ];
            $validate=[
                
                    'nama_sertif' => 'required|max:255|min:3',
                    'penerbit' => 'required|max:255|min:3',
                    'file_sertif' =>  'required|file|max:10000|mimes:doc,docx,pdf,png,jpeg,jpg',
                    'link_sertif' => 'required|url',
                    'startdate' => 'required',
                    'enddate' => 'required',
                    'deskripsi' => 'required|max:255|string'
                
            ];
            if ($dokumen->file_sertif !== null){
                unset($validate['file_sertif']);
            }
            $valid = Validator::make($request->toArray(), $validate, $message);
            if($valid->fails()){
                return response([
                    'errors' => $valid->errors(),
                    'error' => true,
                ], 422);
            }
 
            $dokumen->nama_sertif = $request->nama_sertif; 
            $dokumen->penerbit = $request->penerbit;
            if ($request->file_sertif){
                $dokumen->file_sertif = $file;
            }
            $dokumen->startdate = $request->startdate. '-01' ; 
            $dokumen->enddate = $request->enddate . '-01'; 
            $dokumen->link_sertif = $request->link_sertif; 
            $dokumen->deskripsi = $request->deskripsi;  
            $dokumen->save();
        
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
    public function detail(Request $request, $id) { 
        $dokumen = Sertifikat::where('nim', $id)->first();
        $dokumen1 = Sertifikat::where('nim', $id)->get();
        return view('profile.dokumen', compact('dokumen1', 'dokumen'));
    }

    public function deletedok(Request $request, $id) { 
        try {
            Sertifikat::where('id_sertif', $id)->delete();
    
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
