<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\Event;
use App\Models\Event_attendance;
use App\Models\Leave;
use App\Models\Performance;
use Symfony\Contracts\Service\Attribute\Required;

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

      $attendances = Event_attendance::where('employee_id', $user->employee->employee_id)
         ->pluck('event_id')
         ->toArray();

      return view('employee.attendEvent', compact('events', 'user', 'attendances'));
   }

   public function request_leave(){
      $user = Auth::user();
      $leaves = Leave::where('employee_id', $user->employee_id)->get();

      return view('employee.requestleave', compact('leaves'));
   }

   public function performance(){
      $user = Auth::user();
      $performances = Performance::where('employee_id', $user->employee_id)->get();

      return view('employee.performance', compact('performances'));
   }

   public function attend($employee_id, $event_id)
   {
      $exists = Event_attendance::where('event_id', $event_id)
         ->where('employee_id', $employee_id)
         ->exists();

      if ($exists) {
         return redirect()->back()
               ->with('error', 'You are already registered for this event.');
      }

      Event_attendance::create([
         'event_id' => $event_id,
         'employee_id' => $employee_id,
         'check_in_time' => now(),
         'status' => 'registered',
      ]);

      return redirect()->route('employee.attendEvent')
         ->with('success', 'Successfully registered!');
   }
}
