
    $('#heart').click(function(){
    const mediaid = $(this).attr('data-id');
    const dataliked = $(this).attr('data-liked');
    const info = $(this);
    console.log(info);
                $.ajax({
                type: 'POST',
                url: '/includes/ajax/like.php',  
                data: {
                mediaid: mediaid,
                dataliked:dataliked
                      },
                success: function (jqXHR, textStatus, errorThrown) {
                if(dataliked === 'false'){
                //change heart color 
                //change data-liked to false;
                info.attr('class', 'icon fa-heart');
                info.css('color','red'); 
                info.attr('data-liked','true');
                var r = /\d+/;
                var s = $('#likecount').text();
                const arr = s.match(r);
                const likecount = parseInt(arr[0]);
                const liketext = likecount + 1 + ' Likes';
                $('#likecount').text(liketext);
                }
                if(dataliked === 'true'){
                info.attr('class','icon fa-heart-o');
                info.css('color','#76838f');
                info.attr('data-liked','false');
                var r = /\d+/;
                var s = $('#likecount').text();
                const arr = s.match(r);
                const likecount = parseInt(arr[0]);
                const liketext = likecount - 1 + ' Likes';
                $('#likecount').text(liketext);                
                }
                }
        }); // end ajax request*/  
    });
