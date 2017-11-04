<?php

// Load in our JS
function jsforwp_enqueue_scripts() {

  // Only load if on 'custom.php' template
  if( is_page_template( 'custom.php' ) ) {


    // Set a unique handle to 'jsforwp-theme-js'
    // Change the path to to file to /assets/js/theme.js
    wp_enqueue_script(
      '__CHANGE__',
      get_template_directory_uri() . '__CHANGE__',
      [],
      time(),
      true
    );


    // Change first value to 'jsforwp-theme-js'
    // Change second value to 'jsforwp_globals'
    wp_localize_script(
      '__CHANGE__',
      '__CHANGE__',
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
