


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
    $('.sliders[data-platform=' + platform + ']').css('display','unset');
    $('.sliders[data-platform=' + platform + '-engagement]').css('display','unset');
    $('.sliders[data-platform=' + platform1 + ']').css('display', 'none');
    $('.sliders[data-platform=' + platform1 + '-engagement]').css('display', 'none');
    $('.sliders[data-platform=' + platform2 + ']').css('display', 'none');
    $('.sliders[data-platform=' + platform2 + '-engagement]').css('display', 'none');
    $('.sliders[data-platform=' + platform3 + ']').css('display', 'none');
    $('.sliders[data-platform=' + platform3 + '-engagement]').css('display', 'none');

});






    /**
     * Function to get all the filters in the 2 input fields. This includes tags and influencers names/handles.
     *
     */
    $(document).on('click', '#search-keyword', function () {
        var inputVal = $('.filter-input').val();
        inputVal = inputVal.split(' ');
        filters['keywords'] = inputVal;
        applyFilters(filters);
    });


    $('.filter-input').keypress(function (e) {
      if(e.which == 13){
        var inputVal = $('.filter-input').val();
        inputVal = inputVal.split(' ');
        filters['keywords'] = inputVal;
        applyFilters(filters);
      }
    });




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
    function applyFilters(filters, loading = false) {
        Pace.restart();
        page = 0;
        $.ajax({
            type: 'POST',
            url: '/php/ajax/avocado-discover-pagination-json.php',
            data: {
                filters: filters,
                page: page
            },
            success: function (jqXHR, textStatus, errorThrown) {
                var stringFilters = JSON.stringify(filters);
                localStorage.setItem('discover-filters', stringFilters);
                $('.found-influencers').empty();
                campaignJSON = JSON.parse(jqXHR);
                appendCards(campaignJSON);

            }
        });

        $.ajax({
            type: 'POST',
            url: '/php/ajax/avocado-discover-get-filter-results.php',
            data: {
                filters: filters,
            },
            success: function (jqXHR, textStatus, errorThrown) {
                influencerResults = JSON.parse(jqXHR);
                $('#influencer-results-number').html('('+abbrNum(influencerResults)+')').fadeIn(333);

            }
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
        console.log(elementPlatform);
        $(element).addClass('af-active-icon selected');
      }
  })
  if(filters.category){
    $('.influencer-category[data-category="'+filters.category+'"]').addClass('selected');
    var parentObj = $('.influencer-category[data-category="'+filters.category+'"]').parent()[0]['childNodes'][3];
    $(parentObj).toggle();
    setTimeout(function(){
      $('.subcategory-block[data-subcategory="'+filters.followers.min+'"]').click();
    },600);
  }

  if(filters.engagement){
    $('#engagement-min').val(filters.engagement.min);
    $('#engagement-max').val(filters.engagement.max);
  }

  if(filters.location){
    $('#location-input').val(filters.location);
  }

  if(filters.gender){
    $('.gender-block[data-gender="'+filters.gender[0]+'"]').addClass('checked');
  }

}


function appendCards(campaignJSON){

  $('#influencer-results-number').html(abbrNum(campaignJSON.influencerResults));
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
            if (account.handle) {
                setHandle(key, account.handle, handleContainer, handleSet);
                handleSet = true;
                setIcon(key,iconContainer,idx);
                setFollowInfo(key,followContainer,account,idx, handleSet);
                setEngageInfo(key,engageContainer,account.engagement,idx, handleSet);
            }
        })
    });

}
