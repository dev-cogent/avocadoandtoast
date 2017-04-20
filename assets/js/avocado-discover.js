
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
        var user = $('#influencer-search-name').val();
        if (user.length > 0) filters['user'] = user;
        else delete filters['user'];
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
        $.each(campaignJSON, function (key, obj) {

            $('.found-influencers').append('<div  class="influencer-box col-xs-12 col-md-6 col-lg-4 col-xl-3">' +
                '<div class="influencer-card-discover">' +
                '<a href="/profile.php/?id=' + key + '"><img class="influencer-image-card" src="http://cogenttools.com/' + obj.image + '" onerror="this.src=`/assets/images/default-photo.png`"> </a>' +
                '<div class="col-xs-12 influ-bottom" style="" data-id="' + key + '">' +
                '<!-- insthandle stuff -->' +
                '<div class="icons col-xs-12">' +
                '<i class="switch show-instagram inst-icon icon bd-instagram" data-id="' + key + '" data-platform="instagram" style="color:#73C48D" aria-hidden="true"></i>' +
                '<i class="switch show-facebook inst-icon icon bd-facebook" data-id="' + key + '" data-platform="facebook" aria-hidden="true"></i>' +
                '<i class="switch show-twitter inst-icon icon bd-twitter" data-id="' + key + '" data-platform="twitter" aria-hidden="true"></i>' +
                '</div>' +
                '<div class="col-xs-12 insthandle-info">' +
                '<!--icon here -->' +
                '<p class="instagram-handle insthandle-text" data-id="' + key + '">' + obj.instagram.handle + '</p>' +
                '<p class="facebook-handle insthandle-text" data-id="' + key + '" style="display:none;">' + obj.facebook.handle + '</p>' +
                '<p class="twitter-handle insthandle-text" data-id="' + key + '" style="display:none;">' + obj.twitter.handle + '</p>' +
                '</div>' +
                ' <!-- followers -->' +
                '<div class="col-xs-12">' +
                '<p class="instagram-follower-count follower-count" data-id="' + key + '">' + abbrNum(obj.instagram.followers) + ' Followers</p>' +
                '<p class="facebook-follower-count follower-count" style="display:none" data-id="' + key + '">' + abbrNum(obj.facebook.followers) + ' Likes</p>' +
                '<p class="twitter-follower-count follower-count" style="display:none" data-id="' + key + '">' + abbrNum(obj.twitter.followers) + ' Followers</p>' +
                '</div>' +
                '<!-- Engagement ?-->' +
                '<div class="col-xs-12">' +
                '<p class="instagram-engagement engagement-count" data-id="' + key + '">' + obj.instagram.engagement + '% eng per post</p>' +
                '<p class="facebook-engagement engagement-count" style="display:none"data-id="' + key + '">' + obj.facebook.engagement + '% eng per post</p>' +
                '<p class="twitter-engagement engagement-count" style="display:none"data-id="' + key + '">' + obj.twitter.engagement + '% eng per post</p>' +
                '</div>' +
                '<div class="col-xs-12">' +
                '<div style="display:inline;"class="col-xs-12 invite  avocado-focus" data-id="' + key + '" data-image="' + obj.image + '"></div>' +
                '</div></div></div> </div>');
        });

    }

