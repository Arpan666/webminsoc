<x-app-layout>
    <x-slot name="header">
        <div class="pt-20"></div>
        <h2 class="font-black text-xl text-accent-gold uppercase tracking-[0.4em] text-center drop-shadow-lg">
            {{ __('Lokasi Lapangan') }}
        </h2>
    </x-slot>

    {{-- Main Container --}}
    <div class="min-h-screen bg-dark-bg py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
                
                {{-- Bagian Kiri: Peta dan Visual --}}
                <div class="space-y-8">
                    <div class="relative group">
                        {{-- Judul dengan Aksen Garis --}}
                        <div class="flex items-center space-x-4 mb-6">
                            <div class="h-8 w-1 bg-accent-gold rounded-full"></div>
                            <h2 class="text-3xl font-black text-white uppercase tracking-tighter">
                                Peta <span class="text-accent-gold">Lapangan</span>
                            </h2>
                        </div>

                        {{-- Peta Container --}}
                        <div class="relative w-full h-[450px] bg-dark-card rounded-3xl shadow-2xl overflow-hidden border border-white/10 group-hover:border-accent-gold/30 transition-all duration-500">
                            {{-- Overlay Efek Kaca pada Pinggiran Peta --}}
                            <div class="absolute inset-0 pointer-events-none border-[12px] border-dark-card/50 rounded-3xl z-10"></div>
                            
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.570220268504!2d97.1352934!3d5.1725893!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30477be7167a5f6b%3A0xe67140f0c057ec93!2sF9%20MINI%20SOCCER!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" 
                                width="100%" 
                                height="100%" 
                                style="border:0; filter: grayscale(0.5) contrast(1.1) invert(0.9) hue-rotate(170deg);" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade"
                                class="transition-all duration-700 group-hover:grayscale-0 group-hover:invert-0 group-hover:hue-rotate-0">
                            </iframe>
                        </div>
                    </div>

                    {{-- Card Info Singkat --}}
                    <div class="bg-dark-card/50 backdrop-blur-md p-6 rounded-2xl border border-white/5 shadow-xl">
                        <p class="text-gray-400 leading-relaxed italic text-sm">
                            "Lapangan kami menggunakan rumput sintetis standar internasional dengan pencahayaan LED yang maksimal untuk kenyamanan main di malam hari."
                        </p>
                    </div>
                </div>

                {{-- Bagian Kanan: Detail Akses dan Alamat --}}
                <div class="space-y-6">
                    <div class="flex items-center space-x-4 mb-6 lg:mt-2">
                        <div class="h-8 w-1 bg-accent-gold rounded-full"></div>
                        <h2 class="text-3xl font-black text-white uppercase tracking-tighter">
                            Detail <span class="text-accent-gold">Akses</span>
                        </h2>
                    </div>

                    {{-- Card Alamat Lengkap --}}
                    <div class="bg-dark-card group p-8 rounded-3xl shadow-2xl border border-white/10 hover:border-accent-gold/20 transition-all duration-300">
                        <div class="flex items-start">
                            <div class="p-3 bg-accent-gold/10 rounded-xl mr-5 group-hover:bg-accent-gold transition-colors duration-300">
                                <svg class="w-8 h-8 text-accent-gold group-hover:text-dark-bg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0l-4.243-4.243m11.314 0a10 10 0 01-14.142 0m14.142 0H18.5a2 2 0 002-2V7a2 2 0 00-2-2h-12a2 2 0 00-2 2v7a2 2 0 002 2h2.828"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-black text-white uppercase tracking-widest mb-2">Alamat Resmi</h3>
                                <p class="text-gray-400 leading-relaxed text-sm">
                                    F9 MiniSoccer Jl. Merdeka Timur, Keude Cunda, Kec. Muara Dua, Kota Lhokseumawe, Aceh 24355.
                                </p>
                                <a href="https://maps.app.goo.gl/zUVqeHWfyhBeAAms5" target="_blank" class="mt-6 inline-flex items-center px-6 py-3 bg-white/5 hover:bg-accent-gold text-white hover:text-dark-bg rounded-xl font-bold text-[10px] uppercase tracking-[0.2em] transition-all duration-300 border border-white/10">
                                    Buka Navigasi
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Card Petunjuk Arah --}}
                    <div class="bg-dark-card p-8 rounded-3xl shadow-2xl border border-white/10">
                        <div class="flex items-center mb-6">
                            <div class="p-2 bg-accent-gold/10 rounded-lg mr-4">
                                <svg class="w-6 h-6 text-accent-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                            </div>
                            <h3 class="text-xl font-black text-white uppercase tracking-widest">Petunjuk Arah</h3>
                        </div>
                        
                        <div class="space-y-6">
                            <div class="flex items-start">
                                <div class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center text-accent-gold font-bold text-xs mr-4 border border-white/10 shrink-0">01</div>
                                <p class="text-gray-400 text-sm"><span class="text-white font-bold uppercase">Mobil Pribadi:</span> Akses via Jl. Lintas Sumatera. Lokasi persis di belakang MR.DIY Cunda. Parkir luas dan aman.</p>
                            </div>
                            <div class="flex items-start">
                                <div class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center text-accent-gold font-bold text-xs mr-4 border border-white/10 shrink-0">02</div>
                                <p class="text-gray-400 text-sm"><span class="text-white font-bold uppercase">Transportasi Umum:</span> Turun di Harun Square. Jalan kaki sekitar 2 menit ke arah belakang komplek.</p>
                            </div>
                            <div class="flex items-start">
                                <div class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center text-accent-gold font-bold text-xs mr-4 border border-white/10 shrink-0">03</div>
                                <p class="text-gray-400 text-sm"><span class="text-white font-bold uppercase">Ojek Online:</span> Ketik <span class="text-accent-gold italic">"F9 MINI SOCCER"</span> pada tujuan. Patokan utama adalah Wisma Sartika.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>