<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold mb-6 text-gray-800">Riwayat Pemesanan Anda</h1>

            @if ($bookings->isEmpty())
                <div class="p-8 text-center text-gray-500 border-2 border-dashed border-gray-300 rounded-lg bg-gray-50">
                    <p class="text-lg">Anda belum memiliki riwayat pemesanan.</p>
                    <p class="text-sm mt-1">Silakan cari lapangan untuk memulai pemesanan.</p>
                </div>
            @else
                <div class="space-y-6">
                    @foreach ($bookings as $booking)
                        @php
                            $statusConfig = [
                                'confirmed' => ['label'=>'Dikonfirmasi','variant'=>'success','gradient'=>'from-green-500 via-green-600 to-green-700'],
                                'pending_verification' => ['label'=>'Menunggu Verifikasi','variant'=>'warning','gradient'=>'from-yellow-400 via-yellow-500 to-yellow-600'],
                                'waiting_confirmation' => ['label'=>'Menunggu Konfirmasi','variant'=>'warning','gradient'=>'from-yellow-400 via-yellow-500 to-yellow-600'],
                                'rejected' => ['label'=>'Ditolak','variant'=>'danger','gradient'=>'from-red-500 via-red-600 to-red-700'],
                                'cancelled' => ['label'=>'Dibatalkan','variant'=>'muted','gradient'=>'from-gray-300 via-gray-400 to-gray-500'],
                            ];
                            $status = $statusConfig[$booking->status] ?? ['label'=>'Tidak Diketahui','variant'=>'muted','gradient'=>'from-gray-300 via-gray-400 to-gray-500'];
                        @endphp

                        <x-card :gradient="$status['gradient']">
                            <div class="p-6 flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                                <div class="flex-1 space-y-3">
                                    <div class="flex justify-between items-start">
                                        <h3 class="text-2xl font-extrabold text-gray-900 group-hover:text-red-600 transition-colors">
                                            {{ $booking->field->name }}
                                        </h3>
                                        <x-badge :variant="$status['variant']">{{ $status['label'] }}</x-badge>
                                    </div>

                                    <div class="space-y-2 text-gray-600">
                                        <div class="flex items-center gap-2 text-gray-700">
                                            <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                                            <span class="text-sm font-medium">{{ $booking->start_time->format('d M Y') }}</span>
                                        </div>
                                        <div class="flex items-center gap-2 text-gray-700">
                                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                            <span class="text-sm font-medium">{{ $booking->start_time->format('H:i') }} - {{ $booking->end_time->format('H:i') }}</span>
                                        </div>
                                        <div class="flex items-center gap-2 text-gray-700">
                                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                            <span class="text-sm font-medium">Lapangan Olahraga</span>
                                        </div>
                                    </div>

                                    <div class="pt-3 mt-3 border-t border-gray-100">
                                        <p class="text-sm text-gray-500">Total Pembayaran</p>
                                        <p class="text-3xl font-extrabold text-red-600">Rp {{ number_format($booking->total_price,0,',','.') }}</p>
                                    </div>
                                </div>

                                <div class="flex md:flex-col gap-2 pt-4 md:pt-0">
                                    <x-button color="primary" onclick="window.location='{{ route('payment.show', $booking->id) }}'">
                                        Lihat Detail
                                    </x-button>

                                    @if(in_array($booking->status,['pending_verification','waiting_confirmation']))
                                        @livewire('cancel-booking-button',['booking'=>$booking], key($booking->id))
                                    @endif
                                </div>
                            </div>
                        </x-card>

                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
