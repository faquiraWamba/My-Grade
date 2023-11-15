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
            {{ __('Les salle de classes') }}
        </h2>
    </x-slot>
    
<div class="relative overflow-x-auto shadow-md sm:rounded-lg p4">
    <div class="bg-gray-900 flex justify-between pr-9 items-center">
       
        <div class="p-4 bg-gray-900 dark:bg-gray-900 flex">
             
            <div class="p-2 border-gray-700 rounded bg-white w-44 h-10"></div>
        </div>           
        @if(!isset($teacher_id))
            <a href="{{route('teacher_class_course.create',['course_teacher_id' => $teacherCourse->id])}}" class="text-gray-900 flex justify-center items-center  px-3 py-2 border-slate-300 hover:bg-orange-700 bg-orange-500 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path fill-rule="evenodd" d="M12 5.25a.75.75 0 01.75.75v5.25H18a.75.75 0 010 1.5h-5.25V18a.75.75 0 01-1.5 0v-5.25H6a.75.75 0 010-1.5h5.25V6a.75.75 0 01.75-.75z" clip-rule="evenodd" />
                </svg>         
            </a>
        @endif
    </div>
    <div class=" flex justify-between flex-wrap p-9 ">
        @foreach($classCourses as $classCourse)
            <div class="w-40 h-40 bg-gray-200 border mt-5 hover:bg-white rounded">
                <a href="{{route('my_class_course',['teacher_course_id'=>$teacherCourse->id, 'class_course_id'=>$classCourse->class_course->id])}}" class="w-full h-full  text-black flex flex-col justify-between p-3 items-center ">
                    <div class="w-full  flex justify-between items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-8 h-8 stroke-gray-700 fill-orange-500 ">
                            <path d="M7 8a3 3 0 100-6 3 3 0 000 6zM14.5 9a2.5 2.5 0 100-5 2.5 2.5 0 000 5zM1.615 16.428a1.224 1.224 0 01-.569-1.175 6.002 6.002 0 0111.908 0c.058.467-.172.92-.57 1.174A9.953 9.953 0 017 18a9.953 9.953 0 01-5.385-1.572zM14.5 16h-.106c.07-.297.088-.611.048-.933a7.47 7.47 0 00-1.588-3.755 4.502 4.502 0 015.874 2.636.818.818 0 01-.36.98A7.465 7.465 0 0114.5 16z" />
                        </svg>
                        <span class="text-lg  font-light">{{$classCourse->class_course->classe->speciality->acronym}}</span>
                    </div>
                    <span class="text-4xl font-bold">{{$classCourse->class_course->classe->level}}</span>
                    @if(!isset($teacher_id))
                        <form action="{{route('class_course_teacher.delete',['teacher_course_id'=>$teacherCourse->id, 'class_course_id'=>$classCourse->class_course->id])}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type ="submit" class="delete-item px-2 py-1 text-sm bg-red-700 hover:bg-red-900 rounded-lg text-white">supprimer</button>
                        </form> 
                    @endif
                    
                </a>
            </div>
        @endforeach   
    </div>
            
</div>

        
</x-app-layout>
