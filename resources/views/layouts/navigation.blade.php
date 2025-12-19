@php
    use Illuminate\Support\Facades\Route;
    // Definisi Route agar aman jika route belum dibuat
    $homeRoute = Route::has('welcome') ? route('welcome') : '/';
    $loginRoute = Route::has('login') ? route('login') : '/login';
    $myBookingsRoute = Route::has('my-bookings.index') ? route('my-bookings.index') : '#'; 
    $aboutRoute = Route::has('about-us') ? route('about-us') : '#'; 
    $contactRoute = Route::has('contact-us') ? route('contact-us') : '#'; 
    $locationRoute = Route::has('location') ? route('location') : '#'; 
@endphp

<nav x-data="{ open: false, atTop: true }" 
     @scroll.window="atTop = (window.pageYOffset > 40 ? false : true)"
     {{-- PERBAIKAN: Memberikan background gelap tipis saat di top agar tidak ketimpa foto --}}
     :class="{ 
        'bg-dark-card/95 backdrop-blur-md shadow-2xl border-white/10': !atTop, 
        'bg-black/40 backdrop-blur-sm border-transparent': atTop 
     }"
     class="fixed top-0 w-full z-[9999] transition-all duration-500 border-b">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            
            {{-- Bagian Kiri: Logo & Navigasi Desktop --}}
            <div class="flex items-center shrink-0">
                <a href="{{ $homeRoute }}" class="flex items-center">
                    <span class="text-xl md:text-2xl font-black text-accent-gold tracking-tighter uppercase">
                        F9<span class="text-white">MINI</span>SOCCER
                    </span>
                </a>

                {{-- Desktop Menu --}}
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex items-center">
                    <a href="{{ $homeRoute }}" class="nav-link">Home</a>
                    <a href="{{ $homeRoute }}#lapangan" class="nav-link">Lapangan</a>
                    <a href="{{ $locationRoute }}" class="nav-link">Location</a>
                    <a href="{{ $aboutRoute }}" class="nav-link">About Us</a>
                    <a href="{{ $contactRoute }}" class="nav-link">Contact</a>
                </div>
            </div>

            {{-- Bagian Kanan: Auth Dropdown / Login Button --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @guest
                    <a href="{{ $loginRoute }}" class="py-2.5 px-8 bg-accent-gold text-dark-bg rounded-full font-black uppercase text-[10px] tracking-widest hover:shadow-[0_0_20px_rgba(212,175,55,0.4)] transition-all duration-300 transform hover:scale-105">
                        Login / Register
                    </a>
                @endguest

                @auth
                    <x-dropdown align="right" width="56">
                        <x-slot name="trigger">
                            <button class="flex items-center px-4 py-2 rounded-xl border border-white/10 bg-white/5 text-sm font-bold text-white hover:border-accent-gold/50 transition duration-300 group">
                                <div class="w-2 h-2 rounded-full bg-accent-gold animate-pulse me-3"></div>
                                <span class="group-hover:text-accent-gold transition-colors uppercase tracking-widest text-[11px]">{{ Auth::user()->name }}</span>
                                <svg class="fill-current h-4 w-4 ms-2 text-accent-gold transition-transform group-hover:rotate-180" viewBox="0 0 20 20">
                                    <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="bg-dark-card border border-white/10 rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.5)] overflow-hidden p-1.5 min-w-[200px]">
                                
                                <x-dropdown-link :href="route('profile.edit')" 
                                    class="!flex items-center w-full px-4 py-3 text-[11px] font-bold uppercase tracking-widest !text-white hover:!bg-accent-gold hover:!text-dark-bg rounded-xl transition-all duration-200 border-none">
                                    <svg class="w-4 h-4 me-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    {{ __('Profile') }}
                                </x-dropdown-link>
                                
                                <x-dropdown-link :href="$myBookingsRoute" 
                                    class="!flex items-center w-full px-4 py-3 text-[11px] font-bold uppercase tracking-widest !text-white hover:!bg-accent-gold hover:!text-dark-bg rounded-xl transition-all duration-200 border-none mt-1">
                                    <svg class="w-4 h-4 me-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                    {{ __('Riwayat Booking') }}
                                </x-dropdown-link>

                                <div class="border-t border-white/5 my-1.5 mx-2"></div>

                                <form method="POST" action="{{ route('logout') }}" class="m-0">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')" 
                                        onclick="event.preventDefault(); this.closest('form').submit();" 
                                        class="!flex items-center w-full px-4 py-3 text-[11px] font-bold uppercase tracking-widest !text-red-500 hover:!bg-red-500/10 rounded-xl transition-all duration-200 border-none">
                                        <svg class="w-4 h-4 me-3 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </div>
                        </x-slot>
                    </x-dropdown>
                @endauth
            </div>

            {{-- Hamburger Menu (Mobile) --}}
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = !open" class="p-2 rounded-lg text-accent-gold hover:bg-white/5 transition-colors">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu Dropdown --}}
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="sm:hidden bg-dark-card/98 backdrop-blur-xl border-t border-white/10 shadow-2xl">
        <div class="pt-4 pb-6 space-y-2 px-4">
            <x-responsive-nav-link href="{{ $homeRoute }}" class="mobile-nav-link">Home</x-responsive-nav-link>
            <x-responsive-nav-link href="{{ $homeRoute }}#lapangan" class="mobile-nav-link">Lapangan</x-responsive-nav-link>
            <x-responsive-nav-link href="{{ $locationRoute }}" class="mobile-nav-link">Location</x-responsive-nav-link>
            
            @auth
                <div class="border-t border-white/10 my-4 pt-4">
                    <p class="text-[10px] text-accent-gold font-bold uppercase tracking-widest mb-4 px-4">Akun Saya</p>
                    <x-responsive-nav-link :href="route('profile.edit')" class="mobile-nav-link italic">Profile</x-responsive-nav-link>
                    <x-responsive-nav-link :href="$myBookingsRoute" class="mobile-nav-link italic">Riwayat Booking</x-responsive-nav-link>
                </div>
            @endauth
        </div>
    </div>
</nav>

<style>
    .nav-link {
        @apply relative inline-flex items-center px-1 pt-1 text-[11px] font-bold uppercase tracking-widest text-white hover:text-accent-gold transition-all duration-300;
        text-decoration: none !important;
    }

    .nav-link::after {
        content: "";
        @apply absolute bottom-0 left-0 w-0 h-[2px] bg-accent-gold transition-all duration-300;
    }

    .nav-link:hover::after {
        @apply w-full;
    }

    /* Memaksa navbar berada di layer paling atas */
    nav {
        z-index: 9999 !important;
    }
</style>