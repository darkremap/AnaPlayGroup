document.addEventListener('DOMContentLoaded', function () {

    const toggle = document.getElementById('menu-toggle');
    const nav = document.getElementById('main-navigation');

    if(toggle){

        toggle.addEventListener('click', function(){

            nav.classList.toggle('active');

        });

    }

    window.addEventListener('scroll', function(){

        const header = document.querySelector('.site-header');

        if(window.scrollY > 50){

            header.classList.add('scrolled');

        }else{

            header.classList.remove('scrolled');

        }

    });

});