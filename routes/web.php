<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HrController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use Spatie\Permission\Contracts\Permission;

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [DashboardController::class,'adminDashboard'])->name('dashboard');
    Route::resource('hr',HrController::class);
    Route::resource('employee',EmployeeController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
});

Route::middleware(['auth', 'role:hr'])->prefix('hr')->name('hr.')->group(function () {
    Route::get('dashboard', fn () => view('dashboard.hr'))->name('dashboard');
    Route::resource('employee',EmployeeController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
});

Route::middleware(['auth', 'role:employee'])->prefix('employee')->name('employee.')->group(function () {
    Route::get('dashboard', fn () => view('dashboard.employee'))->name('dashboard');
});

Auth::routes(['register' => false]);

Route::middleware('role.redirect')->get('/',function(){
    return view('auth.login');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
