<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
//        // Kullanıcı admin değilse, anasayfaya yönlendir
//        if (Auth::check() && Auth::user()->role !== 'admin') {
//            Auth::logout();
//            return redirect('/')->with('error', 'You do not have admin access.');
//        }
//
//
//        return $next($request);
    }
}
