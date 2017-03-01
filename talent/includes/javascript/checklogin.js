
$(document).on('click','.login',function(){
    var check = "";
    var site = $(this).attr('data-href');
    $.ajax({
    async: false,
    type: 'POST',
    url: '/includes/ajax/checkaccount.php',
    success: function (jqXHR, textStatus, errorThrown) {
        check = jqXHR;
    }
    }); // end ajax request*/
    if(check == 0){
        swal("Oops", "You need to be logged in to do that.", "warning");
        return 0;
    }
    else
        location.href=site;
    });


if( $("#xs-check").is(":visible") )
    $("#collapsible").removeClass("in");
