<x-app-layout>
    <div class="pt-16 bg-dark-bg min-h-screen">
        <div class="container mx-auto px-4 py-8 max-w-7xl">
            
            {{-- Header Lapangan --}}
            <h1 class="text-4xl font-extrabold text-white mb-8 uppercase tracking-wide">
                {{ $field->name }}
            </h1>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                {{-- Detail Lapangan (2/3 Kolom) --}}
                <div class="lg:col-span-2 space-y-8">
                    
                    {{-- Gambar Utama --}}
                    <div class="bg-dark-card rounded-xl shadow-2xl shadow-black/50 overflow-hidden border border-neon-green/10">
                        @if ($field->image_path)
                            <img src="{{ asset('storage/' . $field->image_path) }}" 
                                 alt="Gambar Utama Lapangan {{ $field->name }}" 
                                 class="w-full h-96 object-cover">
                        @else
                            <div class="w-full h-96 bg-gray-800 flex items-center justify-center">
                                <span class="text-gray-500 text-xl">Foto Lapangan Utama Tidak Ada</span>
                            </div>
                        @endif
                    </div>

                    {{-- Deskripsi Lapangan --}}
                    <div class="bg-dark-card p-6 rounded-xl shadow-xl shadow-black/50 border border-neon-green/10">
                        <h2 class="text-2xl font-bold text-neon-green mb-3 border-b border-gray-700 pb-2 uppercase">Deskripsi Lapangan</h2>
                        <p class="text-gray-300 leading-relaxed">
                            {{ $field->description ?? 'Masukkan deskripsi rinci tentang jenis rumput, fasilitas, dan keunggulan lapangan.' }}
                        </p>
                    </div>
                    
                    {{-- Lokasi & Fasilitas --}}
                    <div class="bg-dark-card p-6 rounded-xl shadow-xl shadow-black/50 border border-neon-green/10">
                        <h2 class="text-2xl font-bold text-neon-green mb-3 border-b border-gray-700 pb-2 uppercase">Lokasi & Fasilitas</h2>
                        <div class="grid grid-cols-2 gap-4 text-gray-400">
                            <p><span class="font-semibold text-white">Alamat:</span> {{ $field->address ?? 'Belum ada data' }}</p>
                            <p><span class="font-semibold text-white">Kota:</span> {{ $field->city ?? 'Belum ada data' }}</p>
                            <p><span class="font-semibold text-white">Fasilitas:</span> Ruang Ganti, Toilet, Kantin</p>
                        </div>
                    </div>

                </div>

                {{-- Form Booking (1/3 Kolom) --}}
                <div class="lg:col-span-1">
                    <div class="sticky top-20 bg-dark-card p-6 rounded-xl shadow-neon shadow-2xl border-t-4 border-neon-green">
                        <h2 class="text-2xl font-extrabold text-white mb-5 uppercase">Pesan Sekarang</h2>
                        
                        <form action="{{ route('booking.process') }}" method="POST">
                            @csrf
                            <input type="hidden" name="field_id" value="{{ $field->id }}">

                            <div class="mb-4">
                                <label for="date" class="block text-sm font-medium text-gray-300 mb-1">Pilih Tanggal</label>
                                <input type="date" name="date" id="date" value="2025-11-23" 
                                       class="mt-1 block w-full rounded-md border-gray-700 shadow-sm focus:border-neon-green focus:ring-neon-green 
                                              bg-dark-bg text-white placeholder-gray-500">
                            </div>
                            
                            <div class="mb-6">
                                <label for="duration" class="block text-sm font-medium text-gray-300 mb-1">Durasi (Jam)</label>
                                <select name="duration" id="duration" 
                                        class="mt-1 block w-full rounded-md border-gray-700 shadow-sm focus:border-neon-green focus:ring-neon-green 
                                               bg-dark-bg text-white">
                                    <option value="1">1 Jam</option>
                                    <option value="2">2 Jam</option>
                                </select>
                            </div>
                            
                            <p class="text-sm font-semibold text-neon-green mb-3">Slot Waktu Tersedia (2025-11-23)</p>
                            <div class="flex flex-wrap gap-2 mb-6">
                                {{-- Slot yang tersedia --}}
                                <span class="px-3 py-1 text-sm rounded-full bg-neon-green/80 text-dark-bg font-semibold cursor-pointer hover:bg-neon-green">14:00</span>
                                <span class="px-3 py-1 text-sm rounded-full bg-neon-green/80 text-dark-bg font-semibold cursor-pointer hover:bg-neon-green">15:00</span>
                                
                                {{-- Slot yang sudah di-booked --}}
                                <span class="px-3 py-1 text-sm rounded-full bg-gray-700 text-gray-400 cursor-not-allowed">16:00 (Booked)</span>
                            </div>

                            <button type="submit" 
                                    class="w-full bg-neon-green text-dark-bg py-3 rounded-lg font-bold text-lg hover:bg-neon-light transition duration-150 shadow-neon uppercase tracking-wider">
                                Pesan Sekarang!
                            </button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>