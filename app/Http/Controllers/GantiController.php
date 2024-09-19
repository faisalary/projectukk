<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Models\Dosen;
use App\Models\Fakultas;
use App\Models\PegawaiIndustri;
use App\Models\ProgramStudi;
use App\Models\Universitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Exception;


class GantiController extends Controller
{
    public function ganti()
    {
        return view('profile.detail-profile-dosen&mitra.ganti');
    }
    public function store(Request $request){
        $request->validate([
            'foto' => 'required|mimes:jpeg,jpg,png',
        ],[
            'foto.required' => 'Foto Wajib',
            'foto.mimes' => 'Foto di perbolehkan hanya jpg,jpeg,png',
        ]);

       try {
        $foto_file = $request->file('foto');
        $foto_ekstensi = $foto_file->extension();
        $foto_nama = date ('ymdhis')."." .$foto_ekstensi;
        $request->file('foto')->storeAs('foto/' . $foto_nama);

        $data =[
            'foto' => $foto_nama,
        ];
            $user = User::where('id', Auth::user()->id)->first();

            $user->update($data);
            return response()->json([
                'message' => 'Update Foto Profil Berhasil',
                'error' => false,
                'showConfirmButton' => false,
            ], 200);
       } catch(Exception $e) {
        return Response::errorCatch($e);
       }
    }
    public function hapus()
    {
        try {
            $user = Auth::user();
            if ($user->foto) {
                Storage::delete('storage/foto/' . $user->foto);
                $user->foto = null;
                $user->save();
            }

            return Response::success(null, 'Foto berhasil dihapus.');
        } catch (\Exception $e) {
            return Response::errorCatch($e);
        }
}


    public function update(Request $request)
{
    try {
        $user = Auth::user();

        $validationRules = [];
        $validationMessages = [];

        if ($user->hasRole('Dosen')) {
            $validationRules['nohpdosen'] = 'required|string|max:15';
            $validationRules['emaildosen'] = 'required|email|max:255';
            $validationRules['namadosen'] = 'required|string|max:255';

            $validationMessages['nohpdosen.required'] = 'No HP dosen wajib diisi';
            $validationMessages['emaildosen.required'] = 'Email dosen wajib diisi';
            $validationMessages['namadosen.required'] = 'Nama dosen wajib diisi';
        }

        if ($user->hasRole('Mitra')) {
            $validationRules['nohppeg'] = 'required|string|max:15';
            $validationRules['emailpeg'] = 'required|email|max:255';

            $validationMessages['nohppeg.required'] = 'No HP mitra wajib diisi';
            $validationMessages['emailpeg.required'] = 'Email mitra wajib diisi';
        }

        if ($user->hasRole('LKM')) {
            $validationRules['email'] = 'required|email|max:255';
            $validationRules['username'] = 'required|string|max:255';

            $validationMessages['email.required'] = 'Email LKM wajib diisi';
            $validationMessages['username.required'] = 'Username LKM wajib diisi';
        }

        $request->validate($validationRules, $validationMessages);

        if ($user->hasRole('Dosen')) {
            $dosen = $user->dosen;
            if ($dosen) {
                $dosen->nohpdosen = $request->input('nohpdosen');
                $dosen->emaildosen = $request->input('emaildosen');
                $dosen->namadosen = $request->input('namadosen');
                $dosen->save();
            }
            $user->email = $request->input('emaildosen');
            $user->save();

        } elseif ($user->hasRole('Mitra')) {
            $mitra = $user->pegawai_industri;
            if ($mitra) {
                $mitra->nohppeg = $request->input('nohppeg');
                $mitra->emailpeg = $request->input('emailpeg');
                $mitra->save();
            }
            $user->email = $request->input('emailpeg');
            $user->save();

        } elseif ($user->hasRole('LKM')) {
            $lkm = $user;
            $user->email = $request->input('email');
            $user->username = $request->input('username');
            $user->save();
        }

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    } catch (Exception $e) {
        return Response::errorCatch($e);
    }
}

    public function show(Request $request) {
        try {

            $user = Auth::user();
            $data = null;

            if ($user->hasRole('Dosen')) {
                $data = Dosen::select(
                    'universitas.namauniv as id_univ', 'fakultas.namafakultas as id_fakultas', 'program_studi.namaprodi as id_prodi',
                    'dosen.namadosen', 'dosen.nohpdosen', 'dosen.emaildosen'
                )
                ->join('universitas', 'universitas.id_univ', 'dosen.id_univ')
                ->join('fakultas', 'fakultas.id_fakultas', 'dosen.id_fakultas')
                ->join('program_studi', 'program_studi.id_prodi', 'dosen.id_prodi')
                ->where('dosen.id_user', $user->id)->first();

            } else if($user->hasRole('Mitra')) {
                $data = PegawaiIndustri::select(
                    'namapeg', 'nohppeg', 'emailpeg', 'jabatan'
                )
                ->where('id_user', $user->id)->first();
            } else if ($user->hasRole('LKM') || $detailProfile = $user->hasRole('Super Admin')) {
                $data = [
                    'email' => $user->email,
                    'name' => $user->name
                ];
            }

            return Response::success($data, 'Success');
        } catch (Exception $e) {
            return Response::errorCatch($e);
        }
    }
}
