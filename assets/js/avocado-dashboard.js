$(document).ready(function() {
    $.ajax({
        type: 'GET',
        url: '/php/ajax/yourcampaigns-info.php',
        success: function(jqXHR, textStatus, errorThrown) {
            campaignJSON = JSON.parse(jqXHR);
            $.each(campaignJSON, function(key, obj) {
                $('#campaign-container').append('<a href="/campaigns/?id='+key+'"><div class="campaign-block col-xs-12" data-id="' + key + '" data-desc="' + obj.description + '" data-name="' + obj.campaignname + '" data-start="' + obj.campaignstart + '" data-end="' + obj.campaignend + '" >' +
                    '<table class="dashboard-table col-xs-12">' +
                    '<tbody style="border-top:0px;">' +
                    '<tr>' +
                    '<td class="campaign-details name" ><a href="/campaigns/?id=' + key + '" class="campaign-details">' + obj.campaignname + ' </a></td>' +
                    '<td class="campaign-details" > ' + obj.state + ' </td>' +
                    '<td class="campaign-details date" > Created ' + obj.created + '</td>' +
                    '<td class="blank-td"></td> <td class="blank-td mobile"> </td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td class="stats"><a class="stats" href="/campaigns/?id=' + key + '">' + obj.totalinfluencers + '</a></td>' +
                    '<td class="stats mobile-off"><a class="stats" href="/campaigns/?id=' + key + '">' + obj.totalposts + '</a></td>' +
                    '<td class="stats mobile-off impressions"><a class="stats" href="/campaigns/?id=' + key + '">' + abbrNum(obj.average_impressions) + '</a></td>' +
                    '<td class="stats mobile-off mobile-off-first"><a class="stats" href="/campaigns/?id=' + key + '">' + abbrNum(obj.average_engagement) + '</a></td>' +
                    '<td class="stats reach"><a class="stats" href="/campaigns/?id=' + key + '">' + abbrNum(obj.totalimpressions) + '</a></td>' +
                    '<td class="button-stats"><a href="/price/?id=' + key + '"><button class="primary-button button-stats-bt">PRICE CAMPAIGN</button> </a></td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td class="label-info">Influencers</td>' +
                    '<td class="label-info mobile-off">Posts</td>' +
                    '<td class="label-info mobile-off impressions">Avg Impressions</td>' +
                    '<td class="label-info mobile-off mobile-off-first">Avg Engagement</td>' +
                    '<td class="label-info reach">Reach</td>' +
                    '<td class="delete-btn-area"> <a href="#" data-campaign="' + key + '" class="delete-campaign"> <i class="icon pe-trash list-dashboard" aria-hidden="true"></i> </a> </td>' +
                    '</tr>' +
                    '</tbody>' +
                    '</table>' +
                    '</div></a>');

            });
        }

    }); // end ajax request*/

});


$(document).on('click', '.campaign-block', function() {
    $('#campaign-info').empty();
    var name = $(this).attr('data-name');
    var desc = $(this).attr('data-desc');
    var id = $(this).attr('data-id');
    var start = $(this).attr('data-start');
    var end = $(this).attr('data-end');


    $('#campaign-info').append(
        '<div id="campaign-details" style="max-width: 330px;">' +
        '<p id="campaign-title">' + name + '</p>' +
        ' <p class="title"> Campaign Summary</p>' +
        '<p id="summary">' + desc + '</p>' +
        '<p class="title">Campaign Schedule</p>' +
        '<p id="schedule"> ' + start + ' - ' + end + '' +
        '<div id="button-container">' +
        '<a style="color:#76838f;"href="/edit/?id=' + id + '"><button class="option-button avocado-hover avocado-focus" id="' + id + '"> Edit Campaign </button></a>' +
        '<a style="color:#76838f;"href="/campaigns/?id=' + id + '"><button class="option-button avocado-hover avocado-focus" name="campaign" value="' + id + '">View Campaign </button></a>' +
        '</div>');
});


$(document).on('click','.delete-campaign',function(){
        var campaignid = $(this).attr('data-campaign');
        $.ajax({
        type: 'POST',
        url: '/php/ajax/deletecampaign.php',
        data: {
            campaignid : campaignid,
        },
        success: function (jqXHR, textStatus, errorThrown) {
          dialog = bootbox.dialog({
              message: '<div class="bootbox-body">' +
              '<div class="icon-popup-div"> <img src="/assets/images/chasing_2.gif" class="success-popup-icon"/> </div>' +
              '<div class="row"> <div class="col-xs-12 popup-detail success">   <span class="yay"> SUCCESS!</span> <br/>Your Campaign has been deleted sucessfully.  </div>' +
              '<div class="col-xs-12 btn-col"><div class="popup-btn-div"> <a href="/dashboard"></a></div>' +
              '</div> </div>',
              closeButton: true
          });

          dialog.modal();
          setTimeout(function () {
            location.href="/dashboard.php";
          }, 3000);
        }

    }); // end ajax request*/

});

function abbrNum(number, decPlaces = 1) {
    if (number < 1000) {
        number = parseInt(number);
        return number;
    }
    var orig = number;
    var dec = decPlaces;
    // 2 decimal places => 100, 3 => 1000, etc
    decPlaces = Math.pow(10, decPlaces);

    // Enumerate number abbreviations
    var abbrev = ["k", "m", "b", "t"];

    // Go through the array backwards, so we do the largest first
    for (var i = abbrev.length - 1; i >= 0; i--) {

        // Convert array index to "1000", "1000000", etc
        var size = Math.pow(10, (i + 1) * 3);

        // If the number is bigger or equal do the abbreviation
        if (size <= number) {
            // Here, we multiply by decPlaces, round, and then divide by decPlaces.
            // This gives us nice rounding to a particular decimal place.
            var number = Math.round(number * decPlaces / size) / decPlaces;

            // instHandle special case where we round up to the next abbreviation
            if ((number == 1000) && (i < abbrev.length - 1)) {
                number = 1;
                i++;
            }

            // Add the letter for the abbreviation
            number += abbrev[i];
            // We are done... stop
            break;
        }

    }
    return number;
}


function noCampaigns(){
    $('#campaign-container').empty();
    $.ajax({
        type: 'GET',
        url: '/html/ajax/noCampaign.html',
        success: function (jqXHR, textStatus, errorThrown) {
              $('#campaign-container').append(jqXHR);
      }
    }); // end ajax request*/

}
