<?php

namespace ExamplePlugin;

abstract class Loader {

  /**
   * Load all classes from a plugin directory.
   *
   * @param string $dir The path to the plugin directory, ie: __DIR__.
   */
  public static function autoload( $dir ) {
    spl_autoload_register( function ( $className ) use ( $dir ) {
      $pathParts = array( $dir, 'src' );
      $className = str_replace( '_', '-', $className ); // Convention: underscores in class names, hyphens in file names
      $className = ltrim( $className, '\\' );
      $namespace = '';

      if ( $lastNsPos = strrpos( $className, '\\' ) ) {
        $namespace = substr( $className, 0, $lastNsPos );
        $namespace = str_replace( '\\', DIRECTORY_SEPARATOR, $namespace );
        $pathParts[] = $namespace;

        $className = substr( $className, $lastNsPos + 1 );
      }

      $pathParts[] = $className . '.php';
      $path = implode( DIRECTORY_SEPARATOR, $pathParts );

      if ( file_exists( $path ) ) {
        require_once $path;
      }
    } );
  }

  /**
   * Check if PHP and WordPress requirements are met.
   *
   * @param array $requirements An array of requirements arrays composed with 3 values to pass to PHP version_compare().
   */
  public static function requirementsOk( $requirements = array() ) {
    $result = TRUE;

    foreach ( $requirements as $req) {
      $result = $result && version_compare( $req['v1'], $req['v2'], $req['op'] );
    }

    return $result;
  }

  /**
   * Loader entry point.
   *
   * @param string $dir The path to the plugin directory, ie: __DIR__.
   * @param string $pluginWpVersion WordPress minimum version.
   * @param string $pluginPhpVersion PHP minimum version.
   */
  public static function setup( $dir, $pluginWpVersion = '', $pluginPhpVersion = '' ) {
    global $wpVersion;

    $requirements = array();

    if ( $pluginWpVersion ) {
      $requirements[] = array( 'v1' => $wpVersion, 'v2' => $pluginWpVersion, '>=' );
    }

    if ( $pluginPhpVersion ) {
      $requirements[] = array( 'v1' => PHP_VERSION, 'v2' => $pluginPhpVersion, '>=' );
    }

    if ( static::requirementsOk() ) {
      static::autoload( $dir );
    } else {
      throw new \Exception( "Plugin classes can't be loaded." );
    }
  }

}
