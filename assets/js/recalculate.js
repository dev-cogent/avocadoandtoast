$(document).ready(function(){
    $.ajax({
    type: 'POST',
    url: '../php/ajax/getCampaignInfo.php',
    data: {
        campaignid: campaignid,
    },
    success: function (jqXHR, textStatus, errorThrown) {
       campaignInfoJSON = JSON.parse(jqXHR);
       $('.campaign-label').append(campaignInfoJSON.campaignname);
    }
  });


    var totalIgImpressions = 0 ;
    var totalFbImpressions = 0;
    var totalTwImpressions = 0;
    var totalOverallImpressions = 0;

    var totalIgEngagement = 0;
    var totalFbEngagement = 0;
    var totalTwEngagement = 0;
    var totalOverallEngagement = 0;
        $.ajax({
        type: 'POST',
        url: '../php/ajax/avocado-recalculate.php',
        data: {
            campaignid: campaignid,
        },
        success: function (jqXHR, textStatus, errorThrown) {
            var campaignJSON = JSON.parse(jqXHR);

            $.each(campaignJSON, function (key, obj) {
            selectedusers.push(key);
            var igPost = parseInt(obj.instagram.post);
            var fbPost = parseInt(obj.facebook.post);
            var twPost = parseInt(obj.twitter.post);
            var totalPost = igPost + fbPost + twPost;

            var igImpressions = parseInt(obj.instagram.impressions);
                totalIgImpressions += igImpressions;
            var fbImpressions = parseInt(obj.facebook.impressions);
                totalFbImpressions += fbImpressions;
            var twImpressions = parseInt(obj.twitter.impressions);
                totalTwImpressions += twImpressions;

            var totalImpressions = igImpressions + fbImpressions + twImpressions;
                totalOverallImpressions += parseInt(totalImpressions);


            var igEngagement = parseInt(obj.instagram.engagement);
                totalIgEngagement += igEngagement;
            var fbEngagement = parseInt(obj.facebook.engagement);
                totalFbEngagement += fbEngagement;
            var twEngagement = parseInt(obj.twitter.engagement);
                totalTwEngagement += twEngagement;

            var totalEngagement = igEngagement + fbEngagement + twEngagement;
                totalOverallEngagement += totalEngagement;

            var igFollowers = parseInt(obj.instagram.followers);
            var fbFollowers = parseInt(obj.facebook.likes);
            var twFollowers = parseInt(obj.twitter.followers);
            var totalFollowers = igFollowers + fbFollowers + twFollowers;


            $('#all-influencers').append('<tr class="influencer-result-row">'+
                            '<td class="influencer-column" data-label="Name" style="width:15%; padding-left:0%;">'+
                              '<div class="influencer-info-container mobile">'+
                              '<img src="http://cogenttools.com/'+obj.image+'" onerror="this.src=`/assets/images/default-photo.png`" class="influencer-campaign-image ">'+
                              '<div class="influencer-handle-text handle">@'+obj.instagram.handle+'</div>'+
                              '<div class="influencer-handle-text location-text"></div>'+
                        '</div></td>'+
                      '<td data-id="'+key+'" class="insta-column" style="width:15%;">'+
                          '<div class="posts-res-div">'+
                            '<input data-id="'+key+'" data-platform="instagram" class="instagraminput campaignfocus" type="number"  value="'+obj.instagram.post+'"max="100" min="0">'+
                            '<div class="post-results">posts</div>'+
                          '</div>'+
                          '<div class="results-mini-col">'+
                            '<div class="impression-res impression-blue impression-instagram-blue" data-id="'+key+'" data-number="'+obj.instagram.impressions+'">'+abbrNum(obj.instagram.impressions)+'</div>'+
                            '<div class="engagement-res engagement-orange engagement-orange-instagram" data-id="'+key+'" data-number="'+obj.instagram.engagement+'" >'+abbrNum(obj.instagram.engagement)+'</div>'+
                            '<div class="social-following-res social-following-red">'+abbrNum(obj.instagram.followers)+'</div> </div></td>'+
                       '<td data-id="'+key+'" class="twit-column" style="width:15%;">'+
                        '<input data-id="'+key+'" data-platform="facebook" class="facebookinput campaignfocus" type="number" value="'+obj.facebook.post+'" max="100" min="0">'+
                        '<div class="post-results"> posts</div>'+
                        '<div class="results-mini-col">'+
                          '<div class="impression-res impression-blue impression-facebook-blue" data-id="'+key+'" data-number="'+obj.facebook.impressions+'">'+abbrNum(obj.facebook.impressions)+'</div>'+
                          '<div class="engagement-res engagement-orange engagement-orange-facebook"  data-id="'+key+'" data-number="'+obj.facebook.engagement+'" >'+abbrNum(obj.facebook.engagement)+'</div>'+
                          '<div class="social-following-res social-following-red">'+abbrNum(obj.facebook.likes)+'</div></div></td>'+
                      '<td data-id="'+key+'" class="face-column" style="width:15%;">'+
                        '<input data-id="'+key+'" data-platform="twitter" class="twitterinput campaignfocus" type="number" value="'+obj.twitter.post+'" max="100" min="0">'+
                        '<div class="post-results"> posts</div>'+
                        '<div class="results-mini-col">'+
                          '<div class="impression-res impression-blue impression-twitter-blue" data-id="'+key+'" data-number="'+obj.twitter.impressions+'">'+abbrNum(obj.twitter.impressions)+'</div>'+
                          '<div class="engagement-res engagement-orange engagement-orange-twitter" data-id="'+key+'" data-number="'+obj.twitter.engagement+'">'+abbrNum(obj.twitter.engagement)+'</div>'+
                          '<div class="social-following-res social-following-red">'+abbrNum(obj.twitter.followers)+'</div></div></td>'+
                     '<td data-id="'+key+'" class="overall-inf-total-column" style="width:15%;">'+
                          '<input data-id="'+key+'" data-platform="total" class="totalinput campaignfocus" type="number" value="'+ totalPost +'" max="100" disabled>'+
                          '<div class="post-results"> posts</div>'+
                          '<div class="results-mini-col">'+
                            '<div class="impression-res impression-blue impression-total-blue" data-id="'+key+'" data-number="'+( totalImpressions )+'" >'+abbrNum(totalImpressions)+'</div>'+
                            '<div class="engagement-res engagement-orange engagement-orange-total"  data-id="'+key+'" data-number="'+(totalEngagement)+'" >'+abbrNum(totalEngagement)+'</div>'+
                            '<div class="social-following-res social-following-red">'+ abbrNum(totalFollowers)+' </div></div></td></tr>');


            });
        $('#all-influencers').append('<tr class="result-row influencer-result-row">'+
                        '<td class="influencer-column" scope="row" data-label="Name" style="width:15%;">'+
                            '<div class="influencer-info-container">'+
                                '<p class="result-name mobile">  CAMPAIGN ENGAGEMENT</p>'+
                            '</div>'+
                      '<td  class="insta-column"  data-label="Instagram" style="width:15%;" > <p class="instagram-posts results-text mobile" id="instagram-engagement" data-number="'+totalIgEngagement+'">'+abbrNum(totalIgEngagement)+'</p> </td>'+
                      '<td  class="twit-column" data-label="Twitter" style="width:15%;"> <p class="facebook-posts results-text mobile" id="facebook-engagement" data-number="'+totalFbEngagement+'">'+abbrNum(totalFbEngagement)+'</p> </td>'+
                      '<td  class="face-column" data-label="Facebook" style="width:15%;"> <p class="twitter-posts results-text mobile" id="twitter-engagement" data-number="'+totalTwEngagement+'">'+abbrNum(totalTwEngagement)+' </p></td>'+
                      '<td  class="face-column" data-label="Total" style="width:15%;"> <p class="total-posts results-text mobile" id="total-engagement" data-number="'+totalOverallEngagement+'" > '+abbrNum(totalOverallEngagement)+'</p>  </td>'+
                    '</tr>'+
                    '<tr class="result-row influencer-result-row">'+
                        '<td class="influencer-column" style="width:15%;" scope="row" data-label="Name">'+
                            '<div class="influencer-info-container">'+
                            '<p class="result-name mobile"> CAMPAIGN IMPRESSIONS</p>'+
                            '</div>'+
                      '<td  class="insta-column" data-label="Instagram" style="width:15%;"><p class="instagram-posts results-text mobile" id="instagram-impressions" data-number="'+totalIgImpressions+'">'+abbrNum(totalIgImpressions)+'</p> </td>'+
                      '<td  class="twit-column" data-label="Twitter" style="width:15%;"> <p class="facebook-posts results-text mobile" id="facebook-impressions" data-number="'+totalFbImpressions+'">'+abbrNum(totalFbImpressions)+'</p> </td>'+
                      '<td  class="face-column" data-label="Facebook"  style="width:15%;"> <p class="twitter-posts results-text mobile" id="twitter-impressions" data-number="'+totalTwImpressions+'">'+abbrNum(totalTwImpressions)+' </p></td>'+
                      '<td  class="total-column" data-label="Total"  style="width:15%;"> <p class="total-posts results-text mobile" id="total-impressions" data-number="'+totalOverallImpressions+'" >'+abbrNum(totalOverallImpressions)+'</p></td>'+
                    '</tr>')
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




$(document).on('change', '.campaignfocus', function () {

    var posts = [];
    var type = $(this).attr('data-platform');
    var id = $(this).attr('data-id');
    console.log(selectedusers);

    if (type == 'instagram') {
        $('.instagraminput').each(function () {
            posts.push(parseInt($(this).val()));
        });
        getCalculation(type, posts, selectedusers);
    }

    if (type == 'twitter') {
        $('.twitterinput').each(function () {
            posts.push(parseInt($(this).val()));
        });
        getCalculation(type, posts, selectedusers);
    }

    if (type == 'facebook') {
        $('.facebookinput').each(function () {
            posts.push(parseInt($(this).val()));
        });
        getCalculation(type, posts, selectedusers);
    }
});

function getCalculation(type, posts, selectedusers) {
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




$(document).on('click', '#savecampaign', function () {
    setLoading();
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
            unsetLoading();
            if (jqXHR != 0 || jqXHR != '0') {
                dialog = bootbox.dialog({
                    message: '<div class="bootbox-body">' +
                    '<div class="icon-popup-div"> <img src="assets/images/chasing_2.gif" class="success-popup-icon"/> </div>' +
                    '<div class="row"> <div class="col-xs-12 popup-detail success">   <span class="yay"> YAY! </span> <br/> Campaign created sucessfully  </div>' +
                    '<div class="col-xs-12 btn-col"><div class="popup-btn-div"> <a href="/campaigns/?id=' + campaignid + '"><button class="submit-btn">VIEW CAMPAIGN </button></a></div>' +
                    '</div> </div>',
                    closeButton: true
                });

                dialog.modal();
                setTimeout(function () {
                  location.href="/campaigns/?id="+campaignid;
                }, 4000);
            }
        }
    }); // end ajax request*/


});
