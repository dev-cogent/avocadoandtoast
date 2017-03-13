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
        throw new Error('Campaign name not entered');
        return 0; // We will give actual error message later.
    }
    $.ajax({
        type: 'POST',
        url: '../includes/ajax/savecampaign.php',
        data: {
            campaignname: name,
            info: JSON.stringify(arr)
        },
        success: function (jqXHR, textStatus, errorThrown) {
            unsetLoading();
            if (jqXHR != 0 || jqXHR != '0') {
                dialog = bootbox.dialog({
                    message: '<div class="bootbox-body">' +
                    '<div class="icon-popup-div"> <img src="assets/images/chasing_2.gif" class="success-popup-icon"/> </div>' +
                    '<div class="row"> <div class="col-xs-12 popup-detail success">   <span class="yay"> YAY! </span> <br/> Campaign created sucessfully  </div>' +
                    '<div class="col-xs-12 btn-col"><div class="popup-btn-div"> <a href="/campaigns/?id=' + jqXHR + '"><button id="applyall" class="submit-btn">VIEW CAMPAIGN </button></a></div> <div class="col-xs-12"><div class="submit-btn-div"><a href="/edit/?id=' + jqXHR + '"> <button id="applyall" class="submit-btn"> ADD  DETAILS </button></a></div>' +
                    '</div> </div>',
                    closeButton: true
                });
                dialog.modal();
            }
        }
    }); // end ajax request*/






});
