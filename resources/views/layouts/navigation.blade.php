<nav x-data="{ open: false }" class="bg-gray-900 fixed w-full top-0 left-0 mb-4   border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class=" block h-9 w-auto fill-orange-500 text-gray-800" />
                    </a>
                </div>
                @php
                    use App\Models\Role;
                    use App\Models\Role_User;
                    $user=auth()->user();
                    $userRole=Role_User::where('user_id','=',$user->id)->first();
                    $role=Role::find($userRole->role_id);
                    // dd($role->role);

                @endphp
                <!-- admin Navigation Links -->
                @if ($role->role === 'admin')
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    </div>

                
                <!-- student Navigation Links -->
                @elseif($role->role === 'étudiant')
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    
                        <x-nav-link :href="route('class_courses')" :active="request()->routeIs('class_courses')">
                            {{ __(' Cours de ma classe') }}
                        </x-nav-link>
                        <x-nav-link :href="route('course_students')" :active="request()->routeIs('course_students')">
                            {{ __(' Mes cours') }}
                        </x-nav-link>
                        <x-nav-link :href="route('student.card')" :active="request()->routeIs('student.card')">
                            {{ __('Bulletins') }}
                        </x-nav-link>
                        <x-nav-link :href="route('student.notes',['semester'=>1])" :active="request()->routeIs('student.notes')">
                            {{ __('Relévés de notes') }}
                        </x-nav-link>
                    </div>
                <!-- teacher Navigation Links -->
                @elseif($role->role === 'enseignant')
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('teacher_courses')" :active="request()->routeIs('teacher_courses')">
                        {{ __('Cours') }}
                    </x-nav-link>
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Classes') }}
                    </x-nav-link>
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Etudiants') }}
                    </x-nav-link>
                </div>

                <!-- parents Navigation Links -->
                @elseif($role->role === 'parent')
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('children')" :active="request()->routeIs('children')">
                            {{ __('Enfant') }}
                        </x-nav-link>
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Relevés de notes') }}
                        </x-nav-link>
                    </div>
                @endif
                
            </div>

            <!-- Settings Dropdown -->
            
            <div class="hidden sm:flex sm:items-center sm:ml-6">
            @if($role->role === 'admin')

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center mr-2 px-1 py-1 bg-orange-500  border border-transparent text-sm leading-4 font-medium rounded-full  text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div class=" ">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                  </svg>
                                  
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content"  >
                        <ul class="py-2 text-sm   text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconButton">
                            <li>
                              <a href="{{route('speciality.create')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Specialities</a>
                            </li>
                            <li>
                              <a href="{{route('class.create')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Classes</a>
                            </li>
                            <li>
                              <div  id="users-dropdown-menu" class="block px-4 py-2  dark:hover:text-white">
                                <span>Utilisateurs<span>
                                <ul id="users-dropdown" class="hidden py-2 text-sm  text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconButton">
                                    <li>
                                    <a href="{{route('student.create')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Etudiants</a>
                                    </li>
                                    <li>
                                    <a href="{{route('teacher.create')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Enseignants</a>
                                    </li>
                                
                                    <li>
                                    </li>
                                </ul>
                            </div>
                            </li>
                            <li>
                            </li>
                          </ul>
                          <div class="py-2">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Separated link</a>
                          </div>

                    </x-slot>
                </x-dropdown>
            @endif

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
{{-- @if ($role->role === 'admin') --}}
    @include('layouts.side-bar')
{{-- @endif --}}
<script>
    // Sélectionnez l'élément par son ID
    const Mainelement = document.getElementById('users-dropdown-menu');
    const element = document.getElementById('users-dropdown');

    // Ajoutez un écouteur d'événement pour le survol (mouseenter)
    Mainelement.addEventListener('mouseenter', function() {
        element.classList.add('hovered');
        element.classList.remove('hidden');
    });

    // (Optionnel) Ajoutez un écouteur d'événement pour le survol terminé (mouseleave)
    // et retirez la classe si vous le souhaitez.
    Mainelement.addEventListener('mouseleave', function() {
        element.classList.remove('hovered');
        element.classList.add('hidden');
    });

</script>