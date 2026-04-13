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
        'address'         => 'Taguig City, Metro Manila',
        'date_of_birth'   => '1995-05-10',
        'gender'          => 'male',
        'employee_role'   => 'head',
        'position_id'     => 1,
        'applicant_id'    => 1,
        'hire_date'       => now(),
        'manager_id'      => null,
        'status'          => 'active'
    ],
    [
        'employee_id'     => 2,
        'employee_number' => 'EMP002',
        'name'            => 'Jane Smith',
        'phone_number'    => '09123456789',
        'address'         => 'Makati City, Metro Manila',
        'date_of_birth'   => '1996-04-20',
        'gender'          => 'female',
        'employee_role'   => 'head',
        'position_id'     => 2,
        'applicant_id'    => 2,
        'hire_date'       => now(),
        'manager_id'      => null,
 
        'status'          => 'active'
    ],
    // ==================== ADD MORE EMPLOYEES BELOW ====================

    [
        'employee_id'     => 3,
        'employee_number' => 'EMP003',
        'name'            => 'Michael Santos',
        'phone_number'    => '09351234567',
        'address'         => 'Pasig City, Metro Manila',
        'date_of_birth'   => '1994-11-15',
        'gender'          => 'male',
        'employee_role'   => 'employee',
        'position_id'     => 3,
        'applicant_id'    => 3,
        'hire_date'       => now(),
        'manager_id'      => 1,           // Reports to John Doe
 
        'status'          => 'active'
    ],
    [
        'employee_id'     => 4,
        'employee_number' => 'EMP004',
        'name'            => 'Maria Cruz',
        'phone_number'    => '09187654321',
        'address'         => 'Quezon City, Metro Manila',
        'date_of_birth'   => '1997-08-05',
        'gender'          => 'female',
        'employee_role'   => 'employee',
        'position_id'     => 4,
        'applicant_id'    => 4,
        'hire_date'       => now(),
        'manager_id'      => 2,           // Reports to Jane Smith
 
        'status'          => 'active'
    ],
    [
        'employee_id'     => 5,
        'employee_number' => 'EMP005',
        'name'            => 'David Lim',
        'phone_number'    => '09451237890',
        'address'         => 'Taguig City, Metro Manila',
        'date_of_birth'   => '1993-02-28',
        'gender'          => 'male',
        'employee_role'   => 'employee',
        'position_id'     => 5,
        'applicant_id'    => 5,
        'hire_date'       => now(),
        'manager_id'      => 1,
        'status'          => 'active'
    ],
]);
}
}
