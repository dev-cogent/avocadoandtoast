  $(document).on('click','#getPassword',function(){
    $.ajax({
        type: 'POST',
        url: '/html/ajax/getPassword.html',
        success: function (jqXHR, textStatus, errorThrown) {
            $('.input-container').empty();
            $('.input-container').append(jqXHR);
        }
    }); // end ajax request*/
  });
  $(document).on('click','#getProfile',function(){
    $.ajax({
        type: 'POST',
        url: '/php/ajax/getProfile.php',
        success: function (jqXHR, textStatus, errorThrown) {
            $('.input-container').empty();
            $('.input-container').append(jqXHR);
        }
    }); // end ajax request*/
  });

    $(document).on('click','#logout',function(){
    $.ajax({
        type: 'POST',
        url: '/logout.php',
        success: function (jqXHR, textStatus, errorThrown) {
            window.location.href="/";
        }
    }); // end ajax request*/
  });