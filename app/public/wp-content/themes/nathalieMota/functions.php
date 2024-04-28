<?php
// Styles & Scripts
function load_scripts() {
  wp_dequeue_script('jquery-migrate-js'); // Deregister jQuery Migrate de WordPress
  wp_enqueue_script( 'jq3.7.1', 'https://code.jquery.com/jquery-3.7.1.min.js', array(), '3.7.1', false); // jQuery 3.7.1
  wp_enqueue_style('style', get_template_directory_uri() . '/style.css', array(), '1.0', 'all'); // Main Stylesheet
  wp_enqueue_script( 'scripts', get_template_directory_uri() . '/assets/js/scripts.js' , array(), '1.0', false); // Main Scripts
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
// Ajouter la prise en charge des miniatures pour les types de post personnalisés
add_action( 'after_setup_theme', 'theme_setup' );
function theme_setup() {
    add_theme_support( 'post-thumbnails', array( 'photo' ) );
}
// Google Fonts
function load_google_fonts_local() {
  wp_enqueue_style('space-mono-font', get_template_directory_uri(  ) . '/assets/fonts/spaceMono/spacemono.css');
  wp_enqueue_style('poppins', get_template_directory_uri(  )  . '/assets/fonts/poppins/poppins.css');
}
add_action('wp_enqueue_scripts', 'load_google_fonts_local');
// Ajax
/**!! Dépendance a ajax_pagination.js !!**/
function load_ajax_pagination() {
  wp_enqueue_script('ajax-pagination', get_template_directory_uri() . '/assets/js/ajax_pagination.js', array(), '1.0', false);
  wp_localize_script('ajax-pagination', 'ajaxpagination', array(
      'ajaxurl' => admin_url('admin-ajax.php'),
      'noposts' => __('No older posts found', 'nathalieMota'),
  ));
}
add_action('wp_enqueue_scripts', 'load_ajax_pagination');
  // Pagination
add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');
  // Chargement des photos page accueil et filtres AJAX
function load_more_photos() {
  $page = $_POST['page'];
  $categories = $_POST['categories'];
  $formats = $_POST['formats'];
  $sort = $_POST['sort'];

  $args = array(
      'post_type'      => 'photo',
      'posts_per_page' => 8,
      'paged'          => $page,
  );
  // Filtres
  if ($categories != 'all') { // Filtre par catégories
      $args['tax_query'] = array(
          array(
              'taxonomy' => 'category',
              'field'    => 'slug',
              'terms'    => $categories,
          ),
      );
  }
  if ($formats != 'all')  {  // Filtre par formats
      $args['meta_query'] = array(
          array(
              'key'     => 'format',
              'value'   => $formats,
              'compare' => '=',
          ),
      );
  }
  if ($sort != 'all') { // Trier par date
    if ($sort == 'date+') {
        $args['orderby'] = 'date';
        $args['order']   = 'DESC';
    } elseif ($sort == 'date-') {
        $args['orderby'] = 'date';
        $args['order']   = 'ASC';
    }
}
  $custom_query = new WP_Query($args);
  if ($custom_query->have_posts()) :
      while ($custom_query->have_posts()) :
          $custom_query->the_post();
          $image_url = get_field('image')['url'];
          $post_url  = get_permalink();
          $post_id   = get_the_ID();
          $refphoto = get_field('ref_photo');
          $category = get_the_category()[0]->name;

          if ($image_url) {
            echo '<a href="' . $post_url . '" class="post-link"><div class="image-overlay"><button class="overlay-fullscreen" data-photourl="' . $image_url . '" data-ref="' . $refphoto .'" data-category="' . $category .'"></button><div class="overlay-logo"></div><div class="overlay-infos"><p>' . $refphoto . '</p><p>' . $category . '</p></div></div><img src="' . esc_url($image_url) . '" alt="' . esc_attr(get_the_title()) . '"></a>';
          }
      endwhile;
      wp_reset_postdata();
  else :
      echo '';
  endif;
  wp_die();
}
