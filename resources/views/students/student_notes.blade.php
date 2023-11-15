<x-app-layout>
    @if (session('error'))
    <div id="notification" class="notification notification-error">
        {{ session('error') }}
     </div>
    @endif
    @if (session('success'))
    <div id="notification" class="notification notification-sucess">
        {{ session('success') }}
     </div>
    @endif
    <x-slot name="header" >
        <h2 class="font-semibold text-xl text-gray-800 leading-tig">
            {{ __('NOTES SEMESTRE '.$semester) }}
        </h2>
    </x-slot>
        @php
            $totalCredits = 0;
            $creditStudent = 0;
            $totalPoints = 0;
            $totalCourse = 0;
            foreach ($student->class_students[0]->course_students as $course) {
                // dd($course);
                if($course->class_course->semester == $semester){
                    $totalCredits += $course->class_course->course->credit;
                    $totalCourse = $totalCourse +1;
                }
            }
        @endphp
    <div class="p-3 flex justify-between">
        <div>
            <a href='{{route('student.notes',['semester'=>1, 'student_id'=>$student->id])}}' class="border rounded bg-gray-200 p-1 font-bold hover:bg-gray-300">semestre 1</a>
            <a href='{{route('student.notes',['semester'=>2, 'student_id'=>$student->id])}}' class="border rounded bg-gray-200 p-1 font-bold hover:bg-gray-300"> semestre 2</a>
        </div>
        <a href="{{route('student.report',['semester'=>$semester, 'student_id'=>$student->id])}}" class="text-white border rounded py-2 px-3 bg-orange-500 hover:bg-orange-600">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
            </svg>                  
        </a>
    </div>
    <div class="overflow-x-auto shadow-md bg-white p-10  border-slate-900 sm:rounded-lg flex flex-col justify-between">
        <div class="flex flex-col justify-center mb-3">
            <h3 class="text-2xl font-bold text-center">ECOLE UNIVERSITAIRE</h3>
            <div class="mt-4 mb-4 border">
                <h4 class="text-lg  text-center ">RELEVE DE NOTES SEMESTRE {{$semester}}</h4>
                <h5 class="text-sm  text-center ">Année Académique {{$student->class_students[0]->school_year - 1 .'/'.$student->class_students[0]->school_year}}</h5>
            </div>
            <div class="flex justify-between">
                <div>
                    <span>Nom(s) et Prénom(s): </span>
                    <span class="font-bold"> {{$student->people->last_name.' '.$student->people->first_name}}</span>
                </div>
                <div>
                    <span> No Matricule:</span>
                    <span class="font-bold"> {{$student->registration_number}}</span>
                </div>
            </div>
            <div class="flex justify-between">
                <div>
                    <span> Né(e) le:</span>
                    <span class="font-bold">{{$student->birthday.' à '.$student->birth_town}}</span>
                </div>
                <div>
                    <span>Filière: </span>
                    <span class="font-bold">{{$student->class_students[0]->classe->speciality->description.
                    ' '.$student->class_students[0]->classe->level}} </span>
                </div>
            </div>
        </div>
        <table class="border-collapse border border-slate-400 w-full rounded-lg whitespace-nowrap">
            <thead class="bg-gray-900 rounded-lg">
                <tr>
                    <th rowspan="2" class="text-white">CODE</th>
                    <th rowspan="2" class="text-white">COURS</th>
                    <th colspan="3" scope="col" class="text-white">NOTES</th>
                    <th rowspan="2" class="text-white">CREDITS</th>
                    <th rowspan="2" class="text-white">RATTRAPAGE</th>
                    
                </tr>
                <tr>
                    <th class="text-white border p-1  border-slate-300">CC</th>
                    <th class="text-white border p-1  border-slate-300">SN</th>
                    <th class="text-white border p-1  border-slate-300">T</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($student->class_students[0]->course_students as $course)
                    <tr>
                        @if($course->class_course->semester == $semester)
                            <th scope='row' class="border border-slate-300 pl-1">{{$course->class_course->course->code}}</th>
                            <td scope='row' class="border border-slate-300 pl-1">{{$course->class_course->course->name}}</td>
                            @php
                                $course_student = App\Models\Course_student::with('note')->find($course->id);
                                $noteCC = $course_student->getNoteByType('CC');
                                $noteSN = $course_student->getNoteByType('SN');
                                $noteT = ($noteCC*0.5) + ($noteSN*0.5);
                                $totalPoints = $totalPoints + $noteT;
                                if($noteT>=12){
                                    $creditStudent = $creditStudent + $course->class_course->course->credit;
                                }
                            @endphp
                            <td class="border p-1 text-xs border-slate-300">{{ $noteCC }}</td>
                            <td class="border p-1 text-xs border-slate-300">{{ $noteSN }}</td>
                            @if($noteT <12)
                               
                                <td class="border p-1 text-xs border-slate-300 bg-orange-100">{{ $noteT }}</td>
                                <td class="border p-1 text-xs border-slate-300 bg-orange-100">0</td>
                                <td class="border p-1 text-xs border-slate-300 bg-orange-100">OUI</td>
                            @else
                                <td class="border p-1 text-xs border-slate-300 bg-gray-100 font-bold">{{ $noteT }}</td>
                                <td class="border p-1 text-xs border-slate-300 bg-gray-100 font-bold">{{ $course->class_course->course->credit }}</td>
                                <td class="border p-1 text-xs border-slate-300 bg-gray-100 font-bold">NON</td>
                            @endif
                        @endif
                    </tr>
                @endforeach
                
            </tbody>
            
        </table>
        <div class="mt-0 p-2 flex justify-between border border-slate-300">
            <div>
                <span>MOYENNE SEMESTRE {{$semester}}:</span> 
                <span class="text-lg font-bold">{{$totalPoints/$totalCourse}}</span>
            </div>
            <div>
                <span>TOTAL CREDITS:</span> 
                <span class="text-lg font-bold">{{$creditStudent.'/'.$totalCredits}}</span>
            
            </div>
        </div>
        <div class="px-5 pb-10  pt-8 flex justify-between">
            <p class="font-bold pb-9">SIGNATURE CHEF D'ETABLISSEMENT</p>
            <p class="font-bold">SIGNATURE RESPONSABLE ACADEMIQUE</p>
        </div>
    </div>

</x-app-layout>
