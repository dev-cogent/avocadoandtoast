<?php
session_start();
include '../includes/class/favorite.php';
include '../includes/numberAbbreviation.php';
$fav = new favorite;
$influencers = $fav->getFavorites($_SESSION['userid']);

$conn = $fav->dbinfo();
$campaigns = $_SESSION['campaigns'];
foreach($influencers as $influencer){
        $sql .= "'$influencer',";
}
if($influencers != NULL){
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
            <p class="campaign" data-id="'.$id.'">ADD TO CAMPAIGN </p> <i data-id="'.$id.'" style="font-size:20px" class="unfavorite icon fa-heart" aria-hidden="true"></i>

            </div>';
    }
}

?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <?php include '../includes/head.php' ?>
   <?php echo ' <title> Favorites | Project Social Beta</title> '; ?>
  <link rel="stylesheet" href="global/vendor/bootstrap-select/bootstrap-select.min.css?">
  <style>
  .text-center {
    text-align:center;
    }
  </style>
<script type="text/javascript" src="/jquery-3.0.0.min.js"></script>
<link rel="stylesheet" href="/sweetalert2/dist/sweetalert.css">
<script src="/sweetalert2/dist/sweetalert.min.js"></script>
</head>
<body>
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
  <?php include '../includes/nav.php' ?>



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
  Favorite Inluencers
  </h1>
</div>

  <!-- STEPS -->

  <!-- 4 across view -->
  <div class="col-lg-12">
    <?php echo $html;?>


  </div>

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
    <script src="/includes/javascript/addcampaign.js"></script>
    <script src="/includes/javascript/favorite.js"></script>

</body>
</html>
