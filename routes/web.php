<?php

use App\Http\Controllers\HRController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\EmployeeController;

Route::get('/', function(){
    return view('login');
});

Route::get('/login', function () {
    return view('login');
})->name('login');


//Human Resource ROUTE---------------------------------------------------------------------------------

Route::post('/login', [AuthController::class, 'login'])->name('hr.logout');


Route::get('/dashboard', [HRController::class, 'dashboard'])->name('hr.dashboard');
Route::get('/employees', [HRController::class, 'employees'])->name('hr.employees');

Route::get('/employees/{id}', [HRController::class, 'employee_details'])->name('hr.EmployeesDetails.employee_details');

Route::get('/organization/form/{id?}', [HRController::class, 'departmentForm'])->name('departmentsForm');
Route::get('/organization', [HRController::class, 'organization'])->name('hr.organization');
Route::get('/organization/{id}', [HRController::class, 'organization_details'])->name('hr.EmployeesDetails.employee_by_department');
Route::post('/organization/add',[CrudController::class, 'addDepartment'])->name('AddNewDepartment');
Route::put('/organization/update/{id}',[CrudController::class, 'updateDepartment'])->name('UpdateDepartment');
Route::delete('/organization/delete/{id}', [CrudController::class, 'destroyDepartment'])->name('deleteDepartment');

Route::get('/attendance', [HRController::class, 'attendance'])->name('hr.attendance');
Route::put('/attendance/{id}/approve', [CrudController::class, 'approved'])->name('approved');
Route::put('/attendance/{id}/reject', [CrudController::class, 'reject'])->name('reject');

Route::get('/payroll', [HRController::class, 'payroll'])->name('hr.payroll');
Route::get('/employee/{id}', [HRController::class, 'getEmployee']);

Route::post('/add-payroll', [CrudController::class, 'AddPayroll'])->name('hr.AddPayroll');
Route::delete('/delete-payroll/{id}', [CrudController::class, 'destroyPayroll'])->name('delete.payroll');
        
Route::get('/add employee', [HRController::class, 'AddEmployees'])->name('hr.Crud.add');
Route::post('/add employee', [CrudController::class, 'add'])->name('hr.Crud.add');

Route::get('add event', [HRController::class, 'AddEvent'])->name('hr.Crud.addEvent');
Route::post('/add event', [CrudController::class, 'AddEvent'])->name('hr.Crud.addEvent');


Route::get('/events/{id}/edit', [HRController::class, 'editEvent'])->name('hr.Crud.editEvent');
Route::put('/events/{id}', [CrudController::class, 'updateEvent'])->name('hr.Crud.updateEvent');
Route::delete('/events/{id}', [CrudController::class, 'destroyEvent'])->name('hr.Crud.deleteEvent');
    
Route::get('/employees/{id}/edit', [HRController::class, 'edit'])->name('hr.Crud.edit');
Route::put('/employees/{id}', [CrudController::class, 'update'])->name('hr.Crud.update');
Route::delete('/employee/{id}', [CrudController::class, 'destroy'])->name('hr.Crud.delete');

Route::get('/view event/{event_id}', [HRController::class, 'EventAttendances'])->name('hr.EmployeesDetails.EventAttendances');

Route::get('/form-performance/{employee_id}/{performance_id?}', [HRController::class, 'ViewPerformanceForm'])->name('gotoperfomanceform');
Route::post('/add-performance/{id}', [CrudController::class, 'addPerformance'])->name('AddEmployeeRating');
Route::put('/form-performance/{employee_id}/{performance_id}', [CrudController::class, 'updatePerformance'])->name('UpdateEmployeeRating');



//EMPLOYEE ROTA-------------------------------------------------------------------------------------------

Route::get('/employee-dashboard', [EmployeeController::class, 'dashboard'])->name('employee.dashboard');
//Actions
Route::get('/employee-attendance', [EmployeeController::class, 'attendance'])->name('employee.attendance');
Route::get('/employee-attend_event', [EmployeeController::class, 'attend_event'])->name('employee.attendEvent');
Route::get('/employee-request_leave', [EmployeeController::class, 'request_leave'])->name('employee.requestleave');
Route::get('/employee-performance', [EmployeeController::class, 'performance'])->name('employee.performance');

Route::get('/employee-attendance/{employee_id}/{event_id}', [EmployeeController::class, 'attend'])->name('attend');
Route::post('/employee-request_leave/{id}', [CrudController::class, 'add_request'])->name('add-request');
Route::delete('/employee-request_leave/{id}', [CrudController::class, 'cancel_leave'])->name('cancel-leave');

Route::get('/payroll/{id}/download-slip', [EmployeeController::class, 'downloadSlip'])
    ->name('payroll.downloadSlip');
Route::get('/attendance/export-csv', [EmployeeController::class, 'exportCsv'])
    ->name('attendance.exportCsv');