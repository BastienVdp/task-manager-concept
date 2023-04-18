const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        "./node_modules/flowbite/**/*.js"
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
        borderWidth: {
            DEFAULT: '1px',
            '0': '0',
            '2': '2px',
            '3': '3px',
            '4': '4px',
            '6': '6px',
            '8': '8px',
        },
        borderRadius: {
            'none': '0',
            'sm': '0.125rem',
            DEFAULT: '0.25rem',
            DEFAULT: '4px',
            'md': '0.375rem',
            'lg': '0.5rem',
            'full': '9999px',
            'large': '12px',
            'xl': '18px'
        },
        colors: {
            'dark-slate-grey': '#2b2e43',
            'tuna': '#2f334a',
            'bright-gray': '#373b55',
            'cold-purple': '#B4A0F7',
            'comet': '#4E5471',
            'purple-haze': '#483D76',
            'medium-purple': '#6D54B7',
            'iris': '#664FAB',
            'gray-light': '#c0c1c9',
            'gray': '#888ea8',
            'mint': '#3bb081',
            'dark-mint': '#187D59',
            'green': '#02cb69',
            'ghost-white': '#f8f8f9',
            'dirt-brown': '#73613c',
            'golden': '#fcba00',
            'red': '#A4140F'
          },
    },

    plugins: [
        require('@tailwindcss/forms'),
    ],
};
