{{-- resources/views/livewire/booking-calendar.blade.php --}}

<div>
    {{-- FORM BOOKING --}}
    <form wire:submit.prevent="createBooking">

        {{-- 1. Pilihan Tanggal --}}
        <div class="mb-4">
            <label for="selectedDate" class="block text-sm font-medium text-gray-700">Pilih Tanggal</label>
            <input type="date" 
                   id="selectedDate" 
                   wire:model.live="selectedDate" 
                   min="{{ now()->toDateString() }}" 
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
            @error('selectedDate') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        
        {{-- 2. Pilihan Durasi --}}
        <div class="mb-4">
            <label for="duration" class="block text-sm font-medium text-gray-700">Durasi (Jam)</label>
            <select id="duration" 
                    wire:model.live="duration" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                <option value="">Pilih Durasi</option>
                <option value="1">1 Jam</option>
                <option value="2">2 Jam</option>
                <option value="3">3 Jam</option>
                {{-- Anda bisa menyesuaikan durasi sesuai kebutuhan --}}
            </select>
            @error('duration') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- 3. Slot Waktu Tersedia --}}
        <h3 class="text-lg font-semibold mt-4 mb-2">Slot Waktu Tersedia ({{ $selectedDate }})</h3>
        
        <div class="flex flex-wrap gap-2 mb-4">
            @forelse ($availableSlots as $slot)
                <button type="button" 
                        wire:click="selectSlot('{{ $slot['time'] }}')" 
                        class="@if($selectedTime == $slot['time']) bg-red-600 text-white @else bg-gray-200 text-gray-700 hover:bg-red-100 @endif 
                                px-3 py-1 rounded-full text-sm font-medium transition duration-150">
                    {{ $slot['time'] }}
                </button>
            @empty
                <p class="text-gray-500">Tidak ada slot tersedia pada tanggal ini.</p>
            @endforelse
        </div>
        @error('selectedTime') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

        {{-- 4. Harga Total (Hanya ditampilkan jika slot dan durasi dipilih) --}}
        @if ($selectedTime && $duration)
            <div class="mt-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700">
                <p class="font-bold text-lg">Total Harga:</p>
                <p class="text-2xl font-extrabold">{{ number_format($totalPrice, 0, ',', '.') }} IDR</p>
                <input type="hidden" wire:model="totalPrice"> {{-- Simpan total harga ke properti --}}
            </div>
        @endif

        {{-- 5. Tombol Pesan --}}
        <button type="submit" 
                class="w-full mt-6 px-4 py-2 bg-red-600 text-white font-bold rounded-lg hover:bg-red-700 transition duration-150"
                @unless ($selectedTime && $duration) disabled @endunless>
            Pesan Sekarang
        </button>
        
    </form>
</div>