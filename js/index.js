$(document).ready(function() {
    $("#toc-collapser").show().click(function() {
        $("#toc").addClass("hidden");
        $("#content").addClass("full");
    });
    $("#toc-expander").click(function() {
        $("#toc").removeClass("hidden");
        $("#content").removeClass("full");
    });
});