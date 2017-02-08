
var dialog;

$(document).on('click','.addtolist',function(){
var listnames;
var id = $(this).attr('data-id');
var image = $(this).attr('data-id');
var listuser = $(this).attr('data-user');
      $.ajax({
        type: 'POST',
        url: '/includes/ajax/getlistnames.php',
        success: function (jqXHR, textStatus, errorThrown) {
                if(jqXHR == '2'){
                  dialog = bootbox.dialog({
                  message: '<p> You have to be logged in to do that!</p>',
                  closeButton: true
                  });
                  dialog.modal(); 
                }
                else{
                dialog = bootbox.dialog({
                message: '<div class="popupborder"> <img class="popup-img" src="http://project.social/images/'+image+'.jpg"> </div> <br/> <h3 class="add-list"> Add '+listuser+' to a list?</h3><br/>'+
                        '<select data-name="'+listuser+'" data-id="'+id+'" id="submitlist">'+jqXHR+
                        '</select>'+
                        '<div class="btn-group popup"><button type="button" class="btn add-popup btn-outline" id="addtolist">Add to List </button>',
                            
                closeButton: true
            });
            dialog.modal();
          }
        }
      });



// do something in the background

});

$(document).on('click','#addtolist',function(){
var influencername = $('#submitlist').attr('data-name');
var users = $('#submitlist').attr('data-id');
var selected = $('#submitlist').val();
var listname = $('#submitlist').text();

      $.ajax({
        type: 'POST',
        url: '/includes/ajax/addtolist.php',
        data: {
          users:users,
          list:selected,
        },
        success: function (jqXHR, textStatus, errorThrown) {
          if(jqXHR === 1 || jqXHR === '1'){
                bootbox.alert({
                message: influencername+' has been added to '+listname,
                size: 'small'
            });
          }
          else if (jqXHR === 'Duplicate'){
                      bootbox.alert({
                      message: 'This Influencer is already in that list.',
                      size: 'small'
                  });
          }
          else {
                      bootbox.alert({
                      message: 'An error has occured! Please contact support if the issue continues.',
                      size: 'small'
                  });
          }
        }
      });

});

$(document).on('click','#createlist',function(){
    var listname = $('#listname').val();
    var description = $('#description').val();
    
    if(listname == null || listname == ''){
      alert('Please name your list to create');
      return 0;
  }
  if(selectedusers == '' || selectedusers == null || selectedusers.length <= 0){
    alert('Please select atleast 1 influencer to create a list');
    return 0;
  }



         $.ajax({
          type: 'POST',
          url: '/includes/ajax/createlist.php',
          data: {
              listname:listname,
              description:description,
              users:selectedusers
          },
          success: function (jqXHR, textStatus, errorThrown) {
                if(jqXHR === '1' || jqXHR === 1){
                  bootbox.alert({
                      message: 'The List has been created!',
                      size: 'small'
                  });
                    $('#listname').val('');
                    $('#description').val('');
                }
                else if(jqXHR === '2' || jqXHR === 2){
                  bootbox.alert({
                      message: 'You need to register to do that!',
                      size: 'small'
                  });
                }
                else if(jqXHR === 'duplicate'){
                  bootbox.alert({ 
                      message: 'There is already an exsisting list with that name. Please choose a different name.',
                      size: 'small'
                  });
                }
                else if (jqXHR === 0 || jqXHR == '0' || jqXHR === 'false'){
                  bootbox.alert({ 
                      message: 'An error has occured! If the issue persist, please contact the site admin.',
                      size: 'small'
                  });
                }
                   
          }
          }); // end ajax request*/
});




/*
    message: '<div class="popupborder"> <img class="popup-img" src="http://project.social/images/'+image+'.jpg"> </div> <br/> <h3 class="add-list"> Add '+listuser+' to a list?</h3><br/>'+
             '<div class="btn-group popup"><button type="button" class="btn add-popup btn-outline">Add to List </button>'+
                '<button type="button" class="btn add-popup dropdown-toggle btn-outline" id="exampleSplitDropdown1" data-toggle="dropdown" aria-expanded="false">'+
                                   '<span class="caret"></span>'+
                                   '<span class="sr-only">Toggle Dropdown</span></button>'+
                                 '<ul class="dropdown-menu popup-drop" aria-labelledby="exampleSplitDropdown1" role="menu">'+
                                   '<li role="presentation"><a href="javascript:void(0)" role="menuitem">Some List Name Here </a></li>'+
                                   '<li role="presentation"><a href="javascript:void(0)" role="menuitem">Another List Name </a></li>'+
                                 '</ul></div>',
    closeButton: true
    */