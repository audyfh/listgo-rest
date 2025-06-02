/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./view/**/*.{html,js,php}",
     "./js/**/*.js"
  ],
  theme: {
    extend: {
        fontFamily: {
        poppins: ['Poppins', 'sans-serif'],
      },
      colors: {
        customBlue: {
          light: '#f2f7fe',
          'light-hover': '#ecf3fd',
          'light-active': '#d7e7fa',
          normal: '#7fb2f0',
          'normal-hover': '#72a0d8',
          'normal-active': '#668ec0',
          dark: '#5f86b4',
          'dark-hover': '#4c6b90',
          'dark-active': '#39506c',
          darker: '#2c3e54',
        },
      },
    },
  },
  plugins: [],
}

