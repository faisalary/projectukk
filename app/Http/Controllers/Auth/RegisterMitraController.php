<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Controller;
use App\Mail\VerifyEmail;
use App\Models\User;
use App\Models\Industri;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Exception;
use Ramsey\Uuid\Uuid;

class RegisterMitraController extends Controller
{
    protected $redirectTo = RouteServiceProvider::HOME; 


    public function showRegistrationForm()
    {
        $industri = Industri::all();
        return view('auth.register_mitra');
    }

    public function store(Request $request)
    {
        // Validasi data input
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'namaindustri' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
        ]);
        try{
            DB::beginTransaction();
            $industri = Industri::create([
            'namaindustri' => $request->namaindustri,
            'email' => $request->email,
            'kategori_industri' => $request->kategori_industri,
            'statuskerjasama' => $request->statuskerjasama,
            'penanggung_jawab' => $request->name,
            'status' => true,
        ]);

        
        $code = Str::random(64);
        $admin = User::create([
            'name' => $request->name,
            'username' => $request->namaindustri,
            'email' => $request->email,
            'password' => bcrypt('12345678'),
            'remember_token' => $code,
            'isAdmin'=>1,
            'id_industri' => $industri->id_industri,
        ]);
        $admin->assignRole('admin');
        $url=url('/admin/set-password/'.$code);

        if ($admin) {
        Mail::to($admin->email)->send(new VerifyEmail($url));
        }
        
        DB::commit();
        return response()->json([
            'error' => false,
            'message' => 'User berhasil ditambahkan. Notifikasi telah dikirim.',
        ]);
        
        } catch (Exception $e) {
            DB::rollBack();
        
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

}


