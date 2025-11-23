<x-app-layout>
    <div class="container mx-auto px-4 py-8 pt-24 max-w-7xl">
        <h1 class="text-4xl font-extrabold text-white mb-8 uppercase tracking-wider">{{ $field->name }}</h1>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-8">
                
                <div class="bg-dark-card rounded-xl shadow-xl shadow-black/50 overflow-hidden">
                    @if ($field->image_path)
                        <img src="{{ asset('storage/' . $field->image_path) }}" 
                             alt="Gambar Utama Lapangan {{ $field->name }}" 
                             class="w-full h-96 object-cover">
                    @else
                        <div class="w-full h-96 bg-gray-800 flex items-center justify-center">
                            <span class="text-gray-500 text-xl">Foto Lapangan Utama</span>
                        </div>
                    @endif
                </div>

                <div class="bg-dark-card p-6 rounded-xl shadow-lg border-l-4 border-neon-green">
                    <h2 class="text-2xl font-bold text-white mb-3 border-b border-gray-700 pb-2">Deskripsi Lapangan</h2>
                    <p class="text-gray-400 leading-relaxed">
                        {{ $field->description ?? 'Masukkan deskripsi rinci tentang jenis rumput, fasilitas, dan keunggulan lapangan.' }}
                    </p>
                </div>
                
                <div class="bg-dark-card p-6 rounded-xl shadow-lg border-l-4 border-neon-green">
                    <h2 class="text-2xl font-bold text-white mb-3 border-b border-gray-700 pb-2">Lokasi & Fasilitas</h2>
                    <div class="grid grid-cols-2 gap-4 text-gray-400">
                        <p><span class="font-semibold text-neon-green">Alamat:</span> {{ $field->address ?? 'Belum ada data' }}</p>
                        <p><span class="font-semibold text-neon-green">Kota:</span> {{ $field->city ?? 'Belum ada data' }}</p>
                    </div>
                </div>

            </div>

            <div class="lg:col-span-1">
                <div class="sticky top-20 bg-dark-card p-6 rounded-xl shadow-2xl shadow-black/70 border-t-4 border-neon-green">
                    <h2 class="text-2xl font-extrabold text-white mb-5 uppercase">Pesan Sekarang</h2>
                    
                    <form action="{{ route('booking.process') ?? '#' }}" method="POST">
                        @csrf
                        <input type="hidden" name="field_id" value="{{ $field->id }}">

                        <div class="mb-4">
                            <label for="date" class="block text-sm font-medium text-gray-300">Pilih Tanggal</label>
                            <input type="date" name="date" id="date" value="2025-11-23" class="mt-1 block w-full rounded-md border-gray-600 shadow-sm bg-dark-bg text-white focus:border-neon-green focus:ring-neon-green">
                        </div>
                        
                        <div class="mb-6">
                            <label for="duration" class="block text-sm font-medium text-gray-300">Durasi (Jam)</label>
                            <select name="duration" id="duration" class="mt-1 block w-full rounded-md border-gray-600 shadow-sm bg-dark-bg text-white focus:border-neon-green focus:ring-neon-green">
                                <option value="1">1 Jam</option>
                                <option value="2">2 Jam</option>
                            </select>
                        </div>
                        
                        <p class="text-sm font-semibold text-gray-300 mb-3">Slot Waktu Tersedia (2025-11-23)</p>
                        <div class="flex flex-wrap gap-2 mb-6">
                            <span class="px-3 py-1 text-sm rounded-full bg-neon-green text-dark-bg cursor-pointer font-medium hover:bg-neon-light transition">14:00</span>
                            <span class="px-3 py-1 text-sm rounded-full bg-neon-green text-dark-bg cursor-pointer font-medium hover:bg-neon-light transition">15:00</span>
                            <span class="px-3 py-1 text-sm rounded-full bg-gray-700 text-gray-400 cursor-not-allowed">16:00 (Booked)</span>
                        </div>

                        <div class="text-center mb-6">
                            <p class="text-gray-400 text-sm uppercase">Total Harga Estimasi</p>
                            <p class="text-4xl font-extrabold text-neon-green mt-1">Rp 150.000</p>
                        </div>

                        <button type="submit" class="w-full bg-neon-green text-dark-bg py-3 rounded-lg font-bold text-lg uppercase 
                                                   hover:bg-neon-light transition duration-150 shadow-neon">
                            Pesan Sekarang!
                        </button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>