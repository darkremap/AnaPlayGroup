<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'ana' ); ?></a>

    <header id="masthead" class="site-header">

        <div class="header-inner">

            <div class="site-branding">

                <a href="<?php echo esc_url(home_url('/')); ?>">

                    <?php
                    if ( function_exists('the_custom_logo') ) {
                        the_custom_logo();
                    }
                    ?>

                </a>

            </div>

            <nav id="main-navigation" class="main-navigation">

                <?php
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'container'      => false,
                    'menu_class'     => 'primary-menu',
                ]);
                ?>

            </nav>

            <div class="header-cta">

                <a href="#consultation" class="header-btn">
                    درخواست مشاوره
                </a>

            </div>

            <button id="menu-toggle" class="menu-toggle">

                <span></span>
                <span></span>
                <span></span>

            </button>

        </div>

    </header>

    <div id="content" class="site-content">