<?php
/*
Template Name: Karnameh
*/
get_header();
?>

<!-- اطلاعات فردی -->
<section class=" AnaChart-card p-5 mb-8 AnaChart-animIn AnaChart-d1" aria-label="اطلاعات فردی">
    <div class="flex flex-wrap items-center justify-between gap-4 text-sm">
        <div class="flex items-center gap-3">
            <div class="w-11 h-11 rounded-full flex items-center justify-center text-white font-bold text-lg" style="background:linear-gradient(135deg,var(--DeepOceanBlue),var(--TealFlow));">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/chartPersone.jpeg" alt="AnaPlayGroup">
            </div>
            <div>
                <div class="AnaChart-iranSansBold font-bold" style="color:var(--DeepOceanBlue)">سینا اکبری</div>
                <div class="AnaChart-iranSans" style="color:var(--lightGray)">مدیر محصول</div>
            </div>
        </div>
        <div class="flex flex-wrap gap-5 AnaChart-iranSans" style="color:var(--lightGray)">
            <span><i class="fa-regular fa-calendar ml-1"></i> تاریخ: ۱۴۰۳/۰۹/۱۵</span>
            <span><i class="fa-regular fa-clock ml-1"></i> مدت: ۳۸ دقیقه</span>
            <span style="color:var(--TealFlow)"><i class="fa-solid fa-check-circle ml-1"></i> تکمیل‌شده</span>
        </div>
    </div>
</section>

<!-- ========== نمودارهای اصلی ========== -->
<section class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8" aria-label="نمودارهای کلی">
    <!-- ========== تحلیل رفتاری ========== -->
    <div class="AnaChart-card p-6 AnaChart-animIn AnaChart-d2 flex flex-col justify-center AnaChart-pulseGlow">
        <h2 class="AnaChart-iranSansBold text-base font-bold mb-6 w-full text-right" style="color:var(--DeepOceanBlue)">
            <i class="fa-solid fa-fingerprint ml-2" style="color:var(--TealFlow)"></i>تحلیل رفتاری
        </h2>
        <div id="behaviorSection" class="space-y-5">
            <!-- آیتم‌ها توسط جاوااسکریپت در اینجا قرار می‌گیرند -->
        </div>
    </div>

    <!-- نمودار رادار -->
    <div class="AnaChart-card p-6 AnaChart-animIn AnaChart-d3">
        <h2 class="AnaChart-iranSansBold text-base font-bold mb-4" style="color:var(--DeepOceanBlue)">
            <i class="fa-solid fa-diagram-project ml-2" style="color:var(--WarmGold)"></i>پروفایل چندبعدی
        </h2>
        <div style="position:relative;max-height:290px;">
            <canvas id="radarChart"></canvas>
        </div>
    </div>
</section>

<!-- ========== کارت‌های ابعاد ========== -->
<section class="mb-8" aria-label="ابعاد روانشناختی">
    <h2 class="AnaChart-iranSansBold text-lg font-bold mb-5 AnaChart-animIn AnaChart-d3" style="color:var(--DeepOceanBlue)">
        <i class="fa-solid fa-cubes ml-2" style="color:var(--TealFlow)"></i>جزئیات ابعاد
    </h2>
    <div id="dimGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4"></div>
</section>

<!-- ========== نمودار مقایسه‌ای ========== -->
<section class=" AnaChart-card p-6 mb-8 AnaChart-animIn" aria-label="مقایسه ابعاد">
    <h2 class="AnaChart-iranSansBold text-base font-bold mb-5" style="color:var(--DeepOceanBlue)">
        <i class="fa-solid fa-chart-bar ml-2" style="color:var(--WarmGold)"></i>مقایسه ابعاد
    </h2>
    <div id="barSection"></div>
</section>

<!-- ========== راهنمای سطوح ========== -->
<section class=" AnaChart-card p-5 mb-8 AnaChart-animIn" aria-label="راهنمای سطوح">
    <h2 class="AnaChart-iranSansBold text-sm font-bold mb-3" style="color:var(--lightGray)">
        <i class="fa-solid fa-circle-info ml-1"></i>راهنمای تفسیر سطوح
    </h2>
    <div class="flex flex-wrap gap-3 text-xs AnaChart-iranSans">
        <span class="AnaChart-levelBadge" style="background:rgba(10,63,90,0.08);color:var(--DeepOceanBlue)">عالی (۸۵–۱۰۰)</span>
        <span class="AnaChart-levelBadge" style="background:rgba(31,166,166,0.1);color:var(--TealFlow)">خوب (۷۰–۸۴)</span>
        <span class="AnaChart-levelBadge" style="background:rgba(233,164,65,0.12);color:var(--WarmGold)">متوسط (۵۰–۶۹)</span>
        <span class="AnaChart-levelBadge" style="background:rgba(239,68,68,0.08);color:#DC4A4A">پایین (۳۰–۴۹)</span>
        <span class="AnaChart-levelBadge" style="background:rgba(220,38,38,0.08);color:#B91C1C">بحرانی (۰–۲۹)</span>
    </div>
</section>

<!-- ========== توصیه‌ها ========== -->
<section class=" AnaChart-card p-6 mb-8 AnaChart-animIn" aria-label="توصیه‌ها">
    <h2 class="AnaChart-iranSansBold text-base font-bold mb-5" style="color:var(--DeepOceanBlue)">
        <i class="fa-solid fa-lightbulb ml-2" style="color:var(--WarmGold)"></i>توصیه‌های شخصی‌سازی‌شده
    </h2>
    <div id="recsContainer" class="space-y-4"></div>
</section>

<?php get_footer(); ?>