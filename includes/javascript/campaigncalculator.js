$(document).on('click', '#next', function () {
    if (selectedusers.length <= 0) {
        //some alert here. 
        return 0;
    }
    previouscontent = $('#content').html();
    previousbar = $('#influencerrow').html();
    previouspage = page;
    $.ajax({
        type: 'POST',
        url: '/includes/ajax/campaigncalculatorp2.php',
        data: {
            influencers: selectedusers
        },
        success: function (jqXHR, textStatus, errorThrown) {

            search = null;
            page = '';
            $('#content').empty();
            $('#influencerrow').empty();
            $('#influencerrow').css('background-color', 'white');
            $('#content').append(jqXHR);
            //grey out
            $('.breadcrumb-1').css('background-color', 'rgb(206,208,215)');
            $('.first-breadcrumb').css('color', 'rgb(206,208,215)');
            //activate
            $('.breadcrumb-2').css('background-color', 'rgb(29, 40, 76)');
            $('.second-breadcrumb').css('color', 'rgb(29, 40, 76)');
            $('#next').text('BACK');
            $('#next').attr('id', 'back');
        }

    }); // end ajax request*/




});



$(document).on('click', '#back', function () {
    search = '';
    page = previouspage;
    $('#back').text('NEXT');
    $('#back').attr('id', 'next');
    $('#content').empty();
    $('#content').append(previouscontent);
    $('#influencerrow').append(previousbar);
    $('.breadcrumb-1').css('background-color', 'rgb(29, 40, 76)');
    $('.first-breadcrumb').css('color', 'rgb(29, 40, 76)');
    //grey out
    $('.breadcrumb-2').css('background-color', 'rgb(206,208,215)');
    $('.second-breadcrumb').css('color', 'rgb(206,208,215)');
    /*$.ajax({
        type: 'POST',
        url: '/includes/ajax/campaigncalculatorp1.php',
        data: {
            influencers: selectedusers
        },
        success: function (jqXHR, textStatus, errorThrown) {
            search = null;
            page = '';
            $('#content').empty();
            $('#influencerrow').remove();
            $('#content').append(jqXHR);
            //grey out
            $('.breadcrumb-1').css('background-color','rgb(206,208,215)');
            $('.first-breadcrumb').css('color','rgb(206,208,215)');
            //activate
            $('.breadcrumb-2').css('background-color','rgb(29, 40, 76)');
            $('.second-breadcrumb').css('color','rgb(29, 40, 76)');
            $('#next').text('BACK');
            $('#next').attr('id','back');
        }

    }); // end ajax request*/




});



$(document).on('keyup', '.campaignfocus', function () {
    var posts = [];
    var type = $(this).attr('data-platform');
    var id = $(this).attr('data-id');
    console.log(selectedusers);

    if (type == 'instagram') {
        $('.instagraminput').each(function () {
            posts.push($(this).val());
        });
        getCalculation(type, posts, selectedusers);
    }

    if (type == 'twitter') {
        $('.twitterinput').each(function () {
            posts.push($(this).val());
        });
        getCalculation(type, posts, selectedusers);
    }

    if (type == 'facebook') {
        $('.facebookinput').each(function () {
            posts.push($(this).val());
        });
        getCalculation(type, posts, selectedusers);
    }




});

function getCalculation(type, posts, selectedusers) {
    console.log('heelo');
    $.ajax({
        type: 'POST',
        url: '/includes/ajax/calculate.php',
        data: {
            type: type,
            posts: posts,
            selected: selectedusers
        },
        success: function (jqXHR, textStatus, errorThrown) {
            if (type == 'instagram') {
                $('.instagram-posts').empty();
                $('.instagram-posts').append(jqXHR);
            }
            if (type == 'twitter') {
                $('.twitter-posts').empty();
                $('.twitter-posts').append(jqXHR);
            }
            if (type == 'facebook') {
                $('.facebook-posts').empty();
                $('.facebook-posts').append(jqXHR);
            }


        }

    }); // end ajax request*/


}



$(document).on('click', '#savepop', function () {
    dialog = bootbox.dialog({
        message: '<input type="text" id="campaignname"><br/><input type="text" id="campaigndescription"><button id="savecampaign">Submit</button>',
        closeButton: true
    });
    dialog.modal();

});
$(document).on('click', '#savecampaign', function () {
    var campaignName = $('#campaignname').val();
    var campaignDescription = $('#campaigndescription').val();
    console.log(campaignName);
    console.log(campaignDescription);
    var instagramtotal = $('instagram-posts').html();
    var facebooktotal = $('.facebook-posts').html();
    var twittertotal = $('.twitter-posts').html();
    var arr = {};
    var instagramposts = [];
    var facebookposts = [];
    var twitterposts = [];
    for (var i = 0; i < selectedusers.length; i++) {
        var temp = $('.instagraminput[data-id="' + selectedusers[i] + '"]').val();
        instagramposts.push(temp);

    }

    for (var i = 0; i < selectedusers.length; i++) {
        var temp = $('.facebookinput[data-id="' + selectedusers[i] + '"]').val();
        facebookposts.push(temp);

    }

    for (var i = 0; i < selectedusers.length; i++) {
        var temp = $('.twitterinput[data-id="' + selectedusers[i] + '"]').val();
        twitterposts.push(temp);

    }





    $.ajax({
        type: 'POST',
        url: '/includes/ajax/savecampaign.php',
        data: {
            campaignname : campaignName,
            campaigndescription: campaignDescription,
            instagramtotal: instagramtotal,
            facebooktotal: facebooktotal,
            twittertotal: twittertotal,
            instagramposts: instagramposts,
            facebookposts: facebookposts,
            twitterposts: twitterposts,
            selectedusers: selectedusers
        },
        success: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);


        }

    }); // end ajax request*/

});
