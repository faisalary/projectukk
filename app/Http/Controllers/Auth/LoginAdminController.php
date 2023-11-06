<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class LoginAdminController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login_mitra');
    }

    public function adminlogin(Request $request)
    {

        // dd('test');
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        // $credentials = $request->only('email', 'password');
        // if (Auth::guard('guardName')($credentials)) {
        //     return redirect()->intended('admin.dashboard.index')
        //                 ->withSuccess('Signed in');
        // }

        if(Auth::guard('admin')->attempt(['email'=>$request->email, 'password'=>$request->password])){
        return redirect()->intended('admin.dashboard.index');

        }
        
        return back()->withInput()->withErrors(['email' => 'Email atau password salah']);
    }
    

    public function dashboard()
    {
        return view('admin.dashboard.index');
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect('/login');
    }
    
}
