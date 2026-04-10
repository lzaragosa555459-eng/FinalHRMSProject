<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('events')->insert([
            
            [
                'title' => 'HR Monthly Meeting',
                'start_datetime' => Carbon::parse('2026-04-10 09:00:00'),
                'end_datetime' => Carbon::parse('2026-04-10 11:00:00'),
                'location' => 'Conference Room A',
                'department_id' => 1,
                'description' => 'Monthly HR planning and updates.',
                'event_type' => 'meeting',
                'max_participants' => 20,
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'title' => 'Leadership Training',
                'start_datetime' => Carbon::parse('2026-04-15 13:00:00'),
                'end_datetime' => Carbon::parse('2026-04-15 17:00:00'),
                'location' => 'Training Room',
                'department_id' => 2,
                'description' => 'Training for future team leaders.',
                'event_type' => 'training',
                'max_participants' => 30,
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'title' => 'Company Team Building',
                'start_datetime' => Carbon::parse('2026-04-20 08:00:00'),
                'end_datetime' => Carbon::parse('2026-04-20 17:00:00'),
                'location' => 'Resort',
                'department_id' => 1,
                'description' => 'Outdoor activities for all employees.',
                'event_type' => 'team_building',
                'max_participants' => 100,
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'title' => 'Workshop on Laravel',
                'start_datetime' => Carbon::parse('2026-04-25 10:00:00'),
                'end_datetime' => Carbon::parse('2026-04-25 15:00:00'),
                'location' => 'Online',
                'department_id' => 3,
                'description' => 'Hands-on Laravel workshop.',
                'event_type' => 'workshop',
                'max_participants' => 50,
                'status' => 'draft',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'title' => 'Company Anniversary Party',
                'start_datetime' => Carbon::parse('2026-04-30 18:00:00'),
                'end_datetime' => Carbon::parse('2026-04-30 23:59:59'),
                'location' => 'Grand Hall',
                'department_id' => 2,
                'description' => 'Celebration event for all employees.',
                'event_type' => 'social',
                'max_participants' => 200,
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            [
                'title' => 'HR Policy Review Session',
                'start_datetime' => Carbon::parse('2026-05-02 09:00:00'),
                'end_datetime' => Carbon::parse('2026-05-02 11:00:00'),
                'location' => 'Conference Room B',
                'department_id' => 1,
                'description' => 'Review and update HR policies.',
                'event_type' => 'meeting',
                'max_participants' => 25,
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'title' => 'Recruitment Strategy Workshop',
                'start_datetime' => Carbon::parse('2026-05-05 13:00:00'),
                'end_datetime' => Carbon::parse('2026-05-05 16:00:00'),
                'location' => 'HR Training Room',
                'department_id' => 1,
                'description' => 'Improving hiring and recruitment processes.',
                'event_type' => 'workshop',
                'max_participants' => 30,
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'title' => 'Employee Engagement Planning',
                'start_datetime' => Carbon::parse('2026-05-10 10:00:00'),
                'end_datetime' => Carbon::parse('2026-05-10 12:00:00'),
                'location' => 'Meeting Room 2',
                'department_id' => 1,
                'description' => 'Planning activities to improve employee engagement.',
                'event_type' => 'team_building',
                'max_participants' => 40,
                'status' => 'draft',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'title' => 'HR Compliance Training',
                'start_datetime' => Carbon::parse('2026-05-15 09:00:00'),
                'end_datetime' => Carbon::parse('2026-05-15 17:00:00'),
                'location' => 'Online',
                'department_id' => 1,
                'description' => 'Mandatory compliance and legal HR training.',
                'event_type' => 'training',
                'max_participants' => 50,
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}