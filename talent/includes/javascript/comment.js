$('#comment').keypress(function(e){
    if(e.which == 13){
        const comment = $(this).val();
        const mediaid = $(this).attr('data-id');
        $.ajax({
        type: 'POST',
        url: '/includes/ajax/comment.php',  
        data: {
        mediaid: mediaid,
        comment:comment
                },
        success: function (jqXHR, textStatus, errorThrown) {
        //Need to find a way to make the lightbox reload without having to append data. 
        $('#comment-content').append(comment);
        $('#comment').val('');
        }
      }); // end ajax request*/  
    }
});



$(document).on('click','.delete',function(){
    console.log('deleting');
    const commentid = $(this).attr('data-id');
    const mediaid = $(this).attr('data-media');
    const comment = $(this);
        $.ajax({
        type: 'POST',
        url: '/includes/ajax/comment.php',  
        data: {
        mediaid: mediaid,
        commentid:commentid,
        delete: 'true'
                },
        success: function (jqXHR, textStatus, errorThrown) {
        comment.parent().remove();
        var r = /\d+/;
        var s = $('#commentcount').text();
        const arr = s.match(r);
        const commentcount = parseInt(arr[0]);
        const commenttext = commentcount - 1 + ' commnets';
        $('#commentcount').text(commenttext);
        // we can remove comment from ajax if successful. 
        }
      }); // end ajax request*/  


});


$(document).on('keypress','#managecomment',function(e){
    if(e.which == 13){
        const comment = $(this).val();
        const mediaid = $(this).attr('data-id');
        $.ajax({
        type: 'POST',
        url: '/includes/ajax/comment.php',  
        data: {
        mediaid: mediaid,
        comment:comment
                },
        success: function (jqXHR, textStatus, errorThrown) {
        //Need to find a way to make the lightbox reload without having to append data. 
        $('#comment-content').append(comment);
        $('#comment').val('');
        }
      }); // end ajax request*/  
    }
});
