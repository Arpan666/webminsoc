<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tiket Booking #{{ $booking->id }} - F9 Minisoccer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print { display: none; }
            body { background: white; color: black; }
            .ticket-card { border: 1px solid #ccc; box-shadow: none; }
        }
    </style>
</head>
<body class="bg-gray-900 flex flex-col items-center p-5">

    <div class="no-print mb-5 text-center">
        <button onclick="window.print()" class="bg-yellow-500 hover:bg-yellow-400 text-black px-6 py-2 rounded-full font-bold shadow-lg transition">
            🖨️ CETAK SEKARANG
        </button>
        <p class="text-gray-400 text-xs mt-2">Atau simpan sebagai PDF melalui menu print browser</p>
    </div>

    {{-- TICKET START --}}
    <div class="ticket-card bg-white w-full max-w-md rounded-3xl overflow-hidden shadow-2xl text-black">
        {{-- Header --}}
        <div class="bg-black p-6 text-center border-b-4 border-yellow-500">
            <h1 class="text-yellow-500 text-2xl font-black italic">F9 MINISOCCER</h1>
            <p class="text-white text-[10px] tracking-[0.3em] uppercase">Digital Booking Ticket</p>
        </div>

        {{-- Body --}}
        <div class="p-8 relative">
            {{-- Watermark Status --}}
            <div class="absolute inset-0 flex items-center justify-center opacity-[0.08] pointer-events-none">
                <p class="text-7xl font-black border-8 border-green-600 text-green-600 p-2 transform -rotate-12 uppercase">LUNAS</p>
            </div>

            <div class="flex justify-between items-start mb-8">
                <div>
                    <p class="text-gray-400 text-[10px] uppercase font-bold tracking-wider">Pelanggan</p>
                    <p class="font-bold text-lg">{{ $booking->user->name }}</p>
                </div>
                <div class="text-right">
                    <p class="text-gray-400 text-[10px] uppercase font-bold tracking-wider">Booking ID</p>
                    <p class="font-mono font-bold text-lg">#F9-{{ str_pad($booking->id, 4, '0', STR_PAD_LEFT) }}</p>
                </div>
            </div>

            <div class="space-y-4 mb-8">
                <div class="flex border-b border-gray-100 pb-2">
                    <span class="w-1/3 text-gray-400 text-xs">Lapangan</span>
                    <span class="w-2/3 font-bold text-sm">: {{ $booking->field->name }}</span>
                </div>
                <div class="flex border-b border-gray-100 pb-2">
                    <span class="w-1/3 text-gray-400 text-xs">Tanggal</span>
                    <span class="w-2/3 font-bold text-sm">: {{ \Carbon\Carbon::parse($booking->start_time)->format('d F Y') }}</span>
                </div>
                <div class="flex border-b border-gray-100 pb-2">
                    <span class="w-1/3 text-gray-400 text-xs">Waktu</span>
                    <span class="w-2/3 font-bold text-sm text-blue-600">: {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }} WIB</span>
                </div>
                <div class="flex border-b border-gray-100 pb-2">
                    <span class="w-1/3 text-gray-400 text-xs">Total Harga</span>
                    <span class="w-2/3 font-bold text-sm">: Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                </div>
            </div>

            {{-- Footer Ticket --}}
            <div class="mt-10 pt-6 border-t-2 border-dashed border-gray-200 text-center">
                <p class="text-[10px] text-gray-400 mb-4 italic">Harap datang 15 menit sebelum waktu pemesanan untuk proses validasi.</p>
                
                {{-- QR Placeholder (Bisa diganti Library QR Code) --}}
                <div class="inline-block p-2 border-2 border-black rounded-xl">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data={{ $booking->id }}" alt="QR Code" class="w-24 h-24">
                </div>
                <p class="text-[8px] mt-2 font-mono uppercase tracking-widest">Authorized by F9 Minisoccer</p>
            </div>
        </div>

        {{-- Edge cut decoration --}}
        <div class="flex justify-between px-4 -mt-3 relative z-10">
            <div class="w-6 h-6 bg-gray-900 rounded-full -ml-7 no-print"></div>
            <div class="w-6 h-6 bg-gray-900 rounded-full -mr-7 no-print"></div>
        </div>
    </div>

</body>
</html>