$(document).on('click','#createcampaign',function(){
  dialog = bootbox.dialog({
      message: '<div class="bootbox-body">'+
 '<div class="icon-popup-div"> <img src="https://68.media.tumblr.com/0abd1f3bfd0a2594ea81787691cb6af2/tumblr_o33ti7IZMI1t4twpao1_500.gif" class="success-popup-icon"/> </div>'+
  '<div class="row"> <div class="col-xs-12 popup-detail success">   <span class="yay"> YAY! </span> <br/> Campaign created sucessfully  </div>'+
    '<div class="col-xs-12 btn-col"><div class="popup-btn-div"> <button id="applyall" class="submit-btn">VIEW CAMPAIGN </button></div> <div class="col-xs-12"><div class="submit-btn-div"> <button id="applyall" class="submit-btn"> ADD DETAILS </button></div>'+
  '</div> </div>',
      closeButton: true
  });
  dialog.modal();
/*var name = $('#campaign-name').val();
var arr = {};
for(i = 0; i < selectedusers.length; i++){
    var id = selectedusers[i];
    arr[id] = {};
    arr[id]['instagramposts'] = $('.instagraminput[data-id='+id+']').val();
    arr[id]['facebookposts'] = $('.facebookinput[data-id='+id+']').val();
    arr[id]['twitterposts'] = $('.twitterinput[data-id='+id+']').val();
}



if(name == '' || name == null){
    throw new Error('Campaign name not entered');
    return 0; // We will give actual error message later.
}
$.ajax({
    /type: 'POST',
    url: '../includes/ajax/savecampaign.php',
    data: {
        campaignname: name,
        info: JSON.stringify(arr)
    },
    success: function (jqXHR, textStatus, errorThrown) {
        if(jqXHR == 1 || jqXHR == '1'){
          dialog = bootbox.dialog({
              message: '<div class="bootbox-body">'+
         '<div class="icon-popup-div"> <img src="https://68.media.tumblr.com/0bd527025c6131b779c1d692c294354a/tumblr_o5asqmb3WP1txllk0o1_r2_500.gif" class="avocado-popup-icon"/> </div>'+
          '<div class="row"> <div class="col-xs-12 popup-detail">  HOORAY BITCHES!  </div>'+
          '<div class="col-xs-1" style="width: 12.499999995%"></div><div class="col-xs-3 input-div">'+
            '<img src="assets/images/fb-logo-green.png" class="fb-logo-popup">'+
          '<div class="quantity"><input type="number" id="get-facebook" value="0" class="input-popup avocado-focus"></div> </div>'+
          '<div class="col-xs-3 input-div"> <img src="assets/images/instagram-logo-green.png" class="insta-logo-popup"> <input type="number" id="get-instagram" value="0" class="input-popup avocado-focus"> </div>'+
          '<div class="col-xs-3 input-div">'+
        '<img src="assets/images/twitter-logo-green.png" class="twitter-icon-popup">'+
          '<input type="number" id="get-twitter" value="0"  class="input-popup"> '+
          '</div><div class="col-xs-1" style="width: 12.499999995%"></div></div>'+
            '<div class="submit-btn-div"> <button id="applyall" class="submit-btn">Submit</button>'+
          '</div> </div>',
              closeButton: true
          });
          dialog.modal();
        }
    }
}); // end ajax request*/






});
