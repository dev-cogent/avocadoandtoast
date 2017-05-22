$(document).on('click', '.social-profile-tab', function() {
    var platform = $(this).attr('data-platform');
    var handle = $(this).attr('data-handle');

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
      platform1 = 'twitter';
      platform2 = 'facebook';
      platform3 = 'instagram';
    }

    $('.switch[data-platform="'+platform+'"]').addClass('active-tab');
    $('.switch[data-platform="'+platform1+'"]').removeClass('active-tab');
    $('.switch[data-platform="'+platform2+'"]').removeClass('active-tab');
    $('.switch[data-platform="'+platform3+'"]').removeClass('active-tab');

    $('#' + platform).removeAttr('style');
    $('#' + platform1).css('display', 'none');
    $('#' + platform2).css('display', 'none');
    $('#' + platform3).css('display', 'none');
});


$(document).ready(function() {
    var handle = $('.social-profile-tab[data-platform=instagram]').attr('data-handle');
    $.ajax({
        type: 'POST',
        url: '/php/ajax/latestimage.php',
        data: {
            inst_user: handle
        },
        success: function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
            $('#instagram').append(jqXHR);
        }
    }); // end ajax request*/

    var handle = $('.social-profile-tab[data-platform=twitter]').attr('data-handle');
    $.ajax({
        type: 'POST',
        url: '/php/ajax/latesttweets.php',
        data: {
            twitter_handle: handle
        },
        success: function(jqXHR, textStatus, errorThrown) {
            $('#twitter').append(jqXHR);
        }
    }); // end ajax request*/

    var handle = $('.social-profile-tab[data-platform=youtube]').attr('data-handle');
    $.ajax({
        type: 'POST',
        url: '/php/ajax/latestvideos.php',
        data: {
            youtube_handle: handle
        },
        success: function(jqXHR, textStatus, errorThrown) {
            $('#youtube').append(jqXHR);
        }
    }); // end ajax request*/


});
