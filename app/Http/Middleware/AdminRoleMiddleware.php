<?php
//namespace App\Http\Middleware;
//
//use Closure;
//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
//
//class AdminRoleMiddleware
//{
//public function handle(Request $request, Closure $next)
//{
//if (Auth::check() && Auth::user()->role !== 'admin') {
//return redirect('/'); // Eğer admin değilse ana sayfaya yönlendir
//}
//
//return $next($request);
//}
//}
