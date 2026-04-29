<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Department;
use App\Models\Position;
use App\Models\Applicant;
use App\Models\User;
use App\Models\Event;
use App\Models\Leave;
use App\Models\Payroll;
use App\Models\Performance;
use SebastianBergmann\CodeUnit\FunctionUnit;

class CrudController extends Controller
{
    public function add(Request $request)
    {
        $validated = $request->validate([
            'employee_number' => 'required|string|max:50|unique:employees,employee_number',
            'name'            => 'required|string|max:150',
            'phone_number'    => 'required|string|max:20',
            'address'         => 'required|string',
            'date_of_birth'   => 'required|date',
            'gender'          => 'required|in:male,female,other',
            'profile_image'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'employee_role'   => 'nullable|in:head,employee',
            'position_id'     => 'required|exists:positions,position_id',
            'applicant_id'    => 'nullable|exists:applicants,applicant_id',
            'hire_date'       => 'nullable|date',
            'manager_id'      => 'nullable|exists:employees,employee_id',
            'status'          => 'nullable|in:active,resigned,inactive',
        ]);
        $employee = Employee::create($validated);
        if (
            $request->filled('username') ||
            $request->filled('email') ||
            $request->filled('password')
        ) {

            $request->validate([
                'username' => 'required|string|max:100',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'system_role' => 'required|in:hr,employee,admin',
            ]);

            User::create([
                'employee_id' => $employee->getkey(),
                'username' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'system_role' => $request->system_role,
            ]);
        }
            


        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('employees', 'public');
            $validated['profile_image'] = $path;
        }

        $validated['status'] = $request->status ?? 'active';

       

        return redirect()->route('hr.employees')
                         ->with('success', 'Employee added successfully!');
    }


        public function update(Request $request, $id)
        {
            $employee = Employee::findOrFail($id);

            $employee->update([
                'employee_number' => $request->employee_number,
                'name'            => $request->name,
                'phone_number'    => $request->phone_number,
                'address'         => $request->address,
                'date_of_birth'   => $request->date_of_birth,
                'gender'          => $request->gender,

                // Profile image handled separately (see note below)

                'employee_role'   => $request->role,
                'position_id'     => $request->position_id,
                'applicant_name'  => $request->applicant_name,
                'hire_date'       => $request->hire_date,
                'salary'          => $request->salary,
                'manager_name'    => $request->manager_name,
                'status'          => $request->status,
            ]);

            return redirect()->route('hr.EmployeesDetails.employee_details', $id)
                ->with('success', 'Employee updated successfully');
        }

        public function destroy($id){
            $employee = Employee::findOrFail($id);
            $employee->delete();

            return redirect()->route('hr.employees')
                         ->with('success', 'Employee deleted successfully!');
        }
        public function AddEvent(Request $request)
        {
            // Validation
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'start_datetime' => 'required|date',
                'end_datetime' => 'required|date|after_or_equal:start_datetime',
                'location' => 'required|string|max:255',
                'department_id' => 'nullable|exists:departments,department_id',
                'description' => 'required|string',
                'event_type' => 'required|in:meeting,training,team_building,social,workshop',
                'max_participants' => 'required|integer|min:1',
                'status' => 'required|in:draft,published,cancelled',
            ]);

            // Create event
            Event::create($validated);

            // Redirect back with success message
            return redirect()->route('hr.organization')
                ->with('success', 'Event created successfully.');
        }

         // Update event
        public function updateEvent(Request $request, $id)
        {
            $event = Event::findOrFail($id);

            // Validation
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'start_datetime' => 'required|date',
                'end_datetime' => 'required|date|after_or_equal:start_datetime',
                'location' => 'required|string|max:255',
                'department_id' => 'nullable|exists:departments,department_id',
                'description' => 'required|string',
                'event_type' => 'required|in:meeting,training,team_building,social,workshop',
                'max_participants' => 'required|integer|min:1',
                'status' => 'required|in:draft,published,cancelled',
            ]);

            // Update record
            $event->update($validated);

            return redirect()->route('hr.organization')
                ->with('success', 'Event updated successfully.');
        }
        //Delete event
        public function destroyEvent($id){
            $employee = Event::findOrFail($id);
            $employee->delete();

            return redirect()->route('hr.organization')
                         ->with('success', 'Employee deleted successfully!');
        }



public function AddPayroll(Request $request)
{
    $validated = $request->validate([
        'employee_id'  => 'required|exists:employees,employee_id',
        'period_start' => 'required|date',
        'period_end'   => 'required|date|after_or_equal:period_start',
        'allowances'   => 'required|numeric|min:0',
        'pay_date'     => 'required|date',
    ]);

    $employee = Employee::with('position')->find($validated['employee_id']);
    $monthlySalary = $employee->position->salary;

    $start = Carbon::parse($validated['period_start']);
    $end   = Carbon::parse($validated['period_end']);

    $days = $start->diffInDays($end) + 1;
    $dailyRate = $monthlySalary / 30;

    $basic_salary = $dailyRate * $days;

    $gross_salary = $basic_salary + $validated['allowances'];

    $leaveCount = Leave::where('employee_id', $validated['employee_id'])
        ->where('status', 'approved')
        ->where(function ($query) use ($validated) {
            $query->whereBetween('start_date', [$validated['period_start'], $validated['period_end']])
                ->orWhereBetween('end_date', [$validated['period_start'], $validated['period_end']]);
        })
        ->get();

    $totalLeaveDays = 0;

    foreach ($leaveCount as $leave) {
        $leaveStart = Carbon::parse($leave->start_date);
        $leaveEnd   = Carbon::parse($leave->end_date);

        $totalLeaveDays += $leaveStart->diffInDays($leaveEnd) + 1;
    }

    $leaveDeduction = $totalLeaveDays * $dailyRate;


    $sss = $gross_salary * 0.045;   // example 4.5%
    $tax = $gross_salary * 0.10;    // example 10%

    $totalDeduction = $leaveDeduction + $sss + $tax;

    $net_salary = $gross_salary - $totalDeduction;

    Payroll::updateOrCreate(
        [
            'employee_id'  => $validated['employee_id'],
            'period_start' => $validated['period_start'],
            'period_end'   => $validated['period_end'],
        ],
        [
            'basic_salary' => $basic_salary,
            'allowances'   => $validated['allowances'],
            'gross_salary' => $gross_salary,
            'deduction'    => $totalDeduction,
            'net_salary'   => $net_salary,
            'pay_date'     => $validated['pay_date'],
        ]
    );

    return redirect()->route('hr.payroll')
        ->with('success', 'Payroll calculated successfully!');
}

        public function destroyPayroll($id){
            $employee = Payroll::findOrFail($id);
            $employee->delete();

            return redirect()->route('hr.payroll')
                         ->with('success', 'Payroll deleted successfully!');

        }

        public function addPerformance(Request $request, $id)
        {
            $validated = $request->validate([
                'reviewer_id'   => 'required|exists:employees,employee_id',
                'review_period' => 'nullable|string|max:255',
                'rating'        => 'nullable|numeric|min:0|max:5',
                'comments'      => 'nullable|string',
                'review_date'   => 'nullable|date',
                'status'        => 'required|in:Pending,Completed,Reviewed',
            ]);

            $validated['employee_id'] = $id;

            Performance::create($validated);

            return redirect()->route('hr.EmployeesDetails.employee_details', $id)->with('success', 'Performance added successfully!');
        }

        public function updatePerformance(Request $request, $employee_id, $performance_id)
        {
            $validated = $request->validate([
                'reviewer_id'   => 'required|exists:employees,employee_id',
                'review_period' => 'nullable|string|max:255',
                'rating'        => 'nullable|numeric|min:0|max:5',
                'comments'      => 'nullable|string',
                'review_date'   => 'nullable|date',
                'status'        => 'required|in:Pending,Completed,Reviewed',
            ]);

            $performance = Performance::findOrFail($performance_id);

            $performance->update($validated);

            return redirect()
                ->route('hr.EmployeesDetails.employee_details', $employee_id)
                ->with('success', 'Updated successfully!');
        }

        public function addDepartment(Request $request)
        {
            $validated = $request->validate([
                'department_number' => 'nullable|string|max:20',
                'name' => 'required|string|max:100',
                'description' => 'nullable|string|max:255',
            ]);

            Department::create($validated);

            return redirect()->route('hr.organization')
                ->with('success', 'Department added successfully!');
        }
        
        public function updateDepartment(Request $request, $id)
        {
            $validated = $request->validate([
                'department_number' => 'nullable|string|max:20',
                'name' => 'required|string|max:100',
                'description' => 'nullable|string|max:255',
            ]);

            Department::where('department_id', $id)->update($validated);

            return redirect()->route('hr.organization')
                ->with('success', 'Department updated successfully!');
        }

        public function destroyDepartment($id){
            $department = Department::findOrFail($id);

            $department->delete();

            return redirect()->route('hr.organization')
                 ->with('success', 'Employee deleted successfully!');
            
        }

        public function approved($id){
           Leave::where('leave_id', $id)
                ->update([
                    'status' => 'approved'
                ]);

            return redirect()->route('hr.attendance')
                 ->with('success', 'successful!');
        }
        public function reject($id){
           Leave::where('leave_id', $id)
                ->update([
                    'status' => 'disapproved'
                ]);

            return redirect()->route('hr.attendance')
                 ->with('success', 'successful!');
        }
        public function add_request(Request $request, $id)
        {
            $employee = Employee::findOrFail($id);

            $validated = $request->validate([
                'employee_id' => 'nullable|exists:employees,employee_id',
                'start_date' => 'nullable|date',
                'end_date'   => 'nullable|date|after_or_equal:start_date',
                'reason'     => 'nullable|string|max:255',
            ]);

            Leave::create([
                'employee_id' => $employee->employee_id,
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
                'reason' => $validated['reason'],
                'status' => 'pending',
            ]);

            return redirect()->back()->with('success', 'Leave request submitted successfully.');
        }

        public function cancel_leave($id){
            $leave = Leave::findOrFail($id);

            $leave->delete();

            return redirect()->route('employee.requestleave')
                ->with('success', 'Leave request submitted successfully.');
        }
}