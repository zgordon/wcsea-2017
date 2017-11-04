<?php

// Load in our JS
function jsforwp_enqueue_scripts() {

  if( is_page_template( 'custom.php' ) ) {

    // Make dependent on 'jquery'
    wp_enqueue_script(
      'jsforwp-theme-js',
      get_stylesheet_directory_uri() . '/assets/js/theme.js',
      [ '__CHANGE__' ],
      time(),
      true
    );

    wp_localize_script(
      'jsforwp-theme-js',
      'jsforwp_globals',
      [
        'rest_url' => esc_url( rest_url() )
      ]
    );

  }

}
add_action( 'wp_enqueue_scripts', 'jsforwp_enqueue_scripts' );

// Load in our CSS
function jsforwp_enqueue_styles() {

  wp_enqueue_style( 'roboto-slab-font-css', 'https://fonts.googleapis.com/css?family=Roboto+Slab', [], '', 'all' );
  wp_enqueue_style( 'main-css', get_stylesheet_directory_uri() . '/style.css', ['roboto-slab-font-css'], time(), 'all' );
  wp_enqueue_style( 'custom-css', get_stylesheet_directory_uri() . '/assets/css/custom.css', [ 'main-css' ], time(), 'all' );

}
add_action( 'wp_enqueue_scripts', 'jsforwp_enqueue_styles' );

require_once( 'assets/lib/functions-extended.php' );

?>
