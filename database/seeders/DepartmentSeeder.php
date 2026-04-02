<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
   public function run()
{
    Department::insert([
        [
            'department_id' => 1,
            'name' => 'IT',
            'description' => 'Handles technical systems'
        ],
        [
            'department_id' => 2,
            'name' => 'HR',
            'description' => 'Handles employees'
        ],
        [
            'department_id' => 3,
            'name' => 'Finance',
            'description' => 'Handles finances'
        ],
    ]);
}
}
