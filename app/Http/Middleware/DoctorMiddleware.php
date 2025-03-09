<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DoctorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!auth()->check()) {
            return redirect()->route('login');
        }else if(auth()->user()->role == 'superadmin') {
            return redirect()->route('superadmin.dashboard');
        }else if(auth()->user()->role == 'admin') {
            return redirect()->route('admin.dashboard');
        }else if(auth()->user()->role == 'doctor') {
            return $next($request);
        }else{
            return redirect()->route('dashboard');
        }
    }
}
