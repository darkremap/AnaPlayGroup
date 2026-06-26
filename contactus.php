<?php
/**
 * Template Name: contactus
 * Description: Contact page with Iran phone number registration
 *
 * @package ANA
 */

get_header();
?>

<main id="primary" class="site-main AnaContact-page">

    <!-- ══ Hero Title ══ -->
    <div class="AnaContact-hero AnaStep-fadeUp AnaStep-d1">
        <div class="AnaGames-Title">
            <h1 class="iranSans_bold">تماس با ما</h1>
            <div class="AnaTitleBoarder">
                <span class="divider-dot"></span>
                <span class="divider-line"></span>
                <span class="divider-diamond"></span>
                <span class="divider-line"></span>
                <span class="divider-dot"></span>
            </div>
            <p class="AnaContact-hero__sub iranSans">
                شماره تلفن خود را ثبت کنید تا با شما در تماس باشیم
            </p>
        </div>
    </div>

    <!-- ══ Main Layout ══ -->
    <div class="AnaContact-wrap">

        <!-- ── Left: Info cards ── -->
        <div class="AnaContact-info AnaStep-fadeUp AnaStep-d2">

            <div class="AnaContact-info__card">
                <div class="AnaContact-info__icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.11 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3 1.22h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L7.09 9a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 21 16.92z"/>
                    </svg>
                </div>
                <div class="AnaContact-info__text">
                    <span class="AnaContact-info__label iranSans">تلفن تماس</span>
                    <span class="AnaContact-info__value iranSans_bold" dir="ltr">۰۲۱-۱۲۳۴۵۶۷۸</span>
                </div>
            </div>

            <div class="AnaContact-info__card">
                <div class="AnaContact-info__icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                        <polyline points="22,6 12,13 2,6"/>
                    </svg>
                </div>
                <div class="AnaContact-info__text">
                    <span class="AnaContact-info__label iranSans">ایمیل</span>
                    <span class="AnaContact-info__value iranSans_bold" dir="ltr">info@anaplay.ir</span>
                </div>
            </div>

            <div class="AnaContact-info__card">
                <div class="AnaContact-info__icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                        <circle cx="12" cy="10" r="3"/>
                    </svg>
                </div>
                <div class="AnaContact-info__text">
                    <span class="AnaContact-info__label iranSans">آدرس</span>
                    <span class="AnaContact-info__value iranSans_bold">تهران، خیابان ولیعصر</span>
                </div>
            </div>
        </div>

        <!-- ── Right: Form ── -->
        <div class="AnaContact-form-wrap AnaStep-fadeUp AnaStep-d3">
            <?php
            $success_msg = '';
            $error_msg   = '';
            // نمایش پیام بعد از ریدایرکت
            if ( isset( $_GET['contact_success'] ) ) {
                $success_msg = 'اطلاعات شما با موفقیت ثبت شد. به زودی با شما تماس خواهیم گرفت.';
            }
            if (
                $_SERVER['REQUEST_METHOD'] === 'POST' &&
                isset( $_POST['ana_contact_nonce'] ) &&
                wp_verify_nonce(
                    sanitize_text_field(
                        wp_unslash( $_POST['ana_contact_nonce'] )
                    ),
                    'ana_contact_submit'
                )
            ) {
                $name  = sanitize_text_field(
                    wp_unslash( $_POST['ana_contact_name'] ?? '' )
                );
                $phone = sanitize_text_field(
                    wp_unslash( $_POST['ana_contact_phone'] ?? '' )
                );
                $msg = sanitize_textarea_field(
                    wp_unslash( $_POST['ana_contact_msg'] ?? '' )
                );
                // اعتبارسنجی شماره
                if ( preg_match( '/^09[0-9]{9}$/', $phone ) ) {
                    $inserted = ana_save_contact_submission(
                        $name,
                        $phone,
                        $msg
                    );
                    if ( $inserted ) {
                        ana_notify_admin_contact(
                            $name,
                            $phone,
                            $msg
                        );
                        // جلوگیری از ثبت مجدد هنگام Refresh
                        wp_safe_redirect(
                            add_query_arg(
                                'contact_success',
                                '1',
                                get_permalink()
                            )
                        );
                        exit;
                    } else {
                        $error_msg = 'خطایی رخ داد. لطفاً دوباره تلاش کنید.';
                    }
                } else {
                    $error_msg = 'شماره موبایل وارد شده معتبر نیست. لطفاً یک شماره ۱۱ رقمی با پیش‌شماره ۰۹ وارد کنید.';
                }
            }
            ?>
            <?php if ( $success_msg ) : ?>
                <div class="AnaContact-alert AnaContact-alert--success iranSans">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round" width="20" height="20">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    <?php echo esc_html( $success_msg ); ?>
                </div>
            <?php endif; ?>

            <?php if ( $error_msg ) : ?>
                <div class="AnaContact-alert AnaContact-alert--error iranSans">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round" width="20" height="20">
                        <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/>
                        <line x1="12" y1="16" x2="12.01" y2="16"/>
                    </svg>
                    <?php echo esc_html( $error_msg ); ?>
                </div>
            <?php endif; ?>
            <form class="AnaContact-form" method="post" action="" novalidate id="ana-contact-form">
                <?php wp_nonce_field( 'ana_contact_submit', 'ana_contact_nonce' ); ?>
                <!-- Name -->
                <div class="AnaContact-field">
                    <label for="ana_contact_name" class="AnaContact-label iranSans">
                        نام و نام خانوادگی <span class="req">*</span>
                    </label>
                    <input
                        type="text"
                        id="ana_contact_name"
                        name="ana_contact_name"
                        class="AnaContact-input iranSans"
                        placeholder="مثلاً: علی رضایی"
                        value="<?php echo esc_attr( $_POST['ana_contact_name'] ?? '' ); ?>"
                        required
                    />
                </div>
                <!-- Phone with Iran prefix selector -->
                <div class="AnaContact-field">
                    <label for="ana_contact_phone" class="AnaContact-label iranSans">
                        شماره موبایل <span class="req">*</span>
                    </label>
                    <div class="AnaContact-phone-wrap">
                        <!-- Fixed Iran prefix badge -->
                        <div class="AnaContact-phone-prefix">
                            <img src="https://flagcdn.com/w20/ir.png"
                                 srcset="https://flagcdn.com/w40/ir.png 2x"
                                 width="20" alt="Iran flag" />
                            <span class="iranSans" dir="ltr">+98</span>
                        </div>
                        <input
                            type="tel"
                            id="ana_contact_phone"
                            name="ana_contact_phone"
                            class="AnaContact-input AnaContact-input--phone iranSans"
                            placeholder="09xxxxxxxxx"
                            maxlength="11"
                            pattern="09[0-9]{9}"
                            inputmode="numeric"
                            value="<?php echo esc_attr( $_POST['ana_contact_phone'] ?? '' ); ?>"
                            required
                            dir="ltr"
                        />
                    </div>
                    <span class="AnaContact-hint iranSans">فرمت صحیح: ۰۹۱۲۳۴۵۶۷۸۹</span>
                </div>
                <!-- Message (optional) -->
                <div class="AnaContact-field">
                    <label for="ana_contact_msg" class="AnaContact-label iranSans">
                        پیام <span class="AnaContact-optional iranSans">(اختیاری)</span>
                    </label>
                    <textarea
                        id="ana_contact_msg"
                        name="ana_contact_msg"
                        class="AnaContact-input AnaContact-input--textarea iranSans"
                        placeholder="اگر سؤال یا پیامی دارید اینجا بنویسید..."
                        rows="4"
                    ><?php echo esc_textarea( $_POST['ana_contact_msg'] ?? '' ); ?></textarea>
                </div>
                <!-- Submit -->
                <button type="submit" class="Anabtn btn-DeepOceanBlue AnaContact-submit iranSans_bold">
                    ثبت اطلاعات
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round" width="18" height="18">
                        <line x1="22" y1="2" x2="11" y2="13"/>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                    </svg>
                </button>
            </form>
        </div><!-- .AnaContact-form-wrap -->
    </div><!-- .AnaContact-wrap -->
</main>
<?php get_footer(); ?>