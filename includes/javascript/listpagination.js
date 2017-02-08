
$(document).ready(function () {
    $.ajax({
        type: 'POST',
        url: '/includes/ajax/getinfluencers.php',
        data: {
            list: list 
        },
        success: function (jqXHR, textStatus, errorThrown) {
            influencers = jqXHR;
            pagination(list, 0, type);
            page = page + 1;

        }
    }); // end ajax request*/
});



$(window).scroll(function () {
    if ($(window).scrollTop() == $(document).height() - $(window).height()) {
        if (influencers != null) {
            console.log('pagination');
            pagination(list, page, type);
            page = page + 1;
        }
    }
});


function pagination(search, page, issearch) {

    $.ajax({
        type: 'POST',
        url: '/includes/ajax/listpagination.php',
        data: {
            list: list,
            type: type,
            page: page,
            influencers: influencers
        },
        success: function (jqXHR, textStatus, errorThrown) {
            if (type == 'list') {
                $('#table').append(jqXHR);
            }
            else {
                $('#clearthis').append(jqXHR);
            }

        }

    }); // end ajax request*/
}

$(document).on('keyup', '#search', function (e) {
    search = $('#search').val();
    $.ajax({
        type: 'POST',
        url: '/includes/ajax/searchlist.php',
        data: {
            list: list,
            search: search,
            influencers: influencers,
            type: type
        },
        success: function (jqXHR, textStatus, errorThrown) {
            page = 1;
            if (type == 'list') {
                $('#table').empty();
                $('#table').append(jqXHR);
            }
            else {
                $('#clearthis').empty();
                $('#clearthis').append(jqXHR);
            }

        }

    }); // end ajax request*/


});


$(document).on('click', '#cardview', function () {
    type = 'card';
    $.ajax({
        type: 'POST',
        url: '/includes/ajax/getcard.php',
        data: {
            list: list,
            influencers:influencers
        },
        success: function (jqXHR, textStatus, errorThrown) {
            page = 1;
            $('#clearthis').empty();
            $('#clearthis').append(jqXHR);

        }

    }); // end ajax request*/



});



$(document).on('click', '#listview', function () {

    type = 'list';
    $.ajax({
        type: 'POST',
        url: '/includes/ajax/getlistview.php',
        data: {
            list: list,
            influencers:influencers
        },
        success: function (jqXHR, textStatus, errorThrown) {
            page = 1;
            $('#clearthis').empty();
            $('#clearthis').append(jqXHR);

        }

    }); // end ajax request*/
});

$(document).on('click', '#edit', function () {
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


$(document).on('click', '.remove', function () {
    alert('deleting');
    var influencerid = $(this).attr('data-id');
    $.ajax({
        type: 'POST',
        url: '/includes/ajax/delfromlist.php',
        data: {
            list: list,
            influencerid: influencerid
        },
        success: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);

        }

    }); // end ajax request*/

});

$(document).on('click', '.select', function () {
    var checked = $(this).attr('data-check');
    
    var influencerid = $(this).attr('data-id');
    //change css properties
    if (checked == 'false') {
        selectedinfluencers.push(influencerid);
        if (type === 'list') {
            $(this).css('background-color', '#f4f4f4');
            $(this).attr('data-check', 'true');
            $(this).find('.checkmark-squared').css('background-color', 'red');
        }
    }
    else {
        if(type === 'list'){
            $(this).css('background-color', 'white');
            $(this).attr('data-check', 'false');
            $(this).find('.checkmark-squared').css('background-color', 'white');
        }
    }



});



$(document).on('click','#deletemultiple',function(){
// give prompt message if they want to delete the users. 
if(selectedinfluencers == null) return 0;
    $.ajax({
        type: 'POST',
        url: '/includes/ajax/delfromlist.php',
        data: {
            list: list,
            influencerid: selectedinfluencers
        },
        success: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);

        }

    }); // end ajax request*/




});