$(document).ready(function() {
    $("#toc-collapser").show().click(function() {
        $("#toc").addClass("hidden");
        $("#content").addClass("full");
    });
    $("#toc-expander").click(function() {
        $("#toc").removeClass("hidden");
        $("#content").removeClass("full");
    });
    $("sup.ref").hover(function(e) {
        if(e.type=="mouseenter") {
            var refid=$("a",$(this)).attr("href").split("#")[1];
            if($("div.ref-preview-"+refid).length>0) {
                return;
            }
            $("div.ref-preview").each(function() {
                var el=$(this);
                el.fadeOut(function(a,b,c) { el.remove(); });
            });
            var target=$("#"+refid);
            var x=e.pageX-$("#content").offset().left;
            var y=$("#content").scrollTop()+e.pageY-$("#content").offset().top;
            var preview=$("<div>").appendTo($("#content")).css({top:y,left:x}).addClass("ref-preview ref-preview-"+refid).append(target.clone());
            setTimeout(function() {
                preview.fadeOut(function() { preview.remove(); });
            },5000);
        }
    });
});