{{-- resources/views/livewire/booking-calendar.blade.php --}}

<div class="p-4">
    {{-- Input Tanggal --}}
    <div class="mb-6">
        <label for="date" class="block text-sm font-medium text-gray-700">Pilih Tanggal</label>
        <input type="date" wire:model.live="selectedDate" min="{{ now()->toDateString() }}" 
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
    </div>

    <h3 class="text-xl font-semibold mb-4">Slot Waktu Tersedia ({{ $selectedDate }})</h3>

    {{-- Tampilan Slot Waktu --}}
    <div class="grid grid-cols-4 sm:grid-cols-6 lg:grid-cols-8 gap-3">
        @foreach($availableSlots as $slot)
            @if($slot['is_booked'])
                {{-- Slot Terisi --}}
                <button disabled class="px-3 py-2 text-sm rounded-lg bg-gray-200 text-gray-500 cursor-not-allowed">
                    {{ $slot['time'] }} (Terisi)
                </button>
            @else
                {{-- Slot Tersedia --}}
                <button 
                    wire:click="selectSlot('{{ $slot['time'] }}')" 
                    class="px-3 py-2 text-sm rounded-lg border 
                           {{ $selectedTime == $slot['time'] ? 'bg-red-600 text-white shadow-lg border-red-800' : 'bg-green-100 text-green-800 hover:bg-green-200' }}"
                >
                    {{ $slot['time'] }} <br> (Rp {{ number_format($slot['price'], 0, ',', '.') }})
                </button>
            @endif
        @endforeach
    </div>
    
    {{-- Form Checkout Sederhana --}}
    @if($selectedTime)
        <div class="mt-8 p-4 border-t border-gray-200 bg-red-50 rounded-lg">
            <h4 class="text-lg font-bold mb-3 text-red-700">Pemesanan Anda:</h4>
            <p>Waktu: **{{ $selectedTime }}** selama 
                <select wire:model.live="duration" class="rounded-md border-gray-300">
                    @for($i = 1; $i <= 4; $i++)
                        <option value="{{ $i }}">{{ $i }} Jam</option>
                    @endfor
                </select>
            </p>
            
            @php
                $total = $this->calculateTotalPrice($selectedTime, $duration);
            @endphp
            
            <p class="text-xl font-extrabold mt-3">Total Biaya: <span class="text-red-600">Rp {{ number_format($total, 0, ',', '.') }}</span></p>

            <button 
                wire:click="processCheckout" 
                class="mt-4 bg-red-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-red-700 transition"
            >
                Pesan Sekarang
            </button>
        </div>
    @endif
</div>