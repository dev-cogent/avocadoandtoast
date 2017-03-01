$(document).ready(function(){
    $(document).on('click','.switch',function(){
    const instagram_id = $(this).attr('id');
            $.ajax({
            type: 'POST',
            url: '../includes/ajax/switchAccounts.php',  
            data: {
            instagram_id: instagram_id
            },
            success: function (jqXHR, textStatus, errorThrown) {
            if(jqXHR !== 'false') 
            location.href='/account.php';
            }   
            }); // end ajax request*/ 
    });
});