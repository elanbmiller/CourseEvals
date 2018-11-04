$(window).scroll(function(){
    $('nav').toggleClass('navScroll', $(this).scrollTop() > 10);
    $('nav div ul li a.nav-link').toggleClass('navLinkScroll', $(this).scrollTop() > 10);
});