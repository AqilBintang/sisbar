<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateBarber
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('barber')->check()) {
            return redirect()->route('barber.login');
        }

        return $next($request);
    }
}