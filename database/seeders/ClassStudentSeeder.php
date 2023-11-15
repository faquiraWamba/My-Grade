<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $students = Student::where('id', '>', 192)
                        ->where('id','<',203)
                        ->get();

        foreach ($students as $student) {
            DB::table('class__students')->insert([
                'student_id' => $student->id,
                'classe_id' => 13,
                'school_year' => 2023,
                'report_card' => "http://127.0.0.1:8000/api/students/reportCards/$student->registration_number"
            ]);
        }
    }
}
