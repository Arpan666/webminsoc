@props(['variant' => 'default', 'class' => ''])

@php
    $classes = match($variant) {
        'success' => 'bg-green-100 text-green-800 border-green-300',
        'warning' => 'bg-yellow-100 text-yellow-800 border-yellow-300',
        'danger' => 'bg-red-100 text-red-800 border-red-300',
        'muted' => 'bg-gray-100 text-gray-600 border-gray-300',
        default => 'bg-gray-100 text-gray-700 border-gray-300',
    };
@endphp

<span {{ $attributes->merge(['class' => "px-3 py-1 text-sm font-semibold rounded-full border {$classes} {$class}"]) }}>
    {{ $slot }}
</span>
