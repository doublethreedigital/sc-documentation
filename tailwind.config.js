let defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
    purge: {
        content: [
            './app/**/*.php',
            './app/**/**/*.php',
            './resources/**/*.antlers.html',
            './content/**/*.md'
        ]
    },
    important: true,
    theme: {
        extend: {
            colors: {
                'sc-dark-blue': '#041B34',
                'sc-dark-light': '#00CDE0',
                'sc-dark-light-darker': '#00e4fa',
            },
            fontFamily: {
                'sc': ['Exo', ...defaultTheme.fontFamily.sans]
            },
            inset: {
                'm25': '-25px',
            }
        },
    },
    variants: {},
    plugins: [
        require('@tailwindcss/typography'),
    ],
}
