<x-app-layout>
    <x-slot name="header" >
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ">
           
            @if (isset($student) && isset($person) )
                {{ __('Modification des informations de un étudiant') }}
            @else
                {{ __('Ajouter un étudiant') }}
            @endif
        </h2>
    </x-slot>

        <div class=" h-auto flex  items-center justify-center">
            <div class=" rounded-lg h-auto w-full bg-white flex flex-col items-center ">
                <div class="text-white bg-gray-900 w-full h-7 flex ">
                    <div class="mx-1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                            <path d="M11 5a3 3 0 11-6 0 3 3 0 016 0zM2.615 16.428a1.224 1.224 0 01-.569-1.175 6.002 6.002 0 0111.908 0c.058.467-.172.92-.57 1.174A9.953 9.953 0 018 18a9.953 9.953 0 01-5.385-1.572zM16.25 5.75a.75.75 0 00-1.5 0v2h-2a.75.75 0 000 1.5h2v2a.75.75 0 001.5 0v-2h2a.75.75 0 000-1.5h-2v-2z" />
                        </svg>
                                                    
                    </div>
                    <div class="">
                       {{__("Identifiants de l'étudiant")}}
                    </div>
                </div>
                
                <div class="w-full p-5">
                    @if (isset($student))

                    <form class="border p-2 w-full h-auto flex flex-col items-center" method="post" action="{{ route('student.update', ['id' =>  $student->id]) }}" enctype="multipart/form-data">

                    @method('PUT')

                    @else

                    <form class="border p-2 w-full h-auto flex flex-col items-center" action="{{route('student.store')}}" method="POST" enctype="multipart/form-data">
                        
                    @endif
                    @csrf
                        <div class="w-full">
                            <div class="mb-6 flex flex-col  h-full w-full  border">
                                
                                <div class="flex items-center justify-end pr-7  mb-4 h-28">
                                    <label for="dropzone-file" class="flex flex-col items-center justify-center w-28 h-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                            </svg>
                                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                        </div>
                                        <input id="dropzone-file" name="picture" type="file" class="hidden" value="{{old('picture',$student->picture ?? '')}}"/>
                                    </label>
                                </div> 
                                <div class=" flex flex-wrap justify-between px-6 border w-full">
                                    <div class=" w-2/5 ">
                                        <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                                        <div class="flex items-center w-64">
                                            <span class="inline-flex items-center px-2.5 py-2 text-xs text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                                <svg class="w-3 h-3 text-gray-500 dark:text-gray-400 fill-gray-900 stroke-orange-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                                                </svg>
                                            </span>
                                            <input type="text" id="last_name" name="last_name" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-gray-900 focus:border-gray-900 block flex-1 min-w-0 w-full text-xs border-gray-300 py-1.5 px-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Nom de l'étudiant" value="{{old('last_name',$person->last_name ?? '')}}" required>
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
                                            <input type="text" id="first_name" name="first_name" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-gray-900 focus:border-gray-900 block flex-1 min-w-0 w-full text-xs border-gray-300 py-1.5 px-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Prénom de l'étudiant" value="{{old('first_name',$person->first_name ?? '')}}" required>
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
                                                <input id="M" type="radio" value="M" {{ old('gender',$person->gender ?? '' ) == 'M' ? 'checked' : '' }} name="gender" class="w-4 h-4 text-gray-900 bg-gray-100 border-gray-300 focus:ring-orange-500 dark:focus:ring-orange-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="M" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">M</label>
                                            </div>
                                            <div class="flex items-center ml-4">
                                                <input id="F" type="radio" value="F" {{ old('gender',$person->gender ?? '') == 'F' ? 'checked' : '' }} name="gender" class="w-4 h-4 text-gray-900 bg-gray-100 border-gray-300 focus:ring-orange-500 dark:focus:ring-orange-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="F" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">F</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex  w-1/2 flex-col ">
                                        <label for="birthday" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Né le</label>
                                        <div class="flex items-center w-80">
                                            
                                                <span class="inline-flex items-center px-2.5 py-2 text-xs text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                                    <svg class="w-3 h-3 text-gray-500 dark:text-gray-400 fill-gray-900 stroke-orange-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                                    </svg>
                                                </span>
                                            <input datepicker   name="birthday" id="birthday" type="date" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-gray-900 focus:border-gray-900 block flex-1 min-w-0 w-full text-xs border-gray-300 py-1.5 px-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="date de naissance" value="{{old('birthday',$student->birthday ?? '')}}">
                                        </div>
                                        <span class="text-red-600  text-xs mr-2">
                                            @error('birthday')
                                                {{$message}}
                                            @enderror
                                        </span>
                                    </div>
                                    
                                    <div class=" w-1/2 ">
                                        <label for="birth_town" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">À</label>
                                        <div class="flex items-center w-80">
                                            <span class="inline-flex items-center px-2.5 py-2 text-xs text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                               
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3 h-3 text-gray-500 dark:text-gray-400 fill-gray-900 stroke-orange-400">
                                                    <path fill-rule="evenodd" d="M9.293 2.293a1 1 0 011.414 0l7 7A1 1 0 0117 11h-1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-3a1 1 0 00-1-1H9a1 1 0 00-1 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-6H3a1 1 0 01-.707-1.707l7-7z" clip-rule="evenodd" />
                                                </svg>
                                                  
                                            </span>
                                            <input type="text" id="birth_town" name="birth_town" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-gray-900 focus:border-gray-900 block flex-1 min-w-0 w-full text-xs border-gray-300 py-1.5 px-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="lieu de naissance" value="{{old('birth_town',$student->birth_town ?? '')}}" required>
                                        </div>
                                        
                                        <span class="text-red-600  text-xs mr-2">
                                            @error('birth_town')
                                                {{$message}}
                                            @enderror
                                        </span>                         
                                    </div>
                                    @if(!isset($student))
                                    <div class=" w-1/2 ">
                                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Adresse Mail</label>
                                        <div class="flex items-center w-80">
                                            <span class="inline-flex items-center px-2.5 py-2 text-xs text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3 h-3 text-gray-500 dark:text-gray-400 fill-gray-900 stroke-orange-400">
                                                    <path d="M3 4a2 2 0 00-2 2v1.161l8.441 4.221a1.25 1.25 0 001.118 0L19 7.162V6a2 2 0 00-2-2H3z" />
                                                    <path d="M19 8.839l-7.77 3.885a2.75 2.75 0 01-2.46 0L1 8.839V14a2 2 0 002 2h14a2 2 0 002-2V8.839z" />
                                                </svg>
                                                  
                                            </span>
                                            <input type="email" id="email" name="email" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-gray-900 focus:border-gray-900 block flex-1 min-w-0 w-full text-xs border-gray-300 py-1.5 px-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="email" value="{{old('email',$student->email ?? '')}}" required>
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
                                            <input type="number" id="phone" name="phone" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-gray-900 focus:border-gray-900 block flex-1 min-w-0 w-full text-xs border-gray-300 py-1.5 px-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Numéro de éléphone" value="{{old('phone',$person->phone ?? '')}}" >
                                        </div>
                                        
                                        <span class="text-red-600  text-xs mr-2">
                                            @error('phone')
                                                {{$message}}
                                            @enderror
                                        </span>                         
                                    </div>
                                    
                                </div>

                                <div class="w-full border flex flex-between px-6">
                                    <div class=" w-2/3 ">
                                        <label for="classe_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Classe</label>
                                        <div class="flex items-center w-72 ">
                                            <span class="inline-flex items-center px-2.5 py-2 text-xs text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3 h-3 text-gray-500 dark:text-gray-400 fill-gray-900 stroke-orange-400">
                                                    <path fill-rule="evenodd" d="M9.664 1.319a.75.75 0 01.672 0 41.059 41.059 0 018.198 5.424.75.75 0 01-.254 1.285 31.372 31.372 0 00-7.86 3.83.75.75 0 01-.84 0 31.508 31.508 0 00-2.08-1.287V9.394c0-.244.116-.463.302-.592a35.504 35.504 0 013.305-2.033.75.75 0 00-.714-1.319 37 37 0 00-3.446 2.12A2.216 2.216 0 006 9.393v.38a31.293 31.293 0 00-4.28-1.746.75.75 0 01-.254-1.285 41.059 41.059 0 018.198-5.424zM6 11.459a29.848 29.848 0 00-2.455-1.158 41.029 41.029 0 00-.39 3.114.75.75 0 00.419.74c.528.256 1.046.53 1.554.82-.21.324-.455.63-.739.914a.75.75 0 101.06 1.06c.37-.369.69-.77.96-1.193a26.61 26.61 0 013.095 2.348.75.75 0 00.992 0 26.547 26.547 0 015.93-3.95.75.75 0 00.42-.739 41.053 41.053 0 00-.39-3.114 29.925 29.925 0 00-5.199 2.801 2.25 2.25 0 01-2.514 0c-.41-.275-.826-.541-1.25-.797a6.985 6.985 0 01-1.084 3.45 26.503 26.503 0 00-1.281-.78A5.487 5.487 0 006 12v-.54z" clip-rule="evenodd" />
                                                </svg>
                                                
                                            </span>
                                            <select  id="classe_id" name="classe_id" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-gray-900 focus:border-gray-900 block flex-1 min-w-0 w-full text-xs border-gray-300 py-1.5 px-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{old('classe_id',$student->classe_id ?? '')}}" >
                                                @foreach ($specialities as $speciality)
                                                    @foreach($speciality->classes as $class)
                                                        <option value="{{$class->id}}" {{-- old('classe_id') == $student->class_students[0]->class_id ? 'selected' : '' --}}>{{$class->level}} {{$speciality->acronym}}</option>
                                                    @endforeach
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        <span class="text-red-600  text-xs mr-2">
                                            @error('classe_id')
                                                {{$message}}
                                            @enderror
                                        </span>                         
                                    </div>
                                    <div class=" w-1/3 ">
                                        <label for="school_year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Année scolaire</label>
                                        <div class="flex items-center w-full">
                                            <span class="inline-flex items-center px-2.5 py-2 text-xs text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3 h-3 text-gray-500 dark:text-gray-400 fill-gray-900 stroke-orange-400">
                                                    <path d="M5.25 12a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H6a.75.75 0 01-.75-.75V12zM6 13.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V14a.75.75 0 00-.75-.75H6zM7.25 12a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H8a.75.75 0 01-.75-.75V12zM8 13.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V14a.75.75 0 00-.75-.75H8zM9.25 10a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H10a.75.75 0 01-.75-.75V10zM10 11.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V12a.75.75 0 00-.75-.75H10zM9.25 14a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H10a.75.75 0 01-.75-.75V14zM12 9.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V10a.75.75 0 00-.75-.75H12zM11.25 12a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H12a.75.75 0 01-.75-.75V12zM12 13.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V14a.75.75 0 00-.75-.75H12zM13.25 10a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H14a.75.75 0 01-.75-.75V10zM14 11.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V12a.75.75 0 00-.75-.75H14z" />
                                                    <path fill-rule="evenodd" d="M5.75 2a.75.75 0 01.75.75V4h7V2.75a.75.75 0 011.5 0V4h.25A2.75 2.75 0 0118 6.75v8.5A2.75 2.75 0 0115.25 18H4.75A2.75 2.75 0 012 15.25v-8.5A2.75 2.75 0 014.75 4H5V2.75A.75.75 0 015.75 2zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75z" clip-rule="evenodd" />
                                                </svg>
                                                
                                            </span>
                                            <input type="number" id="school_year" name="school_year" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-gray-900 focus:border-gray-900 block flex-1 min-w-0 w-full text-xs border-gray-300 py-1.5 px-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Année scolaire" value="{{old('school_year',$student->class_students[0]->school_year ?? '')}} " required >
                                        </div>
                                        
                                        <span class="text-red-600  text-xs mr-2">
                                            @error('school_year')
                                                {{$message}}
                                            @enderror
                                        </span>                         
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="text-white bg-gray-900 hover:bg-gray-950 focus:ring-4 focus:outline-none focus:ring-gray-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-800 dark:hover:bg-gray-900 dark:focus:ring-gray-950">
                                @if (isset($student))
                                {{ __('Modifier l\'étudiant') }}
                                @else
                                    {{ __('Ajouter Un étudiant') }}
                                @endif
                            </button>
                        </div>
                        </form>
                    
                </div>
            </div>
        </div>
  
</x-app-layout>
