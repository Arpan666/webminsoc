{{-- resources/views/livewire/payment-uploader.blade.php --}}

<div>
    {{-- Notifikasi --}}
    @if (session()->has('message'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            <p>{{ session('message') }}</p>
        </div>
    @endif
    
    @if (session()->has('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
            <p>{{ session('error') }}</p>
        </div>
    @endif

    {{-- Tampilan Form Upload --}}
    @if ($booking->status === 'pending_verification' && !$uploadSuccess)
        <form wire:submit.prevent="submitPayment">
            
            <div class="mb-4">
                <label for="paymentProof" class="block text-sm font-medium text-gray-700">Pilih File Bukti Bayar (Max 1MB)</label>
                <input type="file" 
                       id="paymentProof" 
                       wire:model="paymentProof" 
                       class="mt-1 block w-full border border-gray-300 rounded-md p-2">

                {{-- Tampilkan progress bar saat mengupload (opsional) --}}
                <div x-data="{ isUploading: false, progress: 0 }" 
                     x-on:livewire-upload-start="isUploading = true" 
                     x-on:livewire-upload-finish="isUploading = false" 
                     x-on:livewire-upload-error="isUploading = false" 
                     x-on:livewire-upload-progress="progress = $event.detail.progress">
                    
                    @if ($paymentProof)
                        <p class="text-xs text-gray-500 mt-2">File siap diupload. {{ $paymentProof->getClientOriginalName() }}</p>
                    @endif

                    <div x-show="isUploading" class="mt-2">
                        <progress max="100" x-bind:value="progress" class="w-full h-2 rounded-lg"></progress>
                    </div>
                </div>

                @error('paymentProof') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>
            
            <button type="submit" 
                    class="w-full px-4 py-2 bg-red-600 text-white font-bold rounded-lg hover:bg-red-700 transition duration-150">
                Kirim Bukti Pembayaran
            </button>
        </form>
    @elseif ($booking->status === 'waiting_confirmation' || $uploadSuccess)
        {{-- Tampilan setelah bukti bayar berhasil diupload --}}
        <div class="p-6 text-center bg-yellow-50 border-2 border-yellow-300 rounded-lg">
            <p class="text-xl font-bold text-yellow-800">Status Pembayaran: Menunggu Konfirmasi Admin</p>
            <p class="text-gray-700 mt-2">Bukti pembayaran Anda telah kami terima. Admin akan memprosesnya secepatnya.</p>
            @if ($booking->payment_proof_path)
                 <a href="{{ Storage::url($booking->payment_proof_path) }}" target="_blank" class="mt-3 inline-block text-sm text-blue-600 hover:text-blue-800 underline">Lihat Bukti Bayar</a>
            @endif
        </div>
    @elseif ($booking->status === 'confirmed')
        {{-- Tampilan jika sudah dikonfirmasi --}}
         <div class="p-6 text-center bg-green-50 border-2 border-green-300 rounded-lg">
            <p class="text-xl font-bold text-green-800">Status Pembayaran: Dikonfirmasi (Confirmed)</p>
            <p class="text-gray-700 mt-2">Pemesanan lapangan Anda telah berhasil dikonfirmasi oleh Admin.</p>
        </div>
    @endif
    
</div>