<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\Event;

class EmployeeController extends Controller
{
   public function dashboard(){
    $user = Auth::user();

    return view('employee.dashboard', compact('user'));
   }

   public function attendance()
   {
      $user = Auth::user();

      $attendance = Attendance::where('employee_id', $user->employee_id)->get();

      return view('employee.attendance', compact('attendance'));
   }

   public function attend_event()
   {
      $user = Auth::user();

      $department_id = $user->employee->position->department_id;

      $events = Event::where('department_id', $department_id)->get();

      return view('employee.attendEvent', compact('events'));
   }

   public function request_leave(){
      return view('employee.requestleave');
   }

   public function performance(){
      return view('employee.performance');
   }
}
