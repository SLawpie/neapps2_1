<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" id="main" class="">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="theme-color" content="#f1f5f9">
        @include('layouts.favicons')

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'NEApps') }}</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">


        <!-- Scripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-light-bg-primary dark:bg-dark-bg-primary">
        <div id="app" class="flex flex-col h-screen">
            <!-- Page Heading -->
            <div class="w-full">
                @include('layouts.navigation')
            </div>

            <main class="py-4">
                @yield('content')
            </main>
        </div>

        <!-- Scripts -->
        <script src="{{ asset('js/nea.js') }}"></script>
    </body>
</html>
