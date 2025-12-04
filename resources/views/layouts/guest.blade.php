<!DOCTYPE html>
{{-- Menggunakan class="dark-mode" --}}
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark-mode">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'MINISOCCER BOOKING') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    
    {{-- Background body diubah menjadi dark-bg, dan teks default menjadi white --}}
    <body class="font-sans antialiased bg-dark-bg text-white">
        
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-dark-bg">
            <div>
                <a href="/">
                    {{-- Logo yang menonjol menggunakan accent-gold --}}
                    <x-application-logo class="w-24 h-24 fill-current text-accent-gold hover:text-white transition duration-300" />
                </a>
            </div>

            {{-- Card kontainer yang menggunakan warna gelap dan shadow yang kuat --}}
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-dark-card shadow-2xl shadow-black/50 overflow-hidden sm:rounded-xl">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>