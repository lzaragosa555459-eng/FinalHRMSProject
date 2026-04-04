<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Attendance;
use App\Models\Event;
use App\Models\Leave;
use App\Models\Payroll;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psy\Command\WhereamiCommand;

class HRController extends Controller
{
    public function dashboard(){
        $departmentsAnalytics = DB::table('departments as d')
        ->leftJoin('positions as p', 'd.department_id', '=', 'p.department_id')
        ->select(
            'd.name as department',
            DB::raw('COUNT(p.position_id) as total_positions')
        )
        ->groupBy('d.department_id', 'd.name')
        ->get();


        $totalEmployees = Employee::count();

        $totalActive = Employee::where('status', 'active')->count();

        $resignedEmployees = Employee::where('status', 'resigned')->count();

        $newHires = Employee::whereMonth('hire_date', now()->month)->count();

        $positions = Position::count();
     
        $TotalLeave = Leave::where('status', 'approved')->count();
     

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
            'totalLateToday',
            'TotalLeave',
            'departmentsAnalytics',
            'positions'
        ));

          
    }

    public function employees(){
        $employees = Employee::all();
        

        return view('hr.employees', compact('employees'));
    }
    public function organization()
    {
        $departments = Department::with(['head'])
            ->withCount('employees')
            ->get();
       $events = Event::with('department')->get();

        return view('hr.organization', compact('departments', 'events'));
    }

   

    public function attendance(){
        $attendances = Attendance::all();
        $approvedleaves = Leave::where('status', 'approved')->get();
        $countleaves = Leave::where('status', 'pending')->count();
        $pendingleaves = Leave::where('status', 'pending')->get();
        return view('hr.attendance', compact('attendances','approvedleaves', 'countleaves', 'pendingleaves'));
    }

    public function payroll(){
        $payrolls = Payroll::all();
        return view('hr.payroll', compact('payrolls'));
    }

    public function employee_details($id){
          $emp = Employee::findOrFail($id);


        return view('hr.EmployeesDetails.employee_details', compact('emp'));
    }
     public function organization_details($id){
        $employees = Employee::where('department_id', $id)->get();
        $getEvents = Event::where('department_id', $id)->get();
        
        return view('hr.EmployeesDetails.employee_by_department', compact('employees','getEvents'));
    }

    
}
