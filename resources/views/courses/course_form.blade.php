<x-app-layout>
    <x-slot name="header" >
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ">
           
            @if (isset($course))
                {{ __('Modifier un cours') }}
            @else
                {{ __('Ajouter un cours') }}
            @endif
        </h2>
    </x-slot>

        <div class=" h-auto flex  items-center justify-center">
            <div class="h-auto rounded-lg  w-2/3 bg-white flex flex-col items-center ">
                <div class="text-white bg-gray-900 w-full h-7 flex ">
                    <div class="mx-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                        </svg>
                    </div>
                    <div class="">
                       {{__("Détails sur le cours")}}
                    </div>
                </div>
                
                <div class="w-full p-5">
                    @if (isset($course))

                    <form class="border p-2 w-full h-auto flex flex-col items-center" method="post" action="{{ route('course.edit', ['id' =>  $course->id]) }}" enctype="multipart/form-data">

                    @method('PUT')

                    @else

                    <form class="border p-2 w-full h-auto flex flex-col items-center" action="{{route('course.store')}}" method="POST" enctype="multipart/form-data">
                        
                    @endif
                    @csrf
                        <div class="mb-6 flex flex-wrap  h-full w-full justify-between">
                            <div class="   w-2/3">
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Désignation</label>
                                    <input type="text" id="name" name="name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-900 focus:border-gray-900 block w-64 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-900 dark:focus:border-gray-900 dark:shadow-sm-light" value="{{old('name',$course->name ?? '')}}" required>
                                
                                <span class="text-red-600  text-xs mr-2">
                                    @error('name')
                                        {{$message}}
                                    @enderror
                                </span>
                                
                            </div>
                            
                            <div class=" w-1/3">
                                <label for="credit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nbre de crédit</label>
                                <input type="number" id="credit" name="credit" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-900 focus:border-gray-900 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-900 dark:focus:border-gray-900 dark:shadow-sm-light" value="{{old('credit',$course->credit ?? '')}}" required>
                                <span class="text-red-600  text-xs mr-2">
                                    @error('credit')
                                        {{$message}}
                                    @enderror
                                </span>
                            </div>
                            <div class=" w-full">
                                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                <input type="text" id="description" name="description" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-900 focus:border-gray-900 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-900 dark:focus:border-gray-900 dark:shadow-sm-light" value="{{old('description',$course->description ?? '')}}" required>
                                <span class="text-red-600  text-xs mr-2">
                                    @error('description')
                                        {{$message}}
                                    @enderror
                                </span>
                            </div>
                            
                        </div>
                        <div>
                            <button type="submit" class="text-white bg-gray-900 hover:bg-gray-950 focus:ring-4 focus:outline-none focus:ring-gray-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-800 dark:hover:bg-gray-900 dark:focus:ring-gray-950">
                                @if (isset($course))
                                {{ __('Modifier le cours') }}
                                @else
                                    {{ __('Ajouter le cours') }}
                                @endif
                            </button>
                        </div>
                        </form>
                    
                </div>
            </div>
        </div>
  
</x-app-layout>
