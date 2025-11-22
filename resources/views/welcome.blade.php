{{-- resources/views/welcome.blade.php --}}
@php
    use Illuminate\Support\Str;
@endphp

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold mb-6">Daftar Lapangan Tersedia</h1>

            @if ($fields->count() == 0)
                <p class="text-gray-600">Belum ada data lapangan.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach ($fields as $field)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                            <h2 class="text-xl font-semibold mb-2">{{ $field->name }}</h2>

                            <p class="text-gray-600 mb-4">
                                {{ Str::limit($field->description, 80) }}
                            </p>

                            <a href="{{ route('field.detail', $field->id) }}"
                               class="text-red-600 hover:text-red-800 font-medium">
                                Lihat Detail & Booking →
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
