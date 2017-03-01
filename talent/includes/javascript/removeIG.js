$(document).ready(function(){
    $('.removeIG').on('click',function(){
    const instagram_id = $(this).attr('id');
        $.ajax({
                type: 'POST',
                url: 'https://project.social/includes/ajax/removeIG.php',  
                data: {
                instagram_id: instagram_id
                      },
                success: function (jqXHR, textStatus, errorThrown) {
                location.reload();

                }
        }); // end ajax request*/
    });

});