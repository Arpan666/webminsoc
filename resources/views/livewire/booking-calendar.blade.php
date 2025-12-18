<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        {{-- Sisi Kiri: Info Lapangan --}}
        <div class="lg:col-span-2 space-y-6">
            <h1 class="text-3xl font-bold text-white uppercase tracking-wider">{{ $field->name }}</h1>
            
            <div class="rounded-2xl overflow-hidden shadow-2xl border border-gray-800 bg-gray-900 group">
                @php $img = $field->image ?? $field->image_path; @endphp
                @if($img && Storage::disk('public')->exists($img))
                    <img src="{{ asset('storage/' . $img) }}" class="w-full h-[450px] object-cover group-hover:scale-105 transition-transform duration-700">
                @else
                    <div class="w-full h-96 flex flex-col items-center justify-center bg-gray-900 text-gray-700">
                        <i class="fa-solid fa-image text-5xl mb-4"></i>
                        <p class="font-bold uppercase tracking-widest">Foto Tidak Tersedia</p>
                    </div>
                @endif
            </div>

            <div class="bg-gray-900/50 p-8 rounded-2xl border border-gray-800 backdrop-blur-sm">
                <h3 class="text-xl font-bold text-accent-gold mb-4 uppercase tracking-widest border-b border-gray-800 pb-2">Deskripsi Lapangan</h3>
                <p class="text-gray-400 leading-relaxed">{{ $field->description ?? 'Nikmati fasilitas terbaik di F9 Minisoccer.' }}</p>
            </div>
        </div>

        {{-- Sisi Kanan: Form Booking --}}
        <div class="lg:col-span-1">
            <div class="bg-gray-900 p-6 rounded-2xl border border-gray-700 shadow-2xl sticky top-6">
                <h2 class="text-xl font-black text-white mb-6 border-b border-gray-800 pb-4 tracking-tighter text-center">
                    <span class="text-accent-gold">UNIT</span> RESERVASI
                </h2>

                @if (session()->has('error'))
                    <div class="bg-red-500/10 border border-red-500/50 text-red-500 px-4 py-3 rounded-xl mb-6 text-xs font-bold uppercase tracking-tight animate-bounce">
                        <i class="fa-solid fa-triangle-exclamation mr-2"></i> {{ session('error') }}
                    </div>
                @endif
                
                <div class="space-y-5">
                    {{-- Input Tanggal --}}
                    <div>
                        <label class="block text-gray-500 text-[10px] font-black uppercase tracking-[0.2em] mb-2 ml-1">Tanggal Main</label>
                        <input type="date" 
                               wire:model.live="selectedDate"
                               min="{{ date('Y-m-d') }}"
                               class="w-full bg-black/40 text-white border border-gray-700 rounded-xl p-4 focus:border-accent-gold focus:ring-0 transition-all">
                    </div>

                    {{-- Input Durasi --}}
                    <div>
                        <label class="block text-gray-500 text-[10px] font-black uppercase tracking-[0.2em] mb-2 ml-1">Durasi Sewa</label>
                        <select wire:model.live="duration" class="w-full bg-black/40 text-white border border-gray-700 rounded-xl p-4 focus:border-accent-gold focus:ring-0 transition-all">
                            @for ($i = 1; $i <= 2; $i++)
                                <option value="{{ $i }}" class="bg-gray-900">{{ $i }} Jam</option>
                            @endfor
                        </select>
                    </div>

                    {{-- Slot Waktu --}}
                    <div>
                        <label class="block text-gray-500 text-[10px] font-black uppercase tracking-[0.2em] mb-2 ml-1">Pilih Jam</label>
                        @if(count($availableSlots) > 0)
                            <div class="grid grid-cols-3 gap-2 max-h-56 overflow-y-auto pr-2 custom-scrollbar">
                                @foreach($availableSlots as $index => $slot)
                                    <button 
                                        type="button" 
                                        wire:key="slot-{{ $index }}-{{ $selectedDate }}"
                                        wire:click="selectSlot('{{ $slot['time'] }}')"
                                        class="text-[11px] font-bold py-3 rounded-xl border transition-all duration-300
                                        {{ $selectedTime == $slot['time'] 
                                            ? 'bg-accent-gold text-black border-accent-gold shadow-[0_0_15px_rgba(255,195,0,0.4)]' 
                                            : 'bg-black/20 text-gray-400 border-gray-800 hover:border-accent-gold/50' 
                                        }}">
                                        {{ $slot['time'] }}
                                    </button>
                                @endforeach
                            </div>
                        @else
                            <div class="bg-red-500/5 border border-red-900/20 text-red-400 p-4 rounded-xl text-[10px] font-bold text-center uppercase tracking-widest">
                                Tidak ada slot tersedia untuk tanggal ini.
                            </div>
                        @endif
                    </div>

                    {{-- Harga & Tombol --}}
                    <div class="pt-6 border-t border-gray-800 mt-4">
                        <div class="flex justify-between items-end mb-6">
                            <span class="text-[10px] font-black text-gray-500 uppercase tracking-widest">Total Bayar</span>
                            <span class="text-3xl font-black text-white tracking-tighter">
                                <span class="text-accent-gold text-sm font-bold mr-1">Rp</span>{{ number_format($totalPrice, 0, ',', '.') }}
                            </span>
                        </div>

                        <button 
                            type="button" 
                            wire:click="createBooking"
                            wire:loading.attr="disabled"
                            @if(count($availableSlots) == 0) disabled @endif
                            class="w-full bg-accent-gold hover:bg-yellow-400 text-black font-black py-5 rounded-2xl shadow-xl transition-all active:scale-95 disabled:opacity-20 disabled:grayscale uppercase tracking-[0.2em] text-[11px]">
                            <span wire:loading.remove wire:target="createBooking">Konfirmasi Pesanan</span>
                            <span wire:loading wire:target="createBooking" class="flex items-center justify-center">
                                <i class="fa-solid fa-circle-notch animate-spin mr-2"></i> Memproses...
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>