$(window).scroll(function() {
    if($(window).scrollTop() == $(document).height() - $(window).height()) {
        console.log('at the bottom');
        /*$.ajax({
        type: 'POST',
        url: 'http://cogenttools.com/includes/ajax/pagination.php',  
        data: {
        tags: tagsarr,
        limit : limit
        },
        success: function (jqXHR, textStatus, errorThrown) {
            $('#gohere').append(jqXHR);
            limit +=28;
            }   
            
        }); // end ajax request*/ 
    }
});
    