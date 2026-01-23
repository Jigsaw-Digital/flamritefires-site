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
        coolblue: {
          DEFAULT: '#0891b2', // Cool blue for Coolright mode (cyan-600)
          light: '#06b6d4', // Lighter cyan
          dark: '#0e7490', // Darker cyan
          accent: '#22d3ee', // Bright cyan accent (complementary)
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