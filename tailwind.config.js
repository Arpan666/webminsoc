import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                // Warna Kustom Neon Dark Mode
                'dark-bg': '#121212', 
                'dark-card': '#1C1C1C', 
                'neon-green': '#00FF41', 
                'neon-light': '#00FFC2', 
            },
            fontFamily: {
                // Mengganti font default dengan Urbanist
                sans: ['Urbanist', ...defaultTheme.fontFamily.sans], 
            },
            boxShadow: {
                // Shadow khusus neon untuk CTA
                'neon': '0 0 10px rgba(0, 255, 65, 0.6), 0 0 20px rgba(0, 255, 65, 0.4)', 
            }
        },
    },

    plugins: [forms],
};