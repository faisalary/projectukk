<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Middleware\IsAdmin;
use App\Providers\RouteServiceProvider;
use Doctrine\DBAL\Driver\Middleware;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    protected function authenticated(Request $request, $user)
    {
        if ($user->hasRole('superadmin')) {
            return redirect()->route('dashboard.superadmin');
        } elseif ($user->hasRole('admin')) {
            return redirect()->route('dashboard.admin');
        } else {
            // if (!$user->hasVerifiedEmail()) {
            //     return redirect()->route('verification.notice')->with('warning', 'Please verify your email first.');
            // }
            return view('dashboard');
        }
    }
}
