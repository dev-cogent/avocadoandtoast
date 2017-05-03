<?php
session_start();
error_reporting(0);
include 'php/dbinfo.php';
include 'php/numberAbbreviation.php';
include 'php/TwitterAPIexchange.php';

$id = $_GET['id'];


?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <?php include 'html/head.html' ?>
    <title>Profile | Avocado & Toast</title>
<script src="/bootbox/bootbox.js"></script>
<script src="/global/vendor/bootstrap/bootstrap.js"></script>
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Open+Sans:400,700" rel="stylesheet">
<script src="/assets/wnumb/wNumb.js"></script>
<script src="/assets/js/profile.js"></script>
<link rel="stylesheet" href="/assets/css/influencer-profile.css">

<link rel="stylesheet" href="/assets/uislider/nouislider.css">
<link rel="stylesheet" href="/global/fonts/brand-icons/brand-icons.css">
<link rel="stylesheet" href="/global/fonts/font-awesome/font-awesome.css">
<link rel="stylesheet" href="/assets/css/influencer-card.css">



</head>
<?php include 'php/avocado-nav.php';?>
<body style="padding-left:0px;padding-right:0px;">
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

   var selectedusers = [];
</script>
<div id="fb-root"></div>











<div class="col-xs-12 col-sm-9 col-md-3 influencer-card-container">
    <?php
    $stmt = $conn->prepare('SELECT `id`,`image_url`,`instagram_url`,`instagram_count`,`facebook_url`,`facebook_count`,`twitter_count`,`twitter_url`,`youtube_count`,`youtube_url`,`tags`, `total` FROM `Influencer_Information` WHERE `id` = ?' );
    $stmt->bind_param('s',$id);
    $stmt->execute();
    $stmt->bind_result($id,$image,$instagramurl,$instagramcount,$facebookurl,$facebookcount,$twittercount,$twitterurl,$youtubecount,$youtubeurl,$tags,$total);
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
    //https://www.youtube.com/user/animdude
    $youtubehandle = explode('/',$youtubeurl);
    $youtubehandle = $youtubehandle[4];
    echo '
                    <div  class="influencer-box col-xs-10 col-sm-12  ">
                            <div class="card-discover profile-tag-margin">
                                <img class="influencer-image-card" src="http://cogenttools.com/'.$image.'">
                                <div class="col-xs-12 profile-card" style="">
                                    <!-- insthandle stuff -->
                                        <div class="influencer-icons col-xs-12">
                                            <i class="switch show-instagram influencer-card-icon icon bd-instagram" data-id="'.$id.'" data-platform="instagram"  aria-hidden="true"></i>
                                            <i class="switch show-facebook influencer-card-icon icon bd-facebook" data-id="'.$id.'" data-platform="facebook" aria-hidden="true"></i>
                                            <i class="switch show-twitter influencer-card-icon icon bd-twitter" data-id="'.$id.'" data-platform="twitter" aria-hidden="true"></i>
                                        </div>
                                        <div class="col-xs-12 handle-info">
                                            <!--icon here -->
                                            <p class="instagram-handle handle-text" data-id="'.$id.'">'.$insthandle.'</p>
                                            <p class="facebook-handle handle-text" data-id="'.$id.'" style="display:none;">'.$facebookhandle.'</p>
                                            <p class="twitter-handle handle-text" data-id="'.$id.'" style="display:none;">'.$twitterhandle.'</p>
                                        </div>
                                    <!-- followers -->
                                    <div class="col-xs-12">
                                        <div class="instagram-follower-count follower-count" data-id="'.$id.'">Total Reach: '.numberAbbreviation($total).'</div>
                                        <p class="instagram-follower-count follower-count" data-id="'.$id.'">Followers: '.numberAbbreviation($instagramcount).' </p>
                                        <p class="facebook-follower-count follower-count" style="display:none" data-id="'.$id.'">Likes: '.numberAbbreviation($facebookcount).' </p>
                                        <p class="twitter-follower-count follower-count" style="display:none" data-id="'.$id.'">Followers: '.numberAbbreviation($twittercount).' </p>
                                    </div>
                                    <!-- Engagement ?-->
                                    <div class="col-xs-12">
                                        <p class="instagram-engagement engagement-count" data-id="'.$id.'">1.5K Likes per post</p>
                                        <p class="facebook-engagement engagement-count" style="display:none"data-id="'.$id.'">1.5K Likes per post</p>
                                        <p class="twitter-engagement engagement-count" style="display:none"data-id="'.$id.'">1.5K Likes per post</p>
                                    </div>


                                </div>
                            </div>
                    </div>';
                    ?>
                    <!-- Influencer box has ended -->
                  
                    <div class="tag-container">
                        <?php
                        $tags = explode(',',$tags);
                        foreach($tags as $tag){
                            echo '<div class="tag-1 tag col-lg-4 col-xs-6"> <a href="/discover.php?q='.$tag.'" class="tag-btn"> '.$tag.'</a> </div>';
                        }
                        ?>

                    </div>

</div>


<div class="col-xs-12 col-sm-12 col-md-8 social-collage">
<!-- social buttons and stats -->
<?php echo '
<div class="container-fluid social-stats-container">
    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3 platform-container">
        <div class="social-container">
            <div class="inf-number"><a href="'.$instagramurl.'" target="_blank">'.numberAbbreviation($instagramcount).'</a>
                <br>
                <span class="followers-text"> Followers </span>
            </div>
            <a class="social-profile-tab" data-platform="instagram" data-handle="'.$insthandle.'" >
                <i class="switch show-instagram inst-icon icon bd-instagram influencer-prof" data-id="NB4gltv" data-platform="instagram" style="" aria-hidden="true"></i>
            </a>
        </div>
    </div>

 <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3 platform-container">
  <a href="'.$facebookurl.'">
    <div class="social-container">
        <div class="inf-number">'.numberAbbreviation($facebookcount).'
            <br>
            <span class="followers-text"> Likes </span>
        </div>
    <a class="social-profile-tab" data-platform="facebook" data-handle="'.$facebookhandle.'">
        <i class="switch show-facebook inst-icon icon bd-facebook influencer-prof" data-id="NB4gltv" data-platform="facebook" aria-hidden="true"></i> </a>
    </div>
    </a>
  </div>


 <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3 platform-container">
    <div class="social-container">
    <a href="'.$twitterurl.'">
        <div class="inf-number">'.numberAbbreviation($twittercount).'
            <br>
            <span class="followers-text"> Followers </span>
        </div>
        <a class="social-profile-tab" data-platform="twitter" data-handle="'.$twitterhandle.'">
            <i class="switch show-twitter inst-icon icon bd-twitter influencer-prof" data-id="NB4gltv" data-platform="twitter" aria-hidden="true"></i>
        </a>
        </div>
    </a>
 </div>

   <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3 platform-container">
    <div class="social-container">
        <a href="'.$youtubeurl.'">
            <div class="inf-number youtube"> '.numberAbbreviation($youtubecount).'
                <br>
                <span class="followers-text"> Subscribers </span>
            </div>
        <a class="social-profile-tab" data-platform="youtube" data-handle="'.$youtubehandle.'">
            <i class="switch show-twitter inst-icon icon bd-youtube influencer-prof yt" data-id="NB4gltv" data-platform="youtube" aria-hidden="true"></i>
        </a>
        </div>
     </a>
</div>

</div>
    <div class="col-xs-12 col-sm-12 col-lg-12 social-buttons">';
    //Start looking for instagram
         if($instagramurl !== NULL || $instagramurl != ''){
             echo '
             <div class="col-xs-4 button-container">
                <button class="col-xs-12 social-button instagram-platform" data-platform="instagram" data-handle="'.$insthandle.'" style="background-color: rgb(115, 196, 141);"><div class="button-option-text"> <i class="button-icon icon bd-instagram"  data-platform="instagram" aria-hidden="true"></i> <div class="social-btn-text"> INSTAGRAM</div> </div></button>
            </div>';
         }
         //Start facebook
         if($facebookurl !== NULL || $facebookurl != ''){
            echo '<div class="col-xs-4 button-container">
                <button class="col-xs-12 social-button facebook-platform" data-platform="facebook" data-handle="'.$facebookhandle.'"><div class="button-option-text"> <i class="button-icon icon bd-facebook"  data-platform="facebook" aria-hidden="true"></i> <div class="social-btn-text"> FACEBOOK </div> </div>
                </button>
            </div>';

        }
        //Start Twitter
        if($twitterurl != NULL || $twitterurl !== ''){
        echo '   <div class="col-xs-4 button-container twitter-platform">
                <button class="col-xs-12 social-button" data-platform="twitter" data-handle="'.$twitterhandle.'"><div class="button-option-text"> <i class="button-icon icon bd-twitter"  data-platform="twitter" aria-hidden="true"></i> <div class="social-btn-text"> TWITTER </div> </div></button>
            </div>';
        }
      echo '
    </div>';
?>
<!-- content  -->
<div class="col-xs-12 col-sm-12 col-lg-12 social-content" >

<div id="instagram" >




</div>

<style>


</style>

<div id="facebook" style="display:none" class="col-xs-12 facebook-feed-container">
    <?php
    //We start getting the facebook information from now since for some reason calling through ajax doesn't work. It will be put on a display none.
    if($facebookurl != NULL || $facebookurl != ''){
    $facebooktoken = '1075628395822185|Y0CgNIZP8EiF2esClPtNaki4hiE';
    $count = 0;
    $info = curl("https://graph.facebook.com/v2.7/$facebookurl?fields=posts.limit(50){reactions.limit(0).summary(true),created_time,comments.limit(0).summary(true),shares,attachments}&access_token=$facebooktoken");
    //print_r($info);

    foreach($info['posts']['data'] as $post) {
      if ($count >= 12)
        break;
        $count++;

        $reactions = $post['reactions']['summary']['total_count'];
        $comments = $post['comments']['summary']['total_count'];
        $shares = $post['shares']['count'];
        $commentdescription = $post['attachments']['data'][0]['description'];
        $postimage = $post['attachments']['data'][0]['media']['image']['src'];
        $posturl = $post['attachments']['data'][0]['url'];
          echo ' <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 fb-feed-div">
        <div class="fb-feed-card">
          <div class="img-fb-div">  <a href="'.$posturl.'"> <img src="'.$postimage.'" class="fb-card"> </a> </div>

          <div class="fb-caption"> '.$commentdescription.' </div>

    <div class="interaction-info">
          <div class="likes"> <img src="/assets/images/like-green.png" class="thumb-green"> '.numberAbbreviation($reactions).' </div>
                    <div class="comments"> <img src="/assets/images/comment-bubble.png" class="comment-icon"> '.numberAbbreviation($comments).' </div>
          <div class="shares"> <img src="/assets/images/share-option3.png" class="share-green"> '.numberAbbreviation($shares).' </div>
          </div>

          </div>
  </div> ';
        // var_dump($reactions);
    }


}
    ?>
</div>
<!-- End facebook -->
<div id="twitter" style="display:none;margin-bottom:50px;" class="col-xs-12 col-lg-12">


</div>

<div id="youtube" style="display:none;margin-bottom:50px;" class="col-lg-12">


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
