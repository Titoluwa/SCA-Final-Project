<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-white dark:bg-green-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-lg text-green-700 dark:text-green-300">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-lg text-green-700 dark:text-green-300">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-lg text-green-700 dark:text-green-300">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <h1 class="font-semibold sm:text-5xl md:text-7xl lg:text-9xl dark:text-300 text-green-600 leading-tight font-serif">
                    {{ config('app.name') }}
                </h1>
            </div>
        </div>
    </body>
</html>
