<?php

namespace Database\Seeders;

use App\Models\Class_course_teacher;
use App\Models\Classe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

function grade($note){
    if($note<8){
        $type='faible';
    }else if($note>=8 && $note<10){
        $type='mediocre';
    }else if($note>=10 && $note<12){
        $type='passable';
    }else if($note>=12 && $note<14){
        $type='Assez bien';
    }else if($note>=14 && $note<17){
        $type='bien';
    }else if($note>=17 && $note<19){
        $type='Très bien';
    }else{$type='Excellent';}
    return $type;
}
class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        // 
        $classe = Classe::with('class_courses.course_student')->find(3);
       

        foreach ($classe->class_courses as $class) {
            $teacher = Class_course_teacher::where('class_course_id',$class->id)
                 ->with('course_teachers.teacher.people.users')
                 ->first();
            if ($teacher) {
                foreach($class->course_student as $student){
                    $note=rand(10,19);
                    DB::table('notes')->insert([
                        'note' => $note,
                        'type'=> 'SN',
                        'appreciation' => grade($note),
                        'status'=>1,
                        'course_student_id'=>$student->id,
                        'user_id'=>$teacher->course_teachers->teacher->people->users->id
                    ]);
                }
            }
        }
    }
}
