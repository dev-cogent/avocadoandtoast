<?php 
session_start();
error_reporting(0);
?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <?php include 'includes/head.php' ?>
    <title>Campaign Posts | Project Social Beta</title>
  <link rel="stylesheet" href="global/vendor/bootstrap-select/bootstrap-select.min.css?">
    <style>
  .text-center {
    text-align:center;
    }
      .middle {
    float: none;
    margin-left: auto;
    margin-right: auto;
    display: inline-block;
      }
  </style>
</head>
<body>
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
  <?php include 'includes/nav.php' ?>

  <?php include 'includes/sidebar.php' ?>
  
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
        
  
<div class="col-lg-12 text-center">
  <h1>
    Campaign Calculator
  </h1>
</div>
  
  <!-- STEPS -->
<div class="col-lg-12 text-center m-t-25 p-b-25" style="border-bottom:1px solid #eeeeee;">
  <div class="col-lg-4">
    <span>1 - Search Influencers</span>
  </div>

  
    <div class="col-lg-4">
    <span style="font-weight:800;color:blue;">2 - Number of Posts</span>
  </div>
  
    <div class="col-lg-4">
    <span>3 - Impressions & Engagement</span>
  </div>
  </div>
  <!-- END STEPS -->
        
  
  <!-- ADD NUMBER OF POSTS -->
<div class="col-lg-12 m-t-25 text-center">
        
<!-- # of IG posts widget -->
<form action="campaign-results.php" method="POST">
  
<div class="col-lg-3 text-center middle">
<div class="example">
<i class="icon bd-instagram" aria-hidden="true"></i>
</div>
  
<div class="form-group form-material">
<input name="instagram" type="text" class="form-control input-lg empty" id="inputLarge" name="inputLarge" placeholder="Number of Posts">
</div>

</div> 
<!-- end # of IG posts widget -->
        
<!-- # of Twitter posts widget -->
<div class="col-lg-3 text-center middle" >
<div class="example">
<i class="icon bd-twitter" aria-hidden="true"></i>
</div>
  
<div class="form-group form-material">
<input name="twitter" type="text" class="form-control input-lg empty" id="inputLarge" name="inputLarge" placeholder="Number of Posts">
</div>
  
</div> 
<!-- end # of Twitter posts widget -->  
        
 <!-- # of Facebook posts widget -->
<div class="col-lg-3 text-center middle" >
<div class="example">
<i class="icon bd-facebook" aria-hidden="true"></i>
</div>
  
<div class="form-group form-material">
<input name="facebook" type="text" class="form-control input-lg empty" id="inputLarge" name="inputLarge" placeholder="Number of Posts">
</div>
  
</div> 
<!-- end # of Facebook posts widget -->       
        
        
        
      
  </div>
  
  <!-- END NUMBER OF POSTS -->


<!-- PAGE NAVIGATION -->
<div class="col-lg-12 m-t-25">
  
  <!-- Previous BUTTON -->
  <div class="col-lg-3 pull-left m-t-25">
    <a href="/campaign-calculator"><button type="button" class="btn btn-block btn-default">Previous</button></a>
  </div>
  <!-- END Previous BUTTON -->          
        
 <!-- NEXT BUTTON -->
  <div class="col-lg-3 pull-right m-t-25">
    <button type="submit" class="btn btn-block btn-default">Next</button>
  </div>
  <!-- END NEXT BUTTON -->       
        </div>
     </form>   
<!-- END PAGE NAVIGATION --> 
         
        
        
<!-- end test content are -->
      
            </div>
         </div>
       </div> 
    </div>
  </div>
  <!-- End Page -->
  <?php include 'includes/footer.php' ?>
</body>
</html>