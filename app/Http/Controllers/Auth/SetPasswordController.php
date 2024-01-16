<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SetPasswordController extends Controller
{
    //set password mitra
    public function index($token)
    {
        return view('auth.reset_password_admin', compact('token'));
    }
    public function update(Request $request)
    {

        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);
        $admin = User::where('remember_token', $request->token)->first();
        if (!$admin) {
            return redirect()->back()->withInput()->withErrors(['token' => 'Token tidak valid']);
        }
       
        $admin->password = bcrypt($request->password);
        $admin->save();
        
        return redirect('/');
    }

    //set password mahasiswa
    public function setting($token)
    {
        return view('auth.reset_password_mahasiswa', compact('token'));
    }

    public function updateset(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::where('remember_token', $request->token)->first();

        if (!$user) {
            return redirect()->back()->withInput()->withErrors(['token' => 'Token tidak valid']);
        }
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect('/');
    }
}
