<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-2 space-y-6">
            <h1 class="text-3xl font-bold text-white uppercase">{{ $field->name }}</h1>
            
            <div class="rounded-xl overflow-hidden shadow-lg border border-gray-700">
                <img src="{{ asset('storage/' . $field->image) }}" 
                     alt="{{ $field->name }}" 
                     class="w-full h-96 object-cover"
                     onerror="this.src='https://via.placeholder.com/800x400?text=No+Image'">
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
                
                @if (session()->has('price_error'))
                     <div class="bg-yellow-500/10 border border-yellow-500 text-yellow-500 px-4 py-2 rounded mb-4 text-sm">
                        {{ session('price_error') }}
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
                    @error('selectedTime') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
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