<?php
session_start(); 
//error_reporting(0);
include '../includes/dbinfo.php';
include '../includes/class/savecampaign.php';
include '../includes/numberAbbreviation.php';
$url = $_SERVER['REQUEST_URI'];
$id = explode('/',$url);
$id = $id[2];
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
$influencerinfo = $save->getCampaign($campaignid);
$campaigninfo = $save->getCampaignInfo($campaignid);

$description = $campaigninfo['description'];

?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <?php include '../includes/head.php' ?>
    <title><?php echo $influencerinfo['campaign_name'];?> | Avocado & Toast</title>
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

.influencer-box{

}



</style>
</head>

<body class="col-xs-12" style="padding-left:0px;padding-right:0px;">
<?php include '../acnav.php';?>








<!-- Add side bar here -->

<div class="col-xs-1 sidebar-left" style="position:fixed">
<i class="icon fa-bars" aria-hidden="true" style="
    color: white;
    text-align: center;
    font-size: 21px;
    margin-left: 5px;
    height: 20px;
    padding-top: 15px;
"></i>
</div>
<div id="stuff"></div>




<!--Filter content -->


<div class="filter-container col-xs-12" style="border-bottom:0px; height:145px;">
    <div class="go-back-btn-div"> <a class="back-btn" href="/dashboard.php"> Go Back </a> </div>
    <div class="go-back-btn-div"> <a class="back-btn" href="/edit/<?php echo $campaignid;?>"> Edit Campaign </a> </div>
    <div class="go-back-btn-div"> <a class="back-btn" href="/edit/<?php echo $campaignid;?>"> Export Campaign </a> </div>
    <div class="go-back-btn-div"> <a class="back-btn" href="/edit/<?php echo $campaignid;?>"> Price Campaign </a> </div>
</div>

<div class="col-xs-12" style="padding-left:75px;">
    <div class="user-campaign-name col-xs-2" style="padding-left:13px; padding-bottom:20px; margin-left:0px; margin-top: -12px; color:#73C48D;"> <?php echo $influencerinfo['campaign_name'];?> 
    
    <p style="font-size:13px; color:rgb(29, 40, 76);"> <?php echo $description; ?></p>
    
    </div>
  <!--  <div class="user-campaign-inf-count"> <span class="campaign-inf-count"><?php// echo $influencerinfo['campaign_count'];?> </span> Influencers Invited to this Campaign </div> -->
  <?php echo '
    <div class="col-xs-9" id="campaign-breakdown" style="height:240px; padding-bottom:30px; border-radius: 4px;">
        <div class="col-xs-12" style="border:1px solid black;">
        <div class="campaign-block col-xs-12"  style="padding-left:75px;" >
        <table class="col-xs-12">
            <tbody style="border-top:0px;">
            <tr>
                <td class="campaign-details" > Campaign not in progress </td>
                <td class="campaign-details date" > Created 02/17/2017</td>
            </tr>
            <tr>
                <td class="stats">'.$influencerinfo['campaign_count'].'</td>
                <td class="stats">'.$campaigninfo['totalposts'].'</td>
                <td class="stats">'.numberAbbreviation($campaigninfo['totalimpressions']/$influencerinfo['campaign_count']).'</td>
                <td class="stats">1,000</td>
                <td class="stats">'.numberAbbreviation($campaigninfo['totalimpressions']).'</td>
            </tr>
            <tr>
                <td class="label-info">Influencers</td>
                <td class="label-info">Total Post</td>
                <td class="label-info">Avg Impressions</td>
                <td class="label-info"> Avg Engagement</td>
                <td class="label-info"> Total Reach</td>
            </tr>
            </tbody>
        </table>
    </div>
        </div>



    </div>';
    ?>


 






        <div class="found-influencers col-xs-12">
            <?php
                foreach($influencerinfo['influencer'] as $influencerid => $info){
                $id = $influencerid;
                $instagramurl = $info['instagram_url'];
                $facebookurl = $info['facebook_url'];
                $twitterurl = $info['twitter_url'];
                $insthandle = $info['instagram_handle'];
                $facebookhandle = $info['facebook_handle'];
                $twitterhandle = $info['twitter_handle'];
                $insthandle = $info['instagram_handle'];
                $instagramcount = $info['instagram_count'];
                $facebookcount = $info['facebook_count'];
                $twittercount = $info['twitter_count'];
                $instagrampost = $info['instagram_post'];
                $facebookpost = $info['facebook_post'];
                $twitterpost = $info['twitter_post'];


                echo '
                    <div  class="influencer-box col-xs-12 col-md-6 col-lg-3 col-xl-2">
                            <div class="influencer-card-discover">
                                <img class="influencer-image-card" src="https://project.social/'.$info['image'].'">
                                <div class="col-xs-12" style="height:170px;">
                                    <!-- insthandle stuff -->
                                        <div class="icons col-xs-12">';

                                            echo checkDisplayAll($instagramurl,$facebookurl,$twitterurl,$id);
                                        
                                        echo '
                                        </div>
                                        <div class="col-xs-12 insthandle-info">';
                                            if($instagramurl != NULL){
                                                echo '<p class="instagram-handle insthandle-text" data-id="'.$id.'">'.$insthandle.'</p>
                                                      <p class="facebook-handle insthandle-text" data-id="'.$id.'" style="display:none;">'.$facebookhandle.'</p>
                                                      <p class="twitter-handle insthandle-text" data-id="'.$id.'" style="display:none;">'.$twitterhandle.'</p>';
                                            }
                                            elseif($facebookurl != NULL && $instagramurl == NULL){
                                                echo '<p class="instagram-handle insthandle-text" data-id="'.$id.'" style="display:none;">'.$insthandle.'</p>
                                                      <p class="facebook-handle insthandle-text" data-id="'.$id.'">'.$facebookhandle.'</p>
                                                      <p class="twitter-handle insthandle-text" data-id="'.$id.'" style="display:none;">'.$twitterhandle.'</p>';
                                            }
                                            elseif($twitterurl != NULL && $facebookurl == NULL && $instagramurl == NULL){
                                                echo '<p class="instagram-handle insthandle-text" data-id="'.$id.'" style="display:none;">'.$insthandle.'</p>
                                                      <p class="facebook-handle insthandle-text" data-id="'.$id.'" style="display:none;">'.$facebookhandle.'</p>
                                                      <p class="twitter-handle insthandle-text" data-id="'.$id.'">'.$twitterhandle.'</p>';
                                            }

                                            echo '
                                            </div>
                                    <!-- followers -->
                                    <div class="col-xs-12">';
                                    
                                        if($instagramurl != NULL){
                                            echo '
                                        
                                        <p class="instagram-follower-count follower-count" data-id="'.$id.'">'.numberAbbreviation($instagramcount * $instagrampost).' Impressions</p>
                                        <p class="facebook-follower-count follower-count" style="display:none" data-id="'.$id.'">'.numberAbbreviation($facebookcount * $facebookpost).' Impressions</p>
                                        <p class="twitter-follower-count follower-count" style="display:none" data-id="'.$id.'">'.numberAbbreviation($twittercount * $twitterpost).' Impressions</p>
                                        ';
                                        }
                                        elseif($facebookurl != NULL && $instagramurl == NULL){
                                            echo '
                                        <p class="instagram-follower-count follower-count" data-id="'.$id.'" style="display:none">'.numberAbbreviation($instagramcount * $instagrampost).' Impressions</p>
                                        <p class="facebook-follower-count follower-count"  data-id="'.$id.'">'.numberAbbreviation($facebookcount * $facebookpost).' Impressions</p>
                                        <p class="twitter-follower-count follower-count" style="display:none" data-id="'.$id.'">'.numberAbbreviation($twittercount * $twitterpost).' Impressions</p>
                                        ';
                                        }
                                        elseif($twitterurl != NULL && $facebookurl == NULL && $instagramurl == NULL){
                                            echo '
                                        <p class="instagram-follower-count follower-count" data-id="'.$id.'" style="display:none">'.numberAbbreviation($instagramcount * $instagrampost).' Impressions</p>
                                        <p class="facebook-follower-count follower-count"  data-id="'.$id.'" style="display:none">'.numberAbbreviation($facebookcount * $facebookpost).' Impressions</p>
                                        <p class="twitter-follower-count follower-count"  data-id="'.$id.'">'.numberAbbreviation($twittercount * $twitterpost).' Impressions</p>
                                        ';
                                        }
                                    echo '
                                    </div>
                                    <!-- Engagement ?-->
                                    <div class="col-xs-12">
                                        <p class="instagram-engagement engagement-count" data-id="'.$influencerid.'">1.5K Avg Engagement</p>
                                        <p class="facebook-engagement engagement-count" style="display:none"data-id="'.$influencerid.'">1.5K Avg Engagaement</p>
                                        <p class="twitter-engagement engagement-count" style="display:none"data-id="'.$influencerid.'">1.5K Avg Engagement</p>
                                    </div>
                                    
                                    <div class="col-xs-12">

                                        <div style="display:inline; background-color:#73C48D; color:white; border:1px solid #73C48D; margin-top:-10px; margin-bottom:4px; height:28px padding-top:0px;"class="col-xs-12 invite avocado-hover avocado-focus" data-id="'.$influencerid.'" data-image="'.$info['image'].'">
                                              <i class="thumb-up icon fa-check" aria-hidden="true"></i>INVITED
                                        </div>
                                        <p style="text-align:center;padding-top: 3px; color:#73C48D;"> 1 total post </p>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <!-- Influencer box has ended -->';
                //    $count++;
                }







function checkDisplayAll($instagramurl,$facebookurl,$twitterurl,$id){
$html ='';
if($instagramurl == NULL || $instagramurl == ''){
    $html .= '<a> <i class="switch show-instagram inst-icon icon bd-instagram" data-id="'.$id.'" data-platform="instagram" style="display:none;" aria-hidden="true"></i></a>';
}
else{
    $html .='<a> <i class="switch show-instagram inst-icon icon bd-instagram" data-id="'.$id.'" data-platform="instagram" aria-hidden="true"  style="color:#73C48D"></i></a>';
}


//For facebook
if($facebookurl == NULL || $facebookurl == ''){
    $html .= '<a> <i class="switch show-facebook inst-icon icon bd-facebook" data-id="'.$id.'" data-platform="facebook" style="display:none;" aria-hidden="true"></i></a>';
}
elseif($instagramurl == NULL || $instagramurl == '' && $facebookurl != NULL){
    $html .= '<a> <i class="switch show-facebook inst-icon icon bd-facebook" data-id="'.$id.'" data-platform="facebook" aria-hidden="true" style="color:#73C48D"></i></a>';
}
else {
    $html .= '<a> <i class="switch show-facebook inst-icon icon bd-facebook" data-id="'.$id.'" data-platform="facebook" aria-hidden="true"></i></a>';
}

if($twitterurl == NULL || $twitterurl == ''){
    $html .= '<a> <i class="switch show-twitter inst-icon icon bd-twitter" data-id="'.$id.'" data-platform="twitter" aria-hidden="true" style="display:none;"></i></a>';
}
elseif((($facebookurl == NULL || $facebookurl) == '' && ($twitterurl == NULL || $twitterurl == '')) && ($twitterurl != NULL || $twitterurl !== '') ){
    $html .= '<a> <i class="switch show-twitter inst-icon icon bd-twitter" data-id="'.$id.'" data-platform="twitter" aria-hidden="true" style="color:#73C48D"></i></a>';
}
else{
    $html .= '<a> <i class="switch show-twitter inst-icon icon bd-twitter" data-id="'.$id.'" data-platform="twitter" aria-hidden="true"></i></a>';
}

return $html;


}
                    ?>
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
var filters = {};
var target2 = $('#stuff').offset().top;
console.log(target2);
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
