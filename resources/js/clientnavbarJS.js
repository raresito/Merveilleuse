$(document).ready(function() {
    $(window).on("scroll", function() {
        if ($(window).scrollTop() >= 20) {
            $("#clientNavBar").addClass("compressed");
        } else {
            $("#clientNavBar").removeClass("compressed");
        }
    });
});
