var users = [];
$(document).on('keyup','#influencers',function(){
    var search = $(this).val();
    $.ajax({
        type: 'POST',
        url: '/includes/ajax/search.php',  
        data: {
        search: search
            },
        success: function (jqXHR, textStatus, errorThrown) {
       $('#content').empty();
       $('#content').append(jqXHR);
        }
    }); // end ajax request*/

});


$(document).on('click','.user',function(){
    var number = parseInt($('#number').text());
    number += 1;
    $('#number').text(number);
    $('#content').empty();
    var image = $(this).attr('data-img');
    var user = $(this).text();
    var id = $(this).attr('data-id');
    var url = '<div class="col-sm-1"><div class="example" ><img class="img-circle" width="50" height="50" src="'+image+'" onerror="this.src=`/images/ps-square.jpg`" alt="..."> </div></div>';
    $('#search').append(url);
    users.push(id);
    console.log(users);


});

$(document).on('click','#next',function(){
        $.ajax({
        type: 'POST',
        url: '/includes/ajax/sessioncreate.php',  
        data: {
        users:users
            },
        success: function (jqXHR, textStatus, errorThrown) {
        location.href='https://project.social/campaign-posts.php';
        }
    }); // end ajax request*/



});