const containerQueries = require('@tailwindcss/container-queries')

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./**/*.php",
    "./src/**/*.js",
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          DEFAULT: '#E85319', // Greycaine primary green
          light: '#4d4d4d',
          dark: '#C60003',
        },
        secondary: {
          DEFAULT: '#B8A082', // Greycaine secondary beige/tan
          light: '#CDB8A0',
          dark: '#A08764',
        },
        tertiary: {
          DEFAULT: '#F5F3F0', // Greycaine tertiary light cream
          light: '#FDFCFA',
          dark: '#E8E3DC',
        },
      },
      // Add container query support
      containerQuery: {
        sm: '32rem',
        md: '48rem',
        lg: '64rem',
        xl: '80rem',
      },
    }
  },
  plugins: [
    require('@tailwindcss/container-queries'),
  ],
} 