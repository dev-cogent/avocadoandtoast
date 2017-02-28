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



function applyFilters(filters) {
    page = 0;
    $.ajax({
        type: 'POST',
        url: '/includes/ajax/avocado-campaign-pagination.php',
        data: {
            filters: filters,
            page: page
        },
        success: function (jqXHR, textStatus, errorThrown) {
            $('.found-influencers').empty();
            $('.found-influencers').append(jqXHR);
        }
    });
}



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
selectInfluencer(id, element);





}); 



function selectInfluencer(id, element) {
    if(element.attr('data-type') == 'uninvited'){
        console.log('meh');
    }
    element.empty();
    element.css('background-color','white');
    element.css('color','#515862');
    element.css('border','1px solid #515862');
    element.append('<i class="thumb-up icon fa-plus" aria-hidden="true"></i> INVITE');
    element.attr('data-type','uninvited');
    //Ajax goes here to remove user from the campaign. 

}







