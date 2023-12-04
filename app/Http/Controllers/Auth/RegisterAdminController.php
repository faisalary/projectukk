<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Controller;
use App\Mail\VerifyEmail;
use App\Models\User;
use App\Models\Industri;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterAdminController extends Controller
{
    protected $redirectTo = RouteServiceProvider::HOME; 

    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    public function showRegistrationForm()
    {
        return view('auth.tambah_mitra');
    }

    public function adminregister(Request $request)
{
    // Validasi data input
    $this->validate($request, [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    // Pemeriksaan apakah admin dengan alamat email yang sama sudah ada
    $existingAdmin = User::where('email', $request->email)->first();

    if ($existingAdmin) {
        // Admin sudah ada, tampilkan pesan pop-up
        session()->flash('error', 'Admin dengan alamat email yang sama sudah ada.');
    } else {

        $code = Str::random(64);

        // Admin belum ada, tambahkan admin baru
        $admin = User::create([
            'name' => $request->name,
            'username' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'remember_token' => $code,
            'isAdmin'=>1,
            'id_industri'=> 21,
            'id_mahasiswa' => 22

        ]);
        $admin->assignRole('admin');

        $url=url('/admin/set-password/'.$code);

        if ($admin) {
        Mail::to($admin->email)->send(new VerifyEmail($url));

            // Admin berhasil ditambahkan
            session()->flash('success', 'Admin berhasil ditambahkan. silahkan Cek email anda untuk melakukan verify');
               
        } else {
            // Gagal menambahkan admin
            session()->flash('error', 'Gagal menambahkan admin.');
        }
        
    }

    return redirect()->route('admin.register'); // Redirect kembali ke halaman registrasi
}
}


