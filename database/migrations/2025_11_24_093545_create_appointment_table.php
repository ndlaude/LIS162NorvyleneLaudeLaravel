<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointment', function (Blueprint $table) {
            $table->id('appointment_id');

            // Link to the user table (patient)
            $table->foreignId('patient_id')->references('user_id')->on('user')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            // Link to the schedule table
            $table->foreignId('schedule_id')->references('schedule_id')->on('schedule')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->date('date');
            $table->enum('status', ['Pending','Confirmed','Completed','Cancelled'])->default('Pending');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointment');
    }
};