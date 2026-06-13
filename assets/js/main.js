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
