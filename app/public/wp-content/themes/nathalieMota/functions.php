<?php
// Styles & Scripts
function load_scripts() {
  wp_enqueue_script( 'jq3.7.1', 'https://code.jquery.com/jquery-3.7.1.min.js', array(), '3.7.1', false);
  wp_enqueue_style('style', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
  wp_enqueue_script( 'scripts', get_template_directory_uri() . '/assets/js/scripts.js' , array(), '1.0', false);
}
add_action('wp_enqueue_scripts', 'load_scripts');
// Menus
function register_menus() {
  register_nav_menu('header',__( 'Header Menu' )); // Header Menu
  register_nav_menu('footer',__( 'Footer Menu' )); // Footer Menu
}
add_action( 'init', 'register_menus' );
// Logo
add_theme_support('custom-logo');
function theme_logo_customizer($wp_customize) {
  // Ajouter une section pour le logo
  $wp_customize->add_section('theme_logo_section', array(
      'title'    => __('Logo', 'nathalieMota'),
      'priority' => 30,
  ));
  // Ajouter le contrôle du logo
  $wp_customize->add_setting('theme_logo', array(
      'default'           => '',
      'sanitize_callback' => 'esc_url_raw',
  ));

  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'theme_logo', array(
      'label'    => __('Sélectionner le logo', 'nathalieMota'),
      'section'  => 'theme_logo_section',
      'settings' => 'theme_logo',
  )));
}
add_action('customize_register', 'theme_logo_customizer');
// Google Fonts
function load_google_fonts() {
  wp_enqueue_style('space-mono-font', 'https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap');
  wp_enqueue_style('poppins', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
}
add_action('wp_enqueue_scripts', 'load_google_fonts');