<x-app-layout>
    <x-slot name="header" >
        <h2 class="font-semibold text-xl text-gray-800 leading-tig">
            {{ __('Les salle de classes') }}
        </h2>
    </x-slot>
    
<div class="relative overflow-x-auto shadow-md sm:rounded-lg p4">
    <div class="bg-gray-900 flex justify-between pr-9 items-center">
       
        <form class="p-4 bg-gray-900 dark:bg-gray-900 flex" action="{{ route('specialities') }}" method="GET">
             
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
    <div class=" flex justify-between p-9 ">
            <div class="w-20 h-20 bg-gray-200 border hover:bg-white rounded">
                <a href="{{route('class.level',['level'=>'B1'])}}" class="w-full h-full  text-black flex justify-center items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 stroke-gray-700 fill-orange-400 self-start">
                        <path d="M7 8a3 3 0 100-6 3 3 0 000 6zM14.5 9a2.5 2.5 0 100-5 2.5 2.5 0 000 5zM1.615 16.428a1.224 1.224 0 01-.569-1.175 6.002 6.002 0 0111.908 0c.058.467-.172.92-.57 1.174A9.953 9.953 0 017 18a9.953 9.953 0 01-5.385-1.572zM14.5 16h-.106c.07-.297.088-.611.048-.933a7.47 7.47 0 00-1.588-3.755 4.502 4.502 0 015.874 2.636.818.818 0 01-.36.98A7.465 7.465 0 0114.5 16z" />
                    </svg>
                    <span class="text-xl font-bold">B1</span>
                   <span class="text-xs self-end font-light">{{$b1}}</span>
                      
                </a>
            </div>
            <div class="w-20 h-20 bg-gray-200 border hover:bg-white rounded">
                <a href="{{route('class.level',['level'=>'B2'])}}" class="w-full h-full  text-black flex justify-center items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 stroke-gray-700 fill-orange-400 self-start">
                        <path d="M7 8a3 3 0 100-6 3 3 0 000 6zM14.5 9a2.5 2.5 0 100-5 2.5 2.5 0 000 5zM1.615 16.428a1.224 1.224 0 01-.569-1.175 6.002 6.002 0 0111.908 0c.058.467-.172.92-.57 1.174A9.953 9.953 0 017 18a9.953 9.953 0 01-5.385-1.572zM14.5 16h-.106c.07-.297.088-.611.048-.933a7.47 7.47 0 00-1.588-3.755 4.502 4.502 0 015.874 2.636.818.818 0 01-.36.98A7.465 7.465 0 0114.5 16z" />
                    </svg>
                    <span class="text-xl font-bold">B2</span>
                   <span class="text-xs self-end font-light">{{$b2}}</span>
                      
                </a>
            </div>
            <div class="w-20 h-20 bg-gray-200 border hover:bg-white rounded">
                <a href="{{route('class.level',['level'=>'B3'])}}" class="w-full h-full  text-black flex justify-center items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 stroke-gray-700 fill-orange-400 self-start">
                        <path d="M7 8a3 3 0 100-6 3 3 0 000 6zM14.5 9a2.5 2.5 0 100-5 2.5 2.5 0 000 5zM1.615 16.428a1.224 1.224 0 01-.569-1.175 6.002 6.002 0 0111.908 0c.058.467-.172.92-.57 1.174A9.953 9.953 0 017 18a9.953 9.953 0 01-5.385-1.572zM14.5 16h-.106c.07-.297.088-.611.048-.933a7.47 7.47 0 00-1.588-3.755 4.502 4.502 0 015.874 2.636.818.818 0 01-.36.98A7.465 7.465 0 0114.5 16z" />
                    </svg>
                    <span class="text-xl font-bold">B3</span>
                   <span class="text-xs self-end font-light">{{$b3}}</span>
                      
                </a>
            </div>
            <div class="w-20 h-20 bg-gray-200 border hover:bg-white rounded">
                <a href="{{route('class.level',['level'=>'M1'])}}" class="w-full h-full  text-black flex justify-center items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 stroke-gray-700 fill-orange-400 self-start">
                        <path d="M7 8a3 3 0 100-6 3 3 0 000 6zM14.5 9a2.5 2.5 0 100-5 2.5 2.5 0 000 5zM1.615 16.428a1.224 1.224 0 01-.569-1.175 6.002 6.002 0 0111.908 0c.058.467-.172.92-.57 1.174A9.953 9.953 0 017 18a9.953 9.953 0 01-5.385-1.572zM14.5 16h-.106c.07-.297.088-.611.048-.933a7.47 7.47 0 00-1.588-3.755 4.502 4.502 0 015.874 2.636.818.818 0 01-.36.98A7.465 7.465 0 0114.5 16z" />
                    </svg>
                    <span class="text-xl font-bold">M1</span>
                   <span class="text-xs self-end font-light">{{$m1}}</span>
                      
                </a>
            </div>
            <div class="w-20 h-20 bg-gray-200 border hover:bg-white rounded">
                <a href="{{route('class.level',['level'=>'M2'])}}" class="w-full h-full  text-black flex justify-center items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 stroke-gray-700 fill-orange-400 self-start">
                        <path d="M7 8a3 3 0 100-6 3 3 0 000 6zM14.5 9a2.5 2.5 0 100-5 2.5 2.5 0 000 5zM1.615 16.428a1.224 1.224 0 01-.569-1.175 6.002 6.002 0 0111.908 0c.058.467-.172.92-.57 1.174A9.953 9.953 0 017 18a9.953 9.953 0 01-5.385-1.572zM14.5 16h-.106c.07-.297.088-.611.048-.933a7.47 7.47 0 00-1.588-3.755 4.502 4.502 0 015.874 2.636.818.818 0 01-.36.98A7.465 7.465 0 0114.5 16z" />
                    </svg>
                    <span class="text-xl font-bold">M2</span>
                   <span class="text-xs self-end font-light">{{$m2}}</span>
                      
                </a>
            </div>
    </div>
            
</div>

        
</x-app-layout>
