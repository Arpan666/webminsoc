<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-xl text-accent-gold uppercase tracking-widest">Pesan Masuk (Inbox)</h2>
    </x-slot>

    <div class="py-12 bg-dark-bg min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-dark-card border border-white/5 rounded-[2rem] overflow-hidden shadow-2xl">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-white/5 text-accent-gold uppercase text-[10px] tracking-widest">
                        <tr>
                            <th class="p-5">Pengirim</th>
                            <th class="p-5">Email</th>
                            <th class="p-5">Pesan</th>
                            <th class="p-5">Waktu</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-300 text-sm">
                        @foreach($messages as $msg)
                        <tr class="border-b border-white/5 hover:bg-white/5 transition">
                            <td class="p-5 font-bold text-white">{{ $msg->name }}</td>
                            <td class="p-5 italic text-gray-400">{{ $msg->email }}</td>
                            <td class="p-5">{{ $msg->message }}</td>
                            <td class="p-5 text-xs">{{ $msg->created_at->format('d M Y H:i') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>