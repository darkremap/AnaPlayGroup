<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'ana' ); ?></a>

    <header id="masthead" class="site-header" role="banner">
        <div class="header-inner">
            <div class="site-branding">
                <?php
                if ( function_exists( 'the_custom_logo' ) ) {
                    the_custom_logo();
                }
                if ( is_front_page() && is_home() ) : ?>
                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
                <?php else : ?>
                    <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></p>
                <?php endif;

                $description = get_bloginfo( 'description', 'display' );
                if ( $description || is_customize_preview() ) : ?>
                    <p class="site-description"><?php echo $description; ?></p>
                <?php endif; ?>
            </div>

            <nav id="main-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'ana' ); ?>">
                <button id="menu-toggle" class="menu-toggle" aria-expanded="false" aria-controls="primary-menu">
                    <span class="menu-icon" aria-hidden="true"></span>
                    <span class="menu-label"><?php esc_html_e( 'Menu', 'ana' ); ?></span>
                </button>

                <?php
                if ( has_nav_menu( 'primary' ) ) {
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'container'      => false,
                        'menu_class'     => 'primary-menu',
                    ) );
                } else {
                    // Fallback: output pages as a navigable list with the expected IDs/classes
                    wp_page_menu( array(
                        'menu_id'    => 'primary-menu',
                        'menu_class' => 'primary-menu',
                        'show_home'  => true,
                    ) );
                }
                ?>
            </nav>

            <!-- <div class="header-actions">
                <?php get_search_form(); ?>
            </div> -->
        </div>
    </header>

    <div id="content" class="site-content">