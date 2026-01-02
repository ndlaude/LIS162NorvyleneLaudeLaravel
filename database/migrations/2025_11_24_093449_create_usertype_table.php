<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usertype', function (Blueprint $table) {
            // FIX: Explicitly name the ID 'usertype_id'
            $table->id('usertype_id'); 
            $table->string('usertype_name'); // e.g., Admin, Doctor, Patient
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usertype');
    }
};