$(document).ready(function(){
        $.ajax({
            type: 'POST',
            url: '/php/ajax/getCampaignInfo.php',
            data: {
                campaignid: campaignid
            },
            success: function (jqXHR, textStatus, errorThrown) {
                campaignJSON = JSON.parse(jqXHR);
                $('#edit-campaign-name').append(campaignJSON.campaignname);
                $('#name').val(campaignJSON.campaignname);
                $('#campaign-summary').val(campaignJSON.description);
                $('#campaign-request').val(campaignJSON.campaignrequest);
                $('#campaign-start').val(campaignJSON.campaignstart);
                $('#campaign-end').val(campaignJSON.campaignend);
                $('#brand-name').val(campaignJSON.brandname);
        } // end ajax request*/

    });


});


$(document).on('click','#submit-campaign',function(){
    const campaignname = $('#name').val();
    const campaignsummary = $('#campaign-summary').val();
    const campaignrequest = $('#campaign-request').val();
    const campaignstart = $('#campaign-start').val();
    const campaignend = $('#campaign-end').val();
    const brandname = $('#brand-name').val();
    $.ajax({
        type: 'POST',
        url: '/php/ajax/updatecampaign.php',
        data: {
            campaignid : campaignid,
            campaignname: campaignname,
            campaignsummary: campaignsummary,
            campaignrequest:campaignrequest,
            campaignstart:campaignstart,
            campaignend:campaignend,
            brandname:brandname
        },
        success: function (jqXHR, textStatus, errorThrown) {
          dialog = bootbox.dialog({
              message: '<div class="bootbox-body">' +
              '<div class="icon-popup-div"> <img src="/assets/images/chasing_2.gif" class="success-popup-icon"/> </div>' +
              '<div class="row"> <div class="col-xs-12 popup-detail success">   <span class="yay"> YAY! </span> <br/> Campaign created sucessfully  </div>' +
              '<div class="col-xs-12 btn-col"><div class="popup-btn-div"> <a href="/campaigns/?id=' + campaignid + '"><button class="submit-btn">VIEW CAMPAIGN </button></a></div>' +
              '</div> </div>',
              closeButton: true
          });

          dialog.modal();
          setTimeout(function () {
            location.href="/campaigns/?id="+campaignid;
          }, 3000);
        }

    }); // end ajax request*/

});

/*DELETE BUTTON IS HERE */
$(document).on('click','#delete-campaign',function(){

  dialog = bootbox.dialog({
    message:   '<div class="bootbox-body">'+
      '<div class="delete-icon-popup-div"> <img src="/assets/images/delete.png" class="trash-icon"/> </div>'+
      '<div class="row"> <div class="delete-popup-detail">   <span class="delete-list-text"> DELETE LIST?  </span> <br/> Once deleted this action cannot be undone </div>'+
      '<div class="delete-btn-div"> <button class="delete-yes primary-button" type="button"> DELETE '+
      '</button> <button class="delete-no secondary-button" type="button"> NOPE </button></div>'+
      '</div>',
    closeButton: true
  });

  dialog.modal();


});

/*WHEN DELETE BUTTON IS CLICKED ON THIS HAPPENS */
$(document).on('click','.delete-yes', function(){
  var campaignid = $(this).attr('data-campaign');
  var campaignname = $(this).attr('data-name');
  $.ajax({
  type: 'POST',
  url: '/php/ajax/deletecampaign.php',
  data: {
      campaignid : campaignid,
      campaignname: campaignname,
  },
  success: function (jqXHR, textStatus, errorThrown) {
    dialog = bootbox.dialog({
      message: '<div class="bootbox-body">' +
      '<div class="delete-icon-popup-div"> <img src="/assets/images/delete.png" class="trash-icon margin"/> </div>' +
      '<div class="row"> <div class="delete-popup-detail"> <span class="delete-list-text"> SUCCESS! </span> <br>  List has been deleted sucessfully  </div>' +
      '<div class="delete-btn-div"> <a href="/campaigns/?id=' + campaignid + '"></a></div>' +
      '</div>',
        closeButton: true
    });
    dialog.modal();
    setTimeout(function () {
      location.href="/dashboard.php";
    }, 3000);
  }

}); // end ajax request*/


});
