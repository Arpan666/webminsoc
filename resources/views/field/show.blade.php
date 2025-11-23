<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-8">{{ $field->name }}</h1>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-8">
                
                <div class="bg-white rounded-xl shadow-xl overflow-hidden">
                    @if ($field->image_path)
                        <img src="{{ asset('storage/' . $field->image_path) }}" 
                             alt="Gambar Utama Lapangan {{ $field->name }}" 
                             class="w-full h-96 object-cover">
                    @else
                        <div class="w-full h-96 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-500 text-xl">Foto Lapangan Utama</span>
                        </div>
                    @endif
                    
                    </div>

                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <h2 class="text-2xl font-bold text-gray-800 mb-3 border-b pb-2">Deskripsi Lapangan</h2>
                    <p class="text-gray-600 leading-relaxed">
                        {{ $field->description ?? 'Masukkan deskripsi rinci tentang jenis rumput, fasilitas, dan keunggulan lapangan.' }}
                    </p>
                </div>
                
                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <h2 class="text-2xl font-bold text-gray-800 mb-3 border-b pb-2">Lokasi & Fasilitas</h2>
                    <div class="grid grid-cols-2 gap-4 text-gray-700">
                        <p><span class="font-semibold text-red-600">Alamat:</span> {{ $field->address ?? 'Belum ada data' }}</p>
                        <p><span class="font-semibold text-red-600">Kota:</span> {{ $field->city ?? 'Belum ada data' }}</p>
                        </div>
                </div>

            </div>

            <div class="lg:col-span-1">
                <div class="sticky top-4 bg-white p-6 rounded-xl shadow-2xl border-t-4 border-red-600">
                    <h2 class="text-2xl font-extrabold text-gray-800 mb-5">Pesan Sekarang</h2>
                    
                    <form action="{{ route('booking.process') }}" method="POST">
                        @csrf
                        <input type="hidden" name="field_id" value="{{ $field->id }}">

                        <div class="mb-4">
                            <label for="date" class="block text-sm font-medium text-gray-700">Pilih Tanggal</label>
                            <input type="date" name="date" id="date" value="2025-11-23" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                        </div>
                        
                        <div class="mb-6">
                            <label for="duration" class="block text-sm font-medium text-gray-700">Durasi (Jam)</label>
                            <select name="duration" id="duration" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                                <option value="1">1 Jam</option>
                                <option value="2">2 Jam</option>
                            </select>
                        </div>
                        
                        <p class="text-sm font-semibold text-gray-700 mb-3">Slot Waktu Tersedia (2025-11-23)</p>
                        <div class="flex flex-wrap gap-2 mb-6">
                            <span class="px-3 py-1 text-sm rounded-full bg-green-500 text-white cursor-pointer">14:00</span>
                            <span class="px-3 py-1 text-sm rounded-full bg-green-500 text-white cursor-pointer">15:00</span>
                            <span class="px-3 py-1 text-sm rounded-full bg-gray-300 text-gray-600 cursor-not-allowed">16:00 (Booked)</span>
                        </div>

                        <button type="submit" class="w-full bg-red-600 text-white py-3 rounded-lg font-bold text-lg hover:bg-red-700 transition duration-150 shadow-md">
                            Pesan Sekarang!
                        </button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>