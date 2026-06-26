<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'ana' ); ?></a>
    <header id="masthead" class="site-header container-fluid">
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
            <nav id="main-navigation" class="main-navigation iranSans">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12.9056 14.3199C11.551 15.3729 9.84871 16 8 16C3.58172 16 0 12.4183 0 8C0 3.58172 3.58172 0 8 0C12.4183 0 16 3.58172 16 8C16 9.84871 15.3729 11.551 14.3199 12.9056L19.7071 18.2929C20.0976 18.6834 20.0976 19.3166 19.7071 19.7071C19.3166 20.0976 18.6834 20.0976 18.2929 19.7071L12.9056 14.3199ZM14 8C14 11.3137 11.3137 14 8 14C4.68629 14 2 11.3137 2 8C2 4.68629 4.68629 2 8 2C11.3137 2 14 4.68629 14 8Z" fill="#0A3F5A"/>
                </svg>
                <?php
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'container'      => false,
                    'menu_class'     => 'primary-menu',
                ]);
                ?>
            </nav>
            <div class="header-cta iranSans_bold">
                <a href="<?php echo esc_url( home_url( '/consultation' ) ); ?>" class="Anabtn btn-DeepOceanBlue-outline">درخواست مشاوره</a>
                <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="Anabtn btn-DeepOceanBlue">تماس با ما</a>
            </div>
            <button id="menu-toggle" class="menu-toggle" aria-label="منوی موبایل">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </header>
    <div id="content" class="site-content">