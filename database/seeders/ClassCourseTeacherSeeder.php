<?php

namespace Database\Seeders;

use App\Models\Class_Course;
use App\Models\Course_teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassCourseTeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $course_teachers = Course_teacher::all();
        $class_courses = Class_Course::all();

        foreach($course_teachers as $teacher){
            foreach ($class_courses as $course) {
            if($course->course_id == $teacher->course_id){
                    DB::table('class_course_teachers')->insert([
                        'teacher_course_id' => $teacher->id,
                        'class_course_id' => $course->id
                    ]);
                }
            }
           
        }
    }
    
}
