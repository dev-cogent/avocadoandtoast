   $(document).on('keyup','#search',function(e){
        page = 0;
        search = $('#search').val();
        filters['user'] = $(this).val();
        applyFilters(filters);
    });

$(document).on('mouseenter', '.border', function () {
    var childobject = $(this).find('.checkmark');
    if (childobject.attr('data-check') == 'true') {
        return 0;
    }

    $(this).css('border', '1px solid #dddddd');
}).on('mouseleave', '.border', function () {
    var childobject = $(this).find('.checkmark');
    if (childobject.attr('data-check') == 'true') {
        return 0;
    }
    $(this).css('border', '1px solid #edf0f4');


});



$(document).on('click', '.border', function () {
    var border = $(this);
    var image = border.attr('data-image');
    var id = border.attr('data-id');
    var data = $(this).find('.checkmark');

    if (data.attr('data-check') == 'true') {
        border.css('border', '1px solid #dddddd');
        data.css('visibility', 'hidden');
        data.attr('data-check', 'false');
        var del = $('#circles [data-id="' + id + '"]');
        if (del.attr('data-type') == 'appended') {
            changeNumber('negative');
        }
        del.remove();
        var i = selectedusers.indexOf(id);
        if (i != -1) {
            selectedusers.splice(i, 1);
            if (selectedusers.length <= 4) {
                $('.appendimages').each(function () {
                    var image = $(this).attr('data-image');
                    var id = $(this).attr('data-id');
                    $('#circles').prepend('<img src="http://project.social/' + image + '" data-image="' + image + '" data-id="' + id + '" class="added img-circle" style="display:unset;">');

                });
                $('#append').empty();

                $('#scrollcircle').css('visibility', 'hidden');

            }

        }



    }
    else {
        border.css('border', '1px solid #c6c6c6');
        data.css('visibility', '');
        data.attr('data-check', 'true');
        selectedusers.push(id);
        console.log(selectedusers.length);
        if (selectedusers.length > 4) {
            changeNumber('positive');
            $('#scrollcircle').css('visibility', 'visible');
            $('#append').append('<img src="http://project.social/' + image + '" data-image="' + image + '" data-id="' + id + '" data-type="appended"class="added img-circle appendimages" style="margin-bottom: 20px;">');
        }
        else {
            $('#circles').prepend('<img src="http://project.social/' + image + '" data-image="' + image + '" data-id="' + id + '" class="added img-circle" style="display:unset;">');
        }

        /*
          border.css('background-color','#191d59');
          border.css('color','white');
          */
    }
});


$(document).on('mouseenter', '.view', function () {
    $(this).css('color', '#4286f4');
    $(this).find('h5').css('color', '#4286f4');

}).on('mouseleave', '.view', function () {
    $(this).css('color', '#37474f');
    $(this).find('h5').css('color', '#37474f');


});

$(".dropdown-menu").on('click', function (e) {
    e.stopPropagation();
});





/*OLD JS GOES HERE */
$(document).on('click', '.dropdown', function (e) {

    e.stopPropagation();

});

$(document).on('click', '.applied', function () {
    removeFilter($(this));
});



$('#totalfilter').click(function () {
    filters['min'] = $('#min-total').val();
    filters['max'] = $('#max-total').val();
    filters['platform'] = 'total';
    $('#platform').remove();
    applyFilters(filters);
    $('#appliedfilters').append('<span id="platform" data-id="minmax" class="applied m-r-10 label label-pill label-danger label-lg" style="padding:10px;">Total: ' + abbrNum($('#min-total').val()) + ' - ' + abbrNum($('#max-total').val()) + '<i class="fa fa-remove" style="padding-left:5px; color:#fff;"></i></span>');

});

$('#instagramfilter').click(function () {
    filters['min'] = $('#min-instagram').val();
    filters['max'] = $('#max-instagram').val();
    filters['platform'] = 'instagram';
    $('#platform').remove();
    applyFilters(filters);
    $('#appliedfilters').append('<span id="platform" data-id="minmax" class="applied m-r-10 label label-pill label-danger label-lg" style="padding:10px;">Instagram: ' + abbrNum($('#min-instagram').val()) + ' - ' + abbrNum($('#max-instagram').val()) + '<i class="fa fa-remove" style="padding-left:5px; color:#fff;"></i></span>');
});
$('#twitterfilter').click(function () {
    filters['min'] = $('#min-twitter').val();
    filters['max'] = $('#max-twitter').val();
    filters['platform'] = 'twitter';
    $('#platform').remove();
    applyFilters(filters);
    $('#appliedfilters').append('<span id="platform" data-id="minmax" class="applied m-r-10 label label-pill label-danger label-lg" style="padding:10px;">Twitter: ' + abbrNum($('#min-twitter').val()) + ' - ' + abbrNum($('#max-twitter').val()) + '<i class="fa fa-remove" style="padding-left:5px; color:#fff;"></i></span>');
});
$('#facebookfilter').click(function () {
    filters['min'] = $('#min-facebook').val();
    filters['max'] = $('#max-facebook').val();
    filters['platform'] = 'facebook';
    $('#platform').remove();
    applyFilters(filters);
    $('#appliedfilters').append('<span  id="platform" data-id="minmax" class="applied m-r-10 label label-pill label-danger label-lg" style="padding:10px;">Facebook: ' + abbrNum($('#min-facebook').val()) + ' - ' + abbrNum($('#max-facebook').val()) + '<i class="fa fa-remove" style="padding-left:5px; color:#fff;"></i></span>');
});


$(document).on('click', '#bio', function (e) {
    var bio = $('#bioinput').val();
    var options = $("input[name='radio-stacked']:checked").attr('data-id');
    var search = [];
    $("input[class='search']:checked").each(function () {
        search.push($(this).attr('data-id'));
    });
    filters['bio'] = bio;
    filters['options'] = options;
    filters['search'] = search;
    $('#biofilter').remove();
    console.log(filters);
    applyFilters(filters);
    $('#appliedfilters').append('<span id="biofilter" data-id="bio" class="applied m-r-10 label label-pill label-danger label-lg" style="padding:10px;">Keyword: ' + bio + ' <i class="fa fa-remove" style="padding-left:5px; color:#fff;"></i></span>');
});

$(document).on('keyup', '#bioinput', function (e) {
    if (e.which == 13) {
        var bio = $('#bioinput').val();
        var options = $("input[name='radio-stacked']:checked").attr('data-id');
        var search = [];
        $("input[class='search']:checked").each(function () {
            search.push($(this).attr('data-id'));
        });
        filters['bio'] = bio;
        filters['options'] = options;
        filters['search'] = search;
        console.log(filters);
        $('#biofilter').remove();
        applyFilters(filters);
        $('#appliedfilters').append('<span id="biofilter" data-id="bio" class="applied m-r-10 label label-pill label-danger label-lg" style="padding:10px;">Keyword: ' + bio + ' <i class="fa fa-remove" style="padding-left:5px; color:#fff;"></i></span>');
    }
});

$(document).on('click', '#location', function (e) {
    var location = $('#locationinput').val();
    filters['location'] = location;
    $('#locationfilter').remove();
    applyFilters(filters);
    $('#appliedfilters').append('<span id="locationfilter" data-id="location" class="applied m-r-10 label label-pill label-danger label-lg" style="padding:10px;">Location: ' + location + ' <i class="fa fa-remove" style="padding-left:5px; color:#fff;"></i></span>');
});


$(document).on('keyup', '#locationinput', function (e) {
    if (e.which == 13) {
        var location = $(this).val();
        filters['location'] = location;
        $('#locationfilter').remove();
        applyFilters(filters);
        $('#appliedfilters').append('<span id="locationfilter" data-id="location" class="applied m-r-10 label label-pill label-danger label-lg" style="padding:10px;">Location: ' + location + ' <i class="fa fa-remove" style="padding-left:5px; color:#fff;"></i></span>');
    }
});

$(document).on('click', '#clearall', function () {
    filters = {};
    applyFilters(filters);
    $('#appliedfilters').empty();

});


$(document).ready(function () {
    $.ajax({
        type: 'POST',
        url: '/includes/ajax/pagination.php',
        data: {
            page: '0',
            type: type
        },
        success: function (jqXHR, textStatus, errorThrown) {
            $('#content').append(jqXHR);
        }
    }); // end ajax request*/ 
 

    $(window).scroll(function () {
        if(search == null) return 0;
        if ($(window).scrollTop() == $(document).height() - $(window).height()) {
            page = page + 1;
            console.log(page);
            $.ajax({
                type: 'POST',
                url: '/includes/ajax/pagination.php',
                data: {
                    page: page,
                    filters: filters,
                    type: type
                },
                success: function (jqXHR, textStatus, errorThrown) {
                    $('#content').append(jqXHR);

                }

            }); // end ajax request*/ 
        }
    });
});




function applyFilters(filters) {
    $.ajax({
        type: 'POST',
        url: '/includes/ajax/pagination.php',
        data: {
            filters: filters,
            type: type
        },
        success: function (jqXHR, textStatus, errorThrown) {
            $('#content').empty();
            $('#content').append(jqXHR);

            if (type == 'card') {
                $('.thumbnail').each(function () {
                    var tempid = $(this).attr('data-id');
                    var check = $.inArray(tempid, selectedusers);
                    if (check !== -1) {
                        $(this).css('border', '1px solid #c6c6c6');
                        $(this).attr('data-check', 'true');
                    }
                });
            }

            if(type == 'list'){
                $('.border').each(function(){
                    var tempid = $(this).attr('data-id');
                    var check = $.inArray(tempid, selectedusers);
                    var border = $(this);
                    var data = $(this).find('.checkmark');
                    if(check !== -1){
                        border.css('border', '1px solid #c6c6c6');
                        data.css('visibility', '');
                        data.attr('data-check', 'true');
                    }
                });
            }

            page = 0;
        }

    }); // end ajax request*/ 
}





function removeFilter(element) {
    var type = element.attr('data-id');
    console.log(filters);
    console.log(type);
    if (type == 'minmax') {
        delete filters['min'];
        delete filters['max'];
        delete filters['platform'];
        element.remove();
        applyFilters(filters);

    }
    if (type == 'bio') {
        delete filters['bio'];
        element.remove();
        applyFilters(filters);
    }
    if (type == 'location') {
        delete filters['location'];
        element.remove();
        console.log(filters);
        applyFilters(filters);
    }
}



$(document).on('click', '#cardview', function () {
    type = 'card';
    applyFilters(filters);
});

$(document).on('click', '#listview', function () {
    type = 'list';
    applyFilters(filters);
});





function findCheck(id) {

    var item = $('input[data-id=' + id + ']');
    var image = item.attr('data-image');
    var i = selectedusers.indexOf(id);
    if (i != -1) {
        selectedusers.splice(i, 1);
        item.prop('checked', false);
        $('.selected[data-id=' + id + ']').remove();
        $('.border[data-id=' + id + ']').css('border', '1px solid #eeeeee');
        var text = parseInt($('#influencernumber').text());
        text--;
        $('#influencernumber').text(text);

    }
    else {
        item.prop('checked', true);
        $('.border[data-id=' + id + ']').css('border', '2px solid #cccccc');
        selectedusers.push(id);
        $('#search').append('<div class="selected auto m-r-5 m-b-10" data-id="' + id + '" style="float:left; display:inline-block;"><div><img class="img-circle" width="50" height="50" src="' + image + '" onerror="this.src=`https://project.social/images/ps-square.jpg`" alt="..."> </div></div>');
        var text = parseInt($('#influencernumber').text());
        text++;
        $('#influencernumber').text(text);
    }



}





$(document).on('click', '#clearinfluencers', function () {
    selectedusers = [];
    $('#search').empty();
    $('#influencernumber').text('0');
    $('.add').removeAttr('checked');
    $('.border').css('border', '1px solid #eeeeee');
    console.log(filters);
});






$(document).on('click', '.add', function () {
    var image = $(this).attr('data-image');
    var id = $(this).attr('data-id');
    var data = $(this).attr('data-check');

    if (data == 'true') {
        changeAmount('negative');
        $(this).css('border', '1px solid rgba(243,244,245,1)');
        //$(this).css('visibility','hidden');
        $(this).attr('data-check', 'false');
        var del = $('#circles [data-id="' + id + '"]');
        if (del.attr('data-type') == 'appended') {
            changeNumber('negative');
        }
        del.remove();
        var i = selectedusers.indexOf(id);
        if (i != -1) {
            selectedusers.splice(i, 1);
            if (selectedusers.length <= 4) {
                changeNumber('reset');
                $('.appendimages').each(function () {
                    var image = $(this).attr('data-image');
                    var id = $(this).attr('data-id');
                    $('#circles').prepend('<img src="http://project.social/' + image + '" data-image="' + image + '" data-id="' + id + '" class="added img-circle" style="display:unset;">');
 
                });
                $('#append').empty();

                $('#scrollcircle').css('visibility', 'hidden');

            }

        }



    }
    else {
        changeAmount('positive');
        $(this).css('border', '1px solid #c6c6c6');
        $(this).attr('data-check', 'true');
        selectedusers.push(id);
        if (selectedusers.length > 4) {
            changeNumber('positive');
            $('#scrollcircle').css('visibility', 'visible');
            $('#append').append('<img src="http://project.social/' + image + '" data-image="' + image + '" data-id="' + id + '" data-type="appended"class="added img-circle appendimages" style="margin-bottom: 20px;">');
        }
        else {
            $('#circles').prepend('<img src="http://project.social/' + image + '" data-image="' + image + '" data-id="' + id + '" class="added img-circle">');
        }

        /*
          border.css('background-color','#191d59');
          border.css('color','white');
          */
    }
});





function changeAmount(type) {
    if (type == 'positive') {
        var text = ($('#amount').text());
        text.charAt(0);
        text = parseInt(text);
        text = text + 1;
        console.log(text);
        $('#amount').text(text + ' Selected Users');
    }

    if (type == 'negative') {
        var text = ($('#amount').text());
        text.charAt(0);
        text = parseInt(text);
        text = text - 1;
        $('#amount').text(text + ' Selected Users');
    }

    if (type == 'reset') {
        $('#amount').text('0 Selected Users');
    }


}



function changeNumber(type) {
    if (type == 'positive') {
        var text = ($('#usercount').text());
        console.log(text);
        text = text.slice(1);
        text = parseInt(text);
        text = text + 1;
        $('#usercount').text('+' + text);
    }
    if (type == 'negative') {
        var text = ($('#usercount').text());
        console.log(text);
        text = text.slice(1);
        text = parseInt(text);

        text = text - 1;
        $('#usercount').text('+' + text);

    }
    if (type == 'reset') {
        $('#usercount').text('+0');
    }



}


//create list 
$(document).on('click', '#create', function () {
    if (overlay === false) {
        $(".overlay").slideDown("slow", function () {
            $('.overlay').css('display', 'unset');
            overlay = true;
        });
    }
    else {
        $(".overlay").slideUp("slow", function () {
            $('.overlay').css('display', 'none');
            overlay = false;
        });
    }
});


$(document).on('click', '#close', function () {
    if (overlay === false) {
        $(".overlay").slideDown("slow", function () {
            $('.overlay').css('display', 'unset');
            overlay = true;
        });
    }
    else {
        $(".overlay").slideUp("slow", function () {
            $('.overlay').css('display', 'none');
            overlay = false;
        });
    }
});

