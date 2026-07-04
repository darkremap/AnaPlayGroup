<?php get_header(); ?>

<?php
// Get meta values
$english_title      = get_post_meta( get_the_ID(), 'english_title', true );
$summary            = get_post_meta( get_the_ID(), 'summary', true );
$creatorname        = get_post_meta( get_the_ID(), 'creatorname', true );
$creatorimage_id    = get_post_meta( get_the_ID(), 'creatorimage', true );
$heroimage_id       = get_post_meta( get_the_ID(), 'heroimage', true );
$sideimage_id       = get_post_meta( get_the_ID(), 'sideimage', true );
$storyimage_id      = get_post_meta( get_the_ID(), 'storyimage', true );
$storytitle         = get_post_meta( get_the_ID(), 'storytitle', true );
$storycontent       = get_post_meta( get_the_ID(), 'storycontent', true );
$infoimage_id       = get_post_meta( get_the_ID(), 'infoimage', true );
$gametype           = get_post_meta( get_the_ID(), 'gametype', true );
$gamerevition       = get_post_meta( get_the_ID(), 'gamerevition', true );
$gamecreattime      = get_post_meta( get_the_ID(), 'gamecreattime', true );
$gamenumbertoplay   = get_post_meta( get_the_ID(), 'gamenumbertoplay', true );
$gamerange          = get_post_meta( get_the_ID(), 'gamerange', true );
$gamecategory       = get_post_meta( get_the_ID(), 'gamecategory', true );
?>

<div class="container-fluid AnaSingleGame">

    <!-- Hero -->
    <section class="AnaSingleGameHero">
        <div class="AnaSingleGameHero-images">
            <?php if ( $sideimage_id ) : ?>
                <?php echo wp_get_attachment_image( $sideimage_id, 'full', false, array( 'class' => 'AnaSingleGameHero-sideimage', 'alt' => get_the_title() ) ); ?>
            <?php endif; ?>

            <?php if ( $heroimage_id ) : ?>
                <?php echo wp_get_attachment_image( $heroimage_id, 'full', false, array( 'class' => 'AnaSingleGameHero-heroimage', 'alt' => get_the_title() ) ); ?>
            <?php endif; ?>
        </div>

        <div class="AnaSingleGameHero-content">
            <div class="AnaSingleGameHero-title">
                <div>
                    <h1><?php the_title(); ?></h1>
                    <?php if ( $english_title ) : ?>
                        <span><?php echo esc_html( $english_title ); ?></span>
                    <?php endif; ?>
                </div>
                <?php if ( $summary ) : ?>
                    <p class="AnaSingleGameHero-subtitle iranSans">
                        <?php echo wp_kses_post( $summary ); ?>
                    </p>
                <?php endif; ?>
            </div>

            <div class="AnaSingleGameHero-text iranSans">
                <p>
                    <?php the_content(); ?>
                </p>
            </div>

            <div class="AnaSingleGameHero-rating">
                <div class="AnaSingleGameHero-avatars">
                    <?php if ( $creatorimage_id ) : ?>
                        <?php echo wp_get_attachment_image( $creatorimage_id, 'thumbnail', false, array( 'class' => 'AnaSingleGameHero-creatorimage', 'alt' => esc_attr( $creatorname ) ) ); ?>
                    <?php endif; ?>
                </div>
                <div class="iranSans">
                    <strong>مولف :</strong>
                    <?php if ( $creatorname ) : ?>
                        <span><?php echo esc_html( $creatorname ); ?></span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Story -->
    <section class="AnaSingleGameStory container">
        <div class="AnaSingleGameStory-image">
            <?php if ( $storyimage_id ) : ?>
                <?php echo wp_get_attachment_image( $storyimage_id, 'full', false, array( 'class' => 'AnaSingleGameStory-img', 'alt' => esc_attr( $storytitle ) ) ); ?>
            <?php endif; ?>
        </div>

        <div class="AnaSingleGameStory-EnglishCard">
            <div class="AnaSingleGameStory-card">
                <?php if ( $storytitle ) : ?>
                    <h1><?php echo esc_html( $storytitle ); ?></h1>
                <?php endif; ?>

                <?php if ( $storycontent ) : ?>
                    <p><?php echo wp_kses_post( $storycontent ); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Gallery -->
    <section class="AnaSingleGameGallery container">
        <?php if ( $infoimage_id ) : ?>
            <?php echo wp_get_attachment_image( $infoimage_id, 'full', false, array( 'class' => 'AnaSingleGameGallery-infoimage', 'alt' => get_the_title() ) ); ?>
        <?php endif; ?>
    </section>

    <!-- Info -->
    <section class="AnaSingleGameInfo">
        <div class="AnaSingleGameInfo-left iranSans">
            <h2 class="iranSans_bold">نورا</h2>
            <h3 class="iranSans">مدار بازی</h3>
            <?php if ( $gamecategory ) : ?>
                <?php echo wp_kses_post( $gamecategory ); ?>
            <?php endif; ?>
            <div class="AnaSingleGameInfo-buttons">
                <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="Anabtn btn-DeepOceanBlue">
                    درخواست ثبت نام
                </a>
                <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="Anabtn btn-DeepOceanBlue-outline">
                    درخواست مشاوره
                </a>
            </div>
        </div>

        <div class="iranSans AnaSingleGameInfo-right">
            <div class="AnaSingleGameInfo-top">
                <div class="AnaSingleGameInfo-top-image">
                    <div class="AnaSingleGameInfo-avatar-title">
                        <span>نوع بازی</span>
                        <?php if ( $gametype ) : ?>
                            <strong><?php echo esc_html( $gametype ); ?></strong>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="AnaSingleGameInfo-top-logo">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="gallery">
                    <div>
                        <span>آفاق نگار اندیشه آنا</span>
                    </div>
                </div>
            </div>

            <div class="iranSans AnaSingleGameInfo-grid">
                <div class="AnaSingleGameInfo-grid-virsion">
                    <span>نسخه نهایی</span>
                    <?php if ( $gamerevition ) : ?>
                        <strong><?php echo esc_html( $gamerevition ); ?></strong>
                    <?php endif; ?>
                    <?php if ( $gamecreattime ) : ?>
                        <span><?php echo esc_html( $gamecreattime ); ?></span>
                    <?php endif; ?>
                </div>
                <div>
                    <span>شرکت کنندگان</span>
                    <?php if ( $gamenumbertoplay ) : ?>
                        <strong><?php echo esc_html( $gamenumbertoplay ); ?></strong>
                    <?php endif; ?>
                </div>
                <div>
                    <span>محدوده سنی</span>
                    <?php if ( $gamerange ) : ?>
                        <strong><?php echo esc_html( $gamerange ); ?></strong>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <section id="games" class="AnaGames">
        <div class="AnaGames-Title">
            <h1>سایر بازی ها</h1>
            <div class="AnaTitleBoarder">
                <span class="divider-dot"></span>
                <span class="divider-line"></span>
                <span class="divider-diamond"></span>
                <span class="divider-line"></span>
                <span class="divider-dot"></span>
            </div>
            <div class="AnaGames-Content">
                <p class="iranSans">بازی‌های ما صرفاً برای سرگرمی نیستند.</p>
                <p class="iranSans">آن‌ها فضایی برای کنجکاوی، تأمل و آگاهی عمیق‌تر نسبت به خود و دیگران ایجاد می‌کنند.</p>
            </div>
        </div>

        <div class="AnaGames-gallery container-fluid">
            <?php
            $games_query = new WP_Query( array(
                'post_type'      => 'game',
                'posts_per_page' => -1,
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
            ) );

            if ( $games_query->have_posts() ) :
                $i = 0;
                while ( $games_query->have_posts() ) : $games_query->the_post();

                    $storyimage_id  = get_post_meta( get_the_ID(), 'infoimage', true );
                    $storyimage_url = $storyimage_id
                        ? wp_get_attachment_image_url( $storyimage_id, 'full' )
                        : get_template_directory_uri() . '/assets/images/hero.png';

                    $gamecategory = get_post_meta( get_the_ID(), 'gamecategory', true );
                    $active_class = ( $i === 0 ) ? ' active' : '';
                    ?>
                    <div class="AnaGames-panel<?php echo esc_attr( $active_class ); ?>" >
                        <img src="<?php echo esc_url( $storyimage_url ); ?>" alt="<?php the_title_attribute(); ?>">
                        <span>
                            <div class="AnaGames-gallery-content">
                                <h1><?php the_title(); ?></h1>
                                <div class="iranSans AnaGames-gallery-content-body">
                                    <?php echo wp_kses_post( $gamecategory ); ?>
                                </div>
                                <a class="btn-consult Anabtn" href="<?php the_permalink(); ?>">مشاهده اطلاعات</a>
                            </div>
                        </span>
                    </div>
                    <?php
                    $i++;
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p>بازی‌ای ثبت نشده است.</p>';
            endif;
            ?>
        </div>
    </section>
</div>

<?php get_footer(); ?>