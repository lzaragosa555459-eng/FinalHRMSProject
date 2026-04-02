<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Attendance;

class AttendanceSeeder extends Seeder
{
    public function run()
{
    Attendance::insert([
        [
            'employee_id' => 1,
            'date' => now(),
            'time_in' => '08:00:00',
            'time_out' => '17:00:00',
            'status' => 'Present'
        ]
    ]);
}
}
