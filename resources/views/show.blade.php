<x-app-layout>
    <div class="container mx-auto px-4 py-8 pt-24 bg-dark-bg">
        <h1 class="text-4xl font-extrabold text-white mb-8 uppercase border-b border-accent-gold/50 pb-3">
            DETAIL LAPANGAN: <span class="text-accent-gold">{{ $field->name }}</span>
        </h1>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- Bagian Kiri: Gambar dan Deskripsi --}}
            <div class="lg:col-span-2 space-y-8">
                
                {{-- Card Gambar Utama --}}
                <div class="bg-dark-card rounded-xl shadow-xl overflow-hidden border border-accent-gold/20">
                    @if ($field->image_path)
                        <img src="{{ asset('storage/' . $field->image_path) }}" 
                             alt="Gambar Utama Lapangan {{ $field->name }}" 
                             class="w-full h-96 object-cover">
                    @else
                        <div class="w-full h-96 bg-gray-800 flex items-center justify-center">
                            <span class="text-gray-500 text-xl">Foto Lapangan Utama Belum Tersedia</span>
                        </div>
                    @endif
                </div>

                {{-- Card Deskripsi --}}
                <div class="bg-dark-card p-6 rounded-xl shadow-lg border border-gray-700">
                    <h2 class="text-2xl font-bold text-accent-gold mb-3 border-b border-gray-700 pb-2">Deskripsi Lapangan</h2>
                    <p class="text-gray-300 leading-relaxed">
                        {{ $field->description ?? 'Masukkan deskripsi rinci tentang jenis rumput, fasilitas, dan keunggulan lapangan.' }}
                    </p>
                </div>
                
                {{-- Card Lokasi & Fasilitas --}}
                <div class="bg-dark-card p-6 rounded-xl shadow-lg border border-gray-700">
                    <h2 class="text-2xl font-bold text-accent-gold mb-3 border-b border-gray-700 pb-2">Lokasi & Fasilitas</h2>
                    <div class="grid grid-cols-2 gap-4 text-gray-300">
                        <p><span class="font-semibold text-white">Alamat:</span> {{ $field->address ?? 'Belum ada data' }}</p>
                        <p><span class="font-semibold text-white">Kota:</span> {{ $field->city ?? 'Belum ada data' }}</p>
                    </div>
                </div>

            </div>

            {{-- Bagian Kanan: Form Booking (Sticky) --}}
            <div class="lg:col-span-1">
                {{-- Card Form Gold Accent --}}
                <div class="sticky top-24 bg-dark-card p-6 rounded-xl shadow-2xl border-t-4 border-accent-gold/80">
                    <h2 class="text-2xl font-extrabold text-accent-gold mb-5">Pesan Sekarang</h2>
                    
                    <form action="{{ route('booking.process') }}" method="POST">
                        @csrf
                        <input type="hidden" name="field_id" value="{{ $field->id }}">

                        <div class="mb-4">
                            <label for="date" class="block text-sm font-medium text-gray-300">Pilih Tanggal</label>
                            {{-- Input Dark Mode dengan focus Gold --}}
                            <input type="date" name="date" id="date" value="{{ date('Y-m-d') }}" 
                                class="mt-1 block w-full rounded-md bg-gray-800 border-gray-600 text-white shadow-sm focus:border-accent-gold focus:ring-accent-gold">
                        </div>
                        
                        <div class="mb-6">
                            <label for="duration" class="block text-sm font-medium text-gray-300">Durasi (Jam)</label>
                            {{-- Select Dark Mode dengan focus Gold --}}
                            <select name="duration" id="duration" 
                                class="mt-1 block w-full rounded-md bg-gray-800 border-gray-600 text-white shadow-sm focus:border-accent-gold focus:ring-accent-gold">
                                <option value="1">1 Jam</option>
                                <option value="2">2 Jam</option>
                            </select>
                        </div>
                        
                        <p class="text-sm font-semibold text-gray-300 mb-3">Slot Waktu Tersedia ({{ date('Y-m-d') }})</p>
                        <div class="flex flex-wrap gap-2 mb-6">
                            {{-- Slot Tersedia (Warna Gold) --}}
                            <span class="px-3 py-1 text-sm rounded-full bg-accent-gold/90 text-dark-bg cursor-pointer font-bold hover:bg-accent-gold">14:00</span>
                            <span class="px-3 py-1 text-sm rounded-full bg-accent-gold/90 text-dark-bg cursor-pointer font-bold hover:bg-accent-gold">15:00</span>
                            {{-- Slot Ter-Booking --}}
                            <span class="px-3 py-1 text-sm rounded-full bg-gray-600 text-gray-300 cursor-not-allowed">16:00 (Booked)</span>
                        </div>

                        {{-- Tombol Pesan Sekarang (Solid Gold) --}}
                        <button type="submit" class="w-full bg-accent-gold text-dark-bg py-3 rounded-lg font-bold text-lg 
                                                    hover:bg-accent-light transition duration-150 shadow-gold">
                            Pesan Sekarang!
                        </button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>