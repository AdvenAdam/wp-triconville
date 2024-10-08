/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./*.php", "./pages/*.php", "./page-builder/*.html", "./inc/blocks/*.php", "./inc/blocks/**/*.php"],
  theme: {
    extend: {
      fontFamily: {
        sans: ["Helvetica Neue", "sans-serif"],
        serif: ["Lora", "serif"],
      },
      fontSize: {
        "3xl": [
          "2rem",
          {
            lineHeight: "3rem",
          },
        ],
        "4xl": "2.5rem",
      },
      colors: {
        "shadow-image": "#f8f8f8",
      },
    },
  },
  plugins: [require("@tailwindcss/typography")],
};
