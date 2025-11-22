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
                    <p class="font-medium text-yellow-600">{{ $booking->status }}</p>
                </div>
            </div>
        </div>

        {{-- Instruksi Pembayaran dan Upload Bukti --}}
        @livewire('payment-uploader', ['booking' => $booking])

    </div>
</x-app-layout>