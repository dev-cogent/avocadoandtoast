<?php 
session_start();
error_reporting(0);
?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
  <link rel="stylesheet" href="../../../global/vendor/floatthead/jquery.floatThead.css">
  <link rel="stylesheet" href="../../assets/examples/css/tables/floatthead.css">
<head>
  <?php include 'includes/head.php' ?>
    <title>Search + Filter Page | Project Social</title>
    <style>
nav.tabs {
    height: 80px;
    width: 100%;
}
nav.tabs li.current {
    background: #37b480;
}
nav.tabs nav.item li {
    background: #FFF;
    display: block;
    float: left;
    height: 100%;
    line-height: 80px;
    width: 50%;
    -webkit-transition-property: background;
    -webkit-transition-duration: 100ms;
    -webkit-transition-timing-function: linear;
    -webkit-transition-delay: 0;
    -moz-transition-property: background;
    -moz-transition-duration: 100ms;
    -moz-transition-timing-function: linear;
    -moz-transition-delay: 0;
    -ms-transition-property: background;
    -ms-transition-duration: 100ms;
    -ms-transition-timing-function: linear;
    -ms-transition-delay: 0;
    -o-transition-property: background;
    -o-transition-duration: 100ms;
    -o-transition-timing-function: linear;
    -o-transition-delay: 0;
    transition-property: background;
    transition-duration: 100ms;
    transition-timing-function: linear;
    transition-delay: 0;
}
nav.tabs li.current a {
    color: #FFF;
}
nav.tabs .filter a {
    float: right;
}
nav.tabs li a {
    letter-spacing: 0.128em;
    font-family: 'proxima-nova', sans-serif;
    font-weight: 400;
    -webkit-font-smoothing: antialiased;
    color: #3a3532;
    display: block;
    font-size: 1.3em;
    font-weight: 700;
    max-width: 570px;
    text-align: center;
    text-decoration: none;
    text-transform: uppercase;
    width: 100%;
}

.tab-block {
    width: 50%;
    display: block;
    line-height: 80px;
    height: 100%;
}
.nav-tabs .nav-item+.nav-item {
 margin-left: 0px !important;
}
.center-block {
    display: block;
    margin-right: auto;
    margin-left: auto;
}
.mr5 {
    margin-right: 5px;
}
.btn-black {
    height: 60px;
    background: #3a3532;
    color: #fff;
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
<div class="row">

        <div class="col-lg-12">
          <!-- Example Tabs Inverse -->
          <div class="example-wrap">
            <div class="nav-tabs-horizontal" data-plugin="tabs">
              <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item tab-block" role="presentation">
                  <a class="nav-link active" data-toggle="tab" href="#exampleTabsInverseOne" aria-controls="exampleTabsInverseOne" role="tab" aria-expanded="true">
                  FILTER
                </a>
                </li>
                <li class="nav-item tab-block" role="presentation">
                  <a class="nav-link" data-toggle="tab" href="#exampleTabsInverseTwo" aria-controls="exampleTabsInverseTwo" role="tab" aria-expanded="false">
                  SEARCH
                </a>
                </li>
              </ul>
              <div class="col-lg-12 tab-content">

                <div class="tab-pane active" id="exampleTabsInverseOne" role="tabpanel" aria-expanded="true">
                  
                  <!-- START FILTER ROW -->
                  <div class="row">
                  <div class="col-lg-12 text-center m-y-25">
                  <button type="button" class="btn btn-round btn-outline btn-primary btn-lg mr5">Filter 1</button>
                  <button type="button" class="btn btn-round btn-outline btn-primary btn-lg mr5">Filter 2</button>
                  <button type="button" class="btn btn-round btn-outline btn-primary btn-lg mr5">Filter 3</button>
                  <button type="button" class="btn btn-round btn-outline btn-primary btn-lg mr5">Filter 4</button>
                  <button type="button" class="btn btn-round btn-outline btn-primary btn-lg mr5">Filter 5</button>
                  <button type="button" class="btn btn-round btn-outline btn-primary btn-lg">Filter 6</button>
                  </div>
                  </div>
                  <!-- END FILTER ROW -->

<?php include 'includes/filter-panel-body.php' ?>

               


                <div class="tab-pane" id="exampleTabsInverseTwo" role="tabpanel" aria-expanded="false">
                  Insequitur invidi an sumitur accedere epicurum divina claudicare quiddam, praebeat
                  corporis generis errata tempora latinas possent arare soliditatem
                  desiderare, poterit. Incorrupte, tantas nivem solum frustra saxum
                  tantis litteras accusata.
                </div>
              </div>
            </div>
          </div>
          <!-- End Example Tabs Inverse -->
        </div>
        
        <div class="clearfix hidden-lg-down"></div>
        
        
        <!-- End Example Tabs Solid Left Inverse -->
      </div>


    
      
      
      
      
      
      
      
      
      
    </div>
  </div>
  <!-- End Page -->
  <!-- Footer -->
  <footer class="site-footer">
    <div class="site-footer-legal">© 2016 <a href="">Project Social</a></div>
    <div class="site-footer-right">
      Crafted with <i class="red-600 wb wb-heart"></i> by <a href="http://cogentworld.com">CogentWorld</a>
    </div>
  </footer>
  <!-- Core  -->
  <script src="../../../global/vendor/babel-external-helpers/babel-external-helpers.js"></script>
  <script src="../../../global/vendor/jquery/jquery.js"></script>
  <script src="../../../global/vendor/tether/tether.js"></script>
  <script src="../../../global/vendor/bootstrap/bootstrap.js"></script>
  <script src="../../../global/vendor/animsition/animsition.js"></script>
  <script src="../../../global/vendor/mousewheel/jquery.mousewheel.js"></script>
  <script src="../../../global/vendor/asscrollbar/jquery-asScrollbar.js"></script>
  <script src="../../../global/vendor/asscrollable/jquery-asScrollable.js"></script>
  <!-- Plugins -->
  <script src="../../../global/vendor/jquery-mmenu/jquery.mmenu.min.all.js"></script>
  <script src="../../../global/vendor/switchery/switchery.min.js"></script>
  <script src="../../../global/vendor/intro-js/intro.js"></script>
  <script src="../../../global/vendor/screenfull/screenfull.js"></script>
  <script src="../../../global/vendor/slidepanel/jquery-slidePanel.js"></script>
  <script src="../../../global/vendor/matchheight/jquery.matchHeight-min.js"></script>
  <!-- Plugins For This Page -->
  <script src="../../global/vendor/floatthead/jquery.floatThead.min.js"></script>
  <!-- Scripts -->
  <script src="../../../global/js/State.js"></script>
  <script src="../../../global/js/Component.js"></script>
  <script src="../../../global/js/Plugin.js"></script>
  <script src="../../../global/js/Base.js"></script>
  <script src="../../../global/js/Config.js"></script>
  <script src="../../assets/js/Section/Menubar.js"></script>
  <script src="../../assets/js/Section/Sidebar.js"></script>
  <script src="../../assets/js/Section/PageAside.js"></script>
  <!-- Config -->
  <script src="../../../global/js/config/colors.js"></script>
  <script src="../../assets/js/config/tour.js"></script>
  <script>
  Config.set('assets', '../../assets');
  </script>
  <!-- Page -->
  <script src="../../assets/js/Site.js"></script>
  <script src="../../../global/js/Plugin/asscrollable.js"></script>
  <script src="../../../global/js/Plugin/slidepanel.js"></script>
  <script src="../../../global/js/Plugin/switchery.js"></script>
  <script src="../../../global/js/Plugin/responsive-tabs.js"></script>
  <script src="../../../global/js/Plugin/closeable-tabs.js"></script>
  <script src="../../../global/js/Plugin/tabs.js"></script>
    <script src="../../../global/js/Plugin/floatthead.js"></script>
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