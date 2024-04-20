<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisMahasiswa;
use App\Mail\VerifyEmailMhs;
use App\Models\Mahasiswa;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
class RegisteredUserController extends Controller
{
    protected $redirectTo = RouteServiceProvider::HOME; 
    /**
     * Display the registration view.
     */

    public function index()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisMahasiswa $request)
    { 
        try {    
            $mahasiswa = Mahasiswa::where('nim', $request->nim)->first();
            $user = User::where('nim', $request->nim)->first();
            $code = Str::random(64);
             
            if ($user == null) 
            
                $user = User::create([
                        'nim' => $request->nim,
                        'name' => $mahasiswa->namamhs,
                        'username' => $mahasiswa->namamhs,
                        'email' => $mahasiswa->emailmhs,
                        'password' => Hash::make($request->nim),
                        'remember_token' => $code,
                        'isAdmin' => 2
                    ]);  
                $user->assignRole('user');
                $verifymhs = url('/mahasiswa/set-password/' . $code);
                Mail::to($user->email)->send(new VerifyEmailMhs($verifymhs));              
            return view('auth.message-verify-email');
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
        
    }

}