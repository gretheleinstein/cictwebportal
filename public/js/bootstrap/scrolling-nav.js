
$(document).ready(function() {
$(window).scroll(function() {
    if ($(".navbar").offset().top > 50) {
        $(".navbar-expand-md").addClass('navbar-darker');
        $(".navbar-fixed-top").removeClass("navbar-transparent");
        $("#logo").width('150px');
        $("#logo").height('50px');
    } else {
        $(".navbar-expand-md").removeClass('navbar-darker');
        $(".navbar-fixed-top").addClass("navbar-transparent");
        $("#logo").width('420px');
        $("#logo").height('150px');
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
