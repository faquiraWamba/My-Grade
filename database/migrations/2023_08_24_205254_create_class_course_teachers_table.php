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
        Schema::create('class_course_teachers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_course_id');
            $table->unsignedBigInteger('class_course_id');
            $table->foreign('teacher_course_id')->references('id')->on('course_teachers')->onDelete('cascade');
            $table->foreign('class_course_id')->references('id')->on('class__courses')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_course_teachers');
    }
};
