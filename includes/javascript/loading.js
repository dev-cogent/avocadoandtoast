   function setLoading(){
       $('.modal-content').css('display','none');
                    dialog = bootbox.dialog({
                    message: 'ff',
                    closeButton: true
                });
                dialog.modal();
    $('#loading').css('display','unset');

   }

   function unsetLoading(){
    $('#loading').css('display','none');
   }