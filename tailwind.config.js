

module.exports = {
  theme: {
    extend: {
      fontFamily: {
        sans: ['"Noto Sans JP"', '-apple-system', 'sans-serif']
      }
    }
  },
  variants: {},
  plugins: [
    function({ addBase, config }) {
      addBase({
        'html': { fontFamily: config('theme.fontFamily.sans').join(', ') },
        'h1': { fontSize: config('theme.fontSize.2xl') },
        'h2': { fontSize: config('theme.fontSize.xl') },
        'h3': { fontSize: config('theme.fontSize.lg') },
      })
    },
  ]
}
