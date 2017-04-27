$(document).on('mouseover', '.other-nav',function(){
$(this).css('box-shadow','inset 0 0px 0 white, inset 0 -3.5px 0 #73c48d');
});
$(document).on('mouseleave', '.other-nav',function(){
$(this).css('box-shadow','none');
});