<?php 
session_start();
include '../includes/dbinfo.php';
include '../includes/numberAbbreviation.php';
if(isset($_SESSION['project_id']))
  $loggedin = 'true';
else
  $loggedin = 'false';

$campaigns = $_SESSION['campaigns'];

?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <?php include '../includes/head.php' ?>
    <title>Campaign Calculator | Project Social Beta</title>

  <link rel="stylesheet" href="global/vendor/bootstrap-select/bootstrap-select.min.css?">

  <link rel="stylesheet" href="/global/vendor/bootstrap-select/bootstrap-select.min.css?">

  <style>
  .text-center {
    text-align:center;
    }
  </style>
<script type="text/javascript" src="/jquery-3.0.0.min.js"></script>
<link rel="stylesheet" href="/sweetalert2/dist/sweetalert.css">
<script src="/sweetalert2/dist/sweetalert.min.js"></script>
<script src="/bootbox/bootbox.js"></script>

<script src="includes/javascript/account.js"></script>

<script src="/includes/javascript/account.js"></script>

<script src="/global/vendor/bootstrap/bootstrap.js"></script>
</head>
<body>
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
  <?php include '../includes/nav.php' ?>

  <?php include '../includes/sidebar.php' ?>
  
  <!-- Page -->
  <div class="page">
    
    <div class="page-header">
      <ol class="breadcrumb">
        <li>Testing Page</li>
      </ol>
      <div class="page-header-actions">
        <a class="btn btn-sm btn-inverse btn-round" href="mailto:help@project.social">
          <i class="icon wb-link" aria-hidden="true"></i>
          <span class="hidden-xs">Contact Dev Team</span>
        </a>
      </div>
    </div>
    
    
    <div class="page-content">
      
      
      
      <!-- Panel -->
      <div class="panel">
 <!-- <div class="page-content container-fluid"> -->
      <div class="panel-body container-fluid">
      <div class="row row-lg">
        
     
<!-- test content area -->
        
        
<div class="col-lg-12">
<div class="col-lg-12 text-center">
  <h1>
    Campaign Calculator
  </h1>
</div>
  
  <!-- STEPS -->
<div class="col-lg-12 text-center m-t-25">
  <div class="col-lg-4">
    <span style="font-weight:800;color:blue;">1 - Search Influencers</span>
  </div>

  
    <div class="col-lg-4">
    <span>2 - Number of Posts</span>
  </div>
  
    <div class="col-lg-4">
    <span>3 - Impressions & Engagement</span>
  </div>
  </div>
  <!-- END STEPS -->

  
  <!-- SEARCH INFLUENCERS -->
  <div class="col-lg-12">
    <div class="form-group">
                  <div class="input-search">
                    <button type="submit" class="input-search-btn"><i class="icon wb-search" aria-hidden="true"></i></button>
                    <input id="influencers" type="text" class="form-control" name="" placeholder="+ Influencers...">
                    <ol id="content">
                    </ol>
                  </div>
                </div>
  </div>
  <!-- END SEARCH INFLUENCERS -->

  <!-- ADDED INFLUENCERS AREA -->
   <div class="col-lg-12" style="border-top:1px solid #eeeeee;border-bottom:1px solid #eeeeee;">
     
     <div class="col-lg-1 example">
       <span style="font-weight: 800;font-size: 40px;" id="number">0</span>
     </div>
      <div class="col-lg-1">
       <p class="example">
         Influencers Added
       </p>
     </div>
     
     <div class="col-lg-7" id="search">
       
     </div>
     
      
  </div>
  <!-- END ADDED INFLUENCERS AREA -->
  


  

    <div id="testing" class="col-lg-12">


    
  </div>


  <!-- END 4 across view -->
  
  <!-- NEXT BUTTON -->
 <div class="col-lg-3" >
   <button id="createcampaign" type="button" class="btn btn-block btn-default">Create Campaign</button>
  </div>
  <!-- END NEXT BUTTON -->
 
  
          
</div>
      
<!-- end test content are -->
      
            </div>
         </div>
       </div> 
    </div>
  </div>
  <!-- End Page -->
  <?php include '../includes/footer.php' ?>
    <script>
    var usercampaigns = <?php echo json_encode($campaigns); ?>;
    </script>
    <script src="/includes/javascript/searchinfluencers.js"></script>
    <script src="/includes/javascript/addcampaign.js"></script>
     <script src="/includes/javascript/favorite.js"></script>

    <script src="../../../global/vendor/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>

    <script src="/global/vendor/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>

    <script src="/typahead.js"></script>

</body>
</html>