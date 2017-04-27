$(document).ready(function(){
        $.ajax({
            type: 'POST', 
            url: '/php/ajax/getCampaignInfo.php',
            data: {
                campaignid: campaignid
            },
            success: function (jqXHR, textStatus, errorThrown) {
                campaignJSON = JSON.parse(jqXHR);
                $('#edit-campaign-name').append(campaignJSON.campaignname);
                $('#name').val(campaignJSON.campaignname);
                $('#campaign-summary').val(campaignJSON.description);
                $('#campaign-request').val(campaignJSON.campaignrequest);
                $('#campaign-start').val(campaignJSON.campaignstart);
                $('#campaign-end').val(campaignJSON.campaignend);
                $('#brand-name').val(campaignJSON.brandname);
        } // end ajax request*/

    });


});


$(document).on('click','#submit-campaign',function(){
    const campaignname = $('#name').val();
    const campaignsummary = $('#campaign-summary').val();
    const campaignrequest = $('#campaign-request').val();
    const campaignstart = $('#campaign-start').val();
    const campaignend = $('#campaign-end').val();
    const brandname = $('#brand-name').val();
    $.ajax({
        type: 'POST',
        url: '/php/ajax/updatecampaign.php',
        data: {
            campaignid : campaignid,
            campaignname: campaignname,
            campaignsummary: campaignsummary,
            campaignrequest:campaignrequest,
            campaignstart:campaignstart,
            campaignend:campaignend,
            brandname:brandname
        },
        success: function (jqXHR, textStatus, errorThrown) {
            dialog = bootbox.dialog({
                message: '<div class="bootbox-body">'+
            '<div class="icon-popup-div"> <img src="https://68.media.tumblr.com/0abd1f3bfd0a2594ea81787691cb6af2/tumblr_o33ti7IZMI1t4twpao1_500.gif" class="success-popup-icon"/> </div>'+
            '<div class="row"> <div class="col-xs-12 popup-detail success"> <br/> Your campaign has been edited. </div><div class="popup-btn-div"> <a href="/campaigns/?id='+campaignid+'"><button id="applyall" class="submit-btn" style="margin-bottom: 50px;">VIEW CAMPAIGN </button></a></div>'+
            '</div> </div>',
                closeButton: true
            });
            dialog.modal();

        }

    }); // end ajax request*/

});


$(document).on('click','#delete-campaign',function(){
        $.ajax({
        type: 'POST',
        url: '/php/ajax/deletecampaign.php',
        data: {
            campaignid : campaignid,
        },
        success: function (jqXHR, textStatus, errorThrown) {
            dialog = bootbox.dialog({
                message: '<div class="bootbox-body">'+
            '<div class="icon-popup-div"> <img src="https://68.media.tumblr.com/0abd1f3bfd0a2594ea81787691cb6af2/tumblr_o33ti7IZMI1t4twpao1_500.gif" class="success-popup-icon"/> </div>'+
            '<div class="row"> <div class="col-xs-12 popup-detail success"> <br/> Your campaign has been deleted. </div><div class="popup-btn-div"> <a href="/dashboard.php"><button id="applyall" class="submit-btn" style="margin-bottom: 50px;">VIEW CAMPAIGNS </button></a></div>'+
            '</div> </div>',
                closeButton: true
            });
            dialog.modal();

        }

    }); // end ajax request*/

});