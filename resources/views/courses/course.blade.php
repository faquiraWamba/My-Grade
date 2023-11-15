<x-app-layout>
    <x-slot name="header" >
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Détails cours {{ __($course->code) }}
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center">
        
        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="p-5">
                <a href="#">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                       
                            {{$course->name}}
                    </h5>
                </a>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 flex justify-between">
                    <span>Crée le: </span>
                    <span>{{$course->created_at->format('Y-d-m')}}</span>
                </p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 flex justify-between">
                    <span>Total étudiants anées en cours: </span>
                    <span>{{'nb étudiants'}}</span>
                </p>
                <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Autres années scolaires
                     <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>


