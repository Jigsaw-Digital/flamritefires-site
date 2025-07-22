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
          DEFAULT: '#750639',
          light: '#8C1D4F',
          dark: '#5E0023',
        },
        secondary: {
          DEFAULT: '#daa521', 
          light: '#F6BA32',
          dark: '#BE9010',
        },
        tertiary: {
          DEFAULT: '#008080',
          light: '#00A3A3',
          dark: '#006666',
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