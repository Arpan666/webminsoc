<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Lapangan') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-900 min-h-screen">
        @livewire('booking-calendar', ['field' => $field])
    </div>
</x-app-layout>