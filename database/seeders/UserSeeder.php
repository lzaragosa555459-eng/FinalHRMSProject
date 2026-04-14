<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
{
    User::create([
        'username' => 'admin',
        'employee_id' => null,
        'email' => 'admin@gmail.com',
        'password' => Hash::make('123456'),
        'system_role' => 'admin',
    ]);

    User::create([
        'username' => 'hruser',
        'employee_id' => 6,
        'email' => 'hr@gmail.com',
        'password' => Hash::make('123456'),
        'system_role' => 'hr',
    ]);

    User::create([
        'username' => 'john doe',
        'employee_id' => 1,
        'email' => 'john@gmail.com',
        'password' => Hash::make('doe123'),
        'system_role' => 'employee',
    ]);

    User::create([
        'username' => 'jane smith',
        'employee_id' => 2,
        'email' => 'jane@gmail.com',
        'password' => Hash::make('janeSmith1234'),
        'system_role' => 'hr',
    ]);
        User::create([
        'username' => 'Michael_santos',
        'employee_id' => 3,
        'email' => 'MS@gmail.com',
        'password' => Hash::make('ms123'),
        'system_role' => 'employee',
    ]);

    User::create([
        'username' => 'maria cruz',
        'employee_id' => 4,
        'email' => 'maria@gmail.com',
        'password' => Hash::make('maria123'),
        'system_role' => 'hr',
    ]);    
    
    User::create([
        'username' => 'davidlim',
        'employee_id' => 5,
        'email' => 'dave@gmail.com',
        'password' => Hash::make('1234lim'),
        'system_role' => 'employee',
    ]);


}

}