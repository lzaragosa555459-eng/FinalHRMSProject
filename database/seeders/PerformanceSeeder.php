<?php

namespace Database\Seeders;

use App\Models\Performance;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerformanceSeeder extends Seeder
{
    public function run()
    {
        Performance::insert([
            [
                'employee_id' => 3, // Michael Santos
                'review_period' => 'Q1 2026',
                'rating' => 4.20,
                'comments' => 'Consistent performance and good teamwork',
                'reviewer_id' => 1, // John Doe (head)
                'review_date' => '2026-03-31',
                'status' => 'Reviewed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 4, // Maria Cruz
                'review_period' => 'Q1 2026',
                'rating' => 3.90,
                'comments' => 'Good output but needs to improve speed',
                'reviewer_id' => 2, // Jane Smith (head)
                'review_date' => '2026-03-31',
                'status' => 'Completed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 5, // David Lim
                'review_period' => 'Q1 2026',
                'rating' => 4.70,
                'comments' => 'Excellent work and leadership potential',
                'reviewer_id' => 1,
                'review_date' => '2026-03-31',
                'status' => 'Reviewed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}