$(document).ready(function(){
    $.ajax({
        type: 'POST', 
        url: '/php/ajax/yourcampaigns-info.php',
        success: function (jqXHR, textStatus, errorThrown) {
            campaignJSON = JSON.parse(jqXHR);
            $.each(campaignJSON, function(key,obj){
            $('#campaign-container').append('<div class="campaign-block col-xs-9" data-id="'+key+'" data-desc="'+obj.description+'" data-name="'+obj.campaignname+'" data-start="'+obj.campaignstart+'" data-end="'+obj.campaignend+'" style="padding-left:75px;" >'+
                   '<table class="col-xs-12">'+
                        '<tbody style="border-top:0px;">'+
                        '<tr>'+
                            '<td class="campaign-details name" ><a class="campaign-details" href="/campaigns/?id='+key+'">'+obj.campaignname+' </a></td>'+
                            '<td class="campaign-details" > '+obj.state+' </td>'+
                            '<td class="campaign-details date" > Created '+obj.created+'</td>'+
                        '</tr>'+
                       '<tr>'+
                            '<td class="stats">'+obj.totalinfluencers+'</td>'+
                            '<td class="stats">'+obj.totalposts+'</td>'+
                            '<td class="stats">'+abbrNum(obj.average_impressions)+'</td>'+
                            '<td class="stats">'+abbrNum(obj.average_engagement)+'</td>'+
                            '<td class="stats">'+abbrNum(obj.totalimpressions)+'</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td class="label-info"># of Influencers</td>'+
                            '<td class="label-info">Total Post</td>'+
                            '<td class="label-info">Average Impressions</td>'+
                            '<td class="label-info"> Average Engagement</td>'+
                            '<td class="label-info"> Total Reach</td>'+
                        '</tr>'+
                        '</tbody>'+
                    '</table>'+
                '</div>');








            });
        }
    }); // end ajax request*/

});
var target = $("#campaign-info").offset().top;
var sidebar = false;
$(document).on('click','.campaign-block',function(){
    $('#campaign-info').empty();
    var name = $(this).attr('data-name');
    var desc = $(this).attr('data-desc');
    var id = $(this).attr('data-id');
    var start = $(this).attr('data-start');
    var end = $(this).attr('data-end');
    
    
    $('#campaign-info').append(
        '<div id="campaign-details" style="max-width: 330px;">'+
       '<p id="campaign-title">'+name+'</p>'+
      ' <p class="title"> Campaign Summary</p>'+
       '<p id="summary">'+desc+'</p>'+
       '<p class="title">Campaign Schedule</p>'+
       '<p id="schedule"> '+start+' - '+end+ ''+
       '<div id="button-container">'+
           '<a style="color:#76838f;"href="/edit/?id='+id+'"><button class="option-button avocado-hover avocado-focus" id="'+id+'"> Edit Campaign </button></a>'+
           '<a style="color:#76838f;"href="/campaigns/?id='+id+'"><button class="option-button avocado-hover avocado-focus" name="campaign" value="'+id+'">View Campaign </button></a>'+
    '</div>');
});

function abbrNum(number, decPlaces = 2) {
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
            if((number == 1000) && (i < abbrev.length - 1)) {
                number = 1;
                i++;
            }

            // console.log(number);
            // Add the letter for the abbreviation
            number += abbrev[i];

            // We are done... stop
            break;
        }
    }

    return number;
}