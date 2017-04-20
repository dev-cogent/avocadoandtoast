<?php
include 'php/verify-campaign.php'; 
error_reporting(-1);
?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <?php include 'html/head.html' ?>
    <title><?php echo $influencerinfo['campaign_name'];?> | Avocado & Toast</title>
<script src="/bootbox/bootbox.js"></script>
<script src="/global/vendor/bootstrap/bootstrap.js"></script>
<script src="/assets/js/loading.js"></script>
<script src="/assets/js/abbreviatenumber.js"></script>
<link rel="stylesheet" href="/global/fonts/brand-icons/brand-icons.css">
<link rel="stylesheet" href="/global/fonts/font-awesome/font-awesome.css">
<link rel="stylesheet" href="/assets/css/discover.css">
<link rel="stylesheet" href="/assets/css/sidebar.css">
<link rel="stylesheet" href="/assets/css/campaign-calculator.css">
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
<?php include 'php/avocado-nav.php';?>







<div id="stuff"></div>



<div class="col-xs-12 info-container">



        <div class="row">
    <div class="col-sm-12 col-lg-6 campaign-info" style="margin-left:20px;">
    <div class="camapaign-label-container">
    <div class="campaign-label-div">
    <h3 id="campaign-label" class="campaign-label" style="margin-right: 43%;">Campaign name goes here </h3> </div>

    <div class="campaign-desc-div"> <div class="campaign-desc-container"> </div>
    </div></div>
    </div>


    <button class="col-md-6 col-lg-2 col-xs-12 info-button secondary-button" style="">SUBMIT FOR PRICING</button>
    <button class="col-md-6 col-lg-2 col-xs-12 info-button main-button" id="savecampaign">SAVE CAMPAIGN </button>
   <!-- <button class="col-md-6 col-lg-2 col-xs-12 info-button secondary-button" id="add-existing">SAVE AS NEW CAMPAIGN </button> -->

    </div>
<div class="col-xs-12 campaign-select">

            </div>

    <div class="row name-index-row">
    <div class="col-lg-8 col-md-6 col-xs-12">

   </div>


    <div class="col-md-6 col-lg-4  col-xs-12 campaign-info-index">
      <div class="posts-green index-name"> POSTS </div>
      <div class="impression-blue index-name"> IMPRESSION </div>
      <div class="engagement-orange index-name"> ENGAGEMENT </div>
      <div class="social-following-red index-name"> SOCIAL FOLLOWING </div>
    </div>

  </div>



</div>

<div class="post-container col-xs-12">

              <table summary="This table shows a list of influencers added to a campaign" style="width: 100%; max-width: 100%; margin-bottom: 1rem;"class="table-hover">
                <thead class="campaign-calc-table">
                  <tr class="cat-in-campaign-list-table">
                      <th class="text-center"><button class="secondary-button" id="apply">Apply Posts to All</button></th>
                      <th class="text-center"> <img src="assets/images/ig_black.png" class="insta-logo" />
                   </th>
                      <th class="text-center"> <img src="assets/images/fb_black.png" class="fb-logo" /> <p class="number-posts-text"> </p> </th>
                      <th class="text-center"> <img src="assets/images/twitter_black.png" class="twitter-logo2" />  </th>
                        <th class="text-center total-heading">  TOTAL  </th>
                    </tr>
                  </thead>
                  <tbody id="all-influencers">
                  
                   


                    </tbody>
                </table>
</div>


<script>
var selectedusers = [];
var target2 = $('#stuff').offset().top;
var urlParams = new URLSearchParams(window.location.search);
var campaignid = urlParams.get('id');
console.log(campaignid);
</script>
<script src="/assets/js/recalculate.js"></script>
