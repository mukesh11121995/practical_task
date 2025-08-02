<?php

use Illuminate\Support\Facades\Auth;
function getDashboardRedirectUrl()
{
    $user = Auth::user();
    if (!$user) {
        return route('login');
    }
    if ($user->hasRole('admin')) {
        return route('admin.dashboard');
    } elseif ($user->hasRole('hr')) {
        return route('hr.dashboard');
    } elseif ($user->hasRole('employee')) {
        return route('employee.dashboard');
    }
    return route('login');
}
function getRole(){
    $user = Auth::user();
    if (!$user) {
        return route('login');
    }
    if ($user->hasRole('admin')) {
        return 'admin';
    } elseif ($user->hasRole('hr')) {
        return 'hr';
    } elseif ($user->hasRole('employee')) {
        return 'employee';
    }
    return '';
}
