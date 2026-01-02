<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Assuming doctor_id 1-5 exist, create schedules with schedule_id 1-5
        DB::table('schedule')->insert([
            [
                'schedule_id' => 1,
                'doctor_id' => 1,
                'day' => 'Monday',
                'time' => '09:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'schedule_id' => 2,
                'doctor_id' => 2,
                'day' => 'Tuesday',
                'time' => '13:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'schedule_id' => 3,
                'doctor_id' => 3,
                'day' => 'Wednesday',
                'time' => '08:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'schedule_id' => 4,
                'doctor_id' => 4,
                'day' => 'Thursday',
                'time' => '10:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'schedule_id' => 5,
                'doctor_id' => 5,
                'day' => 'Friday',
                'time' => '09:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
