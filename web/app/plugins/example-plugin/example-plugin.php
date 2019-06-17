<?php
/**
 * Plugin Name: Example plugin
 * Plugin URI:
 * Description: This is an example OOP PSR-4 plugin.
 * Version: 1.0.0
 * Author: Adrien
 * Author URI:
 * License: MIT
 * License URI: http://opensource.org/licenses/MIT
 */

if ( ! defined( 'ABSPATH' ) ) {
  die( 'Access denied.' );
}

require_once __DIR__ . "/src/ExamplePlugin/Loader.php";
ExamplePlugin\Loader::setup( __DIR__, '5.0' );

use ExamplePlugin\Plugin;

Plugin::addActions();
