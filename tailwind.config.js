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
                primary: {
                    DEFAULT: '#425a4b',
                    50: '#e8ecea',
                    100: '#c5d1c9',
                    200: '#9fb3a5',
                    300: '#789680',
                    400: '#5a7363',
                    500: '#425a4b',
                    600: '#35493c',
                    700: '#28382d',
                    800: '#1b271e',
                    900: '#0e160f',
                },
                secondary: {
                    DEFAULT: '#964824',
                    50: '#fef3ed',
                    100: '#fde4d6',
                    200: '#fcc9ad',
                    300: '#f9a87d',
                    400: '#e8814f',
                    500: '#d5622e',
                    600: '#b84e1e',
                    700: '#964824',
                    800: '#753a1d',
                    900: '#542c16',
                },
                accent: {
                    gold: '#d4a855',
                    cream: '#f6f3f2',
                    sand: '#c2c8c2',
                },
                surface: {
                    DEFAULT: '#f6f3f2',
                    light: '#fbf9f8',
                    dark: '#e8e5e3',
                },
                on: {
                    surface: '#1b1c1c',
                    'surface-variant': '#424843',
                },
            },
        },
    },

    plugins: [forms],
};
