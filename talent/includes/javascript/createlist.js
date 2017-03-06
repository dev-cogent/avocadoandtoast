   $(document).on('keyup','#search',function(e){
        page = 0;
        search = $('#search').val();
        pagination(search,page,true);


    });




    $(window).scroll(function() {

    if($(window).scrollTop() == $(document).height() - $(window).height()) {
        page = page+1;
        console.log(search);
        pagination(search,page,false);

    }
});


function pagination(search,page, issearch){
         if(search == null) return 0;
         $.ajax({
        type: 'POST',
        url: '/includes/ajax/cardpagination.php',
        data: {
            search:search,
            page:page
        },
        success: function (jqXHR, textStatus, errorThrown) {
            if(issearch == true) $('#content').empty();
            $('#content').append(jqXHR);

            }

        }); // end ajax request*/
}



  $(document).on('click','.add',function(){
    var image = $(this).attr('data-image');
    var id = $(this).attr('data-id');
    var data = $(this).attr('data-check');

      if(data == 'true'){
            changeAmount('negative');
            $(this).css('border','1px solid rgba(243,244,245,1)');
            //$(this).css('visibility','hidden');
            $(this).attr('data-check','false');
            var del = $('#circles [data-id="'+id+'"]');
            if(del.attr('data-type') == 'appended'){
                changeNumber('negative');
            }
            del.remove();
            var i = selectedusers.indexOf(id);
            if(i != -1) {
                selectedusers.splice(i, 1);
                if(selectedusers.length <= 4){
                changeNumber('reset');
                $('.appendimages').each(function(){
                    var image = $(this).attr('data-image');
                    var id = $(this).attr('data-id');
                    $('#circles').prepend('<img src="http://project.social/'+image+'" data-image="'+image+'" data-id="'+id+'" class="added img-circle">');

                });
                $('#append').empty();

                $('#scrollcircle').css('visibility','hidden');

                }

            }



      }
      else{
          changeAmount('positive');
          $(this).css('border','1px solid #c6c6c6');
          $(this).attr('data-check','true');
          selectedusers.push(id);
          if(selectedusers.length > 4){
              changeNumber('positive');
              $('#scrollcircle').css('visibility','visible');
              $('#append').append('<img src="http://project.social/'+image+'" data-image="'+image+'" data-id="'+id+'" data-type="appended"class="added img-circle appendimages" style="margin-bottom: 20px;">');
          }
          else{
              $('#circles').prepend('<img src="http://project.social/'+image+'" data-image="'+image+'" data-id="'+id+'" class="added img-circle">');
          }

          /*
            border.css('background-color','#191d59');
            border.css('color','white');
            */
      }
  });


  $('#clearall').click(function(){
      selectedusers = [];
      $('#circles').empty();
      $('#circles').append('<div class="tooltip tooltip-scroll" id="scrollcircle" style="display:inline;"><p id="usercount">+0</p>'+
              '<div class="wrapper">'+
                  '<span class="tooltip-text" id="append">'+
                  '</span></div></div>');
      changeAmount('reset');
      $('.add').each(function(){
          $(this).attr('data-check','false');
          $(this).css('border','1px solid rgba(243,244,245,1)');

      });
  });



function changeAmount(type){
    if(type == 'positive'){
        var text = ($('#amount').text());
        text.charAt(0);
        text = parseInt(text);
        text = text + 1;
        console.log(text);
        $('#amount').text(text+' Selected Users');
    }

    if(type=='negative'){
        var text = ($('#amount').text());
        text.charAt(0);
        text = parseInt(text);
        text = text - 1;
        $('#amount').text(text+' Selected Users');
    }

    if(type=='reset'){
        $('#amount').text('0 Selected Users');
    }


}


function changeNumber(type){
if(type == 'positive'){
    var text = ($('#usercount').text());
    console.log(text);
    text = text.slice(1);
    text = parseInt(text);
    text = text + 1;
    $('#usercount').text('+'+text);
}
if(type == 'negative'){
    var text = ($('#usercount').text());
    console.log(text);
    text = text.slice(1);
    text = parseInt(text);
    text = text - 1;
    $('#usercount').text('+'+text);

}
if(type=='reset'){
    $('#usercount').text('+0');
}



}
