<x-app-layout>
    <x-slot name="header" >
        <h2 class="font-semibold text-xl text-gray-800 leading-tig">
            {{ __('Les Classe de '.' '.$level) }}
        </h2>
    </x-slot>
    
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <div class="bg-gray-900 flex justify-between pr-9 items-center">
       
        <form class="p-4 bg-gray-900 dark:bg-gray-900 flex" action="{{route('class.level',['level'=>$level])}}" method="GET">
             
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
        <a href="{{route('class.create')}}" class=" flex justify-center items-center  px-3 py-2 border-slate-300 hover:bg-gray-400 bg-white rounded-lg">
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
                    Niveau
                </th>
                <th scope="col" class="px-6 py-3">
                    Acronym
                </th>
                <th scope="col" class="px-6 py-3">
                    Description
                </th>
                <th scope="col" class="px-6  text-center py-3">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
            {{-- @dd($levels); --}}

            @foreach($levels as $level)

            @foreach($classes as $class)

                @if($level->speciality_id != $class->id)
                    @continue
                @else
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="w-4 p-4">
                            {{$id=$id+1}}
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            
                            {{$level->level}}
                        </th>
                        <td class="px-6 py-4">
                            {{$class->acronym}}

                        </td>
                        <td class="px-6 py-4">
                            {{$class->description}}

                        </td>
                        
                        <td class="px-6 py-4 flex justify-around ">
                            <a href="{{route('class',['id'=>$level->id])}}" class="font-medium text-gray-400 dark:text-gray-500 hover:text-gray-900">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                    <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                    <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" clip-rule="evenodd" />
                                </svg>                              
                            </a>
                            <a href="{{route('class.edit',['id'=>$level->id])}}" class="font-medium text-gray-400 dark:text-gray-500 hover:text-gray-900">
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
                    @break
                @endif
            @endforeach
           @endforeach
        </tbody>
    </table>
</div>

        
</x-app-layout>
