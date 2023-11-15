<x-app-layout>
    <x-slot name="header" >
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ">
           
            @if (isset($class))
                {{ __('Modifier une classe') }}
            @else
                {{ __('Ajouter une classe') }}
            @endif
        </h2>
    </x-slot>

        <div class=" h-96 flex  items-center justify-center">
            <div class=" rounded-lg h-80 w-2/3 bg-white flex flex-col items-center ">
                <div class="text-white bg-gray-900 w-full h-7 flex ">
                    <div class="mx-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                          </svg>
                          
                    </div>
                    <div class="">
                       {{__("Détails sur la classe")}}
                    </div>
                </div>
                
                <div class="w-full p-5">
                    @if (isset($class))

                    <form class="border p-2 w-full h-[37em] flex flex-col items-center" method="post" action="{{ route('class.edit', ['id' =>  $class->id]) }}" enctype="multipart/form-data">

                    @method('PUT')

                    @else

                    <form class="border p-2 w-full h-[16.7em] flex flex-col items-center" action="{{route('class.store')}}" method="POST" enctype="multipart/form-data">
                        
                    @endif
                    @csrf
                        <div class="mb-6 flex flex-wrap  h-full w-full justify-between">
                            <div class="   w-1/2"> 
                                <label for="level" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Niveau</label>
                                <select id="level" name="level" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-900 focus:border-gray-900 block w-36 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-900 dark:focus:border-gray-900 dark:shadow-sm-light" value="{{old('level',$class->level ?? '')}}" required>
                                    <option >Niveau</option>
                                        <option value="B1">B1</option>  
                                        <option value="B2">B2</option>  
                                        <option value="B3">B3</option>  
                                        <option value="M1">M1</option>  
                                        <option value="M2">M2</option>  
                                </select>
                                <span class="text-red-600  text-xs mr-2">
                                    @error('level')
                                        {{$message}}
                                    @enderror
                                </span>
                                
                            </div>
                            <div class="   w-1/2"> 
                                <label for="speciality_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Spécialité</label>
                                <select id="speciality_id" name="speciality_id" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-900 focus:border-gray-900 block w-36 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-900 dark:focus:border-gray-900 dark:shadow-sm-light" value="{{old('speciality_id',$class->speciality_id ?? '')}}" required>
                                    <option >Spécialité</option>
                                    @foreach ($specialities as $speciality)
                                        <option value="{{$speciality->id}}">{{$speciality->acronym}}</option>  
                                    @endforeach
                                </select>
                                <span class="text-red-600  text-xs mr-2">
                                    @error('speciality_id')
                                        {{$message}}
                                    @enderror
                                </span>
                                
                            </div>
                            <div class=" w-full">
                                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                <input type="text" id="description" name="description" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-900 focus:border-gray-900 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-900 dark:focus:border-gray-900 dark:shadow-sm-light" value="{{old('description',$class->description ?? '')}}" >
                                <span class="text-red-600  text-xs mr-2">
                                    @error('description')
                                        {{$message}}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="text-white bg-gray-900 hover:bg-gray-950 focus:ring-4 focus:outline-none focus:ring-gray-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-800 dark:hover:bg-gray-900 dark:focus:ring-gray-950">
                                @if (isset($class))
                                {{ __('Modifier la classe') }}
                                @else
                                    {{ __('Ajouter la classe') }}
                                @endif
                            </button>
                        </div>
                        </form>
                    
                </div>
            </div>
        </div>
  
</x-app-layout>
