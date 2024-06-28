<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use App\Models\Industri;
use App\Helpers\Response;
use App\Models\Mahasiswa;
use Illuminate\Support\Str;
use App\Mail\VerifyEmailMhs;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\PegawaiIndustri;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Validator;

class RegisteredUserController extends Controller
{ 
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    { 
        try {
            $validate = ['roleregister' => 'required|in:user,mitra'];

            if ($request->roleregister == 'user') {
                $validate['nim'] = 'required|numeric|exists:mahasiswa,nim';
            } else if ($request->roleregister == 'mitra') {
                $validate['namaindustri'] = 'required';
                $validate['name'] = 'required';
                $validate['email'] = 'required|email|unique:users,email|unique:industri,email';
                $validate['notelpon'] = 'required';
            }

            $validator = Validator::make($request->all(), $validate, [
                'roleregister.required' => 'Pilih role terlebih dahulu',
                'roleregister.in' => 'Role tidak valid',
                'name.required' => 'Nama harus diisi',
                'email.required' => 'Email harus diisi',
                'email.unique' => 'Email sudah terdaftar',
                'notelpon.required' => 'No. Telepon harus diisi',
                'namaindustri.required' => 'Nama harus diisi',
                'nim.required' => 'NIM harus di isi',
                'nim.numeric' => 'Nim harus angka',
                'nim.exists' => 'Nim tidak ditemukan, hubungi LKM untuk info lebih lanjut',
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();
            $code = Str::random(60);

            if ($request->roleregister == 'user') {
                $mahasiswa = Mahasiswa::where('nim', $request->nim)->first();
                if (!$mahasiswa) return Response::error(null, 'Not Found.');

                DB::table('password_reset_tokens')->insert([
                    'email' => $mahasiswa->emailmhs,
                    'token' => $code,
                    'created_at' => now(),
                ]);

                $verifymhs = route('register.set-password', ['code' => $code]);
                Mail::to($mahasiswa->emailmhs)->send(new VerifyEmailMhs($verifymhs));
                
            } else if ($request->roleregister == 'mitra') {
                $industri = Industri::create([
                    'namaindustri' => $request->namaindustri,
                    'status' => 1,
                    'statusapprove' => 0,
                ]);

                $pegawaiIndustri = PegawaiIndustri::create([
                    'id_industri' => $industri->id_industri,
                    'namapeg' => $request->name,
                    'nohppeg' => $request->notelpon,
                    'emailpeg' => $request->email,
                    'jabatan' => 'Administrator',
                    'statuspeg' => true
                ]);

                $industri->update(['penanggung_jawab' => $pegawaiIndustri->id_peg_industri]);
            }

            DB::commit();
            return redirect()->route('register.successed');
        } catch (Exception $e) {
            return Response::errorCatch($e);
        }
    }

    public function newPassword($token) {
        return view('auth.verifikasi_akun', compact('token'));
    }

    public function storeNewPassword(Request $request) {
        $validate = [
            'token' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'password_confirmation' => ['required'],
        ];

        $validator = Validator::make($request->all(), $validate, [
            'password.required' => 'Password harus diisi',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'password.regex' => 'Password harus memiliki campuran huruf besar dan kecil, angka, dan simbol',
            'password_confirmation.required' => 'Konfirmasi password harus diisi',
            'password_confirmation.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        $passwordResetToken = DB::table('password_reset_tokens')->where('token', $request->token)->first();
        if (!$passwordResetToken) {
            return redirect()->back()->withInput()->withErrors(['token' => 'Token tidak valid'], 404);
        }

        $user = User::where('email', $passwordResetToken->email)->first();
        if (!$user) return Response::error(null, 'Not Found.');
        $user->password = Hash::make($request->password);
        $user->save();
        DB::table('password_reset_tokens')->where('email', $passwordResetToken->email)->delete();
        DB::commit();

        return redirect(url('login'));
    }

}