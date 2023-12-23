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
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite('resources/css/app.css')
    </head>
    <body class="antialiased bg-light-bg dark:bg-dark-bg">

        <main class="">
            @yield('content')
        </main>

    </body>
</html>