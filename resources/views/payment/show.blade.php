<x-app-layout>
    {{-- Header Page --}}
    <x-slot name="header">
        {{-- pt-20 agar pas di bawah navbar fixed, pb-4 agar slim --}}
        <div class="pt-20 pb-4">
            <h2 class="font-black text-xl text-accent-gold uppercase tracking-[0.4em] text-center drop-shadow-lg">
                {{ __('Konfirmasi Pembayaran') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-dark-bg min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-dark-card shadow-2xl rounded-[2.5rem] p-8 md:p-10 border border-white/5 relative overflow-hidden">
                {{-- Decorative Glow Effect --}}
                <div class="absolute -right-20 -top-20 w-64 h-64 bg-accent-gold/5 rounded-full blur-[100px]"></div>

                {{-- TOTAL PEMBAYARAN (Hero Section) --}}
                <div class="relative bg-gradient-to-br from-accent-gold to-[#B8860B] p-8 rounded-3xl shadow-[0_20px_50px_rgba(212,175,55,0.2)] mb-10 overflow-hidden group">
                    {{-- Tekstur Karbon Halus --}}
                    <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')]"></div>
                    
                    <div class="relative z-10 text-center md:text-left md:flex items-center justify-between">
                        <div>
                            <p class="text-[10px] font-black text-dark-bg/70 uppercase tracking-[0.3em] mb-1">Total yang harus dibayar</p>
                            <h3 class="text-4xl md:text-5xl font-black text-dark-bg tracking-tighter">
                                Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                            </h3>
                        </div>
                        <div class="mt-6 md:mt-0 pt-6 md:pt-0 border-t md:border-t-0 md:border-l border-dark-bg/20 md:pl-8">
                            <p class="text-[9px] font-black text-dark-bg/70 uppercase tracking-widest mb-1">Transfer Ke Rekening</p>
                            <p class="text-xl font-black text-dark-bg">BNI 123456789</p>
                            <p class="text-[11px] font-bold text-dark-bg/80">A.N. F9 MINISOCCER INDONESIA</p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                    
                    {{-- KOLOM KIRI: DETAIL PEMESANAN --}}
                    <div>
                        <h2 class="text-sm font-black text-white uppercase tracking-widest mb-6 flex items-center">
                            <span class="w-6 h-1 bg-accent-gold mr-3 rounded-full"></span>
                            Detail Pesanan
                        </h2>

                        <div class="space-y-4">
                            {{-- Lapangan --}}
                            <div class="flex items-center p-4 bg-dark-bg border border-white/5 rounded-2xl group hover:border-accent-gold/30 transition-all duration-300">
                                <div class="p-3 bg-white/5 rounded-xl mr-4 text-accent-gold">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                </div>
                                <div>
                                    <p class="text-[8px] font-black text-gray-500 uppercase tracking-widest">Lapangan</p>
                                    <p class="text-white font-bold text-sm tracking-tight">{{ $booking->field->name }}</p>
                                </div>
                            </div>

                            {{-- Waktu --}}
                            <div class="flex items-center p-4 bg-dark-bg border border-white/5 rounded-2xl group hover:border-accent-gold/30 transition-all duration-300">
                                <div class="p-3 bg-white/5 rounded-xl mr-4 text-accent-gold">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-[8px] font-black text-gray-500 uppercase tracking-widest">Jadwal Bermain</p>
                                    <p class="text-white font-bold text-sm tracking-tight italic">
                                        {{ $booking->start_time->format('d M Y, H:i') }} - {{ $booking->end_time->format('H:i') }}
                                    </p>
                                </div>
                            </div>

                            {{-- Status --}}
                            <div class="flex items-center p-4 bg-dark-bg border border-white/5 rounded-2xl group hover:border-accent-gold/30 transition-all duration-300">
                                <div class="p-3 bg-white/5 rounded-xl mr-4">
                                    <div class="w-3 h-3 rounded-full animate-pulse
                                        @if($booking->status === 'pending_verification') bg-orange-500
                                        @elseif($booking->status === 'confirmed') bg-green-500
                                        @else bg-red-500 @endif">
                                    </div>
                                </div>
                                <div>
                                    <p class="text-[8px] font-black text-gray-500 uppercase tracking-widest">Status Pembayaran</p>
                                    <p class="font-black text-xs uppercase tracking-widest
                                        @if($booking->status === 'pending_verification') text-orange-500
                                        @elseif($booking->status === 'confirmed') text-green-500
                                        @else text-red-500 @endif">
                                        {{ str_replace('_', ' ', $booking->status) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- KOLOM KANAN: UPLOAD BUKTI --}}
                    <div class="flex flex-col">
                        <h2 class="text-sm font-black text-white uppercase tracking-widest mb-6 flex items-center">
                            <span class="w-6 h-1 bg-accent-gold mr-3 rounded-full"></span>
                            Upload Bukti Transfer
                        </h2>
                        <div class="p-6 bg-dark-bg border border-white/5 rounded-[2rem] shadow-inner flex-grow">
                            @livewire('payment-uploader', ['bookingId' => $booking->id])
                        </div>
                    </div>
                </div>

                {{-- CATATAN ADMIN (Tampil Jika Ada) --}}
                @if ($booking->admin_notes)
                    <div class="p-6 rounded-2xl border-l-4 relative overflow-hidden mt-6
                        @if($booking->status === 'rejected') bg-red-500/10 border-red-500 text-red-200
                        @else bg-accent-gold/10 border-accent-gold text-accent-gold @endif">
                        <div class="relative z-10">
                            <p class="font-black text-[10px] uppercase tracking-[0.2em] mb-2 opacity-70">
                                {{ $booking->status === 'rejected' ? 'Alasan Penolakan' : 'Catatan Admin' }}
                            </p>
                            <p class="text-sm font-medium leading-relaxed italic">
                                "{{ $booking->admin_notes }}"
                            </p>
                        </div>
                    </div>
                @endif

            </div>

            {{-- FOOTER NAVIGATION --}}
            <div class="mt-10 text-center">
                <a href="{{ route('my-bookings.index') }}" 
                   class="group inline-flex items-center text-gray-500 hover:text-accent-gold transition-all duration-300">
                    <span class="text-[10px] font-black uppercase tracking-[0.3em]">
                        ← Kembali ke Riwayat Booking
                    </span>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>