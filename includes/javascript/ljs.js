    $(document).ready(function(){
    function callInfo(){
    var email = $('#username').val();
    var password = $('#password').val();
         $.ajax({
                type: 'POST',
                url: 'https://project.social/includes/ajax/verify.php',  
                data: {
                email:  email,
                password : password
                      },
                success: function (jqXHR, textStatus, errorThrown) {
                if(jqXHR == "good"){
                window.location.href="https://project.social/campaign-calculator";  
                }
                else if(jqXHR != "bad"){
                $('#info').empty();
                $('#info').append('<p class="error-block">'+jqXHR+'</p>');
                $('#user').append('<p class="error-block">Please enter a valid email</p>');
                $('#pass').append('<p class="error-block">Please enter a valid password</p>');
                }
                else if(jqXHR == "bad"){
                $('#user').append('<p class="error-block">Please enter a valid email</p>');
                $('#pass').append('<p class="error-block">Please enter a valid password</p>');

                }
                }
        }); // end ajax request*/



    }

    $('#login').click(function(){
    callInfo();
    });

    $(document).keypress(function(e){
        if(e.which == 13){
        callInfo();    
        }

    });

});