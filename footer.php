

<!-- ══ CTA Banner ══ -->
<div class="AnaCTA">
    <div class="AnaCTA-title">درخواست ثبت نام</div>
 
    <p class="AnaCTA-desc">
        به جمع بازیکنان بپیوندید یا دنیای ما را از نزدیک تجربه کنید؛ همین حالا برای شروع بازی یا رزرو دمو اقدام کنید.
    </p>
 
    <a href="<?php echo esc_url( home_url( '/register' ) ); ?>" class="AnaCTA-btn" aria-label="ثبت نام">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
             stroke-linecap="round" stroke-linejoin="round">
            <line x1="7" y1="17" x2="17" y2="7"/>
            <polyline points="7 7 17 7 17 17"/>
        </svg>
    </a>
</div>
 
<!-- ══ Footer ══ -->
<footer class="AnaFooter" itemscope itemtype="https://schema.org/WPFooter">
 
    <!-- Logo -->
    <div class="AnaFooter-logo">
        <?php if ( has_custom_logo() ) : ?>
            <?php the_custom_logo(); ?>
        <?php else : ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.png' ); ?>"
                     alt="<?php bloginfo( 'name' ); ?>" />
            </a>
        <?php endif; ?>
    </div>
 
    <!-- Nav — uses a custom "footer-menu" location -->
    <?php
    $footer_menu = wp_nav_menu( [
        'theme_location' => 'footer-menu',
        'menu_class'     => 'AnaFooter-nav',
        'container'      => 'nav',
        'container_class'=> '',
        'depth'          => 1,
        'fallback_cb'    => false,
        'echo'           => false,
    ] );
 
    if ( $footer_menu ) {
        echo $footer_menu;
    } else {
        // Fallback hardcoded links
        ?>
        <nav class="AnaFooter-nav">
            <a href="<?php echo esc_url( home_url( '/about' ) ); ?>"
               <?php echo is_page( 'about' ) ? 'class="current-menu-item"' : ''; ?>>درباره ما</a>
            <a href="<?php echo esc_url( home_url( '/games' ) ); ?>">بازی</a>
            <a href="<?php echo esc_url( home_url( '/encyclopedia' ) ); ?>">دانشنامه</a>
            <a href="<?php echo esc_url( home_url( '/packages' ) ); ?>">پکیج</a>
            <a href="<?php echo esc_url( home_url( '/events' ) ); ?>">رویداد</a>
        </nav>
        <?php
    }
    ?>
 
    <!-- Social Icons -->
    <div class="AnaFooter-social">
 
        <?php
        // Store social URLs in Customizer — Appearance > Customize > Social Links
        $facebook  = get_theme_mod( 'ana_social_facebook',  'https://github.com/darkremap/AnaPlayGroup/pull/13' );
        $twitter   = get_theme_mod( 'ana_social_twitter',   'https://github.com/darkremap/AnaPlayGroup/pull/13' );
        $instagram = get_theme_mod( 'ana_social_instagram', 'https://github.com/darkremap/AnaPlayGroup/pull/13' );
        $linkedin  = get_theme_mod( 'ana_social_linkedin',  'https://github.com/darkremap/AnaPlayGroup/pull/13' );
        $whatsapp  = get_theme_mod( 'ana_social_whatsapp',  'https://github.com/darkremap/AnaPlayGroup/pull/13' );
        $telegram  = get_theme_mod( 'ana_social_telegram',  'https://github.com/darkremap/AnaPlayGroup/pull/13' );
        ?>
 
        <?php if ( $facebook && $facebook !== '#' ) : ?>
        <a href="<?php echo esc_url( $facebook ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
            <svg viewBox="0 0 38 38" xmlns="http://www.w3.org/2000/svg">
                <circle cx="19" cy="19" r="19" fill="#1877F2"/>
                <path d="M24 12h-2.5A1.5 1.5 0 0 0 20 13.5V16h4l-.5 4H20v10h-4V20h-3v-4h3v-2.5C16 10.57 17.57 9 19.5 9H24v3z" fill="#fff"/>
            </svg>
        </a>
        <?php endif; ?>
 
        <?php if ( $twitter && $twitter !== '#' ) : ?>
        <a href="<?php echo esc_url( $twitter ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Twitter">
            <svg viewBox="0 0 38 38" xmlns="http://www.w3.org/2000/svg">
                <circle cx="19" cy="19" r="19" fill="#1DA1F2"/>
                <path d="M29 13.5a8.3 8.3 0 0 1-2.36.65 4.14 4.14 0 0 0 1.81-2.28 8.27 8.27 0 0 1-2.61 1A4.12 4.12 0 0 0 19 17.13a11.7 11.7 0 0 1-8.5-4.3 4.12 4.12 0 0 0 1.27 5.5 4.1 4.1 0 0 1-1.86-.52v.05a4.13 4.13 0 0 0 3.3 4.04 4.15 4.15 0 0 1-1.86.07 4.13 4.13 0 0 0 3.85 2.86A8.27 8.27 0 0 1 9 26.5a11.67 11.67 0 0 0 6.3 1.85c7.57 0 11.71-6.27 11.71-11.71l-.01-.53A8.36 8.36 0 0 0 29 13.5z" fill="#fff"/>
            </svg>
        </a>
        <?php endif; ?>
 
        <?php if ( $instagram && $instagram !== '#' ) : ?>
        <a href="<?php echo esc_url( $instagram ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
            <svg viewBox="0 0 38 38" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <radialGradient id="ig-grad" cx="30%" cy="107%" r="130%">
                        <stop offset="0%"   stop-color="#fdf497"/>
                        <stop offset="10%"  stop-color="#fdf497"/>
                        <stop offset="50%"  stop-color="#fd5949"/>
                        <stop offset="68%"  stop-color="#d6249f"/>
                        <stop offset="100%" stop-color="#285AEB"/>
                    </radialGradient>
                </defs>
                <circle cx="19" cy="19" r="19" fill="url(#ig-grad)"/>
                <rect x="12" y="12" width="14" height="14" rx="4" ry="4" fill="none" stroke="#fff" stroke-width="1.8"/>
                <circle cx="19" cy="19" r="3.5" fill="none" stroke="#fff" stroke-width="1.8"/>
                <circle cx="24" cy="14" r="1" fill="#fff"/>
            </svg>
        </a>
        <?php endif; ?>
 
        <?php if ( $linkedin && $linkedin !== '#' ) : ?>
        <a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
            <svg viewBox="0 0 38 38" xmlns="http://www.w3.org/2000/svg">
                <circle cx="19" cy="19" r="19" fill="#0A66C2"/>
                <path d="M13 16h3v10h-3zM14.5 14.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zM22 16h-3v10h3v-5.5c0-1.5.75-2.5 2-2.5s2 .75 2 2.5V26h3v-6c0-3-1.5-4-3.5-4A3.5 3.5 0 0 0 22 17.5V16z" fill="#fff"/>
            </svg>
        </a>
        <?php endif; ?>
 
        <?php if ( $whatsapp && $whatsapp !== '#' ) : ?>
        <a href="<?php echo esc_url( $whatsapp ); ?>" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp">
            <svg viewBox="0 0 38 38" xmlns="http://www.w3.org/2000/svg">
                <circle cx="19" cy="19" r="19" fill="#25D366"/>
                <path d="M27.5 10.5A11.9 11.9 0 0 0 19 7C12.37 7 7 12.37 7 19a11.93 11.93 0 0 0 1.6 6L7 31l6.18-1.62A11.94 11.94 0 0 0 19 31c6.63 0 12-5.37 12-12a11.9 11.9 0 0 0-3.5-8.5zM19 29a9.94 9.94 0 0 1-5.07-1.38l-.36-.22-3.77.99 1-3.67-.24-.38A9.95 9.95 0 0 1 9 19c0-5.52 4.48-10 10-10s10 4.48 10 10-4.48 10-10 10zm5.45-7.45c-.3-.15-1.76-.87-2.03-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.94 1.17-.17.2-.35.22-.65.07a8.17 8.17 0 0 1-2.4-1.48 9.02 9.02 0 0 1-1.66-2.07c-.17-.3-.02-.46.13-.61.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.07-.15-.67-1.6-.91-2.2-.24-.57-.49-.5-.67-.5h-.57c-.2 0-.52.07-.8.37-.27.3-1.04 1.02-1.04 2.47s1.07 2.87 1.22 3.07c.15.2 2.1 3.2 5.08 4.49.71.31 1.27.49 1.7.62.72.23 1.37.2 1.89.12.57-.09 1.76-.72 2.01-1.42.25-.7.25-1.3.17-1.42-.07-.12-.27-.2-.57-.35z" fill="#fff"/>
            </svg>
        </a>
        <?php endif; ?>
 
        <?php if ( $telegram && $telegram !== '#' ) : ?>
        <a href="<?php echo esc_url( $telegram ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Telegram">
            <svg viewBox="0 0 38 38" xmlns="http://www.w3.org/2000/svg">
                <circle cx="19" cy="19" r="19" fill="#26A5E4"/>
                <path d="M28.5 10.3L8.7 18.1c-1.3.5-1.3 1.3-.2 1.6l5.1 1.6 11.8-7.4c.6-.4 1.1-.2.7.2L15.6 23l-.4 5.2c.6 0 .9-.3 1.2-.6l2.9-2.8 5.1 3.8c.9.5 1.6.2 1.8-.9l3.3-15.6c.3-1.3-.5-1.9-1.6-1.8z" fill="#fff"/>
            </svg>
        </a>
        <?php endif; ?>
 
    </div><!-- .AnaFooter-social -->
 
    <div class="AnaFooter-divider"></div>
 
    <p class="AnaFooter-copy">
        &copy; <?php echo esc_html( date( 'Y' ) ); ?>
        <?php bloginfo( 'name' ); ?>. All rights reserved.
    </p>
 
</footer><!-- .AnaFooter -->

<?php wp_footer(); ?>
</body>

</html>