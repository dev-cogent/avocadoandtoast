$(document).ready(function(){
        $.ajax({
            type: 'POST', 
            url: '/php/ajax/getCampaignInfo.php',
            data: {
                campaignid: campaignid
            },
            success: function (jqXHR, textStatus, errorThrown) {
                campaignJSON = JSON.parse(jqXHR);
                $('#campaign-name').append(campaignJSON.campaignname);
                $('#campaign-details').val(campaignJSON.description);
                $('#brand-name').val(campaignJSON.brandname);
        } // end ajax request*/

    });


});
