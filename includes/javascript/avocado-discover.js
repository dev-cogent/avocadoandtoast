$(document).on('click','#calculate',function(){
    if(selectedusers.length == 0) return 0;
    calculate = true;
    $.ajax({
    type: 'POST',
    url: '/includes/ajax/avocado-get-influencers.php',
    data: {
        influencers: selectedusers
    },
    success: function (jqXHR, textStatus, errorThrown) {
        calculate = true;
        $('#stuff').empty();
        $('#stuff').append(jqXHR);
    }

}); // end ajax request*/ 

});


$(document).on('click','#apply',function(){

    dialog = bootbox.dialog({
        message: '<input type="text" id="get-instagram"> <input type="text" id="get-facebook"> <input type="text" id="get-twitter"> <button id="applyall">Submit</button>',
        closeButton: true
    });
    dialog.modal();

});
    
$(document).on('click','#applyall',function(){
var instval = $('#get-instagram').val();
var facebookval = $('#get-facebook').val();
var twitterval = $('#get-twitter').val();
var instposts = [];
var facebookposts = [];
var twitterposts = [];
$('.instagraminput').each(function(){
    $(this).val(instval);
   instposts.push(instval);
});
getCalculation('instagram',instposts,selectedusers);

$('.facebookinput').each(function(){
    $(this).val(facebookval);
   facebookposts.push(facebookval);
});
getCalculation('facebook',facebookposts,selectedusers);

$('.twitterinput').each(function(){
    $(this).val(twitterval);
   twitterposts.push(twitterval);
});

getCalculation('twitter',twitterposts,selectedusers);


});



$(document).on('click', '#search-keyword', function () {
    var temparr = [];
    $('.token-label').each(function () {
        temparr.push($(this).text());
    });
    if(temparr.length !== 0){
        filters['keywords'] = temparr;
        $('.dropdown').val('');
    }
    else{
        var keyword = $('.dropdown').val();
        filters['keywords'] = [keyword];
    }
    var user = $('#influencer-search-name').val();
    console.log(user.length);
    if(user.length > 0 ) filters['user'] = user;
    else  delete filters['user'];
    console.log(filters);
    applyFilters(filters);
});


$(document).on('click', '.invite', function () {
    var id = $(this).attr('data-id');
    var element = $(this);
    selectInfluencer(id, element);

});

$(document).on('click', '.show-hidden', function () {
    $('.hidden-influencers').css('display', 'unset');
    $('.show-hidden').attr('class', 'hide-influencers');
});

$(document).on('click', '.hide-influencers', function () {
    $('.hidden-influencers').css('display', 'none');
    $('.hide-influencers').attr('class', 'show-hidden');
});



function selectInfluencer(id, element) {
    var image = element.attr('data-image');
    if (!selectedusers.includes(id)) {
        selectedusers.push(id);
        if (selectedusers.length > 20) {
            $('#additional-influencers').css('visibility', 'visible');
            var num = $('#additional-influencers').attr('data-number');
            num++;
            $('#additional-influencers').text('+ ' + num + ' More');
            $('#additional-influencers').attr('data-number', num);
            $('#added-influencers').append('<img class="col-lg-4 col-xs-12 col-xl-3 hidden-influencers images-added" data-id="' + id + '"src="http://project.social/' + image + '" style="padding-bottom:1px; padding-right:1px; z-index:-1;">');
        }
        else {
            $('#added-influencers').append('<img class="col-lg-4 col-xs-12 col-xl-3 images-added" data-id="' + id + '" src="http://project.social/' + image + '" style="padding-bottom:1px; padding-right:1px; z-index:-1;">');
            $('#additional-influencers').css('visibility', 'hidden');
        }
        element.css('border', '1px solid #73C48D');
        element.css('color', 'white');
        element.css('background-color', '#73C48D');
        element.empty();
        element.append('<i class="thumb-up icon fa-check" aria-hidden="true"></i>INVITED');
        //element.text('INVITED');
        var count = parseInt($('#count').text());
        count++;
        $('#count').text(count);

        //After we put in array we will now highlight the border.
    }
    else {
        var temp = false;
        var index = selectedusers.indexOf(id);
        if (index > -1) {
            selectedusers.splice(index, 1);
        }
        if (selectedusers.length <= 20) {
            $('#additional-influencers').css('visibility', 'hidden');
        }
        var count = parseInt($('#count').text());
        count--;
        $('#count').text(count);
        element.css('border', '1px solid #515862');
        element.css('color', '#515862');
        element.css('background-color', 'white');
        element.empty();
        element.append('<i class="thumb-up icon fa-plus" aria-hidden="true"></i>INVITE');
        var classList = $('.images-added[data-id=' + id + ']').attr('class').split(/\s+/);
        $.each(classList, function (index, item) {
            if (item === 'hidden-influencers') {
                temp = true;
                var num = $('#additional-influencers').attr('data-number');
                num--;
                $('#additional-influencers').text('+ ' + num + ' More');
                $('#additional-influencers').attr('data-number', num);
            }


        });
        if (!temp && selectedusers.length >= 20) {

            console.log('here');
            var num = $('#additional-influencers').attr('data-number');
            num--;
            $('#additional-influencers').text('+ ' + num + ' More');
            $('#additional-influencers').attr('data-number', num);
            $('.hidden-influencers').each(function () {
                $(this).removeClass('hidden-influencers');
                return false;
            });

        }

        $('.images-added[data-id=' + id + ']').fadeOut("slow",function(){
            $(this).remove();
        });
    }

}








$('#slider-instagram').click(function () {
    filters['min'] = $('#min-instagram').attr('data-number');
    filters['max'] = $('#max-instagram').attr('data-number');
    filters['platform'] = 'instagram';
    applyFilters(filters);
});

$('#slider-twitter').click(function () {
    console.log('being applied');
    filters['min'] = $('#min-twitter').attr('data-number');
    filters['max'] = $('#max-twitter').attr('data-number');
    filters['platform'] = 'twitter';
    applyFilters(filters);
});


$('#slider-facebook').click(function () {
    filters['min'] = $('#min-facebook').attr('data-number');
    filters['max'] = $('#max-facebook').attr('data-number');
    filters['platform'] = 'facebook';
    applyFilters(filters);
});

$('#slider-instagram-engagement').click(function () {
    filters['min'] = $('#min-instagram-engagement').attr('data-number');
    filters['max'] = $('#max-instagram-engagement').attr('data-number');
    filters['platform'] = 'instagram';
    applyFilters(filters);
});

$('#slider-twitter-engagement').click(function () {
    filters['min'] = $('#min-twitter-engagement').attr('data-number');
    filters['max'] = $('#max-twitter-engagement').attr('data-number');
    filters['platform'] = 'twitter';
    applyFilters(filters);
});


$('#slider-facebook-engagement').click(function () {
    filters['min'] = $('#min-facebook-engagement').attr('data-number');
    filters['max'] = $('#max-facebook-engagement').attr('data-number');
    filters['platform'] = 'twitter';
    applyFilters(filters);
});

/*

$(document).on('click', '#location', function (e) {
    var location = $('#locationinput').val();
    filters['location'] = location;
    $('#locationfilter').remove();
    applyFilters(filters);
    $('#appliedfilters').append('<span id="locationfilter" data-id="location" class="applied m-r-10 label label-pill label-danger label-lg" style="padding:10px;">Location: ' + location + ' <i class="fa fa-remove" style="padding-left:5px; color:#fff;"></i></span>');
});

$(document).on('keyup', '#locationinput', function (e) {
    if (e.which == 13) {
        var location = $(this).val();
        filters['location'] = location;
        $('#locationfilter').remove();
        applyFilters(filters);
        $('#appliedfilters').append('<span id="locationfilter" data-id="location" class="applied m-r-10 label label-pill label-danger label-lg" style="padding:10px;">Location: ' + location + ' <i class="fa fa-remove" style="padding-left:5px; color:#fff;"></i></span>');
    }
});


*/

$(document).ready(function () {
    $.ajax({
        type: 'POST',
        url: '/includes/ajax/avocado-discover-pagination.php',
        data: {
            page: '0'
        },
        success: function (jqXHR, textStatus, errorThrown) {
            $('#content').append(jqXHR);
        }
    }); // end ajax request*/


    $(window).scroll(function () {
        if(calculate == false){
        if ($(window).scrollTop() == $(document).height() - $(window).height()) {
            page = page + 1;
            console.log(page);
            console.log(filters);
            $.ajax({
                type: 'POST',
                url: '/includes/ajax/avocado-discover-pagination.php',
                data: {
                    page: page,
                    filters: filters
                },
                success: function (jqXHR, textStatus, errorThrown) {
                    $('.found-influencers').append(jqXHR);

                }

            }); // end ajax request*/
        }
        }
    });

});



//function to have fixed positioning after scroll.
$(window).scroll(function () {

if(calculate == false){
    if (document.body.scrollTop > target) {
        $('#fixed-position').css('position','fixed');
        $('#fixed-position').css('margin-top', '-190px');
    }
    else {
        $('#fixed-position').css('position','relative');
        $('#fixed-position').css('margin-top', '0px');
    }
}
});

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



function applyFilters(filters) {
    page = 0;
    $.ajax({
        type: 'POST',
        url: '/includes/ajax/avocado-discover-pagination.php',
        data: {
            filters: filters,
            page: page
        },
        success: function (jqXHR, textStatus, errorThrown) {
            $('.found-influencers').empty();
            $('.found-influencers').append(jqXHR);
        }
    });
}



$(document).on('click', '.switch', function () {
    var platform = $(this).attr('data-platform');
    var id = $(this).attr('data-id');
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

    $(this).css('color', '#73C48D');
    //setting all the other colors to grey
    $('.show-' + platform1 + '[data-id=' + id + ']').css('color', '#76838f');
    $('.show-' + platform2 + '[data-id=' + id + ']').css('color', '#76838f');
    //Showing the proper handles
    $('.' + platform + '-handle[data-id=' + id + ']').show();
    $('.' + platform1 + '-handle[data-id=' + id + ']').css('display', 'none');
    $('.' + platform2 + '-handle[data-id=' + id + ']').css('display', 'none');
    //Now showing the proper followers
    $('.' + platform + '-follower-count[data-id=' + id + ']').show();
    $('.' + platform1 + '-follower-count[data-id=' + id + ']').css('display', 'none');
    $('.' + platform2 + '-follower-count[data-id=' + id + ']').css('display', 'none');
    //Now showing the proper engagement
    $('.' + platform + '-engagement[data-id=' + id + ']').show();
    $('.' + platform1 + '-engagement[data-id=' + id + ']').css('display', 'none');
    $('.' + platform2 + '-engagement[data-id=' + id + ']').css('display', 'none');

});


$(document).on('click','.filter-option',function(){
    var platform  = $(this).attr('data-platform');
    $(this).css('background-color', '#73C48D');
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
    $('.filter-option[data-platform=' + platform1 + ']').css('background-color', '#A2A8B1');
    $('.filter-option[data-platform=' + platform2 + ']').css('background-color', '#A2A8B1');

    $('.sliders[data-platform='+platform+']').show();
    $('.sliders[data-platform='+platform+'-engagement]').show();
    $('.sliders[data-platform='+platform1+']').css('display','none');
    $('.sliders[data-platform='+platform1+'-engagement]').css('display','none');
    $('.sliders[data-platform='+platform2+']').css('display','none');
    $('.sliders[data-platform='+platform2+'-engagement]').css('display','none');

});







$(document).on('change', '.campaignfocus', function () {

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




