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
            'basic_salary' => 30000,
            'allowances' => 2000,
            'deduction' => 1000,
            'net_salary' => 31000,
            'pay_date' => now()
        ]
    ]);
}
}
