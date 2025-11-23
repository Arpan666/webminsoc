{{-- resources/views/payment/show.blade.php --}}

<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-xl rounded-xl p-8 border border-gray-200">

                {{-- HEADER --}}
                <div class="flex items-center gap-3 mb-6">
                    <div class="p-3 bg-red-100 text-red-600 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" 
                             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                            <path stroke-linecap="round" stroke-linejoin="round" 
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-800">Konfirmasi Pembayaran</h1>
                </div>

                {{-- TOTAL PEMBAYARAN --}}
                <div class="bg-gradient-to-r from-red-500 to-red-600 text-white p-6 rounded-xl shadow-md mb-8">
                    <p class="text-lg opacity-90">Total yang harus dibayar:</p>
                    <p class="text-5xl font-extrabold tracking-wide mt-2">
                        {{ number_format($booking->total_price, 0, ',', '.') }} IDR
                    </p>
                    <p class="mt-4 text-sm opacity-90">
                        Transfer ke rekening:
                    </p>
                    <p class="text-lg font-semibold">BNI - <span class="font-bold">123456789</span> (A.N. Booking Minisoccer)</p>
                </div>

                {{-- DETAIL BOOKING --}}
                <div class="mb-8">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Detail Pemesanan</h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        <div class="flex items-start gap-3 p-4 bg-gray-100 border rounded-lg">
                            <span class="text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" 
                                     viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" 
                                     class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                        d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                            </span>
                            <div>
                                <p class="text-sm text-gray-500">Lapangan</p>
                                <p class="font-bold">{{ $booking->field->name }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 p-4 bg-gray-100 border rounded-lg">
                            <span class="text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" 
                                     viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" 
                                     class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                        d="M12 6v6l4 2" />
                                </svg>
                            </span>
                            <div>
                                <p class="text-sm text-gray-500">Waktu Bermain</p>
                                <p class="font-bold">
                                    {{ $booking->start_time->format('d M Y, H:i') }} - 
                                    {{ $booking->end_time->format('H:i') }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 p-4 bg-gray-100 border rounded-lg sm:col-span-2">
                            <span class="text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" 
                                     viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" 
                                     class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                        d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </span>
                            <div>
                                <p class="text-sm text-gray-500">Status</p>
                                <span class="px-3 py-1 rounded-full text-sm font-semibold 
                                    @if($booking->status === 'pending_verification')
                                        bg-orange-100 text-orange-600
                                    @elseif($booking->status === 'confirmed')
                                        bg-green-100 text-green-600
                                    @elseif($booking->status === 'rejected')
                                        bg-red-100 text-red-600
                                    @endif">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- CATATAN ADMIN --}}
                @if ($booking->admin_notes)
                    <div class="mb-8 p-5 rounded-lg border-l-4 
                        @if($booking->status === 'rejected') bg-red-50 border-red-600 text-red-700
                        @else bg-green-50 border-green-600 text-green-700 @endif">

                        <p class="font-bold text-lg">
                            {{ $booking->status === 'rejected' ? 'Catatan Admin (Ditolak)' : 'Catatan Admin' }}
                        </p>
                        <p class="mt-1 text-sm leading-relaxed">
                            {{ $booking->admin_notes }}
                        </p>
                    </div>
                @endif


                {{-- UPLOAD BUKTI TRANSFER --}}
                <div>
                    <h2 class="text-xl font-bold text-gray-800 mb-3">Upload Bukti Transfer</h2>
                    <div class="p-5 bg-gray-100 rounded-lg border">
                        @livewire('payment-uploader', ['booking' => $booking])
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
