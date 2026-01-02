<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsertypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['usertype_id' => 1, 'usertype_name' => 'Admin', 'created_at' => now(), 'updated_at' => now()],
            ['usertype_id' => 2, 'usertype_name' => 'Doctor', 'created_at' => now(), 'updated_at' => now()],
            ['usertype_id' => 3, 'usertype_name' => 'Patient', 'created_at' => now(), 'updated_at' => now()],
        ];

        foreach ($types as $t) {
            DB::table('usertype')->updateOrInsert(['usertype_id' => $t['usertype_id']], $t);
        }
    }
}