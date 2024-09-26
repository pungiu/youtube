/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/**/*.{html,js}"],
  theme: {
    colors: {
      'darkMode':'#191919',
      'testr':'red',
      'testg':'green',
      'darkWhite':'#FFFFFF1A',
      'darkBox':'#FFFFFF4D',
      'white':'#fff'
    },
    screens: {
        'nor': '512px',
        'fre': '640px',
    },
    extend: {},
  },
  plugins: [],
}

