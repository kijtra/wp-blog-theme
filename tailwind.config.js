

module.exports = {
  theme: {
    fontFamily: {
      sans: ['"Noto Sans JP"', '-apple-system', 'sans-serif']
    }
    // extend: {
    //   fontFamily: {
    //     sans: ['"Noto Sans JP"', '-apple-system', 'sans-serif']
    //   }
    // }
  },
  variants: {},
  plugins: [
    function({ addBase, config }) {
      addBase({
        'h1': { fontSize: config('theme.fontSize.4xl'), fontWeight: config('theme.fontWeight.bold') },
        'h2': { fontSize: config('theme.fontSize.2xl'), fontWeight: config('theme.fontWeight.bold') },
        'h3': { fontSize: config('theme.fontSize.xl'), fontWeight: config('theme.fontWeight.bold') },
      })
    },
  ]
}
