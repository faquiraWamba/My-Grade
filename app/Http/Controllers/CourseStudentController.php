<?php

namespace App\Http\Controllers;

use App\Models\Course_student;
use App\Http\Requests\StoreCourse_studentRequest;
use App\Http\Requests\UpdateCourse_studentRequest;
use App\Models\Course;
use App\Models\User;
use Illuminate\Contracts\View\View;

class CourseStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($student_id=null)
    {
        //
        if(!$student_id){
            $user_id=auth()->user()->id;
            $user=User::with('people.students.class_students')->find($user_id);
            // dd($user);
            foreach($user->people->students[0]->class_students as $classe){
                if($classe->school_year == date('Y')){
                    $student_id = $classe->id;
                    break;
                }

            };
        }
        $course_students = Course_student::where('class_student_id',$student_id)
                    ->with('class_course.course')
                    ->get();
        $index=0;
        // dd($course_students);
        return view('students.course_students', compact('course_students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourse_studentRequest $request,$class_student_id, $class_course_id)
    {
        //
        $exist_course_student = Course_student::where('class_student_id',$class_student_id)
                                            ->where('class_course_id', $class_course_id)
                                            ->first();
                                            // dd(isset($exist_course_student));
        if($exist_course_student){

            return redirect()->route('class_courses')->with('error','vous suivez déja ce cours');

            // redirect()->route('class_courses')->with();
            
        }else{
            $course_student = new Course_student();
            $course_student->class_student_id = $class_student_id;
            $course_student->class_course_id = $class_course_id;
            $course_student->save();

            return redirect()->route('class_courses')->with('success','vous venez d\'ajouter un cours a vos cours suivies');
            // redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($course_student_id, $course_id):View
    {
        //
        $course_student=Course_student::with('note')->find($course_student_id);
        $course=Course::find($course_id);
        return view('students.course_student',compact('course_student','course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course_student $course_student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourse_studentRequest $request, Course_student $course_student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($course_student_id)
    {
        //
        $course_student=Course_student::find($course_student_id);

        if($course_student){
            $course_student->delete();
            return redirect()->route('course_students')->with('success','vous venez de supprimer un cours parmi vos cours suivies');
        }else{
            return redirect()->route('course_students')->with('error','Ce cours n\'existe pas');

        }                            
    }
}
