<x-app-layout>
    <x-slot name="header" >
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ">
           
            @if (isset($speciality))
                {{ __('Modifier une spécialité') }}
            @else
                {{ __('Ajouter une spécialité') }}
            @endif
        </h2>
    </x-slot>

        <div class=" h-80 flex  items-center justify-center">
            <div class=" rounded-lg h-60 w-2/3 bg-white flex flex-col items-center ">
                <div class="text-white bg-gray-900 w-full h-7 flex ">
                    <div class="mx-1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd" d="M10 2c-1.716 0-3.408.106-5.07.31C3.806 2.45 3 3.414 3 4.517V17.25a.75.75 0 001.075.676L10 15.082l5.925 2.844A.75.75 0 0017 17.25V4.517c0-1.103-.806-2.068-1.93-2.207A41.403 41.403 0 0010 2z" clip-rule="evenodd" />
                          </svg>
                          
                    </div>
                    <div class="">
                       {{__("Détails sur la spécialité")}}
                    </div>
                </div>
                
                <div class="w-full p-5">
                    @if (isset($speciality))

                    <form class="border p-2 w-full h-44 flex flex-col items-center" method="post" action="{{ route('speciality.edit', ['id' =>  $speciality->id]) }}" enctype="multipart/form-data">

                    @method('PUT')

                    @else

                    <form class="border p-2 w-full h-44 flex flex-col items-center" action="{{route('speciality.store')}}" method="POST" enctype="multipart/form-data">
                        
                    @endif
                    @csrf
                        <div class="mb-6 flex   h-full w-full justify-between">
                            <div class="   w-1/2">
                                    <label for="acronym" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Abbréviation</label>
                                    <input type="text" id="acronym" name="acronym" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-900 focus:border-gray-900 block w-36 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-900 dark:focus:border-gray-900 dark:shadow-sm-light" value="{{old('acronym',$speciality->acronym ?? '')}}" required>
                                
                                <span class="text-red-600  text-xs mr-2">
                                    @error('acronym')
                                        {{$message}}
                                    @enderror
                                </span>
                                
                            </div>
                            <div class=" w-1/2">
                                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                <input type="text" id="description" name="description" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-900 focus:border-gray-900 block w-72 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-900 dark:focus:border-gray-900 dark:shadow-sm-light" value="{{old('description',$speciality->description ?? '')}}" required>
                                <span class="text-red-600  text-xs mr-2">
                                    @error('description')
                                        {{$message}}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="text-white bg-gray-900 hover:bg-gray-950 focus:ring-4 focus:outline-none focus:ring-gray-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-800 dark:hover:bg-gray-900 dark:focus:ring-gray-950">
                                @if (isset($speciality))
                                {{ __('Modifier la spécalité') }}
                                @else
                                    {{ __('Ajouter la spécalité') }}
                                @endif
                            </button>
                        </div>
                        </form>
                    
                </div>
            </div>
        </div>
  
</x-app-layout>
