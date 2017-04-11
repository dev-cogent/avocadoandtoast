$(document).on('click','#calculate',function(){
    var appendstatus = 0;
    setLoading();
    if(selectedusers.length == 0) return 0;
    calculate = true;
    $.ajax({
    type: 'POST',
    url: '/php/ajax/avocado-get-influencers.php',
    data: {
        influencers: selectedusers
    },
    success: function (jqXHR, textStatus, errorThrown) {
        calculate = true;
        $('#stuff').empty();
        $('#stuff').append(jqXHR);
        unsetLoading();
        $('.sidebar-left').css('position','absolute');
        $('.sidebar-left').css('margin-top','0px');
    }

}); // end ajax request*/

});


$(document).on('click','#apply',function(){

    dialog = bootbox.dialog({
        message: '<div class="bootbox-body">'+
   '<div class="icon-popup-div"> <img src="assets/images/breakdance_3.gif" class="avocado-popup-icon"/> </div>'+
    '<div class="row"> <div class="col-xs-12 popup-detail">  How many posts would you like your influencer to post on each platform?  </div>'+
    '<div class="col-xs-1" style="width: 12.499999995%"></div><div class="col-xs-3 input-div">'+
      '<img src="assets/images/instagram-logo-green.png" class="insta-logo-popup">'+
    '<div class="quantity"><input type="number" id="get-instagram" value="0" class="input-popup avocado-focus"></div> </div>'+
    '<div class="col-xs-3 input-div"> <img src="assets/images/fb-logo-green.png" class="fb-logo-popup"> <input type="number" id="get-facebook" value="0" class="input-popup avocado-focus"> </div>'+
    '<div class="col-xs-3 input-div">'+
  '<img src="assets/images/twitter-logo-green.png" class="twitter-icon-popup">'+
    '<input type="number" id="get-twitter" value="0"  class="input-popup"> '+
    '</div><div class="col-xs-1" style="width: 12.499999995%"></div></div>'+
      '<div class="submit-btn-div"> <button id="applyall" class="submit-btn">Submit</button>'+
    '</div> </div>',
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
                console.log(jqXHR);
                for(var i = 0; i < selectedusers.length; i++){
                    var id = selectedusers[i];
                    console.log(id);
                    var engagementUser = abbrNum(arr.influencer[id].engagement);
                    var impressionUser = abbrNum(arr.influencer[id].impressions);
                    $('.engagement-orange-instagram[data-id='+id+']').text(engagementUser);
                    $('.engagement-orange-instagram[data-id='+id+']').attr('data-number',arr.influencer[id].engagement);
                    $('.impression-instagram-blue[data-id='+id+']').text(impressionUser);
                    $('.impression-instagram-blue[data-id='+id+']').attr('data-number',arr.influencer[id].impressions);

                }
                $('#instagram-engagement').text(abbrNum(arr.engagement));
                $('#instagram-engagement').attr('data-number',arr.engagement);
                $('#instagram-impressions').text(abbrNum(arr.total));
                $('#instagram-impressions').attr('data-number',arr.engagement);
            }
            if (type == 'twitter') {
                $('.twitter-posts').empty();
                var arr = JSON.parse(jqXHR);
                console.log(jqXHR);
                for(var i = 0; i < selectedusers.length; i++){
                    var id = selectedusers[i];
                    console.log(arr);
                    var engagementUser = abbrNum(arr.influencer[id].engagement);
                    var impressionUser = abbrNum(arr.influencer[id].impressions);
                    $('.engagement-orange-twitter[data-id='+id+']').text(engagementUser);
                    $('.engagement-orange-twitter[data-id='+id+']').attr('data-number',arr.influencer[id].engagement);
                    $('.impression-twitter-blue[data-id='+id+']').text(impressionUser);
                    $('.impression-twitter-blue[data-id='+id+']').attr('data-number',arr.influencer[id].impressions);

                }
                $('#twitter-engagement').text(abbrNum(arr.engagement));
                $('#twitter-engagement').attr('data-number',arr.engagement);
                $('#twitter-impressions').text(abbrNum(arr.total));
                $('#twitter-impressions').attr('data-number',arr.engagement);
            }


            if (type == 'facebook') {
                $('.facebook-posts').empty();
                var arr = JSON.parse(jqXHR);
                console.log(arr);
                for(var i = 0; i < selectedusers.length; i++){
                    var id = selectedusers[i];
                    var engagementUser = abbrNum(arr.influencer[id].engagement);
                    var impressionUser = abbrNum(arr.influencer[id].impressions);
                    $('.engagement-orange-facebook[data-id='+id+']').text(engagementUser);
                    $('.engagement-orange-facebook[data-id='+id+']').attr('data-number',arr.influencer[id].engagement);
                    $('.impression-facebook-blue[data-id='+id+']').text(impressionUser);
                    $('.impression-facebook-blue[data-id='+id+']').attr('data-number',arr.influencer[id].impressions);

                }
                $('#facebook-engagement').text(abbrNum(arr.engagement));
                $('#facebook-engagement').attr('data-number',arr.engagement);
                $('#facebook-impressions').text(abbrNum(arr.total));
                $('#facebook-impressions').attr('data-number',arr.engagement);
            }


            getTotal(selectedusers);

        }

    }); // end ajax request*/


}


function getTotal(selectedusers){
    var campaignEngagementTotal = 0;
    var campaignImpressionsTotal = 0;
    for (var i = 0; i < selectedusers.length; i++){
        var id = selectedusers[i];
        var totalpost = parseInt($('.instagraminput[data-id='+id+']').val()) + parseInt($('.facebookinput[data-id='+id+']').val()) + parseInt($('.twitterinput[data-id='+id+']').val());
        var totalImpressions = parseInt($('.impression-instagram-blue[data-id='+id+']').attr('data-number')) + parseInt($('.impression-facebook-blue[data-id='+id+']').attr('data-number')) + parseInt($('.impression-twitter-blue[data-id='+id+']').attr('data-number'));
        var totalEngagement = parseInt($('.engagement-orange-instagram[data-id='+id+']').attr('data-number')) + parseInt($('.engagement-orange-facebook[data-id='+id+']').attr('data-number')) + parseInt($('.engagement-orange-twitter[data-id='+id+']').attr('data-number'));
        campaignEngagementTotal += totalEngagement;
        campaignImpressionsTotal += totalImpressions;
        $('.totalinput[data-id='+id+']').val(totalpost);
        $('.impression-total-blue[data-id='+id+']').text(abbrNum(totalImpressions));
        $('.impression-total-blue[data-id='+id+']').attr('data-number',totalImpressions);
        $('.engagement-orange-total[data-id='+id+']').text(abbrNum(totalEngagement));
        $('.engagement-orange-total[data-id='+id+']').attr('data-number',totalEngagement);
    }
    $('#total-engagement').text(abbrNum(campaignEngagementTotal));
    $('#total-impressions').text(abbrNum(campaignImpressionsTotal))



}


function abbrNum(number, decPlaces = 2) {
    var orig = number;
    var dec = decPlaces;
    // 2 decimal places => 100, 3 => 1000, etc
    decPlaces = Math.pow(10, decPlaces);

    // Enumerate number abbreviations
    var abbrev = ["k", "m", "b", "t"];

    // Go through the array backwards, so we do the largest first
    for (var i = abbrev.length - 1; i >= 0; i--) {

        // Convert array index to "1000", "1000000", etc
        var size = Math.pow(10, (i + 1) * 3);

        // If the number is bigger or equal do the abbreviation
        if (size <= number) {
            // Here, we multiply by decPlaces, round, and then divide by decPlaces.
            // This gives us nice rounding to a particular decimal place.
            var number = Math.round(number * decPlaces / size) / decPlaces;

            // instHandle special case where we round up to the next abbreviation
            if((number == 1000) && (i < abbrev.length - 1)) {
                number = 1;
                i++;
            }

            // console.log(number);
            // Add the letter for the abbreviation
            number += abbrev[i];

            // We are done... stop
            break;
        }
    }

    return number;
}


$(document).on('click', '#savecampaign', function () {
    //setLoading();
    var campaignid = urlParams.get('id');
    var arr = {};
    for (i = 0; i < selectedusers.length; i++) {
        var id = selectedusers[i];
        arr[id] = {};
        arr[id]['instagramposts'] = $('.instagraminput[data-id=' + id + ']').val();
        arr[id]['facebookposts'] = $('.facebookinput[data-id=' + id + ']').val();
        arr[id]['twitterposts'] = $('.twitterinput[data-id=' + id + ']').val();
    }


    $.ajax({
        type: 'POST',
        url: '../php/ajax/updatecalculation.php',
        data: {
            campaignid: campaignid,
            info: JSON.stringify(arr)
        },
        success: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
            //unsetLoading();
            if (jqXHR != 0 || jqXHR != '0') {
                dialog = bootbox.dialog({
                    message: '<div class="bootbox-body">' +
                    '<div class="icon-popup-div"> <img src="assets/images/chasing_2.gif" class="success-popup-icon"/> </div>' +
                    '<div class="row"> <div class="col-xs-12 popup-detail success">   <span class="yay"> YAY! </span> <br/> Campaign created sucessfully  </div>' +
                    '<div class="col-xs-12 btn-col"><div class="popup-btn-div"> <a href="/campaigns/?id=' + jqXHR + '"><button id="applyall" class="submit-btn">VIEW CAMPAIGN </button></a></div> <div class="col-xs-12"><div class="submit-btn-div"><a href="/edit/?id=' + jqXHR + '"> <button id="applyall" class="submit-btn"> ADD  DETAILS </button></a></div>' +
                    '</div> </div>',
                    closeButton: true
                });
                dialog.modal();
            }
        }
    }); // end ajax request*/


});