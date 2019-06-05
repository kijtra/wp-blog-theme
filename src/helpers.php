<?php

if (!function_exists('mix')) {
  /**
   * Get the path to a versioned Mix file.
   *
   * @param  string  $path
   * @param  string  $manifestDirectory
   * @return \Illuminate\Support\HtmlString|string
   *
   * @throws \Exception
   */
  function mix($path)
  {
      static $manifest;

      $manifestDirectory = get_stylesheet_directory();

      if (null === $manifest) {
          $manifestPath = $manifestDirectory . DIRECTORY_SEPARATOR . 'mix-manifest.json';
          if (file_exists($manifestPath)) {
              $manifest = json_decode(file_get_contents($manifestPath), true);
          } else {
              throw new \Exception('The Mix manifest does not exist.');
          }
      }

      if (0 === strpos($path, 'http')) {
          return $path;
      }

      $path = '/' . ltrim($path, '/');

      if (isset($manifest[$path])) {
          return get_stylesheet_directory_uri() . $manifest[$path];
      } elseif (is_file(get_stylesheet_directory() . $path)) {
          return get_stylesheet_directory_uri() . $path;
      }
  }
}
