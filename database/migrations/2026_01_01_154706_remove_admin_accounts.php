<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Remove all admin accounts (usertype_id = 1)
        DB::table('user')->where('usertype_id', 1)->delete();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Optionally, you could recreate admin accounts here if needed
        // But since we're removing them permanently, down is left empty
    }
};
