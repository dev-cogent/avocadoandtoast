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
<?php include 'acnav.php';?>








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



<div id="stuff">

<!--Filter content -->


<div class="filter-container col-xs-12" style="height:100%; border-bottom:0px;">
    <div class="go-back-btn-div"> <a class="back-btn"> Go Back </a> </div>
    <div class="user-campaign-name"> Gaby's Spring Super Dog Frenzy </div>
    <div class="user-campaign-inf-count"> <span class="campaign-inf-count">120 </span> Influencers Invited to this Campaign </div>









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
                    <div  class="influencer-box col-xs-12 col-md-6 col-lg-3 col-xl-2">
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
<script src="/includes/javascript/avocado-campaign.js"></script>
<script src="/includes/javascript/create-campaign.js"></script>
