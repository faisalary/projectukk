<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthAdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login'); // Menampilkan halaman login admin
    }

    public function login(Request $request)
    {
        // Logika validasi dan otentikasi admin
        $credentials = $request->only('name', 'email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('admin.dashboard.index'); // Redirect jika berhasil login
        } else{
            return back()->withInput()->withErrors(['email' => 'Email atau password salah']); // Redirect dengan pesan kesalahan jika login gagal
        }
    }

    public function dashboard()
    {
        return view('admin.dashboard.index'); // Menampilkan halaman dashboard admin
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login'); // Redirect ke halaman login setelah logout
    }
}
