<?php
/**
 * Plugin Name:   Autoloader example plugin
 * Plugin URI:
 * Description:   This is an example of how to load classes in a plugin and without composer autoload.
 * Version:       1.0.0
 * Author:        Adrien
 * Author URI:
 * License:       MIT
 * License URI:   http://opensource.org/licenses/MIT
 */

spl_autoload_register(function ($className) {
  $pathParts = array(__DIR__, 'src');
  $className = str_replace('_', '-', $className); // Convention: underscores in class names, hyphens in file names.
  $className = ltrim($className, '\\');
  $namespace = '';

  if ($lastNsPos = strrpos($className, '\\')) {
    $namespace = substr($className, 0, $lastNsPos);
    $namespace = str_replace('\\', DIRECTORY_SEPARATOR, $namespace);
    $pathParts[] = $namespace;

    $className = substr($className, $lastNsPos + 1);
  }

  $pathParts[] = $className . '.php';
  $path = implode(DIRECTORY_SEPARATOR, $pathParts);

  if (file_exists($path)) {
    require_once $path;
  }
});

use custom_plugin_root;
use custom_plugin\custom_plugin;

custom_plugin_root::coucou();
new custom_plugin();
