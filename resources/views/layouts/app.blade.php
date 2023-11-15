@php
    use App\Models\Role;
    use App\Models\Role_User;
    $user=auth()->user();
    $userRole=Role_User::where('user_id','=',$user->id)->first();
    $role=Role::find($userRole->role_id);
    // dd($role->role);

@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="/dist/output.css" rel="stylesheet">
        
        <!-- Scripts -->
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

             <!-- Page Heading -->
                @if (isset($header))
                    <header class="bg-white shadow mt-16 ml-48 z-100">
                        <div class="max-w-7xl  mx-auto py-4 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <!-- Page Content -->
                    <main class="ml-48 p-4"  >
                        {{ $slot }}
                    </main>
               
        </div>
        <script src="../../../node_modules/flowbite/dist/flowbite.min.js"></script>
        <script src="../../../node_modules/flowbite/dist/datepicker.js"></script>

    </body>

</html>
