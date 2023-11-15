<?php

namespace App\Http\Controllers;

use App\Mail\MessageGoogle;
use App\Models\Classe;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    //
    public function formMessageGoogle ($class_id,$semester):View {
	
		return view("emails.form_email",compact('class_id','semester'));
	}

    public function sendMessageGoogle (Request $request, $class_id, $semester) {
	
		$this->validate($request, [ 'message' => 'bail|required' ]);

		
		$class = Classe::with('students.tutors.people.users','students.people.users')->find($class_id);
		// dd($class);
		foreach($class->students as $student){
			$link = 'http://127.0.0.1:8000/api/students/reportCards/'.$student->registration_number.'/'.$semester;
			Mail::to($student->people->users->email)->bcc("faquirawamba15@gmail.com")
						->queue(new MessageGoogle($request->all(), $link));
			foreach($student->tutors as $tutor){
				if($tutor){
					Mail::to($tutor->people->users->email)->bcc("faquirawamba15@gmail.com")
						->queue(new MessageGoogle($request->all(), $link));
				}
			}
		}
	
		return back()->with('success',"Message envoyé",compact('semester'));
	}
	
}
