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
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'resume' => 'resume1.pdf',
            'status' => 'hired'
        ],
        [
            'applicant_id' => 2,
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'email' => 'jane@example.com',
            'resume' => 'resume2.pdf',
            'status' => 'pending'
        ],
    ]);
}
}
