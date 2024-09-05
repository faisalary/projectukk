<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Validation\Rules;
use Exception;
use Illuminate\Validation\ValidationException;

class GantiPasswordController extends Controller
{
    public function edit(){
        return view('profile.detail-profile-dosen&mitra.ubah-password');
    }
    public function update(Request $request)
    {
        // dd($request->all());
        
        try {
            DB::beginTransaction();
             $request->validate([
                'currentPassword' => 'required',
                'newPassword' => ['required', 'confirmed', Rules\Password::defaults()],
                'newPassword_confirmation' => ['required'],
            ], [
                'currentPassword.required' => 'Password saat ini wajib diisi',
                'newPassword.required' => 'Password baru wajib diisi',
                'newPassword.min' => 'Password baru minimal 8 karakter',
                'newPassword.confirmed' => 'Konfirmasi password tidak cocok',
                'newPassword.regex' => 'Password harus memiliki campuran huruf besar dan kecil, angka, dan simbol',
                'newPassword_confirmation.required' => 'Konfirmasi password harus diisi',
                'newPassword_confirmation.confirmed' => 'Konfirmasi password tidak cocok',
            ]);
    
            $user = User::find(Auth::user()->id);
    
            if (!Hash::check($request->input('currentPassword'), $user->password)) {
                return throw new Exception('Password saat ini tidak sesuai');
            }
            throw ValidationException::withMessages([
                'currentPassword' => 'Yang anda masukan salah',
                'newPassword' => 'Password tidak pas',
                'newPassword_confirmation' => 'Password tidak'

            ]);

            $user->password = Hash::make($request->input('newPassword'));
    
            $user->save();
            DB::commit();
            return redirect()->back()->with('success', 'Data berhasil diperbarui');
        
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('success', 'Data berhasil diperbarui');
        }
}
}


