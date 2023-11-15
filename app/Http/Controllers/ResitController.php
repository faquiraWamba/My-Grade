<?php

namespace App\Http\Controllers;

use App\Models\Course_student;
use Illuminate\Http\Request;

class ResitController extends Controller
{
    public function sendToResit(Request $request)
{
    $students = $request->get('students');
    // dd($students);
    foreach ($students as $studentId => $courseIds) {
        foreach ($courseIds as $courseId) {
            $course_student = Course_student::where('class_course_id', $courseId)
                                            ->where('class_student_id', $studentId)
                                            ->first();
            $notes = $course_student->note;
            if($notes){
                foreach ($notes as $note) {
                    if($note->type = "SN"){
                        
                        $note->status = 0;
                        $note->save();
                    }
                }
            }
            $course_student->catchup = 1;
            $course_student->save();
        }
    }
    return redirect()->back()->with('success', 'Les étudiants ont été envoyé en rattrapage!');
}

}
