<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;
use App\Models\PegawaiIndustri;
use App\Models\Universitas;
use App\Models\ProgramStudi;
use App\Models\Fakultas;
use App\Helpers\Response;

class ProfileController extends Controller
{

    public function index(Request $request){
        if (auth()->user()->hasRole('Dosen')) {
            $dosen = Dosen::select('universitas.namauniv','fakultas.namafakultas','program_studi.namaprodi','dosen.*')
            ->join('universitas', 'universitas.id_univ', '=', 'dosen.id_univ')
            ->join('fakultas', 'fakultas.id_fakultas', '=', 'dosen.id_fakultas')
            ->join('program_studi', 'program_studi.id_prodi', '=', 'dosen.id_prodi')
            ->where('id_user', auth()->user()->id)->first();
            //dd($dosen);
            if ($request->type) {
                switch ($request->type) {
                    case 'id_fakultas':
                        $data = Fakultas::select('namafakultas as text', 'id_fakultas as id')->where('id_univ', $request->selected)->get();
                        break;
                    case 'id_prodi':
                        $data = ProgramStudi::select('namaprodi as text', 'id_prodi as id')->where('id_fakultas', $request->selected)->get();
                        break;
                    case 'kode_dosen':
                        $data = Dosen::where('id_prodi', $request->selected)->get()->transform(function ($item) {
                            $result = new \stdClass();
                            $result->text = $item->kode_dosen . ' | ' . $item->namadosen;
                            $result->id = $item->kode_dosen;
                            return $result;
                        });
                        break;
                    default:
                        # code...
                        break;
                }
                return Response::success($data, 'Success');
            }
            $universitas = Universitas::all();
            return view('profile.detail-profile-dosen&mitra.index',compact('dosen','universitas'));
        } else if(auth()->user()->hasRole('Mitra')) {
            $pegawai = PegawaiIndustri::select('namapeg','nohppeg','emailpeg','jabatan')
            ->where('id_user', auth()->user()->id)->first();
            //dd($pegawai);
            return view('profile.detail-profile-dosen&mitra.index',compact('pegawai'));
        } else if(auth()->user()->hasRole('LKM')){
            return view('profile.detail-profile-dosen&mitra.index');
        }
    }

    public function ubah_password(){
        return view('profile.detail-profile-dosen&mitra.ubah-password');
    }
}
