<x-app-layout>

    {{-- Header Page --}}
    <x-slot name="header">
        {{ __('Lokasi Lapangan') }}
    </x-slot>

    {{-- Content Area --}}
    <div class="pt-16 pb-20 bg-dark-bg min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-12">
                <h1 class="text-5xl font-extrabold text-white uppercase mb-4">
                    Temukan <span class="text-neon-green">Arena</span> Terbaik
                </h1>
                <p class="text-gray-400 text-lg">
                    Jelajahi lokasi lapangan mini soccer kami dan dapatkan petunjuk arah.
                </p>
            </div>

            {{-- 1. Large Map Placeholder (Futuristic Grid Style) --}}
            <div class="bg-dark-card rounded-xl border border-neon-green/30 shadow-2xl shadow-black/70 p-4 mb-12">
                <div class="relative h-[60vh] overflow-hidden rounded-lg">
                    {{-- Visual Map Placeholder (Futuristic Grid) --}}
                    <div class="absolute inset-0 bg-dark-bg flex items-center justify-center opacity-90" 
                         style="background-image: repeating-linear-gradient(0deg, #1C1C1C, #1C1C1C 1px, transparent 1px, transparent 10px), 
                                repeating-linear-gradient(90deg, #1C1C1C, #1C1C1C 1px, transparent 1px, transparent 10px);">
                        
                        <div class="text-center">
                            <svg class="w-16 h-16 text-neon-green mx-auto mb-3 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                {{-- Ikon: Location Target (Sporty) --}}
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="text-white text-xl font-bold uppercase tracking-widest">
                                MAP API INTEGRATION COMING SOON
                            </span>
                            <p class="text-gray-500 text-sm mt-2">Dapatkan akurasi lokasi terbaik di sini.</p>
                        </div>
                    </div>
                    
                    {{-- Floating CTA --}}
                    <a href="#" class="absolute bottom-4 right-4 py-3 px-6 bg-neon-green text-dark-bg rounded-full font-bold uppercase text-sm tracking-wider 
                                      hover:bg-neon-light transition duration-300 transform hover:scale-105 shadow-neon">
                        Lihat Semua Lapangan
                    </a>
                </div>
            </div>

            {{-- 2. Location List --}}
            <h2 class="text-3xl font-extrabold text-white uppercase tracking-wider mb-8 border-b border-neon-green/30 pb-3">
                Daftar Lapangan Utama
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                {{-- Location Card 1: Main Arena --}}
                <div class="bg-dark-card p-6 rounded-xl border border-neon-light/10 shadow-lg hover:shadow-neon transition duration-300">
                    <div class="flex items-center mb-4">
                         <svg class="w-8 h-8 text-neon-green mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.68 0 3.32-.267 4.87-0.78M3 12h18"></path>
                        </svg>
                        <h3 class="text-xl font-bold text-neon-light uppercase">F9 MINI SOCCER</h3>
                    </div>
                    <p class="text-gray-400 mb-4">Jl. Merdeka Timur, Keude Cunda, Kec. Muara Dua, Kota Lhokseumawe, Aceh 24355</p>
                    
                    <div class="flex justify-between items-center pt-4 border-t border-gray-700">
                        <span class="text-sm text-gray-500">Buka Setiap Hari: 08:00 - 23:00</span>
                        <a href="https://maps.app.goo.gl/Y1QLqmjREyTN7hxv6" target="_blank" 
                           class="text-neon-green font-semibold hover:text-white transition duration-200 flex items-center">
                            Arahkan ke Sini 
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>

                {{-- Location Card 2: Satellite Field --}}
                <div class="bg-dark-card p-6 rounded-xl border border-neon-light/10 shadow-lg hover:shadow-neon transition duration-300">
                    <div class="flex items-center mb-4">
                        <svg class="w-8 h-8 text-neon-green mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                        </svg>
                        <h3 class="text-xl font-bold text-neon-light uppercase">MINISOCCER SATELLITE BARAT</h3>
                    </div>
                    <p class="text-gray-400 mb-4">Komplek Stadion Satelit, Blok C-12, Tangerang Kota. (Kode Pos 15123)</p>
                    
                    <div class="flex justify-between items-center pt-4 border-t border-gray-700">
                        <span class="text-sm text-gray-500">Buka Setiap Hari: 09:00 - 22:00</span>
                        <a href="https://maps.app.goo.gl/pQkBrbXDC8C5ty7o7" target="_blank" 
                           class="text-neon-green font-semibold hover:text-white transition duration-200 flex items-center">
                            Arahkan ke Sini 
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>