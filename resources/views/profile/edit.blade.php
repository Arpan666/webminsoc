<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile | F9 Minisoccer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'dark-bg': '#101010',
                        'dark-card': '#1C1C1C',
                        'accent-gold': '#FFC300',
                    }
                }
            }
        }
    </script>

    <style>
        body { font-family: 'Inter', sans-serif; }
        .shadow-gold-premium {
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5), 0 0 15px rgba(255, 195, 0, 0.05);
        }
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #101010; }
        ::-webkit-scrollbar-thumb { background: #333; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #FFC300; }
    </style>
</head>
<body class="bg-dark-bg min-h-screen text-gray-200 antialiased">

    {{-- Header / Navbar Style --}}
    <header class="fixed top-0 w-full z-50 bg-dark-bg/80 backdrop-blur-xl border-b border-white/5">
        <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <h2 class="font-black text-xl uppercase tracking-[0.3em] text-accent-gold">
                Profil <span class="text-white">User</span>
            </h2>

            <button onclick="history.back()" 
                    class="group flex items-center gap-2 px-4 py-2 bg-white/5 text-gray-400 font-black text-[10px] uppercase tracking-widest rounded-xl border border-white/5 hover:border-accent-gold/50 hover:text-accent-gold transition-all duration-300">
                <svg class="h-4 w-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </button>
        </div>
    </header>

    <div class="pt-32 pb-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

            {{-- SECTION 1: INFORMASI PROFIL --}}
            <div class="bg-dark-card shadow-gold-premium rounded-[2.5rem] p-8 md:p-10 border border-white/5 relative overflow-hidden group">
                <div class="absolute -right-20 -top-20 w-64 h-64 bg-accent-gold/5 rounded-full blur-[100px] group-hover:bg-accent-gold/10 transition-colors duration-500"></div>
                
                <div class="relative z-10">
                    <header class="mb-8 flex items-center gap-4">
                        <div class="p-3 bg-accent-gold/10 rounded-2xl">
                            <svg class="w-6 h-6 text-accent-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-black uppercase tracking-widest text-white">Informasi Profil</h2>
                            <p class="text-xs text-gray-500 mt-1 uppercase tracking-tighter">Perbarui identitas akun Anda secara berkala.</p>
                        </div>
                    </header>

                    <form class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500 ml-1">Nama Lengkap</label>
                                <input type="text" value="Nama Pengguna" class="w-full bg-dark-bg border border-white/10 rounded-2xl px-5 py-4 text-sm text-white focus:outline-none focus:border-accent-gold transition-all duration-300 shadow-inner">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500 ml-1">Alamat Email</label>
                                <input type="email" value="user@example.com" class="w-full bg-dark-bg border border-white/10 rounded-2xl px-5 py-4 text-sm text-white focus:outline-none focus:border-accent-gold transition-all duration-300 shadow-inner">
                            </div>
                        </div>

                        <div class="flex items-center gap-4 pt-4">
                            <button type="submit" class="px-8 py-4 bg-accent-gold text-dark-bg font-black uppercase text-[10px] tracking-widest rounded-2xl shadow-[0_10px_30px_rgba(255,195,0,0.2)] hover:shadow-accent-gold/40 hover:-translate-y-1 transition-all duration-300">
                                Simpan Perubahan
                            </button>
                            <span class="text-[10px] font-bold text-green-500 uppercase tracking-widest animate-pulse">✓ Tersimpan</span>
                        </div>
                    </form>
                </div>
            </div>

            {{-- SECTION 2: UPDATE PASSWORD --}}
            <div class="bg-dark-card shadow-gold-premium rounded-[2.5rem] p-8 md:p-10 border border-white/5 relative overflow-hidden group">
                <div class="relative z-10">
                    <header class="mb-8 flex items-center gap-4">
                        <div class="p-3 bg-accent-gold/10 rounded-2xl">
                            <svg class="w-6 h-6 text-accent-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-black uppercase tracking-widest text-white">Keamanan Akun</h2>
                            <p class="text-xs text-gray-500 mt-1 uppercase tracking-tighter">Gunakan kombinasi password yang kuat dan unik.</p>
                        </div>
                    </header>

                    <form class="space-y-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500 ml-1">Kata Sandi Saat Ini</label>
                            <input type="password" class="w-full bg-dark-bg border border-white/10 rounded-2xl px-5 py-4 text-sm text-white focus:outline-none focus:border-accent-gold transition-all">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500 ml-1">Kata Sandi Baru</label>
                                <input type="password" class="w-full bg-dark-bg border border-white/10 rounded-2xl px-5 py-4 text-sm text-white focus:outline-none focus:border-accent-gold transition-all">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500 ml-1">Konfirmasi Sandi</label>
                                <input type="password" class="w-full bg-dark-bg border border-white/10 rounded-2xl px-5 py-4 text-sm text-white focus:outline-none focus:border-accent-gold transition-all">
                            </div>
                        </div>

                        <div class="pt-4">
                            <button type="submit" class="px-8 py-4 bg-white/5 text-white border border-white/10 font-black uppercase text-[10px] tracking-widest rounded-2xl hover:bg-white/10 hover:border-accent-gold transition-all duration-300">
                                Perbarui Kata Sandi
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- SECTION 3: DELETE ACCOUNT --}}
            <div class="bg-dark-card rounded-[2.5rem] p-8 md:p-10 border border-red-500/20 relative overflow-hidden group">
                <div class="absolute inset-0 bg-red-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                
                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div>
                        <h2 class="text-lg font-black uppercase tracking-widest text-red-500">Hapus Akun</h2>
                        <p class="text-xs text-gray-500 mt-2 max-w-xl leading-relaxed">
                            Setelah akun dihapus, semua riwayat booking dan data Anda akan hilang secara permanen. Tindakan ini tidak dapat dibatalkan.
                        </p>
                    </div>

                    <button onclick="document.getElementById('delete-modal').classList.remove('hidden')" 
                            class="px-8 py-4 bg-red-600/10 text-red-500 border border-red-600/20 font-black uppercase text-[10px] tracking-widest rounded-2xl hover:bg-red-600 hover:text-white transition-all duration-300 whitespace-nowrap">
                        Hapus Akun Saya
                    </button>
                </div>
            </div>

            {{-- MODAL DELETE --}}
            <div id="delete-modal" class="hidden fixed inset-0 bg-dark-bg/95 backdrop-blur-md flex items-center justify-center p-4 z-[100]">
                <div class="bg-dark-card rounded-[3rem] p-10 w-full max-w-md shadow-2xl border border-red-600/30 text-center">
                    <div class="w-20 h-20 bg-red-600/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <h3 class="text-xl font-black text-white uppercase tracking-widest">Konfirmasi Hapus</h3>
                    <p class="mt-4 text-sm text-gray-400 leading-relaxed">
                        Bos, Anda yakin mau pergi? Semua data akan dihapus secara permanen dari server kami.
                    </p>
                    <div class="mt-10 flex flex-col gap-3">
                        <button onclick="alert('Proses Penghapusan...')" class="w-full py-4 bg-red-600 text-white font-black uppercase text-[10px] tracking-widest rounded-2xl hover:bg-red-700 transition shadow-lg shadow-red-600/20">
                            Ya, Hapus Sekarang
                        </button>
                        <button onclick="document.getElementById('delete-modal').classList.add('hidden')" class="w-full py-4 bg-white/5 text-gray-400 font-black uppercase text-[10px] tracking-widest rounded-2xl hover:text-white transition">
                            Batal
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>
</html>