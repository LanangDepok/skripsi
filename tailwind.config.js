/** @type {import('tailwindcss').Config} */
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
        }
      },
    },
    plugins: [
        require('flowbite/plugin')
    ],
  }


