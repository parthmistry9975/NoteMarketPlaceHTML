/* ==========================================
              preloader
===========================================*/

$(window).on('load', function () { //make sure whole site is loaded
    $('#status').fadeOut();
    $('#preloader').delay(350).fadeOut('slow');
});

/* ==========================================
              navigation
===========================================*/

$('.navbar .navbar-toggler-icon i').click(function () {
    iconName = $('.navbar .navbar-toggler-icon i').attr("class");
    if (iconName == "fa fa-bars") {
        $('.navbar .navbar-toggler-icon i').removeClass("fa fa-bars");
        $('.navbar .navbar-toggler-icon i').addClass("fa fa-times");
    }
    else {
        $('.navbar .navbar-toggler-icon i').removeClass("fa fa-times");
        $('.navbar .navbar-toggler-icon i').addClass("fa fa-bars");
    }
});