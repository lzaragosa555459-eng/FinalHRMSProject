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
        'email' => 'admin@gmail.com',
        'password' => Hash::make('123456'),
    ]);

    User::create([
        'username' => 'hruser',
        'email' => 'hr@gmail.com',
        'password' => Hash::make('123456'),
    ]);
}

}