<?php

namespace ExamplePlugin\PostType;

class Agency {

  public static function onInit() {
    $labels = array(
      'name' => _x( 'Agencies', 'Post Type General Name' ),
      'singular_name' => _x( 'Agency', 'Post Type Singular Name' ),
      'menu_name' => __( 'Agencies' ),
      'all_items' => __( 'All agencies' ),
      'view_item' => __( 'View agencies' ),
      'add_new_item' => __( 'Add a new agency' ),
      'add_new' => __( 'Add' ),
      'edit_item' => __( 'Edit' ),
      'update_item' => __( 'Update' ),
      'search_items' => __( 'Search' ),
      'not_found' => __( 'No agency found.' ),
      'not_found_in_trash' => __( 'No agency found in trash.' ),
    );

    $args = array(
      'label' => __( 'Agencies' ),
      'labels' => $labels,
      'supports' => array( 'title', 'custom-fields' ),
      'show_in_rest' => TRUE,
      'hierarchical' => TRUE,
      'public' => TRUE,
      'has_archive' => FALSE,
      'rewrite' => array( 'slug' => 'agencies'),
      'menu_icon' => 'dashicons-admin-multisite',
    );

    register_post_type( 'agency', $args );
  }

}
