<?php

namespace App\Http\Controllers;

use App\Models\Class_Course;
use App\Http\Requests\StoreClass_CourseRequest;
use App\Http\Requests\UpdateClass_CourseRequest;
use App\Models\Course;
use App\Models\Role;
use App\Models\Role_User;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ClassCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($class_id=null):View
    {
        //
        $user_id=auth()->user()->id;

        if(!isset($class_id)){
            $user=User::with('people.students.class_students')->find($user_id);
            foreach($user->people->students[0]->class_students as $classe){
                if($classe->school_year == date('Y')){
                    $class_id = $classe->classe_id;
                    $class_student_id = $classe->id;
                    break;

                }

            };
        }
        $class_courses = Class_Course::where('class_id',$class_id)->with('course')->get();
        // dd($class_courses);
        $index = 0;
        return view('classes.class_courses',compact('class_courses','class_student_id','index'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create( $class_id, Request $request):View
    {
        //
        $search = $request->get('search');
        $courses=Course::all();
        $class_courses = Course::whereHas('class_courses', function ($query) use($class_id)  {
    
                $query->where('class_id','=', $class_id);  }
            )->with(['class_courses' => function ($query) use ($class_id) {
                $query->where('class_id', $class_id);
            }]);
            
        $id=0;
        if ($search) {
            $class_courses = $class_courses->where('name', 'like', "%{$search}%");
        } 
            $class_courses=$class_courses->get();
    
        $id = 0;
        return view('courses.add_course_to_classe',compact('class_courses','courses','class_id','id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClass_CourseRequest $request, $class_id)
    {
        $existingCourse = Class_Course::where('course_id', $request->course_id)
                              ->where('class_id', $class_id)
                              ->where('school_year', $request->school_year)
                              ->where('semester', $request->semester)
                              ->first();
    
    
        if ($existingCourse) {
            $msg = 'le cours a déjà été ajouté pour ce semestre et cette année';
            session()->flash('error', $msg);
            return redirect(route('class_course.create',['class_id' => $class_id]));
        } else {
            Class_Course::create(
                array_merge(
                    $request->except(["_token"]),
                    ['class_id' => $class_id]
                )
            );
            session()->flash('success', 'cours ajouté');
            return redirect(route('class_course.create',['class_id' => $class_id]));
            // Vous pouvez rediriger vers une autre route ou afficher un autre message ici
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Class_Course $class_Course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Class_Course $class_Course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClass_CourseRequest $request, Class_Course $class_Course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $class_Course =Class_Course::find($id);
        if($class_Course){
            $class_Course->delete();
            return redirect()->back()->with('success', 'Vous venez de supprimer un cour');

        }else{
            return redirect()->back()->with('error', 'le cours n\'existe pas');

        }
    }
}
