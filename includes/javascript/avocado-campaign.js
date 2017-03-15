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
                url: '/includes/ajax/avocado-campaign-pagination.php',
                data: {
                    page: page,
                    campaignid: campaignid
                },
                success: function (jqXHR, textStatus, errorThrown) {
                    $('.found-influencers').append(jqXHR);

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


    $('.' + platform + '-total-post[data-id=' + id + ']').show();
    $('.' + platform1 + '-total-post[data-id=' + id + ']').css('display', 'none');
    $('.' + platform2 + '-total-post[data-id=' + id + ']').css('display', 'none');

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


// function that uninvited or invites user to campaign 
$(document).on('click','.invite',function(){
    var id = $(this).attr('data-id');
    var element = $(this);
    var card = $('.influencer-box[data-id='+id+']');
    removeInfluencerFromCampaign(id,element,card);
}); 



function removeInfluencerFromCampaign(id, element, card){
    card.fadeOut(); //Taking the influencer card and making it fadeOut/Disappear... like magic :) 
 
    var reach = parseInt($('#reach').attr('data-num')); //reach is also the totalImpressions. 
    var numberOfInfluencers = parseInt($('#influnum').text());
    var totalPost = parseInt($('#posts').text());
    var totalInfluencerImpressions = parseInt(card.attr('data-t-impressions')) + parseInt(card.attr('data-f-impressions')) + parseInt(card.attr('data-i-impressions'));
    var totalEngagement = $('#engagement').attr('data-number');
    var totalInfluencerEngagement = parseInt(card.attr('data-t-engagement')) + parseInt(card.attr('data-f-engagement')) + parseInt(card.attr('data-i-engagement'));
    var totalInfluencerPost = parseInt(card.attr('data-t-post')) + parseInt(card.attr('data-i-post')) + parseInt(card.attr('data-f-post'));
    var newEngagement = totalEngagement - totalInfluencerEngagement;
    var newAvgEngagement = newEngagement/(numberOfInfluencers - 1);
    var newreach = reach - totalInfluencerImpressions;
    var newAvgImpressions = newreach /(numberOfInfluencers-1); 

    $('#influnum').text(numberOfInfluencers - 1);     //Changing the influencer number
    $('#posts').text(totalPost - totalInfluencerPost);     //changing the totalpost number 
    $('#reach').attr('data-num',newreach); //changing reach 
    $('#reach').text(abbrNum(newreach));
    $('#engagement').text(abbrNum(newEngagement)); // changing engagement 
    $('#engagement').attr('data-number',newEngagement); 
    $('#avgimp').text(abbrNum(newAvgImpressions)); // chaning avg impresions
    $('#avgeng').text(abbrNum(newAvgEngagement)); // changing avg engagement
    deletedusers.push(id); //adding influcner to removed users array 

}








