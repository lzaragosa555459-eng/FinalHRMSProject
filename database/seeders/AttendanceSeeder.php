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
        ['attendance_id' => 1, 'employee_id' => 1, 'date' => '2026-04-01', 'time_in' => '08:00:00', 'time_out' => '17:00:00', 'status' => 'Present'],
        ['attendance_id' => 2, 'employee_id' => 2, 'date' => '2026-04-01', 'time_in' => '08:15:00', 'time_out' => '17:10:00', 'status' => 'Late'],
        ['attendance_id' => 3, 'employee_id' => 3, 'date' => '2026-04-01', 'time_in' => '08:05:00', 'time_out' => '17:00:00', 'status' => 'Present'],
        ['attendance_id' => 4, 'employee_id' => 4, 'date' => '2026-04-01', 'time_in' => '08:30:00', 'time_out' => '17:00:00', 'status' => 'Late'],
        ['attendance_id' => 5, 'employee_id' => 5, 'date' => '2026-04-01', 'time_in' => '08:00:00', 'time_out' => '17:00:00', 'status' => 'Present'],

        ['attendance_id' => 6, 'employee_id' => 1, 'date' => '2026-04-02', 'time_in' => '08:00:00', 'time_out' => '17:00:00', 'status' => 'Present'],
        ['attendance_id' => 7, 'employee_id' => 2, 'date' => '2026-04-02', 'time_in' => '08:20:00', 'time_out' => '17:00:00', 'status' => 'Late'],
        ['attendance_id' => 8, 'employee_id' => 3, 'date' => '2026-04-02', 'time_in' => '08:00:00', 'time_out' => '17:00:00', 'status' => 'Present'],
        ['attendance_id' => 9, 'employee_id' => 4, 'date' => '2026-04-02', 'time_in' => '08:10:00', 'time_out' => '17:00:00', 'status' => 'Present'],
        ['attendance_id' => 10, 'employee_id' => 5, 'date' => '2026-04-02', 'time_in' => '08:25:00', 'time_out' => '17:00:00', 'status' => 'Late'],

        ['attendance_id' => 11, 'employee_id' => 1, 'date' => '2026-04-03', 'time_in' => '08:00:00', 'time_out' => '17:00:00', 'status' => 'Present'],
        ['attendance_id' => 12, 'employee_id' => 2, 'date' => '2026-04-03', 'time_in' => '08:05:00', 'time_out' => '17:00:00', 'status' => 'Present'],
        ['attendance_id' => 13, 'employee_id' => 3, 'date' => '2026-04-03', 'time_in' => '08:40:00', 'time_out' => '17:00:00', 'status' => 'Late'],
        ['attendance_id' => 14, 'employee_id' => 4, 'date' => '2026-04-03', 'time_in' => '08:00:00', 'time_out' => '17:00:00', 'status' => 'Present'],
        ['attendance_id' => 15, 'employee_id' => 5, 'date' => '2026-04-03', 'time_in' => '08:10:00', 'time_out' => '17:00:00', 'status' => 'Present'],

    ]);
}
}
