
var dialog;

$(document).on('click','#save',function(){


    dialog = bootbox.dialog({
    message: '<input placeholder="Name List " id="campaignname">'+
             '<input placeholder="description (optional)" id="description">'+
             '<input id="submit" name="send" class=" btn btn_blue_black submit_btn" value="Save List">',
    closeButton: true
});
// do something in the background
dialog.modal();
});

$(document).on('click','#submit',function(){
const campaignname = $('#campaignname').val();
const description = $('#description').val();
        $.ajax({
        type: 'POST',
        url: '/includes/ajax/savecampaign.php',  
        data: {
        campaignname: campaignname,
        description:description
        },
        success: function (jqXHR, textStatus, errorThrown) {
            dialog.modal('hide');
            bootbox.alert('Your campaign has been saved!');
        }
    }); // end ajax request*/  
});

