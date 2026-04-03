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
        'employee_id'     => 1,
        'employee_number' => 'EMP001',
        'name'            => 'John Doe',
        'phone_number'    => '09456582058',
        'email'           => 'john@example.com',
        'address'         => 'Taguig City, Metro Manila',
        'date_of_birth'   => '1995-05-10',
        'gender'          => 'male',
        'role'            => 'head',
        'department_id'   => 1,
        'position_id'     => 1,
        'applicant_id'    => 1,
        'hire_date'       => now(),
        'salary'          => 35000,
        'manager_id'      => null,
        'user_id'         => null,
        'status'          => 'active'
    ],
    [
        'employee_id'     => 2,
        'employee_number' => 'EMP002',
        'name'            => 'Jane Smith',
        'phone_number'    => '09123456789',
        'email'           => 'jane@example.com',
        'address'         => 'Makati City, Metro Manila',
        'date_of_birth'   => '1996-04-20',
        'gender'          => 'female',
        'role'            => 'head',
        'department_id'   => 2,
        'position_id'     => 2,
        'applicant_id'    => 2,
        'hire_date'       => now(),
        'salary'          => 32000,
        'manager_id'      => null,
        'user_id'         => null,
        'status'          => 'active'
    ],
    // ==================== ADD MORE EMPLOYEES BELOW ====================

    [
        'employee_id'     => 3,
        'employee_number' => 'EMP003',
        'name'            => 'Michael Santos',
        'phone_number'    => '09351234567',
        'email'           => 'michael.santos@example.com',
        'address'         => 'Pasig City, Metro Manila',
        'date_of_birth'   => '1994-11-15',
        'gender'          => 'male',
        'role'            => 'employee',
        'department_id'   => 1,
        'position_id'     => 3,
        'applicant_id'    => 3,
        'hire_date'       => now(),
        'salary'          => 28000,
        'manager_id'      => 1,           // Reports to John Doe
        'user_id'         => null,
        'status'          => 'active'
    ],
    [
        'employee_id'     => 4,
        'employee_number' => 'EMP004',
        'name'            => 'Maria Cruz',
        'phone_number'    => '09187654321',
        'email'           => 'maria.cruz@example.com',
        'address'         => 'Quezon City, Metro Manila',
        'date_of_birth'   => '1997-08-05',
        'gender'          => 'female',
        'role'            => 'employee',
        'department_id'   => 2,
        'position_id'     => 4,
        'applicant_id'    => 4,
        'hire_date'       => now(),
        'salary'          => 29000,
        'manager_id'      => 2,           // Reports to Jane Smith
        'user_id'         => null,
        'status'          => 'active'
    ],
    [
        'employee_id'     => 5,
        'employee_number' => 'EMP005',
        'name'            => 'David Lim',
        'phone_number'    => '09451237890',
        'email'           => 'david.lim@example.com',
        'address'         => 'Taguig City, Metro Manila',
        'date_of_birth'   => '1993-02-28',
        'gender'          => 'male',
        'role'            => 'employee',
        'department_id'   => 3,
        'position_id'     => 5,
        'applicant_id'    => 5,
        'hire_date'       => now(),
        'salary'          => 31000,
        'manager_id'      => 1,
        'user_id'         => null,
        'status'          => 'active'
    ],
]);
}
}
