$(window).scroll(function () {

    if (document.body.scrollTop > target2) {
        $('#af-container').css('position', 'fixed');
        $('#af-container').css('margin-top', '-131px');
    }
    else {
        $('#af-container').css('position', 'absolute');
        $('#af-container').css('margin-top', '0px');
    }

});
