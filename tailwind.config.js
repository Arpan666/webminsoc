import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    // Aktifkan mode gelap secara eksplisit
    darkMode: 'class', 
    
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            // Definisi Skema Warna Neon Dark
            colors: {
                'dark-bg': '#121212', // Latar belakang utama yang sangat gelap
                'dark-card': '#1e1e1e', // Latar belakang kartu/panel
                'neon-green': '#39FF14', // Hijau Neon terang (untuk CTA/Highlight)
                'neon-light': '#00F0FF', // Biru Neon/Cyan untuk aksen
                'gray-700': '#333333', // Digunakan untuk border/divider
            },
            // Efek Shadow Neon
            boxShadow: {
                'neon': '0 0 10px rgba(57, 255, 20, 0.7), 0 0 20px rgba(57, 255, 20, 0.5)',
            }
        },
    },

    plugins: [forms],
};