/** @type {import('tailwindcss').Config} */
const defaultTheme = require('tailwindcss/defaultTheme');
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: ({ colors }) => ({
        'light-accent': '#3b82f6', // blue-500
        'light-bg': '#f1f5f9', // slate-100
        'light-bg-primary': '#e2e8f0', // slate-200
        'light-bg-secondary': '#f8fafc', // slate-50
        'light-text': '#64748b', // slate-500
        'light-text-primary': '#1e293b', // slate-800
        'light-text-secondary': '#64748b', // slate-500

        'dark-accent': '#d946ef', // fuchsia-500
        'dark-bg': '#1e293b', // slate-800
        'dark-bg-primary': '#1e293b', // slate-800
        'dark-bg-secondary': '#334155', // slate-700
        'dark-text': '#e2e8f0', // slate-200
        'dark-text-primary': '#f1f5f9', // slate-100
        'dark-text-secondary': '#94a3b8', // slate-400
      }),
      fontFamily: {
        sans: ['Figtree', ...defaultTheme.fontFamily.sans],
    },
    },
  },
  plugins: [],
}

