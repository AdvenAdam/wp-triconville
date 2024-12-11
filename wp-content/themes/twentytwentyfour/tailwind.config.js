/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.php",
    "./pages/*.php",
    "./page-builder/*.html",
    "./page-builder/news/*.html",
    "./inc/blocks/*.php",
    "./inc/blocks/**/*.php",
  ],
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
        "5xl": ["3rem", { lineHeight: "4.5rem" }],
      },
      letterSpacing: {
        wider: ".07em",
      },
      colors: {
        "shadow-image": "#f8f8f8",
        "triconville-blue": "#10A1CF",
        "triconville-beige": "#EBE9E0",
        "triconville-black": "#3C3E3E",
      },
    },
  },
  plugins: [require("@tailwindcss/typography")],
};
