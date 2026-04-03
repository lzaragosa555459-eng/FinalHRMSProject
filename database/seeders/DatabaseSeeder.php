<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            DepartmentSeeder::class,
            PositionSeeder::class,
            ApplicantSeeder::class,
            EmployeeSeeder::class,
            PayrollSeeder::class,
            AttendanceSeeder::class,
            LeaveSeeder::class,
            EventSeeder::class,
        ]);
    }
}
