<x-app-layout>
    <x-slot name="header" >
        <h2 class="font-semibold text-xl text-gray-800 leading-tig">
            ETUDIANTS RATTRAPABLES {{ __($class->level.' '.$class->speciality->acronym.' SEMESTRE '.$semester) }}
        </h2>
    </x-slot>
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
    
<form method="POST" action="{{ route('send.to.resit') }}">
    @csrf
    <div class=" shadow-md sm:rounded-lg ">
        <div class="bg-white flex justify-between  w-full flex-wrap p-4">
            <button type="submit" class="flex px-2 py-1 self-end mt-3 hover:bg-orange-600 bg-orange-500 text-white border rounded">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                </svg>
                <span> Envoyez en Rattrapage </span>
            </button>
     
        </div>
        <div class=" flex flex-col justify-between p-9 w-full overflow-x-auto">
            @foreach($class->class_courses as $course)
                @php
                    $studentsFailingCourse = []; 
                @endphp
        
                @foreach($class->class_students as $student)
                    @php 
                        $course_student = App\Models\Course_student::where('class_course_id', $course->id)
                                                                ->where('class_student_id', $student->id)
                                                                ->with('note')
                                                                ->first();
                        $noteCC = $course_student->getNoteByType('CC');
                        $noteSN = $course_student->getNoteByType('SN');
                        $noteT = ($noteCC*0.5) + ($noteSN*0.5);
        
                        if($noteT < 12) {
                            $studentsFailingCourse[] = $student;
                        }
                    @endphp
                @endforeach
        
                @if(count($studentsFailingCourse) > 0)
                <div class="w-full flex flex-col items-center border-b border-orange-500">
                    <h3 class="text-xl text-center font-bold mt-4 mb-2">{{ $course->course->name }} ({{ $course->course->code }})</h3>
                    <table class="mb-3 border-collapse border border-slate-400 w-3/4 rounded-lg whitespace-nowrap">
                        <thead class="bg-gray-900 rounded-lg">
                            <tr>
                                <th class="px-7  text-white">Noms & Prénoms</th>
                                <th class="text-white">CC</th>
                                <th class="text-white">SN</th>
                                <th class="text-white">T</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach($studentsFailingCourse as $failingStudent)
                            <input type="hidden" name="students[{{ $failingStudent->id }}][]" value="{{ $course->id }}">
                                
                                @php 
                                    $course_student = App\Models\Course_student::where('class_course_id', $course->id)
                                                                            ->where('class_student_id', $failingStudent->id)
                                                                            ->with('note')
                                                                            ->first();
                                    $noteCC = $course_student->getNoteByType('CC');
                                    $noteSN = $course_student->getNoteByType('SN');
                                    $noteT = ($noteCC*0.5) + ($noteSN*0.5);
                                @endphp
                                <tr>
                                    <th scope='row' class="border border-slate-300 pl-1">{{$failingStudent->student->people->last_name}} {{$failingStudent->student->people->first_name}}</th>
                                    <td class="border p-1 text-xs border-slate-300">{{ $noteCC }}</td>
                                    <td class="border p-1 text-xs border-slate-300">{{ $noteSN }}</td>
                                    <td class="border p-1 text-xs border-slate-300 bg-orange-100">{{ $noteT }}</td>
                                </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            @endforeach
        </div>
    </div>
</form>
        
</x-app-layout>
