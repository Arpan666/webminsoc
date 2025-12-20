<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Tiket #{{ $booking->id }} - F9</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; padding: 0 !important; }
            .ticket-card { box-shadow: none !important; border: 1px solid #eee; margin: 0 !important; width: 100% !important; border-radius: 0 !important; }
        }
        /* Mencegah scroll berlebih di mobile */
        html, body { overflow: hidden; height: 100%; }
    </style>
</head>
<body class="bg-gray-900 flex flex-col items-center justify-center p-4">

    {{-- Tombol Unduh - Ukuran Ringkas --}}
    <div class="no-print mb-4 w-full max-w-[340px]">
        <button onclick="window.print()" class="w-full bg-yellow-500 hover:bg-yellow-400 text-black py-3 rounded-xl font-black shadow-lg transition-all active:scale-95 flex items-center justify-center gap-2 text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M7.5 12l4.5 4.5m0 0l4.5-4.5M12 3v13.5"></path>
            </svg>
            UNDUH TIKET (PDF)
        </button>
    </div>

    {{-- TICKET START - Ukuran Compact --}}
    <div class="ticket-card bg-white w-full max-w-[340px] rounded-[2rem] overflow-hidden shadow-2xl text-black flex flex-col">
        
        {{-- Header Padat --}}
        <div class="bg-black py-4 px-6 text-center border-b-4 border-yellow-500 relative">
            <h1 class="text-yellow-500 text-xl font-black italic tracking-tighter uppercase">
                F9 <span class="text-white">MINISOCCER</span>
            </h1>
            <p class="text-gray-500 text-[8px] tracking-[0.3em] uppercase font-bold">Booking Ticket</p>
        </div>

        {{-- Body Padat --}}
        <div class="p-5 sm:p-6 relative">
            {{-- Watermark Lunas Kecil --}}
            <div class="absolute inset-0 flex items-center justify-center opacity-[0.04] pointer-events-none">
                <p class="text-6xl font-black border-8 border-green-600 text-green-600 p-2 transform -rotate-12 uppercase font-mono">LUNAS</p>
            </div>

            {{-- Info Utama --}}
            <div class="flex justify-between items-end mb-4 relative z-10 border-b border-gray-100 pb-3">
                <div class="max-w-[180px]">
                    <p class="text-gray-400 text-[8px] uppercase font-black tracking-widest mb-0.5 font-mono">Pelanggan</p>
                    <p class="font-black text-lg text-gray-800 leading-tight truncate font-sans">{{ $booking->user->name }}</p>
                </div>
                <div class="text-right">
                    <p class="text-gray-400 text-[8px] uppercase font-black tracking-widest mb-0.5 font-mono">ID</p>
                    <p class="font-mono font-black text-sm text-yellow-600">#F9{{ str_pad($booking->id, 4, '0', STR_PAD_LEFT) }}</p>
                </div>
            </div>

            {{-- Detail Tabel Padat --}}
            <div class="space-y-3 mb-4 relative z-10">
                <div class="flex justify-between items-center text-[11px]">
                    <span class="text-gray-400 font-bold uppercase font-mono tracking-tighter">Lapangan</span>
                    <span class="font-black text-gray-800 text-right">{{ $booking->field->name }}</span>
                </div>
                <div class="flex justify-between items-center text-[11px]">
                    <span class="text-gray-400 font-bold uppercase font-mono tracking-tighter">Tanggal</span>
                    <span class="font-black text-gray-800 text-right font-mono">{{ \Carbon\Carbon::parse($booking->start_time)->format('d/m/Y') }}</span>
                </div>
                <div class="flex justify-between items-center text-[11px]">
                    <span class="text-gray-400 font-bold uppercase font-mono tracking-tighter">Sesi Waktu</span>
                    <span class="font-black text-blue-600 text-right font-mono italic">{{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }}-{{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}</span>
                </div>
                
                {{-- Total Bayar Highlight --}}
                <div class="bg-gray-50 p-3 rounded-xl border border-gray-100 flex justify-between items-center mt-2">
                    <span class="text-gray-500 text-[9px] font-black uppercase font-mono">Total</span>
                    <span class="font-black text-base text-gray-900 tracking-tighter font-mono">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                </div>
            </div>

            {{-- Separator --}}
            <div class="relative h-px border-t-2 border-dashed border-gray-200 my-5">
                <div class="absolute -left-9 -top-3 w-6 h-6 bg-gray-900 rounded-full no-print shadow-inner"></div>
                <div class="absolute -right-9 -top-3 w-6 h-6 bg-gray-900 rounded-full no-print shadow-inner"></div>
            </div>

            {{-- QR Area Terkompresi --}}
            <div class="flex flex-col items-center">
                <div class="p-2.5 bg-white border border-gray-100 rounded-2xl shadow-sm">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data={{ $booking->id }}" 
                         alt="QR Code" 
                         class="w-24 h-24">
                </div>
                <p class="text-[7px] mt-4 font-mono font-bold uppercase tracking-[0.4em] text-gray-300">Verified by F9 Soccer</p>
            </div>
        </div>

        {{-- Footer Decor Padat --}}
        <div class="bg-yellow-500 h-2 w-full"></div>
    </div>

    {{-- Link Kembali --}}
    <div class="no-print mt-4">
        <a href="{{ route('my-bookings.index') }}" class="text-gray-500 hover:text-white text-[10px] font-black uppercase tracking-widest transition-all">
            ← Kembali
        </a>
    </div>

</body>
</html>