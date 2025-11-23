<x-app-layout>

    {{-- Header Page --}}
    <x-slot name="header">
        {{ __('Hubungi Kami') }}
    </x-slot>

    {{-- Content Area --}}
    <div class="pt-16 pb-20 bg-dark-bg min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-12">
                <h1 class="text-5xl font-extrabold text-white uppercase mb-4">
                    Kirim Pesan ke <span class="text-neon-green">Tim Kami</span>
                </h1>
                <p class="text-gray-400 text-lg">
                    Kami siap membantu Anda. Kirimkan pertanyaan, kritik, atau saran Anda.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                {{-- Contact Form Card (Neon Styled) --}}
                <div class="bg-dark-card p-8 rounded-xl border border-neon-green/10 shadow-xl shadow-black/50">
                    <h2 class="text-2xl font-bold text-neon-green mb-6">Formulir Kontak</h2>
                    
                    <form action="#" method="POST">
                        @csrf 
                        
                        <div class="space-y-6">
                            
                            {{-- Name Field --}}
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Nama Lengkap</label>
                                <input type="text" name="name" id="name" required
                                       class="w-full bg-dark-bg border-neon-green/30 text-white rounded-lg shadow-inner 
                                              focus:border-neon-light focus:ring-neon-light transition duration-200">
                            </div>

                            {{-- Email Field --}}
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email Anda</label>
                                <input type="email" name="email" id="email" required
                                       class="w-full bg-dark-bg border-neon-green/30 text-white rounded-lg shadow-inner 
                                              focus:border-neon-light focus:ring-neon-light transition duration-200">
                            </div>

                            {{-- Message Field --}}
                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-300 mb-1">Pesan Anda</label>
                                <textarea name="message" id="message" rows="4" required
                                          class="w-full bg-dark-bg border-neon-green/30 text-white rounded-lg shadow-inner 
                                                 focus:border-neon-light focus:ring-neon-light transition duration-200"></textarea>
                            </div>
                            
                            {{-- Submit Button (CTA Neon) --}}
                            <button type="submit"
                                    class="w-full py-3 bg-neon-green text-dark-bg rounded-lg font-bold uppercase text-lg tracking-wider 
                                           hover:bg-neon-light transition duration-300 transform hover:scale-[1.01] shadow-neon">
                                Kirim Pesan
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Contact Info Card (Side Panel) --}}
                <div class="bg-dark-card p-8 rounded-xl border border-neon-green/10 shadow-xl shadow-black/50 space-y-6">
                    <h2 class="text-2xl font-bold text-neon-green mb-6">Informasi Kontak</h2>
                    
                    {{-- Email --}}
                    <div class="flex items-start space-x-4">
                        <svg class="w-6 h-6 text-neon-light shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8m-18 4v8a2 2 0 002 2h14a2 2 0 002-2v-8m-18 0l9 5 9-5"></path></svg>
                        <div>
                            <p class="text-gray-300 font-semibold">Email Dukungan</p>
                            <a href="mailto:support@minisoccer.id" class="text-neon-green hover:underline">support@minisoccer.id</a>
                        </div>
                    </div>

                    {{-- Phone --}}
                    <div class="flex items-start space-x-4">
                        <svg class="w-6 h-6 text-neon-light shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.144a11.042 11.042 0 005.516 5.516l1.144-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.742 21 3 14.258 3 6V5z"></path></svg>
                        <div>
                            <p class="text-gray-300 font-semibold">Telepon / WhatsApp</p>
                            <a href="tel:+62211234567" class="text-neon-green hover:underline">(021) 123-4567</a>
                        </div>
                    </div>
                    
                    {{-- Location (Map Placeholder) --}}
                    <div>
                        <p class="text-gray-300 font-semibold mb-3">Lokasi Kami</p>
                        <div class="h-48 bg-dark-bg border border-neon-green/30 rounded-lg flex items-center justify-center">
                            <span class="text-gray-500 text-sm">Integrasi Google Maps Akan Datang</span>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>