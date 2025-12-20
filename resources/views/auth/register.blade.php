<x-guest-layout>
    <div class="w-full h-full transform transition-all duration-500">
        
        {{-- Header Section --}}
        <div class="text-center mb-10 relative">
            {{-- Efek Cahaya Belakang Judul --}}
            <div class="absolute inset-0 bg-accent-gold/10 blur-[50px] rounded-full -z-10 h-20 w-40 mx-auto"></div>
            
            <h1 class="text-5xl font-black text-accent-gold tracking-[0.2em] uppercase mb-2 drop-shadow-[0_5px_15px_rgba(255,195,0,0.4)]">
                DAFTAR
            </h1>
            <p class="text-[10px] font-black text-gray-500 uppercase tracking-[0.3em]">
                F9 Minisoccer <span class="text-accent-gold">Elite Member</span>
            </p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            {{-- Name --}}
            <div class="group">
                <label for="name" class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500 group-focus-within:text-accent-gold transition-colors duration-300 ml-1">
                    {{ __('Full Name') }}
                </label>
                <div class="relative">
                    <input id="name" 
                           type="text" 
                           name="name" 
                           :value="old('name')" 
                           required 
                           autofocus 
                           autocomplete="name"
                           class="block mt-1 w-full bg-dark-bg/50 border-0 border-b-2 border-white/10 text-white rounded-none py-4 px-1
                                  focus:border-accent-gold focus:ring-0 transition-all duration-500 placeholder-gray-700 shadow-inner"
                           placeholder="Nama Lengkap Anda" />
                </div>
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-[10px] font-bold uppercase tracking-widest text-red-500" />
            </div>

            {{-- Email Address --}}
            <div class="group">
                <label for="email" class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500 group-focus-within:text-accent-gold transition-colors duration-300 ml-1">
                    {{ __('Email Address') }}
                </label>
                <div class="relative">
                    <input id="email" 
                           type="email" 
                           name="email" 
                           :value="old('email')" 
                           required 
                           autocomplete="username"
                           class="block mt-1 w-full bg-dark-bg/50 border-0 border-b-2 border-white/10 text-white rounded-none py-4 px-1
                                  focus:border-accent-gold focus:ring-0 transition-all duration-500 placeholder-gray-700 shadow-inner"
                           placeholder="yourname@email.com" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-[10px] font-bold uppercase tracking-widest text-red-500" />
            </div>

            {{-- Password --}}
            <div class="group">
                <label for="password" class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500 group-focus-within:text-accent-gold transition-colors duration-300 ml-1">
                    {{ __('Password') }}
                </label>
                <div class="relative">
                    <input id="password" 
                           type="password"
                           name="password"
                           required 
                           autocomplete="new-password"
                           class="block mt-1 w-full bg-dark-bg/50 border-0 border-b-2 border-white/10 text-white rounded-none py-4 px-1
                                  focus:border-accent-gold focus:ring-0 transition-all duration-500 placeholder-gray-700 shadow-inner"
                           placeholder="••••••••" />
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-[10px] font-bold uppercase tracking-widest text-red-500" />
            </div>

            {{-- Confirm Password --}}
            <div class="group">
                <label for="password_confirmation" class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500 group-focus-within:text-accent-gold transition-colors duration-300 ml-1">
                    {{ __('Confirm Password') }}
                </label>
                <div class="relative">
                    <input id="password_confirmation" 
                           type="password"
                           name="password_confirmation" 
                           required 
                           autocomplete="new-password"
                           class="block mt-1 w-full bg-dark-bg/50 border-0 border-b-2 border-white/10 text-white rounded-none py-4 px-1
                                  focus:border-accent-gold focus:ring-0 transition-all duration-500 placeholder-gray-700 shadow-inner"
                           placeholder="••••••••" />
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-[10px] font-bold uppercase tracking-widest text-red-500" />
            </div>

            {{-- Tombol Register --}}
            <div class="pt-4">
                <button type="submit" 
                        class="w-full py-4 bg-accent-gold text-dark-bg font-black uppercase tracking-[0.3em] text-[11px] rounded-2xl
                               shadow-[0_15px_30px_rgba(255,195,0,0.2)] hover:shadow-accent-gold/40 hover:-translate-y-1 active:scale-95 transition-all duration-300">
                    {{ __('Gabung Sekarang') }}
                </button>
            </div>

            <div class="text-center mt-8">
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-600">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="text-accent-gold hover:text-white transition-colors ml-1 underline decoration-2 underline-offset-4">
                        Masuk
                    </a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>