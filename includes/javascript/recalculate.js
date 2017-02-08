$(document).on('click', '#resave', function () {
    dialog = bootbox.dialog({
        message: '<input type="text" id="campaignname" value="'+campaignname+'"><br/><input type="text" id="campaigndescription" value="'+description+'"><button id="savecampaign">Submit</button>',
        closeButton: true
    });
    dialog.modal();

});
$(document).on('click', '#savecampaign', function () {
    var campaignName = $('#campaignname').val();
    var campaignDescription = $('#campaigndescription').val();

    var instagramtotal = $('instagram-posts').html();
    var facebooktotal = $('.facebook-posts').html();
    var twittertotal = $('.twitter-posts').html();
    var arr = {};
    var instagramposts = [];
    var facebookposts = [];
    var twitterposts = [];
    for (var i = 0; i < selectedusers.length; i++) {
        var temp = $('.instagraminput[data-id="' + selectedusers[i] + '"]').val();
        instagramposts.push(temp);

    }

    for (var i = 0; i < selectedusers.length; i++) {
        var temp = $('.facebookinput[data-id="' + selectedusers[i] + '"]').val();
        facebookposts.push(temp);

    }

    for (var i = 0; i < selectedusers.length; i++) {
        var temp = $('.twitterinput[data-id="' + selectedusers[i] + '"]').val();
        twitterposts.push(temp);

    }





    $.ajax({
        type: 'POST',
        url: '/includes/ajax/recalculate.php',
        data: {
            campaignname : campaignName,
            campaigndescription: campaignDescription,
            instagramtotal: instagramtotal,
            facebooktotal: facebooktotal,
            twittertotal: twittertotal,
            instagramposts: instagramposts,
            facebookposts: facebookposts,
            twitterposts: twitterposts,
            selectedusers: selectedusers
        },
        success: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);


        }

    }); // end ajax request*/

});