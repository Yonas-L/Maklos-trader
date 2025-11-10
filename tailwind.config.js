import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import flowbite from 'flowbite/plugin';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        './node_modules/flowbite/**/*.js',
    ],

    theme: {
        extend: {
            colors: {
                maklos: {
                    50: '#f1f7ff',
                    100: '#dceafd',
                    200: '#b9d4fa',
                    300: '#8bb5f5',
                    400: '#5e95ee',
                    500: '#2f74e6',
                    600: '#1f58be',
                    700: '#1a4899',
                    800: '#173c7d',
                    900: '#132f64',
                },
                eucalyptus: '#4dbb90',
                charcoal: '#1a1f2f',
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                display: ['"Space Grotesk"', ...defaultTheme.fontFamily.sans],
            },
            keyframes: {
                aurora: {
                    '0%': {
                        transform: 'translate3d(-10%, -10%, 0) scale(1)',
                        opacity: '0.4',
                    },
                    '25%': {
                        transform: 'translate3d(18%, -6%, 0) scale(1.08)',
                        opacity: '0.55',
                    },
                    '50%': {
                        transform: 'translate3d(8%, 14%, 0) scale(1.03)',
                        opacity: '0.45',
                    },
                    '75%': {
                        transform: 'translate3d(-12%, 6%, 0) scale(1.08)',
                        opacity: '0.5',
                    },
                    '100%': {
                        transform: 'translate3d(-10%, -10%, 0) scale(1)',
                        opacity: '0.4',
                    },
                },
            },
            animation: {
                aurora: 'aurora 18s ease-in-out infinite',
            },
        },
    },

    plugins: [forms, flowbite],
};
