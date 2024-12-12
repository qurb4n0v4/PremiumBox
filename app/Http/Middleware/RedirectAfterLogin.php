<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectAfterLogin
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($request->user() && ($request->is('admin/login') || $request->is('admin'))) {
            return redirect('/admin/dashboard');
        }

        return $response;
    }
}
