<?php get_header(); ?>

<?php while ( have_posts() ) : the_post();
    $blog_cover_url  = ana_blog_cover_image_url( get_the_ID(), 'full' );
    $blog_author     = ana_blog_author_name( get_the_ID() );
    $blog_author_img = ana_blog_author_avatar_url( get_the_ID() );
    ?>

    <article <?php post_class( 'AnaSingleBlog' ); ?>>

        <header class="AnaSingleBlog-hero container">
            <?php if ( $blog_cover_url ) : ?>
                <div class="AnaSingleBlog-hero-img">
                    <img src="<?php echo esc_url( $blog_cover_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
                </div>
            <?php endif; ?>

            <div class="AnaSingleBlog-hero-content container">
                <h1><?php the_title(); ?></h1>
                <div class="AnaSingleBlog-meta iranSans">
                    <?php if ( $blog_author_img ) : ?>
                        <img src="<?php echo esc_url( $blog_author_img ); ?>" alt="<?php echo esc_attr( $blog_author ); ?>" class="AnaSingleBlog-author-avatar">
                    <?php endif; ?>
                    <span><?php echo esc_html( $blog_author ); ?></span>
                    <span class="AnaSingleBlog-meta-divider">•</span>
                    <span><?php echo esc_html( get_the_date() ); ?></span>
                </div>
            </div>
        </header>

        <div class="AnaSingleBlog-content container iranSans">
            <?php the_content(); ?>
        </div>

        <div class="AnaSingleBlog-back container">
            <a href="<?php echo esc_url( ana_blog_page_url() ); ?>" class="Anabtn btn-DeepOceanBlue-outline">
                بازگشت به دانشنامه ها
            </a>
        </div>

    </article>

<?php endwhile; ?>

<?php get_footer(); ?>
