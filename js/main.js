(function ($) {
  // Sidebar Toggler
  $(".sidebar-toggler").click(function () {
    $(".sidebar, .content").toggleClass("open");
    if ($(".sidebar, .content").hasClass("open")) {
      $(".logo-user").css("height", "148px");
    } else {
      $(".logo-user").css("height", "123px");
    }
  });
})(jQuery);

$(document).ready(function () {
  $("#submitedit").on("click", function () {
    if ($("#checkbox").is(":checked")) {
      $("#password").prop("required", true);
    } else {
      $("#password").prop("required", false);
    }
  });
});
