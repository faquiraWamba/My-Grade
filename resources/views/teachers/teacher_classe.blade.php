<x-app-layout>
    <x-slot name="header" >
        <h2 class="font-semibold text-xl text-gray-800 leading-tig">
            {{ __('Les salle de et ses étudiants') }}
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
    @php
    $sortedStudents = $students->class_course->course_student->sortBy(function($student) {
        return $student->class_student->student->people->last_name;
    });
    @endphp     
    <div class="px-20 py-5">
        <div class="w-full bg-white  border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="sm:hidden">
                <label for="tabs" class="sr-only">Selectionner une option</label>
                <select id="tabs" class="bg-gray-50 border-0 border-b border-gray-200 text-gray-900 text-sm rounded-t-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500">
                    <option>Session normale</option>
                    <option>Contrôle Continu</option>
                </select>
            </div>
            <ul class="hidden text-sm  font-medium text-center text-gray-500 divide-x divide-gray-200 rounded-lg sm:flex dark:divide-gray-600 dark:text-gray-400" id="fullWidthTab" data-tabs-toggle="#fullWidthTabContent" role="tablist">
                <li class="w-full">
                    <button id="stats-tab" data-tabs-target="#stats" type="button" role="tab" aria-controls="stats" aria-selected="true" class="inline-block w-full p-4 rounded-tl-lg bg-gray-50 hover:bg-gray-100 focus:outline-none dark:bg-gray-700 dark:hover:bg-gray-600">Session normale</button>
                </li>
                <li class="w-full">
                    <button id="about-tab" data-tabs-target="#about" type="button" role="tab" aria-controls="about" aria-selected="false" class="inline-block w-full p-4 bg-gray-50 hover:bg-gray-100 focus:outline-none dark:bg-gray-700 dark:hover:bg-gray-600">Contrôle Continu</button>
                </li>
                
            </ul>
            <div id="fullWidthTabContent" class="border-t border-gray-200 dark:border-gray-600">
                <div class="hidden p-4 bg-white  rounded-lg md:p-8 dark:bg-gray-800" id="stats" role="tabpanel" aria-labelledby="stats-tab">
                    <form action="{{ route('notes.store', ['type' =>  'SN']) }}" method="POST" id="mySNForm"> 
                        @csrf  
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
                                        SN
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @foreach ($sortedStudents as $student)
                                    <tr class="hover:bg-gray-100">
                                        <th class="border border-slate-300">
                                            {{$loop->index=$loop->index+1}}
                                        </th>
                                        <td  class="border border-slate-300 pl-2">
                                            {{$student->class_student->student->people->last_name}}
                                            {{$student->class_student->student->people->first_name}}
                                        </td>
                                        <td class="border ">
                                            @php
                                                $length = count($student->note);
                                            @endphp
                                                @if($length != 0 )
                                                    @for($i=0; $i<$length; $i=$i+1)
                                                        @if($student->note[$i]->type == "SN")
                                                            @if($admin)
                                                                @if($student->note[$i]->status == 0)
                                                                    indisponible
                                                                @else
                                                                    <input type="number" name="scores[{{$student->id}}]" min="0" max="20" step="0.01"
                                                                    class="border-none w-full focus:border-orange-500 focus:ring-orange-500 disabled:opacity-75 disabled:bg-gray-50" 
                                                                    value="{{$student->note[$i]->note ?? old('scores.' . $student->id)}}" disabled/>
                                                                @endif
                                                            @else
                                                                <input type="number" name="scores[{{$student->id}}]" min="0" max="20" step="0.01"
                                                                class="border-none w-full focus:border-orange-500 focus:ring-orange-500 disabled:opacity-75 disabled:bg-gray-50" 
                                                                value="{{$student->note[$i]->note ?? old('scores.' . $student->id)}}" {{ $student->note[$i]->status == 1 ? 'disabled' : '' }} />
                                                                @break
                                                            @endif
                                                    
                                                        @else
                                                            
                                                            @if($length == 1)
                                                                <input type="number" name="scores[{{$student->id}}]" min="0" max="20" step="0.01"
                                                                class="border-none w-full focus:border-orange-500 focus:ring-orange-500 "/> 
                                        
                                                            @endif
                                                        @endif
                                                    @endfor
                                                @else
                                                    @if(!$admin)
                                                        <input type="number" name="scores[{{$student->id}}]" min="0" max="20" step="0.01"
                                                        class="border-none w-full focus:border-orange-500 focus:ring-orange-500 "/> 
                                                    @else
                                                        indisponible
                                                    @endif
                                                @endif
                                            @error('scores.' . $student->id)
                                                <div class="alert alert-danger text-red-700">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                @endforeach
                                <div class="flex">
                                    @if(!$admin)
                                        <button type="submit" class="bg-gray-900 p-1 border text-white rounded">Enregistrer</button>
                                        <button type="submit" id="submitButtonSN" class="bg-orange-500 p-1 border text-white rounded ">Soumettre</button>
                                    @endif
                                </div>
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="hidden  p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="about" role="tabpanel" aria-labelledby="about-tab">
                    <form action="{{ route('notes.store', ['type' =>  'CC']) }}" method="POST"  id="myCCForm"> 
                        @csrf  
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
                                        CC
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @foreach ($sortedStudents as $student)
                                    <tr class="hover:bg-gray-100">
                                        <th class="border border-slate-300">
                                            {{$loop->index=$loop->index+1}}
                                        </th>
                                        <td  class="border border-slate-300 pl-2">
                                            {{$student->class_student->student->people->last_name}}
                                            {{$student->class_student->student->people->first_name}}
                                        </td>
                                        <td class="border ">
                                            @php
                                                $length = count($student->note);
                                            @endphp
                                                @if($length != 0)
                                                    @for($i=0; $i<$length; $i=$i+1)
                                                        @if($student->note[$i]->type == "CC")
                                                            @if($admin)
                                                                @if($student->note[$i]->status == 0)
                                                                    indisponible
                                                                @else
                                                                    <input type="number" name="scores[{{$student->id}}]" min="0" max="20" step="0.01"
                                                                    class="border-none w-full focus:border-orange-500 focus:ring-orange-500 disabled:opacity-75 disabled:bg-gray-50" 
                                                                    value="{{$student->note[$i]->note ?? old('scores.' . $student->id)}}" disabled/>
                                                                @endif
                                                            @else
                                                                <input type="number" name="scores[{{$student->id}}]" min="0" max="20" step="0.01"
                                                                class="border-none w-full focus:border-orange-500 focus:ring-orange-500 disabled:opacity-75 disabled:bg-gray-50" 
                                                                value="{{$student->note[$i]->note ?? old('scores.' . $student->id)}}" {{ $student->note[$i]->status == 1 ? 'disabled' : '' }} />
                                                                @break
                                                            @endif
                                                        @else
                                                            @if($length == 1)
                                                                <input type="number" name="scores[{{$student->id}}]" min="0" max="20" step="0.01"
                                                                class="border-none w-full focus:border-orange-500 focus:ring-orange-500 "/> 
                                        
                                                            @endif
                                                        @endif
                                                    @endfor
                                                @else
                                                    <input type="number" name="scores[{{$student->id}}]" min="0" max="20" step="0.01"
                                                    class="border-none w-full focus:border-orange-500 focus:ring-orange-500 "/> 
                                     
                                                @endif
                                            @error('scores.' . $student->id)
                                                <div class="alert alert-danger text-red-700">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                @endforeach
                                <div class="flex">
                                    @if(!$admin)
                                        <button type="submit"  class="bg-gray-900 p-1 border text-white rounded">Enregistrer</button>
                                        <button type="submit" id="submitButtonCC" class="bg-orange-500 p-1 border text-white rounded mb-2">Soumettre</button>
                                    @endif
                                </div>
                            </tbody>
                        </table>
                    </form>
                </div>
            
            </div>
        </div>
    </div>
        
</x-app-layout>
