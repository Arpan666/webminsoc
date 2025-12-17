<x-app-layout>
    {{-- Header Page --}}
    <x-slot name="header">
        <div class="pt-20 pb-4">
            <h2 class="font-black text-xl text-accent-gold uppercase tracking-[0.4em] text-center">
                {{ __('Riwayat Pemesanan') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-dark-bg min-h-screen">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            @if ($bookings->isEmpty())
                {{-- Empty State Premium --}}
                <div class="p-20 text-center bg-dark-card border border-white/5 rounded-[3rem] shadow-2xl relative overflow-hidden">
                    <div class="absolute -top-24 -left-24 w-64 h-64 bg-accent-gold/5 rounded-full blur-[100px]"></div>
                    <div class="relative z-10">
                        <div class="w-20 h-20 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-6 border border-white/10">
                            <svg class="w-10 h-10 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-black text-white uppercase tracking-widest mb-2">Belum Ada Riwayat</h3>
                        <p class="text-gray-500 text-sm mb-8">Sepertinya Anda belum melakukan pemesanan lapangan.</p>
                        <a href="{{ route('welcome') }}" class="inline-block py-4 px-10 bg-accent-gold text-dark-bg rounded-xl font-black uppercase text-[10px] tracking-widest hover:shadow-[0_10px_30px_rgba(212,175,55,0.3)] transition-all transform hover:-translate-y-1">
                            Cari Lapangan Sekarang
                        </a>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 gap-6">
                    @foreach ($bookings as $booking)
                        @php
                            $statusConfig = [
                                'confirmed' => ['label'=>'Dikonfirmasi','color'=>'text-green-500','bg'=>'bg-green-500/10','border'=>'border-green-500/20'],
                                'pending_verification' => ['label'=>'Menunggu Verifikasi','color'=>'text-orange-500','bg'=>'bg-orange-500/10','border'=>'border-orange-500/20'],
                                'waiting_confirmation' => ['label'=>'Menunggu Konfirmasi','color'=>'text-accent-gold','bg'=>'bg-accent-gold/10','border'=>'border-accent-gold/20'],
                                'rejected' => ['label'=>'Ditolak','color'=>'text-red-500','bg'=>'bg-red-500/10','border'=>'border-red-500/20'],
                                'cancelled' => ['label'=>'Dibatalkan','color'=>'text-gray-500','bg'=>'bg-white/5','border'=>'border-white/10'],
                            ];
                            $status = $statusConfig[$booking->status] ?? ['label'=>'Unknown','color'=>'text-gray-500','bg'=>'bg-white/5','border'=>'border-white/10'];
                        @endphp

                        {{-- Item Card --}}
                        <div class="group bg-dark-card border border-white/5 rounded-[2rem] p-6 md:p-8 hover:border-accent-gold/30 transition-all duration-500 shadow-xl relative overflow-hidden">
                            {{-- Hover Glow --}}
                            <div class="absolute -right-10 -top-10 w-32 h-32 bg-accent-gold/5 rounded-full blur-[60px] opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            
                            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                                {{-- Info Utama --}}
                                <div class="flex-grow">
                                    <div class="flex items-center gap-3 mb-4">
                                        <span class="px-3 py-1 {{ $status['bg'] }} {{ $status['color'] }} {{ $status['border'] }} border rounded-full text-[9px] font-black uppercase tracking-widest">
                                            {{ $status['label'] }}
                                        </span>
                                        <span class="text-[10px] text-gray-600 font-bold uppercase tracking-widest italic">
                                            #BK-{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}
                                        </span>
                                    </div>

                                    <h3 class="text-2xl font-black text-white uppercase tracking-tight group-hover:text-accent-gold transition-colors duration-300 mb-4">
                                        {{ $booking->field->name }}
                                    </h3>

                                    <div class="flex flex-wrap items-center gap-6">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-accent-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            <span class="text-gray-400 text-sm font-bold uppercase tracking-tighter">{{ $booking->start_time->format('d M Y') }}</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-accent-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            <span class="text-gray-400 text-sm font-bold uppercase tracking-tighter">{{ $booking->start_time->format('H:i') }} - {{ $booking->end_time->format('H:i') }}</span>
                                        </div>
                                        <div class="flex items-center gap-2 border-l border-white/10 pl-6">
                                            <span class="text-[10px] text-gray-500 uppercase font-black tracking-widest block leading-none">Total Harga</span>
                                            <span class="text-white font-black text-lg">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Action Buttons --}}
                                <div class="flex flex-row md:flex-col gap-3 min-w-[160px]">
                                    <a href="{{ route('payment.show', $booking->id) }}" 
                                       class="flex-1 text-center py-3 px-6 bg-white/5 hover:bg-white/10 text-white border border-white/10 rounded-xl font-black uppercase text-[10px] tracking-widest transition-all">
                                        Detail Booking
                                    </a>

                                    @if(in_array($booking->status,['pending_verification','waiting_confirmation']))
                                        <div class="flex-1">
                                            @livewire('cancel-booking-button',['booking'=>$booking], key($booking->id))
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>