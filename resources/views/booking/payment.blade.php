{{-- resources/views/booking/payment.blade.php --}}

<x-app-layout>
    <div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-6 border-b pb-2">💵 Konfirmasi & Pembayaran</h1>

        {{-- Detail Pemesanan --}}
        <div class="bg-white p-6 rounded-lg shadow-md mb-8">
            <h2 class="text-xl font-semibold mb-4">Detail Pesanan Anda</h2>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-500">Lapangan:</p>
                    <p class="font-medium">{{ $booking->field->name }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Waktu:</p>
                    <p class="font-medium">{{ $booking->start_time->format('d M Y, H:i') }} - {{ $booking->end_time->format('H:i') }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Harga Total:</p>
                    <p class="text-2xl font-bold text-red-600">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Status:</p>
                    {{-- Badge Status agar lebih cantik --}}
                    <span class="px-3 py-1 rounded-full text-sm font-semibold 
                        {{ $booking->status === 'confirmed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                    </span>
                </div>
            </div>

            {{-- TAMPILKAN BUKTI JIKA SUDAH ADA --}}
            @if($booking->payment_proof_path)
                <div class="mt-6 pt-6 border-t">
                    <p class="text-gray-500 mb-2">Bukti Pembayaran Anda:</p>
                    <div class="relative w-48 h-64 overflow-hidden rounded-lg border shadow-sm">
                        <img src="{{ asset('storage/' . $booking->payment_proof_path) }}" 
                             alt="Bukti Transfer" 
                             class="object-cover w-full h-full cursor-pointer hover:opacity-80 transition"
                             onclick="window.open(this.src)">
                    </div>
                    <p class="text-xs text-gray-400 mt-2">*Klik gambar untuk memperbesar</p>
                </div>
            @endif
        </div>

        {{-- Instruksi Pembayaran dan Upload Bukti --}}
        {{-- Jika status sudah confirmed, biasanya uploader disembunyikan --}}
        @if($booking->status !== 'confirmed' && $booking->status !== 'completed')
            @livewire('payment-uploader', ['booking' => $booking])
        @else
            <div class="bg-green-50 border-l-4 border-green-400 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">
                            Pembayaran telah dikonfirmasi. Terima kasih!
                        </p>
                    </div>
                </div>
            </div>
        @endif

    </div>
</x-app-layout>