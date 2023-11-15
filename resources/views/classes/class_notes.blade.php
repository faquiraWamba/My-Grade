<x-app-layout>
    <x-slot name="header" >
        <h2 class="font-semibold text-xl text-gray-800 leading-tig">
            NOTE DE {{ __($class->level.' '.$class->speciality->acronym.' SEMESTRE '.$semester) }}
        </h2>
    </x-slot>
    
<div class=" shadow-md sm:rounded-lg ">
    <div class="bg-white flex justify-between  w-full flex-wrap p-4">
        @foreach($class->class_courses as $course)
            <div class="flex justify-between flex-wrap ">
                <span class="font-bold">{{$course->course->code}}=</span>
                <span>{{$course->course->name}}</span>
            </div>
        @endforeach
        <form class="flex justify-between">
            <a href="{{route('form_message',['class_id'=>$class->id, 'semester'=>$semester])}}" class="flex px-2 py-1 self-end mt-3 hover:bg-orange-600 bg-orange-500 text-white border rounded">
            
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path d="M1.5 8.67v8.58a3 3 0 003 3h15a3 3 0 003-3V8.67l-8.928 5.493a3 3 0 01-3.144 0L1.5 8.67z" />
                    <path d="M22.5 6.908V6.75a3 3 0 00-3-3h-15a3 3 0 00-3 3v.158l9.714 5.978a1.5 1.5 0 001.572 0L22.5 6.908z" />
                </svg>
            </a>
            <a href="{{route('class.catchUp',['semester'=>$semester,'class_id'=>$class->id])}}" class="flex px-2 py-1 self-end mt-3 hover:bg-orange-600 bg-orange-500 text-white border rounded">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                </svg>
                <span>  Rattrapage </span>

            </a>
        </form>
    </div>
    <div class=" flex justify-between p-9 w-full overflow-x-auto">
        @php
            $totalCredits = 0;
            foreach ($class->class_courses as $course) {
                $totalCredits += $course->course->credit;
            }
        @endphp

        <table class="border-collapse border border-slate-400 w-full rounded-lg whitespace-nowrap">
            <thead class="bg-gray-900 rounded-lg">
                <tr>
                    <th rowspan="2" class="px-7  text-white">Noms & Prénoms</th>
                    @foreach($class->class_courses as $course)
                        <th colspan="3" scope="col" class="text-white border p-2 border-slate-300">{{$course->course->code}}</th>
                    @endforeach
                    <th rowspan="2" class=" text-white">Crédits</th>

                </tr>
                <tr>
                    @foreach($class->class_courses as $course)
                        <th class="text-white border p-1 text-xs border-slate-300">CC</th>
                        <th class="text-white border p-1 text-xs border-slate-300">SN</th>
                        <th class="text-white border p-1 text-xs border-slate-300">T</th>
                    @endforeach
                </tr>
                
            </thead>
            <tbody class="bg-white">
                @foreach($class->class_students as $student)
                    <tr>
                        <th scope='row' class="border border-slate-300 pl-1">{{$student->student->people->last_name}} {{$student->student->people->first_name}}</th>
                        @php
                            $studentCredits = 0;
                        @endphp

                        @foreach($class->class_courses as $course)
                            @php 
                                $course_student = App\Models\Course_student::where('class_course_id', $course->id)
                                                                    ->where('class_student_id', $student->id)
                                                                    ->with('note')
                                                                    ->first();
                                $noteCC = $course_student->getNoteByType('CC');
                                $noteSN = $course_student->getNoteByType('SN');
                                $noteT = ($noteCC*0.5) + ($noteSN*0.5);

                                if($noteT >= 12) {
                                    $studentCredits += $course->course->credit;
                                }
                            @endphp
                            <td class="border p-1 text-xs border-slate-300">{{ $noteCC }}</td>
                            <td class="border p-1 text-xs border-slate-300">{{ $noteSN }}</td>
                            @if($noteT <12)
                                <td class="border p-1 text-xs border-slate-300 bg-orange-100">{{ $noteT }}</td>
                            @else
                                <td class="border p-1 text-xs border-slate-300 bg-gray-100 font-bold">{{ $noteT }}</td>
                            @endif
                        @endforeach
                        @if($studentCredits < $totalCredits)
                            <td class="border p-1 text-xs border-slate-300 bg-orange-200 text-center font-bold">{{ $studentCredits }}</td>
                        @else
                            <td class="border p-1 text-xs border-slate-300 bg-gray-200 font-bold text-center font-bold">{{ $studentCredits }}</td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>
            
</div>

        
</x-app-layout>
