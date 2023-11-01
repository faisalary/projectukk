<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin; 

class AuthAdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function adminlogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Otentikasi admin
        // if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
        //     return redirect()->route('admin.dashboard.index');
        // }

        return back()->withInput()->withErrors(['email' => 'Email atau password salah']);
    }
    

    public function dashboard()
    {
        return view('admin.dashboard.index');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
