<?php
session_start(); 
error_reporting(0);
include '../includes/dbinfo.php';
include '../includes/class/savecampaign.php';
include '../includes/numberAbbreviation.php';
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
$influencerinfo = $save->getCampaign($campaignid);
$campaigninfo = $save->getCampaignInfo($campaignid);

$description = $campaigninfo['description'];
if($description == NULL){
    $description = 'Looks like nothing is here! Click on edit campaign to give your campaign a summary';
}

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
    width: 150px;
    height: 35px;
    background-color: white;
    border: 1px solid black;
    font-size:12px;
    margin-right:5px;
    font-family:'montserratlight';

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




<!--Filter content -->


<div class="filter-container col-xs-12" style="border-bottom:0px; height:145px;">
  <a  href="/dashboard.php" style="color:black;">  <button class="btn-campaign-options avocado-hover avocado-focus">  GO BACK  </button></a>
  <a href="/edit/?id=<?php echo $campaignid;?>" style="color:black;">  <button class="btn-campaign-options avocado-hover avocado-focus">  EDIT CAMPAIGN  </button></a>
  <a href="#" style="color:black;" class="pdf">  <button class="btn-campaign-options avocado-hover avocado-focus">  EXPORT CAMPAIGN  </button></a>
  <a href="/price/?id=<?php echo $campaignid;?>" style="color:black;">  <button class="btn-campaign-options avocado-hover avocado-focus">  PRICE CAMPAIGN  </button></a>
  <a href="/price/?id=<?php echo $campaignid;?>" style="display:none;" id="undo-button" >  <button class="btn-campaign-options avocado-hover avocado-focus" style="background-color:#73C48D; color:white; border:0px;">UNDO</button></a>
</div>

<div class="col-xs-12" style="padding-left:75px;">
    <div class="user-campaign-name col-xs-2" style="padding-left:13px; padding-bottom:20px; margin-left:0px; margin-top: -12px; color:#73C48D;"> <?php echo $influencerinfo['campaign_name'];?> 
    
    <p style="font-size:13px; color:rgb(29, 40, 76);"> <?php echo'<span><strong>Campaign Summary: </strong></span>'. $description; ?></p>
    
    </div>
  <!--  <div class="user-campaign-inf-count"> <span class="campaign-inf-count"><?php// echo $influencerinfo['campaign_count'];?> </span> Influencers Invited to this Campaign </div> -->
  <?php echo '
    <div class="col-xs-9" id="campaign-breakdown" style="height:240px; padding-bottom:30px; border-radius: 4px;">
        <div class="col-xs-12" style="border:1px solid rgb(210,215,220);">
        <div class="campaign-block col-xs-12"  style="padding-left:75px;" >
        <table class="col-xs-12">
            <tbody style="border-top:0px;">
            <tr>
                <td class="stats" id="influnum">'.$influencerinfo['campaign_count'].'</td>
                <td class="stats" id="posts">'.$campaigninfo['totalposts'].'</td>
                <td class="stats" id="avgimp" data-number="'.$campaigninfo['totalimpressions']/$influencerinfo['campaign_count'].'">'.numberAbbreviation($campaigninfo['totalimpressions']/$influencerinfo['campaign_count']).'</td>
                <td class="stats" id="avgeng" data-number="'.$campaigninfo['totalengagement']/$influencerinfo['campaign_count'].'">'.numberAbbreviation($campaigninfo['totalengagement']/$influencerinfo['campaign_count']).'</td>
                <td class="stats"id="reach" data-num="'.$campaigninfo['totalimpressions'].'">'.numberAbbreviation($campaigninfo['totalimpressions']).'</td>
                <td class="stats"id="engagement" data-number="'.$campaigninfo['totalengagement'].'">'.numberAbbreviation($campaigninfo['totalengagement']).'</td>
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

                $instagrampost = $info['instagram_post'];
                $twitterpost = $info['twitter_post'];
                $facebookpost = $info['facebook_post'];

                $instagramimpressions = $info['instagram_impressions'];
                $twitterimpressions = $info['twitter_impressions'];
                $facebookimpressions = $info['facebook_impressions'];


                $instagrameng = $info['instagram_engagement'];
                $twittereng = $info['twitter_engagement'];
                $facebookeng = $info['facebook_engagement'];


                echo '
                    <div  class="influencer-box col-xs-12 col-md-6 col-lg-3 col-xl-2" data-id="'.$id.'" data-t-post="'.$twitterpost.'" data-f-post="'.$facebookpost.'"
                    data-i-post="'.$instagrampost.'" data-t-impressions="'.$twitterimpressions.'" data-f-impressions="'.$facebookimpressions.'" data-i-impressions="'.$instagramimpressions.'" 
                    data-t-engagement="'.$twittereng.'" data-i-engagement="'.$instagrameng.'" data-f-engagement="'.$facebookeng.'">
                            <div class="influencer-card-discover">

                                <img class="influencer-image-card" src="http://cogenttools.com/'.$info['image'].'" onerror="this.src=`/assets/images/default-photo.png`">
                                <div class="col-xs-12" style="height:170px; box-shadow: rgb(115, 196, 141) 0px -10px 0px;">
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
                                        
                                        <p class="instagram-follower-count follower-count" data-id="'.$id.'">'.numberAbbreviation($instagramimpressions).' Impressions</p>
                                        <p class="facebook-follower-count follower-count" style="display:none" data-id="'.$id.'">'.numberAbbreviation($facebookimpressions).' Impressions</p>
                                        <p class="twitter-follower-count follower-count" style="display:none" data-id="'.$id.'">'.numberAbbreviation($twitterimpressions).' Impressions</p>
                                        ';
                                        }
                                        elseif($facebookurl != NULL && $instagramurl == NULL){
                                            echo '
                                        <p class="instagram-follower-count follower-count" data-id="'.$id.'" style="display:none">'.numberAbbreviation($instagramimpressions).' Impressions</p>
                                        <p class="facebook-follower-count follower-count"  data-id="'.$id.'">'.numberAbbreviation($facebookimpressions).' Impressions</p>
                                        <p class="twitter-follower-count follower-count" style="display:none" data-id="'.$id.'">'.numberAbbreviation($twitterimpressions).' Impressions</p>
                                        ';
                                        }
                                        elseif($twitterurl != NULL && $facebookurl == NULL && $instagramurl == NULL){
                                            echo '
                                        <p class="instagram-follower-count follower-count" data-id="'.$id.'" style="display:none">'.numberAbbreviation($instagramimpressions).' Impressions</p>
                                        <p class="facebook-follower-count follower-count"  data-id="'.$id.'" style="display:none">'.numberAbbreviation($facebookimpressions).' Impressions</p>
                                        <p class="twitter-follower-count follower-count"  data-id="'.$id.'">'.numberAbbreviation($twitterimpressions).' Impressions</p>
                                        ';
                                        }
                                    echo '
                                    </div>
                                    <!-- Engagement ?-->
                                    <div class="col-xs-12">';
                                    if($instagramurl != NULL){
                                        echo '
                                        <p class="instagram-engagement engagement-count" data-id="'.$influencerid.'">'.numberAbbreviation($instagrameng).' Engagaement </p>
                                        <p class="facebook-engagement engagement-count" style="display:none"data-id="'.$influencerid.'">'.numberAbbreviation($facebookeng).' Engagaement</p>
                                        <p class="twitter-engagement engagement-count" style="display:none"data-id="'.$influencerid.'">'.numberAbbreviation($twittereng).' Engagement</p>';
                                    }
                                    elseif ($facebookurl != NULL && $instagramurl == NULL){
                                        echo '<p class="instagram-engagement engagement-count" style="display:none" data-id="'.$influencerid.'">'.numberAbbreviation($instagrameng).' Engagaement </p>
                                        <p class="facebook-engagement engagement-count" data-id="'.$influencerid.'">'.numberAbbreviation($facebookeng).' Engagaement</p>
                                        <p class="twitter-engagement engagement-count" style="display:none"data-id="'.$influencerid.'">'.numberAbbreviation($twittereng).' Engagement</p>';
                                    }
                                    elseif ($twitterurl != NULL && $facebookurl == NULL && $instagramurl == NULL){
                                    echo '<p class="instagram-engagement engagement-count" style="display:none" data-id="'.$influencerid.'">'.numberAbbreviation($instagrameng).' Engagaement </p>
                                        <p class="facebook-engagement engagement-count" style="display:none"data-id="'.$influencerid.'">'.numberAbbreviation($facebookeng).' Engagaement</p>
                                        <p class="twitter-engagement engagement-count" data-id="'.$influencerid.'">'.numberAbbreviation($twittereng).' Engagement</p>';
                                    }
                                    echo '
                                    </div>
                                    
                                    <div class="col-xs-12">
                                    <div style="display:inline; background-color:white; margin-top:1px; margin-bottom:4px; height:28px; padding-top:0px; width:100%;"class="col-xs-12 invite  avocado-focus" data-id="'.$influencerid.'" data-image="'.$info['image'].'">
                                    ';
                                    if($instagramurl != NULL){
                                      echo '   <p  class="instagram-total-post total-post" data-id="'.$id.'" style="text-align:center;padding-top: 3px; color:#73C48D;"> '.$instagrampost.' total post(s) </p>
                                               <p  class="facebook-total-post total-post" data-id="'.$id.'" style="text-align:center;padding-top: 3px; color:#73C48D; display:none;"> '.$facebookpost.' total post(s) </p>
                                               <p  class="twitter-total-post total-post" data-id="'.$id.'" style="text-align:center;padding-top: 3px; color:#73C48D; display:none;"> '.$twitterpost.' total post(s) </p>';
                                    }
                                    elseif($facebookurl != NULL && $instagramurl == NULL){
                                      echo '   <p  class="instagram-total-post total-post" data-id="'.$id.'" style="text-align:center;padding-top: 3px; color:#73C48D; display:none;"> '.$instagrampost.' total post(s) </p>
                                               <p  class="facebook-total-post total-post" data-id="'.$id.'" style="text-align:center;padding-top: 3px; color:#73C48D; "> '.$facebookpost.' total post(s) </p>
                                               <p  class="twitter-total-post total-post" data-id="'.$id.'" style="text-align:center;padding-top: 3px; color:#73C48D; display:none;"> '.$twitterpost.' total post(s) </p>';
                                    }
                                    elseif($twitterurl != NULL && $facebookurl == NULL && $instagramurl == NULL){
                                      echo '   <p  class="instagram-total-post total-post" data-id="'.$id.'" style="text-align:center;padding-top: 3px; color:#73C48D; display:none;"> '.$instagrampost.' total post(s) </p>
                                               <p  class="facebook-total-post total-post" data-id="'.$id.'" style="text-align:center;padding-top: 3px; color:#73C48D; display:none;"> '.$facebookpost.' total post(s) </p>
                                               <p  class="twitter-total-post total-post" data-id="'.$id.'" style="text-align:center;padding-top: 3px; color:#73C48D; "> '.$twitterpost.' total post(s) </p>';
                                    }
                                    echo '
                                              <i class="icon fa-check check" aria-hidden="true" style="text-align:center; width:100%; margin-left:0px;"></i>
                                        </div> 
                                
                                       
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
window.location='/includes/pdf/pdf.php?id='+id;


});
$('#tokenfield').tokenfield();
</script>
<script src="/acslider.js"></script>
<script src="/includes/javascript/avocado-campaign.js"></script>
<script src="/includes/javascript/create-campaign.js"></script>
