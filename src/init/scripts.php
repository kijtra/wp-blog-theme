<?php

add_action('wp_enqueue_scripts', function () {
  wp_enqueue_style('app', mix('/style.css'), [], null);
  wp_enqueue_style('print', mix('/print.css'), [], null, 'print');

  // jQuery関連を削除
  wp_deregister_script('jquery');

  // Google Fontsを使う場合
  wp_enqueue_script('webfont', 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js', [], null, false);
  wp_add_inline_script('webfont', 'WebFont.load(' . json_encode([
      'google' => [
          'families' => [
              'Material Icons',
              'Noto Sans JP:400,700',
          ],
      ],
  ]) . ');');

  // IE用Polyfill
  // wp_enqueue_script('app-polyfill', 'https://polyfill.io/v3/polyfill.min.js', [], null, true);

  wp_enqueue_script('app-manifest', mix('/js/manifest.js'), null, null, true);
  wp_enqueue_script('app-vendor', mix('/js/vendor.js'), ['app-manifest'], null, true);
  wp_enqueue_script('app', mix('/js/app.js'), ['app-manifest'], null, true);

  // インライン
  $conf = [
      'base_url' => home_url(),
      'theme_url' => get_template_directory_uri(),
      'rest_url' => rest_url(),
  ];

  wp_localize_script('app-manifest', '_cfg', $conf);


  wp_dequeue_style('wp-block-library');
  wp_dequeue_style('wp-block-library-theme');

  wp_dequeue_style('mkaz-code-syntax-css');
  wp_dequeue_style('mkaz-code-syntax-prism-css');
  wp_deregister_script('mkaz-code-syntax-prism-css');
  wp_deregister_script('mkaz-code-syntax-prism-settings');
});

add_action('admin_enqueue_scripts', function () {
  wp_deregister_style('wp-editor-font');
  // wp_dequeue_style('wp-editor-font');
  wp_enqueue_style('wp-editor-font', 'https://fonts.googleapis.com/css?family=Noto+Sans+JP%3A400%2C700');
});

add_filter('the_content', function($content) {
  /*
  preg_match_all('#(<pre[^>]*?class="([^"]+)"[^>]*?>)[^<]*?<code#isu', $content, $matches);
  if (!empty($matches[1])) {
    foreach ($matches[1] as $key => $pre) {
      $class = $matches[2][$key];
      $rep = str_replace($class, $class.' sm:-mx-6 md:mx-0', $pre);
      $content = str_replace($pre, $rep, $content);
    }
  }
  */

  preg_match_all('#(<pre[^>]*?>[^<]*?<code[^>]*?lang=[\'"]([^\'"]+)[\'"][^>]*?>)#isu', $content, $matches);
  if (!empty($matches[1])) {
    foreach ($matches[1] as $key => $pre) {
      $lang = $matches[2][$key];
      $rep = str_replace('<pre ', '<pre lang="'.$lang.'" ', $pre);
      $content = str_replace($pre, $rep, $content);
    }
  }

  return $content;
}, 100);
