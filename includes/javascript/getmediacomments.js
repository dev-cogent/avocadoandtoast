var arr = "";
var mediaid = "";
$('.image').on('click',function(){
        mediaid = $(this).attr('data-id');
        $.ajax({
        type: 'POST',
        url: '/includes/ajax/getcomment.php',  
        data: {
        mediaid: mediaid,
                },
        success: function (jqXHR, textStatus, errorThrown) {
        $('#commentsection').empty();
        arr = $.parseJSON(jqXHR);
        for (var key in arr){
         // we can show and append information of comments here. :)
         $('#commentsection').append(arr[key]['displaytext']);
        }
        $('#commentsection').append('<input id="managecomment" data-id="'+mediaid+'"name="comment" type="text" class="form-control" placeholder="Comment here...">');
        }
      }); // end ajax request*/  

});

$(document).on('keyup','#search',function(e){
    var searchterm = $(this).val();
    find(arr,searchterm);
});

function find(arr,searchterm) {
    $('#commentsection').empty();
    var result = [];

    for (var i in arr) {
        var temptext = arr[i]['text'].toLowerCase();
        var tempsearch = searchterm.toLowerCase();
        if (temptext.match(tempsearch)) {
            result.push(arr[i]);
        }
    }

    for (var j in result){
       $('#commentsection').append(result[j]['displaytext']);
    }
    $('#commentsection').append('<input id="comment" data-id="'+mediaid+'"name="comment" type="text" class="form-control" placeholder="Comment here...">');
}