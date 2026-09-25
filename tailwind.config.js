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
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                trade: {
                    green: {
                        DEFAULT: '#1f5f4f',
                        dark: '#163f34',
                        light: '#2e7a66',
                    },
                    amber: {
                        DEFAULT: '#e8a33d', 
                        dark: '#c9582a',
                        light: '#f0b969',
                    }
                }
            }
        },
    },

    plugins: [forms],
};
