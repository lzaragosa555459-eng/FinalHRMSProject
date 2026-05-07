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
        $employees = Employee::with('position')->get();

        foreach ($employees as $emp) {

            $baseSalary = match ($emp->position_id) {
                1 => 40000,
                2 => 35000,
                3 => 30000,
                4 => 28000,
                5 => 25000,
                default => 20000,
            };

            $periods = [
                [Carbon::create(2026, 4, 1), Carbon::create(2026, 4, 15)],
                [Carbon::create(2026, 4, 16), Carbon::create(2026, 4, 30)],
            ];

            foreach ($periods as $index => [$start, $end]) {

                $days = $start->diffInDays($end) + 1;
                $dailyRate = $baseSalary / 30;

                $basic = $dailyRate * $days;
                $allowances = rand(500, 3000);
                $gross = $basic + $allowances;

                // ✅ MATCH CONTROLLER FORMAT
                $cutoff = ($index === 0) ? 'first' : 'second';

                // ✅ SAME LOGIC AS CONTROLLER
                if ($cutoff == 'first') {
                    $tax = $gross * 0.10;
                    $sss = 0;
                    $philhealth = 0;
                    $pagibig = 0;
                } else {
                    $tax = 0;
                    $sss = $gross * 0.045;
                    $philhealth = $gross * 0.03;
                    $pagibig = $gross * 0.02;
                }

                $deduction = $tax + $sss + $philhealth + $pagibig;
                $net = $gross - $deduction;

                Payroll::create([
                    'employee_id'  => $emp->employee_id,
                    'period_start' => $start,
                    'period_end'   => $end,

                    'cutoff_label' => $cutoff,

                    'basic_salary' => $basic,
                    'allowances'   => $allowances,
                    'gross_salary' => $gross,
                    'deduction'    => $deduction,
                    'net_salary'   => $net,

                    'pay_date'     => now(),
                    'status'       => 'Paid',
                ]);
            }
        }
    }
}