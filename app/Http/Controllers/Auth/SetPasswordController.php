<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SetPasswordController extends Controller
{
    public function showResetForm($id)
    {
        
        return view('auth.reset_password_admin', compact('id'));
    }
    public function reset(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        // $user = $request->user();
        // $user->password = Hash::make($request->password);
        // $user->save();

        $admin=User::where('remember_token', $request->token)->first();
        $admin->password=$request->password_confirmation;
        $admin->save();
        return redirect('admin.dashboard.index');
    }
}
