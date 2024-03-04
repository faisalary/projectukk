<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisMahasiswa;
use App\Mail\VerifyEmailMhs;
use App\Models\InformasiPribadi;
use App\Models\Mahasiswa;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Illuminate\Support\Str;
class RegisteredUserController extends Controller
{
    protected $redirectTo = RouteServiceProvider::HOME; 
    /**
     * Display the registration view.
     */
    public function __construct() {
        //
    }

    public function index(): View
    {
        $mahasiswa = Mahasiswa::all();
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
             
            if ($user !== null) 
            throw new Exception('User not found with the provided NIM.'); 
            
                $user = User::create([
                        'nim' => $request->nim,
                        'name' => $mahasiswa->namamhs,
                        'username' => $mahasiswa->namamhs,
                        'email' => $mahasiswa->emailmhs,
                        'password' => Hash::make($request->nim),
                        'remember_token' => $code,
                        'isAdmin' => 2
                    ]);
                $user->syncRoles('user');   
                $verifymhs = url('/mahasiswa/set-password/' . $code);
                Mail::to($user->email)->send(new VerifyEmailMhs($verifymhs));
                $user->save();
                DB::commit();

            return response()->json([
                'error' => false,
                'message' => 'Activated successfully!',
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