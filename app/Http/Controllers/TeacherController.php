<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonRequest;
use App\Models\Teacher;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdatePersonRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\Classe;
use App\Models\Course;
use App\Models\Course_teacher;
use App\Models\Person;
use App\Models\Role;
use App\Models\Role_User;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request):View
    {
        $role= Role::where('role','enseignant')->first();
        $teachers = User::whereHas('roles', function ($query) {
        $role= Role::where('role','enseignant')->first();

            $query->where('role_id', $role->id);  
        })->with('people.teachers');
        
        $search = $request->get('search');
        $id=0;
        if ($search) {
            $teachers = $teachers->whereHas('people', function ($query) use ($search) {
                $query->where('last_name', 'like', "%{$search}%")
                      ->orWhere('first_name', 'like', "%{$search}%");
                // ... Ajoutez d'autres colonnes si nécessaire
            });

        }
        $teachers = $teachers->get();

        
        return view('teachers.teachers',compact('teachers','id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        return view('teachers.teacher_form');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeacherRequest $request, StorePersonRequest $storePersonRequest)
    {
        //création du compte utilisateur de l'enseignant
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
        ]);
        $user = User::create([
            'name' => $request->first_name.' '.$request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->first_name.'12345'),
        ]);
        
        $role=Role::where('role','enseignant')->first();

        //création du role utilisateur
        Role_User::create([
            'role_id' => $role->id,
            'user_id' => $user->id
        ]);


        //Création du compte peronne de l'enseignant(comptes des données à caractère personnel de l'enseignant)
        $person = Person::create(array_merge(
            $storePersonRequest->except(["_token"]),
            ['user_id'=>$user->id]
        ));

        //Enregistrement de l'enseignant
        if($role->role != 'enseignant'){
            return view('teachers.teachers');
        }else{
            $teacher=Teacher::create(array_merge(
                $request->except(["_token"]),
                ['person_id'=>$person->id]
            ));

            
        }
	    return redirect(route('teacher',['id'=>$teacher->id]));
    }

    /**
     * Display the specified resource.
     */
    public function show($id, Request $request)
    {
        //
        $index=0;
        $teacher = Teacher::find($id);
        $Allcourses = Course::all();
        $classes = Classe::all();
        $user = User::whereHas('roles', function ($query)  {
            $role = Role::where('role', 'enseignant')->first();
            $query->where('role_id', $role->id);
        })->whereHas('people.teachers', function ($query) use($id) {
            $query->where('id', $id);
        })->with('people.teachers.course_teachers')->first();

        //cour de l'enseignant 
        $courses = Course_teacher::where('teacher_id',$id)->with('course')->get();
        $search = $request->get('search');
        
        $teachers = Teacher::with(['courses.classes' => function ($query) {
            $query->with('speciality');  
        }])->find($id);
        // dd($teachers);
        return view('teachers.teacher',compact('index','id','teachers','teacher','user','courses','Allcourses'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id):View{
        $teacher = Teacher::find($id);
        // dd($teacher);
        $person= Person::with('teachers')->find($teacher->person_id);

        return view('teachers.teacher_form', compact('teacher','person'));
  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeacherRequest $request,UpdatePersonRequest $updatePersonRequest, $id)
    {
        //
        $teacher=Teacher::find($id);
        $person= Person::with('teachers')->find($teacher->person_id);
        
        if($teacher && $person){
            $teacher->update(
                array_merge(
                    $request->except(["_token"])
                )
            );
            $person->update(
                array_merge(
                    $updatePersonRequest->except(["_token"])
                )
            );
        return redirect(route('teacher',['id'=>$teacher->id]));

        }else{
            return View('teachers.teachers');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
