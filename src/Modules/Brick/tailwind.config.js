/** @type {import('tailwindcss').Config} */
module.exports = {
  prefix: "tw-",
  content: [
    "./Views/**/*.blade.php",
    "./Views/**/*.js",
    "./Views/**/*.vue",
  ],
  theme: {
      container: {
          center: true,
          padding: {
            DEFAULT: '1rem',
            sm: '2rem',
            lg: '4rem',
            xl: '5rem',
            '2xl': '6rem',
          },
      },
    extend: {},
  },
  plugins: [],
}
