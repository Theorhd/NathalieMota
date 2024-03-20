<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header id="masthead" class="site-header" role="banner">
        <nav id="site-navigation" class="main-navigation" role="navigation">

        <div class="site-branding">
            <?php
                $logo = get_theme_mod('theme_logo');
                if ($logo) {
                    echo '<a href="' . get_home_url() . '" ><img src="' . esc_url($logo) . '" alt="' . get_bloginfo('name') . '"></a>';
                } else {
                    echo '<h1>' . get_bloginfo('name') . '</h1>';
                }
            ?>
        </div><!-- .site-branding -->

        <button class="menu-toggle">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </button>

        <div class="menuHeader">
            <?php wp_nav_menu( array( 'theme_location' => 'header' ) ); ?>
        </div>

        </nav><!-- #site-navigation -->
    </header><!-- #masthead -->

    <div id="content" class="site-content">

        <div class="mobile-menu">   
            <?php wp_nav_menu( array( 'theme_location' => 'header' ) ); ?>
        </div>