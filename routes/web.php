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

Route::get('/index', function(){
    return view('hr.index');
});

Route::get('/dashboard', [HRController::class, 'index'])->name('hr.index');