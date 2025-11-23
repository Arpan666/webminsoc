<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} | MiniSoccer Booking</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-white bg-dark-bg">
        <div class="min-h-screen bg-dark-bg">
            
            @include('layouts.navigation') 

            @isset($header)
                <header class="bg-dark-card shadow-lg shadow-black/30 sticky top-16 z-10">
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                        <h2 class="font-bold text-2xl text-neon-green leading-tight">{{ $header }}</h2>
                    </div>
                </header>
            @endisset

            <main class="relative z-0">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>