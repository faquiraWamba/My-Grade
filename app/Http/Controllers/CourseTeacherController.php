<?php

namespace App\Http\Controllers;

use App\Models\Course_teacher;
use App\Http\Requests\StoreCourse_teacherRequest;
use App\Http\Requests\UpdateCourse_teacherRequest;
use App\Models\Course;
use App\Models\Person;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CourseTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        $index= 0;
        $id = auth()->user()->id;
        $person= User::with('people.teachers')->find($id);
        $id = $person->people->teachers[0]->id;

        $courses = Course_teacher::where('teacher_id',$id)->with('course')->get();
        // dd($courses);
        
        return View('teachers.teacher_courses', compact('courses','index','id'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create( $teacher_id, Request $request)
    {

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store( $teacher_id, StoreCourse_teacherRequest $request)
    {
        //
        $existingCourse = Course_teacher::where('course_id', $request->course_id)
                              ->where('teacher_id', $teacher_id)->first();
    
        if ($existingCourse) {
            $msg = 'le cours a déjà été ajouté pour ce semestre et cette année';
            session()->flash('error', $msg);
            return redirect(route('teacher',['id' => $teacher_id]));
        } else {
            Course_teacher::create(
                array_merge(
                    $request->except(["_token"]),
                    ['teacher_id' => $teacher_id]
                )
            );
            $msg = 'le cours a  été ajouté ';
            session()->flash('success', $msg);
            return redirect(route('teacher',['id' => $teacher_id]));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Course_teacher $course_teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course_teacher $course_teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourse_teacherRequest $request, Course_teacher $course_teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course_teacher $course_teacher)
    {
        //
    }
}
