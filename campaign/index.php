<?php 
session_start();
include '../includes/class/campaign.php';
include '../includes/class/favorite.php';
include '../includes/numberAbbreviation.php';
$campaignobj = new campaignCalculator;
$fav = new favorite;
/*
$url = $_SERVER['REQUEST_URI'];
$campaigntitle = explode('/campaign/',$url);
$campaigntitle = trim($campaigntitle[1]);
$campaigntitle = urldecode($campaigntitle);*/
$campaigntitle = $_GET['c'];
$columnid = $_SESSION['column_id'];
$influencers = $campaignobj->getCampaign($columnid,$campaigntitle);
$conn = $campaignobj->dbinfo();
$favoriteinfluencers = $fav->getFavorites($_SESSION['userid']);

foreach($influencers as $influencer){
        $sql .= "'$influencer',";
}  

$sql = substr($sql, 0, -1);
    $stmt = $conn->prepare("SELECT `id`,`image_url`,`user`,`total` FROM `Influencer_Information` WHERE `id` IN ($sql)");
    $stmt->execute();
    $stmt->bind_result($id,$image_url,$username,$total);
    while($stmt->fetch()){
    $html .= '<div class="col-lg-3 text-center">
    <div class="example">
                      <img class="user img-circle" width="100" height="100" src="https://project.social/'.$image_url.'" onerror="this.src=`https://project.social/images/ps-square.jpg`" data-id="'.$id.'" data-img="'.$image_url.'" alt="...">
                    </div>
    <p style="font-weight: 800;">'.$username.'</p>
    <p>'.numberAbbreviation($total).' Total Reach</p>
    <p class="campaign" data-id="'.$id.'">ADD TO CAMPAIGN </p>'; 
    if(in_array($id,$favoriteinfluencers)) $html.='<i data-id="'.$id.'" class="unfavorite icon fa-heart" style="font-size:20px" aria-hidden="true"></i></div>';
    else $html.='<i data-id="'.$id.'" class="favorite icon fa-heart-o" style="font-size:20px" aria-hidden="true"></i></div>';
}
  unset($stmt);




?>

<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <?php include '../includes/head.php' ?>
   <?php echo ' <title>'.$campaigntitle.' | Project Social Beta</title> '; ?>
  <link rel="stylesheet" href="global/vendor/bootstrap-select/bootstrap-select.min.css?">
  <style>
  .text-center {
    text-align:center;
    }
  </style>
<script type="text/javascript" src="/jquery-3.0.0.min.js"></script>
<script src="includes/javascript/account.js"></script>
<link rel="stylesheet" href="/sweetalert2/dist/sweetalert.css">
<script src="/sweetalert2/dist/sweetalert.min.js"></script>
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
    <?php 
    echo $campaigntitle ; ?>
  </h1>
</div>
  
  <!-- STEPS -->
  
  <!-- 4 across view -->
  <div class="col-lg-12">
    <?php echo $html;?>
    <!-- influencer widget -->
<!--
  <div class="col-lg-3 text-center">
    <div class="example">
                      <img class="img-circle" width="100" height="100" src="http://project.social/assets/images/ps-square.jpg" alt="...">
                    </div>
    <p style="font-weight: 800;">Influencer Name</p>
    <p>36k Total Reach</p>
    <p>ADD TO LIST</p>
    
  </div> -->
    <!-- end influencer widget -->
    
  </div>
  <!-- END 4 across view -->
  
  <!-- NEXT BUTTON -->
  <div class="col-lg-3 m-t-25">
   <button id="next" type="button" class="btn btn-block btn-default">Calculate</button>
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
    <script src="../../../global/vendor/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
    <script src="/typahead.js"></script>
    <script src="/includes/javascript/favorite.js"></script>
    <script>
    var users = <?php echo json_encode($influencers);?>;
    </script>

</body>
</html>

