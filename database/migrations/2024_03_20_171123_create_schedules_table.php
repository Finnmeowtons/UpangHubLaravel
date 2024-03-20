<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->string('day');
            $table->time('start_time');
            $table->time('end_time');
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('teacher_id'); 
            $table->timestamps();

            $table->foreign('course_id')->references('id')->on('courses'); 
            $table->foreign('room_id')->references('id')->on('rooms'); 
            $table->foreign('teacher_id')->references('id')->on('teachers'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
