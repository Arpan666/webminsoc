@php
    use Illuminate\Support\Facades\Route;
    $homeRoute = Route::has('welcome') ? route('welcome') : '/';
    $loginRoute = Route::has('login') ? route('login') : '/login';
    $myBookingsRoute = Route::has('my-bookings.index') ? route('my-bookings.index') : '#'; 
    $aboutRoute = Route::has('about-us') ? route('about-us') : '#'; 
    $contactRoute = Route::has('contact-us') ? route('contact-us') : '#'; 
    $locationRoute = Route::has('location') ? route('location') : '#'; 
@endphp

<nav x-data="{ open: false }" class="bg-dark-card border-b border-accent-gold/50 fixed top-0 w-full z-20 shadow-xl shadow-black/50 backdrop-blur-sm transition duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ $homeRoute }}">
                        <span class="text-3xl font-extrabold text-accent-gold tracking-widest uppercase">
                           F9 MINI<span class="text-white">SOCCER</span>
                        </span>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex items-center">
                    <a href="{{ $homeRoute }}" class="nav-link">{{ __('Home') }}</a>
                    <a href="{{ $homeRoute }}#lapangan" class="nav-link">{{ __('Lapangan') }}</a>
                    <a href="{{ $locationRoute }}" class="nav-link">{{ __('Location') }}</a>
                    <a href="{{ $aboutRoute }}" class="nav-link">{{ __('About Us') }}</a>
                    <a href="{{ $contactRoute }}" class="nav-link">{{ __('Contact Us') }}</a>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @guest
                    <a href="{{ $loginRoute }}" class="py-2 px-5 bg-accent-gold text-dark-bg rounded-full font-bold uppercase text-sm tracking-wider hover:bg-accent-light transition duration-300 transform hover:scale-105 shadow-md">
                        {{ __('Login / Register') }}
                    </a>
                @endguest

                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-accent-gold hover:text-white focus:outline-none transition duration-150 ease-in-out">
                                <div>{{ Auth::user()->name }}</div>
                                <svg class="fill-current h-4 w-4 ms-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit') ?? '#'" class="text-dark-bg hover:bg-gray-200">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="$myBookingsRoute" class="text-dark-bg hover:bg-gray-200">
                                {{ __('Riwayat Booking') }}
                            </x-dropdown-link>
                            <div class="border-t border-gray-200 dark:border-gray-600"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-dark-bg hover:bg-gray-200">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-accent-gold hover:text-white hover:bg-dark-bg/50 focus:outline-none focus:bg-dark-bg/70 focus:text-white transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden bg-dark-card border-t border-accent-gold/50">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ $homeRoute }}" :active="request()->routeIs('welcome')" class="text-white hover:text-accent-gold">
                {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ $homeRoute }}#lapangan" :active="false" class="text-white hover:text-accent-gold">
                {{ __('Lapangan') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ $locationRoute }}" :active="false" class="text-white hover:text-accent-gold">
                {{ __('Location') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ $aboutRoute }}" :active="request()->routeIs('about-us')" class="text-white hover:text-accent-gold">
                {{ __('About Us') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ $contactRoute }}" :active="request()->routeIs('contact-us')" class="text-white hover:text-accent-gold">
                {{ __('Contact Us') }}
            </x-responsive-nav-link>
        </div>

        @auth
        <div class="pt-4 pb-1 border-t border-gray-700">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-accent-gold">{{ Auth::user()->email }}</div>
            </div>
            
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit') ?? '#'" :active="request()->routeIs('profile.edit')" class="text-white hover:text-accent-gold">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="$myBookingsRoute" :active="request()->routeIs('my-bookings.index')" class="text-white hover:text-accent-gold">
                    {{ __('Riwayat Booking') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                                           onclick="event.preventDefault(); this.closest('form').submit();"
                                           class="text-white hover:text-accent-gold">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
        @endauth

        @guest
            <div class="p-4 border-t border-gray-700">
                <a href="{{ $loginRoute }}" class="block w-full text-center py-2 bg-accent-gold text-dark-bg rounded-full font-bold uppercase text-sm tracking-wider hover:bg-accent-light transition duration-300">
                    {{ __('Login / Register') }}
                </a>
            </div>
        @endguest
    </div>
</nav>

<style>
    .nav-link {
        @apply inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-semibold leading-5 text-white hover:text-accent-gold hover:border-accent-gold/50 focus:outline-none focus:text-accent-gold focus:border-accent-gold transition duration-300 uppercase tracking-wider;
    }
</style>