<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;


class EmployeeSeeder extends Seeder
{
    public function run()
{
    Employee::insert([
        [
            'employee_id' => 1,
            'employee_number' => 'EMP001',
            'name' => 'John Doe',
            'phone_number' => '09456582058',
            'email' => 'john@example.com',
            'address' => 'Manila',
            'date_of_birth' => '1995-05-10',
            'gender' => 'male',
            'department_id' => 1,
            'position_id' => 1,
            'applicant_id' => 1,
            'hire_date' => now(),
            'salary' => 30000,
            'manager_id' => null,
            'user_id' => null,
            'status' => 'active'
        ]
    ]);

    Employee::insert([
        [
            'employee_id' => 2,
            'employee_number' => 'EMP002',
            'name' => 'Jane Doe',
            'phone_number' => '09123456789',
            'email' => 'jane@example.com',
            'address' => 'Manila',
            'date_of_birth' => '1996-04-20',
            'gender' => 'female',
            'department_id' => 2,
            'position_id' => 2,
            'applicant_id' => 2,
            'hire_date' => now(),
            'salary' => 30000,
            'manager_id' => null,
            'user_id' => null,
            'status' => 'active'
        ]
    ]);
}
}
