<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerifyEmailMhs;
use App\Models\Mahasiswa;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Http\Request;
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
    public function store(Request $request)
    { 
        try {
            $this->validate($request, [
                'nim' => 'required|string|max:255'
            ]);
    
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
                dd($verifymhs);
                Mail::to($user->emailmhs)->send(new VerifyEmailMhs($verifymhs));

            return response()->json([
                'error' => false,
                'message' => 'Activated successfully!',
                'modal' => '#register-mhs'
            ]);

            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        
    }
    public function setting(){

    }

}