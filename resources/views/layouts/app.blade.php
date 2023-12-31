<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" id="main" class="">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="theme-color" content="#f1f5f9">
        @include('layouts.partials.favicons')

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'NEApps') }}</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    </head>
    <body class="antialiased bg-light-bg-primary dark:bg-dark-bg-primary">
        <div class="flex flex-col h-screen">
            <!-- Page Heading -->
            {{-- <div class="w-full drop-shadow-md"> --}}
            <div class="w-full border-b-4 border-light-bg-primary dark:border-dark-bg-primary">
                @include('layouts.partials.navigation')

                <header class="h-20 bg-light-bg-secondary dark:bg-dark-bg-secondary ps-2">
                    <div class="flex h-full items-center max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        @yield('header')
                    </div>
                </header>
            </div>

            <main class="overflow-y-auto">
                @yield('content')
            </main>
        </div>

          <!-- Scripts -->
        <script src="{{ asset('js/nea.js') }}"></script>
    </body>
</html>