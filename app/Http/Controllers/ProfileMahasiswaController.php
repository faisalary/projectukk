<?php

namespace App\Http\Controllers;

use App\Models\Bahasa;
use App\Models\Education;
use App\Models\Experience;
use App\Models\InformasiPribadi;
use App\Models\InformasiTamabahan;
use App\Models\Mahasiswa;
use App\Models\Sertifikat;
use App\Models\Skill;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
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
        $skill = Skill::where('nim', $id)->first();  
        $pendidikan = Education::where('nim' ,$id)->first();
        $informasiprib = InformasiPribadi::where('nim', $id)->first();
        $informasitambahan = InformasiTamabahan::where('nim', $id)->first();
        $mahasiswa = Mahasiswa::where('nim', $id)->with('informasiprib', 'fakultas', 'univ', 'prodi', 'informasitambahan')->first();
        return view('profile.informasi_pribadi', compact('dokumen', 'dokumen1', 'pengalaman', 'skill', 'informasiprib', 'mahasiswa', 'informasitambahan', 'pendidikan'));
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
            'tgl_lahir' => 'required|before:today',
            'ipk' => 'required|numeric|min:0|max:4'
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

   

    public function updatependidikan(Request $request, $id) { 
        $this->validate($request, [
            'nilai' => 'required|numeric|between:0,99.99'
        ]);


        try{
            $pendidikan = Education::where('nim', $id)->first();
            
            $data2 = [
                'name_intitutions' => $request->namasekolah,
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
        } catch (Exception $e) {
            
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
        
    }
    public function updateskill(Request $request, $id) { 

        try{
            $skill = Skill::where('nim', $id)->first();
            
            $keahlian = [
                'skills' => $request->skills                
            ];

            if ($skill) {
                $skill->update($keahlian);
            } else {
                $keahlian['nim'] = $id;
                Skill::create($keahlian);
            }
        } catch (Exception $e) {
            
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
        
    }

    public function store(Request $request, $id) { 
        
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
            
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
        
    }

    public function updatepengalaman(Request $request, $id) {

        $this->validate($request,[
            
        ]);

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

        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function deletepengalaman(Request $request, $id) { 

        //
    }
    
    public function storedokumen(Request $request, $id) { 

        try {
            $dokumen = Sertifikat::where('nim', $id)->first();

            Sertifikat::create([
                'nim' => $id,
                'nama_sertif' => $request->sertifikat,
                'penerbit' => $request->penerbit,
                'startdate' => $request->startdate . '-01',
                'enddate' => $request->enddate . '-01',
                'file_sertif' => $request->file_sertif,
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
                'message' => 'Dokumen berhasil diperbarui',
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
    
}
