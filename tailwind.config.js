import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
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
            colors: {
                'roofing-blue': '#1F3A5F',
                'construction-orange': '#F97316',
                'soft-gray': '#F4F6F9',
                'primary-text': '#1F2937',
                'secondary-text': '#6B7280',
                'success-green': '#22C55E',
                'warning-amber': '#F59E0B',
                'error-red': '#EF4444',
            },
        },
    },

    plugins: [forms],
};
