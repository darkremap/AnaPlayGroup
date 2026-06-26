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
    <section class="AnaSingleGameStory">
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
    <section class="AnaSingleGameGallery">
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
                <a href="#" class="Anabtn btn-DeepOceanBlue">
                    درخواست ثبت نام
                </a>
                <a href="#" class="Anabtn btn-DeepOceanBlue-outline">
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

</div>

<?php get_footer(); ?>