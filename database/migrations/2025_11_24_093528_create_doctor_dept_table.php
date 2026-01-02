<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('doctor_dept', function (Blueprint $table) {
            $table->id('doctor_dept_id'); // Good practice to name the PK

            // Link to the 'user' table (which now uses 'user_id')
            $table->foreignId('doctor_id')->references('user_id')->on('user')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            // Link to the 'departments' table (ensure this matches that migration!)
            $table->foreignId('department_id')->references('department_id')->on('departments')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doctor_dept');
    }
};