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
                primary: '#063970',
                nav: '#F5F5F5',
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    safelist: [
        'bg-yellow-200',
        'text-yellow-800',
        'bg-green-200',
        'text-green-800',
        {
            pattern: /bg-(blue|orange|green|red)-(500|600)/,
            variants: ['hover'],
        }
    ],

    plugins: [forms],
};
