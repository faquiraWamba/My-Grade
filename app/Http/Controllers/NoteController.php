<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Models\Course_student;

function grade($note){
    if($note<8){
        $type='faible';
    }else if($note>=8 && $note<10){
        $type='mediocre';
    }else if($note>=10 && $note<12){
        $type='passable';
    }else if($note>=12 && $note<14){
        $type='Assez bien';
    }else if($note>=14 && $note<17){
        $type='bien';
    }else if($note>=17 && $note<19){
        $type='Très bien';
    }else{$type='Excellent';}
    return $type;
}
class NoteController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNoteRequest $request, $type)
    {
        $scores = $request->input('scores');
        // dd($scores);
        // dd('enregistrez',$scores);
        if(!$scores ){
            return redirect()->back()->with('error', 'Aucune action ne peut être éffectuer sur des notes soumises');

        }else{
            foreach ($scores as $student_id => $score) {
                $note =  Note::where('course_student_id',$student_id)->first();
                if($note && $note->type == $type){
                    if($note->note!=$score ){
                        $note->update([
                        'note'=>$score,
                        'modify'=>'1',
                        'appreciation'=>grade($score),
                        'user_id'=>auth()->user()->id
                    ],);
                    }   
                }else{
                    Note::create(array_merge(
                        $request->except(["_token"]),
                        ['note'=>$score],
                        ['type'=>$type],
                        ['appreciation'=>grade($score)],
                        ['user_id'=>auth()->user()->id],
                        ['course_student_id'=>$student_id],
                        
                    ));
                }
               
            }
    
            return redirect()->back()->with('success', 'Notes enregistrées avec succès');
    
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoteRequest $request, $type)
    {
        //
        $scores = $request->input('scores');
        // dd('soumettre',$scores);
        // dd($type);

        foreach ($scores as $student_id => $score) {
            $courseStudent=Course_student::find($student_id);
            // dd($courseStudent);
            $courseStudent->catchup = 0;
            $courseStudent->save();
            $note =  Note::where('course_student_id',$student_id)
                        ->where('type', $type)
                        ->first();
                    $note->update([
                    'status'=>'1',
                ],);
            };
           

        return redirect()->back()->with('success', 'Les Notes ont été soumises avec succès');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        //
    }
}
