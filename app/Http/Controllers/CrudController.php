<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

use App\Models\Department;
use App\Models\Position;
use App\Models\Applicant;
use App\Models\User;
use App\Models\Event;
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
            'employee_role'   => 'required|in:head,employee',
            'position_id'     => 'nullable|exists:positions,position_id',
            'applicant_id'    => 'nullable|exists:applicants,applicant_id',
            'hire_date'       => 'required|date',
            'manager_id'      => 'nullable|exists:employees,employee_id',
            'user_id'         => 'nullable|integer',
            'status'          => 'required|in:active,resigned,inactive',
        ]);

        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('employees', 'public');
            $validated['profile_image'] = $path;
        }

        Employee::create($validated);

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
                'basic_salary' => 'required|numeric|min:0',
                'allowances'   => 'required|numeric|min:0',
                'deduction'    => 'required|numeric|min:0',
                'pay_date'     => 'required|date|date_format:Y-m-d',
            ]);

            $net_salary = $validated['basic_salary']
                        + $validated['allowances']
                        - $validated['deduction'];

            Payroll::updateOrCreate(
                ['employee_id' => $validated['employee_id']],
                [
                    'basic_salary' => $validated['basic_salary'],
                    'allowances'   => $validated['allowances'],
                    'deduction'    => $validated['deduction'],
                    'net_salary'   => $net_salary,
                    'pay_date'     => $validated['pay_date'],
                ]
            );

            return redirect()->route('hr.payroll')
                ->with('success', 'Payroll saved successfully!');
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
}