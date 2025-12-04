<x-app-layout>
    <x-slot name="header">
        {{-- Header Page --}}
        {{ __('LOKASI LAPANGAN KAMI') }}
    </x-slot>

    <div class="container mx-auto px-4 py-12 bg-dark-bg max-w-7xl">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            
            {{-- Bagian Kiri: Peta dan Visual --}}
            <div class="lg:col-span-1 space-y-6">
                <h2 class="text-3xl font-extrabold text-accent-gold mb-4 border-b border-accent-gold/50 pb-2">Peta Lapangan</h2>

                {{-- **MODIFIKASI: Peta Google Maps (Ganti Placeholder)** --}}
                {{-- Container dipertahankan dengan tinggi h-96, rounded-xl, dan border gold --}}
                <div class="relative w-full h-96 bg-gray-800 rounded-xl shadow-2xl overflow-hidden border border-accent-gold/30">
                    
                    {{-- Kode Iframe Google Maps Anda di sini --}}
                    {{-- Atribut width dan height diubah ke 100% agar mengisi penuh div parent (h-96) --}}
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.561366080626!2d97.1335548!3d5.1740216!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3047830027eb11ad%3A0x4b7a7e15d6e2a44b!2sF9%20MINI%20SOCCER!5e0!3m2!1sid!2sid!4v1763996834030!5m2!1sid!2sid" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                    
                </div>

                <div class="bg-dark-card p-6 rounded-xl shadow-xl border border-gray-700">
                    <p class="text-gray-300 leading-relaxed">
                        Lapangan kami terletak di lokasi strategis yang mudah dijangkau dari berbagai penjuru kota. Cek petunjuk arah melalui Google Maps di atas (atau melalui tautan di bawah).
                    </p>
                </div>
            </div>

            {{-- Bagian Kanan: Detail Akses dan Alamat --}}
            <div class="lg:col-span-1 space-y-8">
                <h2 class="text-3xl font-extrabold text-accent-gold mb-4 border-b border-accent-gold/50 pb-2">Detail Akses</h2>

                {{-- Card Alamat Lengkap --}}
                <div class="bg-dark-card p-6 rounded-xl shadow-xl border border-gray-700">
                    <h3 class="text-xl font-bold text-white mb-2 flex items-center">
                        <svg class="w-6 h-6 text-accent-gold mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0l-4.243-4.243m11.314 0a10 10 0 01-14.142 0m14.142 0H18.5a2 2 0 002-2V7a2 2 0 00-2-2h-12a2 2 0 00-2 2v7a2 2 0 002 2h2.828"></path></svg>
                        Alamat Resmi
                    </h3>
                    <p class="text-gray-400">
                        F9 MiniSoccer Jl. Merdeka Timur, Keude Cunda, Kec. Muara Dua, Kota Lhokseumawe, Aceh 24355.
                    </p>
                    <a href="https://maps.app.goo.gl/wqHNnEKTvmx34caW9" target="_blank" class="mt-4 inline-flex items-center text-accent-gold hover:text-accent-light transition duration-200">
                        Lihat di Google Maps
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    </a>
                </div>

                {{-- Card Petunjuk Transportasi --}}
                <div class="bg-dark-card p-6 rounded-xl shadow-xl border border-gray-700">
                    <h3 class="text-xl font-bold text-white mb-2 flex items-center">
                        <svg class="w-6 h-6 text-accent-gold mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h-4v-2a2 2 0 00-2-2H9a2 2 0 00-2 2v2H3l2-7V8a2 2 0 012-2h10a2 2 0 012 2v5l2 7z"></path></svg>
                        Petunjuk Arah
                    </h3>
                    <ul class="text-gray-400 list-disc list-inside space-y-2">
                        <li>
                            <span class="font-semibold text-white">Mobil Pribadi:</span> Akses melalui Jalan Lintas Sumatera. Lapangan berada di dekat jembatan/sungai. Tersedia parkir di belakang MR.DIY.
                        </li>
                        <li>
                            <span class="font-semibold text-white">Transportasi Publik:</span> Naik angkutan umum (labi-labi) jurusan Cunda/Krueng Geukueh, turun di Komplek Harun Square. Lapangan berada persis di belakang komplek tersebut.
                        </li>
                        <li>
                            <span class="font-semibold text-white">Ojek Online:</span> Cari "F9 MINI SOCCER" atau gunakan patokan "Wisma Sartika" atau "Hotel Diana" (terlihat di peta).
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>