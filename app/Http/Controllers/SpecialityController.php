<?php

namespace App\Http\Controllers;

use App\Models\Speciality;
use App\Http\Requests\StoreSpecialityRequest;
use App\Http\Requests\UpdateSpecialityRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SpecialityController extends Controller
{
    public $specialities;
     function __construct()
    {
        $this->specialities=Speciality::all();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $search = $request->get('search');
        $id=0;
        if ($search) {
            $specialities = Speciality::where('acronym', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                // ... Ajoutez d'autres colonnes si nécessaire
                ->get();
        } else {
            $specialities=Speciality::all();
    
        }
        return view('specialities.specialities',compact('specialities','id'));
             
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        //
        return view('specialities.speciality_form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSpecialityRequest $request)
    {
        //
        $speciality = Speciality::create(
            array_merge(
                $request->except(["_token"]),
                ['acronym'=>strtoupper($request->acronym)]
            )
        );
	    return redirect(route('speciality',['id'=>$speciality->id]));

    }

    /**
     * Display the specified resource.
     */
    public function show($id):View{
        $speciality=Speciality::find($id);
    return view('specialities.speciality',compact('speciality'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id):View{
        $speciality = Speciality::find($id);

        return view('specialities.speciality_form', compact('speciality'))->with('speciality', $speciality);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSpecialityRequest $request, $id)
    {
        //
        $speciality=Speciality::find($id);

        if($speciality){
            $speciality->update(
                array_merge(
                    $request->except(["_token"]),
                    ['acronym'=>strtoupper($request->acronym)]
                )
            );
        return redirect(route('speciality',['id'=>$speciality->id]));

        }else{
            return View('specialities.specialities');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Speciality $speciality)
    {
        //
    }
}
