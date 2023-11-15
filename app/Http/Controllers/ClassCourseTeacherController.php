<?php

namespace App\Http\Controllers;

use App\Models\Class_course_teacher;
use App\Http\Requests\StoreClass_course_teacherRequest;
use App\Http\Requests\UpdateClass_course_teacherRequest;
use App\Models\Class_Course;
use App\Models\Classe;
use App\Models\Course;
use App\Models\Course_student;
use App\Models\Course_teacher;
use App\Models\Role_User;
use App\Models\Speciality;
use Illuminate\Contracts\View\View;

class ClassCourseTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($teacher_course_id,$teacher_id = null):View
    {
        //
      
        $teacherCourse = Course_teacher::with('teacher.people')->with('course')->find($teacher_course_id);
        // dd($teacherCourse);
        $classCourses = Class_Course_Teacher::where('teacher_course_id', $teacherCourse->id)
        ->with('class_course.classe.speciality')
        ->get();
        
        return view('teachers.teacher_classes',compact('classCourses','teacherCourse','teacher_id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($course_teacher_id):View
    {
        //
        $course_id = Course_teacher::find($course_teacher_id);
        $course_id=$course_id->course_id;
        $specialities=Speciality::all();
         $classes =Classe::whereHas('class_courses', function ($query) use($course_id)  {
    
                $query->where('course_id', $course_id);  }
            )->with(['class_courses' => function ($query) use ($course_id) {
                $query->where('course_id', $course_id);
            }])->get();
            
            // dd($classes);

        return view('classes.add_class_to_teacher',compact('classes','specialities','course_teacher_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClass_course_teacherRequest $request,$course_teacher_id)
    {
        //
        $teacher_id = Course_teacher::find($course_teacher_id);
        $teacher_id=$teacher_id->id;
        $existingClass = Class_course_teacher::where('teacher_course_id', $course_teacher_id)
                                            -> where('class_course_id',$request->class_course_id)
                                            ->first();
    
        if ($existingClass) {
            $msg = 'Cette classe a déja été attribué';
            session()->flash('error', $msg);
            return redirect(route('teacher_class_course.create',['course_teacher_id' => $course_teacher_id]));
        } else {
            // dd($course_teacher_id);
            Class_course_teacher::create(
                array_merge(
                    $request->except(["_token"]),
                    ['teacher_course_id' => $course_teacher_id],
                )
            );
            return redirect(route('my_class_courses',['teacher_course_id' => $course_teacher_id]));

            // Vous pouvez rediriger vers une autre route ou afficher un autre message ici
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($teacher_course_id, $class_course_id, $admin = null):View
    {
        //
        // $class = Class_Course::with('classe.class_students')->find($class_course_id);
        

        $students = Class_course_teacher::where('teacher_course_id',$teacher_course_id)
                                ->where('class_course_id',$class_course_id)
                                ->with('class_course.course_student.note','class_course.course_student.class_student.student.people')
                                ->first();
        return view('teachers.teacher_classe', compact('students', 'admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Class_course_teacher $class_course_teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClass_course_teacherRequest $request, Class_course_teacher $class_course_teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($teacher_course_id, $class_course_id)
    {
        //
        $class_course_teacher = Class_course_teacher::where('teacher_course_id',$teacher_course_id)
        ->where('class_course_id',$class_course_id)
        ->first();
        if($class_course_teacher){
           $delete= $class_course_teacher->delete();
           if($delete){
            return redirect()->route('my_class_courses',['teacher_course_id'=>$teacher_course_id])->with('success','la classe a été retiré');
           }else{
            return redirect()->route('my_class_courses',['teacher_course_id'=>$teacher_course_id])->with('error','Une erreur s\'est produite');
           }

        }else{
            return redirect()->route('my_class_courses',['teacher_course_id'=>$teacher_course_id])->with('error', 'la classe n\'existe pas');
        }
    }
}
