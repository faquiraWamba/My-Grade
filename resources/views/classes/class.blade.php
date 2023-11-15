<x-app-layout>
    <x-slot name="header" >
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Détails {{ __($class->level.' '.$class->speciality->acronym) }}
        </h2>
    </x-slot>

    <div class="py-12 flex flex-col justify-center">
        
        <div class="p-5 flex flex-col border">
            <h3 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                @if(isset($class->description))
                    {{$class->description}}
                @else
                    Description
                @endif
            </h3>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 flex justify-between">
                <span>Total étudiants :</span>
                <span class="font-bold">{{$students }}</span>
            </p>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 flex justify-between">
                <span>cours Suivis:</span>
                <span class="font-bold ml-2">{{$courses }}</span>
            </p>
            <a href="{{route('class_course.create',['class_id'=>$class->id])}}" class="items-center self-end px-3 py-2 text-sm font-medium text-center text-white bg-orange-500 rounded-lg hover:bg-orange-600 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                + de cours
            </a>
        </div>
        <div class="w-full bg-white  border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="sm:hidden">
                <label for="tabs" class="sr-only">Selectionner une option</label>
                <select id="tabs" class="bg-gray-50 border-0 border-b border-gray-200 text-gray-900 text-sm rounded-t-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500">
                    <option>Listes des étudiants</option>
                    <option>Listes des Cours</option>
                </select>
            </div>
            <ul class="hidden text-sm  font-medium text-center text-gray-500 divide-x divide-gray-200 rounded-lg sm:flex dark:divide-gray-600 dark:text-gray-400" id="fullWidthTab" data-tabs-toggle="#fullWidthTabContent" role="tablist">
                <li class="w-full">
                    <button id="stats-tab" data-tabs-target="#stats" type="button" role="tab" aria-controls="stats" aria-selected="true" class="inline-block w-full p-4 rounded-tl-lg bg-gray-50 hover:bg-gray-100 focus:outline-none dark:bg-gray-700 dark:hover:bg-gray-600">Listes des étudiants</button>
                </li>
                <li class="w-full">
                    <button id="about-tab" data-tabs-target="#about" type="button" role="tab" aria-controls="about" aria-selected="false" class="inline-block w-full p-4 bg-gray-50 hover:bg-gray-100 focus:outline-none dark:bg-gray-700 dark:hover:bg-gray-600">Listes des cours</button>
                </li>
                
            </ul>
            <div id="fullWidthTabContent" class="border-t border-gray-200 dark:border-gray-600">
                <div class="hidden p-4 bg-white  rounded-lg md:p-8 dark:bg-gray-800" id="stats" role="tabpanel" aria-labelledby="stats-tab">  
                    <table class = "border-collapse border border-slate-400 w-full rounded-lg">
                        <thead class="bg-gray-200 rounded-lg ">
                            <tr >
                                <th class="border border-slate-300 w-10 py-3 " >
                                        No
                                </th>
                                <th class="border border-slate-300 w-2/3" >
                                    Noms et prenoms
                                </th>
                                <th class="border border-slate-300" >
                                    nbres cours
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach ($class->class_students as $student)
                                <tr class="hover:bg-gray-100">
                                    <th class="border border-slate-300">
                                        {{$loop->index=$loop->index+1}}
                                    </th>
                                    <td  class="border border-slate-300 pl-2">
                                        {{$student->student->people->last_name}}
                                        {{$student->student->people->first_name}}
                                    </td>
                                    <td class="border ">
                                        nbres
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="hidden  p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="about" role="tabpanel" aria-labelledby="about-tab">
                    <table class = "border-collapse border border-slate-400 w-full rounded-lg">
                        <thead class="bg-gray-200 rounded-lg ">
                            <tr >
                                <th class="border border-slate-300 w-10 py-3 " >
                                        No
                                </th>
                                <th class="border border-slate-300 " >
                                    Code
                                </th>
                                <th class="border border-slate-300" >
                                    Désignation
                                </th>
                                <th class="border border-slate-300" >
                                    Semestre
                                </th>
                                <th class="border border-slate-300" >
                                    Prof(s)
                                </th>
                                <th class="border border-slate-300" >
                                    
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <tr > 
                                <td>_</td> 
                                <td>_</td> 
                                <td class="flex justify-center">
                                    <a href="{{route('class.notes',['class_id'=>$class->id,'semester'=>1])}}" class="font-bold text-orange-500 text-lg hover:text-orange-700">
                                        NOTES SEMESTRE 1
                                   </a>
                                </td> 
                                <td>_</td> 
                                <td>_</td> 
                            </tr>
                            @php $index=0 @endphp
                            @foreach ($class->class_courses as $course)
                                @if($course->semester == 1)
                                    @php 
                                        $index=$index+1; 
                                        $teachers=App\Models\Class_Course::with('course_teacher.teacher.people')->find($course->id);
                                    @endphp
                                    <tr class="hover:bg-gray-100">
                                        <th class="border border-slate-300">
                                            {{$index}}
                                        </th>
                                        <td  class="border border-slate-300 pl-2">
                                            {{$course->course->code}}
                                        </td>
                                        <td class="border ">
                                            {{$course->course->name}} 
                                        </td>
                                        <td class="border ">
                                            {{$course->semester}} 
                                        </td>
                                        <td class="border ">
                                        @php $count =$teachers->course_teacher->count(); @endphp
                                        @foreach($teachers->course_teacher as $teacher)
                                            {{$teacher->teacher->people->gender == 'M'? 'M.':'Mme '}} {{$teacher->teacher->people->last_name}} 
                                            @endforeach
                                        </td>
                                        <td class="border ">
                                            @if($count == 0)
                                                <a href="#" >notes
                                                </a>   
                                            @else
                                                <a href="{{route('my_class_course', 
                                                    ['teacher_course_id'=>$teachers->course_teacher[0],
                                                    'class_course_id'=>$course->id,
                                                    'admin'=>auth()->user()->id])}}">notes</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            <tr > 
                                <td>_</td> 
                                <td>_</td> 
                                <td class="flex justify-center">
                                    <a href="{{route('class.notes',['class_id'=>$class->id,'semester'=>2])}}" class="font-bold text-orange-500 text-lg hover:text-orange-700">
                                        NOTES SEMESTRE 2
                                   </a>
                                </td> 
                                <td>_</td> 
                                <td>_</td> 
                            </tr>
                                @php $index=0 @endphp
                                @foreach ($class->class_courses as $course)
                                @if($course->semester == 2)
                                    @php 
                                        $index=$index+1 ; 
                                        $teachers=App\Models\Class_Course::with('course_teacher.teacher.people')->find($course->id);
                                        
                                    @endphp
                                  
                                    <tr class="hover:bg-gray-100">
                                        <th class="border border-slate-300">
                                            {{$index}}
                                        </th>
                                        <td  class="border border-slate-300 pl-2">
                                            {{$course->course->code}}
                                        </td>
                                        <td class="border ">
                                            {{$course->course->name}} 
                                        </td>
                                        <td class="border ">
                                            {{$course->semester}} 
                                        </td>
                                        <td class="border ">
                                           
                                            @foreach($teachers->course_teacher as $teacher)
                                            {{$teacher->teacher->people->gender == 'M'? 'M.':'Mme '}} {{$teacher->teacher->people->last_name}} 
                                            @endforeach
                                        </td>
                                        <td class="border ">
                                            @if($count == 0)
                                                <a href="#">notes
                                                </a>
                                            @else
                                                <a href="{{route('my_class_course', 
                                                    ['teacher_course_id'=>$teachers->course_teacher[0],
                                                    'class_course_id'=>$course->id])}}">notes</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </form>
                </div>
            
            </div>
        </div>
    </div>
</x-app-layout>


