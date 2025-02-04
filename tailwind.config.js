import defaultTheme from 'tailwindcss/defaultTheme';

export default {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily: {
          sans: ['Figtree', ...defaultTheme.fontFamily.sans],
      },
      colors: {
          'bg': '#dde5e8',
          'navbar': '#577c8e',
          'txtl': '#5c787e',
          'txtd': '#eae6e2',
          'btn': '#2f4157',
          'btnh': '#577c8e',
          'footer': '#2f4157',
          'secondary': '#bb1f04',
          'secondary2': '#e22808',
      },
  },
  },
  plugins: [],
}