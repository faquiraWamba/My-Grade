<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class PdfController extends Controller
{
    public function studentReportPDF($semester, $student_id) 
    {
        $data = ['title' => 'RELEVE DE NOTES'];
        $student = Student::with(['class_students' => function($query) {
            $query->where('school_year', date('Y'))->first();
        },'people' ,'class_students.classe.speciality','class_students.course_students.note','class_students.course_students.class_course.course'])
        ->find($student_id);
        $pdf = PDF::loadView('students.pdf_student_notes', compact('semester','student_id','student'));  
        
        return $pdf->download('notesSemestre.pdf',$data);  
    }
    public function studentReportCardPDF($student_id) 
    {
        $data = ['title' => 'RELEVE DE NOTES'];
        $student = Student::with(['class_students' => function($query) {
            $query->where('school_year', date('Y'))->first();
        },'people' ,'class_students.classe.speciality','class_students.course_students.note','class_students.course_students.class_course.course'])
        ->find($student_id);
        $pdf = PDF::loadView('students.pdf_student_card', compact('student_id','student'));  
   
        return $pdf->download('bulettins.pdf',$data);  
    }

}
