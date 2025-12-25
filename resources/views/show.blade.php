<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    {{-- Bagian Kanan: Form Booking (Sticky) --}}
    {{-- Pastikan div ini dibungkus sesuai struktur grid di halaman detail lapangan Bos --}}
    
    <div class="lg:col-start-3">
        <div class="sticky top-24 bg-dark-card p-6 rounded-[2rem] shadow-2xl border border-white/5 relative overflow-hidden">
            {{-- Dekorasi Glow --}}
            <div class="absolute -top-24 -right-24 w-48 h-48 bg-accent-gold/10 rounded-full blur-[80px]"></div>
            
            <div class="relative z-10">
                <h2 class="text-2xl font-black text-white uppercase tracking-tighter mb-1">Pesan <span class="text-accent-gold">Lapangan</span></h2>
                <p class="text-[10px] text-gray-500 font-bold uppercase tracking-[0.2em] mb-6">Sistem Reservasi Otomatis</p>

                <div class="space-y-5">
                    {{-- Input Tanggal --}}
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Tanggal Main</label>
                        <div class="relative">
                            <input type="date" wire:model.live="selectedDate" 
                                class="w-full bg-gray-900/50 border-white/5 rounded-xl text-sm text-white focus:ring-accent-gold focus:border-accent-gold transition-all py-3 px-4">
                        </div>
                    </div>

                    {{-- Input Durasi --}}
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Durasi Sewa</label>
                        <select wire:model.live="duration" 
                            class="w-full bg-gray-900/50 border-white/5 rounded-xl text-sm text-white focus:ring-accent-gold focus:border-accent-gold transition-all py-3 px-4">
                            <option value="1">1 Jam (Standar)</option>
                            <option value="2">2 Jam (Rekomendasi)</option>
                            <option value="3">3 Jam (Pro)</option>
                            <option value="4">4 Jam</option>
                        </select>
                    </div>

                    {{-- Slot Waktu --}}
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Pilih Jam Mulai</label>
                        @if(empty($availableSlots))
                            <div class="p-4 bg-red-500/10 border border-red-500/20 rounded-xl text-center">
                                <p class="text-red-500 text-[10px] font-bold uppercase">Maaf, Tidak Ada Slot Tersedia</p>
                            </div>
                        @else
                            <div class="grid grid-cols-3 gap-2">
                                @foreach($availableSlots as $slot)
                                    <button wire:click="selectSlot('{{ $slot['time'] }}')"
                                        class="py-3 text-[11px] font-black rounded-xl border transition-all duration-300 {{ $selectedTime == $slot['time'] ? 'bg-accent-gold border-accent-gold text-dark-bg shadow-[0_10px_20px_rgba(212,175,55,0.2)]' : 'bg-white/5 border-white/5 text-gray-400 hover:border-accent-gold/50' }}">
                                        {{ $slot['time'] }}
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    {{-- Ringkasan Harga --}}
                    <div class="mt-8 pt-6 border-t border-white/5">
                        <div class="flex justify-between items-end mb-6">
                            <div>
                                <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1">Total Pembayaran</p>
                                <div class="flex items-baseline gap-1">
                                    <span class="text-accent-gold font-bold text-sm">IDR</span>
                                    <span class="text-white font-black text-3xl tracking-tighter">
                                        {{ number_format($totalPrice, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-[9px] text-gray-600 font-bold uppercase italic">{{ $duration }} Jam Sewa</p>
                            </div>
                        </div>

                        {{-- Tombol Submit --}}
                        <button wire:click="createBooking" wire:loading.attr="disabled"
                            class="group relative w-full py-4 bg-accent-gold hover:bg-white text-dark-bg font-black uppercase text-[11px] tracking-[0.2em] rounded-xl transition-all duration-500 shadow-xl shadow-accent-gold/20 overflow-hidden">
                            <span wire:loading.remove>Konfirmasi & Bayar</span>
                            <span wire:loading>Memproses...</span>
                            
                            {{-- Efek Kilau --}}
                            <div class="absolute top-0 -inset-full h-full w-1/2 z-5 block transform -skew-x-12 bg-gradient-to-r from-transparent to-white/20 opacity-40 group-hover:animate-shine"></div>
                        </button>
                        
                        <p class="text-[8px] text-gray-600 text-center mt-4 uppercase tracking-widest font-bold">
                            Pembayaran Aman via Transfer Bank
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes shine {
        100% {
            left: 125%;
        }
    }
    .animate-shine {
        animation: shine 0.7s;
    }
</style>