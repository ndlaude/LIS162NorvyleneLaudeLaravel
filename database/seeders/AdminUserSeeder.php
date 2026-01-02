<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'full_name' => 'Admin User',
            'email' => 'agapadmin@gmail.com',
            'password' => bcrypt('agapadmin'),
            'usertype_id' => 1,
        ]);
    }
}
