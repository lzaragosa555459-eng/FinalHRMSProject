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
use App\Models\Payroll;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class EmployeeController extends Controller
{


   public function dashboard()
   {
      $user = Auth::user();

      $employeeId = $user->employee->employee_id;

      $currentMonth = Carbon::now()->month;
      $currentYear  = Carbon::now()->year;
   

      $firstCutoff = Payroll::where('employee_id', $employeeId)
         ->whereMonth('period_start', $currentMonth)
         ->whereYear('period_start', $currentYear)
         ->where('cutoff_label', 'first')
         ->sum('net_salary');

      $secondCutoff = Payroll::where('employee_id', $employeeId)
         ->whereMonth('period_start', $currentMonth)
         ->whereYear('period_start', $currentYear)
         ->where('cutoff_label', 'second')
         ->sum('net_salary');

      $monthlyPayout = $firstCutoff + $secondCutoff;
      // Get ONLY current month payrolls
      $payrolls = Payroll::where('employee_id', $employeeId)
         ->whereMonth('period_start', $currentMonth)
         ->whereYear('period_start', $currentYear)
         ->get();

      // IF no payroll this month
      if ($payrolls->isEmpty()) {

         $monthlyNet = 0;
         $monthlyBasic = 0;
         $monthlyAllowance = 0;
         $monthlyDeduction = 0;

      } else {

         // add first + second cutoff together
         $monthlyNet = $payrolls->sum('net_salary');

         $monthlyBasic = $payrolls->sum('basic_salary');

         $monthlyAllowance = $payrolls->sum('allowances');

         $monthlyDeduction = $payrolls->sum('deduction');
      }

      return view('employee.dashboard', compact(
         'user',
         'monthlyNet',
         'monthlyPayout',
         'firstCutoff',
         'secondCutoff',
         'monthlyBasic',
         'monthlyAllowance',
         'monthlyDeduction'
      ));
   }

   public function attendance()
   {
      $user = Auth::user();

      $attendance = Attendance::where('employee_id', $user->employee_id)->get();

      return view('employee.attendance', compact('attendance','user'));
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

   public function request_leave()
   {
      $user = Auth::user();

      $pending = Leave::where('employee_id', $user->employee_id)
         ->where('status', 'pending')
         ->paginate(5, ['*'], 'pending_page');

      $approved = Leave::where('employee_id', $user->employee_id)
         ->where('status', 'approved')
         ->paginate(5, ['*'], 'approved_page');

      $disapproved = Leave::where('employee_id', $user->employee_id)
         ->where('status', 'disapproved')
         ->paginate(5, ['*'], 'disapproved_page');

      return view('employee.requestleave', compact(
         'user',
         'pending',
         'approved',
         'disapproved'
      ));
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


   public function downloadSlip()
   {
      $user = Auth::user();

      if (!$user || !$user->employee) {
         return back()->with('error', 'No employee found.');
      }

      $payrolls = Payroll::where('employee_id', $user->employee->employee_id)
         ->whereMonth('period_start', now()->month)
         ->whereYear('period_start', now()->year)
         ->orderBy('period_start', 'asc')
         ->get();

      if ($payrolls->isEmpty()) {
         return back()->with('error', 'No payroll found this month.');
      }

      $pdf = Pdf::loadView('pdf.payslip', compact('payrolls', 'user'));

      return $pdf->download('Payslip-'.$user->employee->name.'.pdf');
   }


   public function exportCsv($id)
   {
      $filename = 'attendance-export.csv';

      return response()->streamDownload(function () use ($id) {

         $handle = fopen('php://output', 'w');

         // CSV headers (matches actual data)
         fputcsv($handle, [
               'Employee',
               'Date',
               'Time In',
               'Time Out',
               'Status'
         ]);

         // Fetch data
         $attendances = Attendance::with('employee')
               ->where('employee_id', $id)
               ->get();

         foreach ($attendances as $attendance) {
               fputcsv($handle, [
                  $attendance->employee->name ?? 'N/A',
                  $attendance->date,
                  $attendance->time_in,
                  $attendance->time_out ?? '--',
                  $attendance->status
               ]);
         }

         fclose($handle);

      }, $filename, [
         "Content-Type" => "text/csv",
      ]);
   }
}
