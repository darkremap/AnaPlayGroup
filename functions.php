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


// ── 1. Register footer menu location ──────────────────────────────
function ana_register_menus() {
    register_nav_menus( [
        'footer-menu' => __( 'Footer Menu', 'ana-theme' ),
    ] );
}
add_action( 'after_setup_theme', 'ana_register_menus' );
 
 
// ── 2. Social links in Customizer ─────────────────────────────────
function ana_customize_register( WP_Customize_Manager $wp_customize ) {
 
    // Section
    $wp_customize->add_section( 'ana_social_links', [
        'title'    => __( 'Social Links', 'ana-theme' ),
        'priority' => 120,
    ] );
 
    $socials = [
        'ana_social_facebook'  => __( 'Facebook URL',  'ana-theme' ),
        'ana_social_twitter'   => __( 'Twitter URL',   'ana-theme' ),
        'ana_social_instagram' => __( 'Instagram URL', 'ana-theme' ),
        'ana_social_linkedin'  => __( 'LinkedIn URL',  'ana-theme' ),
        'ana_social_whatsapp'  => __( 'WhatsApp URL or Number (e.g. https://wa.me/989123456789)', 'ana-theme' ),
        'ana_social_telegram'  => __( 'Telegram URL (e.g. https://t.me/yourchannel)', 'ana-theme' ),
    ];
 
    foreach ( $socials as $id => $label ) {
        $wp_customize->add_setting( $id, [
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ] );
        $wp_customize->add_control( $id, [
            'label'   => $label,
            'section' => 'ana_social_links',
            'type'    => 'url',
        ] );
    }
}
add_action( 'customize_register', 'ana_customize_register' );
 
 
// ── 3. Enqueue footer CSS ─────────────────────────────────────────
function ana_enqueue_footer_styles() {
    wp_enqueue_style(
        'ana-footer',
        get_template_directory_uri() . '/assets/css/ana-footer.css',
        [],
        '1.0.0'
    );
}
add_action( 'wp_enqueue_scripts', 'ana_enqueue_footer_styles' );



// Register Custom Post Type for Games
function custom_post_type_games() {

    $labels = array(
        'name'                  => _x( 'Games', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Game', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Games', 'text_domain' ),
        'name_admin_bar'        => __( 'Game', 'text_domain' ),
        'archives'              => __( 'Game Archives', 'text_domain' ),
        'attributes'            => __( 'Game Attributes', 'text_domain' ),
        'parent_item_colon'     => __( 'Parent Game:', 'text_domain' ),
        'all_items'             => __( 'All Games', 'text_domain' ),
        'add_new_item'          => __( 'Add New Game', 'text_domain' ),
        'add_new'               => __( 'Add New', 'text_domain' ),
        'new_item'              => __( 'New Game', 'text_domain' ),
        'edit_item'             => __( 'Edit Game', 'text_domain' ),
        'update_item'           => __( 'Update Game', 'text_domain' ),
        'view_item'             => __( 'View Game', 'text_domain' ),
        'view_items'            => __( 'View Games', 'text_domain' ),
        'search_items'          => __( 'Search Game', 'text_domain' ),
        'not_found'             => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        'featured_image'        => __( 'Featured Image', 'text_domain' ),
        'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
        'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
        'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
        'insert_into_item'      => __( 'Insert into Game', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Game', 'text_domain' ),
        'items_list'            => __( 'Games list', 'text_domain' ),
        'items_list_navigation' => __( 'Games list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter Games list', 'text_domain' ),
    );
    $args = array(
        'label'                 => __( 'Game', 'text_domain' ),
        'description'           => __( 'Post Type for Games', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'page-attributes' ),
        'taxonomies'            => array( 'category', 'post_tag' ),
        'hierarchical'          => true,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'rewrite'               => array('slug' => 'games','with_front' => false),
    );
    register_post_type( 'game', $args );

}
add_action( 'init', 'custom_post_type_games', 0 );