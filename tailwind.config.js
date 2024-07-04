import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

const colors = require('tailwindcss/colors')

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        colors: {
            transparent: 'transparent',
            current: 'currentColor',
            black: {
              DEFAULT: '#222222',
                '50': '#f6f6f6',
                '100': '#e7e7e7',
                '200': '#d1d1d1',
                '300': '#b0b0b0',
                '400': '#888888',
                '500': '#6d6d6d',
                '600': '#5d5d5d',
                '700': '#4f4f4f',
                '800': '#454545',
                '900': '#3d3d3d',
                '950': '#222222',
            },
            yellow: {
                DEFAULT: '#F0C419',
                '50': '#fdfbe9',
                '100': '#fcf7c5',
                '200': '#f9ec8f',
                '300': '#f5da4f',
                '400': '#f0c419',
                '500': '#e0ad12',
                '600': '#c2860c',
                '700': '#9b600d',
                '800': '#804d13',
                '900': '#6d3f16',
                '950': '#3f2009',
            },
            white: colors.white,
            indigo: colors.indigo,
            red: colors.rose,
        },
        fontSize: {
            '3xl': '1.875rem',
            '4xl': '2.25rem',
            '5xl': '3rem',
            '6xl': '4rem',
            '7xl': '5rem',
        },
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms, typography],
};
