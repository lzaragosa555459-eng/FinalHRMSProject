<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Payroll;


class PayrollSeeder extends Seeder
{
    public function run()
    {
        Payroll::insert([
            [
                'employee_id' => 1,
                'period_start' => '2026-04-01',
                'period_end' => '2026-04-15',
                'cutoff_label' => '1st Cutoff',

                'basic_salary' => 30000,
                'allowances' => 2000,
                'gross_salary' => 32000,

                'deduction' => 1000,
                'net_salary' => 31000,

                'pay_date' => now(),
                'status' => 'Paid',

                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
