$(document).on('click','.social-button',function(){
    var platform = $(this).attr('data-platform');
    var handle = $(this).attr('data-handle');
    console.log(handle);
    if (platform == 'facebook') {
        platform1 = 'instagram';
        platform2 = 'twitter';
    }
    if (platform == 'twitter') {
        platform1 = 'instagram';
        platform2 = 'facebook';
    }
    if (platform == 'instagram') {
        platform1 = 'twitter';
        platform2 = 'facebook';
    }

    $(this).css('background-color', '#73C48D');
    //setting all the other colors to grey
    $('.social-button[data-platform=' + platform1 + ']').css('background-color', '#A2A8B1');
    $('.social-button[data-platform=' + platform2 + ']').css('background-color', '#A2A8B1');
    //$('.social-content').empty();   
    console.log(platform);
    console.log(platform1);
    console.log(platform2);
    $('#'+platform).removeAttr('style');
    $('#'+platform1).css('display','none');
    $('#'+platform2).css('display','none');
});


$(document).ready(function(){
        var handle = $('.social-button[data-platform=instagram]').attr('data-handle');
        $.ajax({
        type: 'POST',
        url: '/includes/ajax/latestimage.php',
        data: {
            inst_user:handle
        },
        success: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
            $('#instagram').append(jqXHR);
        }
        }); // end ajax request*/
        
        var handle = $('.social-button[data-platform=twitter]').attr('data-handle');
        $.ajax({
        type: 'POST',
        url: '/includes/ajax/latesttweets.php',
        data: {
            twitter_handle:handle
        },
        success: function (jqXHR, textStatus, errorThrown) {
            $('#twitter').append(jqXHR);
        }
        }); // end ajax request*/


});

