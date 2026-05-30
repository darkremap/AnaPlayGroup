
// Mobile navigation functionality
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.getElementById('menu-toggle');
    const primaryMenu = document.getElementById('primary-menu');
    const mainNavigation = document.getElementById('main-navigation');
    
    if (!menuToggle || !primaryMenu) return;
    
    // Toggle mobile menu
    menuToggle.addEventListener('click', function() {
        const isExpanded = this.getAttribute('aria-expanded') === 'true';
        
        this.classList.toggle('active');
        primaryMenu.classList.toggle('active');
        this.setAttribute('aria-expanded', !isExpanded);
    });
    
    // Add dropdown toggle buttons for mobile
    const dropdownItems = primaryMenu.querySelectorAll('.menu-item-has-children');
    
    dropdownItems.forEach(function(item) {
        const dropdownToggle = document.createElement('button');
        dropdownToggle.className = 'mobile-dropdown-toggle';
        dropdownToggle.innerHTML = '+';
        dropdownToggle.setAttribute('aria-expanded', 'false');
        
        const subMenu = item.querySelector('.sub-menu, .children');
        if (subMenu) {
            item.appendChild(dropdownToggle);
            
            dropdownToggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const isExpanded = this.getAttribute('aria-expanded') === 'true';
                this.setAttribute('aria-expanded', !isExpanded);
                subMenu.classList.toggle('active');
                this.innerHTML = isExpanded ? '+' : '−';
            });
        }
    });
    
    // Close menu when clicking outside
    document.addEventListener('click', function(e) {
        if (!mainNavigation.contains(e.target)) {
            menuToggle.classList.remove('active');
            primaryMenu.classList.remove('active');
            menuToggle.setAttribute('aria-expanded', 'false');
            
            // Close all dropdowns
            dropdownItems.forEach(function(item) {
                const subMenu = item.querySelector('.sub-menu, .children');
                const toggle = item.querySelector('.mobile-dropdown-toggle');
                if (subMenu && toggle) {
                    subMenu.classList.remove('active');
                    toggle.setAttribute('aria-expanded', 'false');
                    toggle.innerHTML = '+';
                }
            });
        }
    });
    
    // Close menu on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            menuToggle.classList.remove('active');
            primaryMenu.classList.remove('active');
            menuToggle.setAttribute('aria-expanded', 'false');
        }
    });
    
    // Smooth scroll for anchor links
    const anchorLinks = document.querySelectorAll('a[href*="#"]');
    anchorLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            if (this.pathname === window.location.pathname && this.hash) {
                e.preventDefault();
                
                const target = document.querySelector(this.hash);
                if (target) {
                    // Close mobile menu if open
                    if (window.innerWidth <= 768) {
                        menuToggle.classList.remove('active');
                        primaryMenu.classList.remove('active');
                        menuToggle.setAttribute('aria-expanded', 'false');
                    }
                    
                    window.scrollTo({
                        top: target.offsetTop - 100,
                        behavior: 'smooth'
                    });
                }
            }
        });
    });
});