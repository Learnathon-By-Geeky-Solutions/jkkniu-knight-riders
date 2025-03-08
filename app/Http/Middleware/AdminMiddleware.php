<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
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
        }else if(auth()->user()->role == 'admin') {
            return $next($request);
        }else if(auth()->user()->role == 'doctor') {
            return redirect()->route('doctor.dashboard');
        }else{
            return redirect()->route('dashboard');
        }
    }
}
