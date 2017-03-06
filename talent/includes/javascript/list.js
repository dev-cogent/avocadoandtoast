$(document).on('click','.addlist',function(){
var id = $(this).attr('data-id');
console.log(id);

});

// have to change to data
$(".influencer-list-table").on("click", function() {
    $('.checkmark-squared').css("background", "red");
});
