<?php
session_start();
//error_reporting(0);
include 'includes/dbinfo.php';
include 'includes/numberAbbreviation.php';

?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <?php include 'includes/head.php' ?>
    <title>Blank Page | Project Social</title>
<script src="/bootbox/bootbox.js"></script>
<script src="/global/vendor/bootstrap/bootstrap.js"></script>
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Open+Sans:400,700" rel="stylesheet">
<script src="/assets/wnumb/wNumb.js"></script>
<script src="/assets/uislider/nouislider.js"></script>
<script src="/includes/javascript/tokenfield/dist/bootstrap-tokenfield.js"></script>
<link rel="stylesheet" href="/includes/javascript/tokenfield/dist/css/bootstrap-tokenfield.css">
<link rel="stylesheet" href="/assets/uislider/nouislider.css">
<link rel="stylesheet" href="/global/fonts/brand-icons/brand-icons.css">
<link rel="stylesheet" href="/global/fonts/font-awesome/font-awesome.css">
<link rel="stylesheet" href="/includes/css/discover.css">

</head>

<body class="col-xs-12" style="padding-left:0px;padding-right:0px;">
    <div class="col-xs-12" style="border-top: 1px solid rgb(210,215,220); border-bottom:1px solid rgb(210,215,220); height:66px;">
       <img src="/assets/images/at-logo-black.png" style="margin-top:-8px;">

    </div>
<!-- Content where the discover, communicatie, order management would be -->
<div class="mininav" style="margin-top:65px" >
    <p class="nav2"> <a href="" class="discover-nav"> DISCOVER </a> </p>
      <p class="nav2"> <a href="" class="create-nav"> CREATE </a> </p>
        <p class="nav2"> <a href="" class="price-nav">  PRICE CAMPAIGN </a></p>
          <p class="nav2"> <a href="" class="campaign-nav"> YOUR CAMPAIGNS </a>  </p>
</div>








<!-- Add side bar here -->

<div class="col-xs-1 sidebar-left">
<i class="icon fa-bars" aria-hidden="true" style="
    color: white;
    text-align: center;
    font-size: 21px;
    margin-left: 5px;
    height: 20px;
    padding-top: 15px;
"></i>
</div>


<!-- The third nav bar , we might be able to take this out. In the mean time, we'll keep it here -->

<div class="mininav col-xs-12" style="height:50px;">
    <p class="nav3">INFLUENCERS</p>
</div>
<div id="stuff">

<!--Filter content -->

<div class="filter-container col-xs-9">
            <p class="desc-header col-xs-12" style="padding-left:0px; padding-top:10px;text-align:center; font-family:'montserratsemibold'; letter-spacing: 2px; font-size:32px;">DISCOVER</p>

            <div class="col-xs-2"></div>
            <div class="col-xs-8" id="searchA">
                <p class="filter-text col-xs-12" style="text-align: center;">Search by Influencer handles and key words</p>
                    <input type="text" class="form-control category avocado-focus" id="influencer-search-name" placeholder="lebronjames">
                    <input type="text" class="form-control category avocado-focus col-xs-6 col-sm-12" style="margin-top:12px;" id="tokenfield"/>
                    <p class="description-text col-xs-12">Seperate tags with commas or by pressing "tab" in the above field. Use double quotes for multi-word tags (e.g. "avocado toast")</p>
                    <button class="search avocado-hover col-xs-12" id="search-keyword">SEARCH</button>
            </div>
            <div class="col-xs-2"></div>



    </div>





<div class="user-container col-xs-3" id="test-height">
    <div id="fixed-position">
    <p style="margin-top:1rem; font-weight:600;" class="filter-text"> Influencers Inside this Campaign </p>
    <p id="count">0</p>

    <button id="viewall" class="show-hidden">View All </button>
    <button id="calculate" class="avocado-button-focus">Calculate Campaign </button>


<!-- Eventually items will be appened here -->
    <div id="added-influencers">
        <!-- Influencers go here -->
    </div>
        <button id="additional-influencers" class="show-hidden" style="visibility:hidden" data-number="0">+0 More</button>
    </div>
</div>

<div class="filter-container col-xs-9" style="height:100%; border-bottom:0px;">
    <p class="desc-header col-xs-12">Influencer Results</p>

        <div class="col-xs-12 col-md-12 col-lg-3 col-xl-2" id="button-filter">
            <button class="col-xs-12 filter-option" data-platform="instagram" style="    background-color: rgb(115, 196, 141);"><div class="filter-option-text"> <i class="button-icon icon bd-instagram"  data-platform="instagram" aria-hidden="true"></i> INSTAGRAM</div></button>
            <button class="col-xs-12 filter-option" data-platform="facebook"><div class="filter-option-text"> <i class="button-icon icon bd-facebook"  data-platform="facebook" aria-hidden="true"></i> FACEBOOK</div></button>
            <button class="col-xs-12 filter-option" data-platform="twitter"><div class="filter-option-text"> <i class="button-icon icon bd-twitter"  data-platform="twitter" aria-hidden="true"></i> TWITTER</div></button>


        </div>


        <div class="col-xs-12 col-md-4 col-lg-3 col-xl-2" id="text-container" style="padding-bottom:25px;">
                <p class="filter-text">Filter Results</p>
                <p class="measure-text">FOLLOWERS</p>
                <p class="measure-text">LIKES PER POST </p>
        </div>
        <div class="col-xs-12 col-md-8 col-lg-6 col-xl-8" id="slider-container">
            <p id="influ-result"> Use the filters below to fine-tune your influencer results. </p>
            <!-- Instagram slider -->
            <div class="sliders" data-platform="instagram">
                <input  class="col-xs-1 input-filter " type="text" id="min-instagram">
                <div id="slider-instagram" class="col-xs-10"></div>
                <input id="max-instagram" class="col-xs-1 input-filter"style="display:inline; padding-left:2%; padding-right:0px;" type="text">
            </div>
            <div class="sliders" data-platform="instagram-engagement">
                <input  class="col-xs-1 input-filter engagement-slider " type="text" id="min-instagram-engagement">
                <div style="margin-top:20px;" id="slider-instagram-engagement" class="col-xs-10"></div>
                <input id="max-instagram-engagement" class="col-xs-1 input-filter engagement-slider"style="display:inline; padding-left:2%; padding-right:0px;" type="text">
            </div>
            <!-- end instagram slider -->


            <!-- Start Facebook slider -->
            <div class="sliders" data-platform="facebook" style="display:none;">
                <input  class="col-xs-1 input-filter" type="text" id="min-facebook">
                <div  id="slider-facebook" class="col-xs-10"></div>
                <input id="max-facebook" class="col-xs-1 input-filter"style="display:inline; padding-left:2%; padding-right:0px;" type="text">
            </div>
            <div class="sliders" data-platform="facebook-engagement" style="display:none;">
                <input  class="col-xs-1 input-filter engagement-slider" type="text" id="min-facebook-engagement">
                <div  style="margin-top:20px;" id="slider-facebook-engagement" class="col-xs-10"></div>
                <input id="max-facebook-engagement" class="col-xs-1 input-filter engagement-slider"style="display:inline; padding-left:2%; padding-right:0px;" type="text">
            </div>
            <!--end facebook slider-->




            <!-- Start Twitter slider -->
            <div class="sliders" data-platform="twitter" style="display:none;">
                <input  class="col-xs-1 input-filter" type="text" id="min-twitter">
                <div id="slider-twitter" class="col-xs-10"></div>
                <input id="max-twitter" class="col-xs-1 input-filter"style="display:inline; padding-left:2%; padding-right:0px;" type="text">
            </div>
            <div class="sliders" data-platform="twitter-engagement" style="display:none;">
                <input  class="col-xs-1 input-filter engagement-slider" type="text" id="min-twitter-engagement">
                <div style="margin-top:20px;" id="slider-twitter-engagement" class="col-xs-10"></div>
                <input id="max-twitter-engagement" class="col-xs-1 input-filter engagement-slider"style="display:inline; padding-left:2%; padding-right:0px;" type="text">
            </div>
            <!--end Twitter slider-->

        </div>




        <div class="found-influencers col-xs-12">
            <?php
                $count = 3;
                $stmt = $conn->prepare('SELECT `id`,`image_url`,`instagram_url`,`instagram_count`,`facebook_url`,`facebook_count`,`twitter_count`,`twitter_url` FROM `Influencer_Information` ORDER BY `total` DESC LIMIT 0,32');
                $stmt->execute();
                $stmt->bind_result($id,$image,$instagramurl,$instagramcount,$facebookurl,$facebookcount,$twittercount,$twitterurl);
                while($stmt->fetch()){
                $insthandle = explode('.com/',$instagramurl);
                $insthandle = explode('/',$insthandle[1]);
                $insthandle = explode('?',$insthandle[0]);
                $insthandle = $insthandle[0];
                //Facebook handle
                $facebookhandle = explode('.com/',$facebookurl);
                $facebookhandle = explode('/',$facebookhandle[1]);
                $facebookhandle = explode('?',$facebookhandle[0]);
                $facebookhandle = $facebookhandle[0];
                //twitter handle
                $twitterhandle = explode('.com/',$twitterurl);
                $twitterhandle = explode('/',$twitterhandle[1]);
                $twitterhandle = explode('?',$twitterhandle[0]);
                $twitterhandle = $twitterhandle[0];

                echo '
                    <div  class="influencer-box col-xs-12 col-md-6 col-lg-4 col-xl-3">
                            <div class="influencer-card-discover">
                                <img class="influencer-image-card" src="https://project.social/'.$image.'">
                                <div class="col-xs-12" style="height:170px;">
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
                                    <!-- Engagement ?-->
                                    <div class="col-xs-12">
                                        <p class="instagram-engagement engagement-count" data-id="'.$id.'">1.5K Likes per post</p>
                                        <p class="facebook-engagement engagement-count" style="display:none"data-id="'.$id.'">1.5K Likes per post</p>
                                        <p class="twitter-engagement engagement-count" style="display:none"data-id="'.$id.'">1.5K Likes per post</p>
                                    </div>
                                    <div class="col-xs-12">

                                        <div style="display:inline;"class="col-xs-12 invite avocado-hover avocado-focus" data-id="'.$id.'" data-image="'.$image.'">
                                              <i class="thumb-up icon fa-plus" aria-hidden="true"></i>
                                                 INVITE</div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <!-- Influencer box has ended -->';
                    $count++;
                }
                    ?>
        </div>
</div>

</div>


</body>
</html>
<script>
var calculate = false;
var page = 0;
var selectedusers = [];
var filters = {};
var target = $("#test-height").offset().top;
var target2 = $('#stuff').offset().top;
function abbrNum(number, decPlaces = 2) {
    var orig = number;
    var dec = decPlaces;
    // 2 decimal places => 100, 3 => 1000, etc
    decPlaces = Math.pow(10, decPlaces);

    // Enumerate number abbreviations
    var abbrev = ["k", "m", "b", "t"];

    // Go through the array backwards, so we do the largest first
    for (var i = abbrev.length - 1; i >= 0; i--) {

        // Convert array index to "1000", "1000000", etc
        var size = Math.pow(10, (i + 1) * 3);

        // If the number is bigger or equal do the abbreviation
        if (size <= number) {
            // Here, we multiply by decPlaces, round, and then divide by decPlaces.
            // This gives us nice rounding to a particular decimal place.
            var number = Math.round(number * decPlaces / size) / decPlaces;

            // instHandle special case where we round up to the next abbreviation
            if((number == 1000) && (i < abbrev.length - 1)) {
                number = 1;
                i++;
            }

            // console.log(number);
            // Add the letter for the abbreviation
            number += abbrev[i];

            // We are done... stop
            break;
        }
    }

    return number;
}

$('#tokenfield').tokenfield();
</script>
<script src="/acslider.js"></script>
<script src="/includes/javascript/avocado-discover.js"></script>





