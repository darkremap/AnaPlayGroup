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

