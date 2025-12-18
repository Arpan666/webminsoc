<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile | F9 Minisoccer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'dark-bg': '#101010',
                        'dark-card': '#1C1C1C',
                        'accent-gold': '#FFC300',
                    }
                }
            }
        }
    </script>

    <style>
        body { font-family: 'Inter', sans-serif; }
        .shadow-gold-premium {
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5), 0 0 15px rgba(255, 195, 0, 0.05);
        }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #101010; }
        ::-webkit-scrollbar-thumb { background: #333; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #FFC300; }
    </style>
    @livewireStyles
</head>
<body class="bg-dark-bg min-h-screen text-gray-200 antialiased">

    {{-- Header / Navbar --}}
    <header class="fixed top-0 w-full z-50 bg-dark-bg/80 backdrop-blur-xl border-b border-white/5">
        <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <h2 class="font-black text-xl uppercase tracking-[0.3em] text-accent-gold">
                Profil <span class="text-white">User</span>
            </h2>

            <a href="{{ route('welcome') }}"
               class="group flex items-center gap-2 px-4 py-2 bg-white/5 text-gray-400 font-black text-[10px] uppercase tracking-widest rounded-xl border border-white/5 hover:border-accent-gold/50 hover:text-accent-gold transition-all duration-300">
                <svg class="h-4 w-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>
        </div>
    </header>

    {{-- 
        BAGIAN INI ADALAH PEMANGGILAN KOMPONEN 
        Seluruh form input ada di dalam file: 
        resources/views/livewire/profile-settings.blade.php
    --}}
    <main>
        @livewire('profile-settings')
    </main>

    @livewireScripts
</body>
</html>