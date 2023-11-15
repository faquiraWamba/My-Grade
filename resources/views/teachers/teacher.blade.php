
<x-app-layout>
    <x-slot name="header" >
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- {{ __('L\'enseignant ') }} --}}
            {{ $user->people->gender == 'M' ? 'M.' : 'Mme' }} {{$user->people->last_name}} {{$user->people->first_name}}

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
    <div class="py-7 w-full flex justify-between ">
            <div class="">
                    <div>
                        <span>Email:</span>
                        <span>{{$user->email}} </span>
                    </div>
                    <div>
                        <span>Téléphone:</span>
                        <span>+237 {{$user->people->phone}} </span>
                    </div>
                    
            </div>
            <div>
                    <span>Employé depuis le:</span>
                    <span>{{$teacher->startAt}} </span>
            </div>
    </div>
    <form action="{{route('course_teacher.store',['teacher_id'=>$id])}}" method="POST" class="border bg-white mb-4 flex-col justify-between px-4 py-1 rounded-lg h-24 shadow-md ">
        @csrf
        <h3 class="mb-4">Ajouter un cours</h3>
        <div class="flex justify-between items-center w-full ">
            <div class="flex items-center">
                <label for='course_id' class="text-sm mr-3">Cours</label>
                <select id="course_id" name="course_id" class="bg-gray-50 border h-8 border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-900 focus:border-gray-900 block w-72  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-900 dark:focus:border-gray-900" >
                    @foreach($Allcourses as $course)
                    <option value="{{$course->id}}" {{ old('course_id')  ? 'selected' : '' }}> {{$course->name}} </option>
                    @endforeach
                </select>
                <span class="text-red-600  text-xs mr-2">
                    @error('class_id')
                        {{$message}}
                    @enderror
                </span>
            </div>
            
            <div>
                <button type="submit" class="py-1 px-3 text-sm hover:bg-orange-600 focus:bg-orange-600 bg-orange-500 text-white rounded">Ajouter</button>
            </div>
        </div>
       

    </form>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="bg-gray-900 flex justify-between pr-9 items-center">
        
            <form class="p-4 bg-gray-900 dark:bg-gray-900 flex" action="{{-- route('course_teacher.create',['class_id'=>$class_id]) --}}" method="GET">
                @csrf
                <input 
                            type="text" 
                            name="search" 
                            value="{{ request()->get('search') }}"
                            placeholder="Rechercher..."
                            class="p-2 border-gray-500 rounded-l  "
                        >
                        <button type="submit" class="p-2 hover:bg-gray-600 focus:bg-gray-600 bg-gray-500 text-white rounded-r">
                            <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path d="M8.25 10.875a2.625 2.625 0 115.25 0 2.625 2.625 0 01-5.25 0z" />
                            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.125 4.5a4.125 4.125 0 102.338 7.524l2.007 2.006a.75.75 0 101.06-1.06l-2.006-2.007a4.125 4.125 0 00-3.399-6.463z" clip-rule="evenodd" />
                        </svg>
                        </button>
                    
            </form>
            <a href="{{route('course.create')}}" class=" flex justify-center items-center  px-3 py-2 border-slate-300 hover:bg-gray-400 bg-white rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path fill-rule="evenodd" d="M12 5.25a.75.75 0 01.75.75v5.25H18a.75.75 0 010 1.5h-5.25V18a.75.75 0 01-1.5 0v-5.25H6a.75.75 0 010-1.5h5.25V6a.75.75 0 01.75-.75z" clip-rule="evenodd" />
                </svg>         
            </a>
        </div>
        
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="p-4">
                        <div class="flex items-center">
                            No
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        code
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nom
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Crédits
                    </th>
                    <th scope="col" class="px-6 py-3">
                        classe(s) attribué(es)
                    </th>
                    <th scope="col" class="px-6 py-3">
                        plus de classe
                    </th>
                
                </tr>
            </thead>
            <tbody>
            @foreach($courses as $course)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="w-4 p-4">
                            {{$index=$index+1}}

                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$course->course->code}}
                        </th>
                        <td class="px-6 py-4">
                            {{$course->course->name}}

                        </td>
                        <td class="px-6 py-4">
                            {{$course->course->credit}}

                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white flex justify-center">
                            <a href="{{route('my_class_courses', ['teacher_course_id'=> $course->id])}}" class="flex font-medium text-gray-400 dark:text-gray-500 hover:text-gray-900">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                    <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                    <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" clip-rule="evenodd" />
                                  </svg>
                                  <span class="ml-3">classe(s)</span>                              
                            </a>
                            </div>
                        </th>


                        <td class="px-6 py-4">
                                <form action="{{route('course_teacher.delete', ['id'=> $course->id])}}" method="POST" class="flex justify-around w-full ">
                                    @csrf
                                    @method('DELETE')
                                        {{$course->teacher->semester}}
                                        <button type="submit" class="text-white" data-tooltip-target="tooltip-no-arrow">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6 fill-red-700 stroke-red-700">
                                                <path fill-rule="evenodd" d="M2 4.75C2 3.784 2.784 3 3.75 3h4.836c.464 0 .909.184 1.237.513l1.414 1.414a.25.25 0 00.177.073h4.836c.966 0 1.75.784 1.75 1.75v8.5A1.75 1.75 0 0116.25 17H3.75A1.75 1.75 0 012 15.25V4.75zm10.25 7a.75.75 0 000-1.5h-4.5a.75.75 0 000 1.5h4.5z" clip-rule="evenodd" />
                                            </svg>  
                                        </button>
                                        <div id="tooltip-no-arrow" role="tooltip" class="absolute z-10 invisible inline-block px-2 py-1 text-xs  text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                            Supprimer
                                        </div>
                                </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
</x-app-layout>
