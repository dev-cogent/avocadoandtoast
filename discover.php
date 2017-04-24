<?php
session_start();
error_reporting(0);
include 'php/dbinfo.php';
include 'php/numberAbbreviation.php';

?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <?php include 'html/head.html' ?>
    <title>Discover | Avocado & Toast</title>
<script src="/bootbox/bootbox.js"></script>
<script src="/global/vendor/bootstrap/bootstrap.js"></script>
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Open+Sans:400,700" rel="stylesheet">
<script src="/assets/js/abbreviatenumber.js"></script>
<script src="/assets/wnumb/wNumb.js"></script>
<script src="/assets/uislider/nouislider.js"></script>
<script src="/assets/js/tokenfield/dist/bootstrap-tokenfield.js"></script>
<script src="/assets/js/loading.js"></script>
<script src="/assets/js/avocado-card-functions.js"></script>
<script src="/assets/js/avocado-calculate.js"></script>
<script src="assets/js/influencer_pullout.js"></script>
<link rel="stylesheet" href="/assets/js/tokenfield/dist/css/bootstrap-tokenfield.css">
<link rel="stylesheet" href="/assets/uislider/nouislider.css">
<link rel="stylesheet" href="/global/fonts/brand-icons/brand-icons.css">
<link rel="stylesheet" href="/global/fonts/font-awesome/font-awesome.css">
<link rel="stylesheet" href="/assets/css/discover.css">
<link rel="stylesheet" href="/assets/css/sidebar.css">
<link rel="stylesheet" href="/assets/css/new-discover.css">
<link rel="stylesheet" href="assets/css/pullout.css">

</head>

<body>
<?php include 'php/avocado-nav.php'; ?>

<!-- right side bar -->
    <div id="influencers-pullout">
      <img id="pulltab" src="assets/images/pulltab.png" alt="">


      <header>
        <div id="num-influencers">__</div>
        <div id="header-text"> Influencers in current campaign </div>
      </header>

      <button type="button" name="button" id="calculate">Calculate campaign</button>

      <div  id="influencer-pullout-image-container">


 <!-- images go here -->


      </div>

      <div id="action-buttons">
        <button id="remove-button" class="greyed-out" type="button" name="button">Remove selected</button>
        <button id="remove-all-button" class="greyed-out" type="button" name="button">Remove all</button>
        <button id="undo-button" class="greyed-out" type="button" name="button"> Undo</button>
      </div>
    </div>

<!-- end right side bar -->

<!-- Add side bar here -->
<div id="loading"><img style="height:250px; width:250px;"src="/assets/images/loading.gif"/></div>



<!-- The third nav bar , we might be able to take this out. In the mean time, we'll keep it here -->

<div id="myNav" class="overlay"></div>
<div id="discover-container">

<!--Filter content -->




<div class="filter-section col-xs-12">
            <div class="desc-header">
                <div class="discover-header">DISCOVER</div>
                <div class="filter-text">Search by Influencer handles and keywords</div>

                    <input type="text" class="filter-input form-control category avocado-focus" id="influencer-search-name" placeholder="Influencer Name or social handle">
                    <input type="text" class="filter-input form-control category avocado-focus" id="tokenfield" placeholder="keyword"/>
                    <div class="description-text">Seperate tags with commas or by pressing "tab" in the above field. Use double quotes for multi-word tags (e.g. "avocado toast")</div>
                    <div class="button-container">
                        <button class="search-button" id="search-keyword">SEARCH</button>
                    </div>
            </div>

</div>




<div class="influencer-results-container col-xs-12">
         <div class="influencer-header">FILTER INFLUENCERS</div>

        <div class="filter-button-container" id="button-filter">
             <i class="filter-option button-icon button-icon-active icon bd-instagram"  data-platform="instagram" aria-hidden="true"></i>
            <i class="filter-option button-icon icon bd-facebook"  data-platform="facebook" aria-hidden="true"></i>
            <i class="filter-option button-icon icon bd-twitter"  data-platform="twitter" aria-hidden="true"></i>
        </div>


<!-- Slider Rows -->
        <div class="slider-container">
                <div class="measure-text">FOLLOWERS</div>
                        <div class="sliders"  data-platform="instagram">
                            <input  class="col-xs-1 input-filter " type="text" id="min-instagram">
                            <div id="slider-instagram" class="col-xs-10"></div>
                            <input id="max-instagram" class="col-xs-1 input-filter"style="display:inline; padding-left:2%; padding-right:0px;" type="text">
                        </div>

            <div class="sliders" data-platform="facebook" style="display:none;">
                <input  class="col-xs-1 input-filter" type="text" id="min-facebook">
                <div  id="slider-facebook" class="col-xs-10"></div>
                <input id="max-facebook" class="col-xs-1 input-filter"style="display:inline; padding-left:2%; padding-right:0px;" type="text">
            </div>

            <div class="sliders" data-platform="twitter" style="display:none;">
                <input  class="col-xs-1 input-filter" type="text" id="min-twitter">
                <div id="slider-twitter" class="col-xs-10"></div>
                <input id="max-twitter" class="col-xs-1 input-filter"style="display:inline; padding-left:2%; padding-right:0px;" type="text">
            </div>




            </div>

        <div class="slider-container" >
                <div class="measure-text" id="engagement-text" >ENGAGEMENT %</div>
            <div class="sliders" data-platform="instagram-engagement">
                <input  class="col-xs-1 input-filter engagement-slider " type="text" id="min-instagram-engagement">
                <div style="margin-top:20px;" id="slider-instagram-engagement" class="col-xs-10"></div>
                <input id="max-instagram-engagement" class="col-xs-1 input-filter engagement-slider"style="display:inline; padding-left:2%; padding-right:0px;" type="text">
            </div>
            <div class="sliders" data-platform="facebook-engagement" style="display:none;">
                <input  class="col-xs-1 input-filter engagement-slider" type="text" id="min-facebook-engagement">
                <div  style="margin-top:20px;" id="slider-facebook-engagement" class="col-xs-10"></div>
                <input id="max-facebook-engagement" class="col-xs-1 input-filter engagement-slider"style="display:inline; padding-left:2%; padding-right:0px;" type="text">
            </div>

            <div class="sliders" data-platform="twitter-engagement" style="display:none;">
                <input  class="col-xs-1 input-filter engagement-slider" type="text" id="min-twitter-engagement">
                <div style="margin-top:20px;" id="slider-twitter-engagement" class="col-xs-10"></div>
                <input id="max-twitter-engagement" class="col-xs-1 input-filter engagement-slider"style="display:inline; padding-left:2%; padding-right:0px;" type="text">
            </div>


            </div>












<!--end slider rows -->


    <br>
    <div class="influencer-header">INFLUENCER RESULTS</div>


       <!-- <div class="influencer-header">INFLUENCER RESULTS</div>-->

        <div class="found-influencers col-xs-12">
            <?php
                $stmt = $conn->prepare('SELECT `id`,`image_url`,`instagram_url`,`instagram_count`,`facebook_url`,`facebook_handle`,`facebook_count`,`twitter_url`,`twitter_count`,`engagement`,`total` FROM `Influencer_Information` ORDER BY `total`  DESC LIMIT 0,24');
                $stmt->execute();
                $stmt->bind_result($id,$image,$instagramurl,$instagramcount,$facebookurl,$facebookhandle,$facebookcount,$twitterurl,$twittercount,$engagement,$total);
                while($stmt->fetch()){
                $insthandle = explode('.com/',$instagramurl);
                $insthandle = explode('/',$insthandle[1]);
                $insthandle = explode('?',$insthandle[0]);
                $insthandle = $insthandle[0];
                //Facebook handle
                if($facebookhandle == NULL){
                $facebookhandle = explode('.com/',$facebookurl);
                $facebookhandle = explode('/',$facebookhandle[1]);
                $facebookhandle = explode('?',$facebookhandle[0]);
                $facebookhandle = $facebookhandle[0];
                }
                //twitter handle
                $twitterhandle = explode('.com/',$twitterurl);
                $twitterhandle = explode('/',$twitterhandle[1]);
                $twitterhandle = explode('?',$twitterhandle[0]);
                $twitterhandle = $twitterhandle[0];
                $engagement = json_decode($engagement,true);

                $twitterengagement = number_format((($engagement['twitter']['average_engagement']/$twittercount)*100),2,'.','');
                $instagramengagement = number_format((($engagement['instagram']['average_engagement']/$instagramcount)*100),2,'.','');
                $facebookengagement = number_format((($engagement['facebook']['average_engagement']/$facebookcount)*100),2,'.','');
                echo '
                    <div  class="influencer-box col-xs-12 col-md-4 col-lg-3">
                            <div class="influencer-card-discover">
                                <a href="/profile.php/?id='.$id.'"><img class="influencer-image-card" src="http://cogenttools.com/'.$image.'" onerror="this.src=`/assets/images/default-photo.png`"> </a>
                                <div class="col-xs-12 influ-bottom" style="" data-id="'.$id.'">
                                    <!-- insthandle stuff -->
                                        <div class="icons col-xs-12">
                                            <i class="switch show-instagram inst-icon icon bd-instagram" data-id="'.$id.'" data-platform="instagram" style="color:#73C48D" aria-hidden="true"></i>
                                            <i class="switch show-facebook inst-icon icon bd-facebook" data-id="'.$id.'" data-platform="facebook" aria-hidden="true"></i>
                                            <i class="switch show-twitter inst-icon icon bd-twitter" data-id="'.$id.'" data-platform="twitter" aria-hidden="true"></i>
                                        </div>
                                        <div class="col-xs-12 insthandle-info">
                                            <!--icon here -->
                                            <p class="instagram-handle insthandle-text" data-id="'.$id.'">'.$insthandle.'</p>
                                            <p class="facebook-handle insthandle-text" data-id="'.$id.'" style="display:none;">'.$facebookhandle.'</p>
                                            <p class="twitter-handle insthandle-text" data-id="'.$id.'" style="display:none;">'.$twitterhandle.'</p>
                                        </div>
                                    <!-- followers -->
                                    <div class="col-xs-12">
                                        <p class="instagram-follower-count follower-count" data-id="'.$id.'">'.numberAbbreviation($instagramcount).' Followers</p>
                                        <p class="facebook-follower-count follower-count" style="display:none" data-id="'.$id.'">'.numberAbbreviation($facebookcount).' Likes</p>
                                        <p class="twitter-follower-count follower-count" style="display:none" data-id="'.$id.'">'.numberAbbreviation($twittercount).' Followers</p>
                                    </div>
                                    <!-- Engagement -->
                                    <div class="col-xs-12">
                                        <p class="instagram-engagement engagement-count" data-id="'.$id.'">'.$instagramengagement.'% eng per post</p>
                                        <p class="facebook-engagement engagement-count" style="display:none"data-id="'.$id.'">'.$facebookengagement.'% eng per post</p>
                                        <p class="twitter-engagement engagement-count" style="display:none"data-id="'.$id.'">'.$twitterengagement.'% eng per post</p>
                                    </div>
                                    <div class="col-xs-12">

                                        <div class="col-xs-12 invite  avocado-focus" data-id="'.$id.'" data-image="'.$image.'"></div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <!-- Influencer box has ended -->';
                }
                    ?>
        </div>
</div>

</div>


</body>
</html>
<script>
$('#tokenfield').tokenfield();
var calculate = false;
var page = 0;
var selectedusers = [];
var filters = {};
var target = $("#test-height").offset().top;
var target2 = $('#discover-container').offset().top;

</script>
<script src="/assets/js/avocado-slider.js"></script>
<script src="/assets/js/avocado-discover.js"></script>
<script src="/assets/js/create-campaign.js"></script>
