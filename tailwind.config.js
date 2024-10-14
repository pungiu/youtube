/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/**/*.{php,html,js}"],
 darkMode: 'class', 
 theme: {
    boxShadow: {
      'default': '0px 4px 4px 0px rgba(0, 0, 0, 0.25)',
    },
    colors: {
      'darkMode':'#191919',
      'testr':'red',
      'testg':'green',
      'darkWhite':'#FFFFFF1A',
      'darkBox':'#FFFFFF4D',
      'white':'#fff',
      'black': '#000000',
      'blured': '#5E5E5E80',
      'ico': '#E8EAED',
      'red': '#E50000',
      'crayon': '#40e0d0',
      'seaweed': '#061614',
      'thumdiv': 'rgba(255, 255, 255, 0.10)',
      'transparent': 'rgba(255, 255, 255, 0)',
      'gray': 'var(--Neutral-Gray-4, #AFAFAF)',
      'green': '#51D651',

      'whitemode': '#F1F1F1',
      'whiteback': 'rgba(0, 0, 0, 0.10)',
    },
    screens: {
        'nor': '512px',
        'fre': '640px',
    },
    spacing: {
      '0':'0',
        '1': '0.25rem',
        '2': '0.5rem',
        '3': '0.75rem',
        '4': '1rem',
        '5': '1.25rem',
        '6': '1.5rem',
        '7': '1.75rem',
        '8': '2rem',
        'thin': '6px',
        '9': '8px',
        'se': '10px',
        '10': '12px',
        '11': '14px',
        '12': '16px',
        'half': '30px',
        '13': '60px',
        'sto': '100px',
        'thum': '128px',
        'crip': '291px',
        '72': '32rem',
        '84': '36rem',
        '96': '46rem',
        'bar': '264px',

        'thuW': '406px',
        'sideDesk':'610px',
    },
    borderRadius: {
      "sharp": '14px',
      'meh':'10px',
      'full': '100%',
      'md': '0.375rem',
    },
    extend: {
      backdropBlur: {
          xs: '10px',
          xl:'6px',
      },
      boxShadow: {
        inner: 'inset 0 -10px 10px 0 rgba(0, 0, 0, 0.20)',
      },
      backgroundImage: {
        'hero-pattern': "url('resources/wallpaper_video.gif')",
       }
    },
  },
  corePlugins: {
    aspectRatio: false,
  },
  plugins: [
    require('@tailwindcss/aspect-ratio'),
  ],
}
