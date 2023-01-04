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
            },
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            backgroundImage: {
                'banner': "url('/assets/images/background-image.svg')",
            }
        },
    },

    plugins: [],
};
