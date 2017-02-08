<?php
include 'includes/getinstagraminfo.php';
/*require "includes/twitteroauth/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

$CONSUMER_KEY = 'sVKOtGf2xTT7iHBgC4WJcgHAD';
$CONSUMER_SECRET = 'vgpJcVDEzUR2a4SJ0hjAktHI4qYS9bgXlEhHD5fMUdE8IMIAMK';
$OAUTH_CALLBACK = 'http://localhost:8000/twittersign.php';
$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET);
$request_token = $connection->oauth("oauth/request_token", array("oauth_callback" => "http://localhost:8000/twittersign.php"));
$_SESSION['oauth_token'] = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
$url = $connection->url("oauth/authorize", array("oauth_token" => $request_token['oauth_token']));*/
?>

<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap admin template">
  <meta name="author" content="">
  <title>Add Instagram | Project Social</title>
  <link rel="apple-touch-icon" href="assets/images/apple-touch-icon.png">
  <link rel="shortcut icon" href="assets/images/favicon.ico">
  <!-- Stylesheets -->
  <link rel="stylesheet" href="global/css/bootstrap.min.css">
  <link rel="stylesheet" href="global/css/bootstrap-extend.min.css">
  <link rel="stylesheet" href="assets/css/site.min.css">
  <!-- Plugins -->
  <link rel="stylesheet" href="global/vendor/animsition/animsition.css">
  <link rel="stylesheet" href="global/vendor/asscrollable/asScrollable.css">
  <link rel="stylesheet" href="global/vendor/switchery/switchery.css">
  <link rel="stylesheet" href="global/vendor/intro-js/introjs.css">
  <link rel="stylesheet" href="global/vendor/slidepanel/slidePanel.css">
  <link rel="stylesheet" href="global/vendor/jquery-mmenu/jquery-mmenu.css">
  <link rel="stylesheet" href="global/vendor/flag-icon-css/flag-icon.css">
  <link rel="stylesheet" href="global/vendor/jquery-mmenu/jquery-mmenu.css">
  <link rel="stylesheet" href="assets/examples/css/pages/register-v2.css">
  <!-- Fonts -->
  <link rel="stylesheet" href="global/fonts/web-icons/web-icons.min.css">
  <link rel="stylesheet" href="global/fonts/brand-icons/brand-icons.min.css">
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
  <link rel="stylesheet" href="/global/fonts/font-awesome/font-awesome.min.css">
   <link rel="stylesheet" href="/global/fonts/font-awesome/font-awesome.css">
  <!--[if lt IE 9]>
    <script src="../../../global/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->
  <!--[if lt IE 10]>
    <script src="../../../global/vendor/media-match/media.match.min.js"></script>
    <script src="../../../global/vendor/respond/respond.min.js"></script>
    <![endif]-->
  <!-- Scripts -->
  <script src="global/vendor/breakpoints/breakpoints.js"></script>
  <script src="jquery-3.0.0.min.js"></script>
  <script>
  Breakpoints();
  </script>
</head>
<body class="animsition page-register-v2 layout-full page-dark">
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
  <!-- Page -->
  <div class="page" data-animsition-in="fade-in" data-animsition-out="fade-out">
    <div class="page-content">
      <div class="page-brand-info">
        <div class="brand">
         <!-- <img class="brand-img" src="/assets/logos/ps-black.png" alt="..."> -->
          <h2 class="brand-text font-size-40">CONNECT INSTAGRAM ACCOUNT</h2>
        </div>
        <p class="font-size-20">  Connect an Instagram account to begin using Project Social</p>
      </div>
      <div class="page-register-main">
        <div class="brand hidden-md-up">
          <img class="brand-img" src="/assets/logos/ps-black.png" alt="..." style="width:350px;">
          
        </div>
        <h3 class="font-size-24">START A FREE TRIAL</h3>
        <p>SIGN UP NOW TO START YOUR 14 DAY FREE TRIAL.<br> NO CREDIT CARD NEEDED.</p>
        
        <p>
          Connect an Instagram account to begin using Project Social
        </p>
        <div class="col-xl-12">
          
        <div class="col-xl-6">
        <button type="button" class="btn btn-labeled btn-sm social-instagram">
        <a href="https://api.instagram.com/oauth/authorize/?client_id=72ecc575c986492282e238e6429798e7&redirect_uri=https://project.social/addinstagram.php&response_type=code&scope=basic+public_content+follower_list+comments+relationships+likes">
                        <span class="btn-label"><i class="icon bd-instagram" aria-hidden="true"></i></span>Add a Instagram Account</a></button>

          </div>
          <div class="col-xl-6">
        <a href="/account"> <button type="button" class="btn btn-outline btn-default" href="/empty">Start Using Project Social</button></a>
          </div>
          </div>
          
          </div>
        <!-- START CONNECTED ACCOUNT -->
        
        <div class="col-xl-8 m-t-25">
       <?php 
        if(!isset($useroptionobj)){
        include 'includes/class/useroptions.php';
        $useroptionobj = new userOptions;
        }
        $conn = $useroptionobj->dbinfo();
        $instagramAccounts = $useroptionobj->getInstagramAccounts($_SESSION['userid'],$conn);
        if($instagramAccounts != NULL || $instagramAccounts != ""){
        foreach($instagramAccounts as $id){
        $stmt = $conn->prepare("SELECT `username`,`profile_picture`,`full_name` FROM `user_instagram_information` WHERE `instagram_id` = ?");
        $stmt->bind_param('s',$id);
        $stmt->execute();
        $stmt->bind_result($username,$profile_picture,$full_name);
        while($stmt->fetch()){
        echo'
        <div class="col-xl-3">
          <img class="img-circle" width="100" height="100" src="'.$profile_picture.'" alt="...">
        </div>
        <div class="col-xl-9">
            <div class="col-xl-6">
            <p>'.$full_name.'</p>
            <p>'.$username.'</p> 
            </div>
            <div class="col-xl-6">
            <button type="button" class="btn btn-floating btn-danger pull-right"><i class="icon wb-minus" aria-hidden="true"></i></button>
            </div>
        </div> 
       ';
            }
          }
        }
       ?>
          
        </div>
        <!-- END CONNECTED ACCOUNT -->
        
      

    
        <div style="display:none"><iframe src="https://instagram.com/accounts/logout/" width="0" height="0"></iframe></div>
        <footer class="page-copyright">
          
          <p>© PROJECT SOCIAL 2016. All RIGHT RESERVED.</p>
          <div class="social">
            <a class="btn btn-icon btn-round social-twitter" href="javascript:void(0)">
              <i class="icon bd-twitter" aria-hidden="true"></i>
            </a>
            <a class="btn btn-icon btn-round social-facebook" href="javascript:void(0)">
              <i class="icon bd-facebook" aria-hidden="true"></i>
            </a>
            <a class="btn btn-icon btn-round social-google-plus" href="javascript:void(0)">
              <i class="icon bd-google-plus" aria-hidden="true"></i>
            </a>
          </div>
        </footer>
      </div>
    </div>
  </div>
  <!-- End Page -->
 <!-- Core  -->
  <script src="../global/vendor/babel-external-helpers/babel-external-helpers.js"></script>
  <script src="../global/vendor/jquery/jquery.js"></script>
  <script src="../global/vendor/tether/tether.js"></script>
  <script src="../global/vendor/bootstrap/bootstrap.js"></script>
  <script src="../global/vendor/animsition/animsition.js"></script>
  <script src="../global/vendor/mousewheel/jquery.mousewheel.js"></script>
  <script src="../global/vendor/asscrollbar/jquery-asScrollbar.js"></script>
  <script src="../global/vendor/asscrollable/jquery-asScrollable.js"></script>
  <!-- Plugins -->
  <script src="../global/vendor/jquery-mmenu/jquery.mmenu.min.all.js"></script>
  <script src="../global/vendor/switchery/switchery.min.js"></script>
  <script src="../global/vendor/intro-js/intro.js"></script>
  <script src="../global/vendor/screenfull/screenfull.js"></script>
  <script src="../global/vendor/slidepanel/jquery-slidePanel.js"></script>
  <script src="../global/vendor/jquery-placeholder/jquery.placeholder.js"></script>
  <!-- Scripts -->
  <script src="../global/js/State.js"></script>
  <script src="../global/js/Component.js"></script>
  <script src="../global/js/Plugin.js"></script>
  <script src="../global/js/Base.js"></script>
  <script src="../global/js/Config.js"></script>
  <script src="assets/js/Section/Menubar.js"></script>
  <script src="assets/js/Section/Sidebar.js"></script>
  <script src="assets/js/Section/PageAside.js"></script>
  <!-- Config -->
  <script src="../global/js/config/colors.js"></script>
  <script src="assets/js/config/tour.js"></script>
  <script>
  Config.set('assets', 'assets');
  </script>
  <!-- Page -->
  <script src="assets/js/Site.js"></script>
  <script src="../global/js/Plugin/asscrollable.js"></script>
  <script src="../global/js/Plugin/slidepanel.js"></script>
  <script src="../global/js/Plugin/switchery.js"></script>
  <script src="../global/js/Plugin/jquery-placeholder.js"></script>
  <script src="../global/js/Plugin/animate-list.js"></script>
  <script>
  (function(document, window, $) {
    'use strict';
    var Site = window.Site;
    $(document).ready(function() {
      Site.run();
    });
  })(document, window, jQuery);
  </script>
</body>
</html>
