<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EventAttendanceSeeder extends Seeder
{
  
    public function run(): void
    {
        $now = Carbon::now();
        DB::table('event_attendances')->insert([
            [
                'event_id' => 1,
                'employee_id' => 1,
                'status' => 'attended',
                'check_in_time' => '2026-04-10 08:50:00',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'event_id' => 1,
                'employee_id' => 3,
                'status' => 'attended',
                'check_in_time' => '2026-04-10 08:55:00',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'event_id' => 2,
                'employee_id' => 2,
                'status' => 'registered',
                'check_in_time' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'event_id' => 2,
                'employee_id' => 4,
                'status' => 'attended',
                'check_in_time' => '2026-04-15 12:45:00',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'event_id' => 3,
                'employee_id' => 5,
                'status' => 'attended',
                'check_in_time' => '2026-04-20 07:50:00',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
