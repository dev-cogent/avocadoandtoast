<?php
session_start();
//error_reporting(0);
include 'includes/dbinfo.php';
?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <?php include 'includes/head.php' ?>
    <title>Blank Page | Project Social</title>
<script src="/bootbox/bootbox.js"></script>
<script src="/includes/javascript/savecampaign.js"></script>
<script src="/includes/javascript/addtolist.js"></script>
<script src="/global/vendor/bootstrap/bootstrap.js"></script>
</head>
<body class=" ">
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
   <?php include 'includes/nav.php' ?>



  <!-- Page -->

          <div class="list-header row" >
              <div class="col-xs-5">
                <div class="list-title-overlay"><h1 class="list-overlay"> Create List </h1> 
                <div class="list-title-div"><h2 class="list-title"> 
                  </h2>
              </div>
            </div>
        </div>



              <div class="col-xs-7 button-div">
          <div class="list-buttons-pad" style="margin-top:75px;">
                <input class="form-control" style="width:25%; display:unset; margin-right:10px;" type="text"  placeholder="listname" id="listname">
                <input class="form-control" style="width:25%; display:unset; margin-right:10px;"type="text"  placeholder="description" id="description">
          <a href="#" class="btn btn-primary main-btn" role="button" id="createlist">  Create List </a>
            <a href="#" class="btn btn-primary main-btn" role="button"> Export PDF  </a>
                <a href="#" class="btn btn-primary main-btn" role="button" id="save"> Delete List </a>
            </div>
          </div>

              </div>



    <div class="row search-list-nav">
        <div class="col-xs-6">
      <div class="input-search list" style="padding-left:35.4%">
                    <button type="submit" class="input-search-btn"><i class="icon wb-search" aria-hidden="true"></i></button>
                    <input id="search" type="text" class="form-control list-create-form" name="" placeholder="+ Influencers">
                  </div>
      </div>


        <div class="col-xs-6 right-side vertical-align-middle">
          <div id="circles">
            <div class="tooltip tooltip-scroll" id="scrollcircle" style="display:inline;"><p id="usercount">+0</p>
                  <div class="wrapper">
                      <span class="tooltip-text" id="append">

                      </span></div>
          </div>

          <div id="amount" style="">
            0 Selected Users
          </div>
        </div>
            <a href="#" class="btn btn-primary clear-btn" role="button" id="clearall"> Clear all  </a>
          </div>

  </div>

  <div class="container-fluid">
  <div class="page-content container" id="content">


        <?php

        $count = 4;
        $stmt = $conn->prepare("SELECT `user`,`id`,`image_url`,`location`,`instagram_count`,`instagram_url`,`facebook_count`,`facebook_url`,`twitter_count`,`twitter_url` FROM `Influencer_Information` ORDER BY `total` DESC LIMIT 0,36");
        $stmt->execute();
        $stmt->bind_result($user,$id,$image,$location,$instagramcount,$instagramurl,$facebookcount,$facebookurl,$twittercount,$twitterurl);
        while($stmt->fetch()){
        if($count == 4){
          echo '<div class="row card-row">';
          $count = 0;
        }
        $check = in_array($id,$_SESSION['favoriteinfluencers']);
        echo '
         <div class="col-xs-6 col-sm-3">
          <div class="thumbnail add" data-id="'.$id.'" data-image="'.$image.'" data-check="false">
              <img src="http://project.social/'.$image.'" alt="influencer-picture" class="thumbnail-pic">
              <div class="name-info">
                <h5 class="influencer-name"> '.$user.' </h5>
                <h6 class="influencer-location"> '.$location.' </h6>

                  <div class="info">
                    <p class="social-info">



                      <img src="assets/images/ig_grey.png" alt="instagram-logo" class="instagram-logo "> <br>
                      <h7 class="numbers ig-following"> '.number_format($instagramcount).' </h7>

                    </p>

                    <p class="social-info">
                      <img src="assets/images/fb_grey.png" alt="facebook-logo" class="facebook-logo"> <br>
                      <h7 class="numbers fb-following"> '.number_format($facebookcount).' </h7>
                  </p>

                    <p class="social-info">
                      <img src="assets/images/twitter_grey.png" alt="twitter-logo" class="twitter-logo"> <br>
                      <h7 class="numbers twitter-following"> '.number_format($twittercount).' </h7>
                  </p>

                   <p class="icon-btn"><a class="addtolist btn plus-icon-btn" role="button" data-id="'.$id.'" data-user="'.$user.'" data-role="list">
                          <i class="icon wb-plus list-icon" aria-hidden="true"></i>
                          </a>

                    ';
                    if($check == true) echo '<a  class="favorite btn fav-icon-btn" role="button"  data-favorite="true"  data-id="'.$id.'" data-user="'.$user.'" style="color:red;">';
                    else echo '<a  class="favorite btn fav-icon-btn" role="button"  data-favorite="false"  data-id="'.$id.'" data-user="'.$user.'">';
                    echo '       <i class="fa fa-heart" aria-hidden="true"></i>
                                 </a>
                                 
                          </p>
                  </div>
              </div>
          </div>
        </div>';
        $count++;
        if($count == 4){
          echo '</div>';
        }
        }
        ?>

      <!-- container ends -->
    </div>
  </div>
                      <!-- container fluid ends  -->


  <!-- End Page -->
  <script>
  var page = 1;
  var search = '';
  var selectedusers = [];
  </script>
  <script src="/includes/javascript/createlist.js"></script>
  <script src="/includes/javascript/list.js"></script>
  <script src="/includes/javascript/favorite.js"></script>
  <?php include 'includes/footer.php' ?>
</body>
</html>
