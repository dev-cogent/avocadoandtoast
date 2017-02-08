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

          <div class="campaign-header row" >
              <div class="col-xs-12 campaign-calc">
                <div class="list-title-overlay"><h1 class="list-overlay"> Campaign Calculator </h1>
                  <div class="campaign-button-pad" style="">
                      <a href="#" class="btn btn-primary main-btn next-btn" role="button" id="next"> Next  </a>
                    </div>
                  <ol class="breadcrumb breadcrumb-arrow">
                    <li class="active bread"><div class="breadcrumb-1 active"> 01 </div><a class="first-breadcrumb" href="javascript:void(0)"> Search Influencers </a> <i class="icon ml-arrow_right" aria-hidden="true" style="font-size: 24px;"></i>  </li>
                    <li class="bread"><div class="breadcrumb-2"> 02 </div><a href="javascript:void(0)" class="second-breadcrumb">Number of Posts </a></li>
                  </ol>
                <div class="list-title-div"><h2 class="list-title">
                  </h2>
              </div>
            </div>
        </div>



              <!-- <div class="col-xs-7 button-div"> -->
          <!-- </div> -->

              </div>



    <div id="influencerrow" class="row search-list-nav">
        <div class="col-xs-6">
      <div class="input-search list" style="padding-left:35.4%">
                    <button type="submit" class="input-search-btn"><i class="icon ti-search" aria-hidden="true"></i></button>
                    <input id="search" type="text" class="form-control list-create-form" name="" placeholder="+ Influencers">
                  </div>
      </div>
       <div class="btn-group">
                    <button type="button" class="btn btn-outline btn-disc dropdown-toggle"  data-toggle="dropdown" aria-expanded="false">  Keyword
                      <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu p-t-10 p-b-10 p-r-10 p-l-10" aria-labelledby="exampleSizingDropdown2" role="menu">
                      <li role="presentation"><input class="form-control"type="text" id="bioinput" placeholder="Search for keywords"></li>
                     <li role="presentation"> <div class="radio-custom radio-primary">
                                        <input data-id="and" class="options" type="radio" id="inputRadiosUnchecked" name="radio-stacked" checked>
                                        <label for="inputRadiosUnchecked">Search for all words (and)</label>

                                         <input data-id="or" class="options" type="radio" id="inputRadiosChecked" name="radio-stacked">
                                        <label for="inputRadiosChecked">Search for anyword (or)</label>
                                    </div>
                        </li>
                          <li role="presentation">

                                   <div class="checkbox-custom checkbox-primary">
                                  <input data-id="tags" type="checkbox" class="search" id="inputChecked1" checked>
                                  <label for="inputChecked1">Search Keywords in bio </label>

                                  <input data-id="names"type="checkbox" class="search" id="inputChecked" checked>
                                  <label for="inputChecked">Search names & handles</label>
                                  </div>

                            </li>

                      <li role="presentation"><button id="bio" type="button" class="btn btn-danger"><i class="icon wb-check" aria-hidden="true"></i> Apply Filter</button></li>
                    </ul>
                  </div>

          <div class="btn-group">
                    <button type="button" class="btn btn-outline btn-disc dropdown-toggle"  data-toggle="dropdown" aria-expanded="false">  Location
                      <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu p-t-10 p-b-10 p-r-10 p-l-10" aria-labelledby="exampleSizingDropdown2" role="menu">
                      <li role="presentation"><input class="form-control"type="text" id="location" placeholder="Search for keywords"></li>
                      <br/>
                      <li role="presentation"><button type="button" class="btn btn-danger"><i class="icon wb-check" aria-hidden="true"></i> Apply Filter</button></li>
                    </ul>
                  </div>


          <div class="btn-group">
                    <button type="button" class="btn btn-outline btn-disc dropdown-toggle"  data-toggle="dropdown" aria-expanded="false">  Instagram
                      <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu p-l-10 p-r-10 p-t-10" aria-labelledby="exampleSizingDropdown2" role="menu">
                    		<div class="m-b-20">
                        <input type="number" id="min-instagram">
                        <input type="number" id="max-instagram">
                        </div>
                      <li role="presentation"><div id="slider-instagram"></div>
                      <br/>
                      <li role="presentation" style="text-align:center;"><button id="instagramfilter" type="button" class="btn btn-danger"><i class="icon wb-check" aria-hidden="true"></i> Apply Filter</button></li>
                    </ul>
                  </div>
          <div class="btn-group">
                    <button type="button" class="btn btn-outline btn-disc dropdown-toggle"  data-toggle="dropdown" aria-expanded="false">  Twitter
                      <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="exampleSizingDropdown2" role="menu">
                    	<div class="m-b-20">
                      <input type="number" id="min-twitter">
                      <input type="number" id="max-twitter">
                      </div>
                      <li role="presentation"><div id="slider-twitter"></div></li>
                      <br/>
                      <li role="presentation" style="text-align:center;" ><button type="button" class="btn btn-danger"><i class="icon wb-check" aria-hidden="true"></i> Apply Filter</button></li>
                    </ul>
                  </div>
          <div class="btn-group">
                    <button type="button" class="btn btn-outline btn-disc dropdown-toggle"  data-toggle="dropdown" aria-expanded="false">  Facebook
                      <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="exampleSizingDropdown2" role="menu">
                    	 <div class="m-b-20">
                        <input type="number" id="min-facebook">
                        <input type="number" id="max-facebook">
                        </div>
                      <li role="presentation"><div id="slider-facebook"></div></li>
                      <br/>
                      <li role="presentation" style="text-align:center;" ><button type="button" class="btn btn-danger"><i class="icon wb-check" aria-hidden="true"></i> Apply Filter</button></li>
                    </ul>
                  </div>
          <div class="btn-group">
                    <button type="button" class="btn btn-outline btn-disc dropdown-toggle"  data-toggle="dropdown" aria-expanded="false">  Total
                      <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="exampleSizingDropdown2" role="menu">
                    	<div class="m-b-20">
                        <input type="number" id="min-total">
                        <input type="number" id="max-total">
                        </div>
                      <li role="presentation"><div id="slider"></div></li>
                      <br/>
                      <li role="presentation"><button type="button" class="btn btn-danger"><i class="icon wb-check" aria-hidden="true"></i> Apply Filter</button></li>
                    </ul>
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
  var search = '';
  var selectedusers = [];
  var previouscontent;
  var previousbar;
  var previouspage;
  var page = 1;
  var filters = {};
  var totalpage = '<?php echo $maxpage;?>';
  var bubble = false;
  var type= "card";


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

            // Handle special case where we round up to the next abbreviation
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
  </script>
  <script src="/includes/javascript/list.js"></script>
  <script src="/includes/javascript/favorite.js"></script>
  <script src="/includes/javascript/campaigncalculator.js"></script>
  <script src="/includes/javascript/discover.js"></script>
  <?php include 'includes/footer.php' ?>
</body>
</html>
