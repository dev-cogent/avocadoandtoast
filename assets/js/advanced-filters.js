$(document).ready(function() {

  resetButton();
  // enableTooltips();
  socialPlatforms();
  categoryDropdowns();
  reachChecks();
  engagementInputs();
  genderChecks();
  locationInput();
  filterScroll();

})


const CATEGORY_RANGES = {
  celeb: [250000000, 100000000, 5000000, 1000000],
  macro: [500000, 400000, 300000, 25000, 20000, 15000, 10000],
  micro: [50000, 40000, 30000, 20000, 10000, 5000, 2000, 30, 20, 10]
}

var platformsSelected = [];
var categorySelected;
var rangesSelected = { celeb: null, macro: null, micro: null };
var engagement = {min:0, max: 10.00}
var genderSelected = [];
var loc;

function resetButton() {
  $('#reset-button').click(function() {
    platformsSelected = [];
    engagement = {min:0, max: 10.00};
    categorySelected, genderSelected, loc = null;
    $('.af-platform').each(function() {
      $(this).removeClass('selected');
    })
    $('.influencer-category').each(function() {
      $(this).removeClass('selected');
      slide(this, 'up');
    })
    $('#engagement-min').val('0.00');
    $('#engagement-max').val('10.00');
    $('.gender-block').each(function() {
      $(this).removeClass('checked');
    })
    $('#location-input').val('');

    tempKeywords = filters['keywords'];
    filters = {
      engagement:{
        min:0,
        max:10
      },
      followers:{
        min:1,
        max:1000000000
      }
    };
    filters['keywords'] = tempKeywords;
    applyFilters(filters);
    resetRanges();
  })
}




function filterScroll(){
  var target = $('#af-container').offset().top;
  var navHeight = $('.avocado-nav-spacing').height();
  target = (target - navHeight) - 7;
  $(window).scroll(function () {

      if (document.body.scrollTop > target) {
          $('#af-container').css('position', 'fixed');
          $('#af-container').css('margin-top', '-370px');
      }
      else {
          $('#af-container').css('position', 'absolute');
          $('#af-container').css('margin-top', '0px');
      }

  });
}

function resetRanges() {
  for (var category in CATEGORY_RANGES) {
    var range = CATEGORY_RANGES[category]
    var highestInRange = range[range.length - 1];
    rangesSelected[category] = highestInRange;
  }
  $('.category-options').each(function() {
    $(this).children().each(function() {
      $(this).removeClass('checked');
    })
    $(this).children().last().addClass('checked');
  })
}

function socialPlatforms() {
  $('.af-platform').click(function() {
    var thisPlatform = $(this).attr('data-platform');
    if (!$(this).hasClass('selected')) {
      $(this).addClass('selected');
      platformsSelected.push(thisPlatform);
    } else {
      $(this).removeClass('selected');
      platformsSelected = platformsSelected.filter(function(el) {
        return el !== thisPlatform;
      })
    }
    filterPlatforms();
  })
}

 function filterPlatforms (){
  filters['platform'] = platformsSelected;
  applyFilters(filters);
}

function enableTooltips() {
  var tipCreated = false;
  var tooltip;
  $('.influencer-category')
    .mouseover(function(){
      if (!tipCreated) {
        var text = $(this).attr('data-tip');
        tooltip = $('<div class="tip">').html(text);
        setTimeout(function() {if(tipCreated) { $(tooltip).appendTo(document.body).hide().fadeIn(500) }}, 333)
        tipCreated = true;
      }
    })
    .mousemove(function(e) {
      tooltip.css({
        left: e.pageX + 20,
        top: e.pageY - 30
      })
    })
    .mouseout(function() {
      tipCreated = false;
      tooltip.remove();
    })
}

function slide(category, direction) {
  if (direction == 'down') {
    $(category).siblings().slideDown();
  } else if (direction == 'up'){
    $(category).siblings().slideUp();
  }
}

function categoryDropdowns() {
  $('.influencer-category').click(function() {
    if ($(this).hasClass('selected')) {
      if ($(this).siblings().is(':visible')) {
        slide(this,'up');
      } else {
        slide(this, 'down');
      }
    } else {
      categorySelected = $(this).attr('data-category')

      filters['followers']['min'] = rangesSelected[categorySelected];
      if(categorySelected == 'celeb') {
        filters['followers']['max'] = 100000000000;
      } else if (categorySelected == 'macro') {
        filters['followers']['max'] = 1000000;
      } else {
        filters['followers']['max'] = 100000;

      }

      applyFilters(filters);


      $(this).addClass('selected');
      slide(this, "down");

      $('.influencer-category').each(function() {
        if ($(this).attr('data-category') != categorySelected) {
          $(this).removeClass('selected');
          slide(this, 'up');
        }
      })

    }
  })
}

function reachChecks() {
  for (var category in CATEGORY_RANGES) {
    (function(category) {

      var container = $('.influencer-category[data-category="' + category + '"]').siblings();
      var ranges = CATEGORY_RANGES[category];
      var len = ranges.length;
      ranges.forEach(function(num, i) {
        var block = $('<div class="subcategory-block">').attr('data-subcategory', num);
        if (i == 0) {
          block.html('<div class="check"></div> ' + abbrNum(num) + "+");
          block.addClass('checked');
          rangesSelected[category] = num;
        } else {
          block.html('<div class="check"></div> ' + abbrNum(num) + " to " + abbrNum(ranges[i-1]));
        }

        container.append(block);

        block.click(function() {
          if (!$(this).hasClass('checked')) {
            $(this).addClass('checked');
            $(this).siblings().removeClass('checked');
            rangesSelected[category] = num;
            filters['followers']['min'] = num;
            if(ranges[i-1]){
              filters['followers']['max'] = ranges[i-1];
            }else{
              if(category == 'celeb') {
                filters['followers']['max'] = 1000000000;
              } else if (category == 'macro') {
                filters['followers']['max'] = CATEGORY_RANGES['celeb'][CATEGORY_RANGES['celeb'].length - 1];
              } else {
                filters['followers']['max'] = CATEGORY_RANGES['macro'][CATEGORY_RANGES['macro'].length - 1];
              }
            }

            applyFilters(filters);
          }
        })
      })
    })(category); //IIFE to bind category variable. Otherwise it gets stuck on last value.
  }
}

function engagementInputs() {
  $('.engagement-input')
    .keypress(function(e) {
      if(e.which == 13) {
        checkSetEngagement();
      }
    })
    .change(function(e) {
      checkSetEngagement();
    })
}

function checkSetEngagement() {
  var min = parseFloat($('#engagement-min').val());
  var max = parseFloat($('#engagement-max').val());
  if (min > max) {
    $("#engagement-error-message").slideDown(333);
  } else {
    engagement.min = min;
    engagement.max = max;
    filters['engagement']['min'] = engagement.min;
    filters['engagement']['max'] = engagement.max;
    applyFilters(filters);
    $("#engagement-error-message").slideUp(333);
  }
}

function genderChecks() {
  $('.gender-block').click(function() {
    // $(this).addClass('checked');
    var thisGender = $(this).attr('data-gender')

    if ($(this).hasClass('checked')) {
      var loc = genderSelected.indexOf(thisGender);
      genderSelected.splice(loc, 1);
      $(this).removeClass('checked');
    } else {
      $(this).addClass('checked');
      genderSelected.push(thisGender);
    }
    filters['gender'] = genderSelected;
    applyFilters(filters);


  })
}

function locationInput() {

  $('#location-input')
    .keypress(function(e) {
      if(e.which == 13) {
        if(loc === $(this).val()) return 0;
        loc = $(this).val();
        filters['location'] = loc;
        applyFilters(filters);
      }
    })
    .change(function(e) {
      loc = $(this).val();
      filters['location'] = loc;
      applyFilters(filters);
    })
}
