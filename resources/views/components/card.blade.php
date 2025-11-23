<div {{ $attributes->merge(['class' => 'group overflow-hidden border border-gray-200 bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300']) }}>
    {{ $slot }}
    {{-- Optional: line gradient --}}
    @isset($gradient)
        <div class="h-1 bg-gradient-to-r {{ $gradient }} transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
    @endisset
</div>
