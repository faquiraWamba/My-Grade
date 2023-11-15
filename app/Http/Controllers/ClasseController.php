<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Http\Requests\StoreClasseRequest;
use App\Http\Requests\UpdateClasseRequest;
use App\Models\Class_course_teacher;
use App\Models\Class_Student;
use App\Models\Speciality;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $specialities = Speciality::all();
        $search = $request->get('search');
        $id=0;
        $b1 = Classe::where('level','B1')->count();
        $b2 = Classe::where('level','B2')->count();
        $b3 = Classe::where('level','B3')->count();
        $m1 = Classe::where('level','M1')->count();
        $m2 = Classe::where('level','M2')->count();
        
        if ($search) {
            $classes = Classe::where('acronym', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                // ... Ajoutez d'autres colonnes si nécessaire
                ->get();
        } else {
            $classes=Classe::all();
    
        }
        return view('classes.classes',compact('classes','id','specialities','b1','b2','b3','m1','m2',));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        //
        $specialities = Speciality::all();

        return view('classes.class_form',compact('specialities'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClasseRequest $request)
    {
        //
        $class = Classe::create(
            array_merge(
                $request->except(["_token"]),
                // ['acronym'=>strtoupper($request->acronym)]
            )
        );
	    return redirect(route('class',['id'=>$class->id]));
    }

    /**
     * Display the specified resource.
     */
    public function show($id):View{
        
        $class=Classe::with('speciality','class_students.student.people','class_courses.course.teachers.people')->find($id);
        
        // $class=Classe::with('class_courses.class_course_teachers.course_teachers.teacher.people')->find($id);

        // dd($class);
        // $students = Class_Student::with('student.people')->where('classe_id',$id)->get();
        $students = $class->class_students->count();
        $courses = $class->class_courses->count();
      
    return view('classes.class',compact('class','students', 'courses'));
    }

     /**
     * Display the class level.
     */
    public function showLevel($level, Request $request):View{
        $levels = Classe::where('level',$level )->get();
        $classes = Speciality::all();
        $search = $request->get('search');
        if ($search) {
            $classes = $classes->whereHas('classes', function ($query) use ($search) {
                $query->where('acronym', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
            })->get();

        }else{
            $classes = Speciality::all();
        }

       
        $id=0;
            return view('classes.class_level', compact('classes','level','levels','id'));
   
    }

    public function classNotes($class_id, $semester ){

       
        $class = Classe::whereHas('class_courses', function($query) use($semester) {
            $query->Where('semester', $semester);
        })
        ->with(['speciality', 'class_courses' => function($query) use($semester) {
            $query->Where('semester', $semester);
        }, 'class_courses.course_student.note', 'class_students.student.people'])
        ->find($class_id);
        
        // dd($class);

        return view('classes.class_notes', compact('semester','class'));
    }
    public function classCatchup($class_id,$semester ){

       
        $class = Classe::whereHas('class_courses', function($query) use($semester) {
            $query->Where('semester', $semester);
        })
        ->with(['speciality', 'class_courses' => function($query) use($semester) {
            $query->Where('semester', $semester);
        }, 'class_courses.course_student.note', 'class_students.student.people'])
        ->find($class_id);
        
        // dd($class);

        return view('classes.class_catchup', compact('semester','class'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id):View{
        $specialities = Speciality::all();

        $class = Classe::find($id);

        return view('classes.class_form', compact('class','specialities'))->with('class', $class);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClasseRequest $request,  $id)
    {
        //
        $class=Classe::find($id);

        if($class){
            $class->update(
                array_merge(
                    $request->except(["_token"]),
                    // ['acronym'=>strtoupper($request->acronym)]
                )
            );
        return redirect(route('class',['id'=>$class->id]));

        }else{
            return View('classes.classes');
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classe $classe)
    {
        //
    }
}
