<?php
session_start();
//error_reporting(0);
include 'includes/dbinfo.php';
include 'includes/numberAbbreviation.php';
include 'includes/TwitterAPIexchange.php';   
$id = '5AUgZ0C';

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
<script src="/includes/javascript/profile.js"></script>
<link rel="stylesheet" href="/includes/javascript/tokenfield/dist/css/bootstrap-tokenfield.css">
<link rel="stylesheet" href="/assets/uislider/nouislider.css">
<link rel="stylesheet" href="/global/fonts/brand-icons/brand-icons.css">
<link rel="stylesheet" href="/global/fonts/font-awesome/font-awesome.css">
<link rel="stylesheet" href="/includes/css/discover.css">
<link rel="stylesheet" href="/includes/css/profile.css">

</head>

<body class="col-xs-12" style="padding-left:0px;padding-right:0px;">
    <!-- Facebook scripts and stuff -->
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1075628395822185',
      xfbml      : true,
      version    : 'v2.8'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
<div id="fb-root"></div>




    <div class="col-xs-12" style="border-top: 1px solid rgb(210,215,220); border-bottom:1px solid rgb(210,215,220); height:66px;">
       <img src="/assets/images/at-logo-black.png" style="margin-top:-8px;">

    </div>
<!-- Content where the discover, communicatie, order management would be -->
<div class="mininav" style="margin-top:65px" >
    <p class="nav2">DISCOVER</p>
</div>








<!-- Add side bar here -->

<div class="col-xs-1 sidebar-left" style="position:relative;">
<i class="icon fa-bars" aria-hidden="true" style="
    color: white;
    text-align: center;
    font-size: 21px;
    margin-left: 5px;
    height: 20px;
    padding-top: 15px;
"></i>
</div>

<div class="col-md-3 influencer-card-container">
    <?php 
    $stmt = $conn->prepare('SELECT `id`,`image_url`,`instagram_url`,`instagram_count`,`facebook_url`,`facebook_count`,`twitter_count`,`twitter_url` FROM `Influencer_Information` WHERE `id` = ?' );
    $stmt->bind_param('s',$id);
    $stmt->execute();
    $stmt->bind_result($id,$image,$instagramurl,$instagramcount,$facebookurl,$facebookcount,$twittercount,$twitterurl);
    $stmt->fetch();
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
                    <div  class="influencer-box col-xs-12 ">
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
                                        <p class="instagram-follower-count follower-count" data-id="'.$id.'">'.numberAbbreviation($instagramcount).'5M Followers</p>
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
                    </div>';
                    ?>
                    <!-- Influencer box has ended -->
</div>    


<div class="col-lg-7 col-xl-5" style="margin-left: 3%;">
<!-- social buttons and stats -->
<?php echo '<p  class="col-xs-12"style="padding-top:49px;"> Viewing @'.$insthandle.' latest instagram posts</p>
    <div class="col-xs-12 social-buttons">
            <div class="col-xs-4 button-container">
                <button class="col-xs-12 social-button instagram-platform" data-platform="instagram" data-handle="'.$insthandle.'" style="background-color: rgb(115, 196, 141);"><div class="button-option-text"> <i class="button-icon icon bd-instagram"  data-platform="instagram" aria-hidden="true"></i> INSTAGRAM</div></button>
            </div>
            <div class="col-xs-4 button-container">
                <button class="col-xs-12 social-button facebook-platform" data-platform="facebook" data-handle="'.$facebookhandle.'"><div class="button-option-text"> <i class="button-icon icon bd-facebook"  data-platform="facebook" aria-hidden="true"></i> FACEBOOK</div>
                </button>
            </div>
           <div class="col-xs-4 button-container twitter-platform">
                <button class="col-xs-12 social-button" data-platform="twitter" data-handle="'.$twitterhandle.'"><div class="button-option-text"> <i class="button-icon icon bd-twitter"  data-platform="twitter" aria-hidden="true"></i> TWITTER</div></button>
            </div>
    </div>';
?>
<!-- content  -->
<div class="col-xs-12 social-content" >

<div id="instagram" >




</div>


<div id="facebook" style="display:none" class="col-xs-12">
    <?php
    //We start getting the facebook information from now since for some reason calling through ajax doesn't work. It will be put on a display none. 
    $facebooktoken = '1075628395822185|Y0CgNIZP8EiF2esClPtNaki4hiE';
    $info = curl('https://graph.facebook.com/v2.7/'.$facebookhandle.'?fields=posts.limit(10){permalink_url}&access_token='.$facebooktoken);
    $facebookpost = array();  
    foreach($info['posts']['data'] as $id ){
        array_push($facebookpost,$id['permalink_url']);
    }
    foreach($facebookpost as $id){
        echo '<div class="fb-post" data-href="'.$id.'" data-width="50" data-height="100"></div>';
    }
    ?>
</div>
<!-- End facebook -->
<div id="twitter" style="display:none;" class="col-xs-12">


</div>


</div>    




</div>
<?php 
function curl($url) {
    $curl_connection = curl_init($url);
    curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
    $json = json_decode(curl_exec($curl_connection), true); 
    curl_close($curl_connection);
    return $json;     
    
} // end curl
?>






