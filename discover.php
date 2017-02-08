<html>
<head>
  <link rel="stylesheet" type="text/css" href="/includes/css/discover.css">
  <?php include 'includes/head.php' ?>
  <link rel="stylesheet" href="/global/vendor/bootstrap-select/bootstrap-select.min.css?">

<script type="text/javascript" src="/jquery-3.0.0.min.js"></script>
<link rel="stylesheet" href="/sweetalert2/dist/sweetalert.css">
<link rel="stylesheet" href="/assets/uislider/nouislider.css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script src="/sweetalert2/dist/sweetalert.min.js"></script>
<script src="/bootbox/bootbox.js"></script>
<script src="/includes/javascript/account.js"></script>
<script src="/assets/wnumb/wNumb.js"></script>
<script src="/assets/uislider/nouislider.js"></script>
<style>
.overlay{
  height:100%;
  width: 15%;
  position:absolute;
  z-index:100;
  background-color:lightsteelblue;
}
</style>

</head>
  <!-- Added spacing -->
<body>
       <?php include 'includes/nav.php' ?>
            <div class="overlay" style="display:none;">
                <div class="container container-filter">
                  <div class="btn-group filter-group">
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

                  <div class="btn-group filter-group" style="">
                            <button type="button" class="btn btn-outline btn-disc dropdown-toggle"  data-toggle="dropdown" aria-expanded="false">  Location
                              <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu p-t-10 p-b-10 p-r-10 p-l-10" aria-labelledby="exampleSizingDropdown2" role="menu">
                              <li role="presentation"><input class="form-control"type="text" id="location" placeholder="Search for keywords"></li>
                              <br/>
                              <li role="presentation"><button type="button" class="btn btn-danger"><i class="icon wb-check" aria-hidden="true"></i> Apply Filter</button></li>
                            </ul>
                          </div>


                  <div class="btn-group filter-group">
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
                  <div class="btn-group filter-group">
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
                  <div class="btn-group filter-group">
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
                  <div class="btn-group filter-group">
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

                    <div class="btn-group filter-group">
                     <a class="btn btn-primary main-btn" role="button" style="color:white;margin-left:2px;padding-top:8px; padding-bottom:10px; padding-right:15px; padding-left:15px;" id="create">LIST OPTIONS</a>

                  </div>
                  <p class="slider-panel">
                  <ul class="dropdown-menu" aria-labelledby="exampleSizingDropdown2" role="menu">
                                	<div class="m-b-20">
                                    <input type="number" id="min-total">
                                    <input type="number" id="max-total">
                                    </div>
                                  <li role="presentation"><div id="slider" class="undefined"><div class="undefined"><div class="undefined" style="left: 0%;"><div class="noUi-handle noUi-handle-lower" data-handle="0" style="z-index: 5;"></div></div><div class="undefined" style="left: 0%; right: 0%;"></div><div class="undefined" style="left: 100%;"><div class="noUi-handle noUi-handle-upper" data-handle="1" style="z-index: 4;"></div></div></div></div></li>
                                  <br>
                                  <li role="presentation"><button type="button" class="btn btn-danger"><i class="icon wb-check" aria-hidden="true"></i> Apply Filter</button></li>
                                </ul>
                      </p>
              </div>
      <div  id="spacing">
        </div>

<div class="row">
  <!-- end spacing -->

<div class="container">
    <div class="col-xs-12">
                <div class="list-title-overlay" style="display:inline;"><h1 class="list-overlay"> Discover </h1> </div>


      <div id="icons">
        <div style="display:inline; padding-right:30px;" data-type="card"><i class="fa fa-1x fa-th" style="top:8; padding-right:10px"></i><h5 style="display:inline;" id="cardview">Card View</h5></div>
        <div style="display:inline;" data-type="list"><i class="fa fa-1x fa-bars" style="top:8; padding-right:10px"></i><h5 style="display:inline;" id="listview">List View</h5></div>
      </div>
  </div>
      </div>
    </div>

       <div  id="spacing"></div>
<div class="row">
       <div class="m-b-40" id="filters" style="background-color:rgba(241, 242, 243, 1); padding-bottom: 20;padding-top: 20;">
         <div class="container" style="padding-left:0.8%;">




            <div class="btn-group">
             <a class="btn btn-primary main-btn" role="button" style="color:white;margin-left:2px;padding-top:8px; padding-bottom:10px; padding-right:15px; padding-left:15px;" id="create"> FILTER BY </a>

          </div>
                 <div id="circles">



                   <div class="tooltip tooltip-scroll" id="scrollcircle" style="display:inline;"><p id="usercount">+0</p>
              <div class="wrapper">
                  <span class="tooltip-text" id="append">

                  </span></div>

              </div>
                 </div>
            </div>

       </div>
      </div>


 <div class="container"  class="test">
    <div class="row" id="content">

      <!-- All content will be autofilled in here -->

    </div>
  </div>

  </body>


<script>
        //global variables
        var page = 0;
        var selectedusers = [];
        var filters = {};
        var totalpage = '<?php echo $maxpage;?>';
        var collapse = false;
        var bubble = false;
        var type= "list";

</script>


  <script>

var type ='list';
var overlay = false;

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
<script src="/includes/javascript/discover.js"></script>
<script src="/includes/javascript/slider.js"></script>
</html>
