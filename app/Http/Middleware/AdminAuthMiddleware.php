<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

     public function handle($request, Closure $next)
     {
         if (!Auth::check()) {
             return redirect('/');
         }
 
         if (Auth::guard('admin')->check()) {
             return $next($request);
         }
 
         return redirect()->route('admin.login'); // Ganti dengan rute login admin Anda
     }
}
