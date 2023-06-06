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
            animation: {
                movedown: 'movedown 2s',
            },
            keyframes: {
                movedown: {
                    '0%': {
                        transform: 'translateY(-100%)',
                    },
                    '40%': {
                        transform: 'translateY(calc(40%))'
                    }
                }
            },
            width: {
                '4': '4%',
                '5/100': '5%',
                'sidebar': '15%', 
            },
            height: {
                '2/100': '2%',
            },
            colors: {
                'custom-light-purple': '#912197',
                'custom-purple': '#5E053A',
                'custom-blue': '#182946'
            },
            margin: {
                '5/100': '5%'
            }
        },

        plugins: [forms]
    }
};
