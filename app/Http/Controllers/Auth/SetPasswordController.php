<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SetPasswordController extends Controller
{
    // public function showResetForm($id)
    // {
        
    //     return view('auth.reset_password_admin', compact('id'));
    // }
    // public function reset(Request $request)
    // {
    //         $request->validate([
    //             'password' => 'required|string|min:8|confirmed',
    //         ]);

    //         $admin=User::where('remember_token', $request->token)->first();
    //         $admin->password=$request->password_confirmation;
    //         $admin->save();
    //         return redirect('company.profile_company');
    // }

    public function showResetForm($token)
    {
        return view('auth.reset_password_admin', compact('token'));
    }

    public function reset(Request $request)
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
        // $admin->
        return redirect('/informasi/lowongan');
    }
}
