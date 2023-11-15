<x-app-layout>
    <x-slot name="header" >
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ">
           
            @if (isset($tutor) && isset($person) )
                {{ __('Modification des informations de un parent') }}
            @else
                {{ __('Ajouter un parent') }}
            @endif
        </h2>
    </x-slot>

        <div class=" h-96 flex  items-center justify-center">
            <div class=" rounded-lg h-auto w-full bg-white flex flex-col justify-center items-center ">
                <div class="text-white bg-gray-900 w-full h-7 flex ">
                    <div class="mx-1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                            <path d="M11 5a3 3 0 11-6 0 3 3 0 016 0zM2.615 16.428a1.224 1.224 0 01-.569-1.175 6.002 6.002 0 0111.908 0c.058.467-.172.92-.57 1.174A9.953 9.953 0 018 18a9.953 9.953 0 01-5.385-1.572zM16.25 5.75a.75.75 0 00-1.5 0v2h-2a.75.75 0 000 1.5h2v2a.75.75 0 001.5 0v-2h2a.75.75 0 000-1.5h-2v-2z" />
                        </svg>
                                                    
                    </div>
                    <div class="">
                       {{__("Identifiants du parent")}}
                    </div>
                </div>
                
                <div class="w-full p-5 ">
                    @if (isset($tutor))

                    <form class="border p-2 w-full h-auto flex flex-col items-center" method="post" action="{{ route('tutor.edit', ['id' =>  $tutor->id]) }}" enctype="multipart/form-data">

                    @method('PUT')

                    @else
                        @if( isset($student_id))
                            <form class="border p-2 w-full h-auto flex flex-col items-center" action="{{route('tutor.store',['student_id'=>$student_id])}}" method="POST" enctype="multipart/form-data">
                        @else
                            <form class="border p-2 w-full h-auto flex flex-col items-center" action="{{route('tutor.store')}}" method="POST" enctype="multipart/form-data">

                        @endif
                    @endif
                    @csrf
                        <div class="w-full">
                            <div class="mb-6 flex flex-col  h-full w-full  border">
                            
                                <div class=" flex flex-wrap justify-between px-6 border w-full">
                                    <div class=" w-2/5 ">
                                        <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                                        <div class="flex items-center w-64">
                                            <span class="inline-flex items-center px-2.5 py-2 text-xs text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                                <svg class="w-3 h-3 text-gray-500 dark:text-gray-400 fill-gray-900 stroke-orange-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                                                </svg>
                                            </span>
                                            <input type="text" id="last_name" name="last_name" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-gray-900 focus:border-gray-900 block flex-1 min-w-0 w-full text-xs border-gray-300 py-1.5 px-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Nom du parent" value="{{old('last_name',$person->last_name ?? '')}}" required>
                                        </div>
                                        
                                        <span class="text-red-600  text-xs mr-2">
                                            @error('last_name')
                                                {{$message}}
                                            @enderror
                                        </span>                         
                                    </div>
                                    
                                    <div class=" w-2/5 ">
                                        <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prénom</label>
                                        <div class="flex items-center w-64">
                                            <span class="inline-flex items-center px-2.5 py-2 text-xs text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                                <svg class="w-3 h-3 text-gray-500 dark:text-gray-400 fill-gray-900 stroke-orange-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                                                </svg>
                                            </span>
                                            <input type="text" id="first_name" name="first_name" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-gray-900 focus:border-gray-900 block flex-1 min-w-0 w-full text-xs border-gray-300 py-1.5 px-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Prénom du parent" value="{{old('first_name',$person->first_name ?? '')}}" required>
                                        </div>
                                        
                                        <span class="text-red-600  text-xs mr-2">
                                            @error('first_name')
                                                {{$message}}
                                            @enderror
                                        </span>                         
                                    </div>
                                    <div class="flex  w-1/5 flex-col ">
                                        <label for="sexe" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sexe</label>
                                        <div class="flex  flex-around   ">
                                            <div class="flex items-center ">
                                                <input required id="M" type="radio" value="M" {{ old('gender') == 'M' ? 'checked' : '' }} name="gender" class="w-4 h-4 text-gray-900 bg-gray-100 border-gray-300 focus:ring-orange-500 dark:focus:ring-orange-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="M" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">M</label>
                                            </div>
                                            <div class="flex items-center ml-4">
                                                <input required id="F" type="radio" value="F" {{ old('gender') == 'F' ? 'checked' : '' }} name="gender" class="w-4 h-4 text-gray-900 bg-gray-100 border-gray-300 focus:ring-orange-500 dark:focus:ring-orange-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="F" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">F</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    @if(!isset($tutor))
                                    <div class=" w-1/2 ">
                                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Adresse Mail</label>
                                        <div class="flex items-center w-80">
                                            <span class="inline-flex items-center px-2.5 py-2 text-xs text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3 h-3 text-gray-500 dark:text-gray-400 fill-gray-900 stroke-orange-400">
                                                    <path d="M3 4a2 2 0 00-2 2v1.161l8.441 4.221a1.25 1.25 0 001.118 0L19 7.162V6a2 2 0 00-2-2H3z" />
                                                    <path d="M19 8.839l-7.77 3.885a2.75 2.75 0 01-2.46 0L1 8.839V14a2 2 0 002 2h14a2 2 0 002-2V8.839z" />
                                                </svg>
                                                  
                                            </span>
                                            <input type="email" id="email" name="email" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-gray-900 focus:border-gray-900 block flex-1 min-w-0 w-full text-xs border-gray-300 py-1.5 px-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="email" value="{{old('email',$tutor->email ?? '')}}" required>
                                        </div>
                                        
                                        <span class="text-red-600  text-xs mr-2">
                                            @error('email')
                                                {{$message}}
                                            @enderror
                                        </span>                         
                                    </div>
                                    @endif
                                    <div class=" w-1/2 ">
                                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Téléphone</label>
                                        <div class="flex items-center w-80">
                                            <span class="inline-flex items-center px-2.5 py-2 text-xs text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3 h-3 text-gray-500 dark:text-gray-400 fill-gray-900 stroke-orange-400">
                                                    <path fill-rule="evenodd" d="M2 3.5A1.5 1.5 0 013.5 2h1.148a1.5 1.5 0 011.465 1.175l.716 3.223a1.5 1.5 0 01-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 006.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 011.767-1.052l3.223.716A1.5 1.5 0 0118 15.352V16.5a1.5 1.5 0 01-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 012.43 8.326 13.019 13.019 0 012 5V3.5z" clip-rule="evenodd" />
                                                </svg>
                                                  
                                            </span>
                                            <input type="number" id="phone" name="phone" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-gray-900 focus:border-gray-900 block flex-1 min-w-0 w-full text-xs border-gray-300 py-1.5 px-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Numéro de téléphone" value="{{old('phone',$person->phone ?? '')}}" >
                                        </div>
                                        
                                        <span class="text-red-600  text-xs mr-2">
                                            @error('phone')
                                                {{$message}}
                                            @enderror
                                        </span>                         
                                    </div>
                                   
                                    
                                </div>
                                <div class="w-full border flex flex-between px-6 py-2">
                                    <div class="flex  w-full flex-col ">
                                        <label for="startAt" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Relation</label>
                                        <div class="flex items-center w-80">
                                            
                                                <span class="inline-flex items-center px-2.5 py-2 text-xs text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3 h-3 text-gray-500 dark:text-gray-400 fill-gray-900 stroke-orange-400">
                                                    <path d="M9.653 16.915l-.005-.003-.019-.01a20.759 20.759 0 01-1.162-.682 22.045 22.045 0 01-2.582-1.9C4.045 12.733 2 10.352 2 7.5a4.5 4.5 0 018-2.828A4.5 4.5 0 0118 7.5c0 2.852-2.044 5.233-3.885 6.82a22.049 22.049 0 01-3.744 2.582l-.019.01-.005.003h-.002a.739.739 0 01-.69.001l-.002-.001z" />
                                                    </svg>                                                                                                                                           
                                                </span>
                                            <select  name="relation" id="relation"  class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-gray-900 focus:border-gray-900 block flex-1 min-w-0 w-full text-xs border-gray-300 py-1.5 px-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <option value="père" {{old('père'?'selected':'')}}>père</option>
                                                <option value="mère" {{old('mère'?'selected':'')}}>mère</option>
                                                <option value="tuteur" {{old('tuteur'?'selected':'')}}>tuteur</option>
                                            </select>
                                        </div>
                                        <span class="text-red-600  text-xs mr-2">
                                            @error('relation')
                                                {{$message}}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="text-white bg-gray-900 hover:bg-gray-950 focus:ring-4 focus:outline-none focus:ring-gray-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-800 dark:hover:bg-gray-900 dark:focus:ring-gray-950">
                                @if (isset($tutor))
                                {{ __('Modifier l\'enseignant') }}
                                @else
                                    {{ __('Ajouter Un enseignant') }}
                                @endif
                            </button>
                        </div>
                        </form>
                    
                </div>
            </div>
        </div>
  
</x-app-layout>
