<?php
/**
 * ANA theme functions and definitions.
 *
 * @package ANA
 */

if ( ! function_exists( 'ana_setup' ) ) {
    function ana_setup() {
        load_theme_textdomain( 'ana', get_template_directory() . '/languages' );

        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'responsive-embeds' );
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        ) );
        add_theme_support( 'custom-logo', array(
            'height'      => 80,
            'width'       => 300,
            'flex-width'  => true,
            'flex-height' => true,
        ) );
        add_theme_support( 'custom-background', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ) );

        register_nav_menus( array(
            'primary' => __( 'Primary Menu', 'ana' ),
            'footer'  => __( 'Footer Menu', 'ana' ),
        ) );
    }
}
add_action( 'after_setup_theme', 'ana_setup' );

/**
 * Set content width for the theme.
 */
function ana_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'ana_content_width', 1200 );
}
add_action( 'after_setup_theme', 'ana_content_width', 0 );

/**
 * Enqueue theme styles and scripts.
 */
function ana_scripts() {
    $theme_version = wp_get_theme()->get( 'Version' );

    wp_enqueue_style( 'ana-style', get_stylesheet_uri(), array(), $theme_version );

    $main_css_path = get_theme_file_path( 'assets/css/app.css' );
    if ( file_exists( $main_css_path ) ) {
        wp_enqueue_style( 'ana-main-css', get_theme_file_uri( 'assets/css/app.css' ), array( 'ana-style' ), filemtime( $main_css_path ) );
    }

    $navigation_js_path = get_theme_file_path( 'assets/js/navigation.js' );
    if ( file_exists( $navigation_js_path ) ) {
        wp_enqueue_script( 'ana-navigation', get_theme_file_uri( 'assets/js/navigation.js' ), array( 'jquery' ), filemtime( $navigation_js_path ), true );
    }

    $main_js_path = get_theme_file_path( 'assets/js/main.js' );
    if ( file_exists( $main_js_path ) ) {
        wp_enqueue_script( 'ana-main', get_theme_file_uri( 'assets/js/main.js' ), array( 'jquery' ), filemtime( $main_js_path ), true );
    }

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'ana_scripts' );

/**
 * Register widget areas.
 */
function ana_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Sidebar', 'ana' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Main sidebar that appears on blog posts and pages.', 'ana' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer Widget Area', 'ana' ),
        'id'            => 'footer-1',
        'description'   => __( 'Footer widget area.', 'ana' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'ana_widgets_init' );

/**
 * Customize the excerpt more link.
 */
function ana_excerpt_more( $more ) {
    if ( is_admin() ) {
        return $more;
    }

    return sprintf( '... <a class="read-more" href="%1$s">%2$s</a>', esc_url( get_permalink( get_the_ID() ) ), __( 'Continue reading', 'ana' ) );
}
add_filter( 'excerpt_more', 'ana_excerpt_more' );

/**
 * Add helpful body classes.
 */
function ana_body_classes( $classes ) {
    if ( is_multi_author() ) {
        $classes[] = 'group-blog';
    }
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }

    return $classes;
}
add_filter( 'body_class', 'ana_body_classes' );

/**
 * Allow SVG uploads.
 */
function ana_allow_svg_uploads( $mimes ) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'ana_allow_svg_uploads' );
