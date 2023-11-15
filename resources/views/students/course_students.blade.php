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
            {{ __('cours') }}
        </h2>
    </x-slot>
    
<div class="overflow-x-auto shadow-md p-10 border-slate-900 sm:rounded-lg">
    <div class="bg-gray-900 flex justify-center font-bold p-9 items-center text-orange-500">
       COURS SUIVI(S)
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
                    Cours
                </th>
                <th scope="col" class="px-6 py-3">
                    Crédit
                </th>
                <th scope="col" class="px-6  text-center py-3">
                    Notes
                </th>
                <th scope="col" class="px-6  text-center py-3">
                    
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($course_students as $course_student)
            {{-- @dd($teacher->fi) --}}
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="w-4 p-4">
                        {{$loop->index=$loop->index+1}}

                    </td>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$course_student->class_course->course->code}}
                    </th>
                    <td class="px-6 py-4">
                        {{$course_student->class_course->course->name}}
                    </td>
                    <td class="px-6 py-4">
                        {{$course_student->class_course->course->credit}}
                    </td>
                    
                    <td class="px-6 py-4 flex justify-center">
                        <a href="{{route('course_student.notes',['course_student_id'=>$course_student->id, 'course_id'=>$course_student->class_course->course->id])}}">
                            <span class="mr-1">note</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                <path d="M10 12.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" />
                                <path fill-rule="evenodd" d="M.664 10.59a1.651 1.651 0 010-1.186A10.004 10.004 0 0110 3c4.257 0 7.893 2.66 9.336 6.41.147.381.146.804 0 1.186A10.004 10.004 0 0110 17c-4.257 0-7.893-2.66-9.336-6.41zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                            </svg>
                        </a>  
                          
                    </td> 
                    <td class="px-6 py-4">
                        <form action="{{ route('course_student.delete', ['course_student_id'=>$course_student->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-item ">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 fill-red-700 hover:fill-red-900">
                                    <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </form>
                    </td>
                   
                </tr>
           @endforeach
        </tbody>
    </table>
</div>

{{-- <script>
    document.querySelectorAll('.delete-item').forEach(function(element) {
    element.addEventListener('click', function(e) {
        if (!confirm('Êtes-vous sûr de vouloir supprimer cet élément?')) {
            e.preventDefault();
        }
    });
});
</script>    --}}
</x-app-layout>
