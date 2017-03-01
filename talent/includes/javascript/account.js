function checkLogin(){
    var check = "";
    $.ajax({
    async: false,
    type: 'POST',
    url: '/includes/ajax/checkaccount.php',  
    success: function (jqXHR, textStatus, errorThrown) {
        check = jqXHR;
    }   
    }); // end ajax request*/    
    return check;
}