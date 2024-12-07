/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        'bghdcl': '#f8f8f8',
        'bgftcl': '#4c5175',
        'bgcl': '#f2f4fa',
        // 'bghdcl': '#f1f2e4',
        // 'bgftcl': '#49b090',
        // 'bgcl': '#d0f6d0',
        'txcl': '#f2f2f2',
        // 'bghdcl': '#f2f2f2',
        // 'bgftcl': '#517eb9',
        // 'bgcl': '#c5dbe9',
        'cardcl': '#f2f4ff',
      },
    },
  },
  plugins: [],
}