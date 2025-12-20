<x-app-layout>
    {{-- Header Page --}}
    <x-slot name="header">
        {{-- Spacer pt-20 untuk mencegah konten tertabrak Navbar Fixed --}}
        <div class="pt-20">
            <h2 class="font-black text-xl text-accent-gold uppercase tracking-[0.4em] text-center drop-shadow-lg">
                {{ __('Tentang Kami') }}
            </h2>
        </div>
    </x-slot>

    {{-- Content Area --}}
    <div class="bg-dark-bg min-h-screen py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Judul Filosofi --}}
            <div class="text-center mb-16">
                <div class="inline-block px-4 py-1 rounded-full bg-accent-gold/10 border border-accent-gold/20 mb-4">
                    <span class="text-accent-gold text-[10px] font-bold uppercase tracking-[0.3em]">Our Story</span>
                </div>
                <h1 class="text-4xl md:text-6xl font-black text-white uppercase tracking-tighter mb-4">
                    Filosofi <span class="text-accent-gold">MINISOCCER</span>
                </h1>
                <div class="h-1.5 w-24 bg-accent-gold mx-auto rounded-full mb-6"></div>
                <p class="text-gray-400 text-lg max-w-2xl mx-auto leading-relaxed">
                    Ruang bermain modern untuk mereka yang serius menikmati kualitas permainan MiniSoccer dan persaudaraan.
                </p>
            </div>

            <div class="space-y-10">
                
                {{-- Visi & Misi Card --}}
                <div class="bg-dark-card group p-10 rounded-[2rem] border border-white/10 shadow-2xl transition-all duration-500 hover:border-accent-gold/30">
                    <div class="flex items-center space-x-4 mb-8">
                        <div class="p-3 bg-accent-gold/10 rounded-2xl group-hover:bg-accent-gold transition-colors duration-500">
                            <svg class="w-8 h-8 text-accent-gold group-hover:text-dark-bg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l-2 1m2-1h10l1 3m-1 0v8a1 1 0 01-1 1H8m6-4a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <h2 class="text-3xl font-black text-white uppercase tracking-tighter">Visi <span class="text-accent-gold">Kami</span></h2>
                    </div>
                    
                    <p class="text-gray-300 leading-relaxed text-lg mb-8 italic border-l-4 border-accent-gold/30 pl-6">
                        "Menghadirkan pengalaman bermain terbaik dengan standar internasional—bukan sekadar lapangan, tapi rumah bagi para atlet."
                    </p>
                    
                    <div class="space-y-6">
                        <h3 class="text-xs font-black text-accent-gold uppercase tracking-[0.4em] mb-4">Misi Utama Kami</h3>
                        <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                            <div class="flex items-start p-4 bg-white/5 rounded-2xl border border-white/5 hover:bg-white/10 transition-all">
                                <div class="w-6 h-6 rounded-full bg-accent-gold/20 flex items-center justify-center text-accent-gold text-xs font-bold mr-4 shrink-0">1</div>
                                <p class="text-gray-400 text-sm">Menyediakan rumput sintetis kelas premium dengan perawatan harian yang konsisten.</p>
                            </div>
                            <div class="flex items-start p-4 bg-white/5 rounded-2xl border border-white/5 hover:bg-white/10 transition-all">
                                <div class="w-6 h-6 rounded-full bg-accent-gold/20 flex items-center justify-center text-accent-gold text-xs font-bold mr-4 shrink-0">2</div>
                                <p class="text-gray-400 text-sm">Sistem booking real-time yang transparan, tanpa drama, dan tanpa ribet.</p>
                            </div>
                            <div class="flex items-start p-4 bg-white/5 rounded-2xl border border-white/5 hover:bg-white/10 transition-all">
                                <div class="w-6 h-6 rounded-full bg-accent-gold/20 flex items-center justify-center text-accent-gold text-xs font-bold mr-4 shrink-0">3</div>
                                <p class="text-gray-400 text-sm">Membangun komunitas sepakbola yang inklusif, aman, dan kompetitif.</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tim Card --}}
                <div class="bg-dark-card p-10 rounded-[2rem] border border-white/10 shadow-2xl relative overflow-hidden">
                    {{-- Efek cahaya latar (Glow) --}}
                    <div class="absolute -right-20 -top-20 w-64 h-64 bg-accent-gold/5 rounded-full blur-[100px]"></div>
                    
                    <div class="relative z-10 text-center">
                        <h2 class="text-3xl font-black text-white uppercase tracking-tighter mb-6">Tim di Balik <span class="text-accent-gold">Layar</span></h2>
                        <p class="text-gray-400 leading-relaxed max-w-2xl mx-auto mb-10">
                            Kami adalah pecinta olahraga yang percaya bahwa kualitas fasilitas menentukan kualitas permainan. Setiap detail, mulai dari lampu stadium hingga aliran udara, kami pantau demi kenyamanan Anda.
                        </p>
                        
                        <div class="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                            <a href="{{ route('contact.index') ?? '#' }}" 
                               class="w-full sm:w-auto px-8 py-4 bg-accent-gold text-dark-bg rounded-2xl font-black uppercase text-[11px] tracking-[0.2em] hover:scale-105 hover:shadow-[0_10px_30px_rgba(212,175,55,0.3)] transition-all duration-300">
                                Hubungi Tim Kami
                            </a>
                            <div class="flex -space-x-3">
                                <div class="w-10 h-10 rounded-full border-2 border-dark-card bg-gray-700"></div>
                                <div class="w-10 h-10 rounded-full border-2 border-dark-card bg-gray-600"></div>
                                <div class="w-10 h-10 rounded-full border-2 border-dark-card bg-gray-500"></div>
                                <div class="w-10 h-10 rounded-full border-2 border-dark-card bg-accent-gold flex items-center justify-center text-[10px] font-bold text-dark-bg">+12</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>