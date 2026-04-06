<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class CrudController extends Controller
{
    public function add(Request $request)
    {
        $validated = $request->validate([
            'employee_number' => 'required|string|max:50|unique:employees,employee_number',
            'name'            => 'required|string|max:150',
            'phone_number'    => 'required|string|max:20',
            'email'           => 'required|email|max:150',
            'address'         => 'required|string',
            'date_of_birth'   => 'required|date',
            'gender'          => 'required|in:male,female,other',
            'profile_image'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'role'            => 'required|in:head,employee',
            'department_id'   => 'nullable|exists:departments,department_id',
            'position_id'     => 'nullable|exists:positions,position_id',
            'applicant_id'    => 'nullable|exists:applicants,applicant_id',
            'hire_date'       => 'required|date',
            'salary'          => 'required|numeric',
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
}