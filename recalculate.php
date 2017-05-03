<?php
include 'php/verify-campaign.php';
error_reporting(-1);
?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <?php include 'html/head.html' ?>
    <title> Recalculate | Avocado & Toast</title>
    <script src="/bootbox/bootbox.js"></script>
    <script src="/global/vendor/bootstrap/bootstrap.js"></script>
    <script src="/assets/js/abbreviatenumber.js"></script>
    <script src="/assets/js/loading.js"></script>
    <link rel="stylesheet" href="/global/fonts/brand-icons/brand-icons.css">
    <link rel="stylesheet" href="/global/fonts/font-awesome/font-awesome.css">
    <link rel="stylesheet" href="/assets/css/campaign-calculator.css">
</head>

<body>
<?php include 'php/avocado-nav.php';?>
  <div id="loading"><img style="height:250px; width:250px;"src="/assets/images/loading.gif"/></div>
  <div id="myNav" class="overlay"></div>
<div class="container-fluid">
<div class="info-container">



       <div class="row">

   <div class="col-sm-12 col-md-6 col-lg-6 campaign-info" style="">
   <div class="camapaign-label-container mobile">
   <div class="campaign-label-div">
   <h4 id="campaign-label" class="campaign-label">CAMPAIGN NAME: </h4></div>


    <div class="select-campaign-container small">
           <div class="add-to-existing-container">

     </div>
           </div>

   </div></div>



<div class="col-xs-12 col-sm-10 col-md-6 col-lg-6 campaign-select">


 <div class="campaign-calc-btn-container tablet">
   <button class="info-button secondary-button mobile sm-mobile" id="price-campaign" style="">SUBMIT FOR PRICING</button>
   <button class="info-button main-button primary-button mobile sm-mobile" id="savecampaign">SAVE CAMPAIGN </button>
   </div>


           </div>
           </div>
   </div>

   <div class="row">


       <div class="campaign-info-index col-xs-12">
     <div class="posts-green index-name"> POSTS </div>
     <div class="impression-blue index-name"> IMPRESSION </div>
     <div class="engagement-orange index-name"> ENGAGEMENT </div>
     <div class="social-following-red index-name"> SOCIAL FOLLOWING </div>
   </div>

   </div>


<div class="post-container col-xs-12 tablet mobile">

             <table summary="This table shows a list of influencers added to a campaign" class="table-hover">
               <thead class="campaign-calc-table">
                 <tr class="cat-in-influencer-result-row">
                     <th class="text-center" scope="col"><button class="secondary-button mobile-apply small" id="apply">Apply Posts to All</button></th>
                     <th class="text-center" scope="col"> <img src="assets/images/ig_black.png" class="insta-logo" />
                  </th>
                     <th class="text-center" scope="col"> <img src="assets/images/fb_black.png" class="fb-logo" /> <p class="number-posts-text"> </p> </th>
                     <th class="text-center" scope="col"> <img src="assets/images/twitter_black.png" class="twitter-logo2" />  </th>
                       <th class="text-center total-heading" scope="col">  TOTAL  </th>
                   </tr>
                 </thead>
                 <tbody id="all-influencers">








                    </tbody>
                </table>
</div>


<script>
var selectedusers = [];
var urlParams = new URLSearchParams(window.location.search);
var campaignid = urlParams.get('id');
console.log(campaignid);
</script>
<script src="/assets/js/recalculate.js"></script>
