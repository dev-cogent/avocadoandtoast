$(document).on('click', '#createcampaign', function () {
    setLoading();
    var name = $('#campaign-name').val();
    var arr = {};
    for (i = 0; i < selectedusers.length; i++) {
        var id = selectedusers[i];
        arr[id] = {};
        arr[id]['instagramposts'] = $('.instagraminput[data-id=' + id + ']').val();
        arr[id]['facebookposts'] = $('.facebookinput[data-id=' + id + ']').val();
        arr[id]['twitterposts'] = $('.twitterinput[data-id=' + id + ']').val();
    }


    if (name == '' || name == null) {
        unsetLoading();
        // throw new Error('Campaign name not entered');
        dialog = bootbox.dialog({
          message: '<div class="bootbox-noname">' +
          '<div class="no-name-popup-div"> <img src="/assets/images/burnt-toast-smaller.gif" class="campaign-name-error-gif"/> </div>' +
          '<div class="row popup"> <div class="name-popup-detail"> <span class="no-name-error"> oops! </span> <br>  your list doesn&#39;t have a name yet <br> Pls name it and you will be one step closer!    </div>' +
          '<div class="delete-btn-div"> <a href="#"></a></div>' +
          '</div>',
            closeButton: true
        });
        dialog.modal();
       return 0; // We will give actual error message later.
    }
    $.ajax({
        type: 'POST',
        url: '../php/ajax/savecampaign.php',
        data: {
            campaignname: name,
            info: JSON.stringify(arr)
        },
        success: function (jqXHR, textStatus, errorThrown) {
            unsetLoading();
            localStorage.clear();
            if (jqXHR != 0 || jqXHR != '0') {
                dialog = bootbox.dialog({
                    message: '<div class="bootbox-body">' +
                    '<div class="icon-popup-div"> <img src="/assets/images/chasing_2.gif" class="success-popup-icon"/> </div>' +
                    '<div class="row popup"> <div class="successful-list-detail success">   <span class="yay"> YAY! </span> <br/> '+ name +' List created sucessfully  </div>' +
                    '<div class="view-campaign-div"> <a href="/campaigns/?id=' + jqXHR + '"><button id="applyall" class="primary-button view-campaign-btn">VIEW CAMPAIGN </button></a></div> <div class="add-details-div"><a href="/edit/?id=' + jqXHR + '"> <button id="applyall" class="primary-button add-details-btn"> ADD  DETAILS </button></a></div>'
                    ,
                    closeButton: true
                });
                dialog.modal();
            }
        }
    }); // end ajax request*/


});

$(document).on('click', '#add-existing', function () {
    setLoading();
    var name = $('.campaign-dropdown').val();
    var displayName = $('.campaign-dropdown option:selected').text();
    var arr = {};
    for (i = 0; i < selectedusers.length; i++) {
        var id = selectedusers[i];
        arr[id] = {};
        arr[id]['instagramposts'] = $('.instagraminput[data-id=' + id + ']').val();
        arr[id]['facebookposts'] = $('.facebookinput[data-id=' + id + ']').val();
        arr[id]['twitterposts'] = $('.twitterinput[data-id=' + id + ']').val();
    }
    if (name == '' || name == null) {
        unsetLoading();
        throw new Error('Campaign name not entered');

        return 0; // We will give actual error message later.
    }
    $.ajax({
        type: 'POST',
        url: '../php/ajax/addtoexistingcampaign.php',
        data: {
            campaignid: name,
            info: JSON.stringify(arr)
        },
        success: function (jqXHR, textStatus, errorThrown) {
            unsetLoading();
            if (jqXHR != 0 || jqXHR != '0') {
              dialog = bootbox.dialog({
                  message: '<div class="bootbox-body">' +
                  '<div class="icon-popup-div"> <img src="/assets/images/chasing_2.gif" class="success-popup-icon"/> </div>' +
                  '<div class="row popup"> <div class="successful-list-detail success">   <span class="yay"> YAY! </span> <br/> Influencers have been to your '+ displayName +' list </div>' +
                  '<div class="view-campaign-div"> <a href="/campaigns/?id=' + jqXHR + '"><button id="applyall" class="primary-button view-campaign-btn">VIEW CAMPAIGN </button></a></div> <div class="add-details-div"><a href="/edit/?id=' + jqXHR + '"> <button id="applyall" class="primary-button add-details-btn"> ADD  DETAILS </button></a></div>'
                  ,
                  closeButton: true
              });
              dialog.modal();
            }
        }
    }); // end ajax request*/
});
