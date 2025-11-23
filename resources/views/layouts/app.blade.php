<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark-mode">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'MINISOCCER BOOKING') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-dark-bg text-white"> 
        <div class="min-h-screen"> 
            
            @include('layouts.navigation')

            @isset($header)
                {{-- Header standar diganti agar cocok dengan tema gelap --}}
                <header class="bg-dark-card shadow-lg shadow-black/30 border-b border-neon-green/30 pt-16">
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                        <h2 class="font-semibold text-xl text-neon-green leading-tight uppercase tracking-wider">
                             {{ $header }}
                        </h2>
                    </div>
                </header>
            @endisset

            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>