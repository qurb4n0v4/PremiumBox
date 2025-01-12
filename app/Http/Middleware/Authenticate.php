<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo(Request $request): ?string
    {
        // If the request is for an admin area, redirect to the admin login
        if (auth()->check() && auth()->check()->role !== 'admin') {
            if ($request->is('admin/*')) {
                return route('admin.login');
            }
        }
        if (!auth()->check()){
            if ($request->is('admin/*')) {
                return route('admin.login');
            }
        }

        // Default route to login for regular users (if necessary)
        return $request->expectsJson() ? null : route('login');
    }
}
