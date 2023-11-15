<?php

namespace Database\Seeders;

use App\Models\Class_Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Class_Course::factory()->count(20)->create();

    }
}
