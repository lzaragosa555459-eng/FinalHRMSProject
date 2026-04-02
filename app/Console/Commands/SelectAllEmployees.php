<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Employee;

class SelectAllEmployees extends Command
{
    protected $signature = "all:employees";

         public function handle(){
                $employees = Employee::all();

                $this->table(
            [
                'ID',
                'Employee No.',
                'Name',
                'Phone',
                'Email',
                'Department',
                'Position',
                'Hire Date',
                'Salary',
                'Status'
            ],
            $employees->map(function ($emp) {
                return [
                    $emp->employee_id,
                    $emp->employee_number,
                    $emp->name,
                    $emp->phone_number,
                    $emp->email,
                    $emp->department?->name ?? '—',
                    $emp->position?->title ?? '—',
                    $emp->hire_date,
                    $emp->salary,
                    $emp->status,
                ];
            })->toArray()
        );
    }
}
