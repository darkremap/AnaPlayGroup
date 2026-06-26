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

 


// plugin for games ------------------------------------------------------------------------------

if ( ! defined( 'ABSPATH' ) ) exit;

// ─────────────────────────────────────────
// 1. Register Custom Post Type
// ─────────────────────────────────────────
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
        'label'               => __( 'Game', 'text_domain' ),
        'description'         => __( 'Post Type for Games', 'text_domain' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'page-attributes' ),
        'taxonomies'          => array( 'category', 'post_tag' ),
        'hierarchical'        => true,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 5,
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'rewrite'             => array( 'slug' => 'games', 'with_front' => false ),
    );
    register_post_type( 'game', $args );
}
add_action( 'init', 'custom_post_type_games', 0 );

// ─────────────────────────────────────────
// 2. Enqueue Media Uploader
// ─────────────────────────────────────────
function game_meta_enqueue_scripts( $hook ) {
    global $post;
    if ( ( $hook === 'post-new.php' || $hook === 'post.php' )
        && isset( $post ) && $post->post_type === 'game' ) {
        wp_enqueue_media();
        wp_enqueue_editor();
        wp_enqueue_style(
            'game-meta-style',
            plugin_dir_url( __FILE__ ) . 'game-meta.css',
            array(),
            '1.0'
        );
    }
}
add_action( 'admin_enqueue_scripts', 'game_meta_enqueue_scripts' );

// ─────────────────────────────────────────
// 3. Register Meta Boxes
// ─────────────────────────────────────────
function game_register_meta_boxes() {
    add_meta_box(
        'game_general_info',
        'اطلاعات کلی بازی',
        'game_general_info_cb',
        'game',
        'normal',
        'high'
    );
    add_meta_box(
        'game_creator_info',
        'اطلاعات سازنده',
        'game_creator_info_cb',
        'game',
        'normal',
        'high'
    );
    add_meta_box(
        'game_images',
        'تصاویر بازی',
        'game_images_cb',
        'game',
        'normal',
        'default'
    );
    add_meta_box(
        'game_story',
        'داستان بازی',
        'game_story_cb',
        'game',
        'normal',
        'default'
    );
    add_meta_box(
        'game_tech_info',
        'اطلاعات فنی بازی',
        'game_tech_info_cb',
        'game',
        'side',
        'default'
    );
}
add_action( 'add_meta_boxes', 'game_register_meta_boxes' );

// ─────────────────────────────────────────
// 4. Helper: Image Field
// ─────────────────────────────────────────
function game_image_field( $post, $meta_key, $label ) {
    $value = get_post_meta( $post->ID, $meta_key, true );
    $img_src = $value ? wp_get_attachment_image_src( $value, 'thumbnail' ) : false;
    ?>
    <div class="game-image-field" style="margin-bottom:16px;">
        <label style="display:block;font-weight:600;margin-bottom:6px;"><?php echo esc_html( $label ); ?></label>
        <div class="game-image-preview" id="preview_<?php echo esc_attr( $meta_key ); ?>" style="margin-bottom:8px;">
            <?php if ( $img_src ) : ?>
                <img src="<?php echo esc_url( $img_src[0] ); ?>" style="max-width:150px;max-height:150px;display:block;border-radius:4px;border:1px solid #ddd;">
            <?php endif; ?>
        </div>
        <input type="hidden" name="<?php echo esc_attr( $meta_key ); ?>" id="<?php echo esc_attr( $meta_key ); ?>" value="<?php echo esc_attr( $value ); ?>">
        <button type="button" class="button game-upload-btn" data-target="<?php echo esc_attr( $meta_key ); ?>" data-preview="preview_<?php echo esc_attr( $meta_key ); ?>">
            <?php echo $value ? 'تغییر تصویر' : 'انتخاب تصویر'; ?>
        </button>
        <?php if ( $value ) : ?>
            <button type="button" class="button game-remove-btn" data-target="<?php echo esc_attr( $meta_key ); ?>" data-preview="preview_<?php echo esc_attr( $meta_key ); ?>" style="margin-right:6px;">
                حذف تصویر
            </button>
        <?php endif; ?>
    </div>
    <?php
}

// ─────────────────────────────────────────
// 5. Meta Box Callbacks
// ─────────────────────────────────────────

// --- General Info ---
function game_general_info_cb( $post ) {
    wp_nonce_field( 'game_meta_nonce', 'game_meta_nonce_field' );
    $english_title = get_post_meta( $post->ID, 'english_title', true );
    $summary       = get_post_meta( $post->ID, 'summary', true );
    ?>
    <div class="game-meta-wrap">
        <div class="game-field">
            <label for="english_title"><strong>عنوان انگلیسی (english_title)</strong></label>
            <input type="text" name="english_title" id="english_title"
                   value="<?php echo esc_attr( $english_title ); ?>"
                   class="widefat" style="margin-top:5px;">
        </div>

        <div class="game-field" style="margin-top:16px;">
            <label><strong>خلاصه بازی (summary)</strong></label>
            <div style="margin-top:6px;">
                <?php
                wp_editor( $summary, 'summary', array(
                    'textarea_name' => 'summary',
                    'textarea_rows' => 6,
                    'media_buttons' => false,
                    'teeny'         => true,
                ) );
                ?>
            </div>
        </div>
    </div>
    <?php
}

// --- Creator Info ---
function game_creator_info_cb( $post ) {
    $creatorname = get_post_meta( $post->ID, 'creatorname', true );
    ?>
    <div class="game-meta-wrap">
        <div class="game-field">
            <label for="creatorname"><strong>نام سازنده (creatorname)</strong></label>
            <input type="text" name="creatorname" id="creatorname"
                   value="<?php echo esc_attr( $creatorname ); ?>"
                   class="widefat" style="margin-top:5px;">
        </div>
        <div style="margin-top:16px;">
            <?php game_image_field( $post, 'creatorimage', 'تصویر سازنده (creatorimage)' ); ?>
        </div>
    </div>
    <?php
}

// --- Images ---
function game_images_cb( $post ) {
    ?>
    <div class="game-meta-wrap">
        <?php
        game_image_field( $post, 'heroimage',  'تصویر اصلی هیرو (heroimage)' );
        game_image_field( $post, 'sideimage',  'تصویر کناری (sideimage)' );
        game_image_field( $post, 'storyimage', 'تصویر داستان (storyimage)' );
        game_image_field( $post, 'infoimage',  'تصویر اطلاعات (infoimage)' );
        ?>
    </div>
    <?php
}

// --- Story ---
function game_story_cb( $post ) {
    $storytitle   = get_post_meta( $post->ID, 'storytitle', true );
    $storycontent = get_post_meta( $post->ID, 'storycontent', true );
    ?>
    <div class="game-meta-wrap">
        <div class="game-field">
            <label for="storytitle"><strong>عنوان داستان (storytitle)</strong></label>
            <input type="text" name="storytitle" id="storytitle"
                   value="<?php echo esc_attr( $storytitle ); ?>"
                   class="widefat" style="margin-top:5px;">
        </div>
        <div class="game-field" style="margin-top:16px;">
            <label><strong>متن داستان (storycontent)</strong></label>
            <div style="margin-top:6px;">
                <?php
                wp_editor( $storycontent, 'storycontent', array(
                    'textarea_name' => 'storycontent',
                    'textarea_rows' => 8,
                    'media_buttons' => false,
                    'teeny'         => true,
                ) );
                ?>
            </div>
        </div>
    </div>
    <?php
}

// --- Tech Info (sidebar) ---
function game_tech_info_cb( $post ) {
    $fields = array(
        'gametype'           => 'نوع بازی',
        'gamerevition'       => 'نسخه بازی',
        'gamecreattime'      => 'تاریخ انتشار',
        'gamenumbertoplay'   => 'تعداد بازیکنان',
        'gamerange'          => 'محدوده سنی',
    );
    $gamecategory = get_post_meta( $post->ID, 'gamecategory', true );
    ?>
    <div class="game-meta-wrap">
        <?php foreach ( $fields as $key => $label ) :
            $val = get_post_meta( $post->ID, $key, true ); ?>
            <div class="game-field" style="margin-bottom:12px;">
                <label for="<?php echo esc_attr( $key ); ?>"><strong><?php echo esc_html( $label ); ?></strong></label>
                <input type="text" name="<?php echo esc_attr( $key ); ?>"
                       id="<?php echo esc_attr( $key ); ?>"
                       value="<?php echo esc_attr( $val ); ?>"
                       class="widefat" style="margin-top:4px;">
            </div>
        <?php endforeach; ?>

        <div class="game-field" style="margin-top:4px;">
            <label><strong>دسته‌بندی بازی (gamecategory)</strong></label>
            <div style="margin-top:6px;">
                <?php
                wp_editor( $gamecategory, 'gamecategory', array(
                    'textarea_name' => 'gamecategory',
                    'textarea_rows' => 4,
                    'media_buttons' => false,
                    'teeny'         => true,
                ) );
                ?>
            </div>
        </div>
    </div>
    <?php
}

// ─────────────────────────────────────────
// 6. Save Meta Fields
// ─────────────────────────────────────────
function game_save_meta_fields( $post_id ) {
    // Security checks
    if ( ! isset( $_POST['game_meta_nonce_field'] )
        || ! wp_verify_nonce( $_POST['game_meta_nonce_field'], 'game_meta_nonce' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;
    if ( get_post_type( $post_id ) !== 'game' ) return;

    // Text fields
    $text_fields = array(
        'english_title',
        'creatorname',
        'storytitle',
        'gametype',
        'gamerevition',
        'gamecreattime',
        'gamenumbertoplay',
        'gamerange',
    );
    foreach ( $text_fields as $field ) {
        if ( isset( $_POST[ $field ] ) ) {
            update_post_meta( $post_id, $field, sanitize_text_field( $_POST[ $field ] ) );
        }
    }

    // Rich text fields (allow HTML)
    $richtext_fields = array( 'summary', 'storycontent', 'gamecategory' );
    foreach ( $richtext_fields as $field ) {
        if ( isset( $_POST[ $field ] ) ) {
            update_post_meta( $post_id, $field, wp_kses_post( $_POST[ $field ] ) );
        }
    }

    // Image fields (store attachment ID)
    $image_fields = array( 'creatorimage', 'heroimage', 'sideimage', 'storyimage', 'infoimage' );
    foreach ( $image_fields as $field ) {
        if ( isset( $_POST[ $field ] ) ) {
            $attachment_id = absint( $_POST[ $field ] );
            if ( $attachment_id > 0 ) {
                update_post_meta( $post_id, $field, $attachment_id );
            } else {
                delete_post_meta( $post_id, $field );
            }
        }
    }
}
add_action( 'save_post', 'game_save_meta_fields' );

// ─────────────────────────────────────────
// 7. Inline JS for Media Uploader
// ─────────────────────────────────────────
function game_meta_admin_footer() {
    global $post;
    if ( ! isset( $post ) || $post->post_type !== 'game' ) return;
    ?>
    <script>
    (function($){
        // Upload button
        $(document).on('click', '.game-upload-btn', function(e){
            e.preventDefault();
            var btn      = $(this);
            var targetId = btn.data('target');
            var previewId = btn.data('preview');

            var frame = wp.media({
                title: 'انتخاب تصویر',
                button: { text: 'انتخاب' },
                multiple: false,
                library: { type: 'image' }
            });

            frame.on('select', function(){
                var attachment = frame.state().get('selection').first().toJSON();
                $('#' + targetId).val(attachment.id);
                var imgUrl = attachment.sizes && attachment.sizes.thumbnail
                    ? attachment.sizes.thumbnail.url
                    : attachment.url;
                $('#' + previewId).html('<img src="' + imgUrl + '" style="max-width:150px;max-height:150px;display:block;border-radius:4px;border:1px solid #ddd;">');
                btn.text('تغییر تصویر');

                // Show remove button if not already there
                if (!btn.next('.game-remove-btn').length) {
                    btn.after('<button type="button" class="button game-remove-btn" data-target="' + targetId + '" data-preview="' + previewId + '" style="margin-right:6px;">حذف تصویر</button>');
                }
            });

            frame.open();
        });

        // Remove button
        $(document).on('click', '.game-remove-btn', function(e){
            e.preventDefault();
            var btn       = $(this);
            var targetId  = btn.data('target');
            var previewId = btn.data('preview');
            $('#' + targetId).val('');
            $('#' + previewId).html('');
            btn.prev('.game-upload-btn').text('انتخاب تصویر');
            btn.remove();
        });
    })(jQuery);
    </script>
    <style>
        .game-meta-wrap { padding: 4px 0; }
        .game-field label { display: block; }
        .game-field input[type="text"] { margin-top: 5px; }
        #game_tech_info .game-field input { font-size: 13px; }
    </style>
    <?php
}
add_action( 'admin_footer', 'game_meta_admin_footer' );

/* ────────────────────────────────────────────────────────
   1. CREATE DB TABLE ON THEME ACTIVATION
   ──────────────────────────────────────────────────────── */
function ana_create_contact_table() {
    global $wpdb;
 
    $table_name      = $wpdb->prefix . 'ana_contacts';
    $charset_collate = $wpdb->get_charset_collate();
 
    $sql = "CREATE TABLE IF NOT EXISTS {$table_name} (
        id          BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        name        VARCHAR(100)        NOT NULL DEFAULT '',
        phone       VARCHAR(20)         NOT NULL DEFAULT '',
        message     TEXT,
        submitted_at DATETIME           NOT NULL DEFAULT CURRENT_TIMESTAMP,
        is_read     TINYINT(1)          NOT NULL DEFAULT 0,
        PRIMARY KEY (id)
    ) {$charset_collate};";
 
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta( $sql );
 
    update_option( 'ana_contact_db_version', '1.0' );
}
add_action( 'after_switch_theme', 'ana_create_contact_table' );
 
// Also run on init in case table is missing (safe — uses CREATE TABLE IF NOT EXISTS)
add_action( 'init', function() {
    if ( get_option( 'ana_contact_db_version' ) !== '1.0' ) {
        ana_create_contact_table();
    }
} );
 
 
/* ────────────────────────────────────────────────────────
   2. SAVE SUBMISSION TO DB
   ──────────────────────────────────────────────────────── */
function ana_save_contact_submission( $name, $phone, $message = '' ) {
    global $wpdb;
 
    $table_name = $wpdb->prefix . 'ana_contacts';
 
    $rows_affected = $wpdb->insert(
        $table_name,
        [
            'name'         => $name,
            'phone'        => $phone,
            'message'      => $message,
            'submitted_at' => current_time( 'mysql' ),
            'is_read'      => 0,
        ],
        [ '%s', '%s', '%s', '%s', '%d' ]
    );
 
    return $rows_affected !== false;
}
 
 
/* ────────────────────────────────────────────────────────
   3. EMAIL NOTIFICATION TO ADMIN
   ──────────────────────────────────────────────────────── */
function ana_notify_admin_contact( $name, $phone, $message = '' ) {
    $admin_email = get_option( 'admin_email' );
    $site_name   = get_bloginfo( 'name' );
 
    // Allow overriding recipient via Customizer
    $notify_email = get_theme_mod( 'ana_contact_notify_email', $admin_email );
 
    $subject = sprintf( '[%s] ثبت شماره تماس جدید از %s', $site_name, $name );
 
    $body  = "سلام،\n\n";
    $body .= "یک کاربر جدید اطلاعات تماس خود را در سایت ثبت کرده است:\n\n";
    $body .= "────────────────────\n";
    $body .= "نام:       {$name}\n";
    $body .= "شماره:     {$phone}\n";
    if ( $message ) {
        $body .= "پیام:\n{$message}\n";
    }
    $body .= "────────────────────\n\n";
    $body .= "زمان ثبت: " . current_time( 'Y/m/d H:i:s' ) . "\n\n";
    $body .= "برای مشاهده همه درخواست‌ها به پنل ادمین مراجعه کنید:\n";
    $body .= admin_url( 'admin.php?page=ana-contacts' ) . "\n\n";
    $body .= "با احترام،\n{$site_name}";
 
    $headers = [
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . $site_name . ' <' . $admin_email . '>',
    ];
 
    wp_mail( $notify_email, $subject, $body, $headers );
}
 
 
/* ────────────────────────────────────────────────────────
   4. ADMIN PANEL — MENU + LIST PAGE
   ──────────────────────────────────────────────────────── */
function ana_register_admin_menu() {
    add_menu_page(
        'درخواست‌های تماس',       // page title
        'تماس‌های ANA',           // menu title
        'manage_options',          // capability
        'ana-contacts',            // slug
        'ana_contacts_admin_page', // callback
        'dashicons-phone',         // icon
        30                         // position
    );
}
add_action( 'admin_menu', 'ana_register_admin_menu' );
 
 
function ana_contacts_admin_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'ana_contacts';
 
    // ── Mark as read ──
    if ( isset( $_GET['mark_read'] ) && is_numeric( $_GET['mark_read'] ) &&
         check_admin_referer( 'ana_mark_read_' . (int) $_GET['mark_read'] ) ) {
        $wpdb->update( $table_name, [ 'is_read' => 1 ], [ 'id' => (int) $_GET['mark_read'] ], [ '%d' ], [ '%d' ] );
        echo '<div class="notice notice-success is-dismissible"><p>✓ به عنوان خوانده‌شده علامت‌گذاری شد.</p></div>';
    }
 
    // ── Delete ──
    if ( isset( $_GET['delete_row'] ) && is_numeric( $_GET['delete_row'] ) &&
         check_admin_referer( 'ana_delete_' . (int) $_GET['delete_row'] ) ) {
        $wpdb->delete( $table_name, [ 'id' => (int) $_GET['delete_row'] ], [ '%d' ] );
        echo '<div class="notice notice-success is-dismissible"><p>✓ رکورد حذف شد.</p></div>';
    }
 
    // ── Export CSV ──
    if ( isset( $_GET['export_csv'] ) && current_user_can( 'manage_options' ) &&
         check_admin_referer( 'ana_export_csv' ) ) {
        ana_export_contacts_csv();
    }
 
    // ── Fetch rows ──
    $per_page   = 20;
    $current_pg = max( 1, (int) ( $_GET['paged'] ?? 1 ) );
    $offset     = ( $current_pg - 1 ) * $per_page;
    $filter     = isset( $_GET['filter'] ) && $_GET['filter'] === 'unread' ? 'unread' : 'all';
 
    $where      = $filter === 'unread' ? 'WHERE is_read = 0' : '';
    $total      = (int) $wpdb->get_var( "SELECT COUNT(*) FROM {$table_name} {$where}" );
    $total_unread = (int) $wpdb->get_var( "SELECT COUNT(*) FROM {$table_name} WHERE is_read = 0" );
 
    // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
    $rows = $wpdb->get_results(
        $wpdb->prepare(
            "SELECT * FROM {$table_name} {$where} ORDER BY submitted_at DESC LIMIT %d OFFSET %d",
            $per_page,
            $offset
        )
    );
 
    $total_pages = ceil( $total / $per_page );
 
    ?>
    <div class="wrap" style="direction:rtl; font-family: Tahoma, sans-serif;">
 
        <h1 style="display:flex; align-items:center; gap:12px;">
            📞 درخواست‌های تماس
            <?php if ( $total_unread > 0 ) : ?>
                <span style="background:#E9A441;color:#fff;border-radius:50px;padding:2px 12px;font-size:13px;">
                    <?php echo esc_html( $total_unread ); ?> خوانده‌نشده
                </span>
            <?php endif; ?>
        </h1>
 
        <!-- Toolbar -->
        <div style="display:flex; gap:12px; align-items:center; margin:16px 0; flex-wrap:wrap;">
            <a href="<?php echo esc_url( admin_url('admin.php?page=ana-contacts') ); ?>"
               class="button <?php echo $filter === 'all' ? 'button-primary' : ''; ?>">
               همه (<?php echo esc_html($total); ?>)
            </a>
            <a href="<?php echo esc_url( admin_url('admin.php?page=ana-contacts&filter=unread') ); ?>"
               class="button <?php echo $filter === 'unread' ? 'button-primary' : ''; ?>">
               خوانده‌نشده (<?php echo esc_html($total_unread); ?>)
            </a>
            <a href="<?php echo esc_url( wp_nonce_url( admin_url('admin.php?page=ana-contacts&export_csv=1'), 'ana_export_csv' ) ); ?>"
               class="button">
               ⬇ خروجی CSV
            </a>
        </div>
 
        <!-- Table -->
        <table class="wp-list-table widefat fixed striped"
               style="direction:rtl; text-align:right; border-radius:8px; overflow:hidden;">
            <thead style="background:#0A3F5A; color:#fff;">
                <tr>
                    <th style="color:#fff; width:40px;">#</th>
                    <th style="color:#fff;">نام</th>
                    <th style="color:#fff;">شماره موبایل</th>
                    <th style="color:#fff;">پیام</th>
                    <th style="color:#fff;">تاریخ ثبت</th>
                    <th style="color:#fff; width:60px;">وضعیت</th>
                    <th style="color:#fff; width:120px;">عملیات</th>
                </tr>
            </thead>
            <tbody>
                <?php if ( empty( $rows ) ) : ?>
                    <tr>
                        <td colspan="7" style="text-align:center; padding:32px; color:#777;">
                            هیچ رکوردی یافت نشد.
                        </td>
                    </tr>
                <?php else : ?>
                    <?php foreach ( $rows as $row ) : ?>
                        <tr style="<?php echo ! $row->is_read ? 'font-weight:bold; background:#fffbf0;' : ''; ?>">
                            <td><?php echo esc_html( $row->id ); ?></td>
                            <td><?php echo esc_html( $row->name ); ?></td>
                            <td dir="ltr" style="text-align:left; letter-spacing:1px;">
                                <?php echo esc_html( $row->phone ); ?>
                            </td>
                            <td style="max-width:240px; white-space:normal; word-break:break-word;">
                                <?php echo esc_html( $row->message ?: '—' ); ?>
                            </td>
                            <td dir="ltr" style="text-align:left; font-size:12px; color:#555;">
                                <?php echo esc_html( $row->submitted_at ); ?>
                            </td>
                            <td>
                                <?php if ( $row->is_read ) : ?>
                                    <span style="color:#1FA6A6; font-size:12px;">✓ خوانده</span>
                                <?php else : ?>
                                    <span style="color:#E9A441; font-size:12px;">● جدید</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ( ! $row->is_read ) : ?>
                                    <a href="<?php echo esc_url( wp_nonce_url(
                                        admin_url( 'admin.php?page=ana-contacts&mark_read=' . $row->id ),
                                        'ana_mark_read_' . $row->id
                                    ) ); ?>"
                                       class="button button-small">خوانده‌شد</a>
                                <?php endif; ?>
                                <a href="<?php echo esc_url( wp_nonce_url(
                                    admin_url( 'admin.php?page=ana-contacts&delete_row=' . $row->id ),
                                    'ana_delete_' . $row->id
                                ) ); ?>"
                                   class="button button-small"
                                   style="color:#c0392b; border-color:#c0392b; margin-top:4px;"
                                   onclick="return confirm('آیا مطمئن هستید؟')">حذف</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
 
        <!-- Pagination -->
        <?php if ( $total_pages > 1 ) : ?>
            <div style="margin-top:16px; display:flex; gap:8px; align-items:center;">
                <?php for ( $i = 1; $i <= $total_pages; $i++ ) : ?>
                    <a href="<?php echo esc_url( admin_url( 'admin.php?page=ana-contacts&paged=' . $i . ( $filter !== 'all' ? '&filter=' . $filter : '' ) ) ); ?>"
                       class="button <?php echo $i === $current_pg ? 'button-primary' : ''; ?>">
                        <?php echo esc_html( $i ); ?>
                    </a>
                <?php endfor; ?>
            </div>
        <?php endif; ?>
 
        <p style="color:#777; font-size:12px; margin-top:12px;">
            مجموع: <?php echo esc_html( $total ); ?> رکورد
        </p>
 
    </div>
    <?php
}
 
 
/* ────────────────────────────────────────────────────────
   5. EXPORT CSV
   ──────────────────────────────────────────────────────── */
function ana_export_contacts_csv() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'ana_contacts';
 
    $rows = $wpdb->get_results( "SELECT * FROM {$table_name} ORDER BY submitted_at DESC", ARRAY_A );
 
    $filename = 'ana-contacts-' . gmdate( 'Y-m-d' ) . '.csv';
 
    header( 'Content-Type: text/csv; charset=UTF-8' );
    header( 'Content-Disposition: attachment; filename="' . $filename . '"' );
    header( 'Pragma: no-cache' );
    header( 'Expires: 0' );
 
    $output = fopen( 'php://output', 'w' );
    // BOM for Excel UTF-8
    fputs( $output, "\xEF\xBB\xBF" );
 
    fputcsv( $output, [ 'ID', 'نام', 'شماره موبایل', 'پیام', 'تاریخ ثبت', 'خوانده‌شده' ] );
 
    foreach ( $rows as $row ) {
        fputcsv( $output, [
            $row['id'],
            $row['name'],
            $row['phone'],
            $row['message'],
            $row['submitted_at'],
            $row['is_read'] ? 'بله' : 'خیر',
        ] );
    }
 
    fclose( $output );
    exit;
}
 
 
/* ────────────────────────────────────────────────────────
   6. CUSTOMIZER: notification email setting
   ──────────────────────────────────────────────────────── */
add_action( 'customize_register', function( WP_Customize_Manager $wp_customize ) {
    // Add to existing ana_social_links section or create new
    $wp_customize->add_section( 'ana_contact_settings', [
        'title'    => 'تنظیمات تماس با ما',
        'priority' => 125,
    ] );
 
    $wp_customize->add_setting( 'ana_contact_notify_email', [
        'default'           => get_option( 'admin_email' ),
        'sanitize_callback' => 'sanitize_email',
    ] );
 
    $wp_customize->add_control( 'ana_contact_notify_email', [
        'label'       => 'ایمیل دریافت اعلان‌های تماس',
        'description' => 'هر بار که شماره‌ای ثبت شود به این آدرس ایمیل ارسال می‌شود.',
        'section'     => 'ana_contact_settings',
        'type'        => 'email',
    ] );
} );
 
 
/* ────────────────────────────────────────────────────────
   7. ADMIN BADGE: unread count in menu
   ──────────────────────────────────────────────────────── */
add_action( 'admin_menu', function() {
    global $wpdb, $menu;
    $table_name = $wpdb->prefix . 'ana_contacts';
 
    if ( $wpdb->get_var( "SHOW TABLES LIKE '{$table_name}'" ) === $table_name ) {
        $unread = (int) $wpdb->get_var( "SELECT COUNT(*) FROM {$table_name} WHERE is_read = 0" );
        if ( $unread > 0 ) {
            foreach ( $menu as $key => $item ) {
                if ( isset( $item[2] ) && $item[2] === 'ana-contacts' ) {
                    $menu[ $key ][0] .= ' <span class="awaiting-mod">' . $unread . '</span>';
                    break;
                }
            }
        }
    }
}, 999 );