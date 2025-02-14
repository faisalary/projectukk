<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        if(Auth::user()->can('dashboard.dashboard_admin')) {
            $url = RouteServiceProvider::ADMIN;
        } elseif(Auth::user()->can('dashboard.dashboard_mitra')) {
            $url = RouteServiceProvider::MITRA;
        } elseif(Auth::user()->can('approval_mhs_doswal.view')) {
            $url = RouteServiceProvider::DOSEN;
        } elseif(Auth::user()->can('approval_mhs_kaprodi.view')) {
            $url = RouteServiceProvider::KAPRODI;
        } elseif(Auth::user()->can('kelola_magang_pemb_lapangan.view')) {
            $url = RouteServiceProvider::PEMB_LAPANGAN;
        } else {
            $url = RouteServiceProvider::LANDINGPAGE;
        }
        
        return redirect()->intended($url);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
