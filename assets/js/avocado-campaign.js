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

function setCampaignInfluencers(campaignJSON){
    $.each(campaignJSON, function (key, obj) {
           $('.found-influencers').append( '<div  class="influencer-box col-xs-12 col-sm-6 col-md-4 col-lg-3" data-id="'+key+'"'+
           'data-t-post="'+obj.twitter_post+'" data-f-post="'+obj.facebook_post+'" data-i-post="'+obj.instagram_post+'" data-t-impressions="'+obj.twitter_impressions+'" data-f-impressions="'+obj.facebook_impressions+'" data-i-impressions="'+obj.instagram_impressions+'"'+
           'data-t-engagement="'+obj.twitter_engagement+'" data-i-engagement="'+obj.instagram_engagement+'" data-f-engagement="'+obj.facebook_engagement+'">'+
                '<div class="influencer-card-discover">'+
                                '<img class="influencer-image-card" src="http://cogenttools.com/'+obj.image+'" onerror="this.src=`/assets/images/default-photo.png`">'+
                                    '<div class="col-xs-12" style="height:170px; box-shadow: rgb(115, 196, 141) 0px -10px 0px;">'+
                                      '<div class="icons col-xs-12">'+
                                      '<a> <i class="switch show-instagram inst-icon icon bd-instagram" data-id="'+key+'" data-platform="instagram" aria-hidden="true"  style="color:#73C48D"></i></a>'+
                                      '<a> <i class="switch show-facebook inst-icon icon bd-facebook" data-id="'+key+'" data-platform="facebook" aria-hidden="true" ></i></a>'+
                                      '<a> <i class="switch show-twitter inst-icon icon bd-twitter" data-id="'+key+'" data-platform="twitter" aria-hidden="true"></i></a>'+
                                      '</div>'+
                                        '<!-- insthandle stuff -->'+
                                        '<div class="icons col-xs-12"></div>'+
                                        '<div class="col-xs-12 insthandle-info">'+
                                                '<p class="instagram-handle insthandle-text" data-id="'+key+'">'+obj.instagram_handle+'</p>'+
                                                '<p class="facebook-handle insthandle-text" data-id="'+key+'" style="display:none;">'+obj.facebook_handle+'</p>'+
                                               '<p class="twitter-handle insthandle-text" data-id="'+key+'" style="display:none;">'+obj.twitter_handle+'</p>'+                                            
                                        '</div>'+
                                    '<!-- followers -->'+
                                    '<div class="col-xs-12">'+
                                        '<p class="instagram-follower-count follower-count" data-id="'+key+'">'+ abbrNum(obj.instagram_impressions)+' Impressions</p>'+
                                        '<p class="facebook-follower-count follower-count" style="display:none" data-id="'+key+'">'+abbrNum(obj.facebook_impressions)+' Impressions</p>'+
                                        '<p class="twitter-follower-count follower-count" style="display:none" data-id="'+key+'">'+abbrNum(obj.twitter_impressions)+' Impressions</p>'+
                                    '</div>'+
                                    '<div class="col-xs-12">'+
                                        '<p class="instagram-engagement engagement-count" data-id="'+key+'">'+abbrNum(obj.instagram_engagement)+ ' Engagaement </p>'+
                                        '<p class="facebook-engagement engagement-count" style="display:none"data-id="'+key+'">'+abbrNum(obj.facebook_engagement)+' Engagaement</p>'+
                                        '<p class="twitter-engagement engagement-count" style="display:none"data-id="'+key+'">'+abbrNum(obj.twitter_engagement)+' Engagement</p>'+
                                    '</div>'+
                                    '<div class="col-xs-12">'+
                                    '<div style="display:inline; background-color:white; margin-top:1px; margin-bottom:4px; height:28px; padding-top:0px; width:100%;"class="col-xs-12 invite  avocado-focus" data-id="'+key+'" >'+
                                              '<p  class="instagram-total-post total-post" data-id="'+key+'" style="text-align:center;padding-top: 3px; color:#73C48D;">'+obj.instagram_post+' total post(s) </p>'+
                                               '<p  class="facebook-total-post total-post" data-id="'+key+'" style="text-align:center;padding-top: 3px; color:#73C48D; display:none;">'+obj.facebook_post+'  total post(s) </p>'+
                                               '<p  class="twitter-total-post total-post" data-id="'+key+'" style="text-align:center;padding-top: 3px; color:#73C48D; display:none;">'+obj.twitter_post+'  total post(s) </p>'+
                                              '<i class="icon fa-times remove-influencer" aria-hidden="true" style="text-align:center; width:100%; margin-left:0px;"></i>'+
                                        '</div></div></div></div></div>');


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
$(document).on('click','.invite',function(){
    var id = $(this).attr('data-id');
    var element = $(this);
    var card = $('.influencer-box[data-id='+id+']');
    removeInfluencerFromCampaign(id,card);
    UndoButton();
    saveButton();
}); 



$(document).on('click','#save-button',function(){
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
                    message: '<div class="bootbox-body">' +
                    '<div class="icon-popup-div"> <img src="/assets/images/chasing_2.gif" class="success-popup-icon"/> </div>' +
                    '<div class="row"> <div class="col-xs-12 popup-detail success">   <span class="yay"> YAY! </span> <br/> Your Campaign has been updated </div>' +
                    '</div> </div>',
                    closeButton: true
                });
                dialog.modal();
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
    card.fadeOut(); //Taking the influencer card and making it fadeOut/Disappear... like magic :) 
 
    var reach = parseInt($('#total-reach').attr('data-number')); //reach is also the totalImpressions. 
    var numberOfInfluencers = parseInt($('#influnum').text());
    var totalPost = parseInt($('#total-posts').text());
    var totalInfluencerImpressions = parseInt(card.attr('data-t-impressions')) + parseInt(card.attr('data-f-impressions')) + parseInt(card.attr('data-i-impressions'));
    console.log(totalInfluencerImpressions);
    var totalEngagement = $('#total-engagement').attr('data-number');
    var totalInfluencerEngagement = parseInt(card.attr('data-t-engagement')) + parseInt(card.attr('data-f-engagement')) + parseInt(card.attr('data-i-engagement'));
    var totalInfluencerPost = parseInt(card.attr('data-t-post')) + parseInt(card.attr('data-i-post')) + parseInt(card.attr('data-f-post'));
    var newEngagement = totalEngagement - totalInfluencerEngagement;
    var newAvgEngagement = newEngagement/(numberOfInfluencers - 1);
    var newreach = reach - totalInfluencerImpressions;
    var newAvgImpressions = newreach /(numberOfInfluencers-1); 

    $('#influnum').text(numberOfInfluencers - 1);     //Changing the influencer number
    $('#total-posts').text(totalPost - totalInfluencerPost);     //changing the totalpost number 
    $('#total-reach').attr('data-number',newreach); //changing reach 
    $('#total-reach').text(abbrNum(newreach));
    $('#total-engagement').text(abbrNum(newEngagement)); // changing engagement 
    $('#total-engagement').attr('data-number',newEngagement); 
    $('#avg-impressions').text(abbrNum(newAvgImpressions)); // chaning avg impresions
    $('#avg-engagement').text(abbrNum(newAvgEngagement)); // changing avg engagement
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

