<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            ['department_name' => 'Neurology', 'location' => 'Room 11'],
            ['department_name' => 'Pediatrics', 'location' => 'Room 13'],
            ['department_name' => 'Orthopedics', 'location' => 'Room 14'],
            ['department_name' => 'Radiology', 'location' => 'Room 15'],
            ['department_name' => 'Oncology', 'location' => 'Room 16'],
            ['department_name' => 'Dermatology', 'location' => 'Room 30'],
            ['department_name' => 'Psychiatry', 'location' => 'Room 17'],
            ['department_name' => 'General Surgery', 'location' => 'Room 18'],
        ];

        $deptData = [];
        foreach ($departments as $dept) {
            $deptData[$dept['department_name']] = DB::table('departments')->insertGetId([
                'department_name' => $dept['department_name'],
                'location' => $dept['location'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Doctors data for each department
        $doctorsData = [
            'Neurology' => [
                ['user_id' => 301, 'full_name' => 'Dr. Carlo Mendoza', 'email' => 'carlo@neurology.com', 'day' => 'Monday', 'time' => '13:00:00'],
                ['user_id' => 302, 'full_name' => 'Dr. Nina Flores', 'email' => 'nina@neurology.com', 'day' => 'Tuesday', 'time' => '09:00:00'],
                ['user_id' => 303, 'full_name' => 'Dr. Mark Villanueva', 'email' => 'mark@neurology.com', 'day' => 'Wednesday', 'time' => '14:00:00'],
                ['user_id' => 304, 'full_name' => 'Dr. Paul Navarro', 'email' => 'paul@neurology.com', 'day' => 'Friday', 'time' => '13:00:00'],
                ['user_id' => 305, 'full_name' => 'Dr. Elena Rossi', 'email' => 'elena@neurology.com', 'day' => 'Thursday', 'time' => '10:00:00'],
            ],
            'Pediatrics' => [
                ['user_id' => 306, 'full_name' => 'Dr. Sofia Alvarez', 'email' => 'sofia@pediatrics.com', 'day' => 'Monday', 'time' => '08:00:00'],
                ['user_id' => 307, 'full_name' => 'Dr. Miguel Torres', 'email' => 'miguel@pediatrics.com', 'day' => 'Tuesday', 'time' => '09:00:00'],
            ],
            'Orthopedics' => [
                ['user_id' => 308, 'full_name' => 'Dr. Roberto Garcia', 'email' => 'roberto@orthopedics.com', 'day' => 'Wednesday', 'time' => '10:00:00'],
                ['user_id' => 309, 'full_name' => 'Dr. Laura Martinez', 'email' => 'laura@orthopedics.com', 'day' => 'Thursday', 'time' => '11:00:00'],
            ],
            'Radiology' => [
                ['user_id' => 310, 'full_name' => 'Dr. Antonio Lopez', 'email' => 'antonio@radiology.com', 'day' => 'Friday', 'time' => '12:00:00'],
            ],
            'Oncology' => [
                ['user_id' => 311, 'full_name' => 'Dr. Carmen Ruiz', 'email' => 'carmen@oncology.com', 'day' => 'Monday', 'time' => '14:00:00'],
                ['user_id' => 312, 'full_name' => 'Dr. Diego Fernandez', 'email' => 'diego@oncology.com', 'day' => 'Tuesday', 'time' => '15:00:00'],
            ],
            'Dermatology' => [
                ['user_id' => 313, 'full_name' => 'Dr. Clara Skin', 'email' => 'clara@dermatology.com', 'day' => 'Wednesday', 'time' => '10:00:00'],
            ],
            'Psychiatry' => [
                ['user_id' => 314, 'full_name' => 'Dr. Victor Morales', 'email' => 'victor@psychiatry.com', 'day' => 'Thursday', 'time' => '16:00:00'],
            ],
            'General Surgery' => [
                ['user_id' => 315, 'full_name' => 'Dr. Isabel Jimenez', 'email' => 'isabel@generalsurgery.com', 'day' => 'Friday', 'time' => '08:00:00'],
                ['user_id' => 316, 'full_name' => 'Dr. Francisco Castro', 'email' => 'francisco@generalsurgery.com', 'day' => 'Monday', 'time' => '09:00:00'],
            ],
        ];

        foreach ($doctorsData as $deptName => $doctors) {
            $deptId = $deptData[$deptName];
            foreach ($doctors as $doc) {
                // Insert doctor user
                DB::table('user')->updateOrInsert(['user_id' => $doc['user_id']], [
                    'user_id' => $doc['user_id'],
                    'full_name' => $doc['full_name'],
                    'email' => $doc['email'],
                    'password' => Hash::make('password'),
                    'usertype_id' => 2, // Doctor
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Link doctor to department
                DB::table('doctor_dept')->updateOrInsert([
                    'doctor_id' => $doc['user_id'],
                    'department_id' => $deptId,
                ], ['created_at' => now(), 'updated_at' => now()]);

                // Insert schedule
                DB::table('schedule')->insert([
                    'doctor_id' => $doc['user_id'],
                    'day' => $doc['day'],
                    'time' => $doc['time'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
