{{-- resources/views/field/show.blade.php --}}

{{-- Menggunakan layout standar (Misalnya dari Breeze: x-app-layout) --}}
<x-app-layout> 
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        
        {{-- Tampilan Informasi Lapangan --}}
        <div class="bg-white p-8 rounded-lg shadow-xl mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900 mb-2">{{ $field->name }}</h1>
            <p class="text-gray-600 mb-4">{{ $field->description ?? 'Tidak ada deskripsi tersedia.' }}</p>
            {{-- Tambahkan gambar lapangan jika ada --}}
            {{-- <img src="{{ asset('storage/' . $field->image_path) }}" alt="{{ $field->name }}" class="w-full h-64 object-cover rounded-lg"> --}}
        </div>

        {{-- Komponen Livewire Kalender Booking --}}
        <div class="bg-white p-6 rounded-lg shadow-xl border border-red-200">
            <h2 class="text-2xl font-bold mb-4 text-red-700">🗓️ Pilih Tanggal & Waktu Sewa</h2>
            
            {{-- Flash messages untuk peringatan login --}}
            @if (session()->has('warning'))
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4" role="alert">
                    <p class="font-bold">Perhatian</p>
                    <p>{{ session('warning') }}</p>
                </div>
            @endif

            {{-- Memanggil komponen Livewire dan meneruskan objek Field --}}
            @livewire('booking-calendar', ['field' => $field])
        </div>
    </div>
</x-app-layout>