<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticatedWithRole
{

    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->hasRole('hr')) {
                return redirect()->route('hr.dashboard');
            } elseif ($user->hasRole('employee')) {
                return redirect()->route('employee.dashboard');
            }
        }
        return $next($request);
    }
}

