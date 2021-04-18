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
    $('#toggle-for-icon').removeClass('fa-eye-slash');
  } else {
    input.attr("type", "password");
    $('#toggle-for-icon').addClass('fa-eye-slash');  
  }
});
$(".toggle-password1").click(function () {
  let input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
    $('#toggle-for-icon1').removeClass('fa-eye-slash');
  } else {
    input.attr("type", "password");
    $('#toggle-for-icon1').addClass('fa-eye-slash');  
  }
});
$(".toggle-password2").click(function () {
  let input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
    $('#toggle-for-icon2').removeClass('fa-eye-slash');
  } else {
    input.attr("type", "password");
    $('#toggle-for-icon2').addClass('fa-eye-slash');  
  }
});
/* ==========================================
              navigation
===========================================*/



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

