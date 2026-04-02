<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Position;

class PositionSeeder extends Seeder
{
    public function run()
{
    Position::insert([
        [
            'position_id' => 1,
            'title' => 'Developer',
            'salary' => 30000,
            'department_id' => 1
        ],
        [
            'position_id' => 2,
            'title' => 'HR Manager',
            'salary' => 25000,
            'department_id' => 2
        ],
        [
            'position_id' => 3,
            'title' => 'Accountant',
            'salary' => 28000,
            'department_id' => 3
        ],
    ]);
}
}
