/*If you're reading this then you shall know that this..... is my favortie page.......... i'll see myself out. 💩 👽 */


$(document).on('click','.favorite', function(){
var item = $(this);
var id = $(this).attr('data-id');
var check = $(this).attr('data-favorite');
$.ajax({
    type: 'POST',
    url: '/includes/ajax/addfavorite.php',   
    data: {
        id:id,
        check:check
    },
    success: function (jqXHR, textStatus, errorThrown) {
             if(jqXHR == 'true'){
                item.attr('data-favorite','true');
                item.css('color','red');
             }
             else{
                item.attr('data-favorite','false');
                item.css('color','');  
             }
    }   
    
}); // end ajax request*/ 
    
});