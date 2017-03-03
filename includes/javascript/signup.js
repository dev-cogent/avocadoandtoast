//check for password 
$(document).on('focusout', 'input[name="password"]', function () {
    passwordCheck();
    verifyPassword();

});

//Function for check password
function passwordCheck(e = null) {
    if ($('input[name="password"]').val().length < 6) {
        $('#password-error').css('visibility', 'visible');
        if(!e) return false;
        else return e.preventDefault();
    }
    else {
        $('#password-error').css('visibility', 'hidden');
        return true;
    }

}




//Check verify password 
$(document).on('focusout', 'input[name="confirm"]', function () {
    verifyPassword();
});

//Function for verify password
function verifyPassword(e = null){
    if ($('input[name="confirm"]').val() != $('input[name="password"]').val()) {
        $('#confirm-error').css('visibility', 'visible');
        if(!e) return false;
        else return e.preventDefault();
    }
    else {
        $('#confirm-error').css('visibility', 'hidden');
        return true;
    }
}


//check if email is correct 
$(document).on('focusout','input[name="email"]' , function () {
    checkEmail();
});

function checkEmail(e = null){
    var email = $('input[name="email"]').val();
    email = email.trim();
    if ((email == '' || email == ' ') || (email.includes('@') == false)) {
        $('#email-error').css('visibility', 'visible');
        if(!e) return false;
        else return e.preventDefault();
    }
    else {
        $('#email-error').css('visibility', 'hidden');
        return true;
    }
}




//check if company is correct 
$(document).on('focusout', 'input[name="company"]', function () {
    checkCompany();
});


function checkCompany(e = null){
    var company = $('input[name="company"]').val();
    company = company.trim();
    if (company == '' || company == ' ') {
        $('#company').css('visibility', 'visible');
        if(!e) return false;
        else return e.preventDefault();
    }
    else {
        $('#company').css('visibility', 'hidden');
        return true;
    }

}


$(document).on('focusout', 'input[name="firstname"]', function () {
    checkFirstName();
});


function checkFirstName(e = null){
    var name = $('input[name="firstname"]').val();
    name = name.trim();
    if (name == '' || name == ' ') {
        $('#first-error').css('visibility', 'visible');
        if(!e) return false;
        else return e.preventDefault();
    }
    else {
        $('#first-error').css('visibility', 'hidden');
        return true;
    }
}


    $(document).on('focusout', 'input[name="lastname"]', function () {
        checklastName();
    });


function checklastName(e = null ) {
        var name = $('input[name="lastname"]').val();
        name = name.trim();
        if (name == '' || name == ' ') {
            $('#last-error').css('visibility', 'visible');
            if(!e) return false;
            else return e.preventDefault();
        }
        else {
            $('#last-error').css('visibility', 'hidden');
            return true;
        }

}

$("form").submit(function (e) {

    checklastName(e);
    checkCompany(e);
    checkFirstName(e);
    checklastName(e)
    passwordCheck(e);
    verifyPassword(e);
    //e.preventDefault();
    

});
