module.exports = {
  // mode: 'jit', // Enable Just-In-Time mode
  plugins: {
    tailwindcss: {},
    autoprefixer: {},
  },
  content: [
    "./**/*.php",
    "./**/*.html",
    "./assets/js/**/*.js",
    "./templates/**/*.php",
    "./assets/css/**/*.css", // Include CSS files
  ],
  safelist: [
    "font-hwt", 
    "font-hwt_regular",
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
      // fontFamily: {
      //   hwt: ["HWT_Artz", "sans-serif"],
      //   hwt_regular: ["HWT_Artz_Regular", "sans-serif"],
      //   hwt_light: ["HWT_Artz_light", "sans-serif"], // Fixed Typo
      // },
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
        // md: '768px', // Or 800px if needed
        // lg: '1524px',
        // xl: '1980px',
      },
    },
  },
  plugins: [],
}


