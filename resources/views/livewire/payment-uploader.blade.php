<div class="bg-gray-800 p-6 rounded-lg border border-gray-700">
    <h3 class="text-lg font-bold text-white mb-4">Upload Bukti Pembayaran</h3>

    @if ($uploadSuccess)
        <div class="bg-green-500/10 border border-green-500 text-green-500 p-4 rounded mb-4">
            <p class="font-bold">Berhasil!</p>
            <p>Bukti pembayaran telah terkirim. Admin akan memverifikasi segera.</p>
            <a href="{{ url('/') }}" class="block mt-4 text-center bg-green-600 text-white py-2 rounded">
    Kembali ke Halaman Utama
</a>
        </div>
    @else
        <form wire:submit.prevent="save">
            <div class="mb-4">
                <label class="block text-gray-400 text-sm mb-2">Foto Bukti Transfer</label>
                
                <input type="file" wire:model="paymentProof" class="text-white w-full bg-gray-900 border border-gray-600 rounded p-2">
                
                @error('paymentProof') 
                    <span class="text-red-500 text-xs">{{ $message }}</span> 
                @enderror
            </div>

            <div wire:loading wire:target="paymentProof" class="text-yellow-500 text-sm mb-2">
                Mengunggah gambar...
            </div>

            <button type="submit" 
                class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded w-full disabled:opacity-50"
                wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="save">Kirim Bukti</span>
                <span wire:loading wire:target="save">Memproses...</span>
            </button>
        </form>
    @endif
</div>