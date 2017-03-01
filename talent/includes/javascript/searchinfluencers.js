var users = [];
$(document).on('keyup','#influencers',function(){
    var search = $(this).val();
    //this is clear the content box when the input field is empty. 
    if(search.length == 0){
       $('#content').empty();
       return 0; 
    }
        
    $.ajax({
        type: 'POST',
        url: '/includes/ajax/search.php',  
        data: {
        search: search
            },
        success: function (jqXHR, textStatus, errorThrown) {
        $('#testing').empty();
        $('#testing').append(jqXHR);
       //$('#content').empty();
       //$('#content').append(jqXHR);
        }
    }); // end ajax request*/

});


$(document).on('click','.user',function(){
    var number = parseInt($('#number').text());
    number += 1;
    $('#number').text(number);
    $('#content').empty();
    $('#influencers').val('');
    var image = $(this).attr('data-img');
    var user = $(this).text();
    var id = $(this).attr('data-id');
    var url = '<div class="added col-sm-1" data-id="'+id+'" ><div class="example" ><img class="img-circle" width="50" height="50" src="https://project.social/'+image+'" onerror="this.src=`https://project.social/images/ps-square.jpg`" alt="..."> </div></div>';
    $('#search').append(url);
    users.push(id);


});

$(document).on('dblclick','.added',function(){
    var id = $(this).attr('data-id');
    var number = parseInt($('#number').text());
    number -= 1;
    $('#number').text(number);
    var index = users.indexOf(id);
    if (index > -1) {
        users.splice(index, 1);
    }
    $(this).remove();
    console.log(users);


});



$(document).on('click','#next',function(){
    console.log(users);
        $.ajax({
        type: 'POST',
        url: '/includes/ajax/sessioncreate.php',  
        data: {
        users:users
            },
        success: function (jqXHR, textStatus, errorThrown) {
        location.href='/campaign-posts.php';
        }
    }); // end ajax request*/



});


$(document).on('click','#createcampaign',function(){

dialog = bootbox.dialog({
message: '<label>Campaign Name: <input placeholder="name campaign (optional)" id="campaignname"><br>'+

            '<input id="submitcampaign" name="send" class=" btn btn_blue_black submit_btn" value="Save Camapign">',
closeButton: true
});
// do something in the background
dialog.modal();

}); // end ajax request*/


$(document).on('click','#submitcampaign',function(){
const campaignname = $('#campaignname').val();
        $.ajax({
        type: 'POST',
        url: '/includes/ajax/createcampaign.php',  
        data: {
        campaignname: campaignname,
        users:users
        },
        success: function (jqXHR, textStatus, errorThrown) {
            dialog.modal('hide');
            bootbox.alert('Your campaign has been created!');
            setTimeout(function(){
                location.reload();
            }, 2000);
        }
    }); // end ajax request*/  
});



