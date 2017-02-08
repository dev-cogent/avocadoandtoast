<?php
session_start();
include 'includes/class/savecampaign.php';
$obj = new saveCampaign;
$campaignconn = $obj->savedDB();
$conn = $obj->dbinfo(); 
$influencerlist = array();
$columnid = $_SESSION['column_id'];
$campaignid = $_GET['q'];
$stmt = $conn->prepare('SELECT `campaign_id` FROM `campaign_save_link` WHERE `column_id` = ? AND `campaign_id` = ?');
$stmt->bind_param('ss',$columnid,$campaignid);
$stmt->execute();
$stmt->bind_result($check);
$stmt->fetch();
if($check === NULL) header('Location:/campaigncalculator.php');
$stmt = $campaignconn->prepare("SELECT `influencer_id` FROM `$campaignid`");
$stmt->execute();
$stmt->bind_result($id);
while($stmt->fetch()){
    array_push($influencerlist,$id);
}
$stmt = $conn->prepare('SELECT `campaign_name` FROM `campaign_save_link` WHERE `campaign_id` = ?');
$stmt->bind_param('s',$campaignid);
$stmt->execute();
$stmt->bind_result($campaignname);
$stmt->fetch();


?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <?php include 'includes/head.php' ?>
    <title>Blank Page | Project Social</title>
<script src="/bootbox/bootbox.js"></script>
<script src="/includes/javascript/savecampaign.js"></script>
<script src="/includes/javascript/addtolist.js"></script>
<script src="/global/vendor/bootstrap/bootstrap.js"></script>
<style>
 .campaignfocus:focus{
    outline: none;
    background-color:transparent;
    color: rgba(0, 0, 44, 0.37);
}
.campaignfocus{
background-color:transparent;
border:none; 
text-align:center; 
font-size:3em; 
width:200px;
color: rgba(0, 0, 44, 0.37);
    }
</style>
</head>
<body class="campaigncalc-view">
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
   <?php include 'includes/nav.php' ?>



  <!-- Page -->

          <div class="campaign-header row" >
              <div class="col-xs-12 campaign-calc">
                <div class="list-title-overlay"><h1 class="list-overlay"> Launch Campaign </h1>
                  <div class="campaign-button-pad2" style="">
                      <a href="#" class="btn btn-primary main-btn export-btn"  role="button"> Export Insights to PDF </a>
                      <a href="#" id="resave" class="btn btn-primary main-btn"  role="button"> Save Campaign </a>
                      <a href="#" class="btn btn-primary main-btn price-btn" role="button">  Price Campaign </a>

                    </div>
                  <ol class="breadcrumb breadcrumb-arrow">
                    <li class="active bread"><div class="breadcrumb-1 active"> 01 </div><a class="first-breadcrumb" href="javascript:void(0)"> Search Influencers </a> <i class="icon ml-arrow_right" aria-hidden="true" style="font-size: 24px;"></i>  </li>
                    <li class="bread"><div class="breadcrumb-2"> 02 </div><a href="javascript:void(0)" class="second-breadcrumb">Number of Posts </a></li>
                  </ol>
                <div class="list-title-div"><h2 class="list-title">
                  </h2>
              </div>
            </div>
        </div>

              </div>


  <div class="container">
  <div class="page-content container" id="content">


    <div class="row">
        <div class="col-xs-12">
            <div class="table-responsive table-chosen-influencers">
              <table summary="This table shows a list of influencers added to a campaign" class="table table-bordered table-hover">
                <thead class="campaign-calc-table">
                  <tr class="cat-in-campaign-list-table">
                    <th class="text-center"> </th>
                      <th class="text-center"> <img src="assets/images/ig_black.png" class="insta-logo" />
                    <h6 class="posts-num"> Instagram Post Link </h6>  </th>
                      <th class="text-center"> <img src="assets/images/fb_black.png" class="fb-logo" /> <h6 class="posts-num">  Facebook Post Link </h6> </th>
                      <th class="text-center"> <img src="assets/images/twitter_black.png" class="twitter-logo2" /> <h6 class="posts-num"> Twitter Post Link </h6> </th>
                    </tr>
                  </thead>
                  <tbody id="table">
                  <?php 
                  unset($stmt);
                  $comma_separated = implode("','", $influencerlist);
                  $stmt = $conn->prepare("SELECT `id`,`user`,`image_url` FROM `Influencer_Information` WHERE `id` IN ('$comma_separated') ORDER BY `total` DESC");
                  $stmt->execute();
                  $stmt->bind_result($id,$user,$image);
                    while($stmt->fetch()){
                      echo ' <tr class="campaign-list-table">
                        <td class="campaign-tablerow" style="width:15%;"><div class="influencer-det"> <img src="http://project.social/'.$image.'" class="influencerphoto img-circle">
                            <h4 class="influencer-onlist">'.$user.'</h4>
                      </div></td>

                      <td data-id="'.$id.'" class="insta-column" style="width:15%;"><input data-id="'.$id.'" data-platform="instagram" class="instagraminput campaignfocus" type="number" value="0" max="100"> </td>
                      <td data-id="'.$id.'" class="twit-column" style="width:15%;"> <input data-id="'.$id.'" data-platform="facebook" class="facebookinput campaignfocus" type="number" value="0" max="100"> </td>
                      <td data-id="'.$id.'" class="face-column" style="width:15%;"> <input data-id="'.$id.'" data-platform="twitter" class="twitterinput campaignfocus" type="number" value="0" max="100"> </td>
                    </tr>';       
                    }

                  ?>



                     <tr class="influencer-list-table">
                      <td class="campaign-tablerow" style="width:20%;"><div class="influencer-det">
                          <h4 class="influencer-onlist"> Campaign Total</h4>
                    </div></td>
                    <td class="insta-column" style="width:10%;"><h4 class="instagram-posts"> 0 </h4> </td>
                    <td class="twit-column" style="width:10%;"> <h4 class="facebook-posts"> 0 </h4> </td>
                    <td class="face-column" style="width:10%;"> <h4 class="twitter-posts"> 0</h4> </td>
                  </tr>

                  </tbody>


      <!-- container ends -->
    </div>
  </div>
</div>
</div>
</div>
                      <!-- container fluid ends  -->


  <!-- End Page -->
  <script>
  var description = `<?php echo $comment;?>`
  var campaignname = `<?php echo $campaignname;?>`;
  var campaign = getParameterByName('q');
  var selectedusers = <?php echo json_encode($influencerlist);?>;
  function getParameterByName(name, url) {
  if (!url) {
    url = window.location.href;
  }
  name = name.replace(/[\[\]]/g, "\\$&");
  var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
      results = regex.exec(url);
  if (!results) return null;
  if (!results[2]) return '';
  return decodeURIComponent(results[2].replace(/\+/g, " "));
  }
  </script>
  
  <script src="/includes/javascript/list.js"></script>
  <script src="/includes/javascript/favorite.js"></script>
  <script src="/includes/javascript/campaigncalculator.js"></script>
  <script src="/includes/javascript/recalculate.js"></script>

</body>
</html>
