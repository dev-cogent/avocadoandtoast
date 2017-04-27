$(document).on('click', '.filter-option', function () {
    var platform = $(this).attr('data-platform');
    $(this).css('color', '#73C48D');
    if (platform == 'facebook') {
        platform1 = 'instagram';
        platform2 = 'twitter';
        platform3 = 'youtube';
    }
    if (platform == 'twitter') {
        platform1 = 'instagram';
        platform2 = 'facebook';
        platform3 = 'youtube';
    }
    if (platform == 'instagram') {
        platform1 = 'twitter';
        platform2 = 'facebook';
        platform3 = 'youtube';
    }
    if(platform == 'youtube'){
        platform1 = 'facebook';
        platform2 = 'instagram';
        platform3 = 'twitter';

    }
    $('.filter-option[data-platform=' + platform1 + ']').css('color', '#A2A8B1');
    $('.filter-option[data-platform=' + platform2 + ']').css('color', '#A2A8B1');
    $('.filter-option[data-platform=' + platform3 + ']').css('color','#A2A8B1');
    $('.sliders[data-platform=' + platform + ']').show();
    $('.sliders[data-platform=' + platform + '-engagement]').show();
    $('.sliders[data-platform=' + platform1 + ']').css('display', 'none');
    $('.sliders[data-platform=' + platform1 + '-engagement]').css('display', 'none');
    $('.sliders[data-platform=' + platform2 + ']').css('display', 'none');
    $('.sliders[data-platform=' + platform2 + '-engagement]').css('display', 'none');
    $('.sliders[data-platform=' + platform3 + ']').css('display', 'none');
    $('.sliders[data-platform=' + platform3 + '-engagement]').css('display', 'none');

});
    
    
    /**
     * Function when the user clicks on the "Calculate Campaign button" all javascript pertaining that page can be found at avocado-calculate.js 
     * @return NULL
     */
    $(document).on('click', '#calculate', function () {
        setLoading();
        if (selectedusers.length == 0) {
            console.log('THERE ARE NO INFLUENCERS SELECTED');
            unsetLoading();
            return 0;
        }
        calculate = true;
        $.ajax({
            type: 'POST',
            url: '/php/ajax/avocado-get-influencers.php',
            data: {
                influencers: selectedusers
            },
            success: function (jqXHR, textStatus, errorThrown) {

                calculate = true;
                $('#discover-container').empty();
                $('#discover-container').append(jqXHR);
                unsetLoading();
               
            }
        }); // end ajax request*/
    });

 

    /**
     * Function to get all the filters in the 2 input fields. This includes tags and influencers names/handles. 
     * 
     */
    $(document).on('click', '#search-keyword', function () {
        var keywordarr = [];
        $('.token-label').each(function () {
            keywordarr.push($(this).text()); // taking all of the keywords the user has submitted. 
        });
        if (keywordarr.length !== 0) {
            filters['keywords'] = keywordarr;
            $('.dropdown').val('');
        }
        else {
            var keyword = $('.dropdown').val();
            filters['keywords'] = [keyword];
        }
        applyFilters(filters);
    });

    $('#slider-instagram').click(function () {
        filterSlider('instagram');
    });

    $('#slider-instagram-engagement').click(function () {
        filterSlider('instagram');
    });

    $('#slider-twitter').click(function () {
        filterSlider('twitter');
    });

    $('#slider-twitter-engagement').click(function () {
        filterSlider('twitter');
    });

    $('#slider-facebook').click(function () {
        filterSlider('facebook');
    });

    $('#slider-facebook-engagement').click(function () {
        filterSlider('facebook');
    });


    /**
     * @About function to filter all slider options
     * @param {string} platform 
     */
    function filterSlider(platform) {
        filters['eng-min'] = $('#min-' + platform + '-engagement').attr('data-number');
        filters['eng-max'] = $('#max-' + platform + '-engagement').attr('data-number');
        filters['min'] = $('#min-' + platform).attr('data-number');
        filters['max'] = $('#max-' + platform).attr('data-number');
        filters['platform'] = platform;
        applyFilters(filters);
    }


    /**
     * Function for pagination. 
     */
    $(window).scroll(function () {
        //The reason why we check for calculate is because when we switch to a new page it will still try to get new influencers with the pagination function
        if (calculate == false) {
            if ($(window).scrollTop() + $(window).height() > $(document).height() - 30) {
                page = page + 1;
                $.ajax({
                    type: 'POST',
                    url: '/php/ajax/avocado-discover-pagination-json.php',
                    data: {
                        page: page,
                        filters: filters
                    },
                    success: function (jqXHR, textStatus, errorThrown) {
                        campaignJSON = JSON.parse(jqXHR);
                        appendCards(campaignJSON);
                    }
                }); // end ajax request*/
            }
        }
    });


    /**
     * 
     * @ABOUT applyFilters takes an object of filters and then applies it. Returning JSON. That JSON goes to the appendCards function and that provieds the content. 
     * @param {object} filters 
     */
    function applyFilters(filters) {
        setLoading();
        page = 0;
        $.ajax({
            type: 'POST',
            url: '/php/ajax/avocado-discover-pagination-json.php',
            data: {
                filters: filters,
                page: page
            },
            success: function (jqXHR, textStatus, errorThrown) {
                $('.found-influencers').empty();
                campaignJSON = JSON.parse(jqXHR);
                appendCards(campaignJSON);
                unsetLoading();
            }
        });
    }

    /**
     * @About taking JSON from other functions and making the HTML card view. 
     * @param {JSON} campaignJSON 
     */
    function appendCards(campaignJSON) {
         console.log(campaignJSON);
            $.each(campaignJSON, function (key, obj) {
            
            $('.found-influencers').append('<div  class="influencer-box col-xs-12 col-sm-6 col-md-4 col-lg-3">' +
                '<div class="influencer-card-discover">' +
                '<a href="/profile.php/?id=' + key + '"><img class="influencer-image-card" src="http://cogenttools.com/' + obj.image + '" onerror="this.src=`/assets/images/default-photo.png`"> </a>' +
                '<div class="col-xs-12 influ-bottom" style="" data-id="' + key + '">' +
                '<!-- insthandle stuff -->' +
                '<div class="icons col-xs-12">' +
                '<i class="switch show-instagram inst-icon icon bd-instagram active-platform" data-id="' + key + '" data-platform="instagram" aria-hidden="true"></i>' +
                '<i class="switch show-facebook inst-icon icon bd-facebook" data-id="' + key + '" data-platform="facebook" aria-hidden="true"></i>' +
                '<i class="switch show-twitter inst-icon icon bd-twitter" data-id="' + key + '" data-platform="twitter" aria-hidden="true"></i>' +
                '</div>' +
                '<div class="col-xs-12 insthandle-info">' +
                '<!--icon here -->' +
                '<div class="instagram-handle insthandle-text" data-id="' + key + '">' + obj.instagram.handle + '</div>' +
                '<div class="facebook-handle insthandle-text disable-platform" data-id="' + key + '" >' + obj.facebook.handle + '</div>' +
                '<div class="twitter-handle insthandle-text disable-platform" data-id="' + key + '" >' + obj.twitter.handle + '</div>' +
                '</div>' +
                ' <!-- followers -->' +
                '<div class="col-xs-12">' +
                '<div class="follower-count">Total Reach: '+abbrNum(obj.total)+'</div>'+
                '<div class="instagram-follower-count follower-count disable-platform" data-id="' + key + '">Followers: ' + abbrNum(obj.instagram.followers) + ' </div>' +
                '<div class="facebook-follower-count follower-count disable-platform"  data-id="' + key + '">Likes: ' + abbrNum(obj.facebook.followers) + ' </div>' +
                '<div class="twitter-follower-count follower-count disable-platform"  data-id="' + key + '">Followers: ' + abbrNum(obj.twitter.followers) + ' </div>' +
                '</div>' +
                '<!-- Engagement ?-->' +
                '<div class="col-xs-12">' +
                '<div class="instagram-engagement follower-count disable-platform" data-id="' + key + '">Engagement: ' + obj.instagram.engagement + '%</div>' +
                '<div class="facebook-engagement follower-count disable-platform" data-id="' + key + '">Engagement: ' + obj.facebook.engagement + '%</div>' +
                '<div class="twitter-engagement follower-count disable-platform" data-id="' + key + '">Engagement: ' + obj.twitter.engagement + '%</div>' +
                '</div>' +
                '<div class="col-xs-12">' +
                '<div class="col-xs-12 invite  avocado-focus" data-id="' + key + '" data-image="' + obj.image + '"></div>' +
                '</div></div></div> </div>');
                checkExistancePlatform(key, obj);
        });

    }


/** this function was created to read the instahandle info, and either append icon or hide icon
 *  */







 

  
 function checkExistancePlatform (id, influencerObj) {
        
         var instagramUrl = influencerObj.instagram.url;
         var facebookUrl = influencerObj.facebook.url;
         var twitterUrl = influencerObj.twitter.url;

         if(!instagramUrl){
            changePlatforminfo(id,'instagram');
         }
         if(!facebookUrl){
             changePlatforminfo(id,'facebook');
         }
         if(!twitterUrl){
            changePlatforminfo(id,'twitter');
         }         
 }


function changePlatforminfo(id, platform) {
    if(platform = "instagram"){
        var platform1= "facebook";
        var platform2= "twitter";

    }
    if(platform == "facebook"){
        var platform1= "twitter";

    }
    if(platform == "twitter"){


    }
        //$('.show-' + platform + '[data-id="'+id+'"]').addClass('disable-platform');
        $('.show-' + platform1 + '[data-id="'+id+'"]').addClass('active-platform');
        $('.' + platform +'-handle[data-id="'+id+'"]').addClass('disable-platform');
        $('.' + platform1 +'-handle[data-id="'+id+'"]').removeClass('disable-platform');
        $('.' + platform +'-follower-count[data-id="'+id+'"]').addClass('disable-platform');
        $('.' + platform1 +'-follower-count[data-id="'+id+'"]').removeClass('disable-platform');
        $('.' + platform +'-engagement[data-id="'+id+'"]').addClass('disable-platform');
        $('.' + platform1 +'-engagement[data-id="'+id+'"]').removeClass('disable-platform'); 
}
