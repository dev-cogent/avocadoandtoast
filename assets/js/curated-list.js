
$(document).ready(function(){
    getCampaignInformation(campaignid);
    getCampaignInfluencers(campaignid);

});


function getCampaignInformation(campaignid){
    $.ajax({
            type: 'POST',
            url: '/php/ajax/getCampaignInfo.php',
            data: {
                campaignid: campaignid
            },
            success: function (jqXHR, textStatus, errorThrown) {
                campaignJSON = JSON.parse(jqXHR);
                setCampaignInformation(campaignJSON);
        } // end ajax request*/

    });
}


function setCampaignInformation(campaignJSON){
        $('#campaign-description').append(campaignJSON.description);
        $('#campaign-name').prepend(campaignJSON.campaignname);
        $('#influnum').text(campaignJSON.total_influencers);
        $('#total-posts').text(campaignJSON.totalposts);
        var avgImpressions = campaignJSON.totalimpressions/campaignJSON.total_influencers;
        var avgEngagement = campaignJSON.totalengagement/campaignJSON.total_influencers;
        $('#avg-impressions').attr('data-number',avgImpressions);
        $('#avg-impressions').text(abbrNum(avgImpressions));
        $('#avg-engagement').attr('data-number',avgEngagement);
        $('#avg-engagement').text(abbrNum(avgEngagement));
        $('#total-reach').attr('data-number',campaignJSON.totalimpressions);
        $('#total-reach').text(abbrNum(campaignJSON.totalimpressions));
        $('#total-engagement').attr('data-number',campaignJSON.totalengagement);
        $('#total-engagement').text(abbrNum(campaignJSON.totalengagement));
}


function getCampaignInfluencers(campaignid){
    $.ajax({
            type: 'POST',
            url: '/php/ajax/getCampInfluInfo.php',
            data: {
                campaignid: campaignid
            },
            success: function (jqXHR, textStatus, errorThrown) {
                campaignJSON = JSON.parse(jqXHR);
                setCampaignInfluencers(campaignJSON);
        } // end ajax request*/

    });


}
function appendImagePullOut(selectedusers){
  selectedusers.forEach(function(influencer){
    console.log(influencer);
    var influencerString = '<img class="influencer-pullout-image image-selected" data-id="'+influencer+'" onerror="this.src=`/assets/images/default-photo.png`" src="http://cogenttools.com/images/'+influencer+'.jpg">';
    console.log(influencerString);
    $('#influencer-pullout-image-container').append(influencerString);
  });
  var numOfInfluencers = selectedusers.length;
  $('#num-influencers').text(numOfInfluencers);

}





var PLATFORMS = {
    0: 'instagram',
    1: 'facebook',
    2: 'twitter',
    3: 'youtube'
}


function setIcon(id, container, platform) {
    var icon = $('<i class="influencer-card-icon switch">');

    icon
        .addClass('show-' + PLATFORMS[platform])
        .addClass('bd-' + PLATFORMS[platform])
        .attr('data-id',id)
        .attr('data-platform', PLATFORMS[platform])
    container.append(icon);
}


function setHandle(id,string, container, handleSet) {
    var handleText = $('<div class="handle-text">').attr('data-id',id).html(string);
    container.append(handleText);
    if(handleSet){
        handleText.hide();
    }
}

function setFollowInfo(id,container,account,platform, handleSet){
    var string ;
    var followers = account.followers;
    if(PLATFORMS[platform] !== 'facebook'){
        var followInfo = $('<div class="follower-count">').html('Followers: ' + abbrNum(followers));
    }else{
        followers = account.likes;
        var followInfo = $('<div class="follower-count">').html('Likes: ' + abbrNum(followers));
    }

    followInfo
        .addClass(PLATFORMS[platform]+'-follower-count')
        .attr('data-id',id);
    if(handleSet){
        followInfo.hide();
    }
    container.append(followInfo);
}




function setEngageInfo(id,container,engagement,platform, handleSet){
    var engageInfo = $('<div class="follower-count">').html('Engagement: '+engagement+'%');
    engageInfo
        .addClass(PLATFORMS[platform]+'-engagement')
        .attr('data-id',id);
    if(handleSet){
        engageInfo.hide();
    }
    container.append(engageInfo);
}


function showFilters(filters){
  var valKeywords = filters.keywords.join(' ');
  $('.filter-input').val(valKeywords);
  var item = $('#af-icon-container').children();
  $.each(item,function(key, element){
      var elementPlatform = $(element).attr('data-platform');
      if(elementPlatform == filters.platform){
        $(element).addClass('af-active-icon');
      }
  })

}


function setCampaignInfluencers(campaignJSON){
    console.log(campaignJSON);
    $.each(campaignJSON, function (key, obj) {

        var bsbox = $('<div  class="influencer-box col-xs-12 col-sm-6 col-md-4 col-lg-3" data-id="'+key+'">');
        $('.found-influencers').append(bsbox);

        var card = $('<div class="influencer-card-discover">');
        bsbox.append(card);

        var image = $('<a href="/profile.php/?id=' + key + '"><img class="influencer-image-card" src="http://cogenttools.com/' + obj.image + '" onerror="this.src=`/assets/images/default-photo.png`">');
        card.append(image);

        var cardBottom = $('<div class="col-xs-12 influ-bottom" style="" data-id="' + key + '">');
        card.append(cardBottom);

        var iconContainer = $('<div class= "influencer-icons col-xs-12">');
        var handleContainer = $('<div class= "handle-info col-xs-12">');
        var followContainer = $('<div class= "col-xs-12">');
        var engageContainer = $('<div class= "col-xs-12">');
        var inviteContainer = $('<div class= "col-xs-12">');

        var totalReach = $('<div class="follower-count">').html('Total Reach: '+ abbrNum(obj.total));
        followContainer.append(totalReach);

        var inviteButton = $('<div class="col-xs-12 invite avocado-focus">').attr('data-id', key).attr('data-image',obj.image);
        inviteContainer.append(inviteButton);

        cardBottom.append(iconContainer, handleContainer, followContainer, engageContainer, inviteContainer);

        var accounts = [obj.instagram, obj.facebook, obj.twitter, obj.youtube];
        var handleSet = false;
        accounts.forEach(function(account, idx) {
            
            if (account && account.handle) {
                setHandle(key, account.handle, handleContainer, handleSet);
                handleSet = true;
                setIcon(key,iconContainer,idx);
                setFollowInfo(key,followContainer,account,idx, handleSet);
                setEngageInfo(key,engageContainer,account.eng_decimal,idx, handleSet);
            }else{
                
            }
        })
    });
}










// same ajax call but calling a different php file that contains different bootstrap styling
// for the view campaigns onscroll pagination
    $(window).scroll(function () {
        if(calculate == false){
        if ($(window).scrollTop() == $(document).height() - $(window).height()) {
            page = page + 1;
            console.log(page);
            console.log(filters);
            $.ajax({
                type: 'POST',
                url: '/php/ajax/avocado-campaign-pagination.php',
                data: {
                    page: page,
                    campaignid: campaignid
                },
                success: function (jqXHR, textStatus, errorThrown) {
                    campaignJSON = JSON.parse(jqXHR);
                    setCampaignInfluencers(campaignJSON);

                }

            }); // end ajax request*/
        }
        }
    });





$(document).on('click', '.switch', function () {
    var platform = $(this).attr('data-platform');
    var id = $(this).attr('data-id');
    var platformarr = findPlatform(platform);
    platform = platformarr[0];
    platform1 = platformarr[1];
    platform2 = platformarr[2];

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


    $('.' + platform + '-total-post[data-id=' + id + ']').show();
    $('.' + platform1 + '-total-post[data-id=' + id + ']').css('display', 'none');
    $('.' + platform2 + '-total-post[data-id=' + id + ']').css('display', 'none');

});

/**
 * @about identfies the platform
 * @param {string} platform
 * @returns{array} and array of all the platforms
 */
function findPlatform(platform){
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
    var platformarr = [platform,platform1,platform2];
    return platformarr;
}



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







