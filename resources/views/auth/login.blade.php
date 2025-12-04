<x-guest-layout>
    
    {{-- CATATAN: Semua div luar seperti min-h-screen, Logo, dan card container telah dihapus.
         Konten ini akan dimasukkan langsung ke dalam card container di guest.blade.php. --}}

    <div class="w-full h-full 
                transform transition-all duration-500 hover:shadow-accent-gold/40">
        
        <div class="text-center mb-10">
            <h1 class="text-5xl font-extrabold text-accent-gold tracking-widest uppercase mb-1 drop-shadow-lg drop-shadow-accent-gold/50">
                MASUK
            </h1>
            <p class="text-gray-400 text-sm">Akses cepat untuk memesan slot lapangan Anda.</p>
        </div>

        <x-auth-session-status class="mb-4 text-accent-gold" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address - Gaya Modern: Bottom Border Only -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-gray-300" />
                <x-text-input id="email" 
                              class="block mt-1 w-full bg-dark-bg border-0 border-b border-gray-600 text-white rounded-none py-3
                                     focus:border-accent-gold focus:ring-0 focus:border-b-2 transition duration-300" 
                              type="email" 
                              name="email" 
                              :value="old('email')" 
                              required 
                              autofocus 
                              autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password - Gaya Modern: Bottom Border Only -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" class="text-gray-300" />

                <x-text-input id="password" 
                              class="block mt-1 w-full bg-dark-bg border-0 border-b border-gray-600 text-white rounded-none py-3
                                     focus:border-accent-gold focus:ring-0 focus:border-b-2 transition duration-300"
                              type="password"
                              name="password"
                              required 
                              autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center group">
                    <input id="remember_me" 
                           type="checkbox" 
                           class="rounded-sm border-gray-700 text-accent-gold bg-dark-bg shadow-sm 
                                  focus:ring-accent-gold focus:ring-offset-dark-card transition duration-300" 
                           name="remember">
                    <span class="ms-2 text-sm text-gray-400 group-hover:text-white transition duration-300">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-between mt-8 pt-4 border-t border-gray-700">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-400 hover:text-accent-gold transition duration-300
                              rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-accent-gold focus:ring-offset-dark-card" 
                       href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                {{-- Tombol Login: Besar, Bold, dan Rounded-Full --}}
                <x-primary-button class="ms-4 px-8 py-3 bg-accent-gold hover:bg-yellow-400 
                                         text-dark-bg font-black uppercase tracking-widest rounded-full 
                                         shadow-xl shadow-accent-gold/30 transition ease-in-out duration-300 
                                         transform hover:scale-105">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>

            <!-- Link to Register Page -->
            @if (Route::has('register'))
                <div class="text-center mt-6 text-sm text-gray-400">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="underline text-accent-gold hover:text-yellow-400 font-bold transition duration-300">
                        Daftar Sekarang
                    </a>
                </div>
            @endif
        </form>
    </div>
</x-guest-layout>