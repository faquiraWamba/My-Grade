<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonRequest;
use App\Models\Tutor;
use App\Http\Requests\StoreTutorRequest;
use App\Http\Requests\UpdatePersonRequest;
use App\Http\Requests\UpdateTutorRequest;
use App\Models\Person;
use App\Models\Role;
use App\Models\Role_User;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;

class TutorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($student_id):View
    {
        return view('tutors.tutor_form',compact('student_id'));
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTutorRequest $request, StorePersonRequest $storePersonRequest, $student_id =null)
    {
        //création du compte utilisateur de l'parent

        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
        ]);
        $user = User::create([
            'name' => $request->first_name.' '.$request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->first_name.'12345'),
        ]);
        
        $role=Role::where('role','parent')->first();

        //création du role utilisateur
        Role_User::create([
            'role_id' => $role->id,
            'user_id' => $user->id
        ]);


        //Création du compte peronne du parent(comptes des données à caractère personnel de l'parent)
        $person = Person::create(array_merge(
            $storePersonRequest->except(["_token"]),
            ['user_id'=>$user->id]
        ));

        //Enregistrement du parent
        if($role->role != 'parent'){
            return view('tutors.tutors');
        }else{
            if($student_id){
                $tutor=Tutor::create(array_merge(
                    $request->except(["_token"]),
                    ['person_id'=>$person->id],
                    ['student_id'=>$student_id],
                ));
	        return redirect(route('student',['id'=>$student_id]));

            }else{
                $tutor=Tutor::create(array_merge(
                    $request->except(["_token"]),
                    ['person_id'=>$person->id]
                ));
	        return redirect(route('tutor',['id'=>$tutor->id]));

            }
            

            
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Tutor $tutor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id):View{
        $tutor = Tutor::find($id);
        // dd($tutor);
        $person= Person::with('tutors')->find($tutor->person_id);

        return view('tutors.tutor_form', compact('tutor','person'));
  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTutorRequest $request,UpdatePersonRequest $updatePersonRequest, $id)
    {
        //
        $tutor=Tutor::find($id);
        $person= Person::with('tutors')->find($tutor->person_id);
        
        if($tutor && $person){
            $tutor->update(
                array_merge(
                    $request->except(["_token"])
                )
            );
            $person->update(
                array_merge(
                    $updatePersonRequest->except(["_token"])
                )
            );
        return redirect(route('student',['id'=>$tutor->student_id]));

        }else{
            return View('tutors.tutors');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tutor $tutor)
    {
        //
    }

    public function children($tutor_id=null):View
    {
        //
        $user_id=auth()->user()->id;

        if(!isset($tutor_id)){
            $user=User::with('people.tutors.students.people')->find($user_id);
            // dd($user);
            return view('tutors.children',compact('user'));
            
        }
    }
}
