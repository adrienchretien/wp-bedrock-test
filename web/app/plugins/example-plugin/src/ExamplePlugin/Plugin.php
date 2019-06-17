<?php

namespace ExamplePlugin;

class Plugin {

  public static function addActions() {
    add_action( 'init', 'ExamplePlugin\PostType\Agency::onInit' );
  }

}
