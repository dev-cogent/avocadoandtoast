<?php
session_start();
error_reporting(0);
include 'php/dbinfo.php';
include 'php/numberAbbreviation.php';

?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
    <link rel="stylesheet" href="/assets/uislider/nouislider.css">
    <?php include 'html/head.html' ?>
    <title>Discover | Avocado & Toast</title>
    <script src="/bootbox/bootbox.js"></script>
    <script src="/global/vendor/bootstrap/bootstrap.js"></script>
    <script src="/global/js/jquery-ui-slider/jquery-ui.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Open+Sans:400,700" rel="stylesheet">
    <script src="/assets/js/abbreviatenumber.js"></script>
    <script src="/assets/wnumb/wNumb.js"></script>
    <script src="/assets/uislider/nouislider.js"></script>
    <script src="/assets/js/tokenfield/dist/bootstrap-tokenfield.js"></script>
    <script src="/assets/js/loading.js"></script>
    <script src="/assets/js/avocado-card-functions.js"></script>
    <script src="/assets/js/avocado-calculate.js"></script>
    <script src="assets/js/influencer_pullout.js"></script>
    <script src="assets/js/af-slidedown.js"></script>
    <link rel="stylesheet" href="/assets/js/tokenfield/dist/css/bootstrap-tokenfield.css">
    <link rel="stylesheet" href="/global/fonts/brand-icons/brand-icons.css">
    <link rel="stylesheet" href="/global/fonts/font-awesome/font-awesome.css">
    <link rel="stylesheet" href="assets/css/pullout.css">
    <link rel="stylesheet" href="assets/css/influencer-card.css">
    <link rel="stylesheet" href="/assets/css/discover.css">
    <link rel="stylesheet" href="/assets/css/af-slidedown.css">
    <link rel="stylesheet" href="/global/js/jquery-ui-slider/jquery-ui.min.css">
</head>

<body>
<?php include 'php/avocado-nav.php'; ?>

<!-- right side bar -->
    <div id="influencers-pullout">
      <img id="pulltab" src="assets/images/pulltab_icon.png" alt="">
      <header>
            <div id="num-influencers">__</div>
            <div id="header-text">
            Influencers in current campaign
            </div>
            <div id=dismiss-button>x</div>
      </header>

      <button type="button" name="button" id="calculate">Calculate campaign</button>


      <div  id="influencer-pullout-image-container">


 <!-- images go here -->


      </div>

      <div id="action-buttons">
        <button id="remove-button" class="greyed-out" type="button" name="button">Remove selected</button>
        <button id="remove-all-button" class="greyed-out" type="button" name="button">Remove all</button>
        <button id="undo-button" class="greyed-out" type="button" name="button"> Undo</button>
      </div>
    </div>

<!-- end right side bar -->

<!-- Add side bar here -->
<div id="loading"><img style="height:250px; width:250px;"src="/assets/images/loading.gif"/></div>



<!-- The third nav bar , we might be able to take this out. In the mean time, we'll keep it here -->

<div id="myNav" class="overlay"></div>
<div id="discover-container">

<!--Filter content -->




<div class="filter-section col-xs-12">
            <div class="desc-header">
                <div class="discover-header">DISCOVER</div>
                <div class="filter-text">Search by influencer handles and keywords</div>
                    <input type="text" class="filter-input" id="tokenfield" placeholder="keyword"/>
                    <div class="description-text">Separate tags with commas or by pressing "tab" in the above field.<br> Use double quotes for multi-word tags (e.g. "avocado toast")</div>
                                            <div  id="af-link"> Advanced Filtering </div>
                        <!-- Filtering options will go here -->
                            <div id="af-slidedown">

                                <div id="af-icon-container">
                                <i class="fa fa-instagram" aria-hidden="true" data-platform="instagram"></i>
                                <i class="fa fa-facebook" aria-hidden="true" data-platform="facebook"></i>
                                <i class="fa fa-twitter" aria-hidden="true" data-platform="twitter"></i>
                                <i class="bd-youtube" aria-hidden="true" data-platform="youtube"></i>
                                </div>
                                <div class="af-slider-container">
                                <div class="af-slider-text">
                                    <label for="num-followers">FOLLOWERS:</label>
                                </div>
                                <div class="af-inputs">
                                    <input type="text" id="num-followers1">
                                    <div id="follower-range"></div>
                                    <input type="text" id="num-followers2">
                                </div>
                                </div>
                                <div class="af-slider-container">
                                <div class="af-slider-text">
                                    <label for="num-engagement">ENGAGEMENT:</label>
                                </div>
                                <div class="af-inputs">
                                    <input type="text" id="num-engagement1">
                                    <div id="engagement-range"></div>
                                    <input type="text" id="num-engagement2">
                                </div>
                                </div>
                    </div>
                    <div class="button-container">
                
                        <button class="search-button primary-button" id="search-keyword">SEARCH</button>

            </div>

</div>




<!--<div class="influencer-results-container col-xs-12">-->







<!--
        <div class="filter-button-container" id="button-filter">
             <i class="filter-option button-icon button-icon-active icon bd-instagram"  data-platform="instagram" aria-hidden="true"></i>
            <i class="filter-option button-icon icon bd-facebook"  data-platform="facebook" aria-hidden="true"></i>
            <i class="filter-option button-icon icon bd-twitter"  data-platform="twitter" aria-hidden="true"></i>
            <i class="filter-option button-icon icon bd-youtube"  data-platform="youtube" aria-hidden="true"></i>
        </div>


<!-- Slider Rows -->
        <!--<div class="slider-container">
                <div class="measure-text">FOLLOWERS</div>
                        <div class="sliders"  data-platform="instagram">
                            <input  class="col-xs-1 input-filter " type="text" id="min-instagram">
                            <div id="slider-instagram" class="col-xs-10"></div>
                            <input id="max-instagram" class="col-xs-1 input-filter"style="display:inline; padding-left:2%; padding-right:0px;" type="text">
                        </div>

            <div class="sliders" data-platform="facebook" style="display:none;">
                <input  class="col-xs-1 input-filter" type="text" id="min-facebook">
                <div  id="slider-facebook" class="col-xs-10"></div>
                <input id="max-facebook" class="col-xs-1 input-filter"style="display:inline; padding-left:2%; padding-right:0px;" type="text">
            </div>

            <div class="sliders" data-platform="twitter" style="display:none;">
                <input  class="col-xs-1 input-filter" type="text" id="min-twitter">
                <div id="slider-twitter" class="col-xs-10"></div>
                <input id="max-twitter" class="col-xs-1 input-filter"style="display:inline; padding-left:2%; padding-right:0px;" type="text">
            </div>




            </div>

        <div class="slider-container" >
                <div class="measure-text" id="engagement-text" >ENGAGEMENT %</div>
            <div class="sliders" data-platform="instagram-engagement">
                <input  class="col-xs-1 input-filter engagement-slider " type="text" id="min-instagram-engagement">
                <div style="margin-top:20px;" id="slider-instagram-engagement" class="col-xs-10"></div>
                <input id="max-instagram-engagement" class="col-xs-1 input-filter engagement-slider"style="display:inline; padding-left:2%; padding-right:0px;" type="text">
            </div>
            <div class="sliders" data-platform="facebook-engagement" style="display:none;">
                <input  class="col-xs-1 input-filter engagement-slider" type="text" id="min-facebook-engagement">
                <div  style="margin-top:20px;" id="slider-facebook-engagement" class="col-xs-10"></div>
                <input id="max-facebook-engagement" class="col-xs-1 input-filter engagement-slider"style="display:inline; padding-left:2%; padding-right:0px;" type="text">
            </div>

            <div class="sliders" data-platform="twitter-engagement" style="display:none;">
                <input  class="col-xs-1 input-filter engagement-slider" type="text" id="min-twitter-engagement">
                <div style="margin-top:20px;" id="slider-twitter-engagement" class="col-xs-10"></div>
                <input id="max-twitter-engagement" class="col-xs-1 input-filter engagement-slider"style="display:inline; padding-left:2%; padding-right:0px;" type="text">
            </div>-->


            <!--</div>-->












<!--end slider rows -->

    <hr>
    <br>

    <div class="influencer-header">INFLUENCER RESULTS</div>


       <!-- <div class="influencer-header">INFLUENCER RESULTS</div>-->

        <div class="found-influencers col-xs-12">
            <?php
                //If this is a get request, then we will make a script here to collect the parameters from the GET request. Afterwards we will apply this script at the end of the page. 
                if($_GET['q']){
                    $queryArr = explode(' ' ,$_GET['q']);
                    $queryArr = json_encode($queryArr);
                    $javaquery = "
                    <script>
                        var keywordsarr = '$queryArr';
                        keywordsarr = JSON.parse(keywordsarr);
                        filters['keywords'] = keywordsarr;
                        applyFilters(filters);
                        keywordsarr.forEach(function(element){
                            $('#tokenfield').tokenfield('createToken', element);
                        });
                    </script>
                    ";
                } 
            ?>
        </div>
    </div>
</div>


</body>
</html>
<script>
$('#tokenfield').tokenfield();
var calculate = false;
var page = 0;
var selectedusers = [];
var filters = {};
</script>
<script src="/assets/js/avocado-slider.js"></script>
<script src="/assets/js/avocado-discover.js"></script>
<script src="/assets/js/create-campaign.js"></script>
<?php if($javaquery) {echo $javaquery;}
      else{
          echo '<script> applyFilters(filters,false); </script>';
      }

 ?>
