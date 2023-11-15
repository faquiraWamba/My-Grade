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
        Schema::create('notices', function (Blueprint $table) {
            $table->id();
            $table->text('text');
            $table->date('addDate');
            $table->unsignedBigInteger('course_student_id');
            $table->unsignedBigInteger('teacher_course_id');
            $table->foreign('course_student_id')->references('id')->on('course_students')->onDelete('cascade');
            $table->foreign('teacher_course_id')->references('id')->on('course_teachers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notices');
    }
};
