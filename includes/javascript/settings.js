$(document).on('click','#logout',function(){

            $.ajax({
            type: 'POST',
            url: '/includes/ajax/logout.php',
            success: function (jqXHR, textStatus, errorThrown) {
            console.log('Goodbye :)');
            location.href="/login.php";
            }
            }); // end ajax request*/

});


// Menu side toggle
// $('document').ready(function(){
//   $('button.navbar-toggle').click(function(){
//     var navbar_obj = $($(this).data("target"));
//     navbar_obj.toggleClass("open");
//   });
// });
//
// $(window).on('swipe', function(data){
//   console.log("Swipe event");
// });

$(document).ready(function() {
    $(".dropdown-toggle").dropdown();
});
// adds button overlay functionality
$(document).ready(function(){
    $(".button ").click(function(){
        $(".overlay2").fadeToggle(200);
       $(this).toggleClass('btn-open').toggleClass('btn-close');
    });
});
$('.overlay2').on('click', function(){
    $(".overlay2").fadeToggle(200);
    $(".button ").toggleClass('btn-open').toggleClass('btn-close');
    open = false;
});
