   function setLoading(){
    document.getElementById("myNav").style.height = "100%";
    $('#loading').css('display','unset');

   }

   function unsetLoading(){
    $('#loading').css('display','none');
    document.getElementById("myNav").style.height = "0%";
    
   }