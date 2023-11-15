<style>
    .container {
        padding: 1em;
    }
    
    .shadow-md {
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
    
    .bg-white {
        background-color: #ffffff;
    }
    
    .border-slate-900 {
        border-color: #1f2937;
    }
    
    .rounded-lg {
        border-radius: 0.5rem;
    }
    
    .text-center {
        text-align: center;
    }
    
    .text-2xl {
        font-size: 1.5rem;
    }
    
    .font-bold {
        font-weight: bold;
    }
    
    .text-lg {
        font-size: 1.125rem;
    }
    
    .text-sm {
        font-size: 0.875rem;
    }
    
    .border {
        border: 1px solid #cbd5e0;
    }
    
    .border-slate-300 {
        border-color: #d1d5db;
    }
    
    .text-white {
        color: #ffffff;
    }
    
    .bg-gray-900 {
        background-color: #1f2937;
    }
    
    .bg-orange-100 {
        background-color: #ffedd5;
    }
    
    .bg-gray-100 {
        background-color: #f4f4f5;
    }
    
    .p-1 {
        padding: 0.25rem;
    }
    
    .text-xs {
        font-size: 0.75rem;
    }
    
    .pl-1 {
        padding-left: 0.25rem;
    }
    
    .flex {
        display: flex;
        width: 100%;
    }
    
    .justify-between {
        justify-content: space-between;
    }
    
    .justify-center {
        justify-content: center;
    }
    
    .flex-col {
        flex-direction: column;
    }
    
    .mb-3 {
        margin-bottom: 0.75rem;
    }
    
    .mt-4 {
        margin-top: 1rem;
    }
    
    .mb-4 {
        margin-bottom: 1rem;
    }
    .w-full{
        width: 100%;
    }
</style>

<div class="container">
 

    <div class="p-5">
        @php
            $totalCreditsS1 = 0;
            $creditStudentS1 = 0;
            $totalPointsS1 = 0;
            $totalCourseS1 = 0;
            foreach ($student->class_students[0]->course_students as $course) {
                // dd($course);
                if($course->class_course->semester == 1){
                    $totalCreditsS1 += $course->class_course->course->credit;
                    $totalCourseS1 = $totalCourseS1 +1;
                }
            }
            $totalCreditsS2 = 0;
            $creditStudentS2 = 0;
            $totalPointsS2 = 0;
            $totalCourseS2 = 0;
            foreach ($student->class_students[0]->course_students as $course) {
                // dd($course);
                if($course->class_course->semester == 2){
                    $totalCreditsS2 += $course->class_course->course->credit;
                    $totalCourseS2 = $totalCourseS2 +1;
                }
            }
        @endphp
    
    <div class="overflow-x-auto shadow-md bg-white p-10  border-slate-900 sm:rounded-lg flex flex-col justify-between">
        <div class="flex flex-col justify-center mb-3">
            <h3 class="text-2xl font-bold text-center">ECOLE UNIVERSITAIRE</h3>
            <div class="mt-4 mb-4 border">
                <h4 class="text-lg  text-center ">BULLETINS DE NOTES</h4>
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
                        @if($course->class_course->semester == 1)
                            <th scope='row' class="border border-slate-300 pl-1">{{$course->class_course->course->code}}</th>
                            <td scope='row' class="border border-slate-300 pl-1">{{$course->class_course->course->name}}</td>
                            @php
                                $course_student = App\Models\Course_student::with('note')->find($course->id);
                                $noteCC = $course_student->getNoteByType('CC');
                                $noteSN = $course_student->getNoteByType('SN');
                                $noteT = ($noteCC*0.5) + ($noteSN*0.5);
                                $totalPointsS1 = $totalPointsS1 + $noteT;
                                if($noteT>=12){
                                    $creditStudentS1 = $creditStudentS1 + $course->class_course->course->credit;
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
                <tr class="border border-slate-300">
                    <td colspan="4" class="w-full p-2">
                        <div class="flex justify-between">
                            <div>
                                <span>MOYENNE SEMESTRE 1:</span> 
                                <span class="text-lg font-bold">{{round($totalPointsS1/$totalCourseS1,2)}}</span>
                            </div>
                            <div>
                                <span>TOTAL CREDITS:</span> 
                                <span class="text-lg font-bold">{{$creditStudentS1.'/'.$totalCreditsS1}}</span>
                            </div>
                        </div>
                    </td>
                </tr>
                @foreach ($student->class_students[0]->course_students as $course)
                    <tr>
                        @if($course->class_course->semester == 2)
                            <th scope='row' class="border border-slate-300 pl-1">{{$course->class_course->course->code}}</th>
                            <td scope='row' class="border border-slate-300 pl-1">{{$course->class_course->course->name}}</td>
                            @php
                                $course_student = App\Models\Course_student::with('note')->find($course->id);
                                $noteCC = $course_student->getNoteByType('CC');
                                $noteSN = $course_student->getNoteByType('SN');
                                $noteT = ($noteCC*0.5) + ($noteSN*0.5);
                                $totalPointsS2 = $totalPointsS2 + $noteT;
                                if($noteT>=12){
                                    $creditStudentS2 = $creditStudentS2 + $course->class_course->course->credit;
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
                <tr class="border border-slate-300">
                    <td colspan="4" class="w-full p-2">
                        <div class="flex justify-between">
                            <div>
                                <span>MOYENNE SEMESTRE 2:</span> 
                                <span class="text-lg font-bold">{{round($totalPointsS2/$totalCourseS2,2)}}</span>
                            </div>
                            <div>
                                <span>TOTAL CREDITS:</span> 
                                <span class="text-lg font-bold">{{$creditStudentS2.'/'.$totalCreditsS2}}</span>
                            </div>
                        </div>
                    </td>
                </tr>
                
            </tbody>
            
        </table>
        <div class="mt-0 p-2 flex justify-between border bg-gray-900 text-white border-slate-300">
            <div>
                <span>MOYENNE GENERALE:</span> 
                <span class="text-lg font-bold">{{round((($totalPointsS2/$totalCourseS2)+($totalPointsS1/$totalCourseS1))/2 ,2)}}</span>
            </div>
            <div>
                <span>TOTAL CREDITS:</span> 
                <span class="text-lg font-bold">{{($creditStudentS1+$creditStudentS2).'/'.($totalCreditsS1+$totalCreditsS2)}}</span>
            
            </div>
        </div>
        
        <div class="px-5 pb-10  pt-8 flex justify-between">
            <p class="font-bold pb-9">SIGNATURE CHEF D'ETABLISSEMENT</p>
            <p class="font-bold">SIGNATURE RESPONSABLE ACADEMIQUE</p>
        </div>
    </div>

</div>
</div>
