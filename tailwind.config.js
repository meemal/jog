module.exports = {
  content: [
    "./*.php",
    "./**/*.html",
    "./assets/js/**/*.js",
    "./templates/**/*.php",
  ],
  safelist: [
    "font-hwt", 
    "font-hwt_regular",
    "tab-content",
  ],
  theme: {
    extend: {
      colors: {
        'mill-red': '#9A0F1E',
        'mill-red-high': '#B81E26',
        'mill-blue': '#6899BF',
        'mill-blue-light': '#A4C8E1',
        'mill-smoke': '#787573',
        'mill-smoke-light': '#b0b2b4',
        'mill-warm-grey': '#474341',
        'mill-peach-light': '#e2c5d1',
        'mill-warm-oatmeal': '#E2D6C5',
        'mill-warm-oatmeal-light': '#F4EDE6',
        'mill-dark-grey': '#2C2C2C'
      },
      fontFamily: {
        brother: ['"brother-1816"', 'sans-serif'],
        artz: ['"hwt-artz"', 'sans-serif'],
      },
      fontWeight: {
        light: '200',
        normal: '400',
        bold: '700',
      },
      screens: {
        ssm: '500px',
      },
    },
  },
  plugins: [], // Keep this as an array, even if empty
};
