const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');

/** @type {import('tailwindcss').Config} */
module.exports = {
    prefix: 'tw-',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            colors: {
                success: colors.green,
                info: colors.blue,
                warning: colors.amber,
                danger: colors.red,
                default: colors.slate,
                dark: '#313A46',
                light: '#FAFBFE',
                primary: '#7C3AED',
                gray: {
                    50: '#F8FAFC',
                    100: '#F1F5F9',
                    200: '#E2E8F0',
                    300: '#CBD5E1',
                    400: '#94A3B8',
                    500: '#64748B',
                    600: '#475569',
                    700: '#334155',
                    800: '#1E293B',
                }
            },
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
                titillium: ['Titillium Web', ...defaultTheme.fontFamily.sans],
            },
            backgroundImage: {
                'banner': "url('/assets/images/background-image.svg')",
                'hero-bg': "url('/assets/images/bg.png')",
            }
        },
    },

    plugins: [],
};
