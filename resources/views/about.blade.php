<x-app-layout>

    {{-- Header Page --}}
    <x-slot name="header">
        {{ __('Tentang Kami') }}
    </x-slot>

    {{-- Content Area --}}
    <div class="pt-16 pb-20 bg-dark-bg min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-12">
                <h1 class="text-5xl font-extrabold text-white uppercase mb-4">
                    Filosofi <span class="text-neon-green">MINISOCCER</span>
                </h1>
                <p class="text-gray-400 text-lg">
                    Kami hadir untuk membawa kemudahan booking lapangan ke era digital.
                </p>
            </div>

            <div class="space-y-12">
                
                {{-- Visi & Misi Card --}}
                <div class="bg-dark-card p-8 rounded-xl border border-neon-green/10 shadow-2xl shadow-black/70">
                    <h2 class="text-3xl font-bold text-neon-light mb-6 border-b border-neon-green/30 pb-3 flex items-center">
                        <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            {{-- Ikon: Vision/Target --}}
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l-2 1m2-1h10l1 3m-1 0v8a1 1 0 01-1 1H8m6-4a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        Visi Kami
                    </h2>
                    <p class="text-gray-300 leading-relaxed text-lg">
                        Menjadi platform *booking* lapangan mini soccer terkemuka di Indonesia yang menyediakan kemudahan akses dan pengalaman pemesanan tercepat bagi setiap penggemar olahraga.
                    </p>
                    
                    <h3 class="text-xl font-semibold text-neon-green mt-6 mb-3">Misi Utama</h3>
                    <ul class="list-disc list-inside text-gray-400 space-y-2 ml-4">
                        <li>Memberikan sistem *booking* *real-time* dan tanpa *ribet*.</li>
                        <li>Mengembangkan jaringan lapangan berkualitas dengan standar terbaik.</li>
                        <li>Menciptakan komunitas olahraga yang aktif dan terhubung secara digital.</li>
                    </ul>
                </div>

                {{-- Tim Card --}}
                <div class="bg-dark-card p-8 rounded-xl border border-neon-green/10 shadow-2xl shadow-black/70">
                    <h2 class="text-3xl font-bold text-neon-light mb-6 border-b border-neon-green/30 pb-3 flex items-center">
                        <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            {{-- Ikon: Team/People --}}
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h-5v-1a4 4 0 00-4-4H4a4 4 0 00-4 4v1h5m3-6a4 4 0 100-8 4 4 0 000 8zm-8 2h8m-8-2v2m-2-2h-2m2-2a4 4 0 10-8 0 4 4 0 008 0z"></path>
                        </svg>
                        Tim di Balik Layar
                    </h2>
                    <p class="text-gray-300 leading-relaxed">
                        Kami adalah tim kecil yang terdiri dari penggemar teknologi dan olahraga. Kami percaya bahwa teknologi yang tepat dapat membuat pengalaman bermain mini soccer menjadi lebih baik dan *seamless*.
                    </p>
                    
                    <div class="mt-6 text-center">
                        <a href="{{ route('contact-us') ?? '#' }}" 
                           class="inline-block py-3 px-6 bg-neon-green text-dark-bg rounded-full font-bold uppercase text-md tracking-wider 
                                  hover:bg-neon-light transition duration-300 transform hover:scale-[1.03] shadow-neon">
                            Bergabung atau Hubungi Tim Kami
                        </a>
                    </div>
                </div>

            </div>
            
        </div>
    </div>
</x-app-layout>