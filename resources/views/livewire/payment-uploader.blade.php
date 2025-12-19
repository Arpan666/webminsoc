<div class="space-y-4"> {{-- Gunakan space-y kecil agar rapat tapi rapi --}}

    {{-- 1. BAGIAN E-TICKET (Desain Ramping & Elegan) --}}
    @if(in_array($booking->status, ['success', 'confirmed', 'CONFIRMED', 'Dikonfirmasi']))
        <div class="bg-[#1a1c1e] border border-yellow-500/30 rounded-2xl overflow-hidden shadow-xl shadow-yellow-900/10">
            <div class="p-4 bg-gradient-to-r from-yellow-500/10 to-transparent">
                <div class="flex items-center gap-3 mb-3">
                    <div class="bg-yellow-500 p-2 rounded-lg shadow-lg">
                        <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-white font-black text-xs uppercase italic tracking-wider">E-Ticket Ready</h4>
                        <p class="text-gray-500 text-[9px]">Pembayaran Terverifikasi</p>
                    </div>
                </div>
                
                <a href="{{ route('booking.print', $booking->id) }}" target="_blank" 
                   class="flex items-center justify-center gap-2 w-full bg-white hover:bg-yellow-500 text-black font-black py-2.5 rounded-xl transition-all text-[11px] shadow-lg group">
                    <svg class="w-4 h-4 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 00-2 2h2m2 4h10a2 2 0 002-2v-4H5v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                    CETAK TIKET SEKARANG
                </a>
            </div>
        </div>
    @endif

    {{-- 2. BAGIAN BUKTI PEMBAYARAN --}}
    <div class="bg-[#1a1c1e] p-5 rounded-2xl border border-gray-800 shadow-2xl">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-[10px] font-bold text-gray-500 uppercase tracking-widest flex items-center gap-2">
                <svg class="w-3.5 h-3.5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Bukti Transfer
            </h3>
            @if($booking->payment_proof_path)
                <span class="px-2 py-0.5 rounded-md text-[8px] font-black uppercase bg-green-500/10 text-green-500 border border-green-500/20">
                    {{ str_replace('_', ' ', $booking->status) }}
                </span>
            @endif
        </div>

        @if ($uploadSuccess || $booking->payment_proof_path)
            <div class="space-y-4">
                {{-- Preview Foto Bukti --}}
                <div class="relative group aspect-video rounded-xl overflow-hidden border border-gray-800 bg-black/40">
                    <img src="{{ asset('storage/' . $booking->payment_proof_path) }}" 
                         class="w-full h-full object-cover opacity-60 group-hover:opacity-100 transition-opacity" alt="Bukti">
                    <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                        <span class="text-[8px] text-gray-500 font-bold uppercase bg-black/60 px-2 py-1 rounded border border-gray-700">Bukti Terlampir</span>
                    </div>
                </div>

                <a href="{{ url('/my-bookings') }}" class="flex items-center justify-center gap-2 w-full text-[10px] text-gray-500 hover:text-white transition-colors">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Riwayat
                </a>
            </div>
        @else
            {{-- Form Upload (Jika belum ada bukti) --}}
            <form wire:submit.prevent="save" class="space-y-4">
                <div class="relative group">
                    <input type="file" wire:model="paymentProof" id="file-upload" class="hidden" accept="image/*">
                    <label for="file-upload" class="flex flex-col items-center justify-center w-full min-h-[120px] border-2 border-dashed border-gray-700 rounded-xl cursor-pointer bg-black/20 hover:border-yellow-500/50 transition-all text-center p-4">
                        @if ($paymentProof)
                            <img src="{{ $paymentProof->temporaryUrl() }}" class="max-h-24 rounded-lg shadow-xl">
                        @else
                            <svg class="w-8 h-8 text-gray-700 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <p class="text-[10px] text-gray-500">Klik untuk pilih foto bukti</p>
                        @endif
                    </label>
                </div>

                <button type="submit" 
                    class="w-full bg-yellow-500 hover:bg-yellow-400 text-black font-black py-3 rounded-xl shadow-lg transition-all active:scale-95 text-[11px]"
                    wire:loading.attr="disabled" wire:target="paymentProof">
                    <span wire:loading.remove wire:target="save">KIRIM BUKTI SEKARANG</span>
                    <span wire:loading wire:target="save">MEMPROSES...</span>
                </button>
            </form>
        @endif
    </div>
</div>