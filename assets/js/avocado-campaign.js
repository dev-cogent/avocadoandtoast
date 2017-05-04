var removedInfluencers = {


};


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

var PLATFORMS = {
    0: 'instagram',
    1: 'facebook',
    2: 'twitter'
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
    var impressions = account.impressions;
    var followInfo = $('<div class="follower-count">').html('Impressions: ' + abbrNum(impressions));
    followInfo
        .addClass(PLATFORMS[platform]+'-follower-count')
        .attr('data-id',id);
    if(handleSet){
        followInfo.hide();
    }
    container.append(followInfo);
}




function setEngageInfo(id,container,engagement,platform, handleSet){
    var engageInfo = $('<div class="follower-count">').html('Engagement: '+abbrNum(engagement));
    engageInfo
        .addClass(PLATFORMS[platform]+'-engagement')
        .attr('data-id',id);
    if(handleSet){
        engageInfo.hide();
    }
    container.append(engageInfo);
}


/*<p  class="facebook-total-post total-post" data-id="'+key+'" style="text-align:center;padding-top: 3px; color:#73C48D; display:none;">'+obj.facebook_post+'  total post(s) </p>*/
function setPostInfo(key, container, post, platform, handleSet) {
    var postInfo = $('<div class="total-post">').html('Total Posts: '+abbrNum(post));
    postInfo
        .addClass(PLATFORMS[platform]+'-total-post')
        .attr('data-id',key);
    if(handleSet){
        postInfo.hide();
    }
    container.append(postInfo);
}



function setCampaignInfluencers(campaignJSON){
    $.each(campaignJSON, function (key, obj) {

        var bsbox = $('<div  class="influencer-box col-xs-12 col-sm-6 col-md-4 col-lg-3" data-id="'+key+'"'+
            'data-t-post="'+obj.twitter.post+'" data-f-post="'+obj.facebook.post+'" data-i-post="'+obj.instagram.post+'" data-t-impressions="'+obj.twitter.impressions+'" data-f-impressions="'+obj.facebook.impressions+'" data-i-impressions="'+obj.instagram.impressions+'"'+
            'data-t-engagement="'+obj.twitter.engagement+'" data-i-engagement="'+obj.instagram.engagement+'" data-f-engagement="'+obj.facebook.engagement+'">');
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
        var postsContainer = $('<div class= "col-xs-12">');
        var xButtonContainer = $('<div class= "x-button-container">');

        console.log(obj);
        var totalReach = $('<div class="follower-count">').html('Total Reach: '+ abbrNum(obj.total));
        followContainer.append(totalReach);

        var xButton = $('<div class="remove-influencer">').html('x').attr('data-id', key);
        xButtonContainer.append(xButton);

        cardBottom.append(iconContainer, handleContainer, followContainer, engageContainer, postsContainer, xButtonContainer);

        var accounts = [obj.instagram, obj.facebook, obj.twitter];
        var handleSet = false;
        accounts.forEach(function(account, idx) {
            if (account.handle) {
                setHandle(key, account.handle, handleContainer, handleSet);
                handleSet = true;
                setIcon(key,iconContainer,idx);
                setFollowInfo(key,followContainer,account,idx, handleSet);
                setEngageInfo(key,engageContainer,account.engagement,idx, handleSet);
                setPostInfo(key, postsContainer, account.post, idx, handleSet);
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


// function that uninvited or invites user to campaign
$(document).on('click','.remove-influencer',function(){
    var id = $(this).attr('data-id');
    var element = $(this);
    var card = $('.influencer-box[data-id='+id+']');
    if(!removedInfluencers[id]){

      removeInfluencerFromCampaign(id,card);
      removedInfluencers[id] = id;
    }
    UndoButton();
    saveButton();
});



$(document).on('click','#save-button',function(){
    setLoading();
    var urlParams = new URLSearchParams(window.location.search);
    var campaignid = urlParams.getAll('id');
        $.ajax({
            type: 'POST',
            url: '/php/ajax/editcampaign.php',
            data: {
            deletedInfluencers:deletedusers,
            campaignid:campaignid
            },
            success: function (jqXHR, textStatus, errorThrown) {
                dialog = bootbox.dialog({
                    message: '<div class="bootbox-body"><div class="modal-close-button">x</div>' +
                    '<div class="icon-popup-div"> <img src="/assets/images/chasing_2.gif" class="success-popup-icon"/> </div>' +
                    '<div class="row"> <div class="col-xs-12 popup-detail success">   <span class="yay"> YAY! </span> <br/> Your Campaign has been updated </div>' +
                    '</div> </div>',
                    closeButton: false
                });
                dialog.modal();
                $('.modal-close-button').click(function(){
                    dialog.modal('hide');
                    location.reload();

                });
                unsetLoading();
            } // end success
        }); // end ajax request*/

});


$(document).on('click','#undo-button',function(){
undoInfluencer();

});




/**
 * @about removes the influencer from the campaign.
 * @param {string} id
 * @param {string} card
 */
function removeInfluencerFromCampaign(id,card){
     card.fadeOut();//Taking the influencer card and making it fadeOut/Disappear... like magic :)
    var reach = parseInt($('#total-reach').attr('data-number')); //reach is also the totalImpressions.
    var numberOfInfluencers = parseInt($('#influnum').text() - 1);
    var totalPost = parseInt($('#total-posts').text());
    var totalInfluencerImpressions = parseInt(card.attr('data-t-impressions')) + parseInt(card.attr('data-f-impressions')) + parseInt(card.attr('data-i-impressions'));
    console.log(totalInfluencerImpressions);
    var totalEngagement = parseInt($('#total-engagement').attr('data-number'));
    var totalInfluencerEngagement = parseInt(card.attr('data-t-engagement')) + parseInt(card.attr('data-f-engagement')) + parseInt(card.attr('data-i-engagement'));
    var totalInfluencerPost = parseInt(card.attr('data-t-post')) + parseInt(card.attr('data-i-post')) + parseInt(card.attr('data-f-post'));
    var newEngagement = totalEngagement - totalInfluencerEngagement;
    var newAvgEngagement = newEngagement/(numberOfInfluencers);
    var newreach = reach - totalInfluencerImpressions;
    var newAvgImpressions = newreach /(numberOfInfluencers);

    if(!numberOfInfluencers){
        $('#influnum').text('0');     //Changing the influencer number
        $('#total-posts').text('0');     //changing the totalpost number
        $('#total-reach').attr('data-number','0'); //changing reach
        $('#total-reach').text('0');
        $('#total-engagement').text('0'); // changing engagement
        $('#total-engagement').attr('0');
        $('#avg-impressions').text('0'); // chaning avg impresions
        $('#avg-engagement').text('0'); // changing avg engagement
    }else{

    $('#influnum').text(numberOfInfluencers);     //Changing the influencer number
    $('#total-posts').text(totalPost - totalInfluencerPost);     //changing the totalpost number
    $('#total-reach').attr('data-number',newreach); //changing reach
    $('#total-reach').text(abbrNum(newreach));
    $('#total-engagement').text(abbrNum(newEngagement)); // changing engagement
    $('#total-engagement').attr('data-number',newEngagement);
    $('#avg-impressions').text(abbrNum(newAvgImpressions)); // chaning avg impresions
    $('#avg-engagement').text(abbrNum(newAvgEngagement)); // changing avg engagement
    }
    deletedusers.push(id); //adding influcner to removed users array

}


function saveButton(){
    if (deletedusers.length == 0)
    $('#save-button').css('visibility','hidden');
    else
    $('#save-button').css('visibility','visible');
}


function UndoButton(){
    if (deletedusers.length == 0)
    $('#undo-button').css('visibility','hidden');
    else
    $('#undo-button').css('visibility','visible');
}



/**
 * Function to undoInflunecer - conisides with addInfluencerToCampaign
 */
function undoInfluencer(){
    var lastelement = deletedusers.length - 1;
    var id = deletedusers[lastelement];
    deletedusers.splice(lastelement,1);
    removedInfluencers[id] = null;
    var card = $('.influencer-box[data-id='+id+']');
    addInfluencerToCampaign(id,card);
    if(deletedusers.length == 0){
        UndoButton();
        saveButton();
    }
}




/**
 * @about adds the influencer back to campain.
 * @param {string} id
 * @param {string} card
 *
 */
function addInfluencerToCampaign(id,card){
    card.fadeIn();
    var reach = parseInt($('#total-reach').attr('data-number')); //reach is also the totalImpressions.
    var numberOfInfluencers = parseInt($('#influnum').text());
    var totalPost = parseInt($('#total-posts').text());
    var totalInfluencerImpressions = parseInt(card.attr('data-t-impressions')) + parseInt(card.attr('data-f-impressions')) + parseInt(card.attr('data-i-impressions'));
    var totalEngagement = parseInt($('#total-engagement').attr('data-number'));
    var totalInfluencerEngagement = parseInt(card.attr('data-t-engagement')) + parseInt(card.attr('data-f-engagement')) + parseInt(card.attr('data-i-engagement'));
    var totalInfluencerPost = parseInt(card.attr('data-t-post')) + parseInt(card.attr('data-i-post')) + parseInt(card.attr('data-f-post'));
    var newEngagement = totalEngagement + totalInfluencerEngagement;
    var newAvgEngagement = newEngagement/(numberOfInfluencers + 1);
    var newreach = reach + totalInfluencerImpressions;
    var newAvgImpressions = newreach /(numberOfInfluencers + 1);
    $('#influnum').text(numberOfInfluencers + 1);     //Changing the influencer number
    $('#total-posts').text(totalPost + totalInfluencerPost);     //changing the totalpost number
    $('#total-reach').attr('data-number',newreach); //changing reach
    $('#total-reach').text(abbrNum(newreach));
    $('#total-engagement').text(abbrNum(newEngagement)); // changing engagement
    $('#total-engagement').attr('data-number',newEngagement);
    $('#avg-impressions').text(abbrNum(newAvgImpressions)); // chaning avg impresions
    $('#avg-engagement').text(abbrNum(newAvgEngagement)); // changing avg engagement

}
