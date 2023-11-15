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
            {{ __('Suivre des cours') }}
        </h2>
    </x-slot>
    
<div class="relative overflow-x-auto shadow-md p-10 border-slate-900 sm:rounded-lg">
    <div class="bg-gray-900 flex justify-center font-bold p-9 items-center text-orange-500">
       CHOISIR DES COURS A SUIVRE POUR L'ANNEE SCOLAIRE
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
                    Cours
                </th>
                <th scope="col" class="px-6 py-3">
                    Crédit
                </th>
                <th scope="col" class="px-6  text-center py-3">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($class_courses as $class_course)
            {{-- @dd($teacher->fi) --}}
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="w-4 p-4">
                        {{$index=$index+1}}

                    </td>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$class_course->course->name}}
                    <td class="px-6 py-4">
                        {{$class_course->course->credit}}
                        {{-- @dd($teacher->people->teachers[0]->id); --}}
                    </td>
                    
                    <td class="px-6 py-4 flex justify-around ">
                        <form action="{{route('course_student.store',['class_student_id'=> $class_student_id, 'class_course_id'=>$class_course->id])}}" method="POST">
                            @csrf
                            <button type="submit" class="text-orange-500 font-bold hover:text-black">Suivre</button>
                        </form>
                    </td>
                </tr>
           @endforeach
        </tbody>
    </table>
</div>

        
</x-app-layout>
