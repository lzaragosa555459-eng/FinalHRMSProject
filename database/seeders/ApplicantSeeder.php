<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Applicant;

class ApplicantSeeder extends Seeder
{
   public function run()
{
    Applicant::insert([
        [
            'applicant_id' => 1,
            'first_name'   => 'John',
            'last_name'    => 'Doe',
            'email'        => 'john@example.com',
            'resume'       => 'resume1.pdf',
            'status'       => 'hired',
            'created_at'   => now(),
            'updated_at'   => now(),
        ],
        [
            'applicant_id' => 2,
            'first_name'   => 'Jane',
            'last_name'    => 'Smith',
            'email'        => 'jane@example.com',
            'resume'       => 'resume2.pdf',
            'status'       => 'hired',
            'created_at'   => now(),
            'updated_at'   => now(),
        ],
        [
            'applicant_id' => 3,
            'first_name'   => 'Michael',
            'last_name'    => 'Santos',
            'email'        => 'michael.santos@example.com',
            'resume'       => 'resume3.pdf',
            'status'       => 'hired',
            'created_at'   => now(),
            'updated_at'   => now(),
        ],
        [
            'applicant_id' => 4,
            'first_name'   => 'Maria',
            'last_name'    => 'Cruz',
            'email'        => 'maria.cruz@example.com',
            'resume'       => 'resume4.pdf',
            'status'       => 'hired',
            'created_at'   => now(),
            'updated_at'   => now(),
        ],
        [
            'applicant_id' => 5,
            'first_name'   => 'David',
            'last_name'    => 'Lim',
            'email'        => 'david.lim@example.com',
            'resume'       => 'resume5.pdf',
            'status'       => 'hired',
            'created_at'   => now(),
            'updated_at'   => now(),
        ],
    ]);
}
}
