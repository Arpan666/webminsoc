{{-- File: resources/views/layouts/navigation.blade.php --}}
@php
    // Menggunakan Route::has untuk menghindari error jika rute belum terdaftar
    use Illuminate\Support\Facades\Route;
    $homeRoute = Route::has('welcome') ? route('welcome') : '/';
    $loginRoute = Route::has('login') ? route('login') : '/login';
    $myBookingsRoute = Route::has('my-bookings') ? route('my-bookings') : '#'; 
    $aboutRoute = Route::has('about-us') ? route('about-us') : '#'; 
    $contactRoute = Route::has('contact-us') ? route('contact-us') : '#'; 
    // Tambahkan variabel untuk rute Location
    $locationRoute = Route::has('location') ? route('location') : '#'; 
@endphp

<nav x-data="{ open: false }" 
     class="bg-dark-card border-b border-neon-green/30 fixed top-0 w-full z-20 
            shadow-xl shadow-black/50 backdrop-blur-sm transition duration-300">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ $homeRoute }}">
                        <span class="text-3xl font-extrabold text-neon-green tracking-widest uppercase">
                            MINI<span class="text-white">SOCCER</span>
                        </span>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex items-center">
                    
                    {{-- Item 1: Home --}}
                    <a href="{{ $homeRoute }}" 
                       class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-semibold leading-5 text-white hover:text-neon-green hover:border-neon-green/50 focus:outline-none focus:text-neon-green focus:border-neon-green transition duration-300 uppercase tracking-wider">
                        {{ __('Home') }}
                    </a>

                    {{-- Item 2: Lapangan (Anchor ke Section Lapangan di Home) --}}
                    <a href="{{ $homeRoute }}#lapangan" 
                       class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-semibold leading-5 text-white hover:text-neon-green hover:border-neon-green/50 focus:outline-none focus:text-neon-green focus:border-neon-green transition duration-300 uppercase tracking-wider">
                        {{ __('Lapangan') }}
                    </a>

                    {{-- Item 3: Location (BARU DITAMBAHKAN) --}}
                    <a href="{{ $locationRoute }}" 
                       class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-semibold leading-5 text-white hover:text-neon-green hover:border-neon-green/50 focus:outline-none focus:text-neon-green focus:border-neon-green transition duration-300 uppercase tracking-wider">
                        {{ __('Location') }}
                    </a>
                    
                    {{-- Item 4: My Bookings --}}
                    @auth
                        <a href="{{ $myBookingsRoute }}" 
                            class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-semibold leading-5 text-white hover:text-neon-green hover:border-neon-green/50 focus:outline-none focus:text-neon-green focus:border-neon-green transition duration-300 uppercase tracking-wider">
                            {{ __('Pemesanan Saya') }}
                        </a>
                    @endauth
                    
                    {{-- Item 5: About Us --}}
                    <a href="{{ $aboutRoute }}" 
                       class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-semibold leading-5 text-white hover:text-neon-green hover:border-neon-green/50 focus:outline-none focus:text-neon-green focus:border-neon-green transition duration-300 uppercase tracking-wider">
                        {{ __('About Us') }}
                    </a>

                    {{-- Item 6: Contact Us --}}
                    <a href="{{ $contactRoute }}" 
                       class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-semibold leading-5 text-white hover:text-neon-green hover:border-neon-green/50 focus:outline-none focus:text-neon-green focus:border-neon-green transition duration-300 uppercase tracking-wider">
                        {{ __('Contact Us') }}
                    </a>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @guest
                    <a href="{{ $loginRoute }}" 
                       class="py-2 px-5 bg-neon-green text-dark-bg rounded-full font-bold uppercase text-sm tracking-wider 
                              hover:bg-neon-light transition duration-300 transform hover:scale-105 shadow-neon">
                        Login / Register
                    </a>
                @endguest

                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-neon-green hover:text-white focus:outline-none transition duration-150 ease-in-out">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit') ?? '#'" class="text-dark-bg hover:bg-gray-200">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="text-dark-bg hover:bg-gray-200">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth
            </div>
            
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-neon-green hover:text-white hover:bg-dark-bg/50 focus:outline-none focus:bg-dark-bg/70 focus:text-white transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-dark-card border-t border-neon-green/30">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ $homeRoute }}" :active="request()->routeIs('welcome')" class="text-white hover:text-neon-green">
                {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ $homeRoute }}#lapangan" :active="false" class="text-white hover:text-neon-green">
                {{ __('Lapangan') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ $locationRoute }}" :active="false" class="text-white hover:text-neon-green">
                {{ __('Location') }}
            </x-responsive-nav-link>
            @auth
                <x-responsive-nav-link href="{{ $myBookingsRoute }}" :active="false" class="text-white hover:text-neon-green">
                    {{ __('Pemesanan Saya') }}
                </x-responsive-nav-link>
            @endauth
            <x-responsive-nav-link href="{{ $aboutRoute }}" :active="false" class="text-white hover:text-neon-green">
                {{ __('About Us') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ $contactRoute }}" :active="false" class="text-white hover:text-neon-green">
                {{ __('Contact Us') }}
            </x-responsive-nav-link>
        </div>

        @auth
        <div class="pt-4 pb-1 border-t border-gray-700">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-neon-green">{{ Auth::user()->email }}</div>
            </div>
            
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit') ?? '#'" class="text-white hover:text-neon-green">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="text-white hover:text-neon-green">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
        @endauth
        
        @guest
            <div class="p-4 border-t border-gray-700">
                 <a href="{{ $loginRoute }}" 
                    class="block w-full text-center py-2 bg-neon-green text-dark-bg rounded-full font-bold uppercase text-sm tracking-wider 
                           hover:bg-neon-light transition duration-300">
                    Login / Register
                </a>
            </div>
        @endguest
    </div>
</nav>w