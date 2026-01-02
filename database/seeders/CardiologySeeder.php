<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CardiologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure Cardiology department exists
        $deptId = DB::table('departments')->insertGetId([
            'department_name' => 'Cardiology',
            'location' => 'Room 12',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create 5 doctor users with specific ids (non-conflicting high numbers)
        $doctorUsers = [
            ['user_id' => 201, 'full_name' => 'Dr. Juan Dela Cruz', 'email' => 'juan@cardiology.com', 'password' => Hash::make('password'), 'usertype_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 202, 'full_name' => 'Dr. Maria Santos', 'email' => 'maria@cardiology.com', 'password' => Hash::make('password'), 'usertype_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 203, 'full_name' => 'Dr. Ana Reyes', 'email' => 'ana@cardiology.com', 'password' => Hash::make('password'), 'usertype_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 204, 'full_name' => 'Dr. Pedro Cruz', 'email' => 'pedro@cardiology.com', 'password' => Hash::make('password'), 'usertype_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 205, 'full_name' => 'Dr. Liza Gomez', 'email' => 'liza@cardiology.com', 'password' => Hash::make('password'), 'usertype_id' => 2, 'created_at' => now(), 'updated_at' => now()],
        ];

        foreach ($doctorUsers as $du) {
            DB::table('user')->updateOrInsert(['user_id' => $du['user_id']], $du);
        }

        // Link doctors to the Cardiology department
        foreach ([201,202,203,204,205] as $docId) {
            DB::table('doctor_dept')->updateOrInsert([
                'doctor_id' => $docId,
                'department_id' => $deptId,
            ], ['created_at' => now(), 'updated_at' => now()]);
        }

        // Insert schedules, letting schedule_id auto-increment
        $schedules = [
            ['doctor_id' => 201, 'day' => 'Monday', 'time' => '09:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['doctor_id' => 202, 'day' => 'Tuesday', 'time' => '13:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['doctor_id' => 203, 'day' => 'Wednesday', 'time' => '08:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['doctor_id' => 204, 'day' => 'Thursday', 'time' => '10:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['doctor_id' => 205, 'day' => 'Friday', 'time' => '09:00:00', 'created_at' => now(), 'updated_at' => now()],
        ];

        foreach ($schedules as $s) {
            DB::table('schedule')->insert($s);
        }

        // Optionally create a test patient for quick manual testing
        DB::table('user')->updateOrInsert(['email' => 'patient@example.com'], [
            'full_name' => 'Test Patient',
            'email' => 'patient@example.com',
            'password' => Hash::make('password'),
            'usertype_id' => 3,
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
