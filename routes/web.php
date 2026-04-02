<?php

use App\Http\Controllers\HRController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

Route::get('/', function(){
    return view('login');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);



Route::get('/dashboard', [HRController::class, 'dashboard'])->name('hr.dashboard');
Route::get('/employees', [HRController::class, 'employees'])->name('hr.employees');
Route::get('/organization', [HRController::class, 'organization'])->name('hr.organization');
Route::get('/attendance', [HRController::class, 'attendance'])->name('hr.attendance');
Route::get('/payroll', [HRController::class, 'payroll'])->name('hr.payroll');