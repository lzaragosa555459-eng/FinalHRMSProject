<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Employee;
use App\Models\Payroll;

class GeneratePayroll extends Command
{
    protected $signature = 'generate:payroll';

    public function handle()
    {
        $employees = Employee::all();

        foreach ($employees as $emp) {

            // Example computation
            $basic = $emp->salary ?? 0;
            $allowances = 2000;
            $deduction = 1000;

            $net = $basic + $allowances - $deduction;

        }

        $this->info("✅ Payroll generated successfully! Net Salary: $net");
    }
}
