<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Leave;

class LeaveSeeder extends Seeder
{
    public function run()
{
    Leave::insert([
        [
            'employee_id' => 1,
            'start_date' => '2026-04-01',
            'end_date' => '2026-04-03',
            'reason' => 'Sick leave',
            'status' => 'approved'
        ]
    ]);
}
}
