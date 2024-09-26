/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./*.php", "./pages/*.php", "./page-builder/*.html"],
  theme: {
    theme: {
      fontFamily: {
        sans: ['"karla"', "sans-serif"],
      },
    },
    extend: {
      colors: {
        "shadow-image": "#f8f8f8",
      },
    },
  },
  plugins: [require("@tailwindcss/typography")],
};
