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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->float('note');
            $table->enum('type',['CC','SN']);
            $table->string('appreciation');
            $table->boolean('status')->default('0');
            $table->boolean('modify')->default('0');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('course_student_id');
            $table->string('anonymity')->nullable();
            $table->foreign('course_student_id')->references('id')->on('course_students')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
