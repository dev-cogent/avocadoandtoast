<?php
session_start(); 
error_reporting(-1);
include '../php/dbinfo.php';
include '../php/class/savecampaign.php';
include '../php/numberAbbreviation.php';
//$url = $_SERVER['REQUEST_URI'];
//$id = explode('/',$url);
$id = $_GET['id'];
if($id == NULL){
$campaignid = $_SESSION['temp_campaign_id'];
}
else{
$campaignid = $id;
}


$save = new saveCampaign;
//Checking for campaign validity
$checkcampaign = $save->checkCampaign($campaignid, $_SESSION['column_id']);
if($checkcampaign === false) header('Location: /dashboard.php');

//If all is good, we continue. 



?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <?php include '../html/head.html' ?>
    <title><?php echo $influencerinfo['campaign_name'];?> | Avocado & Toast</title>
<script src="/assets/js/abbreviatenumber.js"></script>
<script src="/global/vendor/bootstrap/bootstrap.js"></script>

<script src="/assets/js/avocado-campaign.js"></script>

<link rel="stylesheet" href="/assets/js/tokenfield/dist/css/bootstrap-tokenfield.css">
<link rel="stylesheet" href="/global/fonts/brand-icons/brand-icons.css">
<link rel="stylesheet" href="/global/fonts/font-awesome/font-awesome.css">
<link rel="stylesheet" href="/assets/css/discover.css">
<link rel="stylesheet" href="/assets/css/sidebar.css">
<style>
.stats{
    color: #73C48D;
    font-family: 'montserratsemibold';
    font-size: 40px;
    padding-right: 17px;
    font-weight: 600;
    padding-top: 10px;

}
.label-info{

    color: rgb(29, 40, 76);
    font-weight: 600;
    font-size: 13px;
    font-family: 'open sans';
    padding-bottom: 10px;

}
.campaign-details{
font-size:15px;
color:rgb(29, 40, 76);
font-family:'open sans';
padding-top: 30px;
width:20%;
}

.engagement-count{
    padding-bottom:0px;
    margin-bottom:0px;
}

.invite{
    margin-left:0%;
}


.btn-campaign-options{
    width: 160px;
    height: 35px;
    background-color: white;
    border: 1px solid black;
    font-size:12px;
    margin-right:5px;
    font-family:'montserratlight';

}
.button-container{
padding-left: 90px;
border-bottom: 0px;
height: 145px;
padding-top: 45px;
}

</style>
</head>

<body class="col-xs-12" style="padding-left:0px;padding-right:0px;">
<?php include '../php/avocado-nav.php';?>








<!-- Add side bar here -->


<div id="stuff"></div>




<!--Filter content -->


<div class="button-container col-xs-12" style="border-bottom:0px; height:145px; padding-top:45px;">
  <a href="/edit/?id=<?php echo $campaignid;?>" style="color:black;">  <button class="btn-campaign-options avocado-hover avocado-focus">  EDIT CAMPAIGN  </button></a>
  <a href="#"style="color:black;" class="pdf" data-id="<?php echo $campaignid; ?>">  <button class="btn-campaign-options avocado-hover avocado-focus">  EXPORT CAMPAIGN  </button></a>
  <a href="/price/?id=<?php echo $campaignid;?>" style="color:black;">  <button class="btn-campaign-options avocado-hover avocado-focus">  PRICE CAMPAIGN  </button></a>
  <a href="/recalculate.php?id=<?php echo $campaignid;?>" style="color:black;">  <button class="btn-campaign-options avocado-hover avocado-focus">  CALCULATE CAMPAIGN  </button></a>
  <a style="display:none;" id="undo-button" >  <button class="btn-campaign-options avocado-hover avocado-focus" style="background-color:#73C48D; color:white; border:0px;">UNDO</button></a>
  <a style="display:none;" id="save-button" >  <button class="btn-campaign-options avocado-hover avocado-focus" style="background-color:#73C48D; color:white; border:0px;">SAVE</button></a>
</div>

<div class="col-xs-12" style="padding-left:75px;">
    <div class="user-campaign-name col-xs-2" id="campaign-name" style="padding-left:13px; padding-bottom:20px; margin-left:0px; margin-top: -12px; color:#73C48D;">

    <p style="font-size:13px; color:rgb(29, 40, 76);" id="campaign-description"><span><strong>Campaign Summary: </strong></span></p>
    
    </div>
  <!--  <div class="user-campaign-inf-count"> <span class="campaign-inf-count"><?php// echo $influencerinfo['campaign_count'];?> </span> Influencers Invited to this Campaign </div> -->

    <div class="col-xs-9" id="campaign-breakdown" style="height:240px; padding-bottom:30px; border-radius: 4px;">
        <div class="col-xs-12" style="border:1px solid rgb(210,215,220);">
        <div class="campaign-block col-xs-12"  style="padding-left:75px;" >
        <table class="col-xs-12">
            <tbody style="border-top:0px;">
            <tr>
                <td class="stats" id="influnum"></td>
                <td class="stats" id="total-posts"></td>
                <td class="stats" id="avg-impressions" data-number="0"></td>
                <td class="stats" id="avg-engagement" data-number="0"></td>
                <td class="stats"id="total-reach" data-num="0"></td>
                <td class="stats"id="total-engagement" data-number="0"></td>
            </tr>
            <tr>
                <td class="label-info">Influencers</td>
                <td class="label-info">Total Post</td>
                <td class="label-info">Avg Impressions</td>
                <td class="label-info"> Avg Engagement</td>
                <td class="label-info"> Total Reach</td>
                <td class="label-info"> Total Engagement</td>
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

