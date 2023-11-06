<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin; 

class AdminRegisterController extends Controller
{
    protected $redirectTo = RouteServiceProvider::HOME; 

    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    public function showRegistrationForm()
    {
        return view('admin.register');
    }

    public function adminregister(Request $request)
    {
         // Validasi data input
    $this->validate($request, [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:admins',
        'password' => 'required|string|min:8|confirmed',
    ]);

    // Buat admin baru dalam database
    $admin = Admin::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // Autentikasi admin yang baru terdaftar
    Auth::guard('admin')->login($admin);

    // Redirect ke halaman dashboard atau halaman login setelah pendaftaran berhasil
    return redirect()->route('admin.dashboard');
    }
}
