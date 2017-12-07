
$(document).ready(function() {
$(window).scroll(function() {
    if ($(".navbar").offset().top > 50) {
        $("#navbar_main").addClass('navbar-darker');
        $("#navbar_main").removeClass("navbar-transparent");
        $("#logo_main").width('150px');
        $("#logo_main").height('50px');
    } else {
        $("#navbar_main").removeClass('navbar-darker');
        $("#navbar_main").addClass("navbar-transparent");
        $("#logo_main").width('420px');
        $("#logo_main").height('150px');
    }
});
});


//jQuery for page scrolling feature - requires jQuery Easing plugin
$(function() {
   $(document).on('click', 'a.page-scroll', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top - $('.navbar').height()
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });

    $("#login-form").click(function() {
      $('html, body').animate({
          scrollTop: $("#login-div").offset().top - $('.navbar').height()
    }, 2000);
    });
});
