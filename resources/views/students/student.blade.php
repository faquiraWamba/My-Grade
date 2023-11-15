<x-app-layout>
    <x-slot name="header" >
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('L\'étudiant '.$student->registration_number) }}
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

    <div class="py-7 w-full ">
        <div class="flex justify-between w-full border">
            <div>
                <div>
                    <span>Nom(s):</span>
                    <span>{{$user->people->last_name}}</span>
                </div>
                <div>
                    <span>Prénom(s):</span>
                    <span>{{$user->people->first_name}}</span>
                </div>
                <div>
                    <span>Email:</span>
                    <span>{{$user->email}} </span>
                </div>
                <div>
                    <span>Téléphone:</span>
                    <span>{{$user->people->phone}} </span>
                </div>
            </div>
            <div class="border w-40 h-36">
                <img class="w-full h-full" src="{{$student->picture}}" alt="student picture">
            </div> 
        </div>
        <div class="py-12 ">
        
            <div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="sm:hidden">
                    <label for="tabs" class="sr-only">Selectionner une option</label>
                    <select id="tabs" class="bg-gray-50 border-0 border-b border-gray-200 text-gray-900 text-sm rounded-t-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option>Années scolaires et classes</option>
                        <option>Listes des tuteurs</option>
                    </select>
                </div>
                <ul class="hidden text-sm font-medium text-center text-gray-500 divide-x divide-gray-200 rounded-lg sm:flex dark:divide-gray-600 dark:text-gray-400" id="fullWidthTab" data-tabs-toggle="#fullWidthTabContent" role="tablist">
                    <li class="w-full">
                        <button id="stats-tab" data-tabs-target="#stats" type="button" role="tab" aria-controls="stats" aria-selected="true" class="inline-block w-full p-4 rounded-tl-lg bg-gray-50 hover:bg-gray-100 focus:outline-none dark:bg-gray-700 dark:hover:bg-gray-600">Années scolaires et classes</button>
                    </li>
                    <li class="w-full">
                        <button id="about-tab" data-tabs-target="#about" type="button" role="tab" aria-controls="about" aria-selected="false" class="inline-block w-full p-4 bg-gray-50 hover:bg-gray-100 focus:outline-none dark:bg-gray-700 dark:hover:bg-gray-600">Listes des tuteurs</button>
                    </li>
                    
                </ul>
                <div id="fullWidthTabContent" class="border-t border-gray-200 dark:border-gray-600">
                    <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="stats" role="tabpanel" aria-labelledby="stats-tab">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="p-4">
                                        <div class="flex items-center">
                                            No
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Année
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        classe 
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Bulletins
                                    </th>
                                    <th scope="col" class="px-6  text-center py-3">
                                        Cours suivies
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @dd($user->people->students[0]->class_students) --}}
                                @foreach($user->people->students[0]->class_students as $student_class)
                                    <tr>
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{$index=$index+1}}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{$student_class->school_year}}
                                        </td>
                                        <td class="px-6 py-4 text-lg">
                                          {{$student_class->classe->level.' '. $student_class->classe->speciality->acronym}}
                                        </td>
                                        <td class="px-6 py-4">
                                           <a href="{{$student_class->report_card}}">Voir</a>
                                        </td>
                                        <td class="px-4 py-4  flex justify-center">
                                            @php     
                                             $courses=App\Models\Course_student::where('class_student_id',$student_class->id)->count(); 
                                            @endphp
                                            {{$courses }} cour(s)
                                         </td>
                                    </tr>
                                @endforeach

                            </tbody>

                        </table>
                        <a href='#' class="text-white bg-gray-900 hover:bg-gray-950 focus:ring-4 focus:outline-none focus:ring-gray-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-800 dark:hover:bg-gray-900 dark:focus:ring-gray-950">Ajouter une année scolaire</a>
            
                    </div>
                    <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="about" role="tabpanel" aria-labelledby="about-tab">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="p-4">
                                        <div class="flex items-center">
                                            No
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Nom et Prénom
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Téléphone
                                    </th>
                                    <th scope="col" class="px-6  text-center py-3">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tutors as $tutor)
                                {{-- @dd($tutor->fi) --}}
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="w-4 p-4">
                                            {{$T_index=$T_index+1}}
                    
                                        </td>
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{$tutor->people->gender == 'M'? 'M.': 'Mme'}} {{$tutor->people->last_name}} {{$tutor->people->first_name}}
                                        <td class="px-6 py-4">
                                            {{$tutor->people->phone}}
                                            {{-- @dd($tutor->people->tutors[0]->id); --}}
                                        </td>
                                        
                                        <td class="px-6 py-4 flex justify-around ">
                                            <a href="{{route('tutor',['id'=>$tutor->people->tutors[0]->id])}}" class="font-medium text-gray-400 dark:text-gray-500 hover:text-gray-900">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                                    <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                                    <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" clip-rule="evenodd" />
                                                  </svg>                              
                                            </a>
                                            <a href="{{route('tutor.edit',['id'=>$tutor->people->tutors[0]->id])}}" class="font-medium text-gray-400 dark:text-gray-500 hover:text-gray-900">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                                    <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                                                  </svg>                              
                                            </a>
                                            <a href="#" class="font-medium text-gray-400 dark:text-gray-500 hover:text-gray-900">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                                    <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                               @endforeach
                            </tbody>
                        </table>
                        <a href="{{route('tutor.create',['student_id'=>$id])}}" class="text-white bg-gray-900 hover:bg-gray-950 focus:ring-4 focus:outline-none focus:ring-gray-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-800 dark:hover:bg-gray-900 dark:focus:ring-gray-950">Ajouter un tuteur</a>
            
                    </div>
                   
                </div>
            </div>
                </div>
    </div>
</x-app-layout>
