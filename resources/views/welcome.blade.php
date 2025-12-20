<x-app-layout>
    <div class="pt-16 bg-dark-bg text-white">

        {{-- Hero Section (Enhanced) --}}
        <section id="hero" 
            class="relative h-[85vh] flex items-center justify-center overflow-hidden bg-dark-bg bg-cover bg-center"
            style="background-image: url('https://images.unsplash.com/photo-1529900748604-07564a03e7a6?q=80&w=2070&auto=format&fit=crop');">
            
            <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/60 to-dark-bg z-10"></div> 

            <div class="relative z-20 text-center max-w-5xl px-4">
                <div class="inline-block px-4 py-1 border border-accent-gold/50 rounded-full mb-6 bg-accent-gold/10">
                    <p class="text-accent-gold text-xs md:text-sm font-bold uppercase tracking-[0.3em] animate-pulse">
                        #SOCCEREVOLUTION
                    </p>
                </div>

                <h1 class="text-5xl md:text-8xl font-extrabold uppercase leading-[1.1] mb-6 drop-shadow-2xl">
                    Cahaya Sorot <span class="text-accent-gold italic">nyala</span><br> 
                    <span class="text-white/90 text-4xl md:text-6xl">Kamu yang jadi pusat permainan</span>
                </h1>
                
                <p class="text-gray-400 text-lg md:text-xl mb-10 tracking-wide max-w-2xl mx-auto leading-relaxed italic">
                    "Pesan slot lapangan mini soccer terbaik di lokasi kami sekarang juga dalam hitungan detik.
                </p>
                
                <a href="#lapangan" class="group relative inline-block py-4 px-12 bg-accent-gold text-dark-bg rounded-full font-bold uppercase text-lg tracking-wider overflow-hidden transition duration-300 shadow-[0_0_20px_rgba(212,175,55,0.3)] hover:shadow-[0_0_30px_rgba(212,175,55,0.6)]">
                    <span class="relative z-10">Booking Sekarang!</span>
                    <div class="absolute top-0 -left-full w-full h-full bg-gradient-to-r from-transparent via-white/30 to-transparent transition-all duration-500 group-hover:left-full"></div>
                </a>
            </div>
            <div class="absolute bottom-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-accent-gold/50 to-transparent z-20"></div>
        </section>

        {{-- Section Lapangan Tersedia (Improved Cards) --}}
        <section id="lapangan" class="py-24 bg-dark-bg">
            <div class="container mx-auto px-4 max-w-7xl">
                <div class="flex flex-col items-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-extrabold text-white text-center uppercase tracking-wider mb-4">
                        Pilihan Lapangan <span class="text-accent-gold">Terbaik</span>
                    </h2>
                    <div class="h-1 w-24 bg-accent-gold rounded-full"></div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    @forelse ($fields as $field)
                        <div class="group bg-dark-card rounded-2xl border border-white/5 shadow-2xl overflow-hidden transition-all duration-500 hover:border-accent-gold/50 hover:-translate-y-3">
                            <a href="{{ url('lapangan/' . $field->id) }}" class="block">
                                <div class="relative h-64 w-full overflow-hidden">
                                    @if ($field->image_path)
                                        <img src="{{ asset('storage/' . $field->image_path) }}" 
                                            alt="{{ $field->name }}" 
                                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                    @else
                                        <div class="w-full h-full bg-gray-800 flex flex-col items-center justify-center text-gray-500">
                                            <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            <span class="text-xs uppercase tracking-widest">No Image Available</span>
                                        </div>
                                    @endif
                                    <div class="absolute inset-0 bg-gradient-to-t from-dark-card via-transparent to-transparent opacity-60"></div>
                                    <span class="absolute top-4 right-4 bg-accent-gold text-dark-bg text-[10px] font-black px-3 py-1 rounded-md tracking-tighter">
                                        POPULAR SLOTS
                                    </span>
                                </div>
                                
                                <div class="p-8">
                                    <h3 class="text-2xl font-bold text-white mb-3 group-hover:text-accent-gold transition-colors">{{ $field->name }}</h3>
                                    <p class="text-gray-400 text-sm leading-relaxed mb-6 line-clamp-2 italic">
                                        "{{ $field->description ?? 'Nikmati pengalaman bermain terbaik dengan rumput standar FIFA.' }}"
                                    </p>
                                    
                                    <div class="flex items-end justify-between border-t border-white/10 pt-6">
                                        <div>
                                            <p class="text-[10px] uppercase text-gray-500 tracking-widest mb-1">Mulai Dari</p>
                                            <p class="text-2xl font-black text-white">
                                                <span class="text-accent-gold text-sm">Rp</span> {{ number_format($field->min_price ?? 100000, 0, ',', '.') }}
                                            </p>
                                        </div>
                                        <div class="bg-accent-gold/10 p-2 rounded-lg group-hover:bg-accent-gold transition-all duration-300">
                                            <svg class="w-6 h-6 text-accent-gold group-hover:text-dark-bg" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-span-full py-20 text-center border-2 border-dashed border-white/10 rounded-3xl">
                            <p class="text-gray-500 italic">Jadwal lapangan belum tersedia untuk saat ini...</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        {{-- Section Keunggulan (Modern Glassmorphism) --}}
        <section id="keunggulan" class="py-24 bg-dark-card relative overflow-hidden">
            <div class="absolute top-0 left-0 w-64 h-64 bg-accent-gold/5 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
            <div class="container mx-auto px-4 max-w-7xl relative z-10">
                <h2 class="text-4xl font-extrabold text-white text-center mb-16 uppercase tracking-wider">
                    Eksklusivitas <span class="text-accent-gold">Layanan</span>
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @php
                        $features = [
                            ['title' => 'Booking Kilat', 'desc' => 'Sistem pemesanan cerdas tanpa perlu menunggu admin.', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                            ['title' => 'Keamanan Transaksi', 'desc' => 'Enkripsi pembayaran aman untuk kenyamanan Anda.', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                            ['title' => 'Update Real-time', 'desc' => 'Data slot sinkron otomatis 100% akurat.', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z']
                        ];
                    @endphp

                    @foreach($features as $f)
                        <div class="group p-10 bg-dark-bg/50 backdrop-blur-sm border border-white/5 rounded-3xl hover:border-accent-gold/30 transition duration-500">
                            <div class="w-16 h-16 bg-accent-gold/10 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500">
                                <svg class="w-8 h-8 text-accent-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $f['icon'] }}"></path></svg>
                            </div>
                            <h3 class="text-xl font-bold text-white mb-4 tracking-tight group-hover:text-accent-gold">{{ $f['title'] }}</h3>
                            <p class="text-gray-500 text-sm leading-relaxed">{{ $f['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        
        {{-- Footer (Premium Style) --}}
        <footer class="bg-dark-bg border-t border-white/5 pt-20 pb-10">
            <div class="container mx-auto px-4 max-w-7xl">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
                    
                    <div class="col-span-1">
                        <span class="text-3xl font-black text-accent-gold tracking-tighter uppercase">
                            F9<span class="text-white">MINI</span>SOCCER
                        </span>
                        <p class="text-gray-500 text-sm mt-6 leading-relaxed">
                            Penyedia lapangan mini soccer kualitas premium dengan sistem booking paling modern di Indonesia.
                        </p>
                    </div>
                    
                    <div>
                        <h4 class="text-white font-bold mb-6 uppercase tracking-widest text-xs">Navigasi</h4>
                        <ul class="space-y-4 text-gray-500 text-sm">
                            <li><a href="#lapangan" class="hover:text-accent-gold transition">Katalog Lapangan</a></li>
                            <li><a href="#keunggulan" class="hover:text-accent-gold transition">Layanan Unggulan</a></li>
                            <li><a href="#" class="hover:text-accent-gold transition">Cara Pesan</a></li>
                        </ul>
                    </div>
                    
                    <div>
                        <h4 class="text-white font-bold mb-6 uppercase tracking-widest text-xs">Bantuan</h4>
                        <ul class="space-y-4 text-gray-500 text-sm">
                            <li><a href="#" class="hover:text-accent-gold transition">Pusat Bantuan</a></li>
                            <li><a href="#" class="hover:text-accent-gold transition">Syarat & Ketentuan</a></li>
                            <li><a href="#" class="hover:text-accent-gold transition">Kebijakan Pembatalan</a></li>
                        </ul>
                    </div>
                    
                    <div>
                        <h4 class="text-white font-bold mb-6 uppercase tracking-widest text-xs">Stay Connected</h4>
                        <div class="flex space-x-4">
                            <a href="https://www.instagram.com/f9minisoccer/?hl=id" class="w-10 h-10 rounded-full border border-white/10 flex items-center justify-center hover:border-accent-gold hover:text-accent-gold transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="border-t border-white/5 pt-10 text-center">
                    <p class="text-gray-600 text-xs tracking-widest uppercase">&copy; {{ date('Y') }} F9 Minisoccer. Crafted for Winners.</p>
                </div>
            </div>
        </footer>
    </div>
</x-app-layout>