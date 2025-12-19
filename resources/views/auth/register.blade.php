<x-guest-layout>
    <div class="min-h-screen flex flex-col items-center justify-center bg-[#0f1012] px-4">
        
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-black text-yellow-500 italic tracking-tighter">F9<span class="text-white">MINISOCCER</span></h1>
            <p class="text-gray-500 text-xs uppercase tracking-[0.3em] mt-1">Join the Club</p>
        </div>

        <div class="w-full max-w-md bg-[#1a1c1e] border border-gray-800 p-8 rounded-3xl shadow-2xl relative overflow-hidden">
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-yellow-500/10 blur-3xl rounded-full"></div>

            <h2 class="text-xl font-bold text-white mb-6">Buat Akun Baru</h2>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-gray-500 text-[10px] font-bold uppercase tracking-widest mb-2 ml-1">Nama Lengkap</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </span>
                        <input type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Masukkan nama Anda"
                            class="w-full bg-[#0f1012] border border-gray-800 text-white text-sm rounded-xl py-3 pl-11 pr-4 focus:ring-1 focus:ring-yellow-500 focus:border-yellow-500 transition-all outline-none">
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-1" />
                </div>

                <div>
                    <label class="block text-gray-500 text-[10px] font-bold uppercase tracking-widest mb-2 ml-1">Alamat Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </span>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="email@contoh.com"
                            class="w-full bg-[#0f1012] border border-gray-800 text-white text-sm rounded-xl py-3 pl-11 pr-4 focus:ring-1 focus:ring-yellow-500 focus:border-yellow-500 transition-all outline-none">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <div>
                    <label class="block text-gray-500 text-[10px] font-bold uppercase tracking-widest mb-2 ml-1">Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </span>
                        <input type="password" name="password" required placeholder="••••••••"
                            class="w-full bg-[#0f1012] border border-gray-800 text-white text-sm rounded-xl py-3 pl-11 pr-4 focus:ring-1 focus:ring-yellow-500 focus:border-yellow-500 transition-all outline-none">
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                <div>
                    <label class="block text-gray-500 text-[10px] font-bold uppercase tracking-widest mb-2 ml-1">Konfirmasi Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </span>
                        <input type="password" name="password_confirmation" required placeholder="••••••••"
                            class="w-full bg-[#0f1012] border border-gray-800 text-white text-sm rounded-xl py-3 pl-11 pr-4 focus:ring-1 focus:ring-yellow-500 focus:border-yellow-500 transition-all outline-none">
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-400 text-black font-black py-3 rounded-xl shadow-lg shadow-yellow-900/20 transition-all transform active:scale-95">
                        DAFTAR SEKARANG
                    </button>
                </div>

                <div class="text-center mt-4">
                    <p class="text-gray-500 text-xs">Sudah punya akun? 
                        <a href="{{ route('login') }}" class="text-yellow-500 font-bold hover:underline">Masuk di sini</a>
                    </p>
                </div>
            </form>
        </div>
        
        <p class="mt-8 text-gray-600 text-[10px] uppercase tracking-widest font-medium">&copy; 2025 F9 Minisoccer Indonesia</p>
    </div>
</x-guest-layout>