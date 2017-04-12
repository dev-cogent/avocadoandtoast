
$(document).ready(function() {
    var $el, leftPos, newWidth,
        $mainNav = $(".avo-list");
    
    $mainNav.append("<li class='magic-line'></li>");
    var $magicLine = $(".magic-line");

    $magicLine
        .width($(".current-page").width())
        .css("left", $(".current-page a").position().left)
        .data("origLeft", $magicLine.position().left)
        .data("origWidth", $magicLine.width());
        
    $(".avo-list li a").hover(function() {
        $el = $(this);
        leftPos = $el.position().left;
        newWidth = $el.parent().width();
        $magicLine.stop().animate({
            left: leftPos,
            width: newWidth
        });
    }, function() {
        $magicLine.stop().animate({
            left: $magicLine.data("origLeft"),
            width: $magicLine.data("origWidth")
        });    
    });
});