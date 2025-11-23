{{-- resources/views/livewire/cancel-booking-button.blade.php --}}

<div x-data="{ open: false }">
    <button @click="open = true" 
            class="mt-2 w-full md:w-auto px-4 py-2 text-sm font-bold text-white bg-gray-500 rounded-lg hover:bg-gray-600 transition duration-150">
        Batalkan Pesanan
    </button>

    {{-- Modal Konfirmasi (Menggunakan Alpine.js untuk UX yang lebih baik) --}}
    <div x-show="open" 
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
         style="display: none;">
        
        <div @click.away="open = false"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             class="bg-white p-6 rounded-lg shadow-2xl max-w-sm w-full">
            
            <h3 class="text-xl font-bold mb-4 text-red-600">Konfirmasi Pembatalan</h3>
            <p class="text-gray-700 mb-6">Anda yakin ingin membatalkan pemesanan lapangan **{{ $booking->field->name }}** pada tanggal **{{ $booking->start_time->format('d M Y') }}**? Tindakan ini tidak dapat dibatalkan.</p>
            
            <div class="flex justify-end space-x-3">
                <button @click="open = false" 
                        type="button"
                        class="px-4 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 transition duration-150">
                    Batal
                </button>
                <button wire:click.prevent="cancel" 
                        @click="open = false"
                        type="button"
                        class="px-4 py-2 text-white bg-red-600 rounded-lg hover:bg-red-700 font-bold transition duration-150">
                    Ya, Batalkan
                </button>
            </div>
        </div>
    </div>
</div>