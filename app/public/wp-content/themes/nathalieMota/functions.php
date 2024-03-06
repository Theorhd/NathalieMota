<?php

function register_header_menu() {
  register_nav_menu('header',__( 'Header Menu' ));
}
add_action( 'init', 'register_header_menu' );

function register_footer_menu() {
    register_nav_menu('footer',__( 'Footer Menu' ));
  }
  add_action( 'init', 'register_footer_menu' );

  function load_google_fonts() {
    wp_enqueue_style('space-mono-font', 'https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap');
    wp_enqueue_style('poppins', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
}
add_action('wp_enqueue_scripts', 'load_google_fonts');