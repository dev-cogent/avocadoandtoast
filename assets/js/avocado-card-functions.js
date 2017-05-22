$(document).on('click', '.switch', function () {
    var platform = $(this).attr('data-platform');
    var id = $(this).attr('data-id');
    if (platform == 'facebook') {
        platform1 = 'instagram';
        platform2 = 'twitter';
        platform3 = 'youtube';
    }
    if (platform == 'twitter') {
        platform1 = 'instagram';
        platform2 = 'facebook';
        platform3 = 'youtube';
    }
    if (platform == 'instagram') {
        platform1 = 'twitter';
        platform2 = 'facebook';
        platform3 = 'youtube';
    }
    if(platform == 'youtube'){
        platform1 = 'instagram';
        platform2 = 'twitter';
        platform3 = 'facebook';
    }

    $(this).addClass('active-card-icon');
    //setting all the other colors to grey
    $('.show-' + platform1 + '[data-id=' + id + ']').removeClass('active-card-icon');
    $('.show-' + platform2 + '[data-id=' + id + ']').removeClass('active-card-icon');
    $('.show-' + platform3 + '[data-id=' + id + ']').removeClass('active-card-icon');
    //Showing the proper handles
    $('.' + platform + '-handle[data-id=' + id + ']').show();
    $('.' + platform1 + '-handle[data-id=' + id + ']').css('display', 'none');
    $('.' + platform2 + '-handle[data-id=' + id + ']').css('display', 'none');
    $('.' + platform3 + '-handle[data-id=' + id + ']').css('display', 'none');
    //Now showing the proper followers
    $('.' + platform + '-follower-count[data-id=' + id + ']').show();
    $('.' + platform1 + '-follower-count[data-id=' + id + ']').css('display', 'none');
    $('.' + platform2 + '-follower-count[data-id=' + id + ']').css('display', 'none');
    $('.' + platform3 + '-follower-count[data-id=' + id + ']').css('display', 'none');
    //Now showing the proper engagement
    $('.' + platform + '-engagement[data-id=' + id + ']').show();
    $('.' + platform1 + '-engagement[data-id=' + id + ']').css('display', 'none');
    $('.' + platform2 + '-engagement[data-id=' + id + ']').css('display', 'none');
    $('.' + platform3 + '-engagement[data-id=' + id + ']').css('display', 'none');

});




