<div>
    <button 
        type="button"
        x-data
        x-on:click="
            Swal.fire({
                title: 'BATALKAN PESANAN?',
                text: 'Tindakan ini tidak dapat dibatalkan, Bos!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#1e293b',
                confirmButtonText: 'YA, BATALKAN!',
                cancelButtonText: 'TIDAK, KEMBALI',
                background: '#111827',
                color: '#fff',
                iconColor: '#ef4444',
                customClass: {
                    popup: 'border border-white/10 rounded-[2rem]',
                    confirmButton: 'rounded-xl font-black uppercase tracking-widest text-[10px] py-3 px-6',
                    cancelButton: 'rounded-xl font-black uppercase tracking-widest text-[10px] py-3 px-6'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $wire.cancel()
                }
            })
        "
        class="w-full text-center py-3 px-6 bg-red-600/10 hover:bg-red-600 text-red-500 hover:text-white border border-red-600/20 hover:border-red-600 rounded-xl font-black uppercase text-[10px] tracking-widest transition-all duration-300 flex items-center justify-center gap-2 group"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
        </svg>
        <span>Batalkan Pesanan</span>
    </button>
</div>

<script>
    window.addEventListener('swal:success', event => {
        Swal.fire({
            title: 'BERHASIL!',
            text: event.detail.message,
            icon: 'success',
            background: '#111827',
            color: '#fff',
            confirmButtonColor: '#d4af37',
            customClass: {
                popup: 'border border-white/10 rounded-[2rem]',
                confirmButton: 'rounded-xl font-black uppercase tracking-widest text-[10px] py-3 px-6'
            }
        });
    });
</script>