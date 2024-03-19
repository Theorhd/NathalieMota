<?php
// Styles & Scripts
function load_scripts() {
  wp_dequeue_script('jquery-migrate-js');
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
// Ajouter la prise en charge des miniatures pour les types de post personnalisés
add_action( 'after_setup_theme', 'theme_setup' );
function theme_setup() {
    add_theme_support( 'post-thumbnails', array( 'photo' ) );
}
// Google Fonts
function load_google_fonts() {
  wp_enqueue_style('space-mono-font', 'https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap');
  wp_enqueue_style('poppins', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
}
add_action('wp_enqueue_scripts', 'load_google_fonts');
// Ajax
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

function load_more_photos() {
    $page = $_POST['page'];
    $categories = $_POST['categories'];
    $formats = $_POST['formats'];
    $sort = $_POST['sort'];

    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 8,
        'paged' => $page,
    );

    if($categories != 'all') {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => $categories,
            ),
        );
    }

    if($formats != 'all') {
        $args['meta_query'] = array(
            array(
                'key' => 'format',
                'value' => $formats,
                'compare' => '=',
            ),
        );
    }

    if($sort != 'all') {
        $args['orderby'] = $sort;
        if($sort == 'date') {
            $args['order'] = 'DESC';
        } else {
            $args['order'] = 'ASC';
        }
    }

    $custom_query = new WP_Query($args);

    if ($custom_query->have_posts()) :
        while ($custom_query->have_posts()) :
            $custom_query->the_post();
            $image_url = get_field('image')['url'];
            $post_url = get_permalink();
            if ($image_url) {
                echo '<a href="' . $post_url . '"><img src="' . esc_url($image_url) . '" alt="' . esc_attr(get_the_title()) . '"></a>';
            }
        endwhile;
        wp_reset_postdata();
    else :
        echo '';
    endif;

    wp_die();
}