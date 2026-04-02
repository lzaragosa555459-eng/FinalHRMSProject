<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Attendance;

use Illuminate\Http\Request;

class HRController extends Controller
{
    public function dashboard(){
      


        $totalEmployees = Employee::count();

        $totalActive = Employee::where('status', 'active')->count();

        $resignedEmployees = Employee::where('status', 'resigned')->count();

        $newHires = Employee::whereMonth('hire_date', now()->month)->count();

        // Departments
        $departments = Department::count();

        // Attendance
        $totalPresentToday = Attendance::whereDate('date', now())
            ->where('status', 'Present')
            ->count();

        $totalLateToday = Attendance::whereDate('date', now())
            ->where('status', 'Late')
            ->count();

        return view('hr.dashboard', compact(
            'totalEmployees',
            'totalActive',
            'resignedEmployees',
            'newHires',
            'departments',
            'totalPresentToday',
            'totalLateToday'
        ));

          
    }

    public function employees(){
        $employees = Employee::all();

        return view('hr.employees', compact('employees'));
    }
    public function organization(){
        return view('hr.organization');
    }

    public function attendance(){
        return view('hr.attendance');
    }

    public function payroll(){
        return view('hr.payroll');
    }
}
