<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header id="masthead" class="site-header" role="banner">
        <nav id="site-navigation" class="main-navigation" role="navigation">

        <div class="site-branding">
            <?php
                $logo = get_theme_mod('theme_logo');
                if ($logo) {
                    echo '<img src="' . esc_url($logo) . '" alt="' . get_bloginfo('name') . '">';
                } else {
                    echo '<h1>' . get_bloginfo('name') . '</h1>';
                }
            ?>
        </div><!-- .site-branding -->

        <?php wp_nav_menu( array( 'theme_location' => 'header' ) ); ?>
        
        </nav><!-- #site-navigation -->
    </header><!-- #masthead -->

    <div id="content" class="site-content">