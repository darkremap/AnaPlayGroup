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
    const activate = () => {
    panels.forEach(p => p.classList.remove('active'));
    panel.classList.add('active');
    };

    panel.addEventListener('mouseenter', activate);
    panel.addEventListener('click', activate);
});

// Char Page -------------------------------------------------------------------


// AnaPoint --------------------------------------------------------------------------------
// AnaPoint – IntersectionObserver scroll animation
(function () {
  const cards = document.querySelectorAll('.AnaPoint-Card');

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          observer.unobserve(entry.target); // یه‌بار اجرا می‌شه
        }
      });
    },
    { threshold: 0.15 }
  );

  cards.forEach((card) => observer.observe(card));
})();


// AnaSteo--------------------------------------------------------------------------------


// AnaComments  ---------------------------------------------------------------------------

(function () {
    const track   = document.getElementById('ana-track');
    const prevBtn = document.getElementById('ana-prev');
    const nextBtn = document.getElementById('ana-next');
    const dotsEl  = document.getElementById('ana-dots');
 
    const cards      = track.querySelectorAll('.AnaComments-card');
    const total      = cards.length;
    const visibleCount = () => window.innerWidth <= 760 ? 1 : 2;
    let current = 0;
 
    // Build dots
    function buildDots() {
      dotsEl.innerHTML = '';
      const steps = total - visibleCount() + 1;
      for (let i = 0; i < steps; i++) {
        const d = document.createElement('span');
        d.className = 'AnaComments-dot' + (i === current ? ' active' : '');
        d.addEventListener('click', () => goTo(i));
        dotsEl.appendChild(d);
      }
    }
 
    function updateDots() {
      dotsEl.querySelectorAll('.AnaComments-dot').forEach((d, i) => {
        d.classList.toggle('active', i === current);
      });
    }
 
    function cardWidth() {
      return cards[0].offsetWidth + 24; // 24 = gap
    }
 
    function goTo(index) {
      const maxIndex = total - visibleCount();
      current = Math.max(0, Math.min(index, maxIndex));
      track.style.transform = `translateX(${current * cardWidth()}px)`;
      updateDots();
    }
 
    prevBtn.addEventListener('click', () => goTo(current - 1));
    nextBtn.addEventListener('click', () => goTo(current + 1));
 
    // Keyboard
    document.addEventListener('keydown', e => {
      if (e.key === 'ArrowRight') goTo(current - 1);
      if (e.key === 'ArrowLeft')  goTo(current + 1);
    });
 
    // Touch/swipe
    let startX = 0;
    track.addEventListener('touchstart', e => { startX = e.touches[0].clientX; }, { passive: true });
    track.addEventListener('touchend', e => {
      const diff = startX - e.changedTouches[0].clientX;
      if (Math.abs(diff) > 40) goTo(diff > 0 ? current + 1 : current - 1);
    });
 
    // Init & resize
    buildDots();
    window.addEventListener('resize', () => { buildDots(); goTo(current); });
  })();