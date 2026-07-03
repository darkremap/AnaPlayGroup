<?php get_header(); ?>
<!-- ══ HERO ══ -->
<section class="AnaHero">
  <div>
    <div class="row AnaHero-items">

      <!-- ── Right column: text ── -->
      <div class="px-5 col-12 col-lg-5 hero-text order-lg-1">
        <h2 class="hero-title iranSans_bold">بازی راهی برای شناخت</h2>
        <p class="hero-desc iranSans">
          با بهره‌گیری از روش‌های نوین یادگیری، دنیایی از کشف و خلاقیت را تجربه کنید.
          ما راهنمای شما در مسیر رشد و شناخت عمیق‌تر هستیم.
        </p>
        <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn-consult Anabtn">درخواست مشاوره</a>
      </div>

      <!-- ── Left column: hero image ── -->
      <div class="col-12 col-lg-7 order-lg-2 AnaHero-img-col">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero.png" alt="AnaPlayGroup">
      </div>

    </div><!-- /row -->
  </div><!-- /container -->
</section>


<section id="games" class="AnaGames">
    <div class="AnaGames-Title">
        <h1>هر بازی یک سفر</h1>
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
                <a href="<?php the_permalink(); ?>" class="AnaGames-panel<?php echo esc_attr( $active_class ); ?>">
                    <img src="<?php echo esc_url( $storyimage_url ); ?>" alt="<?php the_title_attribute(); ?>">
                    <span>
                        <div class="AnaGames-gallery-content">
                            <h1><?php the_title(); ?></h1>
                            <div class="iranSans AnaGames-gallery-content-body">
                                <?php echo wp_kses_post( $gamecategory ); ?>
                            </div>
                        </div>
                    </span>
                </a>
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


<section class="AnaPoint container">
    <div class="AnaPoint-Card">
        <div class="AnaPoint-Icon">
            <svg width="25" height="20" viewBox="0 0 33 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M2.80744 22.0645C1.85265 17.3602 2.61648 7.30645 13.31 4.72581C26.677 1.5 30.0188 1.5 30.9736 1.5C31.9284 1.5 30.9736 12.7903 30.9736 13.1935C30.9736 13.5968 28.1093 31.3387 5.19447 24.8871M0.897949 26.5C5.03531 23.4086 13.31 16.8226 13.31 15.2097C13.31 13.5968 20.3118 9.69892 23.8127 7.95161M19.0388 17.2258C17.6066 18.1667 14.4557 19.8871 13.31 19.2419" stroke="#0A3F5A" stroke-width="3"/>
            </svg>
            <h3 class="iranSans">آزادی و رشد</h3>
        </div>
        <p class="iranSans">پی‌ریزی آینده و شکوفایی پتانسیل‌ها از مسیر آزادی در تجربه و رشد درونی</p>
    </div>
    <div class="AnaPoint-Card">
        <div class="AnaPoint-Icon">
            <svg width="25" height="20" viewBox="0 0 31 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M3.10452 13.0506L0.00477522 13.0518L0.00357649 9.79169L3.10332 9.79055C5.24214 9.78976 7.35018 10.3595 9.3034 11.4183C13.1773 9.29783 17.8269 9.29612 21.7024 11.4138C23.6548 10.3535 25.7779 9.78221 27.9013 9.78143L31.001 9.78029L31.0022 13.0404L27.9025 13.0415C25.7481 13.0423 23.5941 13.8092 21.7038 15.2118C17.9211 12.4258 13.0855 12.4275 9.3048 15.2163C7.41344 13.8152 5.25884 13.0498 3.10452 13.0506ZM3.10811 22.8309L0.00837141 22.8321L0.00717268 19.572L3.10692 19.5708C5.24574 19.57 7.35377 20.1398 9.307 21.1986C13.1809 19.0781 17.8305 19.0764 21.706 21.194C23.6584 20.1338 25.7815 19.5625 27.9049 19.5617L31.0046 19.5606L31.0058 22.8207L27.9061 22.8218C25.7517 22.8226 23.5977 23.5895 21.7074 24.992C17.9247 22.206 13.0891 22.2078 9.30839 24.9966C7.41704 23.5955 5.26244 22.8301 3.10811 22.8309ZM3.10092 3.27036L0.00117903 3.2715L-1.96951e-05 0.0114106L3.09972 0.0102709C5.23855 0.00948441 7.34658 0.579226 9.29981 1.63804C13.1737 -0.482447 17.8233 -0.484157 21.6988 1.63348C23.6512 0.573231 25.7743 0.00193344 27.8977 0.0011527L30.9974 1.29335e-05L30.9986 3.2601L27.8989 3.26124C25.7445 3.26203 23.5905 4.02895 21.7002 5.43148C17.9175 2.6455 13.0819 2.64728 9.3012 5.43604C7.40984 4.0349 5.25524 3.26957 3.10092 3.27036Z" fill="#0A3F5A"/>
            </svg>
            <h3 class="iranSans">عمق و ناخودآگاه</h3>
        </div>
        <p class="iranSans">بازی؛ دریچه‌ای امن برای عبور از ظاهرِ رفتار و کشفِ لایه‌های پنهانِ ذهن در مسیرِ خودشناسی.</p>
    </div>
    <div class="AnaPoint-Card">
        <div class="AnaPoint-Icon">
            <svg width="25" height="20" viewBox="0 0 33 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M16.1287 11.2861C19.2302 11.2863 21.7546 13.813 21.7546 16.9424C21.7545 20.0716 19.2301 22.5975 16.1287 22.5977C13.0271 22.5977 10.5019 20.0717 10.5017 16.9424C10.5017 13.8129 13.027 11.2861 16.1287 11.2861Z" stroke="#0A3F5A" stroke-width="3"/>
                <path d="M25.4338 16.5648H31.4352" stroke="#0A3F5A" stroke-width="3" stroke-linecap="round"/>
                <path d="M1.5 16.5655H7.50135" stroke="#0A3F5A" stroke-width="3" stroke-linecap="round"/>
                <path d="M22.6682 9.91395L27.0778 5.82632" stroke="#0A3F5A" stroke-width="3" stroke-linecap="round"/>
                <path d="M22.8091 23.0078L26.9409 27.3782" stroke="#0A3F5A" stroke-width="3" stroke-linecap="round"/>
                <path d="M5.25073 6.01986L9.38253 10.3903" stroke="#0A3F5A" stroke-width="3" stroke-linecap="round"/>
                <path d="M4.50049 27.4324L8.91003 23.3448" stroke="#0A3F5A" stroke-width="3" stroke-linecap="round"/>
                <path d="M16.5034 7.52512L16.6253 1.50001" stroke="#0A3F5A" stroke-width="3" stroke-linecap="round"/>
                <path d="M15.7532 31.6292L15.875 25.604" stroke="#0A3F5A" stroke-width="3" stroke-linecap="round"/>
            </svg>
            <h3 class="iranSans">شناخت و بینش</h3>
        </div>
        <p class="iranSans">گذار از مشاهده‌ای ساده به دانایی عمیق از طریق تجربه و آزادی</p>
    </div>
    <div class="AnaPoint-Card">
        <div class="AnaPoint-Icon">
            <svg width="25" height="20" viewBox="0 0 33 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8.09998 26.6895C6.50921 25.1464 0.145757 19.7456 2.532 11.6443C4.95587 3.41534 10.884 2 16.8498 2C20.867 2.70852 26.1564 2.07715 29.9745 11.6443C34.7471 23.6033 21.6224 29.0042 16.8498 27.8468C12.0771 26.6895 6.85719 19.1882 8.9378 14.3447C12.915 5.08619 18.0431 8.17237 21.2249 9.71547C24.4066 11.2586 26.353 14.3448 19.9895 20.5171C13.626 26.6895 12.0771 9.32969 18.4406 14.3447" stroke="#0A3F5A" stroke-width="4"/>
            </svg>
            <h3 class="iranSans">بازی و تجربه</h3>
        </div>
        <p class="iranSans">تبدیل بازی به زبانی برای کشف و پیوندی میان کنجکاوی و خرد در مسیرِ خودشناسی.</p>
    </div>
</section>


<section class="AnaStep">
    <div class="AnaGames-Title AnaStep-fadeUp AnaStep-d1">
        <h1 id="AnaStep-title" class="iranSans_bold">مسیر تجربه بازی</h1>
        <div class="AnaTitleBoarder">
        <span class="divider-dot"></span>
        <span class="divider-line"></span>
        <span class="divider-diamond"></span>
        <span class="divider-line"></span>
        <span class="divider-dot"></span>
        </div>
        <div class="AnaGames-Content">
            <p class="iranSans">از ورود به بازی تا دریافت کارنامه نهایی، شرکت‌کنندگان از طریق تعامل و بازخورد، الگوهای رفتاری خود را کشف می‌کنند.</p>
        </div>
    </div>

    <div class="AnaStep-pathWrap" aria-label="مراحل تجربه بازی">
        <ol class="AnaStep-list container iranSans">
            <li class="AnaStep-item AnaStep-item1">
                <span class="AnaStep-coin">1</span>
                <span class="AnaStep-label">انجام بازی</span>
            </li>
            <li class="AnaStep-item AnaStep-item2">
                <span class="AnaStep-coin">2</span>
                <span class="AnaStep-label">بازخورد مشارکتی</span>
            </li>
            <li class="AnaStep-item AnaStep-item3">
                <span class="AnaStep-coin">3</span>
                <span class="AnaStep-label">کشف نتایج شگفت انگیز</span>
            </li>
            <li class="AnaStep-item AnaStep-item4">
                <span class="AnaStep-coin">4</span>
                <span class="AnaStep-label">دریافت کارنامه</span>
            </li>
        </ol>
    </div>
</section>
<section class="container AnaHomeChart">
    <div class="AnaGames-Title AnaStep-fadeUp AnaStep-d1">
        <h1 id="AnaStep-title" class="iranSans_bold">دست آورد شما بعد از انجام بازی</h1>
        <div class="AnaTitleBoarder">
        <span class="divider-dot"></span>
        <span class="divider-line"></span>
        <span class="divider-diamond"></span>
        <span class="divider-line"></span>
        <span class="divider-dot"></span>
        </div>
    </div>
    <div class="AnaHomeChart-image">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/chart.png" alt="AnaPlayGroup">
    </div>
</section>

<section class="AnaConsultation">
    <!-- ── Your existing title markup (unchanged) ── -->
    <div class="AnaGames-Title AnaStep-fadeUp AnaStep-d1">
        <h1 class="iranSans_bold">درخواست مشاوره و راهنمایی</h1>
        <div class="AnaTitleBoarder">
        <span class="divider-dot"></span>
        <span class="divider-line"></span>
        <span class="divider-diamond"></span>
        <span class="divider-line"></span>
        <span class="divider-dot"></span>
        </div>
        <div class="container px-5 AnaGames-Content">
            <p class="iranSans">ما اینجا هستیم تا در مسیر رسیدن به اهدافتان همراه شما باشیم. اگر پروژه خاصی در نظر دارید یا برای چالش‌های خود به راهنمایی تخصصی نیاز دارید، تیم ما آماده است تا بینش‌های کاربردی مورد نیازتان را ارائه دهد.</p>
        </div>
    </div>
    <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn-consult Anabtn">درخواست مشاوره</a>
    <div class="container AnaConsultation-image">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Consultation.png" alt="AnaPlayGroup">
    </div>
</section>

<section id="about-us" class="container AnaAboutUs">
    <!-- Title -->
    <div class="AnaGames-Title AnaStep-fadeUp AnaStep-d1">
        <h1 class="iranSans_bold">درباره ما</h1>
        <div class="AnaTitleBoarder">
            <span class="divider-dot"></span>
            <span class="divider-line"></span>
            <span class="divider-diamond"></span>
            <span class="divider-line"></span>
            <span class="divider-dot"></span>
        </div>
    </div>
    <!-- Top row: cube + two stacked cards -->
    <div class="AnaAboutUs-body">
        <!-- Rubik cube image (right side in RTL) -->
        <div class="AnaAboutUs-cube AnaStep-fadeUp AnaStep-d2">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/aboutus.png" alt="AnaPlayGroup">
        </div>
        <!-- Two cards stacked on the left -->
        <div class="AnaAboutUs-cards">
            <div class="AnaAboutUs-card AnaStep-fadeUp AnaStep-d5">
                <h3>هوشمندی در دل ساختار</h3>
                <p>
                    سازمان‌های موفق تنها بر پایه فرآیندها و ساختارها ساخته نمی‌شوند؛ بلکه فرهنگ، انگیزه و تعاملات انسانی، قلب تپنده آن‌هاست. ما با تلفیق رفتار شناسی، تفکر سیستمی، روایت و طراحی بازی، مفاهیم پیچیده سازمانی را به تجربه‌هایی ساده، جذاب و اثربخش تبدیل می‌کنیم. هدف ما کمک به ایجاد محیط‌هایی پویا، خلاق و یادگیرنده است که رشد و توسعه در آن‌ها به بخشی طبیعی از فرهنگ سازمانی تبدیل شود.
                </p>
            </div>
            <div class="AnaAboutUs-card AnaStep-fadeUp AnaStep-d4">
                <h3>سفری به اعماق خویشتن</h3>
                <p>
                بسیاری از پاسخ‌های مهم زندگی در درون ما نهفته‌اند. ما با خلق بازی‌ها و تجربه‌های تعاملی، فرصتی فراهم می‌کنیم تا افراد بتوانند الگوهای ذهنی، باورها، احساسات و توانمندی‌های خود را بهتر درک کنند. هر بازی مسیری برای افزایش آگاهی، خودشناسی و رشد فردی است؛ مسیری که به کشف ابعاد تازه‌ای از وجود انسان منتهی می‌شود.
                </p>
            </div>
        </div>
    </div>
    <!-- Bottom row: two equal cards -->
    <div class="AnaAboutUs-bottom" style="margin-top: 24px;">
        <div class="AnaAboutUs-card AnaStep-fadeUp AnaStep-d3">
            <p>
            در آفاق نگار اندیشه آنا ما باور داریم که بازی تنها ابزاری برای سرگرمی نیست؛ بلکه زبانی جهانی برای یادگیری، کشف، ارتباط و رشد است. ما با طراحی تجربه‌های بازی‌محور، تلاش می‌کنیم فضایی خلق کنیم که افراد و سازمان‌ها بتوانند در آن خود را بهتر بشناسند، روابط عمیق‌تری بسازند و ظرفیت‌های پنهان خود را شکوفا کنند.
            </p>
        </div>
        <div class="AnaAboutUs-card AnaStep-fadeUp AnaStep-d6">
            <h3>چشم‌انداز ما</h3>
            <p>
               ما آینده‌ای را تصور می‌کنیم که در آن بازی به عنوان ابزاری قدرتمند برای یادگیری، توسعه فردی و تحول سازمانی شناخته شود. چشم‌انداز ما خلق تجربه‌هایی است که افراد را به شناخت عمیق‌تر خود، ارتباط مؤثرتر با دیگران و ساختن جوامع و سازمان‌هایی انسانی‌تر و آگاه‌تر نزدیک کند. ما باور داریم که هر تغییر ماندگار، از یک تجربه معنادار آغاز می‌شود.
            </p>
        </div>
    </div>
</section>

<?php
// Query all AnaComments
$ana_comments_query = new WP_Query( array(
    'post_type'      => 'ana_comment',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
) );
?>
<?php if ( $ana_comments_query->have_posts() ) : ?>
<div class="container AnaComments">
    <!-- Title -->
    <div class="AnaGames-Title AnaStep-fadeUp AnaStep-d1">
        <h1 class="iranSans_bold">نظرات شرکت کنندگان</h1>
        <div class="AnaTitleBoarder">
            <span class="divider-dot"></span>
            <span class="divider-line"></span>
            <span class="divider-diamond"></span>
            <span class="divider-line"></span>
            <span class="divider-dot"></span>
        </div>
    </div>
    <!-- Slider -->
    <div class="AnaComments-slider-wrap AnaStep-fadeUp AnaStep-d2">
        <!-- Prev arrow -->
        <button class="AnaComments-nav prev" id="ana-prev" aria-label="قبلی">&#8249;</button>
        <div class="AnaComments-track-outer">
            <div class="AnaComments-track" id="ana-track">
                <?php while ( $ana_comments_query->have_posts() ) : $ana_comments_query->the_post(); ?>
                <?php
                    $comment_id     = get_the_ID();
                    $content        = get_post_meta( $comment_id, 'content', true );
                    $commentpoint   = get_post_meta( $comment_id, 'commentpoint', true );
                    $playername     = get_post_meta( $comment_id, 'playername', true );
                    $playermejore   = get_post_meta( $comment_id, 'playermejore', true );
                    $playerimage_id = get_post_meta( $comment_id, 'playerimage', true );
                    $game_title     = get_the_title();
                ?>
                <!-- Card -->
                <div class="AnaComments-card">
                    <?php if ( $content ) : ?>
                        <p class="AnaComments-card-text">
                            <?php echo wp_kses_post( $content ); ?>
                        </p>
                    <?php endif; ?>
                    <div class="AnaComments-card-footer">
                        <div class="AnaComments-avatar">
                            <div class="AnaComments-avatar-item">
                                <div class="AnaComments-avatar-placeholder">
                                    <?php if ( $playerimage_id ) : ?>
                                        <?php echo wp_get_attachment_image(
                                            $playerimage_id,
                                            'thumbnail',
                                            false,
                                            array(
                                                'alt'   => esc_attr( $playername ),
                                                'style' => 'width:100%;height:100%;object-fit:cover;border-radius:50%;',
                                            )
                                        ); ?>
                                    <?php else : ?>
                                        <span class="AnaComments-avatar-fallback">
                                            <?php echo mb_substr( $playername, 0, 1 ); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="AnaComments-avatar-info">
                                    <?php if ( $playername ) : ?>
                                        <div class="AnaComments-avatar-name">
                                            <?php echo esc_html( $playername ); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ( $playermejore ) : ?>
                                        <div class="AnaComments-avatar-role">
                                            <?php echo esc_html( $playermejore ); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="AnaComments-meta">
                            <div class="AnaComments-meta-divider"></div>
                            <div class="AnaComments-meta-item">
                                <span class="AnaComments-meta-label">امتیاز</span>
                                <span class="AnaComments-meta-value">
                                    <span class="coin-icon">★</span>
                                    <?php echo esc_html( $commentpoint ?: '—' ); ?>
                                </span>
                            </div>
                            <div class="AnaComments-meta-divider"></div>
                            <div class="AnaComments-meta-item">
                                <span class="AnaComments-meta-label">نام بازی</span>
                                <span class="AnaComments-meta-value">
                                    <?php echo esc_html( $game_title ); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Card -->
                <?php endwhile; wp_reset_postdata(); ?>
            </div><!-- /track -->
        </div><!-- /track-outer -->
        <!-- Next arrow -->
        <button class="AnaComments-nav next" id="ana-next" aria-label="بعدی">&#8250;</button>
    </div><!-- /slider-wrap -->
    <!-- Dots -->
    <div class="AnaComments-dots" id="ana-dots"></div>
</div><!-- /AnaComments -->
<?php endif; ?>

<?php get_footer(); ?>