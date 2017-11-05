//jQuery to collapse the navbar on scroll
$(window).scroll(function() {
  $("#a.login").click();
    if ($(".navbar").offset().top > 50) {
        $(".navbar-fixed-top").addClass("top-nav-collapse");
        $(".navbar-fixed-top").removeClass("navbar-transparent");
        $(".a-signin").removeClass("corners-rounded btn btn-default");
    } else {
        $(".navbar-fixed-top").removeClass("top-nav-collapse");
        $(".navbar-fixed-top").addClass("navbar-transparent");
        $(".a-signin").addClass("corners-rounded btn btn-default");
    }
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
