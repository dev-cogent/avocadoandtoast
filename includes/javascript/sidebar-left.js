$(window).scroll(function () {

    if (document.body.scrollTop > target2) {
        $('.sidebar-left').css('position', 'fixed');
        $('.sidebar-left').css('margin-top', '-131px');
    }
    else {
        $('.sidebar-left').css('position', 'absolute');
        $('.sidebar-left').css('margin-top', '0px');
    }

});

if(typeof target !== 'undefined'){
$(window).scroll(function () {
    if (document.body.scrollTop > target) {
        $('#campaign-details').css('position','fixed');
        $('#campaign-details').css('margin-top', '-190px');
    }
    else {
        $('#campaign-details').css('position','absolute');
        $('#campaign-details').css('margin-top', '0px');
    }

});

}