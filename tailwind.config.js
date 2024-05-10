/** @type {import('tailwindcss').Config} */
const defaultTheme = require('tailwindcss/defaultTheme')
module.exports = {
    content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
      "./node_modules/flowbite/**/*.js"
    ],
    theme: {
      extend: {
        colors:{
            primary: '#0F4A3A'
        },
        fontFamily: {
            sans: ['Inter var', ...defaultTheme.fontFamily.sans],
          },
      },
    },
    plugins: [
        require('flowbite/plugin')
    ],
  }


