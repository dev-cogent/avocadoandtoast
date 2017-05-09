<?php
session_start();
error_reporting(0);
$campaignid = $_GET['id'];
?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <?php include '../html/head.html' ?>
    <title>Curated List | Avocado & Toast</title>
<script src="/assets/js/avocado-card-function.js"></script>
<script src="/assets/js/abbreviatenumber.js"></script>
<script src="/global/vendor/bootstrap/bootstrap.js"></script>
<script src="/bootbox/bootbox.js"></script>
<script src="/assets/js/curated-list.js"></script>
<script src="/assets/js/influencer_pullout.js"></script>
<script src="/assets/js/loading.js"></script>
<link rel="stylesheet" href="/assets/css/pullout.css">
<link rel="stylesheet" href="/global/fonts/brand-icons/brand-icons.css">
<link rel="stylesheet" href="/global/fonts/font-awesome/font-awesome.css">
<link rel="stylesheet" href="/assets/css/avocado-campaign.css">
<link rel="stylesheet" href="/assets/css/influencer-card.css">
<link rel="stylesheet" href="/assets/css/curated-lists.css">


</head>
<?php include '../php/avocado-nav.php';?>

<body>
<!-- right side bar -->
    <div id="influencers-pullout">
      <img id="pulltab" src="/assets/images/pulltab_icon.png" alt="">
      <header>
            <div id="num-influencers">__</div>
            <div id="header-text">
            Influencers in current List
            </div>
            <div id=dismiss-button>x</div>
      </header>

      <button type="button" name="button" id="calculate">Calculate List</button>


      <div  id="influencer-pullout-image-container">


 <!-- images go here -->


      </div>

      <div id="action-buttons">
        <button id="remove-button" class="greyed-out" type="button" name="button">Remove selected</button>
        <button id="remove-all-button" class="greyed-out" type="button" name="button">Remove all</button>
        <button id="undo-button" class="greyed-out" type="button" name="button"> Undo</button>
      </div>
    </div>
<div id="loading"><img style="height:250px; width:250px;"src="/assets/images/loading.gif"/></div>
<div id="myNav" class="overlay"></div>

<!-- Add side bar here -->



<!--Filter content -->

<div class="col-xs-12 campaign-details">
    <div class="campaign-name col-xs-12" id="campaign-name"> </div>
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
                                        <div class="influencer-icons col-xs-12"></div>
                                        <div class="col-xs-12 handle-info">
                                                <p class="instagram-handle handle-text" data-id=""></p>
                                                <p class="facebook-handle handle-text" data-id="" style="display:none;"></p>
                                                <p class="twitter-handle handle-text" data-id="" style="display:none;"></p>
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
var sidebar = false;




</script>
