<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --color-dark-bg: #101010;
            --color-dark-card: #1C1C1C;
            --color-accent-gold: #FFC300;
            --color-accent-light: #FFD700;
            --color-gray-700: #333333;
        }

        /* Apply the custom font and main BG color globally */
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--color-dark-bg); /* Menggunakan variabel CSS */
        }
        
        /* Custom Gold Shadow Class (Menggunakan definisi statis) */
        .shadow-gold-custom {
            box-shadow: 0 0 15px rgba(255, 195, 0, 0.6), 0 0 25px rgba(255, 195, 0, 0.3);
        }
        
        /* Custom Utility Classes untuk mengganti kelas Tailwind custom yang dihapus */
        .bg-card { background-color: var(--color-dark-card); }
        .text-gold { color: var(--color-accent-gold); }
        .text-light-gold { color: var(--color-accent-light); }
        .bg-gold { background-color: var(--color-accent-gold); }
        .border-gold-50 { border-color: rgba(255, 195, 0, 0.5); }
        .hover-border-gold:hover { border-color: var(--color-accent-gold); }
        .bg-gray-input { background-color: rgba(51, 51, 51, 0.5); }
        .border-gray-input { border-color: var(--color-gray-700); }
        .focus-ring-gold:focus { 
            --tw-ring-color: var(--color-accent-gold);
            outline: 2px solid var(--color-accent-gold);
            outline-offset: 2px;
        }
        .focus-border-gold-80:focus { border-color: rgba(255, 195, 0, 0.8); }
        /* Kelas untuk Focus Ring Offset agar kontras dengan card */
        .ring-offset-card { --tw-ring-offset-color: var(--color-dark-card); }

    </style>
</head>
<body class="min-h-screen text-gray-200">

    <header class="bg-card border-b border-gray-700/50 shadow-lg">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            
            <h2 class="font-bold text-2xl leading-tight text-gold tracking-wider">
                Profil Pengguna
            </h2>

            <button onclick="history.back()" 
                    class="inline-flex items-center px-4 py-2 bg-gray-700/50 text-gray-200 font-semibold text-sm uppercase rounded-xl hover:bg-gray-600 focus:outline-none focus:ring-2 focus-ring-gold ring-offset-2 ring-offset-card transition ease-in-out duration-150">
                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Batal / Kembali
            </button>
        </div>
    </header>

    <div class="py-12">
        <div class="max-w-4xl lg:max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="p-4 sm:p-8 bg-card shadow-gold-custom sm:rounded-xl border border-gold-50 transition duration-300 hover-border-gold">
                <div class="max-w-full">
                    <section>
                        <header>
                            <h2 class="text-xl font-semibold text-light-gold">Informasi Profil</h2>
                            <p class="mt-1 text-sm text-gray-400">
                                Perbarui nama dan alamat email akun Anda.
                            </p>
                        </header>

                        <form class="mt-6 space-y-6">
                            <div>
                                <label for="name" class="block font-medium text-sm text-gray-300 mb-1">Nama</label>
                                <input id="name" type="text" value="Nama Pengguna" class="mt-1 block w-full bg-gray-input border-gray-input rounded-lg text-gray-200 focus-ring-gold focus-border-gold-80" required>
                            </div>
                            <div>
                                <label for="email" class="block font-medium text-sm text-gray-300 mb-1">Email</label>
                                <input id="email" type="email" value="user@example.com" class="mt-1 block w-full bg-gray-input border-gray-input rounded-lg text-gray-200 focus-ring-gold focus-border-gold-80" required>
                            </div>

                            <div class="flex items-center gap-4">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gold text-dark-bg font-bold text-sm uppercase tracking-wider rounded-xl shadow-lg hover:bg-accent-light focus:outline-none focus:ring-2 focus-ring-gold ring-offset-2 ring-offset-card transition ease-in-out duration-150">
                                    Simpan Perubahan
                                </button>
                                <p class="text-sm text-gray-500">Tersimpan.</p>
                            </div>
                        </form>
                    </section>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-card shadow-gold-custom sm:rounded-xl border border-gold-50 transition duration-300 hover-border-gold">
                <div class="max-w-full">
                    <section>
                        <header>
                            <h2 class="text-xl font-semibold text-light-gold">Perbarui Kata Sandi</h2>
                            <p class="mt-1 text-sm text-gray-400">
                                Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.
                            </p>
                        </header>

                        <form class="mt-6 space-y-6">
                            <div>
                                <label for="current_password" class="block font-medium text-sm text-gray-300 mb-1">Kata Sandi Saat Ini</label>
                                <input id="current_password" type="password" class="mt-1 block w-full bg-gray-input border-gray-input rounded-lg text-gray-200 focus-ring-gold focus-border-gold-80" required>
                            </div>
                            <div>
                                <label for="password" class="block font-medium text-sm text-gray-300 mb-1">Kata Sandi Baru</label>
                                <input id="password" type="password" class="mt-1 block w-full bg-gray-input border-gray-input rounded-lg text-gray-200 focus-ring-gold focus-border-gold-80" required>
                            </div>
                            <div>
                                <label for="password_confirmation" class="block font-medium text-sm text-gray-300 mb-1">Konfirmasi Kata Sandi</label>
                                <input id="password_confirmation" type="password" class="mt-1 block w-full bg-gray-input border-gray-input rounded-lg text-gray-200 focus-ring-gold focus-border-gold-80" required>
                            </div>

                            <div class="flex items-center gap-4">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gold text-dark-bg font-bold text-sm uppercase tracking-wider rounded-xl shadow-lg hover:bg-accent-light focus:outline-none focus:ring-2 focus-ring-gold ring-offset-2 ring-offset-card transition ease-in-out duration-150">
                                    Simpan Kata Sandi
                                </button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
            
            <div class="p-4 sm:p-8 bg-card shadow-gold-custom sm:rounded-xl border border-red-600/50">
                <div class="max-w-full">
                    <section>
                        <header>
                            <h2 class="text-xl font-semibold text-red-500">Hapus Akun</h2>
                            <p class="mt-1 text-sm text-gray-400">
                                Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Sebelum menghapus akun Anda, harap unduh data atau informasi apa pun yang ingin Anda simpan.
                            </p>
                        </header>

                        <button onclick="document.getElementById('delete-modal').classList.remove('hidden')" class="mt-6 inline-flex items-center px-4 py-2 bg-red-600 text-white font-bold text-sm uppercase tracking-wider rounded-xl shadow-lg hover:bg-red-700 transition ease-in-out duration-150">
                            Hapus Akun
                        </button>
                    </section>
                </div>
            </div>
            
            <div id="delete-modal" class="hidden fixed inset-0 bg-dark-bg/80 backdrop-blur-sm flex items-center justify-center p-4 z-50" role="dialog" aria-modal="true" aria-labelledby="modal-title">
                <div class="bg-card rounded-xl p-6 w-full max-w-sm shadow-gold-custom border border-red-600/70">
                    <h3 id="modal-title" class="text-lg font-bold text-red-500">Konfirmasi Penghapusan Akun</h3>
                    <p class="mt-2 text-sm text-gray-400">
                        Apakah Anda yakin ingin menghapus akun Anda? Semua data akan hilang secara permanen.
                    </p>
                    <div class="mt-6 flex justify-end gap-3">
                        <button onclick="document.getElementById('delete-modal').classList.add('hidden')" class="px-4 py-2 text-sm font-medium rounded-lg text-gray-200 hover:bg-gray-700/50 transition">
                            Batal
                        </button>
                        <button onclick="alert('Akun telah disimulasikan untuk dihapus. (Dalam aplikasi nyata, ini akan menghapus data)')" class="px-4 py-2 text-sm font-medium rounded-lg bg-red-600 text-white hover:bg-red-700 transition">
                            Saya Yakin, Hapus Akun
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>
</html>