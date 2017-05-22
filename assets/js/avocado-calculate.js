var campaignResults = {};

$(document).on('click','#price-campaign',function(){

    selectedusers.forEach(function(element) {
        //instagram
        var platformStats =  {
            instagramPost:  $('.instagraminput[data-id="'+element+'"]').val(),
            instagramImpressions: $('.impression-instagram-blue[data-id="'+element+'"]').attr('data-number'),
            instagramEngagement: $('.impression-instagram-blue[data-id="'+element+'"]').attr('data-number'),
            facebookPost:$('.facebookinput[data-id="'+element+'"]').val(),
            facebookImpression: $('.impression-facebook-blue[data-id="'+element+'"]').attr('data-number'),
            facebookEngagement:$('.engagement-orange-facebook[data-id="'+element+'"]').attr('data-number'),
            twitterPost: $('.twitterinput[data-id="'+element+'"]').val(),
            twitterImpression: $('.impression-twitter-blue[data-id="'+element+'"]').attr('data-number'),
            twitterEngagement: $('.engagement-orange-twitter[data-id="'+element+'"]').attr('data-number')
        };
        campaignResults[element]  = platformStats;
    });
    console.log(campaignResults);
    campaignResults = JSON.stringify(campaignResults);
    console.log(campaignResults);
    localStorage.setItem('price-campaign-influencer-stats',campaignResults);
    //window.location='/price/';


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


$(document).on('click', '#apply', function () {

    dialog = bootbox.dialog({
        message: '<div class="bootbox-body">' +
        '<div class="icon-popup-div"> <img src="/assets/images/breakdance_3.gif" class="avocado-popup-icon"/> </div>' +
        '<div class="row popup"> <div class="col-xs-12 popup-detail">  How many posts would you like your influencer to post on each platform?  </div>' +
        '<div class="col-xs-1" style="width: 12.499999995%"></div><div class="col-xs-3 input-div">' +
        '<img src="/assets/images/instagram-logo-green.png" class="insta-logo-popup">' +
        '<div class="quantity"><input type="number" id="get-instagram" value="0" class="input-popup avocado-focus"></div> </div>' +
        '<div class="col-xs-3 input-div"> <img src="/assets/images/fb-logo-green.png" class="fb-logo-popup"> <input type="number" id="get-facebook" value="0" class="input-popup avocado-focus"> </div>' +
        '<div class="col-xs-3 input-div">' +
        '<img src="/assets/images/twitter-logo-green.png" class="twitter-icon-popup">' +
        '<input type="number" id="get-twitter" value="0"  class="input-popup"> ' +
        '</div><div class="col-xs-1" style="width: 12.499999995%"></div></div>' +
        '<div class="submit-btn-div"> <button id="applyall" class="primary-button submit-button">Submit</button>' +
        '</div> </div>',
        closeButton: true
    });
    dialog.modal();

});

$(document).on('click', '#applyall', function () {
    var instval = $('#get-instagram').val();
    var facebookval = $('#get-facebook').val();
    var twitterval = $('#get-twitter').val();
    var instposts = [];
    var facebookposts = [];
    var twitterposts = [];
    $('.instagraminput').each(function () {
        $(this).val(instval);
        instposts.push(instval);
    });
    getCalculation('instagram', instposts, selectedusers);

    $('.facebookinput').each(function () {
        $(this).val(facebookval);
        facebookposts.push(facebookval);
    });
    getCalculation('facebook', facebookposts, selectedusers);

    $('.twitterinput').each(function () {
        $(this).val(twitterval);
        twitterposts.push(twitterval);
    });

    getCalculation('twitter', twitterposts, selectedusers);


});


function getCalculation(type, posts, selectedusers) {
    console.log(selectedusers);
    console.log(posts);
    $.ajax({
        type: 'POST',
        url: '/php/ajax/calculate.php',
        data: {
            type: type,
            posts: posts,
            selected: selectedusers
        },
        success: function (jqXHR, textStatus, errorThrown) {
            if (type == 'instagram') {
                $('.instagram-posts').empty();
                var arr = JSON.parse(jqXHR);
                for (var i = 0; i < selectedusers.length; i++) {
                    var id = selectedusers[i];
                    var engagementUser = abbrNum(arr.influencer[id].engagement);
                    var impressionUser = abbrNum(arr.influencer[id].impressions);
                    $('.engagement-orange-instagram[data-id=' + id + ']').text(engagementUser);
                    $('.engagement-orange-instagram[data-id=' + id + ']').attr('data-number', arr.influencer[id].engagement);
                    $('.impression-instagram-blue[data-id=' + id + ']').text(impressionUser);
                    $('.impression-instagram-blue[data-id=' + id + ']').attr('data-number', arr.influencer[id].impressions);

                }
                $('#instagram-engagement').text(abbrNum(arr.engagement));
                $('#instagram-engagement').attr('data-number', arr.engagement);
                $('#instagram-impressions').text(abbrNum(arr.total));
                $('#instagram-impressions').attr('data-number', arr.engagement);
            }
            if (type == 'twitter') {
                $('.twitter-posts').empty();
                var arr = JSON.parse(jqXHR);
                for (var i = 0; i < selectedusers.length; i++) {
                    var id = selectedusers[i];
                    console.log(arr);
                    var engagementUser = abbrNum(arr.influencer[id].engagement);
                    var impressionUser = abbrNum(arr.influencer[id].impressions);
                    $('.engagement-orange-twitter[data-id=' + id + ']').text(engagementUser);
                    $('.engagement-orange-twitter[data-id=' + id + ']').attr('data-number', arr.influencer[id].engagement);
                    $('.impression-twitter-blue[data-id=' + id + ']').text(impressionUser);
                    $('.impression-twitter-blue[data-id=' + id + ']').attr('data-number', arr.influencer[id].impressions);

                }
                $('#twitter-engagement').text(abbrNum(arr.engagement));
                $('#twitter-engagement').attr('data-number', arr.engagement);
                $('#twitter-impressions').text(abbrNum(arr.total));
                $('#twitter-impressions').attr('data-number', arr.engagement);
            }


            if (type == 'facebook') {
                $('.facebook-posts').empty();
                var arr = JSON.parse(jqXHR);
                console.log(arr);
                for (var i = 0; i < selectedusers.length; i++) {
                    var id = selectedusers[i];
                    var engagementUser = abbrNum(arr.influencer[id].engagement);
                    var impressionUser = abbrNum(arr.influencer[id].impressions);
                    $('.engagement-orange-facebook[data-id=' + id + ']').text(engagementUser);
                    $('.engagement-orange-facebook[data-id=' + id + ']').attr('data-number', arr.influencer[id].engagement);
                    $('.impression-facebook-blue[data-id=' + id + ']').text(impressionUser);
                    $('.impression-facebook-blue[data-id=' + id + ']').attr('data-number', arr.influencer[id].impressions);

                }
                $('#facebook-engagement').text(abbrNum(arr.engagement));
                $('#facebook-engagement').attr('data-number', arr.engagement);
                $('#facebook-impressions').text(abbrNum(arr.total));
                $('#facebook-impressions').attr('data-number', arr.engagement);
            }


            getTotal(selectedusers);

        }

    }); // end ajax request*/


}


function getTotal(selectedusers) {
    var campaignEngagementTotal = 0;
    var campaignImpressionsTotal = 0;
    for (var i = 0; i < selectedusers.length; i++) {
        var id = selectedusers[i];
        var totalpost = parseInt($('.instagraminput[data-id=' + id + ']').val()) + parseInt($('.facebookinput[data-id=' + id + ']').val()) + parseInt($('.twitterinput[data-id=' + id + ']').val());
        var totalImpressions = parseInt($('.impression-instagram-blue[data-id=' + id + ']').attr('data-number')) + parseInt($('.impression-facebook-blue[data-id=' + id + ']').attr('data-number')) + parseInt($('.impression-twitter-blue[data-id=' + id + ']').attr('data-number'));
        var totalEngagement = parseInt($('.engagement-orange-instagram[data-id=' + id + ']').attr('data-number')) + parseInt($('.engagement-orange-facebook[data-id=' + id + ']').attr('data-number')) + parseInt($('.engagement-orange-twitter[data-id=' + id + ']').attr('data-number'));
        campaignEngagementTotal += totalEngagement;
        campaignImpressionsTotal += totalImpressions;
        $('.totalinput[data-id=' + id + ']').val(totalpost);
        $('.impression-total-blue[data-id=' + id + ']').text(abbrNum(totalImpressions));
        $('.impression-total-blue[data-id=' + id + ']').attr('data-number', totalImpressions);
        $('.engagement-orange-total[data-id=' + id + ']').text(abbrNum(totalEngagement));
        $('.engagement-orange-total[data-id=' + id + ']').attr('data-number', totalEngagement);
    }
    $('#total-engagement').text(abbrNum(campaignEngagementTotal));
    $('#total-impressions').text(abbrNum(campaignImpressionsTotal))



}
