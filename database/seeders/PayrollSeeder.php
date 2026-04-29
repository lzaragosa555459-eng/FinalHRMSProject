<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payroll;
use App\Models\Employee;
use Carbon\Carbon;

class PayrollSeeder extends Seeder
{
    public function run()
    {
        $employees = Employee::all();

        foreach ($employees as $emp) {

            // simulate position salary (you can replace with real relation later)
            $baseSalary = match ($emp->position_id) {
                1 => 40000,
                2 => 35000,
                3 => 30000,
                4 => 28000,
                5 => 25000,
                default => 20000,
            };

            // cutoffs
            $periodStart1 = Carbon::create(2026, 4, 1);
            $periodEnd1   = Carbon::create(2026, 4, 15);

            $periodStart2 = Carbon::create(2026, 4, 16);
            $periodEnd2   = Carbon::create(2026, 4, 30);

            foreach ([[$periodStart1, $periodEnd1, '1st Cutoff'], [$periodStart2, $periodEnd2, '2nd Cutoff']] as [$start, $end, $label]) {

                $days = $start->diffInDays($end) + 1;
                $dailyRate = $baseSalary / 30;

                $basic = $dailyRate * $days;

                $allowances = rand(500, 3000);
                $deduction  = rand(200, 1500);

                $gross = $basic + $allowances;
                $net   = $gross - $deduction;

                Payroll::create([
                    'employee_id'   => $emp->employee_id,
                    'period_start'  => $start,
                    'period_end'    => $end,
                    'cutoff_label'  => $label,

                    'basic_salary'  => $basic,
                    'allowances'    => $allowances,
                    'gross_salary'  => $gross,
                    'deduction'     => $deduction,
                    'net_salary'    => $net,

                    'pay_date'      => now(),
                    'status'        => 'Paid',
                ]);
            }
        }
    }
}