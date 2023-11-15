<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

function course_code($id)
{
    $code = '';
    $number = rand(10,99);
    $date = date('y');
    $code = "UE".$date.$number.$id;
    return $code;
}
class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $search = $request->get('search');
        $id=0;
        if ($search) {
            $courses = Course::where('acronym', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                // ... Ajoutez d'autres colonnes si nécessaire
                ->get();
        } else {
            $courses=Course::all();
    
        }
        return view('courses.courses',compact('courses','id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        //
        return view('courses.course_form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        //
        $course = Course::create(
            array_merge(
                $request->except(["_token"]),
                ['code'=>'code']
            ));
            $course->code=course_code($course->id);
            $course->save();
    
	    return redirect(route('course',['id'=>$course->id]));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $course=Course::find($id);
        return view('courses.course',compact('course'));
        
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id):View{
        $course = Course::find($id);

        return view('courses.course_form', compact('course'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, $id)
    {
        //
        $course=Course::find($id);

        if($course){
            $course->update(
                array_merge(
                    $request->except(["_token"])
                )
            );
        return redirect(route('course',['id'=>$course->id]));

        }else{
            return View('courses.courses');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }
}
