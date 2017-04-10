<?php
session_start(); 
error_reporting(-1);
include 'includes/dbinfo.php';
include 'includes/class/savecampaign.php';
include 'includes/numberAbbreviation.php';

$campaignid = $_GET['id'];
$save = new saveCampaign;
//Checking for campaign validity
$checkcampaign = $save->checkCampaign($campaignid, $_SESSION['column_id']);
if($checkcampaign === false) header('Location: /dashboard.php');

//If all is good, we continue. 
$influencerinfo = $save->getCampaign($campaignid,0,100);
$campaigninfo = $save->getCampaignInfo($campaignid);

 
?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <?php include 'includes/head.php' ?>
    <title><?php echo $influencerinfo['campaign_name'];?> | Avocado & Toast</title>
<script src="/bootbox/bootbox.js"></script>
<script src="/global/vendor/bootstrap/bootstrap.js"></script>
<script src="/includes/javascript/tokenfield/dist/bootstrap-tokenfield.js"></script>
<script src="includes/javascript/loading.js"></script>
<link rel="stylesheet" href="/includes/javascript/tokenfield/dist/css/bootstrap-tokenfield.css">
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
<?php include 'acnav.php';?>








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
  <div id="li-container" style="display:none;">
    <li class="item"><a class="side-link" href="/dashboard.php"> DASHBOARD </a> </li>
    <li class="item"><a class="side-link" href="/acdiscover.php"> DISCOVER </a></li>
    <li class="item"><a class="side-link" href="/settings.php"> ACCOUNT SETTINGS </a></li>
    <li class="item"><a class="side-link" href="#"> FAQ</a> </li>
    <li class="item"><a class="side-link" href="#"> CONTACT</a> </li>
    <li class="item"><a class="side-link" href="#"> LATEST UPDATES</a></li>
    <li class="item"><a class="side-link" href="/logout.php"> LOGOUT</a></li>
  </div>
</div>

<div id="stuff"></div>



<div class="col-xs-12 info-container">



        <div class="row">
    <div class="col-sm-12 col-lg-6 campaign-info" style="margin-left:20px;">
    <div class="camapaign-label-container">
    <div class="campaign-label-div">
    <h3 id="campaign-label" class="campaign-label" style="margin-right: 43%;"><?php echo $campaigninfo['campaignname']; ?></h3> </div>

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
                  <tbody>
                  <?php
                  $influencerarr = array();
                  foreach($influencerinfo['influencer'] as $id => $info){
                  array_push($influencerarr, $id);
                  echo'
                    <tr class="campaign-list-table">
                        <td class="campaign-tablerow" style="width:15%; padding-left:0%;">
                                <div class="information">
                            <img src="http://cogenttools.com/'.$info['image'].'" onerror="this.src=`/assets/images/default-photo.png`" class="influencer-campaign-image ">
                            <h4 class="influencer-handle-text handle">@'.$info['instagram_handle'].'</h4>
                            <h4 class="influencer-handle-text location-text">Location</h4>
                      </div></td>

                      <td data-id="'.$id.'" class="insta-column" style="width:15%;">
                          <div class="posts-res-div">
                            <input data-id="'.$id.'" data-platform="instagram" class="instagraminput campaignfocus" type="number"  value="'.$info['instagram_post'].'"max="100" min="0">
                            <div class="post-results">posts</div>
                          </div>
                          <div class="results-mini-col">
                            <div class="impression-res impression-blue impression-instagram-blue" data-id="'.$id.'" data-number="'.$info['instagram_impressions'].'">'.numberAbbreviation($info['instagram_impressions']).'</div>
                            <div class="engagement-res engagement-orange engagement-orange-instagram" data-id="'.$id.'" data-number="'.$info['instagram_engagement'].'" >'.numberAbbreviation($info['instagram_engagement']).'</div>
                            <div class="social-following-res social-following-red">'.numberAbbreviation($info['instagram_count']).'</div>
                          </div>
                      </td>

                      <td data-id="'.$id.'" class="twit-column" style="width:15%;">
                        <input data-id="'.$id.'" data-platform="facebook" class="facebookinput campaignfocus" type="number" value="'.$info['facebook_post'].'" max="100" min="0">
                        <div class="post-results"> posts</div>
                        <div class="results-mini-col">
                          <div class="impression-res impression-blue impression-facebook-blue" data-id="'.$id.'" data-number="'.$info['facebook_impressions'].'">'.numberAbbreviation($info['facebook_impressions']).'</div>
                          <div class="engagement-res engagement-orange engagement-orange-facebook"  data-id="'.$id.'" data-number="'.$info['facebook_engagement'].'" >'.numberAbbreviation($info['facebook_engagement']).'</div>
                          <div class="social-following-res social-following-red">'.numberAbbreviation($info['facebook_count']).'</div>
                        </div>
                      </td>

                      <td data-id="'.$id.'" class="face-column" style="width:15%;">
                        <input data-id="'.$id.'" data-platform="twitter" class="twitterinput campaignfocus" type="number" value="'.$info['twitter_post'].'" max="100" min="0">
                        <div class="post-results"> posts</div>
                        <div class="results-mini-col">
                          <div class="impression-res impression-blue impression-twitter-blue" data-id="'.$id.'" data-number="'.$info['twitter_impressions'].'">'.numberAbbreviation($info['twitter_impressions']).'</div>
                          <div class="engagement-res engagement-orange engagement-orange-twitter" data-id="'.$id.'" data-number="'.$info['twitter_engagement'].'">'.numberAbbreviation($info['twitter_engagement']).'</div>
                          <div class="social-following-res social-following-red">'.numberAbbreviation($info['twitter_count']).'</div>
                        </div>
                      </td>

                      <td data-id="'.$id.'" class="overall-inf-total-column" style="width:15%;">
                          <input data-id="'.$id.'" data-platform="total" class="totalinput campaignfocus" type="number" value="'.($info['instagram_post'] + $info['twitter_post'] + $info['facebook_post']).'" max="100" disabled>
                          <div class="post-results"> posts</div>
                          <div class="results-mini-col">
                            <div class="impression-res impression-blue impression-total-blue" data-id="'.$id.'" data-number="'.($info['instagram_impressions'] + $info['facebook_impressions'] + $info['twitter_impressions']).'" >'.numberAbbreviation($info['instagram_impressions'] + $info['facebook_impressions'] + $info['twitter_impressions']).'</div>
                            <div class="engagement-res engagement-orange engagement-orange-total"  data-id="'.$id.'" data-number="'.($info['instagram_engagement'] + $info['facebook_engagement'] + $info['twitter_engagement']).'" >'.numberAbbreviation($info['instagram_engagement'] + $info['facebook_engagement'] + $info['twitter_engagement']).'</div>
                            <div class="social-following-res social-following-red"> </div>
                          </div>
                      </td>
                    </tr>';
                    unset($stmt);
                  }
                  echo '

                       <!-- results -->
                        <tr class="result-row campaign-list-table">
                        <td class="campaign-tablerow" style="width:15%;">
                            <div class="information">
                                <p class="result-name" style="width:210px;">  CAMPAIGN ENGAGEMENT</p>
                            </div>
                      <td  class="insta-column" style="width:15%;"> <p class="instagram-posts results-text" id="instagram-engagement" data-number="'.$campaigninfo['total_instagram_engagement'].'"> '.numberAbbreviation($campaigninfo['total_instagram_engagement']).' </p> </td>
                      <td  class="twit-column" style="width:15%;"> <p class="facebook-posts results-text" id="facebook-engagement" data-number="'.$campaigninfo['total_facebook_engagement'].'"> '.numberAbbreviation($campaigninfo['total_facebook_engagement']).' </p> </td>
                      <td  class="face-column" style="width:15%;"> <p class="twitter-posts results-text" id="twitter-engagement" data-number="'.$campaigninfo['total_twitter_engagement'].'">'.numberAbbreviation($campaigninfo['total_twitter_engagement']).'</p></td>
                      <td  class="face-column" style="width:15%;"> <p class="total-posts results-text" id="total-engagement" data-number="'.$campaigninfo['totalengagement'].'" >'.numberAbbreviation($campaigninfo['totalengagement']).'</p>  </td>
                    </tr>


                        <tr class="result-row campaign-list-table">
                        <td class="campaign-tablerow" style="width:15%;">
                            <div class="information">
                            <p class="result-name" style="width:210px;"> CAMPAIGN IMPRESSIONS</p>
                            </div>
                      <td  class="insta-column" style="width:15%;"><p class="instagram-posts results-text" id="instagram-impressions" data-number="'.$campaigninfo['total_instagram_impressions'].'"> '.numberAbbreviation($campaigninfo['total_instagram_impressions']).' </p> </td>
                      <td  class="twit-column" style="width:15%;"> <p class="facebook-posts results-text" id="facebook-impressions" data-number="'.$campaigninfo['total_facebook_impressions'].'"> '.numberAbbreviation($campaigninfo['total_facebook_impressions']).' </p> </td>
                      <td  class="face-column" style="width:15%;"> <p class="twitter-posts results-text" id="twitter-impressions" data-number="'.$campaigninfo['total_twitter_impressions'].'"> '.numberAbbreviation($campaigninfo['total_twitter_impressions']).' </p></td>
                      <td  class="total-column" style="width:15%;"> <p class="total-posts results-text" id="total-impressions" data-number="'.$campaigninfo['totalimpressions'].'"> '.numberAbbreviation($campaigninfo['totalimpressions']).' </p></td>

                    </tr>


                    </tbody>
                </table>
</div>';

?>
<script>
var selectedusers = <?php echo json_encode($influencerarr); ?>;
var target2 = $('#stuff').offset().top;
var urlParams = new URLSearchParams(window.location.search);
</script>
<script src="/includes/javascript/recalculate.js"></script>
