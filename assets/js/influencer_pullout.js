$(document).ready(function () {
  var pulledOut = false;
  var breakSmall = 600;
  var vw, vh, leftVal;  //viewport width and left value for pulled out state
  var cellphoneMode = false;

  var undoQueue = [];

  checkNumInfluencers();
  assignDimensions();
  addPulloutResize();
  addPulloutClick();
  addSelectToggle();
  addButtonHandlers();



  $(document).on('click', '.invite', function () {
    var id = $(this).attr('data-id');
    var element = $(this);

    selectInfluencer(id, element);
    checkNumInfluencers();
  });


  function selectInfluencer(id, element) {

    var image = element.attr('data-image');
    var influencerCount = parseInt($('#count').text());
    //Then we are adding them to our campaign/sidebar.
    if(selectedusers.indexOf(id) == -1) {

      selectedusers.push(id);
      $('#influencer-pullout-image-container').append('<img class="influencer-pullout-image" data-id="' + id + '" onerror="this.src=`/assets/images/default-photo.png`" src="http://cogenttools.com/' + image + '">');
      element.css('background-color', 'white');
      element.empty();
      element.append('<div class="checkmark-circle"><div class="background"></div><div class="checkmark draw"></div></div>');
      $('.influ-bottom[data-id="' + id + '"]').css('box-shadow', '0px -10px 0px #73C48D');
    } else {
      selectedusers.splice(selectedusers.indexOf(id), 1);
      $('.influencer-pullout-image[data-id="' + id + '"]').remove();

      $(".invite[data-id='" + id + "']").empty();
      $(".invite[data-id='" + id + "']").css('background-color', '#e0e0e0');
      $('.influ-bottom[data-id="' + id + '"]').css('box-shadow', 'none');
    }

  }



  function checkNumInfluencers() {

    if (selectedusers.length == 0) {
      $('#remove-button').addClass('greyed-out');
      $('#remove-all-button').addClass('greyed-out');
    } else {
      $('#remove-all-button').removeClass('greyed-out');
    }
    $('#num-influencers').html(selectedusers.length);
  }

  function assignDimensions() {
    vw = window.innerWidth;
    vh = window.innerHeight;
    leftVal = vw - 400 + "px";

    cellphoneMode = vw < breakSmall ? true : false;
    cellphoneLayout(cellphoneMode);

  }

  function cellphoneLayout(yes) {
    if (yes) {

    } else {

    }
  }

  function addPulloutResize() {
    $(window).resize(function () {
      assignDimensions();
      if (pulledOut) {
        $("#influencers-pullout").animate({ left: leftVal }, 0);
      } else {
        $("#influencers-pullout").animate({ left: (vw + "px") }, 0);
      }

    })
  }

  function addPulloutClick() {
    $("#pulltab").click(function (e) {
      if (!pulledOut) {
        $("#influencers-pullout").animate({ left: leftVal }, 600);
      } else {
        $("#influencers-pullout").animate({ left: (vw + "px") }, 600);
      }
      pulledOut = !pulledOut;
    })
  }

  function addSelectToggle() {
    $('#influencer-pullout-image-container').on('mousedown', '.influencer-pullout-image', function (e) {
      $(this).toggleClass("image-selected");
      if ($('.image-selected').length > 0) {
        $('#remove-button').removeClass('greyed-out');
      }
    });
  }

  function addButtonHandlers() {
    $('#dismiss-button').click(function() {dismissPullout();})

    $('#remove-button').click(function () { removeSelected(); })
    $('#remove-all-button').click(function () { removeAll(); })
    $('#undo-button').click(function () { undo(); })
  }

  function dismissPullout() {
    $("#influencers-pullout").animate({ left: (vw + "px") }, 600);
    pulledOut = false;
  }

  function removeSelected() {
    if ($('.image-selected').length == 0) { return; }
    collectIndices = [];
    $(".image-selected").each(function (index) {
      var id = $(this).attr('data-id');
      collectIndices.push(id);
      selectedusers.splice(selectedusers.indexOf(id), 1);

      $(this).css({ display: "none" })
      $(this).removeClass("image-selected");
    });
    removeChecks(collectIndices);
    checkNumInfluencers();

    undoQueue.push(collectIndices);
    $('#remove-button').addClass("greyed-out");
    $('#undo-button').removeClass("greyed-out");

  }

  function removeAll() {
    collectIndices = [];

    $("#influencer-pullout-image-container img:visible").each(function () {
      collectIndices.push($(this).attr('data-id'));
      $(this).css({ display: "none" })
    })
    selectedusers = [];
    removeChecks(collectIndices);
    checkNumInfluencers();

    undoQueue.push(collectIndices);
    $('#undo-button').removeClass("greyed-out");
  }

  function undo() {
    if (undoQueue.length == 0) { return; }
    lastAction = undoQueue[undoQueue.length - 1];
    lastAction.forEach(function (index) {
      selectedusers.push(index);
      var selector = "#influencer-pullout-image-container img[data-id='" + index + "']"
      $(selector).css({ display: "inline-block" })
    })
    addChecks(lastAction);
    checkNumInfluencers();

    undoQueue.splice(-1, 1);
    if (undoQueue.length == 0) {
      $('#undo-button').addClass("greyed-out");
    }
  }

  function removeChecks(lastAction) {
    lastAction.forEach(function (id) {
      $(".invite[data-id='" + id + "']").empty();
      $(".invite[data-id='" + id + "']").css('background-color', '#e0e0e0');
      $('.influ-bottom[data-id="' + id + '"]').css('box-shadow', 'none');
    })
  }

  function addChecks(lastAction) {
    lastAction.forEach(function (id) {
      $(".invite[data-id='" + id + "']").append('<div class="checkmark-circle"><div class="background"></div><div class="checkmark draw"></div></div>');
      $(".invite[data-id='" + id + "']").css('background-color', 'white');
      $('.influ-bottom[data-id="' + id + '"]').css('box-shadow', '0px -10px 0px #73C48D');
    })


  }





})
