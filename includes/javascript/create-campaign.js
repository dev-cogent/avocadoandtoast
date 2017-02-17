$(document).on('click','#createcampaign',function(){
var name = $('#campaign-name').val();
var arr = {};
for(i = 0; i < selectedusers.length; i++){
    var id = selectedusers[i];
    arr[id] = {};
    arr[id]['instagramposts'] = $('.instagraminput[data-id='+id+']').val();
    arr[id]['facebookposts'] = $('.facebookinput[data-id='+id+']').val();
    arr[id]['twitterposts'] = $('.twitterinput[data-id='+id+']').val();
}



if(name == '' || name == null){
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
        if(jqXHR == 1 || jqXHR == '1'){
            alert('Campaign Has been created!');
        }
    }
}); // end ajax request*/ 






}); 