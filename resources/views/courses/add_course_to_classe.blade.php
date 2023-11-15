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
            {{ __('Ajouter des cours en') }}
        </h2>
    </x-slot>
    
    <form action="{{route('class_course.store',['class_id'=>$class_id])}}" method="POST" class="border bg-white mb-4 flex-col justify-between px-4 py-1 rounded-lg h-24 shadow-md ">
        @csrf
        <h3 class="">Ajouter un cours</h3>
        <div class="flex justify-around items-center w-full ">
            <div class="flex items-center">
                <label for='course_id' class="text-sm mr-3">Cours</label>
                <select id="course_id" name="course_id" class="bg-gray-50 border h-8 border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-900 focus:border-gray-900 block w-72  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-900 dark:focus:border-gray-900" >
                    @foreach($courses as $course)

                    <option value="{{$course->id}}" {{ old('course_id')  ? 'selected' : '' }}> {{$course->name}} </option>
                    @endforeach
                </select>
                <span class="text-red-600  text-xs mr-2">
                    @error('course_id')
                        {{$message}}
                    @enderror
                </span>
            </div>
            <div class="flex items-center">
                <label for='semester' class="text-sm mr-3">Semestre</label>
                <select id="semester" name="semester" class="bg-gray-50 border h-8 border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-900 focus:border-gray-900 block w-20  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-900 dark:focus:border-gray-900">
                    <option  value="1" {{ old('classe_id') ? 'selected' : '' }}> 1 </option>
                    <option value="2" {{ old('classe_id') ? 'selected' : '' }}> 2 </option>
                </select>
                <span class="text-red-600  text-xs mr-2">
                    @error('semester')
                        {{$message}}
                    @enderror
                </span>
            </div>
            <div class="flex items-center">
                <label for='school_year' class="text-sm mr-3">Année scolaire</label>
                <input type="number" id="school_year" name="school_year" value="{{old('school_year' ?? '')}}" required class=" rounded-lg bg-gray-50 border text-gray-900 focus:ring-gray-900 focus:border-gray-900 block flex-1 min-w-0 w-24 text-xs border-gray-300 py-1.5 px-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                <span class="text-red-600  text-xs mr-2">
                    @error('school_year')
                        {{$message}}
                    @enderror
                </span>
            </div>
            
            <div>
                <button type="submit" class="py-1 px-3 text-sm hover:bg-gray-600 focus:bg-gray-600 bg-gray-500 text-white rounded">Ajouter</button>
            </div>
        </div>
       

    </form>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="bg-gray-900 flex justify-between pr-9 items-center">
        
            <form class="p-4 bg-gray-900 dark:bg-gray-900 flex" action="{{ route('class_course.create',['class_id'=>$class_id]) }}" method="GET">
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
                        Années scolaires
                    </th>
                    <th scope="col" class="px-6 py-3">
                        semestre
                    </th>
                
                </tr>
            </thead>
            <tbody>
                @foreach($class_courses as $course)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="w-4 p-4">
                            {{$id=$id+1}}

                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$course->code}}
                        </th>
                        <td class="px-6 py-4">
                            {{$course->name}}

                        </td>
                        <td class="px-6 py-4">
                            {{$course->credit}}

                        </td>
                        <td class="px-6 py-4">
                            @foreach($course->class_courses as $class_course)
                                <div>
                                    {{$class_course->school_year}}
                                </div>
                            @endforeach
                        </td>
                        <td class="px-6 py-4">
                            @foreach($course->class_courses as $class_course)
                            <form action="{{route('class_course.delete', ['id'=> $class_course->id])}}" method="POST" class="flex justify-around w-full ">
                                @csrf
                                @method('DELETE')
                                    {{$class_course->semester}}
                                    <button type="submit" class="text-white" data-tooltip-target="tooltip-no-arrow">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 fill-red-700 stroke-red-700">
                                            <path fill-rule="evenodd" d="M2 4.75C2 3.784 2.784 3 3.75 3h4.836c.464 0 .909.184 1.237.513l1.414 1.414a.25.25 0 00.177.073h4.836c.966 0 1.75.784 1.75 1.75v8.5A1.75 1.75 0 0116.25 17H3.75A1.75 1.75 0 012 15.25V4.75zm10.25 7a.75.75 0 000-1.5h-4.5a.75.75 0 000 1.5h4.5z" clip-rule="evenodd" />
                                        </svg>  
                                    </button>
                                    <div id="tooltip-no-arrow" role="tooltip" class="absolute z-10 invisible inline-block px-2 py-1 text-xs  text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                        Supprimer
                                    </div>
                            </form>
                            @endforeach
                        </td>
                        
                       
                    </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>
   
        
</x-app-layout>
