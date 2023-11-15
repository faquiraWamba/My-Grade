<?php

namespace Database\Seeders;

use App\Models\Class_Course;
use App\Models\Class_Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $class_students = Class_Student::all();
        $class_courses = Class_Course::all();

        foreach ($class_courses as $course) {
            foreach($class_students as $student){
                if($course->class_id == $student->classe_id){
                    DB::table('course_students')->insert([
                        'class_student_id' => $student->id,
                        'class_course_id' => $course->id
                    ]);
                }
            }
           
        }
    }
}
