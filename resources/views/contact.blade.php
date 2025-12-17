<x-app-layout>
    {{-- Header Page --}}
    <x-slot name="header">
        {{-- Kita hilangkan kesan 'blok' dengan membuat container ini transparan --}}
        <div class="pt-20 bg-transparent"> 
            <h2 class="font-black text-xl text-accent-gold uppercase tracking-[0.4em] text-center drop-shadow-lg">
                {{ __('Hubungi Kami') }}
            </h2>
        </div>
    </x-slot>

    {{-- Content Area --}}
    {{-- Kita kurangi pt-16 menjadi pt-8 karena header sudah punya padding atas --}}
    <div class="bg-dark-bg min-h-screen pt-8 pb-20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
                
                {{-- Bagian Kiri: Formulir Kontak (8 Kolom) --}}
                <div class="lg:col-span-7">
                    <div class="bg-dark-card p-8 md:p-10 rounded-[2.5rem] border border-white/5 shadow-2xl relative overflow-hidden h-full">
                        {{-- Glow Effect --}}
                        <div class="absolute -left-10 -bottom-10 w-40 h-40 bg-accent-gold/5 rounded-full blur-[80px]"></div>
                        
                        <div class="relative z-10">
                            <h3 class="text-xl font-black text-white uppercase tracking-widest mb-8 flex items-center">
                                <span class="w-6 h-1 bg-accent-gold mr-3 rounded-full"></span>
                                Kirim Pesan
                            </h3>
                            
                            <form action="#" method="POST" class="space-y-5">
                                @csrf 
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <div>
                                        <label class="block text-[10px] font-black text-accent-gold uppercase tracking-[0.2em] mb-2 ml-1">Nama Lengkap</label>
                                        <input type="text" name="name" required
                                               class="w-full bg-dark-bg border-white/5 text-white rounded-2xl py-3.5 px-6 focus:border-accent-gold focus:ring-1 focus:ring-accent-gold/20 transition duration-300 placeholder:text-gray-700"
                                               placeholder="Nama Anda">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-black text-accent-gold uppercase tracking-[0.2em] mb-2 ml-1">Email</label>
                                        <input type="email" name="email" required
                                               class="w-full bg-dark-bg border-white/5 text-white rounded-2xl py-3.5 px-6 focus:border-accent-gold focus:ring-1 focus:ring-accent-gold/20 transition duration-300 placeholder:text-gray-700"
                                               placeholder="Email@mail.com">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-[10px] font-black text-accent-gold uppercase tracking-[0.2em] mb-2 ml-1">Pesan</label>
                                    <textarea name="message" rows="5" required
                                              class="w-full bg-dark-bg border-white/5 text-white rounded-2xl py-3.5 px-6 focus:border-accent-gold focus:ring-1 focus:ring-accent-gold/20 transition duration-300 placeholder:text-gray-700"
                                              placeholder="Apa yang ingin Anda tanyakan?"></textarea>
                                </div>
                                
                                <button type="submit"
                                        class="w-full py-4 bg-accent-gold text-dark-bg rounded-2xl font-black uppercase text-[11px] tracking-[0.3em] hover:shadow-[0_10px_40px_rgba(212,175,55,0.2)] transition-all duration-500 transform hover:-translate-y-1 active:scale-95">
                                    Kirim Sekarang
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Bagian Kanan: Info Panel (5 Kolom) --}}
                <div class="lg:col-span-5">
                    <div class="bg-dark-card p-10 rounded-[2.5rem] border border-white/5 shadow-2xl h-full flex flex-col justify-center relative overflow-hidden">
                        <div class="absolute -right-10 -top-10 w-32 h-32 bg-accent-gold/5 rounded-full blur-[60px]"></div>
                        
                        <h3 class="text-xl font-black text-white uppercase tracking-widest mb-10 flex items-center relative z-10">
                            <span class="w-6 h-1 bg-accent-gold mr-3 rounded-full"></span>
                            Info Kontak
                        </h3>
                        
                        <div class="space-y-8 relative z-10">
                            <div class="flex items-center group">
                                <div class="p-3.5 bg-white/5 rounded-xl mr-5 group-hover:bg-accent-gold group-hover:rotate-6 transition-all duration-500">
                                    <svg class="w-6 h-6 text-accent-gold group-hover:text-dark-bg" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8m-18 4v8a2 2 0 002 2h14a2 2 0 002-2v-8m-18 0l9 5 9-5"></path></svg>
                                </div>
                                <div>
                                    <p class="text-[9px] font-black text-gray-500 uppercase tracking-widest mb-0.5">Email Resmi</p>
                                    <p class="text-white font-bold text-sm tracking-tight">support@f9minisoccer.com</p>
                                </div>
                            </div>

                            <div class="flex items-center group">
                                <div class="p-3.5 bg-white/5 rounded-xl mr-5 group-hover:bg-accent-gold group-hover:-rotate-6 transition-all duration-500">
                                    <svg class="w-6 h-6 text-accent-gold group-hover:text-dark-bg" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.144a11.042 11.042 0 005.516 5.516l1.144-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.742 21 3 14.258 3 6V5z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-[9px] font-black text-gray-500 uppercase tracking-widest mb-0.5">WhatsApp Admin</p>
                                    <p class="text-white font-bold text-sm tracking-tight">+62 812-6999-888</p>
                                </div>
                            </div>

                            <div class="pt-8 mt-8 border-t border-white/5 relative">
                                <p class="text-gray-500 text-[10px] leading-relaxed italic uppercase tracking-wider">
                                    Tersedia Setiap Hari<br>
                                    <span class="text-accent-gold/60">08:00 — 23:00 WIB</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>