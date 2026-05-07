<?php

namespace Database\Seeders;

use App\Models\Performance;
use Illuminate\Database\Seeder;

class PerformanceSeeder extends Seeder
{
    public function run()
    {
        Performance::insert([
            [
                'employee_id' => 1,
                'review_period' => 'Q1 2025',
                'rating' => 4.10,
                'comments' => 'Consistent output and reliable work ethic',
                'reviewer_id' => 2,
                'review_date' => '2025-03-31',
                'status' => 'Reviewed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 1,
                'review_period' => 'Q2 2025',
                'rating' => 4.30,
                'comments' => 'Improved task completion speed',
                'reviewer_id' => 3,
                'review_date' => '2025-06-30',
                'status' => 'Reviewed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 1,
                'review_period' => 'Q3 2025',
                'rating' => 4.50,
                'comments' => 'Shows leadership in team tasks',
                'reviewer_id' => 4,
                'review_date' => '2025-09-30',
                'status' => 'Reviewed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 1,
                'review_period' => 'Q4 2025',
                'rating' => 4.20,
                'comments' => 'Maintained good performance despite workload',
                'reviewer_id' => 2,
                'review_date' => '2025-12-31',
                'status' => 'Reviewed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 1,
                'review_period' => 'Q1 2026',
                'rating' => 4.40,
                'comments' => 'Strong collaboration with team members',
                'reviewer_id' => 5,
                'review_date' => '2026-03-31',
                'status' => 'Reviewed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 1,
                'review_period' => 'Q2 2026',
                'rating' => 4.60,
                'comments' => 'Excellent problem-solving skills',
                'reviewer_id' => 3,
                'review_date' => '2026-06-30',
                'status' => 'Completed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 1,
                'review_period' => 'Q3 2026',
                'rating' => 4.70,
                'comments' => 'Very proactive in handling tasks',
                'reviewer_id' => 6,
                'review_date' => '2026-09-30',
                'status' => 'Reviewed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 1,
                'review_period' => 'Q4 2026',
                'rating' => 4.80,
                'comments' => 'Shows leadership potential and initiative',
                'reviewer_id' => 2,
                'review_date' => '2026-12-31',
                'status' => 'Reviewed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 1,
                'review_period' => 'Q1 2027',
                'rating' => 4.90,
                'comments' => 'Outstanding performance and reliability',
                'reviewer_id' => 4,
                'review_date' => '2027-03-31',
                'status' => 'Reviewed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 1,
                'review_period' => 'Q2 2027',
                'rating' => 5.00,
                'comments' => 'Exceptional employee, consistently exceeds expectations',
                'reviewer_id' => 5,
                'review_date' => '2027-06-30',
                'status' => 'Completed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}