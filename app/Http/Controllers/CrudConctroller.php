<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CrudConctroller extends Controller
{
    public function save(Request $request){
        $validated = $request->validate([
            'employee_number' => 'required|string|max:50',
            'name'     => 'required|string|max:150',
            'phone'         => 'required|string|max:20',
            'email'         => 'required|email|unique:employees,email',
            'address'       => 'required|string|max:20',
            'date_of_birth' => 'nullable|date',
            'gender'        => 'required|string|max:20',
            'profile_image' => 'required|string|max:255',
            'role'          => 'required',
            'department_id' => 'required|exists:departments,department_id',
            'position_id'   => 'required|exists:positions,position_id',
            'applicant_id'  => 'required|exists:applicants,applicant_id',
            'hire_date'     => 'required|date',
            'salary'        => 'reruired|decimal|max:10',
            'manager_id'    => 'required|max:10|exitst:employees,employee_id',
            'user_id'       => 'required|int|max:10',
            'status'        => 'required',
        ]);
    }
}
