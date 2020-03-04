<?php

namespace Roots\Sage\Assets;

/**
 * Get paths for assets
 */
class JsonManifest {
  private $manifest;

  public function __construct($manifest_path) {
    $this->manifest = json_decode(file_get_contents($manifest_path), true);
  }

  public function get() {
    return $this->manifest;
  }

  public function getPath($key = '', $default = null) {
    $collection = $this->manifest;
    if (is_null($key)) {
      return $collection;
    }
    if (isset($collection[$key])) {
      return $collection[$key];
    }
    foreach (explode('.', $key) as $segment) {
      if (!isset($collection[$segment])) {
        return $default;
      } else {
        $collection = $collection[$segment];
      }
    }
    return $collection;
  }
}

function asset_path($filename) {
  $dist_path = get_template_directory_uri() . '/dist/';
  $directory = dirname($filename) . '/';
  $file = basename($filename);
  static $manifest;

  if (empty($manifest)) {
    if ($_ENV['WP_ENV'] == 'development') {
      $ip = rtrim(shell_exec('netstat -rn | grep ^0.0.0.0 | awk \'{ print $2 }\''));
      $manifest_path = "http://$ip:18080/manifest.json";
    } else {
      $manifest_path = get_template_directory() . '/dist/' . 'manifest.json';
    }

    $manifest = new JsonManifest($manifest_path);
  }

  if (array_key_exists($file, $manifest->get())) {
    // var_dump($manifest->get()[$file]);
    return $manifest->get()[$file];
  } else {
    // TODO: this will raise an error once all of this is sorted
    // throw new Exception('Could not find asset');
  }
}
