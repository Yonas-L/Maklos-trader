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
                eucalyptus: {
                    50: '#f0fdf9',
                    100: '#ccfbf1',
                    200: '#99f6e4',
                    300: '#5eead4',
                    400: '#2dd4bf',
                    500: '#4dbb90',
                    600: '#0d9488',
                    700: '#0f766e',
                    800: '#115e59',
                    900: '#134e4a',
                },
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
                blob: {
                    '0%': {
                        borderRadius: '42% 58% 63% 37% / 55% 44% 56% 45%',
                        transform: 'translate3d(0, 0, 0) scale(1)',
                    },
                    '25%': {
                        borderRadius: '55% 45% 40% 60% / 48% 62% 38% 52%',
                        transform: 'translate3d(12%, -6%, 0) scale(1.08)',
                    },
                    '50%': {
                        borderRadius: '47% 53% 58% 42% / 60% 40% 58% 42%',
                        transform: 'translate3d(-8%, 10%, 0) scale(0.96)',
                    },
                    '75%': {
                        borderRadius: '40% 60% 44% 56% / 52% 48% 52% 48%',
                        transform: 'translate3d(6%, 6%, 0) scale(1.05)',
                    },
                    '100%': {
                        borderRadius: '42% 58% 63% 37% / 55% 44% 56% 45%',
                        transform: 'translate3d(0, 0, 0) scale(1)',
                    },
                },
            },
            animation: {
                aurora: 'aurora 18s ease-in-out infinite',
                blob: 'blob 16s ease-in-out infinite',
                'blob-slow': 'blob 24s ease-in-out infinite',
            },
        },
    },

    plugins: [forms, flowbite],
};
