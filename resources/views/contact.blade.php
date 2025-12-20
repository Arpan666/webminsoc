<x-app-layout>
    <x-slot name="header">
        <div class="pt-20 bg-transparent"> 
            <h2 class="font-black text-xl text-accent-gold uppercase tracking-[0.4em] text-center drop-shadow-lg">
                {{ __('Hubungi Kami') }}
            </h2>
        </div>
    </x-slot>

    <div class="bg-dark-bg min-h-screen pt-8 pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
                
                <div class="lg:col-span-7">
                    <div class="bg-dark-card p-8 md:p-10 rounded-[2.5rem] border border-white/5 shadow-2xl relative overflow-hidden h-full">
                        <div class="absolute -left-10 -bottom-10 w-40 h-40 bg-accent-gold/5 rounded-full blur-[80px]"></div>
                        
                        <div class="relative z-10">
                            <h3 class="text-xl font-black text-white uppercase tracking-widest mb-8 flex items-center">
                                <span class="w-6 h-1 bg-accent-gold mr-3 rounded-full"></span>
                                Kirim Pesan
                            </h3>
                            
                            <form id="contactForm" class="space-y-5">
                                @csrf 
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <div>
                                        <label class="block text-[10px] font-black text-accent-gold uppercase tracking-[0.2em] mb-2 ml-1">Nama Lengkap</label>
                                        <input type="text" id="name" required class="w-full bg-dark-bg border border-white/5 text-white rounded-2xl py-3.5 px-6 focus:border-accent-gold focus:ring-1 focus:ring-accent-gold/20 transition duration-300 placeholder:text-gray-700" placeholder="Nama Anda">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-black text-accent-gold uppercase tracking-[0.2em] mb-2 ml-1">Email</label>
                                        <input type="email" id="email" required class="w-full bg-dark-bg border border-white/5 text-white rounded-2xl py-3.5 px-6 focus:border-accent-gold focus:ring-1 focus:ring-accent-gold/20 transition duration-300 placeholder:text-gray-700" placeholder="Email@mail.com">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-[10px] font-black text-accent-gold uppercase tracking-[0.2em] mb-2 ml-1">Pesan</label>
                                    <textarea id="message" rows="5" required class="w-full bg-dark-bg border border-white/5 text-white rounded-2xl py-3.5 px-6 focus:border-accent-gold focus:ring-1 focus:ring-accent-gold/20 transition duration-300 placeholder:text-gray-700" placeholder="Apa yang ingin Anda tanyakan?"></textarea>
                                </div>
                                
                                <button type="submit" id="submitBtn" class="w-full py-4 bg-accent-gold text-dark-bg rounded-2xl font-black uppercase text-[11px] tracking-[0.3em] hover:shadow-[0_10px_40px_rgba(212,175,55,0.2)] transition-all duration-500 transform hover:-translate-y-1 active:scale-95">
                                    Kirim Sekarang
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-5 space-y-6">
                    <div class="bg-dark-card p-8 rounded-[2.5rem] border border-white/5 shadow-2xl relative overflow-hidden">
                        <h3 class="text-xl font-black text-white uppercase tracking-widest mb-8 flex items-center">
                            <span class="w-6 h-1 bg-accent-gold mr-3 rounded-full"></span>
                            Info Kontak
                        </h3>

                        <div class="space-y-6">
                            <a href="https://wa.me/6281295689743" target="_blank" class="flex items-center group">
                                <div class="w-12 h-12 bg-accent-gold/10 rounded-xl flex items-center justify-center mr-4 group-hover:bg-accent-gold transition-colors duration-500">
                                    <i class="fab fa-whatsapp text-accent-gold group-hover:text-dark-bg text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black text-accent-gold uppercase tracking-widest">WhatsApp Admin</p>
                                    <p class="text-white font-bold">+62 812-9568-9743</p>
                                </div>
                            </a>
                            <div class="flex items-start">
                                <div class="group cursor-pointer flex-shrink-0 mr-4">
                                    <div class="w-12 h-12 bg-accent-gold/10 rounded-xl flex items-center justify-center group-hover:bg-accent-gold transition-all duration-500 shadow-sm">
                                        <i class="fas fa-map-marker-alt text-accent-gold group-hover:text-dark-bg text-xl transition-colors duration-500"></i>
                                    </div>
                                </div>
                                
                                <div>
                                    <p class="text-[10px] font-black text-accent-gold uppercase tracking-widest">Lokasi Lapangan</p>
                                    <p class="text-white font-bold leading-relaxed">
                                        Jl. Merdeka Timur, Keude Cunda, Kec. Muara Dua, Kota Lhokseumawe, Aceh 24355
                                    </p>
                                </div>
                            </div>

                            <a href="https://www.instagram.com/f9minisoccer/?hl=id" class="flex items-center group">
                                <div class="w-12 h-12 bg-accent-gold/10 rounded-xl flex items-center justify-center mr-4 group-hover:bg-accent-gold transition-colors duration-500">
                                    <i class="fab fa-instagram text-accent-gold group-hover:text-dark-bg text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black text-accent-gold uppercase tracking-widest">Instagram</p>
                                    <p class="text-white font-bold">@f9.minisoccer</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="bg-dark-card p-4 rounded-[2.5rem] border border-white/5 shadow-2xl h-[300px] overflow-hidden">
                        <iframe 
                            class="w-full h-full rounded-[2rem] grayscale-[0.8] contrast-[1.2] opacity-80 hover:grayscale-0 hover:opacity-100 transition-all duration-700"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.561366080626!2d97.1335548!3d5.1740216!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3047830027eb11ad%3A0x4b7a7e15d6e2a44b!2sF9%20MINI%20SOCCER!5e0!3m2!1sid!2sid!4v1766224726892!5m2!1sid!2sid" 
                            allowfullscreen="" 
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        @vite('resources/js/contact-handler.js')
    @endpush
</x-app-layout>