<?php
/**
 * Template Name: blog
 * Description: صفحه لیست بلاگ — تمام نوشته‌های منتشر شده را به‌صورت کارتی نمایش می‌دهد
 *
 * @package ANA
 */

get_header();

$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : ( get_query_var( 'page' ) ? get_query_var( 'page' ) : 1 );

$blog_query = new WP_Query( array(
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 9,
    'paged'          => $paged,
) );
?>

<section class="AnaGames AnaBlog">
    <div class="AnaGames-Title">
        <h1>دانشنامه ها</h1>
        <div class="AnaTitleBoarder">
            <span class="divider-dot"></span>
            <span class="divider-line"></span>
            <span class="divider-diamond"></span>
            <span class="divider-line"></span>
            <span class="divider-dot"></span>
        </div>
        <div class="AnaGames-Content">
            <p class="iranSans">آخرین مطالب، تجربه‌ها و یادداشت‌های تیم آنا را اینجا دنبال کنید.</p>
        </div>
    </div>

    <div class="AnaBlog-grid container">
        <?php if ( $blog_query->have_posts() ) : ?>
            <?php while ( $blog_query->have_posts() ) : $blog_query->the_post();
                $blog_cover_url  = ana_blog_cover_image_url( get_the_ID(), 'medium_large' );
                $blog_author     = ana_blog_author_name( get_the_ID() );
                $blog_author_img = ana_blog_author_avatar_url( get_the_ID() );
                ?>
                <article <?php post_class( 'AnaBlog-card' ); ?>>
                    <a href="<?php the_permalink(); ?>" class="AnaBlog-card-thumb" aria-hidden="true" tabindex="-1">
                        <?php if ( $blog_cover_url ) : ?>
                            <img src="<?php echo esc_url( $blog_cover_url ); ?>" alt="<?php the_title_attribute(); ?>">
                        <?php else : ?>
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero.png' ); ?>" alt="<?php the_title_attribute(); ?>">
                        <?php endif; ?>
                    </a>
                    <div class="AnaBlog-card-body iranSans">
                        <span class="AnaBlog-card-date"><?php echo esc_html( get_the_date() ); ?></span>
                        <h2 class="AnaBlog-card-title iranSans_bold">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        <p class="AnaBlog-card-excerpt">
                            <?php echo esc_html( wp_trim_words( get_the_excerpt(), 22 ) ); ?>
                        </p>
                        <div class="AnaBlog-card-author">
                            <?php if ( $blog_author_img ) : ?>
                                <img src="<?php echo esc_url( $blog_author_img ); ?>" alt="<?php echo esc_attr( $blog_author ); ?>" class="AnaBlog-card-author-avatar">
                            <?php endif; ?>
                            <span><?php echo esc_html( $blog_author ); ?></span>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="Anabtn btn-DeepOceanBlue-outline">ادامه مطلب</a>
                    </div>
                </article>
            <?php endwhile; wp_reset_postdata(); ?>
        <?php else : ?>
            <p class="iranSans AnaBlog-empty">هنوز مطلبی منتشر نشده است.</p>
        <?php endif; ?>
    </div>

    <?php if ( $blog_query->max_num_pages > 1 ) : ?>
        <div class="AnaBlog-pagination iranSans">
            <?php
            echo paginate_links( array(
                'base'      => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                'format'    => '?paged=%#%',
                'current'   => $paged,
                'total'     => $blog_query->max_num_pages,
                'mid_size'  => 2,
                'prev_text' => 'قبلی',
                'next_text' => 'بعدی',
            ) );
            ?>
        </div>
    <?php endif; ?>
</section>

<?php get_footer(); ?>
