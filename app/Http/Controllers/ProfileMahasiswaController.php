<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Skill;
use App\Helpers\Response;
use App\Models\Education;
use App\Models\Mahasiswa;
use App\Models\Experience;
use App\Models\Sertifikat;
use Illuminate\Http\Request;
use App\Models\SosmedTambahan;
use Illuminate\Support\Carbon;
use App\Models\BahasaMahasiswa;
use App\Models\InformasiPribadi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DokumenRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\InformasiKeahlianReq;
use App\Http\Requests\InformasiTambahanReq;
use App\Http\Requests\InformasiPendidikanReq;
use App\Http\Requests\InformasiPengalamanReq;

class ProfileMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() { 
        // Menghitung persentase kelengkapan profil
        // $persentase = $this->persentase($id);
        
        $user = auth()->user();
        $mahasiswa = $user->mahasiswa->load('univ', 'fakultas', 'prodi');

        $data['mahasiswa'] = $mahasiswa;
        $data['pendidikan'] = Education::where('nim', $mahasiswa->nim)->orderBy('startdate', 'desc')->get();

        return view('profile.informasi_pribadi', $data);
    }

    public function getDataProfile(Request $request) {
        $user = auth()->user();
        
        switch ($request->section) {
            case 'modalEditInformasi':
                $data = self::getDataProfileDetail($user);
                break;
            case 'modalTambahPendidikan':
                $data = self::getDataPendidikan($user->mahasiswa->nim, $request->data_id);
                break;
            
            default:
                return Response::error(null, 'Not Found');
        }

        if (!$data) return Response::error(null, 'Not Found');

        return Response::success($data, 'Success get detail profile.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'tgl_lahir' => 'required|before:today',
            'gender' => 'required|in:Laki-Laki,Perempuan',
            'headliner' => 'required',
            'profile_picture' => 'nullable',
            'deskripsi_diri' => 'required',
        ], [
            'tgl_lahir.required' => 'Tanggal lahir wajib di isi.',
            'tgl_lahir.before' => 'Tidak boleh melebihi tanggal hari ini.',
            'gender.required' =>  'Pilih jenis kelamin terlebih dahulu.',
            'gender.in' => 'Jenis kelamin tidak valid',
            'headliner.required' => 'Headliner wajib diisi.',
            'deskripsi_diri.required' => 'Deskripsi wajib diisi.'
        ]);

        try {
            $user = auth()->user();

            $mahasiswa = Mahasiswa::where('id_user', $user->id)->first();
            if (!$mahasiswa) return Response::error(null, 'Mahasiswa not found', 404);
            
            $mahasiswa->tgl_lahir = $request->tgl_lahir;
            $mahasiswa->headliner = $request->headliner;
            $mahasiswa->deskripsi_diri = $request->deskripsi_diri;
            $mahasiswa->gender = $request->gender;
            $mahasiswa->save();

            $mahasiswa = $mahasiswa->load('univ', 'fakultas', 'prodi');
            
            return Response::success([
                'view' => view('profile/components/informasi_pribadi_detail', compact('mahasiswa'))->render()
            ], 'Informasi pribadi successfully updated.');
        } catch (Exception $e) {
            return Response::errorCatch($e);
        }
    }

    public function updatePendidikan(InformasiPendidikanReq $request) { 
        try{
            $mahasiswa = auth()->user()->mahasiswa;
            $pendidikan = Education::where('nim', $mahasiswa->nim)->where('id_education', $request->data_id)->first();
            
            $data = [
                'name_intitutions' => $request->name_intitutions,
                'tingkat' => $request->tingkat,
                'startdate'=> Carbon::createFromFormat('F Y', $request->startdate)->format('Y-m') . '-01',
                'enddate' => Carbon::createFromFormat('F Y', $request->enddate)->format('Y-m') . '-01',
                'nilai' => $request->nilai,
            ];

            if ($pendidikan) {
                $pendidikan->update($data);
            } else {
                $data['nim'] = $mahasiswa->nim;
                Education::create($data);
            }

            $pendidikan = $mahasiswa->education;
            return Response::success([
                'view' => view('profile/components/timeline-pendidikan', compact('pendidikan'))->render()
            ], 'Data Successfully Updated!');
        } catch (Exception $e) {
            return Response::errorCatch($e);
        }
    }

    public function deletePendidikan($id) {
        try {
            $mahasiswa = auth()->user()->mahasiswa;
            $education = Education::where('nim', $mahasiswa->nim)->where('id_education', $id)->first();
            if (!$education) return Response::error(null, 'Education not found', 404);
            $education->delete();

            $pendidikan = $mahasiswa->education;
            return Response::success([
                'view' => view('profile/components/timeline-pendidikan', compact('pendidikan'))->render()
            ], 'Data Successfully Deleted!');
        } catch (\Exception $e) {
            return Response::errorCatch($e);
        }
    }

    public function updateKeahlian(InformasiKeahlianReq $request) { 
        try{
            $mahasiswa = auth()->user()->mahasiswa;
            $skill = Skill::where('nim', $mahasiswa->nim)->first();
            
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

    private static function getDataProfileDetail($user) {

        $mahasiswa = Mahasiswa::join('universitas', 'universitas.id_univ', '=', 'mahasiswa.id_univ')
        ->join('fakultas', 'fakultas.id_fakultas', '=', 'mahasiswa.id_fakultas')
        ->join('program_studi', 'program_studi.id_prodi', '=', 'mahasiswa.id_prodi')
        ->where('id_user', $user->id)->first();

        return $mahasiswa;
    }

    private static function getDataPendidikan($nim, $id) {
        $education = Education::where('nim', $nim)->where('id_education', $id)->first();
        $education->startdate = Carbon::parse($education->startdate)->format('F Y');
        $education->enddate = Carbon::parse($education->enddate)->format('F Y');
        return $education;
    }

    /**
     * Display a listing of the resource.
     */
    public function persentase($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        $informasiprib = InformasiPribadi::where('nim', $id)->first();
        $pendidikan = Education::where('nim', $id)->first();

        // Pastikan bahwa setiap objek tidak null dan mengandung beberapa data
        if ($mahasiswa && $pendidikan && $informasiprib) {
            $filledColumns = 0;

            $mahasiswaColumns = [
                'nim', 
                'angkatan', 
                'id_prodi', 
                'id_univ', 
                'id_fakultas', 
                'namamhs', 
                'alamatmhs', 
                'emailmhs', 
                'nohpmhs', 
                'status',
                'eprt',
                'ipk',
                'tak',
                'lok_magang',
                'skills',
                'tunggakan_bpp'
            ];

            $infropribcolumns = [
                'tgl_lahir',
                'headliner',
                'deskripsi_diri',
                'profile_picture',
                'gender',
            ];
            
            $pendidikanColumns = [
                'name_intitutions',
                'tingkat',
                'nilai',
                'startdate',
                'enddate',
            ];

            $totalColumns = count($mahasiswaColumns) + count($pendidikanColumns) + count($infropribcolumns);

            foreach ($mahasiswaColumns as $column) {
                if (!is_null($mahasiswa->$column) && $mahasiswa->$column !== '') {
                    $filledColumns++;
                }
            }

            foreach ($infropribcolumns as $column) {
                if (!is_null($informasiprib->$column) && $informasiprib->$column !== '') {
                    $filledColumns++;
                }
            }

            foreach ($pendidikanColumns as $column) {
                if (!is_null($pendidikan->$column) && $pendidikan->$column !== '') {
                    $filledColumns++;
                }
            }
            
            $persentase = ($filledColumns / $totalColumns) * 100;
        } else {
            $persentase = 78;
        }

        return $persentase;
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
            
            if ($bahasamahasiswa){
                $bahasamahasiswa->update();
            } else {
                foreach ($request->tambahan as $t) {
                    BahasaMahasiswa::create([
                        'nim' => $id,
                        'bahasa' => $t['bahasa'],
                    ]);
                }
            }
            
            // if ($sosialmedia){
                foreach ($request->sosialmedia as $s) {
                    SosmedTambahan::create([
                        'nim' => $id,
                        'namaSosmed' => $s['sosmed'],
                        'urlSosmed' => $s['url_sosmed']
                    ]);
                }
            // } else{
            //     $sosialmedia->update();
            // }            
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
            $pengalaman->jenis = $request->jenis;
            $pengalaman->name_intitutions = $request->name_intitutions;
            $pengalaman->startdate = $request->startdate . '-01';
            $pengalaman->enddate = $request->enddate . '-01';
            $pengalaman->deskripsi = $request->deskripsi;
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
