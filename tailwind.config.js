let defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
    purge: {
      content: [
        './resources/**/*.antlers.html',
        './resources/**/*/*.antlers.html',
        // './resources/**/*.blade.php',
        './content/**/*.md'
      ]
    },
    important: true,
    theme: {
      extend: {
          colors: {
              'sc-dark-blue': '#041B34',
              'sc-dark-light': '#00CDE0',
          },
          fontFamily: {
              'sc': ['Exo', ...defaultTheme.fontFamily.sans]
          }
      },
    },
    variants: {},
    plugins: [
        require('@tailwindcss/typography'),
    ],
}
