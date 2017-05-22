$(document).on('keydown','.filter-input',function(e){

  if(e.which == 9)setNewValue();


  var search = $(this).val();
  if(search.length < 3) return 0;
  if(search == '') showKeyword('Search...');

  $.ajax({
      type: 'POST',
      url: '/php/ajax/getKeywords.php',
      data:{
        keyword:search
      },
      success: function(jqXHR, textStatus, errorThrown) {
        showKeyword(jqXHR);
      }
  }); // end ajax request*/

});


function showKeyword(word){
  $('.filter-input').attr('placeholder',word);
  return 0;
}


function setNewValue(){
  var newValue = $('.filter-input').attr('placeholder');
  $('.filter-input').val(newValue);
  return 0;
}
