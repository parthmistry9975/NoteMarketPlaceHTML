/* ==========================================
              preloader
===========================================*/

$(window).on('load', function () { //make sure whole site is loaded
    $('#status').fadeOut();
    $('#preloader').delay(350).fadeOut('slow');
});

/* toogle password */


$(".toggle-password").click(function () {
  let input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
/* ==========================================
              navigation
===========================================*/
function sticky_header() {
    var header_height = jQuery('.navbar').innerHeight() / 2;
    var scrollTop = jQuery(window).scrollTop();;
    if (scrollTop > header_height) {
        jQuery('body').addClass('sticky-nav')
        $(".navbar img").attr("src", "images/home/PicsArt_12-23-12.15.33.png");
        $(".navbar-profile .nav-item a img").attr("src", "images/user-profile/login-image.jpg");
    } else {
        jQuery('body').removeClass('sticky-nav')
        $(".navbar img").attr("src", "images/login/top-logo.png");
        $(".navbar-profile .navbar-brand img").attr("src", "images/user-profile/logo.png");
        $(".navbar-profile .nav-item a img").attr("src", "images/user-profile/login-image.jpg");
    }
}

jQuery(document).ready(function () {
  sticky_header();
});

jQuery(window).scroll(function () {
  sticky_header();  
});
jQuery(window).resize(function () {
  sticky_header();
});

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

$('.navbar1 .navbar-toggler-icon i').click(function () {
    iconName = $('.navbar1 .navbar-toggler-icon i').attr("class");
    if (iconName == "fa fa-bars") {
        $('.navbar1 .navbar-toggler-icon i').removeClass("fa fa-bars");
        $('.navbar1 .navbar-toggler-icon i').addClass("fa fa-times");
    }
    else {
        $('.navbar1 .navbar-toggler-icon i').removeClass("fa fa-times");
        $('.navbar1 .navbar-toggler-icon i').addClass("fa fa-bars");
    }
});

function toggleIcon(e) {
    $(e.target)
	    .prev('.panel-heading')
        .find(".more-less")
	    .toggleClass('fa-plus fa-minus');
}
$('.panel-group').on('hidden.bs.collapse', toggleIcon);
$('.panel-group').on('shown.bs.collapse', toggleIcon);

$('#submit').click(function(){
     /* when the submit button in the modal is clicked, submit the form */
    alert('submitting');
    $('#formfield').submit();
});

