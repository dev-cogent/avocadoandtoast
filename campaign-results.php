<?php 
session_start();
error_reporting(0);
include 'includes/class/campaign.php';
include 'includes/class/favorite.php';
include 'includes/numberAbbreviation.php';
$users = $_SESSION['users'];
$campaignobj = new campaignCalculator;
$favoriteobj = new favorite;
$favoriteinfluencers = $_SESSION['favoriteinfluencers'];
$campaigns = $_SESSION['campaigns'];
if($_SESSION['campaigns'] === NULL)
  $campaigns = [];
?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>

    <?php include 'includes/head.php' ?>
    <title>Campaign Results | Project Social Beta</title>
    <link rel="stylesheet" href="global/vendor/bootstrap-select/bootstrap-select.min.css?">
      <style>
    .text-center {
    text-align:center;
    }
  </style>
<script type="text/javascript" src="/jquery-3.0.0.min.js"></script>
<script src="includes/javascript/account.js"></script>
<link rel="stylesheet" href="/sweetalert2/dist/sweetalert.css">
<script src="/global/vendor/bootstrap/bootstrap.js"></script>
<script src="/sweetalert2/dist/sweetalert.min.js"></script>
<script src="/bootbox/bootbox.js"></script>

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
    <span>2 - Number of Posts</span>
  </div>
  
    <div class="col-lg-4">
    <span style="font-weight:800;color:blue;">3 - Impressions & Engagement</span>
  </div>
  </div>
  <!-- END STEPS -->


<div class="col-lg-3" style="float: none;margin-right: auto;margin-left: auto;">
<button id="save" type="button" class="btn btn-block btn-default">Save Campaign</button>
</div>

   <!-- ADD RESULTS OF POSTS -->
<?php 
$campaignarr = array();
foreach($users as $user){
$arr['userid'] = $user;
$arr['instagrampost'] = $_POST['instagram'];
$arr['twitterpost'] = $_POST['twitter'];
$arr['facebookpost'] = $_POST['facebook'];
$info = $campaignobj->calculate($arr);
$instagramtotal += $info['instagramimpressions'];
$twittertotal += $info['twitterimpressions'];
$facebooktotal += $info['facebookimpressions'];
$total += $info['totalimpressions'];
//We put everything now in an array. 
$campaignarr[$user]['userid'] = $user;
$campaignarr[$user]['instagrampost'] = $_POST['instagram'];
$campaignarr[$user]['instagramimpressions'] = $info['instagramimpressions'];
$campaignarr[$user]['twitterpost'] = $_POST['twitter'];
$campaignarr[$user]['twitterimpressions'] = $info['twitterimpressions'];
$campaignarr[$user]['facebookpost'] = $_POST['facebook'];
$campaignarr[$user]['facebookimpressions'] = $info['facebookimpressions'];
echo
'

<div class="col-lg-12 m-t-25">
        
<!-- Influencer Photo -->
  <div class="col-lg-2 text-center">
    <div class="example">
                      <img class="img-circle" width="100" height="100" src="https://project.social/'.$info['image'].'" onerror="this.src=`https://project.social/images/ps-square.jpg`" alt="...">
                      <p>'.$info['user'].'</p>
                      <p class="campaign" data-id="'.$user.'">ADD TO CAMPAIGN </p>'; 
echo $favoriteobj->checkFavorite($user,$favoriteinfluencers);
echo '
      </div>
  </div>
  
<!-- End Influencer Photo -->  
  
  
<!-- # of IG results widget -->
<form action="#" method="POST">
<div class="col-lg-2 text-center m-r-25">
<div class="example">
<i class="icon bd-instagram" aria-hidden="true"></i>
</div>
  
<span data-toggle="tooltip" data-placement="top" data-original-title="'.number_format($info['instagramimpressions']).'" style="font-weight:800;font-size:40px;">'.numberAbbreviation($info['instagramimpressions']).'</span>
  <p>
    Estimated Total Impressions
  </p>

</div> 
<!-- end # of IG results widget -->
        
<!-- # of Twitter results widget -->
<div class="col-lg-2 text-center m-r-25" >
<div class="example">
<i class="icon bd-twitter" aria-hidden="true"></i>
</div>
  
<span data-toggle="tooltip" data-placement="top" data-original-title="'.number_format($info['twitterimpressions']).'" style="font-weight:800;font-size:40px;">'.numberAbbreviation($info['twitterimpressions']).'</span>
  <p>
    Estimated Total Impressions
  </p>
  
</div> 
<!-- end # of Twitter results widget -->  
        
 <!-- # of Facebook results widget -->
<div class="col-lg-2 text-center m-r-25" >
<div class="example">
<i class="icon bd-facebook" aria-hidden="true"></i>
</div>
  
<span data-toggle="tooltip" data-placement="top" data-original-title="'.number_format($info['facebookimpressions']).'" style="font-weight:800;font-size:40px;">'.numberAbbreviation($info['facebookimpressions']).'</span>
  <p>
    Estimated Total Impressions
  </p>
  
</div> 
<!-- end # of Facebook results widget -->       
  
 <!-- # of Total results widget -->
<div class="col-lg-2 text-center m-r-25" >
<div class="example">
<i class="icon wb-users" aria-hidden="true"></i>
</div>
  
<span data-toggle="tooltip" data-placement="top" data-original-title="'.number_format($info['totalimpressions']).'" style="font-weight:800;font-size:40px;">'.numberAbbreviation($info['totalimpressions']).'</span>
  <p>
    Estimated Total Impressions
  </p>
  
</div> 
<!-- end # of Total results widget -->    
        
        
        
      
</div>';
}
$_SESSION['savecampaign'] = $campaignarr;
    ?>
  <!-- END POSTS RESULTS -->    
  
  
  
  <!-- CAMPAIGN TOTAL AREA -->
  
    
    
      <!-- ADD NUMBER OF POSTS -->
<div class="col-lg-12 m-t-25" style="border-top:1px solid #eeeeee;">
        
<!-- Influencer Photo -->
  <div class="col-lg-2 text-center">
    
  <div class="example">
    
   <span style="font-weight:800;font-size:20px;">CAMPAIGN<br>TOTALS</span>
    
    </div>

  </div>
  
<!-- End Influencer Photo -->  
  
  
<!-- # of IG results widget -->
<form action="#" method="POST">
<div class="col-lg-2 text-center m-r-25">
<div class="example">
<i class="icon bd-instagram" aria-hidden="true"></i>
</div>
  
<?php echo '<span data-toggle="tooltip" data-placement="top" data-original-title="'.number_format($instagramtotal).'" style="font-weight:800;font-size:40px;">'.numberAbbreviation($instagramtotal).'</span>';?>
  <p>
    Estimated Total Impressions
  </p>

</div> 
<!-- end # of IG results widget -->
        
<!-- # of Twitter results widget -->
<div class="col-lg-2 text-center m-r-25" >
<div class="example">
<i class="icon bd-twitter" aria-hidden="true"></i>
</div>
  
<?php echo '<span data-toggle="tooltip" data-placement="top" data-original-title="'.number_format($twittertotal).'" style="font-weight:800;font-size:40px;">'.numberAbbreviation($twittertotal).'</span>';?>
  <p>
    Estimated Total Impressions
  </p>
  
</div> 
<!-- end # of Twitter results widget -->  
        
 <!-- # of Facebook results widget -->
<div class="col-lg-2 text-center m-r-25" >
<div class="example">
<i class="icon bd-facebook" aria-hidden="true"></i>
</div>
  
<?php echo '<span data-toggle="tooltip" data-placement="top" data-original-title="'.number_format($facebooktotal).'" style="font-weight:800;font-size:40px;">'.numberAbbreviation($facebooktotal).'</span>';?>
  <p>
    Estimated Total Impressions
  </p>
  
</div> 
<!-- end # of Facebook results widget -->       
  
 <!-- # of Total results widget -->
<div class="col-lg-2 text-center m-r-25" >
<div class="example">
<i class="icon wb-users" aria-hidden="true"></i>
</div>
  
<?php echo '<span data-toggle="tooltip" data-placement="top" data-original-title="'.number_format($total).'" style="font-weight:800;font-size:40px;">'.numberAbbreviation($total).'</span>';?>
  <p>
    Estimated Total Impressions
  </p>
  
</div> 
<!-- end # of Total results widget -->    
        
        
        
      
</div>
  
  <!-- END POSTS RESULTS --> 
    
  
  
  <!-- END CAMPAIGN TOTAL AREA -->
        
  
  <!-- REQUEST PRICING BUTTON -->
  <div class="col-lg-12 m-t-50 text-center">
   <div class="col-lg-3" style="float: none;margin-right: auto;margin-left: auto;"><button id="pricing" type="button" class="btn btn-block btn-default">REQUEST PRICING</button></div>
  </div>
  <!-- END REQUEST PRICING BUTTON -->
        
        
        
<!-- end test content are -->
      
            </div>
         </div>
       </div> 
    </div>
  </div>
  <!-- End Page -->
  <script>
  var usercampaigns = <?php echo json_encode($campaigns); ?>;
    
  </script>
  <script src="/includes/javascript/savecampaign.js"></script>
  <script src="/includes/javascript/favorite.js"></script>
  <script src="/includes/javascript/addcampaign.js"></script>
  <?php include 'includes/footer.php' ?>
</body>
</html>