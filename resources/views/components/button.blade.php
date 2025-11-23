@props(['type' => 'button', 'color' => 'primary'])

@php
    $base = 'inline-flex items-center justify-center px-4 py-2 font-semibold rounded-lg shadow-md transition duration-150';
    $colors = match($color) {
        'primary' => 'bg-red-600 text-white hover:bg-red-700',
        'secondary' => 'bg-gray-200 text-gray-800 hover:bg-gray-300',
        'danger' => 'bg-red-500 text-white hover:bg-red-600',
        default => 'bg-gray-100 text-gray-800 hover:bg-gray-200',
    };
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => "$base $colors"]) }}>
    {{ $slot }}
</button>
