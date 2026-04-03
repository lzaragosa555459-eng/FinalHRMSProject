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
        'position_id'   => 1,
        'title'         => 'IT Manager',
        'salary'        => 35000,
        'department_id' => 1
    ],
    [
        'position_id'   => 2,
        'title'         => 'HR Manager',
        'salary'        => 32000,
        'department_id' => 2
    ],
    [
        'position_id'   => 3,
        'title'         => 'Software Developer',
        'salary'        => 28000,
        'department_id' => 1
    ],
    [
        'position_id'   => 4,
        'title'         => 'HR Assistant',
        'salary'        => 29000,
        'department_id' => 2
    ],
    [
        'position_id'   => 5,
        'title'         => 'Finance Officer',
        'salary'        => 31000,
        'department_id' => 3
    ],
]);
}
}
