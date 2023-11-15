

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
            {{ __('Attribuer une cours') }}
        </h2>
    </x-slot>
    
    <div class="flex justify-center items-center w-full  h-72">
        <form action="{{route('teacher_class_course.store',['teacher_course_id'=>$course_teacher_id])}}" method="POST" class=" w-96  bg-white mb-4 flex flex-col justify-between items-center p-4  rounded-lg h-52 shadow-md ">
            @csrf
            <h3 class="text-2xl font-bold">Attribuer une classe </h3>
            <div class="flex flex-col ">
                <label for='class_course_id' class="text-lg font-bold mr-3">Cours</label>
                <select id="class_course_id" name="class_course_id" class="bg-gray-50 border h-8 border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-900 focus:border-gray-900 block w-72  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-900 dark:focus:border-gray-900" >
                    <option>Choisissez une classe</option>
                    @foreach($classes as $class)
                        @foreach($class->class_courses as $class_course)
                            @if($class_course->class_id==$class->id)
                                <option value="{{$class_course->id}}" {{ old('class_course_id')  ? 'selected' : '' }}>
                                    {{$class->level}}
                                @break
                            @endif
                        @endforeach
                        @foreach($specialities as $speciality)
                            @if($class->speciality_id == $speciality->id)
                                {{$speciality->acronym}}
                                @break
                            @endif
                        @endforeach
                    </option>
                    @endforeach
                </select>
                <span class="text-red-600  text-xs mr-2">
                    @error('class_course_id')
                        {{$message}}
                    @enderror
                </span>
            </div>
            
            <div>
                <button type="submit" class="py-1 px-4 text-lg hover:bg-orange-600 focus:bg-orange-600 bg-orange-500 text-white rounded">Ajouter</button>
            </div>
        </form>
    </div>
   
   
        
</x-app-layout>
