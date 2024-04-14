const defaultTheme = require('tailwindcss/defaultTheme')
/** @type {import('tailwindcss').Config} */

module.exports = {
    prefix: 'pai-',
    important: false,
    separator: ':',
    purge: {
        content: ["./elements/**/*.{php, html,js}"],
        options: {
            whitelist: [
                'body',
                'html',
                'img',
                'a',
                'g-image',
                'g-image--lazy',
                'g-image--loaded',
                'active',
            ],
        }
    },
    theme: {
        outline: {
            DEFAULT: 'outline-none'
        },
        borderWidth: {
            DEFAULT: '1px',
            '0': '0',
        },
    },
    plugins: [],
}
