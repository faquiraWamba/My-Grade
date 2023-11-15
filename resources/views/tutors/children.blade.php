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
            {{ __('VOS ENFANTS') }}
        </h2>
    </x-slot>
    
<div class="relative overflow-x-auto shadow-md p-10 border-slate-900 sm:rounded-lg">
    <div class="bg-gray-900 flex justify-center font-bold p-9 items-center text-orange-500">
       Liste de vos enfants
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
                    Matricule
                </th>
                <th scope="col" class="px-6 py-3">
                    Prénom
                </th>
                <th scope="col" class="px-6 py-3">
                    Nom
                </th>
                <th scope="col" class="px-6  text-center py-3">
                    Relevés
                </th>
                <th scope="col" class="px-6  text-center py-3">
                    Bulletins
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($user->people->tutors as $tutor)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="w-4 p-4">
                        {{$loop->index=$loop->index+1}}

                    </td>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$tutor->students->registration_number}}
                    </th>
                    <td class="px-6 py-4">
                        {{$tutor->students->people->first_name}}
                    </td>
                    <td class="px-6 py-4">
                        {{$tutor->students->people->last_name}}

                    </td>
                    
                    <td class="px-6 py-4 text-center ">
                        <a href="{{route('student.notes',['semester'=>1, 'student_id'=>$tutor->students->id])}}" class="hover:text-orange-500">
                            <span class="mr-1">notes</span>
                        </a>           
                    </td> 
                    <td class="px-6 py-4 flex justify-center">
                        <a href="{{route('student.card',['student_id'=>$tutor->students->id])}}" class="hover:text-orange-500">
                            
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                <path d="M10 12.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" />
                                <path fill-rule="evenodd" d="M.664 10.59a1.651 1.651 0 010-1.186A10.004 10.004 0 0110 3c4.257 0 7.893 2.66 9.336 6.41.147.381.146.804 0 1.186A10.004 10.004 0 0110 17c-4.257 0-7.893-2.66-9.336-6.41zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                            </svg>
                        </a>           
                    </td> 
                    
                </tr>
           @endforeach
        </tbody>
    </table>
</div>

</x-app-layout>
