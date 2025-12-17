<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-2 space-y-6">
            <h1 class="text-3xl font-bold text-white uppercase">{{ $field->name }}</h1>
            
            <div class="rounded-xl overflow-hidden shadow-lg border border-gray-700 bg-gray-800">
                {{-- Logic Image Fix --}}
                @php
                    $img = $field->image ?? $field->image_path;
                @endphp
                @if($img && Storage::disk('public')->exists($img))
                    <img src="{{ asset('storage/' . $img) }}" 
                         alt="{{ $field->name }}" 
                         class="w-full h-96 object-cover">
                @else
                    <div class="w-full h-96 flex flex-col items-center justify-center bg-gray-900 text-gray-600">
                        <svg class="w-16 h-16 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p>Foto Lapangan Belum Tersedia</p>
                    </div>
                @endif
            </div>

            <div class="bg-gray-900 p-6 rounded-xl border border-gray-800">
                <h3 class="text-xl font-bold text-white mb-4">Deskripsi</h3>
                <p class="text-gray-300">{{ $field->description ?? 'Tidak ada deskripsi.' }}</p>
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="bg-gray-900 p-6 rounded-xl border border-gray-700 shadow-2xl sticky top-6">
                <h2 class="text-xl font-bold text-white mb-6 border-b border-gray-700 pb-2">PESAN SEKARANG</h2>

                @if (session()->has('error'))
                    <div class="bg-red-500/10 border border-red-500 text-red-500 px-4 py-2 rounded mb-4 text-sm">
                        {{ session('error') }}
                    </div>
                @endif
                
                <div class="mb-4">
                    <label class="block text-gray-400 text-sm mb-2">Pilih Tanggal</label>
                    <input type="date" 
                           wire:model.live="selectedDate"
                           class="w-full bg-gray-800 text-white border border-gray-600 rounded-lg p-3">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-400 text-sm mb-2">Durasi (Jam)</label>
                    <select wire:model.live="duration" class="w-full bg-gray-800 text-white border border-gray-600 rounded-lg p-3">
                        @for ($i = 1; $i <= 3; $i++)
                            <option value="{{ $i }}">{{ $i }} Jam</option>
                        @endfor
                    </select>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-400 text-sm mb-2">Slot Waktu</label>
                    @if(count($availableSlots) > 0)
                        <div class="grid grid-cols-3 gap-2 max-h-48 overflow-y-auto pr-1">
                            @foreach($availableSlots as $index => $slot)
                                <button 
                                    type="button" 
                                    wire:key="slot-{{ $index }}"
                                    wire:click="selectSlot('{{ $slot['time'] }}')"
                                    class="text-sm py-2 px-1 rounded border transition
                                    {{ $selectedTime == $slot['time'] 
                                        ? 'bg-yellow-500 text-black border-yellow-500 font-bold' 
                                        : 'bg-transparent text-gray-300 border-gray-600 hover:border-yellow-500' 
                                    }}">
                                    {{ $slot['time'] }}
                                </button>
                            @endforeach
                        </div>
                    @else
                        <div class="text-red-400 text-sm">Tidak ada slot tersedia.</div>
                    @endif
                </div>

                <div class="text-center mb-6">
                    <h3 class="text-3xl font-bold text-white">Rp {{ number_format($totalPrice, 0, ',', '.') }}</h3>
                </div>

                <button 
                    type="button" 
                    wire:click="createBooking"
                    wire:loading.attr="disabled"
                    class="w-full bg-yellow-500 hover:bg-yellow-400 text-black font-bold py-4 rounded-lg shadow-lg disabled:opacity-50">
                    <span wire:loading.remove wire:target="createBooking">PESAN SEKARANG!</span>
                    <span wire:loading wire:target="createBooking">MEMPROSES...</span>
                </button>
            </div>
        </div>
    </div>
</div>