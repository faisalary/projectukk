<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SetPasswordController extends Controller
{
    public function index($id)
    {
        
        return view('auth.reset_password_admin', compact('id'));
    }
    public function update(Request $request)
    {
        
       $this->validate($request, [
            'password' => 'required|string|min:8|confirmed',
        ]);

        $admin = User::where('remember_token', $request->id)->first();

        if (!$admin) {
            return redirect()->back()->with('error', 'Invalid token.');
        }
        // dd($admin);
        $admin->password = bcrypt($request->password);
        $admin->remember_token = null; 
        $admin->save();
        if (!$admin->save()) {
            return redirect()->back()->with('error', 'Password update failed.');
        }

        return redirect('/company/profile-company')->with('success', 'Password updated successfully.');
    }


    // public function index($token)
    // {
    //     return view('auth.reset_password_admin', compact('token'));
    // }

    // public function update(Request $request)
    // {
    //     $request->validate([
    //         'password' => 'required|string|min:8|confirmed',
    //     ]);

    //     $admin = User::where('remember_token', $request->token)->first();

    //     if (!$admin) {
    //         return redirect()->back()->withInput()->withErrors(['token' => 'Token tidak valid']);
    //     }
    //     $admin->password = bcrypt($request->password);
    //     $admin->save();
    //     // $admin->
    //     return redirect('/informasi/lowongan');
    // }
}
