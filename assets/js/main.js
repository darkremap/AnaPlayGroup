//    Mobile Toggle (Hamburger)
document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.getElementById('menu-toggle');
    const mainNavigation = document.getElementById('main-navigation');

    if (menuToggle && mainNavigation) {
        
        menuToggle.addEventListener('click', function () {
            this.classList.toggle('active');
            mainNavigation.classList.toggle('active');
            this.setAttribute('aria-expanded', this.classList.contains('active') ? 'true' : 'false');
        });

        // بستن منو با کلیک روی لینک‌ها
        const menuLinks = mainNavigation.querySelectorAll('a');
        menuLinks.forEach(function(link) {
            link.addEventListener('click', function () {
                menuToggle.classList.remove('active');
                mainNavigation.classList.remove('active');
                menuToggle.setAttribute('aria-expanded', 'false');
            });
        });

        // بستن منو با کلیک روی هر جای صفحه بجز خود منو و دکمه همبرگر
        document.addEventListener('click', function (e) {
            if (!mainNavigation.classList.contains('active')) return;
            const clickedInsideNav    = mainNavigation.contains(e.target);
            const clickedToggleButton = menuToggle.contains(e.target);
            if (!clickedInsideNav && !clickedToggleButton) {
                menuToggle.classList.remove('active');
                mainNavigation.classList.remove('active');
                menuToggle.setAttribute('aria-expanded', 'false');
            }
        });
        
    } else {
        console.log('Error: Menu Toggle or Navigation not found!'); 
    }


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
(function(){

const track=document.getElementById("ana-track");
const prev=document.getElementById("ana-prev");
const next=document.getElementById("ana-next");
const dots=document.getElementById("ana-dots");

if(!track) return;

const cards=[...track.querySelectorAll(".AnaComments-card")];

let current=0;

function visible(){

    return window.innerWidth<=760?1:2;

}

function gap(){

    return parseFloat(getComputedStyle(track).gap)||0;

}

function cardWidth(){

    return cards[0].getBoundingClientRect().width+gap();

}

function maxIndex(){

    return Math.max(0,cards.length-visible());

}

function move(){

    track.style.transform=`translateX(-${current*cardWidth()}px)`;

    updateDots();

}

function go(index){

    current=Math.max(0,Math.min(index,maxIndex()));

    move();

}

function buildDots(){

    dots.innerHTML="";

    for(let i=0;i<=maxIndex();i++){

        const d=document.createElement("span");

        d.className="AnaComments-dot";

        if(i===current) d.classList.add("active");

        d.onclick=()=>go(i);

        dots.appendChild(d);

    }

}

function updateDots(){

    [...dots.children].forEach((d,i)=>{

        d.classList.toggle("active",i===current);

    });

}

prev?.addEventListener("click",()=>go(current-1));

next?.addEventListener("click",()=>go(current+1));



let startX=0;

let delta=0;

const outer=document.querySelector(".AnaComments-track-outer");

outer.addEventListener("touchstart",(e)=>{

startX=e.touches[0].clientX;

delta=0;

},{passive:true});

outer.addEventListener("touchmove",(e)=>{

delta=e.touches[0].clientX-startX;

},{passive:true});

outer.addEventListener("touchend",()=>{

if(Math.abs(delta)>50){

if(delta<0){

go(current+1);

}else{

go(current-1);

}

}

});



window.addEventListener("resize",()=>{

current=Math.min(current,maxIndex());

buildDots();

move();

});

buildDots();

move();

})();

// contact us form to create phon number ---------------------------------------------------
  (function(){
      // Live phone validation feedback
      const phoneInput = document.getElementById('ana_contact_phone');
      const hint       = phoneInput ? phoneInput.closest('.AnaContact-field').querySelector('.AnaContact-hint') : null;
      if ( phoneInput ) {
          // Allow only digits
          phoneInput.addEventListener('input', function(){
              this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11);
              const valid = /^09[0-9]{9}$/.test(this.value);
              this.classList.toggle('is-valid',   this.value.length === 11 && valid);
              this.classList.toggle('is-invalid', this.value.length > 0 && !valid);
              if ( hint ) {
                  hint.textContent = valid
                      ? '✓ شماره معتبر است'
                      : (this.value.length > 0 ? 'شماره باید ۱۱ رقم و با ۰۹ شروع شود' : 'فرمت صحیح: ۰۹۱۲۳۴۵۶۷۸۹');
                  hint.style.color = valid ? '#1FA6A6' : '#c0392b';
              }
          });
          // Form submit guard
          const form = document.getElementById('ana-contact-form');
          if ( form ) {
              form.addEventListener('submit', function(e){
                  if ( !/^09[0-9]{9}$/.test(phoneInput.value) ) {
                      e.preventDefault();
                      phoneInput.classList.add('is-invalid');
                      phoneInput.focus();
                  }
              });
          }
      }
  })();

// scroll page to about us  -------------------------------------------------------------
// scroll page to games -------------------------------------------------------------
// Smooth scroll for anchor links
document.addEventListener('DOMContentLoaded', function () {
    function smoothScrollTo(targetId) {
        var target = document.getElementById(targetId);
        if (!target) return;
        // Close mobile menu if open
        var menuToggle = document.getElementById('menu-toggle');
        var nav = document.querySelector('.main-navigation');
        if (nav && nav.classList.contains('active')) {
            nav.classList.remove('active');
            if (menuToggle) {
                menuToggle.classList.remove('active');
                menuToggle.setAttribute('aria-expanded', 'false');
            }
        }
        // Offset for sticky header
        var headerHeight = document.getElementById('masthead')
            ? document.getElementById('masthead').offsetHeight
            : 0;

        var targetTop = target.getBoundingClientRect().top + window.pageYOffset - headerHeight - 16;
        window.scrollTo({ top: targetTop, behavior: 'smooth' });
    }
    // درباره ما
    document.querySelectorAll('a[href="#about-us"], a[href*="/#about-us"]').forEach(function (link) {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            smoothScrollTo('about-us');
        });
    });
    // بازی ها
    document.querySelectorAll('a[href="#games"], a[href*="/#games"]').forEach(function (link) {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            smoothScrollTo('games');
        });
    });
});
    // Smooth scroll for anchor links (درباره ما and any #hash links)
  // document.addEventListener('DOMContentLoaded', function () {
  //     document.querySelectorAll('a[href*="#about-us"], a[href="#about-us"]').forEach(function (link) {
  //         link.addEventListener('click', function (e) {
  //             var target = document.getElementById('about-us');
  //             if (!target) return;
  //             e.preventDefault();
  //             // Close mobile menu if open
  //             var menuToggle = document.getElementById('menu-toggle');
  //             var nav = document.querySelector('.main-navigation');
  //             if (nav && nav.classList.contains('is-active')) {
  //                 nav.classList.remove('is-active');
  //                 if (menuToggle) menuToggle.classList.remove('is-active');
  //             }
  //             // Offset for sticky header
  //             var headerHeight = document.getElementById('masthead')
  //                 ? document.getElementById('masthead').offsetHeight
  //                 : 0;
  //             var targetTop = target.getBoundingClientRect().top + window.pageYOffset - headerHeight - 16;
  //             window.scrollTo({ top: targetTop, behavior: 'smooth' });
  //         });
  //     });
  // });

});