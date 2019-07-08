<?php

function dacsite_setup() {
  add_theme_support( 'title-tag' );
  show_admin_bar( false );
}

add_action( 'after_setup_theme', 'dacsite_setup' );

function dacsite_scripts() {
  // Load our main stylesheet.
  wp_enqueue_style( 'dacsite-style', get_stylesheet_uri() );

  // Load our javascript.
  wp_enqueue_script( 'dacsite-script', get_template_directory_uri() . 'assets/js/main.js', array(), '20190708', true);

}

add_action( 'wp_enqueue_scripts', 'dacsite_scripts' );

?>