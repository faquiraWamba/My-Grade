<x-app-layout>
    <x-slot name="header" >
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('La spécialité '.$speciality->acronym) }}
        </h2>
    </x-slot>

    <div class="py-12 ">
        
<div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <div class="sm:hidden">
        <label for="tabs" class="sr-only">Selectionner une option</label>
        <select id="tabs" class="bg-gray-50 border-0 border-b border-gray-200 text-gray-900 text-sm rounded-t-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option>Détails</option>
            <option>Classes</option>
        </select>
    </div>
    <ul class="hidden text-sm font-medium text-center text-gray-500 divide-x divide-gray-200 rounded-lg sm:flex dark:divide-gray-600 dark:text-gray-400" id="fullWidthTab" data-tabs-toggle="#fullWidthTabContent" role="tablist">
        <li class="w-full">
            <button id="stats-tab" data-tabs-target="#stats" type="button" role="tab" aria-controls="stats" aria-selected="true" class="inline-block w-full p-4 rounded-tl-lg bg-gray-50 hover:bg-gray-100 focus:outline-none dark:bg-gray-700 dark:hover:bg-gray-600">Détails</button>
        </li>
        <li class="w-full">
            <button id="about-tab" data-tabs-target="#about" type="button" role="tab" aria-controls="about" aria-selected="false" class="inline-block w-full p-4 bg-gray-50 hover:bg-gray-100 focus:outline-none dark:bg-gray-700 dark:hover:bg-gray-600">Classe</button>
        </li>
        
    </ul>
    <div id="fullWidthTabContent" class="border-t border-gray-200 dark:border-gray-600">
        <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="stats" role="tabpanel" aria-labelledby="stats-tab">
            <dl class=" max-w-screen-xl  gap-8 p-4 mx-auto text-gray-900 sm:grid-cols-3 xl:grid-cols-6 dark:text-white sm:p-8">
                <div class="flex  items-center justify-between">
                    <dd class="text-gray-500 dark:text-gray-400">Sigle:</dd>
                    <dt class="mb-2 text-3xl font-extrabold">{{$speciality->acronym}}</dt>
                </div>
                <div class="flex  items-center justify-between">
                    <dd class="text-gray-500 dark:text-gray-400">Description:</dd>
                    <dt class="mb-2 text-3xl font-extrabold">{{$speciality->description}}</dt>
                </div>
                <div class="flex  items-center justify-between">
                    <dd class="text-gray-500 dark:text-gray-400">Nbe de classes:</dd>
                    <dt class="mb-2 text-3xl font-extrabold">{{$speciality->description}}</dt>
                </div>
                <div class="flex  items-center justify-between">
                    <dd class="text-gray-500 dark:text-gray-400">créé le:</dd>
                    <dt class="mb-2 text-3xl font-extrabold">{{$speciality->created_at->format('Y-m-d')}}</dt>
                </div>
            </dl>
            <a href="{{route('speciality.edit', ['id' => $speciality->id])}}" class="text-white bg-gray-900 hover:bg-gray-950 focus:ring-4 focus:outline-none focus:ring-gray-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-800 dark:hover:bg-gray-900 dark:focus:ring-gray-950">Editer</a>

        </div>
        <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="about" role="tabpanel" aria-labelledby="about-tab">
            <h2 class="mb-5 text-2xl font-extrabold tracking-tight text-gray-900 dark:text-white">We invest in the world’s potential</h2>
            <!-- List -->
            <ul role="list" class="space-y-4 text-gray-500 dark:text-gray-400">
                <li class="flex space-x-2 items-center">
                    <svg class="flex-shrink-0 w-3.5 h-3.5 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                    </svg>
                    <span class="leading-tight">Dynamic reports and dashboards</span>
                </li>
                <li class="flex space-x-2 items-center">
                    <svg class="flex-shrink-0 w-3.5 h-3.5 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                    </svg>
                    <span class="leading-tight">Templates for everyone</span>
                </li>
                <li class="flex space-x-2 items-center">
                    <svg class="flex-shrink-0 w-3.5 h-3.5 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                    </svg>
                    <span class="leading-tight">Development workflow</span>
                </li>
                <li class="flex space-x-2 items-center">
                    <svg class="flex-shrink-0 w-3.5 h-3.5 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                    </svg>
                    <span class="leading-tight">Limitless business automation</span>
                </li>
            </ul>
        </div>
       
    </div>
</div>
    </div>
</x-app-layout>
