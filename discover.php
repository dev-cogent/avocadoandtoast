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
    <script src="assets/js/influencer_pullout.js"></script>
    <script src="/assets/js/advanced-filters.js"></script>
    <script src="/assets/js/getKeywords.js"></script>
    <link rel="stylesheet" href="/assets/js/tokenfield/dist/css/bootstrap-tokenfield.css">
    <link rel="stylesheet" href="/global/fonts/brand-icons/brand-icons.css">
    <link rel="stylesheet" href="/global/fonts/font-awesome/font-awesome.css">
    <link rel="stylesheet" href="assets/css/pullout.css">
    <link rel="stylesheet" href="assets/css/influencer-card.css">
    <link rel="stylesheet" href="/assets/css/discover.css">
    <link rel="stylesheet" href="/global/js/jquery-ui-slider/jquery-ui.min.css">
    <link rel="stylesheet" href="/assets/css/advanced-filters.css">

</head>

<body>
<?php include 'php/avocado-nav.php'; ?>




<!-- right side bar -->
    <div id="influencers-pullout">
      <img id="pulltab" src="assets/images/pulltab_icon.png" alt="">
      <header>
            <div id="num-influencers">__</div>
            <div id="header-text">
            Influencers in current List
            </div>
            <div id=dismiss-button>x</div>
      </header>

      <button type="button" name="button" id="calculate">Calculate List</button>


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
            <div class="desc-header search-header">
                <div class="discover-header">DISCOVER</div>
                <div class="filter-text">Search by influencer handles and keywords</div>
                    <input type="text" class="filter-input" placeholder="Search..." tabindex="-1"/>
                    <!--<ul id="content"></ul>-->
                    <!--<div class="description-text">Separate tags with commas or by pressing "tab" in the above field.<br> Use double quotes for multi-word tags (e.g. "avocado toast")</div>-->
                    <!-- TAKE OUT INLINE STYING IF WE DECIDE TO KEEP THE DESCRIPTION TEXT -->

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

    <div class="influencer-header">INFLUENCERS <span id="influencer-results-number"></div>
      <div class="col-xs-4 col-sm-1" ></div>
      <div class="col-xs-4 col-sm-1" id="af-container">
            <div id="reset-button" class="af-header">
              RESET ALL
            </div>
            <div id="af-platforms">
              <div class="af-header"> Platforms:</div>
              <div id="af-icon-container">
                <i class="fa fa-instagram af-platform" data-platform="instagram" aria-hidden="true"></i>
                <i class="fa fa-facebook af-platform" data-platform="facebook" aria-hidden="true"></i>
                <i class="fa fa-twitter af-platform" data-platform="twitter" aria-hidden="true"></i>
                <i class="fa fa-youtube af-platform" data-platform="youtube" aria-hidden="true"></i>
              </div>
            </div>
            <div id="influencer-reach">
              <div class="af-header">
                Reach:
              </div>
              <div class="influencer-category-container">
                <div class="influencer-category" data-category="celeb"
                  data-tip="Celebrities have at least one million followers">Celebrity</div>
                <div class="category-options">

                </div>
              </div>
              <div class="influencer-category-container">
                <div class="influencer-category" data-category="macro"
                  data-tip="Macro influencers have at least 500k followers">Macro–Influencer</div>
                <div class="category-options">

                </div>
              </div>
              <div class="influencer-category-container">
                <div class="influencer-category" data-category="micro"
                  data-tip="Micro influencers have less than 500k followers">Micro–Influencer</div>
                <div class="category-options">

                </div>

              </div>
            </div>
            <div id="influencer-engagement">
              <div class="af-header"> Engagement:</div>
              <div class="engagement-input-container">
                <span class="engagement-label"> Min: </span> <input class="engagement-input" id="engagement-min" type="number" step="0.01" name="min" value="0.00">
              </div>
              <div class="engagement-input-container">
                <span class="engagement-label"> Max: </span> <input class="engagement-input" id="engagement-max" type="number" step="0.01" name="max" value="10.00">
              </div>
              <div id="engagement-error-message">
                Min should be less than max!
              </div>
            </div>
            <div id="influencer-gender">
              <div class="af-header"> Gender:</div>
              <div class="gender-block" data-gender="female">
                <div class="check"></div> Female
              </div>
              <div class="gender-block" data-gender="male">
                <div class="check"></div> Male
              </div>
            </div>
            <div id="influencer-location">
              <div class="af-header"> Location: </div>
              <input id="location-input" type="text" name="" value="" placeholder="LOCATION">
            </div>
          </div>

       <!-- <div class="influencer-header">INFLUENCER RESULTS</div>-->

        <div class="found-influencers col-xs-11">
            <?php
                //If this is a get request, then we will make a script here to collect the parameters from the GET request. Afterwards we will apply this script at the end of the page.
                if($_GET['q']){
                    $queryArr = explode(' ' ,$_GET['q']);
                    $queryArr = json_encode($queryArr);
                    $getParameter = "
                    <script>
                        var keywordsarr = '$queryArr';
                        keywordsarr = JSON.parse(keywordsarr);
                        filters['keywords'] = keywordsarr;
                        applyFilters(filters);
                        var inputString = '';
                        keywordsarr.forEach(function(element){
                            inputString += element + ' ';
                        });
                        $('.filter-input').val(inputString);
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
if(!selectedusers){
    var selectedusers = [];
}
var filters = {
  engagement:{
    min:0,
    max:10
  },
  followers:{
    min:1,
    max:1000000000
  }
};



</script>
<script src="/assets/js/avocado-discover.js"></script>
<script src="/assets/js/create-campaign.js"></script>

<?php if($getParameter) {echo $getParameter;}
      else{
          ?>
          <script>
          //If there is no $getParameter then we will then check if localStorage is still there for filters.
          if(localStorage.getItem('discover-filters') !== null && localStorage.getItem('discover-filters') !== 'undefined'){
            tempFilters = localStorage.getItem('discover-filters');
            filters = JSON.parse(tempFilters);
            applyFilters(filters);
            showFilters(filters);
          }else{
            //if not we apply default filters
            applyFilters(filters);
          }
          </script>


        <?php
      }

 ?>
