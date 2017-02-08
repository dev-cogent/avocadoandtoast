<?php 
include 'includes/getUserInfo.php';
include 'includes/class/useroptions.php';
$useroptionsobj = new userOptions;
$accesstoken = $_SESSION['access_token'];
$url = 'https://api.instagram.com/v1/locations/search?lat=40.743228&lng=-73.999168&access_token='.$accesstoken;
$location = $useroptionsobj->curl($url);



        $address = $dlocation; // Google HQ
        $address = 'New York New York';
        $prepAddr = str_replace(' ','+',$address);
        $geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
        $output= json_decode($geocode);
        $latitude = $output->results[0]->geometry->location->lat;
        $longitude = $output->results[0]->geometry->location->lng;
        var_dump($latitude);

?>

<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <?php include 'includes/head.php' ?>
    <title>My Profile | Project Social</title>
    <script type="text/javascript" src="/jquery-3.0.0.min.js"></script>
      <style scoped>
        .ajax-text-and-image {
          max-width: 925px;
          padding: 0;
        }
        
        .ajax-col {
          width: 50%;
          float: left;
        }
        
        .ajax-col img {
          width: 100%;
          height: auto;
        }
        
        @media all and (max-width:30em) {
          .ajax-col {
            width: 100%;
            float: none;
          }
        }
        .carousel-inner>.item>a>img, .carousel-inner>.item>img, .img-responsive, .thumbnail a>img, .thumbnail>img {
    display: block;
    max-width: 100%;
    height: auto;
}
      </style>
</head>
<body class="animsition site-navbar-small ">
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
  <?php include 'includes/nav.php' ?>

  <?php include 'includes/sidebar.php' ?>
  
  <!-- Page -->
  <div class="page">
    <div class="page-content container-fluid">

      
      <div class="col-xlg-12 col-md-12">
          <!-- Example Heading With Desc -->
          <div class="panel">
            <div class="panel-body">
            <div class="col-lg-4">




              </div>


            <!-- end col -lg-8 -->

            </div>
          </div>


        <!-- close out main div --> 

          <!-- End Example Heading With Desc -->
        </div>

      
      <div class="col-xlg-12 col-md-12">
          <!-- Example Heading With Desc -->
          <div class="panel">
            <div class="panel-heading">
              <h3 class="panel-title">All Media
              </h3>
            </div>
            <div class="panel-body">



            </div>
          </div>
          <!-- End Example Heading With Desc -->
        </div>
      
      
      
    </div>
  </div>
  <!-- End Page -->

  <?php include 'includes/footer.php' ?>

</body>
<script src="/includes/javascript/getmediacomments.js"></script>
</html>