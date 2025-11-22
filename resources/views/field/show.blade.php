{{-- resources/views/field/show.blade.php --}}

<x-app-layout>
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        
        <h1 class="text-4xl font-extrabold text-gray-900 mb-6">{{ $field->name }}</h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- KIRI: Detail Lapangan --}}
            <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-md">
                
                {{-- Foto Lapangan --}}
                @if ($field->image_path)
                    <img src="{{ Storage::url($field->image_path) }}" 
                         alt="Foto {{ $field->name }}" 
                         class="w-full h-96 object-cover rounded-lg mb-6">
                @endif
                
                <h2 class="text-2xl font-semibold mb-3">Deskripsi</h2>
                <p class="text-gray-600 mb-6">{{ $field->description }}</p>

                <h2 class="text-2xl font-semibold mb-3">Informasi Lain</h2>
                <p><strong>Alamat:</strong> {{ $field->address ?? 'Belum ada data' }}</p>
                <p><strong>Kota:</strong> {{ $field->city ?? 'Belum ada data' }}</p>
            </div>
            
            {{-- KANAN: Booking Calendar Livewire --}}
            <div class="lg:col-span-1">
                <div class="bg-white p-6 rounded-lg shadow-xl sticky top-6">
                    <h2 class="text-2xl font-bold text-red-600 mb-4">Pesan Sekarang</h2>
                    
                    {{-- PANGGIL KOMPONEN LIVEWIRE BOOKING --}}
                    @livewire('booking-calendar', ['field' => $field])
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>