<?php
session_start();
error_reporting(0);
include '../php/verify-campaign.php';
//If all is good, we continue. 
?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <?php include '../html/head.html' ?>
    <title>Campaign | Avocado & Toast</title>
<script src="/assets/js/abbreviatenumber.js"></script>
<script src="/global/vendor/bootstrap/bootstrap.js"></script>
<script src="/bootbox/bootbox.js"></script>
<script src="/assets/js/avocado-campaign.js"></script>

<link rel="stylesheet" href="/assets/js/tokenfield/dist/css/bootstrap-tokenfield.css">
<link rel="stylesheet" href="/global/fonts/brand-icons/brand-icons.css">
<link rel="stylesheet" href="/global/fonts/font-awesome/font-awesome.css">
<link rel="stylesheet" href="/assets/css/discover.css">
<link rel="stylesheet" href="/assets/css/sidebar.css">
<link rel="stylesheet" href="/assets/css/avocado-campaign.css">
</head>
<?php include '../php/avocado-nav.php';?>

<body>



<!-- Add side bar here -->
 


<!--Filter content -->

<div class="col-xs-12 campaign-details">
    <div class="campaign-name col-xs-12" id="campaign-name"> </div>
    <div class="campaign-summary col-xs-12" id="campaign-description"><span><strong>Campaign Summary:</strong></span> </div>
</div>



<div class="button-container col-xs-12">
   <button class="btn-campaign-options avocado-hover avocado-focus" onclick="location.href='/edit/?id=<?php echo $campaignid;?>'">  EDIT   </button></a>
   <button class="btn-campaign-options avocado-hover avocado-focus pdf" data-id="<?php echo $campaignid; ?>">  EXPORT </button></a>
   <button class="btn-campaign-options avocado-hover avocado-focus" onclick="location.href='/price/?id=<?php echo $campaignid;?>'">  PRICE </button></a>
   <button class="btn-campaign-options avocado-hover avocado-focus" onclick="location.href='/recalculate.php?id=<?php echo $campaignid;?>'">  RECALCULATE  </button></a>
   <button class="btn-campaign-options-primary  avocado-focus" id="undo-button" style="visibility:hidden;">UNDO</button></a>
   <button class="btn-campaign-options-primary  avocado-focus" id="save-button" style="visibility:hidden;">SAVE</button></a>
</div>


  <!--  <div class="user-campaign-inf-count"> <span class="campaign-inf-count"><?php// echo $influencerinfo['campaign_count'];?> </span> Influencers Invited to this Campaign </div> -->

    <div class="col-xs-12" id="campaign-breakdown">
        <div class="col-xs-12 campaign-border">
        <div class="campaign-block col-xs-12"  >
        <table class="col-xs-12">
            <tbody style="border-top:0px;">
            <tr>
                <td class="stats" id="influnum"></td>
                <td class="stats" id="total-posts"></td>
                <td class="stats mobile-off" id="avg-impressions" data-number="0"></td>
                <td class="stats mobile-off" id="avg-engagement" data-number="0"></td>
                <td class="stats"id="total-reach" data-number="0"></td>
                <td class="stats"id="total-engagement" data-number="0"></td>
            </tr>
            <tr>
                <td class="label-info">Influencers</td>
                <td class="label-info">Posts</td>
                <td class="label-info mobile-off">Avg Impressions</td>
                <td class="label-info mobile-off"> Avg Engagement</td>
                <td class="label-info">Reach</td>
                <td class="label-info">Engagement</td>
            </tr>
            </tbody>
        </table>
    </div>
        </div>



    </div>



 






        <div class="found-influencers col-xs-12">

<!--                    <div  class="influencer-box col-xs-12 col-md-6 col-lg-3 col-xl-2" data-id="" data-t-post="" data-f-post=""
                    data-i-post="" data-t-impressions="" data-f-impressions="" data-i-impressions="" 
                    data-t-engagement="" data-i-engagement="" data-f-engagement="">
                            <div class="influencer-card-discover">
                                <img class="influencer-image-card" src="image-goes-here" onerror="this.src=`/assets/images/default-photo.png`">
                                    <div class="col-xs-12" style="height:170px; box-shadow: rgb(115, 196, 141) 0px -10px 0px;">
                                        <!-- insthandle stuff -->
                                    <!--
                                        <div class="icons col-xs-12"></div>
                                        <div class="col-xs-12 insthandle-info">
                                                <p class="instagram-handle insthandle-text" data-id=""></p>
                                                <p class="facebook-handle insthandle-text" data-id="" style="display:none;"></p>
                                                <p class="twitter-handle insthandle-text" data-id="" style="display:none;"></p>                                            
                                        </div>
                                    <!-- followers -->
                                    <!--
                                    <div class="col-xs-12">
                                        <p class="instagram-follower-count follower-count" data-id=""> Impressions</p>
                                        <p class="facebook-follower-count follower-count" style="display:none" data-id="">Impressions</p>
                                        <p class="twitter-follower-count follower-count" style="display:none" data-id=""> Impressions</p>
                                    </div>
                                    <!-- Engagement ?-->
                                    <!--
                                    <div class="col-xs-12">
                                        <p class="instagram-engagement engagement-count" data-id=""> Engagaement </p>
                                        <p class="facebook-engagement engagement-count" style="display:none"data-id=""> Engagaement</p>
                                        <p class="twitter-engagement engagement-count" style="display:none"data-id=""> Engagement</p>

                                    </div>
                                    <div class="col-xs-12">
                                    <div style="display:inline; background-color:white; margin-top:1px; margin-bottom:4px; height:28px; padding-top:0px; width:100%;"class="col-xs-12 invite  avocado-focus" data-id="'.$influencerid.'" data-image="">
                                              <p  class="instagram-total-post total-post" data-id="" style="text-align:center;padding-top: 3px; color:#73C48D;">  total post(s) </p>
                                               <p  class="facebook-total-post total-post" data-id="" style="text-align:center;padding-top: 3px; color:#73C48D; display:none;">  total post(s) </p>
                                               <p  class="twitter-total-post total-post" data-id="" style="text-align:center;padding-top: 3px; color:#73C48D; display:none;">  total post(s) </p>
                                              <i class="icon fa-check check" aria-hidden="true" style="text-align:center; width:100%; margin-left:0px;"></i>
                                    </div> 
                                </div>
                            </div>
                        </div>
                </div>
                    <!-- Influencer box has ended -->

                



 
            
        </div>
</div>

</div>


</body>
</html>
<script>
var campaignid = '<?php echo $campaignid; ?>';
var calculate = false;
var page = 0;
var selectedusers = [];
var deletedusers = [];
var filters = {};
var target2 = $('#stuff').offset().top;
var sidebar = false;
console.log(target2);

$(document).on('click','.sidebar-left',function(){

if(sidebar == false){
$(this).animate({
'max-width':'300px',
 'width':'300px'
}, 'slow');
$('#li-container').fadeIn();
sidebar = true;
}

else{
    $(this).animate({
    'width':'55px',
    'max-width':'55px'
},'slow');
$('#li-container').fadeOut();
sidebar = false;
}



});

$(document).on('click','.pdf',function(){
var id = $(this).attr('data-id');
window.location='/assets/pdf/pdf.php?id='+id;


});
$('#tokenfield').tokenfield();
</script>

