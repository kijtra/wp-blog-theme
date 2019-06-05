const mix = require('laravel-mix');
require('laravel-mix-tailwind');

mix
  .options({
    processCssUrls: false,
    postCss: [
      require('autoprefixer')(),
      require('css-mqpacker')()
    ]
  })
  .sourceMaps(!mix.inProduction())
  .version()
  .extract([
    'axios',
    'vue'
  ])
  .setPublicPath('./')
  .js('resources/js/app.js', 'js/')
  .sass('resources/sass/app.scss', 'style.css')
  .sass('resources/sass/print.scss', 'print.css')
  .sass('resources/sass/style-editor.scss', 'style-editor.css')
  .tailwind('tailwind.config.js');
