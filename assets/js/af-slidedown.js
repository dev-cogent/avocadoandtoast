$(document).ready(function() {
  addAFLinkHandler();
  addPlatformChangeHandler();
  addRangeSliders();
  addRangeButtonHandlers();
})

var afShowing = false;
var slideSpeed = 333;

function addAFLinkHandler() {
  $('#af-link').click(function() {
    if(afShowing) {
      $('#af-slidedown').slideUp(slideSpeed, function() {afShowing = false})
    } else {
      $('#af-slidedown').slideDown(slideSpeed, function() {afShowing = true})
    }
  })
}

function addPlatformChangeHandler() {
  $('#af-icon-container').children().click(function() {
    $('#af-icon-container').children().removeClass('af-active-icon');
    $(this).addClass('af-active-icon');
  })
}

function disabbreviate(string) {
  var lastLetter = string[string.length - 1].toLowerCase();
  var multiplier = 1;
  if (lastLetter == "k") {
    multiplier = 1000;
  } else if (lastLetter == "m"){
    multiplier = 1000000;
  }

  if(lastLetter == "%") {
    string = string.substring(0, string.length - 1);
  }
  return parseFloat(string) * multiplier;
}

function addRangeInputs(slider, category) {
  var val1, val2;
  $('#num-' + category + '1').change(function() {
    console.log(disabbreviate($(this).val()));
    val1 = disabbreviate($(this).val());
    val2 = disabbreviate($('#num-' + category + '2').val());
    slider.slider( "option", "values", [ val1, val2 ] );
  })
  $('#num-' + category + '2').change(function() {
    val1 = disabbreviate($('#num-' + category + '1').val());
    val2 = disabbreviate($(this).val());
    slider.slider( "option", "values", [ val1, val2 ] );
  })
}

function addRangeSliders() {
  var followerSlider = $('#follower-range').slider({
    range: true,
    min: 0,
    max: 300000000,
    values: [0, 300000000],
    slide: function(event, ui) {
      $( "#num-followers1" ).val(abbrNum(ui.values[ 0 ]));
      $( "#num-followers2" ).val(abbrNum(ui.values[ 1 ]));
    }
  })
  $( "#num-followers1" ).val(abbrNum($( "#follower-range" ).slider( "values", 0 )));
  $( "#num-followers2" ).val(abbrNum($( "#follower-range" ).slider( "values", 1 )));

  addRangeInputs(followerSlider, 'followers');

  var engagementSlider = $('#engagement-range').slider({
    range: true,
    min: 0,
    max: 10,
    step: 0.01,
    values: [0, 10],
    slide: function(event, ui) {
      $( "#num-engagement1" ).val(ui.values[ 0 ] + "%");
      $( "#num-engagement2" ).val(ui.values[ 1 ] + "%");
    }
  })

  $( "#num-engagement1" ).val($( "#engagement-range" ).slider( "values", 0 ) + "%");
  $( "#num-engagement2" ).val($( "#engagement-range" ).slider( "values", 1 ) + "%");
  addRangeInputs(engagementSlider, 'engagement');

}

function addRangeButtonHandlers(){
  //focus out should only work if value has been changed.
    $('#num-followers1, #num-followers2, #num-engagement1, #num-engagement2').focusout(function(){
        setSliderFilters();
    });

      $('#num-followers1, #num-followers2, #num-engagement1, #num-engagement2').keypress(function(e){
          if(e.which == 13){
            setSliderFilters();
          }
      });

      $('.ui-slider-handle').mouseup(function(){
            setSliderFilters();
      });
}




function setSliderFilters(){
  var platform = $('.af-active-icon').attr('data-platform');
  filters['min'] = disabbreviate($('#num-followers1').val());
  filters['max'] = disabbreviate($('#num-followers2').val());
  filters['eng-min'] = disabbreviate($('#num-engagement1').val());
  filters['eng-max'] = disabbreviate($('#num-engagement2').val());
  filters['platform'] = platform;
  applyFilters(filters);

}





function abbrNum(number, decPlaces = 1) {
    if(number < 1000){
        number = parseInt(number);
        return number;
    }
    var orig = number;
    var dec = decPlaces;
    decPlaces = Math.pow(10, decPlaces);
    var abbrev = ["k", "m", "b", "t"];
    for (var i = abbrev.length - 1; i >= 0; i--) {
        var size = Math.pow(10, (i + 1) * 3);
        if (size <= number) {
            var number = Math.round(number * decPlaces / size) / decPlaces;
            if ((number == 1000) && (i < abbrev.length - 1)) {
                number = 1;
                i++;
            }
            number += abbrev[i];
            break;
        }
    }
    return number;
}