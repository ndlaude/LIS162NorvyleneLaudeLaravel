<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ensure user types exist
        $this->call(UsertypeSeeder::class);

        // Seed admin user
        $this->call(AdminUserSeeder::class);

        // Seed Cardiology doctors, schedules, and a test patient
        $this->call(CardiologySeeder::class);

        // Seed other departments, doctors, and schedules
        $this->call(DepartmentSeeder::class);

        // Optionally keep the original test user
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
