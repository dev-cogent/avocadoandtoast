
/*  
*
*Start Facebook Sliders
*/
var facebookslider = document.getElementById('slider-facebook');
noUiSlider.create(facebookslider, {
    start: [0, 110000000],
    connect: true,
    range: {
        'min': 0,
        '50%':[1000000],
        'max': 110000000
    },
    format: wNumb({
        decimals: 0
    })
});


var facebookEngagementslider = document.getElementById('slider-facebook-engagement');
noUiSlider.create(facebookEngagementslider, {
    start: [0, 110000000],
    connect: true,
    range: {
        'min': 0,
        '50%':[1000000],
        'max': 110000000
    },
    format: wNumb({
        decimals: 0
    })
});


/*  
*
*Start Instagram Sliders
*/

var instagramslider = document.getElementById('slider-instagram');
noUiSlider.create(instagramslider, {
    start: [0, 110000000],
    step:1000,
    connect: true,
    range: {
        'min': 0,
        '50%':[1000000],
        'max': 110000000
    },
    format: wNumb({
        decimals: 0
    })
});

var instagramEngagementslider = document.getElementById('slider-instagram-engagement');
noUiSlider.create(instagramEngagementslider, {
    start: [0, 110000000],
    step:1000,
    connect: true,
    range: {
        'min': 0,
        '50%':[1000000],
        'max': 110000000
    },
    format: wNumb({
        decimals: 0
    })
});

/**
 * 
 * Start Twitter Slider 
 * 
 */
var twitterslider = document.getElementById('slider-twitter');
noUiSlider.create(twitterslider, {
    start: [0, 110000000],
    connect: true,
    range: {
        'min': 0,
        '50%':[1000000],
        'max': 110000000
    },
    format: wNumb({
        decimals: 0
    })
});


var twitterengagementslider = document.getElementById('slider-twitter-engagement');
noUiSlider.create(twitterengagementslider, {
    start: [0, 110000000],
    connect: true,
    range: {
        'min': 0,
        '50%':[1000000],
        'max': 110000000
    },
    format: wNumb({
        decimals: 0
    })
});



/*
*
*End inititalizing sliders 
*
*/

/*Total Inputs */

/*instagram Inputs */
var input2 = document.getElementById('min-instagram');//instagram
var input3 = document.getElementById('max-instagram');//instagram 
var input4 = document.getElementById('min-twitter');//twitter
var input5 = document.getElementById('max-twitter');//twitter 
var input6 = document.getElementById('min-facebook');//facebook
var input7 = document.getElementById('max-facebook');//facebook
//engagement for each platofmr 
var input8 = document.getElementById('min-instagram-engagement');//instagram
var input9 = document.getElementById('max-instagram-engagement');//instagram 
var input10 = document.getElementById('min-twitter-engagement');//instagram
var input11= document.getElementById('max-twitter-engagement');//instagram 
var input12 = document.getElementById('min-facebook-engagement');//facebook
var input13= document.getElementById('max-facebook-engagement');//facebook

/*inititalizing input arrays */
var inputsfacebook = [input6, input7]; //total 
var inputsinstagram = [input2, input3]; // instagram 
var inputstwitter = [input4,input5];
var inputsinstagramEngagement = [input8,input9];
var inputstwitterEngagement = [input10,input11];
var inputsfacebookEngagement = [input12,input13];

/*inititalizing all sluders with input fields */
//Total 

//Twitter 
facebookslider.noUiSlider.on('update', function (values, handle) {
    inputsfacebook[handle].value = values[handle];

    var max = Math.floor($('#max-facebook').val());
    var displayMax = abbrNum(max);
    var min = Math.floor($('#min-facebook').val());
    var displayMin = abbrNum(min);
    var checkMax = typeof (displayMax);
    var checkMin = typeof (displayMin);
    if (checkMax != 'string') {
        $('#min-facebook').val(displayMin);
        $('#min-facebook').attr('data-number',min);
        /*filters['max'] = $('#max-facebook').attr('data-number');
        filters['min'] =  min;
        filters['platform'] = 'facebook';*/
    }
    if (checkMin != 'string') {
        $('#max-facebook').val(displayMax);
        $('#max-facebook').attr('data-number',max);
        /*filters['max'] = max;
        filters['min'] =  $('#min-facebook').attr('data-number');
        filters['platform'] = 'facebook';*/
    }
    //console.log(filters);

});

facebookEngagementslider.noUiSlider.on('update', function (values, handle) {
    inputsfacebookEngagement[handle].value = values[handle];

    var max = Math.floor($('#max-facebook-engagement').val());
    var displayMax = abbrNum(max);
    var min = Math.floor($('#min-facebook-engagement').val());
    var displayMin = abbrNum(min);
    var checkMax = typeof (displayMax);
    var checkMin = typeof (displayMin);
    if (checkMax != 'string') {
        $('#min-facebook-engagement').val(displayMin);
        $('#min-facebook-engagement').attr('data-number',min);
        /*filters['max'] = $('#max-facebook-engagement').attr('data-number');
        filters['min'] =  min;
        filters['platform'] = 'facebook';*/
    }
    if (checkMin != 'string') {
        $('#max-facebook-engagement').val(displayMax);
        $('#max-facebook-engagement').attr('data-number',max);
        /*filters['max'] = max;
        filters['min'] =  $('#min-facebook-engagement').attr('data-number');
        filters['platform'] = 'facebook';*/
    }
    //console.log(filters);

});










//Instagram 
instagramslider.noUiSlider.on('update', function (values, handle) {
    inputsinstagram[handle].value = values[handle];
    var max = Math.floor($('#max-instagram').val());
    var displayMax = abbrNum(max);
    var min = Math.floor($('#min-instagram').val());
    var displayMin = abbrNum(min);
    var checkMax = typeof (displayMax);
    var checkMin = typeof (displayMin);
    if (checkMax != 'string') {
        $('#min-instagram').val(displayMin);
        $('#min-instagram').attr('data-number',min);
        /*filters['max'] = $('#max-instagram').attr('data-number');
        filters['min'] =  min;
        filters['platform'] = 'instagram';*/
    }
    if (checkMin != 'string') {
        $('#max-instagram').val(displayMax);
        $('#max-instagram').attr('data-number',max);
        /*filters['max'] = max;
        filters['min'] =  $('#min-instagram').attr('data-number');
        filters['platform'] = 'instagram';*/
    }
    //console.log(filters);


});


instagramEngagementslider.noUiSlider.on('update', function (values, handle) {
    inputsinstagramEngagement[handle].value = values[handle];
    var max = Math.floor($('#max-instagram-engagement').val());
    var displayMax = abbrNum(max);
    var min = Math.floor($('#min-instagram-engagement').val());
    var displayMin = abbrNum(min);
    var checkMax = typeof (displayMax);
    var checkMin = typeof (displayMin);
    if (checkMax != 'string') {
        $('#min-instagram-engagement').val(displayMin);
        $('#min-instagram-engagement').attr('data-number',min);
        /*filters['max'] = $('#max-instagram-engagement').attr('data-number');
        filters['min'] =  min;
        filters['platform'] = 'instagram';*/
    }
    if (checkMin != 'string') {
        $('#max-instagram-engagement').val(displayMax);
        $('#max-instagram-engagement').attr('data-number',max);
        /*filters['max'] = max;
        filters['min'] =  $('#min-instagram-engagement').attr('data-number');
        filters['platform'] = 'instagram';*/
    }

});


//Twitter 
twitterslider.noUiSlider.on('update', function (values, handle) {
    inputstwitter[handle].value = values[handle];
    var max = Math.floor($('#max-twitter').val());
    var displayMax = abbrNum(max);
    var min = Math.floor($('#min-twitter').val());
    var displayMin = abbrNum(min);
    var checkMax = typeof (displayMax);
    var checkMin = typeof (displayMin);
    if (checkMax != 'string') {
        $('#min-twitter').val(displayMin);
        $('#min-twitter').attr('data-number',min);
        /*filters['max'] = $('#max-twitter').attr('data-number');
        filters['min'] =  min;
        filters['platform'] = 'twitter';*/
    }
    if (checkMin != 'string') {
        $('#max-twitter').val(displayMax);
        $('#max-twitter').attr('data-number',max);
        /*filters['max'] = max;
        filters['min'] =  $('#min-twitter').attr('data-number');
        filters['platform'] = 'twitter';*/
    }
    console.log(filters);

});


twitterengagementslider.noUiSlider.on('update', function (values, handle) {
    inputstwitterEngagement[handle].value = values[handle];
    var max = Math.floor($('#max-twitter-engagement').val());
    var displayMax = abbrNum(max);
    var min = Math.floor($('#min-twitter-engagement').val());
    var displayMin = abbrNum(min);
    var checkMax = typeof (displayMax);
    var checkMin = typeof (displayMin);
    if (checkMax != 'string') {
        $('#min-twitter-engagement').val(displayMin);
        $('#min-twitter-engagement').attr('data-number',min);
        /*filters['max'] = $('#max-twitter-engagement').attr('data-number');
        filters['min'] =  min;
        filters['platform'] = 'twitter';*/
    }
    if (checkMin != 'string') {
        $('#max-twitter-engagement').val(displayMax);
        $('#max-twitter-engagement').attr('data-number',max);
        /*filters['max'] = max;
        filters['min'] =  $('#min-twitter-engagement').attr('data-number');
        filters['platform'] = 'twitter';*/
    }

});

/*
*
*Declaring all set slider handler functions. 
*
*
*/
//Total 
//Facebook
function setSliderHandleFacebook(i, value) {
    var r = [null, null];
    r[i] = value;
    facebookslider.noUiSlider.set(r);
}


function setSliderHandleFacebookEngagement(i, value) {
    var r = [null, null];
    r[i] = value;
    facebookEngagementslider.noUiSlider.set(r);
}

function setSliderHandleInstagram(i, value) {
    var r = [null, null];
    r[i] = value;
    instagramslider.noUiSlider.set(r);
}

function setSliderHandleInstagramEngagement(i, value) {
    var r = [null, null];
    r[i] = value;
    instagramEngagementslider.noUiSlider.set(r);
}

function setSliderHandleTwitter(i, value) {
    var r = [null, null];
    r[i] = value;
    twitterslider.noUiSlider.set(r);
}


function setSliderHandleTwitterEngagement(i, value) {
    var r = [null, null];
    r[i] = value;
    twitterengagementslider.noUiSlider.set(r);
}





//Facebook


// Listen to keydown events on the input field.
inputsfacebook.forEach(function (input, handle) {
    input.addEventListener('change', function () {
        setSliderHandleFacebook(handle, this.value);
    });
    input.addEventListener('keydown', function (e) {
        var values = facebookslider.noUiSlider.get();
        var value = Number(values[handle]);
        var steps = facebookslider.noUiSlider.steps();
        var step = steps[handle];
        var position;
        switch (e.which) {
            case 13:
                setSliderHandleFacebook(handle, this.value);
                break;
            case 38:
                position = step[1];
                if (position === false) position = 1;
                if (position !== null) setSliderHandleFacebook(handle, value + position);
                break;
            case 40:
                position = step[0];
                if (position === false) position = 1;
                if (position !== null) setSliderHandleFacebook(handle, value - position);
                break;
        }
    });
});



inputsfacebookEngagement.forEach(function (input, handle) {
    input.addEventListener('change', function () {
        setSliderHandleFacebook(handle, this.value);
    });
    input.addEventListener('keydown', function (e) {
        var values = facebookEngagementslider.noUiSlider.get();
        var value = Number(values[handle]);
        var steps = facebookEngagementslider.noUiSlider.steps();
        var step = steps[handle];
        var position;
        switch (e.which) {
            case 13:
                setSliderHandleFacebookEngagement(handle, this.value);
                break;
            case 38:
                position = step[1];
                if (position === false) position = 1;
                if (position !== null) setSliderHandleFacebookEngagement(handle, value + position);
                break;
            case 40:
                position = step[0];
                if (position === false) position = 1;
                if (position !== null) setSliderHandleFacebookEngagement(handle, value - position);
                break;
        }
    });
});






// Listen to keydown events on the input field.
inputsinstagram.forEach(function (input, handle) {
    input.addEventListener('change', function () {
        setSliderHandleInstagram(handle, this.value);
    });
    input.addEventListener('keydown', function (e) {
        var values = instagramslider.noUiSlider.get();
        var value = Number(values[handle]);
        var steps = instagramslider.noUiSlider.steps();
        var step = steps[handle];
        var position;
        switch (e.which) {
            case 13:
                setSliderHandleInstagram(handle, this.value);
                break;
            case 38:
                position = step[1];
                if (position === false) position = 1;
                if (position !== null) setSliderHandleInstagram(handle, value + position);
                break;
            case 40:
                position = step[0];
                if (position === false) position = 1;
                if (position !== null) setSliderHandleInstagram(handle, value - position);
                break;
        }
    });
});



inputsinstagramEngagement.forEach(function (input, handle) {
    input.addEventListener('change', function () {
        setSliderHandleInstagramEngagement(handle, this.value);
    });
    input.addEventListener('keydown', function (e) {
        var values = instagramEngagementslider.noUiSlider.get();
        var value = Number(values[handle]);
        var steps = instagramEngagementslider.noUiSlider.steps();
        var step = steps[handle];
        var position;
        switch (e.which) {
            case 13:
                setSliderHandleInstagramEngagement(handle, this.value);
                break;
            case 38:
                position = step[1];
                if (position === false) position = 1;
                if (position !== null) setSliderHandleInstagramEngagement(handle, value + position);
                break;
            case 40:
                position = step[0];
                if (position === false) position = 1;
                if (position !== null) setSliderHandleInstagramEngagement(handle, value - position);
                break;
        }
    });
});

inputstwitter.forEach(function (input, handle) {
    input.addEventListener('change', function () {
        setSliderHandleTwitter(handle, this.value);
    });
    input.addEventListener('keydown', function (e) {
        var values = twitterslider.noUiSlider.get();
        var value = Number(values[handle]);
        var steps = twitterslider.noUiSlider.steps();
        var step = steps[handle];
        var position;
        switch (e.which) {
            case 13:
                setSliderHandleTwitter(handle, this.value);
                break;
            case 38:
                position = step[1];
                if (position === false) position = 1;
                if (position !== null) setSliderHandleTwitter(handle, value + position);
                break;
            case 40:
                position = step[0];
                if (position === false) position = 1;
                if (position !== null) setSliderHandleTwitter(handle, value - position);
                break;
        }
    });
});





inputstwitterEngagement.forEach(function (input, handle) {
    input.addEventListener('change', function () {
        setSliderHandleTwitterEngagement(handle, this.value);
    });
    input.addEventListener('keydown', function (e) {
        var values = twitterengagementslider.noUiSlider.get();
        var value = Number(values[handle]);
        var steps = twitterengagementslider.noUiSlider.steps();
        var step = steps[handle];
        var position;
        switch (e.which) {
            case 13:
                setSliderHandleTwitterEngagement(handle, this.value);
                break;
            case 38:
                position = step[1];
                if (position === false) position = 1;
                if (position !== null) setSliderHandleTwitterEngagement(handle, value + position);
                break;
            case 40:
                position = step[0];
                if (position === false) position = 1;
                if (position !== null) setSliderHandleTwitterEngagement(handle, value - position);
                break;
        }
    });
});



