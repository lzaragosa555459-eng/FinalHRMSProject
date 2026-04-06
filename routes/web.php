<?php

use App\Http\Controllers\HRController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CrudConctroller;

Route::get('/', function(){
    return view('login');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('hr.logout');



Route::get('/dashboard', [HRController::class, 'dashboard'])->name('hr.dashboard');
Route::get('/employees', [HRController::class, 'employees'])->name('hr.employees');

Route::get('/employees/{id}', [HRController::class, 'employee_details'])->name('hr.EmployeesDetails.employee_details');


Route::get('/organization', [HRController::class, 'organization'])->name('hr.organization');
Route::get('/organization/{id}', [HRController::class, 'organization_details'])->name('hr.EmployeesDetails.employee_by_department');

Route::get('/attendance', [HRController::class, 'attendance'])->name('hr.attendance');
Route::get('/payroll', [HRController::class, 'payroll'])->name('hr.payroll');


Route::get('/add employee', [HRController::class, 'AddEmployees'])->name('hr.Crud.add');
Route::post('/add employee', [CrudConctroller::class, 'save']);


//Route::get('/edit employees', [HRController::class, 'EditEmployees'])->name('hr.Crud.edit');