//    Mobile Toggle (Hamburger)
document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.getElementById('menu-toggle');
    const mainNavigation = document.getElementById('main-navigation');

    if (menuToggle && mainNavigation) {
        
        menuToggle.addEventListener('click', function () {
            // این خط باید در کنسول مرورگر چاپ شود تا مطمئن شویم کلیک کار میکند
            console.log('Hamburger Clicked!'); 
            
            this.classList.toggle('active');
            mainNavigation.classList.toggle('active');
            
            // لاگ وضعیت کلاس
            console.log('Button classes:', this.className);
        });

        // بستن منو با کلیک روی لینک‌ها
        const menuLinks = mainNavigation.querySelectorAll('a');
        menuLinks.forEach(function(link) {
            link.addEventListener('click', function () {
                menuToggle.classList.remove('active');
                mainNavigation.classList.remove('active');
            });
        });
        
    } else {
        console.log('Error: Menu Toggle or Navigation not found!'); 
    }
});

// AnaGames Section Fore Drower Hover
const panels = document.querySelectorAll('.AnaGames-panel');
panels.forEach(panel => {
  ['mouseenter', 'click'].forEach(evt => {
    panel.addEventListener(evt, () => {
      panels.forEach(p => p.classList.remove('active'));
      panel.classList.add('active');
    });
  });
});

// Char Page -------------------------------------------------------------------

/* ===== ابزارها ===== */
const PD = ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'];
function toFa(n) { return String(n).replace(/\d/g, d => PD[d]); }

/* ===== داده‌ها ===== */
const dims = [
    { name: 'آرامش', score: 72, color: '#1FA6A6', icon: 'fa-spa', desc: 'توانایی حفظ آرامش در شرایط دشوار' },
    { name: 'شادابی', score: 65, color: '#E9A441', icon: 'fa-sun', desc: 'احساس سرزندگی و انرژی مثبت در زندگی' },
    { name: 'مدیریت استرس', score: 48, color: '#DC4A4A', icon: 'fa-shield-halved', desc: 'توانایی مقابله با فشارهای روزمره' },
    { name: 'عزت نفس', score: 81, color: '#0A3F5A', icon: 'fa-crown', desc: 'ارزش‌گذاری مثبت از خود و توانایی‌ها' },
    { name: 'مهارت اجتماعی', score: 74, color: '#1FA6A6', icon: 'fa-people-group', desc: 'توانایی برقراری ارتباط موثر با دیگران' },
    { name: 'هوش هیجانی', score: 68, color: '#E9A441', icon: 'fa-brain', desc: 'شناخت و مدیریت هیجانات خود و دیگران' },
    { name: 'تاب‌آوری', score: 85, color: '#0A3F5A', icon: 'fa-heart-pulse', desc: 'بازگشت سریع پس از سختی‌ها و بحران‌ها' },
    { name: 'خلق و خو', score: 58, color: '#E9A441', icon: 'fa-face-smile', desc: 'وضعیت کلی احساسی و عاطفی روزانه' },
];

const overall = Math.round(dims.reduce((s, d) => s + d.score, 0) / dims.length);

function getLevel(s) {
    if (s >= 85) return { text: 'عالی', color: '#0A3F5A', bg: 'rgba(10,63,90,0.08)' };
    if (s >= 70) return { text: 'خوب', color: '#1FA6A6', bg: 'rgba(31,166,166,0.1)' };
    if (s >= 50) return { text: 'متوسط', color: '#E9A441', bg: 'rgba(233,164,65,0.12)' };
    if (s >= 30) return { text: 'پایین', color: '#DC4A4A', bg: 'rgba(239,68,68,0.08)' };
    return { text: 'بحرانی', color: '#B91C1C', bg: 'rgba(220,38,38,0.08)' };
}

/* ===== شمارش امتیاز کل ===== */
function animateScore() {
    const el = document.getElementById('overallScore');
    let cur = 0;
    const step = Math.max(1, Math.floor(overall / 40));
    const iv = setInterval(() => {
        cur = Math.min(cur + step, overall);
        el.textContent = toFa(cur);
        if (cur >= overall) clearInterval(iv);
    }, 35);
}

/* ===== نمودار دونات ===== */
function createDonut() {
    const ctx = document.getElementById('donutChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [overall, 100 - overall],
                backgroundColor: ['#1FA6A6', '#EDEAE3'],
                borderWidth: 0,
                borderRadius: 8,
            }]
        },
        options: {
            cutout: '78%',
            responsive: true,
            maintainAspectRatio: true,
            plugins: { legend: { display: false }, tooltip: { enabled: false } },
            animation: { animateRotate: true, duration: 1800, easing: 'easeOutQuart' }
        }
    });
}

/* ===== نمودار رادار ===== */
function createRadar() {
    const ctx = document.getElementById('radarChart').getContext('2d');
    new Chart(ctx, {
        type: 'radar',
        data: {
            labels: dims.map(d => d.name),
            datasets: [{
                data: dims.map(d => d.score),
                backgroundColor: 'rgba(31,166,166,0.1)',
                borderColor: '#1FA6A6',
                borderWidth: 2.5,
                pointBackgroundColor: dims.map(d => d.color),
                pointBorderColor: '#FFFFFF',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 8,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    rtl: true,
                    backgroundColor: '#0A3F5A',
                    titleFont: { family: 'Vazirmatn' },
                    bodyFont: { family: 'Vazirmatn' },
                    callbacks: { label: ctx => toFa(ctx.raw) + ' از ۱۰۰' }
                }
            },
            scales: {
                r: {
                    beginAtZero: true,
                    max: 100,
                    ticks: {
                        stepSize: 20,
                        color: '#B0ACA4',
                        backdropColor: 'transparent',
                        font: { family: 'Vazirmatn', size: 9 }
                    },
                    grid: { color: 'rgba(10,63,90,0.07)' },
                    angleLines: { color: 'rgba(10,63,90,0.07)' },
                    pointLabels: {
                        color: '#0A3F5A',
                        font: { family: 'Vazirmatn', size: 11, weight: 600 }
                    }
                }
            },
            animation: { duration: 1500, easing: 'easeOutQuart' }
        }
    });
}

/* ===== کارت‌های ابعاد ===== */
function createDimCards() {
    const grid = document.getElementById('dimGrid');
    const R = 34, C = 2 * Math.PI * R;

    dims.forEach((d, i) => {
        const lv = getLevel(d.score);
        const offset = C * (1 - d.score / 100);
        const card = document.createElement('div');
        card.className = `AnaChart-card p-5 AnaChart-animIn AnaChart-d${i + 1} flex flex-col items-center text-center`;
        card.innerHTML = `
            <svg class="AnaChart-progressRing mb-3" width="82" height="82" viewBox="0 0 82 82">
                <circle class="AnaChart-ringBg" cx="41" cy="41" r="${R}" fill="none" stroke-width="6"/>
                <circle class="AnaChart-ringFg" cx="41" cy="41" r="${R}" fill="none"
                    stroke="${d.color}" stroke-width="6" stroke-linecap="round"
                    stroke-dasharray="${C}" stroke-dashoffset="${C}"
                    data-target="${offset}"/>
            </svg>
            <div style="margin-top:-58px;margin-bottom:22px;position:relative;z-index:1;">
                <span class="AnaChart-iranSansBold text-2xl font-black" style="color:${d.color}">${toFa(d.score)}</span>
            </div>
            <div class="flex items-center gap-2 mb-1.5">
                <i class="fa-solid ${d.icon}" style="color:${d.color};font-size:14px"></i>
                <span class="AnaChart-iranSansBold font-bold text-sm" style="color:var(--DeepOceanBlue)">${d.name}</span>
            </div>
            <span class="AnaChart-levelBadge mb-2 AnaChart-iranSans" style="background:${lv.bg};color:${lv.color}">${lv.text}</span>
            <p class="AnaChart-iranSans text-xs leading-relaxed" style="color:var(--lightGray)">${d.desc}</p>
        `;
        grid.appendChild(card);
    });

    setTimeout(() => {
        document.querySelectorAll('.AnaChart-ringFg').forEach(c => {
            c.style.strokeDashoffset = c.dataset.target;
        });
    }, 600);
}

/* ===== نمودار مقایسه‌ای ===== */
function createBars() {
    const container = document.getElementById('barSection');
    const sorted = [...dims].sort((a, b) => b.score - a.score);
    sorted.forEach(d => {
        const row = document.createElement('div');
        row.className = 'flex items-center gap-3 mb-3';
        row.innerHTML = `
            <span class="w-28 text-xs font-bold text-right AnaChart-iranSans" style="color:${d.color}">${d.name}</span>
            <div class="flex-1 AnaChart-hbarTrack">
                <div class="AnaChart-hbarFill" style="background:linear-gradient(90deg,${d.color},${d.color}88);" data-w="${d.score}%"></div>
            </div>
            <span class="w-8 text-xs font-black text-left AnaChart-iranSansBold" style="color:${d.color}">${toFa(d.score)}</span>
        `;
        container.appendChild(row);
    });
    setTimeout(() => {
        document.querySelectorAll('.AnaChart-hbarFill').forEach(b => { b.style.width = b.dataset.w; });
    }, 800);
}

/* ===== توصیه‌ها ===== */
function createRecs() {
    const recs = [
        {
            dim: 'مدیریت استرس', color: '#DC4A4A', icon: 'fa-triangle-exclamation', priority: 'ضروری',
            texts: [
                'تمرینات تنفس عمیق و آرام‌سازی پیشرونده عضلات را روزانه ۱۵ دقیقه تمرین کنید.',
                'فهرست‌بندی اولویت‌های روزانه و تفکیک مسائل کنترل‌پذیر از غیرقابل کنترل.',
                'استفاده از تکنیک «توقف ذهنی» هنگام بروز افکار استرس‌زا.'
            ]
        },
        {
            dim: 'خلق و خو', color: '#E9A441', icon: 'fa-cloud-sun', priority: 'مهم',
            texts: [
                'فعالیت بدنی منظم حداقل ۳۰ دقیقه در روز (پیاده‌روی، یوگا یا دوچرخه‌سواری).',
                'ثبت روزانه سه اتفاق مثبت در دفتر شکرگزاری.',
                'برنامه‌ریزی برای فعالیت‌های لذت‌بخش حداقل سه بار در هفته.'
            ]
        },
        {
            dim: 'شادابی', color: '#E9A441', icon: 'fa-battery-half', priority: 'توصیه‌شده',
            texts: [
                'بهداشت خواب: ۷ تا ۸ ساعت خواب منظم با برنامه ثابت.',
                'افزایش ارتباطات اجتماعی معنادار و وقت‌گذرانی با دوستان.',
                'مشارکت در فعالیت‌های خلاقانه (نقاشی، موسیقی، باغبانی).'
            ]
        },
        {
            dim: 'تاب‌آوری', color: '#0A3F5A', icon: 'fa-circle-check', priority: 'نقطه قوت',
            texts: [
                'تاب‌آوری شما در سطح عالی قرار دارد. از این نقطه قوت برای حمایت از ابعاد ضعیف‌تر بهره ببرید.',
                'تجربیات غلبه بر سختی‌ها را مکتوب کنید تا الگوی موفقیت خود را بشناسید.'
            ]
        }
    ];

    const container = document.getElementById('recsContainer');
    recs.forEach((r, i) => {
        const div = document.createElement('div');
        div.className = `AnaChart-recCard AnaChart-animIn AnaChart-d${i + 1}`;
        div.style.borderColor = r.color;
        div.innerHTML = `
            <div class="flex items-center gap-2 mb-2">
                <i class="fa-solid ${r.icon}" style="color:${r.color}"></i>
                <span class="AnaChart-iranSansBold font-bold text-sm" style="color:var(--DeepOceanBlue)">${r.dim}</span>
                <span class="AnaChart-levelBadge mr-auto AnaChart-iranSans" style="background:${r.color}18;color:${r.color};font-size:10px">${r.priority}</span>
            </div>
            <ul class="space-y-1.5 mr-4">
                ${r.texts.map(t => `<li class="AnaChart-iranSans text-xs leading-relaxed list-disc" style="color:var(--lightGray)">${t}</li>`).join('')}
            </ul>
        `;
        container.appendChild(div);
    });
}

/* ===== راه‌اندازی ===== */
function initAnaChart() {
    // 1. بلافاصله کلاس AnaChart-loaded را اضافه کن تا opacity: 0 برطرف شود
    document.body.classList.add('AnaChart-loaded');
    
    // 2. بررسی اینکه آیا Chart.js لود شده است یا خیر
    if (typeof Chart === 'undefined') {
        console.warn('AnaChart: Chart.js هنوز لود نشده است. ۱ ثانیه دیگر تلاش می‌شود...');
        setTimeout(initAnaChart, 1000);
        return;
    }

    // 3. اجرای توابع با try-catch تا یک خطا، کل صفحه را متوقف نکند
    try { createDonut(); } catch(e) { console.error('خطا در نمودار دونات:', e); }
    try { createRadar(); } catch(e) { console.error('خطا در نمودار رادار:', e); }
    try { createDimCards(); } catch(e) { console.error('خطا در کارت‌ها:', e); }
    try { createBars(); } catch(e) { console.error('خطا در نمودار مقایسه:', e); }
    try { createRecs(); } catch(e) { console.error('خطا در توصیه‌ها:', e); }
    
    setTimeout(animateScore, 400);
}

// بررسی وضعیت DOM
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initAnaChart);
} else {
    initAnaChart();
}

/* ===== تحلیل رفتاری ===== */
function createBehavior() {
    const container = document.getElementById('behaviorSection');
    if (!container) return; // اگر المان وجود نداشت، خارج شو

    const behaviors = [
        { title: 'واکنش به فشار', leftLabel: 'منفعل', rightLabel: 'واکنشی', value: 35, desc: 'واکنش اولیه شدید به استرس اما بازگشت سریع به حالت تعادل' },
        { title: 'سبک ارتباطی', leftLabel: 'انزواطلب', rightLabel: 'اجتماعی', value: 65, desc: 'تعادل بین تنهایی و معاشرت، ترجیح ارتباطات عمیق و کوچک' },
        { title: 'درک از خود', leftLabel: 'خودمنتقد', rightLabel: 'خودباور', value: 78, desc: 'ارزش‌گذاری مثبت از توانایی‌ها با نوسانات گاه‌وبیگاه' },
        { title: 'پردازش هیجانی', leftLabel: 'تحلیلی', rightLabel: 'شهودی', value: 50, desc: 'ترکیبی از منطق و احساس، نیاز به محرک برای حفظ شادابی' }
    ];

    behaviors.forEach(b => {
        const row = document.createElement('div');
        row.innerHTML = `
            <div class="flex justify-between items-center mb-1.5">
                <span class="AnaChart-iranSansBold text-xs font-bold" style="color:var(--DeepOceanBlue)">${b.title}</span>
                <span class="AnaChart-iranSans text-xs font-bold" style="color:var(--TealFlow)">${toFa(b.value)}%</span>
            </div>
            <div class="flex justify-between items-center mb-1">
                <span class="AnaChart-spectrumLabel AnaChart-iranSans">${b.leftLabel}</span>
                <span class="AnaChart-spectrumLabel AnaChart-iranSans">${b.rightLabel}</span>
            </div>
            <div class="AnaChart-spectrumTrack">
                <div class="AnaChart-spectrumFill" data-w="${b.value}%"></div>
                <div class="AnaChart-spectrumDot" data-pos="${b.value}%"></div>
            </div>
            <p class="AnaChart-iranSans text-xs mt-1.5 leading-relaxed" style="color:var(--lightGray)">${b.desc}</p>
        `;
        container.appendChild(row);
    });

    // اجرای انیمیشن با تاخیر کمی برای لود شدن المان‌ها
    setTimeout(() => {
        document.querySelectorAll('.AnaChart-spectrumFill').forEach(el => { 
            el.style.width = el.getAttribute('data-w'); 
        });
        document.querySelectorAll('.AnaChart-spectrumDot').forEach(el => { 
            el.style.left = el.getAttribute('data-pos'); 
        });
    }, 800);
}

// فراخوانی تابع (اگر از DOMContentLoaded استفاده می‌کنید، این خط را داخل آن قرار دهید)
createBehavior();