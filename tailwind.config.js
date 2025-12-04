import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    // Tetap aktifkan dark mode class untuk latar belakang
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
            // DEFINISI SKEMA WARNA GOLD/ORANGE
            colors: {
                'dark-bg': '#101010',      // Latar belakang sangat gelap
                'dark-card': '#1C1C1C',    // Latar belakang elemen
                'accent-gold': '#FFC300',  // Warna Emas/Jingga utama
                'accent-light': '#FFD700', // Warna Emas yang lebih terang
                'gray-700': '#333333',
            },
            // EFEK SHADOW GOLD
            boxShadow: {
                'gold': '0 0 15px rgba(255, 195, 0, 0.6), 0 0 25px rgba(255, 195, 0, 0.3)',
            }
        },
    },

    plugins: [forms],
};