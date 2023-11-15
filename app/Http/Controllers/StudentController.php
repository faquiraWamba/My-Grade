<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonRequest;
use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdatePersonRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Class_Student;
use App\Models\Classe;
use App\Models\Course_student;
use App\Models\Person;
use App\Models\Role;
use App\Models\Role_User;
use App\Models\Speciality;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

function reg_number($id)
{
    $regNum = '';
    $letter = chr(rand(65,90));
    $number = rand(0,9);
    $date = date('y');
    $regNum = "MAT".'-'.$date.$number.$letter.'-'.$id;
    return $regNum;
}

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request):View
    {
        $role= Role::where('role','étudiant')->first();
        $students = User::whereHas('roles', function ($query) {
        $role= Role::where('role','étudiant')->first();

            $query->where('role_id', $role->id);  
        })->with('people.students');
        
        $search = $request->get('search');
        $id=0;
        if ($search) {
            $students = $students->whereHas('people', function ($query) use ($search) {
                $query->where('last_name', 'like', "%{$search}%")
                      ->orWhere('first_name', 'like', "%{$search}%");
                // ... Ajoutez d'autres colonnes si nécessaire
            });

        }
        $students = $students->paginate(30);

        
        return view('students.students',compact('students','id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        //
        $specialities=Speciality::with('classes')->get();
        // dd($specialities[0]->classes[0]->level);
        return view('students.student_form',compact('specialities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store( StoreStudentRequest $request, StorePersonRequest $storePersonRequest)
    {
        //
        
        $path=null;
        if($request->has('picture')){
            /** @var UploadedFile $picture */
            $picture=$request->validated('picture');
            $path = $picture->store('students/pictures','public');
        };
        // dd($request->has('picture'));
        $request->merge(['picture'=>$path]);
        //création du compte utilisateur de l'étudiant
        $request->validate([
            // 'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $user = User::create([
            'name' => $request->first_name.' '.$request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->first_name.'12345'),
        ]);
        
        $role=Role::where('role','étudiant')->first();

        //création du role utilisateur
        Role_User::create([
            'role_id' => $role->id,
            'user_id' => $user->id
        ]);


        //Création du compte peronne de l'étudiant(comptes des données à caractère personnel de l'étudiant)
        $person = Person::create(array_merge(
            $storePersonRequest->except(["_token"]),
            ['user_id'=>$user->id]
        ));

        //Enregistrement de l'étudiant
        if($role->role != 'étudiant'){
            return view('students.students');
        }else{
            $student=Student::create(array_merge(
                $request->except(["_token"]),
                ['person_id'=>$person->id],
                ['registration_number'=>reg_number($person->id)],
                ['picture'=>$path],
            ));

            //Enregistrement de la classe de l'étudiant
            Class_Student::create(array_merge(
                $request->except(["_token"]),
                ['student_id'=>$student->id],
                ['report_card'=>"http://127.0.0.1:8000/api/students/reportCards/$student->registration_number"]
                
            ));
        }
	    return redirect(route('student',['id'=>$student->id]));

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $index=0;
        $T_index=0;
        $student = Student::find($id);
        $specialities = Speciality::all();
        $classes = Classe::all();
        $user = User::whereHas('roles', function ($query)  {
            $role = Role::where('role', 'étudiant')->first();
            $query->where('role_id', $role->id);
        })->whereHas('people.students', function ($query) use($id) {
            $query->where('id', $id);
        })->with('people.students.class_students.classe.speciality')->first();

        //students tutors
        $role= Role::where('role','parent')->first();
        $tutors = User::whereHas('roles', function ($query) {
        $role= Role::where('role','parent')->first();

            $query->where('role_id', $role->id);  
        })->whereHas('people.tutors',function ($query) use($id) {
            $query->where('student_id', $id);
        })->get();
        // dd($tutors->get());
        return view('students.student',compact('T_index','index','id','tutors','student','user','classes','specialities'));

    }
    public function notes($semester,$student_id=null):View{
        if(!$student_id){
            $user=User::with('people.student')->find(auth()->user()->id);
            // dd($user->people->student->id);

             $student_id = $user->people->student->id;
        }

        $student = Student::with(['class_students' => function($query) {
            $query->where('school_year', date('Y'))->first();
        },'people' ,'class_students.classe.speciality','class_students.course_students.note','class_students.course_students.class_course.course'])
        ->find($student_id);

        // dd($student);
        return view('students.student_notes', compact('student', 'semester'));
    }

    public function card($student_id=null):View{
       
        if(!$student_id){
            $user=User::with('people.student')->find(auth()->user()->id);
            // dd($user->people->student->id);

             $student_id = $user->people->student->id;
        }

        $student = Student::with(['class_students' => function($query) {
            $query->where('school_year', date('Y'))->first();
        },'people' ,'class_students.classe.speciality','class_students.course_students.note','class_students.course_students.class_course.course'])
        ->find($student_id);

        // dd($student);
        return view('students.student_card', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $student=Student::with('class_students')->find($id);
        $person= Person::with('students')->find($student->person_id);
        $specialities=Speciality::with('classes')->get();
        
        // dd($student->class_students[0]->school_year);
        return view('students.student_form',compact('person', 'student','specialities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, UpdatePersonRequest $updatePersonRequest, $id)
    {
        //
        $student = Student::find($id);
        $person= Person::with('students')->find($student->person_id);
        
        if($student && $person){
            dd($student && $person);
            $path=null;
            if($request->has('picture')){
            /** @var UploadedFile $picture */
            $picture=$request->validated('picture'); 
            $path = $picture->store('students/pictures','public');
            }
            if(Storage::exists($student->picture) ){
                Storage::delete($student->picture);
            }
            $student->update(
                array_merge(
                    $request->except(["_token"]),
                    ['picture'=>$path],
                )
            );
            $person->update(
                array_merge(
                    $updatePersonRequest->except(["_token"])
                )
            );
         return redirect(route('student',['id'=>$student->id]));

        }else{
            return View('students.students');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }
    public function student_report_card($matricule,$semester){
        // dd($student);
        $student = Student::with(['class_students' => function($query) {
            $query->where('school_year', date('Y'))->first();
        },'people' ,'class_students.classe.speciality','class_students.course_students.note','class_students.course_students.class_course.course'])
        ->where('registration_number',$matricule)
        ->first();

        // dd($student);
        return view('students.student_mail_card', compact('student','semester'));
    }
}
