var slider = document.getElementById('slider');
noUiSlider.create(slider, {
    start: [0, 100000000],
    connect: true,
    range: {
        'min': 0,
        'max': 100000000
    },
		cssClasses: {
		handle: 'handle',
		handleLower: 'handle-lower',
		handleUpper: 'handle-upper'
	},
		format: wNumb({
		decimals: 0
	})
});


var instagramslider = document.getElementById('slider-instagram');
noUiSlider.create(instagramslider, {
    start: [0, 10000000],
    connect: true,
    range: {
        'min': 0,
        'max': 10000000
    },
	format: wNumb({
		decimals: 0
	})
});


var facebookslider = document.getElementById('slider-facebook');
noUiSlider.create(facebookslider, {
    start: [0, 10000000],
    connect: true,
    range: {
        'min': 0,
        'max': 10000000
    },
		format: wNumb({
		decimals: 0
	})
});

var twitterslider = document.getElementById('slider-twitter');
noUiSlider.create(twitterslider, {
    start: [0, 10000000],
    connect: true,
    range: {
        'min': 0,
        'max': 10000000
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
var input0 = document.getElementById('min-total'); //total 
var input1 = document.getElementById('max-total');//total

/*instagram Inputs */
var input2 = document.getElementById('min-instagram');//instagram
var input3 = document.getElementById('max-instagram');//instagram 

/*Twitter Inputs */
var input4 = document.getElementById('min-twitter');//twitter
var input5 = document.getElementById('max-twitter');//twitter

/*facebook Inputs */
var input6 = document.getElementById('min-facebook');//facebook
var input7 = document.getElementById('max-facebook');//facebook

/*inititalizing input arrays */
var inputs = [input0, input1]; //total 

var inputsinstagram =[input2,input3]; // instagram 

var inputstwitter = [input4,input5]; //twitter 

var inputsfacebook = [input6,input7]; //facebook 

/*inititalizing all sluders with input fields */ 
//Total 

slider.noUiSlider.on('update', function( values, handle ) {
	inputs[handle].value = values[handle];
    var max = abbrNum(Math.floor($('#max-total').val()));
    var min = abbrNum(Math.floor($('#min-total').val()));

    $('#show').text(min+ ' and '+max);
});


//Instagram 
instagramslider.noUiSlider.on('update', function( values, handle ) {
	inputsinstagram[handle].value = values[handle];
    var max = abbrNum(Math.floor($('#max-instagram').val()));
    var min = abbrNum(Math.floor($('#min-instagram').val()));

    $('#showinstagram').text(min+ ' and '+max);
});


//Twitter 
twitterslider.noUiSlider.on('update', function( values, handle ) {
	inputstwitter[handle].value = values[handle];
    var max = abbrNum(Math.floor($('#max-twitter').val()));
    var min = abbrNum(Math.floor($('#min-twitter').val()));

    $('#showtwitter').text(min+ ' and '+max);
});


//Twitter 
facebookslider.noUiSlider.on('update', function( values, handle ) {
	inputsfacebook[handle].value = values[handle];
    var max = abbrNum(Math.floor($('#max-facebook').val()));
    var min = abbrNum(Math.floor($('#min-facebook').val()));

    $('#showfacebook').text(min+ ' and '+max);
});



/*
*
*Declaring all set slider handler functions. 
*
*
*/
//Total 
function setSliderHandle(i, value) {
	var r = [null,null];
	r[i] = value;
	slider.noUiSlider.set(r);
}

//Instagram
function setSliderHandleInstagram(i, value) {
	var r = [null,null];
	r[i] = value;
	instagramslider.noUiSlider.set(r);
}


//Twitter
function setSliderHandleTwitter(i, value) {
	var r = [null,null];
	r[i] = value;
	twitterslider.noUiSlider.set(r);
}


//Facebook
function setSliderHandleFacebook(i, value) {
	var r = [null,null];
	r[i] = value;
	facebookslider.noUiSlider.set(r);
}



// Listen to keydown events on the input field.
inputs.forEach(function(input, handle) {
	input.addEventListener('change', function(){
		setSliderHandle(handle, this.value);
	});
	input.addEventListener('keydown', function( e ) {
		var values = slider.noUiSlider.get();
		var value = Number(values[handle]);
		var steps = slider.noUiSlider.steps();
		var step = steps[handle];
		var position;
		switch ( e.which ) {
			case 13:
				setSliderHandle(handle, this.value);
				break;
			case 38:
				position = step[1];
				if ( position === false ) position = 1;
				if ( position !== null ) setSliderHandle(handle, value + position);
				break;
			case 40:
				position = step[0];
				if ( position === false ) position = 1;
				if ( position !== null ) setSliderHandle(handle, value - position);
				break;
		}
	});
});



// Listen to keydown events on the input field.
inputsinstagram.forEach(function(input, handle) {
	input.addEventListener('change', function(){
		setSliderHandleInstagram(handle, this.value);
	});
	input.addEventListener('keydown', function( e ) {
		var values = slider.noUiSlider.get();
		var value = Number(values[handle]);
		var steps = slider.noUiSlider.steps();
		var step = steps[handle];
		var position;
		switch ( e.which ) {
			case 13:
				setSliderHandleInstagram(handle, this.value);
				break;
			case 38:
				position = step[1];
				if ( position === false ) position = 1;
				if ( position !== null ) setSliderHandleInstagram(handle, value + position);
				break;
			case 40:
				position = step[0];
				if ( position === false ) position = 1;
				if ( position !== null ) setSliderHandleInstagram(handle, value - position);
				break;
		}
	});
});



// Listen to keydown events on the input field.
inputstwitter.forEach(function(inputtwitter, handle) {
	inputtwitter.addEventListener('change', function(){
		setSliderHandleTwitter(handle, this.value);
	});
	inputtwitter.addEventListener('keydown', function( e ) {
		var values = twitterslider.noUiSlider.get();
		var value = Number(values[handle]);
		var steps = twitterslider.noUiSlider.steps();
		var step = steps[handle];
		var position;
		switch ( e.which ) {
			case 13:
				setSliderHandleTwitter(handle, this.value);
				break;
			case 38:
				position = step[1];
				if ( position === false ) {
					position = 1;
				}
				if ( position !== null ) {
					setSliderHandleTwitter(handle, value + position);
				}
				break;
			case 40:
				position = step[0];
				if ( position === false ) {
					position = 1;
				}
				if ( position !== null ) {
					setSliderHandleTwitter(handle, value - position);
				}
				break;
		}
	});
});




// Listen to keydown events on the input field.
inputsfacebook.forEach(function(input, handle) {
	input.addEventListener('change', function(){
		setSliderHandleFacebook(handle, this.value);
	});
	input.addEventListener('keydown', function( e ) {
		var values = slider.noUiSlider.get();
		var value = Number(values[handle]);
		var steps = slider.noUiSlider.steps();
		var step = steps[handle];
		var position;
		switch ( e.which ) {
			case 13:
				setSliderHandleFacebook(handle, this.value);
				break;
			case 38:
				position = step[1];
				if ( position === false ) position = 1;
				if ( position !== null ) setSliderHandleFacebook(handle, value + position);
				break;
			case 40:
				position = step[0];
				if ( position === false ) position = 1;
				if ( position !== null ) setSliderHandleFacebook(handle, value - position);
				break;
		}
	});
});