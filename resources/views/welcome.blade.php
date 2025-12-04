<x-app-layout>
    {{-- Pastikan ini memanggil komponen navigasi yang sudah dimodifikasi --}}

    <div class="pt-16">

        {{-- Hero Section (Tetap sama, menggunakan warna Gold untuk highlight) --}}
        <section id="hero" 
            class="relative h-[85vh] flex items-center justify-center overflow-hidden bg-dark-bg bg-cover bg-center"
            style="background-image: url('{{ asset('images/sporty-minisoccer-bg.jpg') }}');">
            
            <div class="absolute inset-0 bg-black/80 z-10"></div> 

            <div class="relative z-20 text-center max-w-4xl px-4">
                {{-- Teks dan Warna Gold --}}
                <p class="text-accent-gold text-lg font-bold uppercase tracking-widest mb-4 animate-pulse">
                    #SPORTINSTRESSOUT
                </p>
                <h1 class="text-5xl md:text-7xl font-extrabold uppercase leading-tight text-white mb-6">
                    Cahaya Sorot <span class="text-accent-gold">nyala</span>, masalah padam, kamu yang jadi pusat permainan.
                </h1>
                <p class="text-gray-300 text-xl mb-10 tracking-wide">
                    Pesan slot lapangan mini soccer terbaik di lokasi kami sekarang juga dalam hitungan detik.
                </p>
                
                {{-- Tombol Gold --}}
                <a href="#lapangan" class="inline-block py-4 px-10 bg-accent-gold text-dark-bg rounded-full font-bold uppercase text-lg tracking-wider 
                                            transition duration-300 transform hover:scale-105 shadow-lg shadow-accent-gold/50 hover:shadow-xl">
                    Booking Sekarang!
                </a>
            </div>
        </section>

        {{-- Section Lapangan Tersedia (Rombakan Gold Mode) --}}
        <section id="lapangan" class="py-20 bg-dark-bg">
            <div class="container mx-auto px-4 max-w-7xl">
                <h2 class="text-4xl font-extrabold text-white text-center mb-12 uppercase tracking-wider">
                    Pilihan Lapangan <span class="text-accent-gold">Terbaik</span>
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    
                    @forelse ($fields as $field)
                        <a href="{{ url('lapangan/' . $field->id) }}" class="block">
                            {{-- Card Dark/Gold --}}
                            <div class="bg-dark-card rounded-xl border border-accent-gold/10 shadow-2xl shadow-black/70 
                                         hover:shadow-accent-gold/40 transition duration-300 overflow-hidden transform hover:-translate-y-1 hover:border-accent-gold/50">
                                
                                <div class="relative h-60 w-full">
                                    @if ($field->image_path)
                                        <img src="{{ asset('storage/' . $field->image_path) }}" 
                                            alt="Gambar Lapangan {{ $field->name }}" 
                                            class="w-full h-full object-cover transition duration-500 hover:opacity-80">
                                    @else
                                        <div class="w-full h-full bg-gray-800 flex items-center justify-center">
                                            <span class="text-gray-500 font-light">Image Not Found</span>
                                        </div>
                                    @endif
                                    
                                    {{-- Badge Gold --}}
                                    <span class="absolute top-4 right-4 bg-accent-gold text-dark-bg text-xs font-bold px-4 py-1 rounded-full shadow-lg">
                                        BOOK NOW
                                    </span>
                                </div>
                                
                                <div class="p-6">
                                    <h2 class="text-2xl font-extrabold text-white mb-2 uppercase">{{ $field->name }}</h2>
                                    
                                    <p class="text-gray-400 text-sm mb-4 line-clamp-2">
                                        {{ $field->description ?? 'Lapangan berkualitas tinggi dengan fasilitas lengkap.' }}
                                    </p>
                                    
                                    <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-700">
                                        <span class="text-sm font-semibold text-accent-gold uppercase tracking-wider">Mulai Dari</span>
                                        <span class="text-2xl font-extrabold text-white">
                                            Rp {{ number_format($field->min_price ?? 100000, 0, ',', '.') }}<span class="text-base text-gray-400 font-normal">/jam</span>
                                        </span>
                                    </div>
                                    
                                    {{-- Tombol Gold Outline --}}
                                    <button class="mt-6 w-full py-3 border border-accent-gold text-accent-gold rounded-full font-bold uppercase 
                                                     hover:bg-accent-gold hover:text-dark-bg transition duration-300 tracking-wider">
                                        Lihat Slot & Detail
                                    </button>
                                </div>
                            </div>
                        </a>
                    @empty
                        <p class="text-gray-400 text-center col-span-full py-10">
                            😔 Belum ada data lapangan yang tersedia saat ini. Silakan cek kembali nanti.
                        </p>
                    @endforelse
                </div>
            </div>
        </section>

        {{-- Section Keunggulan (Gold Mode) --}}
        <section id="keunggulan" class="py-20 bg-dark-card border-t border-b border-accent-gold/20">
            <div class="container mx-auto px-4 max-w-7xl">
                <h2 class="text-4xl font-extrabold text-white text-center mb-16 uppercase tracking-wider">
                    Kenapa Booking di <span class="text-accent-gold">Sini?</span>
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                    
                    <div class="p-8 bg-dark-bg rounded-xl shadow-xl hover:shadow-accent-gold/40 transition duration-300 transform hover:-translate-y-2">
                        {{-- Icon Gold --}}
                        <svg class="w-12 h-12 text-accent-gold mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <h3 class="text-xl font-bold text-white mb-2">Booking Kilat</h3>
                        <p class="text-gray-400">Pesan slot lapangan hanya dalam 3 langkah cepat. Tidak ada penantian lama.</p>
                    </div>

                    <div class="p-8 bg-dark-bg rounded-xl shadow-xl hover:shadow-accent-gold/40 transition duration-300 transform hover:-translate-y-2">
                        {{-- Icon Gold --}}
                        <svg class="w-12 h-12 text-accent-gold mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        <h3 class="text-xl font-bold text-white mb-2">Pembayaran Aman</h3>
                        <p class="text-gray-400">Didukung sistem pembayaran terverifikasi, transaksi Anda 100% aman.</p>
                    </div>

                    <div class="p-8 bg-dark-bg rounded-xl shadow-xl hover:shadow-accent-gold/40 transition duration-300 transform hover:-translate-y-2">
                        {{-- Icon Gold --}}
                        <svg class="w-12 h-12 text-accent-gold mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M17 17h.01"></path></svg>
                        <h3 class="text-xl font-bold text-white mb-2">Slot Real-time</h3>
                        <p class="text-gray-400">Jadwal lapangan selalu terupdate secara instan. Tidak ada lagi *double booking*.</p>
                    </div>

                </div>
            </div>
        </section>
        
        {{-- Footer (Gold Mode) --}}
        <footer class="bg-dark-card border-t border-accent-gold/30 py-10">
            <div class="container mx-auto px-4 max-w-7xl">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    
                    <div class="col-span-2 md:col-span-1">
                        <span class="text-3xl font-extrabold text-accent-gold tracking-widest uppercase">
                            MINI<span class="text-white">SOCCER</span>
                        </span>
                        <p class="text-gray-500 text-sm mt-3">Play with passion, book with ease.</p>
                        <p class="text-gray-600 text-xs mt-6">&copy; {{ date('Y') }} Booking Minisoccer. All rights reserved.</p>
                    </div>
                    
                    <div>
                        <h4 class="text-lg font-bold text-white mb-4 border-b border-accent-gold/50 pb-1">Navigasi</h4>
                        <ul class="space-y-2 text-gray-400 text-sm">
                            <li><a href="#lapangan" class="hover:text-accent-gold transition duration-200">Lapangan</a></li>
                            <li><a href="#keunggulan" class="hover:text-accent-gold transition duration-200">Keunggulan</a></li>
                            <li><a href="{{ route('login') ?? '#' }}" class="hover:text-accent-gold transition duration-200">Login</a></li>
                        </ul>
                    </div>
                    
                    <div>
                        <h4 class="text-lg font-bold text-white mb-4 border-b border-accent-gold/50 pb-1">Bantuan</h4>
                        <ul class="space-y-2 text-gray-400 text-sm">
                            <li><a href="#" class="hover:text-accent-gold transition duration-200">FAQ</a></li>
                            <li><a href="#" class="hover:text-accent-gold transition duration-200">Kebijakan Privasi</a></li>
                            <li><a href="{{ route('contact-us') ?? '#' }}" class="hover:text-accent-gold transition duration-200">Kontak Kami</a></li>
                        </ul>
                    </div>
                    
                    <div>
                        <h4 class="text-lg font-bold text-white mb-4 border-b border-accent-gold/50 pb-1">Hubungi Kami</h4>
                        <p class="text-gray-400 text-sm">Email: support@minisoccer.id</p>
                        <p class="text-gray-400 text-sm mt-2">Telp: (021) 123-4567</p>
                        <div class="flex space-x-3 mt-4 text-accent-gold">
                            {{-- Placeholder untuk ikon media sosial (Tetap warna Gold) --}}
                            <svg class="w-6 h-6 hover:text-white transition duration-200" fill="currentColor" viewBox="0 0 24 24"><path d="M7 10v4h3v7h4v-7h3l1-4h-4V8a2 2 0 012-2h2V2h-4a5 5 0 00-5 5v3H7z"/></svg> <svg class="w-6 h-6 hover:text-white transition duration-200" fill="currentColor" viewBox="0 0 24 24"><path d="M22 4.01c-.885.39-1.83.65-2.82.77.962-.57 1.706-1.48 2.05-2.55-.907.54-1.916.93-2.98.96C18.33 3.49 17.2 3 16 3c-2.484 0-4.5 2.016-4.5 4.5 0 .35.04.69.11 1.02-3.73-.19-7.03-1.97-9.24-4.68-.387.66-.58 1.4-.58 2.21 0 1.56.79 2.94 1.99 3.75-.72-.02-1.4-.22-2-.56v.05c0 2.18 1.55 4 3.6 4.42-.36.1-.73.15-1.12.15-.27 0-.53-.03-.79-.08.57 1.79 2.24 3.1 4.2 3.14-1.54 1.2-3.48 1.92-5.59 1.92-.36 0-.71-.02-1.06-.06 2 1.28 4.38 2.03 6.88 2.03 8.27 0 12.77-6.86 12.77-12.86 0-.2-.01-.4-.02-.6.94-.68 1.76-1.53 2.4-2.5z"/></svg> </div>
                    </div>
                    
                </div>
            </div>
        </footer>
    </div>
</x-app-layout>