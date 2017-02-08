<?php 
error_reporting(0);
session_start();

if(!isset($_SESSION['project_id'])){
  $login = false;
}
else{
  include 'includes/class/savecampaign.php';
  include 'includes/numberAbbreviation.php';
  $obj = new saveCampaign;
  $saveconn = $obj->savedDB();
  $conn = $obj->dbinfo();
  $campaign = $obj->getSavedCampaigns($_SESSION['column_id']);
}
?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <?php include 'includes/head.php' ?>
    <title>Blank Page | Project Social</title>
<script src="/bootbox/bootbox.js"></script>
<script src="/global/vendor/bootstrap/bootstrap.js"></script>
</head>
<body class=" ">
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
   <?php include 'includes/nav.php' ?>



  <!-- Page -->
        <div class="row">
            <div class="col-xs-6">
          <div class="list-header">
                <div class="list-title-overlay"><h1 class="list-overlay header"> Saved Campaigns </h1> <div class="list-title-div"><h2 class="list-title"> </h2></div></div>
              </div>
            </div>

            <div class="col-xs-6">
          <div class="my-list-buttons-pad ">
             <h7 class="sort-by"> SORT BY </h7>
            <div class="btn-group my-list">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            A TO Z <span class="caret"></span>
          </button>
          <ul class="dropdown-menu list">
            <li><a href="#" class="z-a"> Z TO A </a></li>
          </ul>
        </div>

                          <a href="/createlist.php" class="btn btn-primary main-btn" role="button"> Create List  </a>
            </div>

              </div>
            </div>

  <div class="container-fluid">
  <div class="page-content container" id="content">


        <?php
        if(isset($campaign)){
         foreach($campaign as $campaignid => $campaignname){
         $stmt = $saveconn->prepare("SELECT table_comment FROM INFORMATION_SCHEMA.TABLES WHERE table_schema='l5o0c8t4_save_campaign' AND table_name='$campaignid'");
         $stmt->execute();
         $stmt->bind_result($comment);
         $stmt->fetch();
         $comment = json_decode($comment,true);
         unset($stmt);
         $stmt = $saveconn->prepare("SELECT `influencer_id` FROM `$campaignid` LIMIT 0,6");
         $stmt->execute();
         $stmt->bind_result($influencerid);
         $arrinfluencers = array();
         while($stmt->fetch()){
           array_push($arrinfluencers,$influencerid);
         }
         unset($stmt);
         $stmt = $saveconn->prepare("SELECT COUNT(*) FROM `$campaignid`");
         $stmt->execute();
         $stmt->bind_result($numberofinfluencers);
         $stmt->fetch();
         unset($stmt);
         $comma_separated = implode("','", $arrinfluencers);

        echo '
        <div class="col-xs-6 col-sm-3 mylist">
          <div class="list add seperator-wrapper" data-id="" data-image="" data-check="false">
                  <div class="seperator gradient"> </div>
              <div class="name-info">
                  <div class="list-follow-div">
                <h5 class="list-name"><a  style="color:black;"href="/list.php?q='.$campaignid.'">'.$campaignname['campaignname'].'</a></h5>
                <h6 class="total-list-followers">'.$comment['description'].'</h6>
                  </div>

                  <div class="info">


                    <div class="mylist-info list">  <h7 class="days-heading"> Past 7 Days </h7>
                      <div class="gained-followers-percentage list"> <strong>'.numberAbbreviation($comment['totalimpressions']).'</strong> Total Impressions</div>
                      <div class="lost-followers-percentage list"> <strong> 1m </strong> Total Engagement </div>
                      <div class="total-list-posts list"> <strong> 4k </strong> Total Posts </div>
                      <div class="price-list-btn-div list">';
                      
                      $stmt = $conn->prepare("SELECT `image_url` FROM `Influencer_Information` WHERE `id` IN('$comma_separated')");
                      $stmt->execute();
                      $stmt->bind_result($image);
                      while($stmt->fetch()){
                        echo '<img src="http://project.social/'.$image.'" class="img-circle" style="height:30px;width:30px; display:inline;"/>';
                      }
                      unset($stmt);
                      echo '<p>'.$numberofinfluencers.'</p>';
                      echo'

                            <a href="#" class="btn btn-primary list-btn addtolist" role="button"> Price List </a>
                            </div>


                  </div>

                          <div class="seperator gradient"> </div>

                  </div>
              </div>
          </div>
        </div>';
         
        }
        }
        unset($conn);
        unset($campaignconn);
        unset($stmt);
        ?>

      <!-- container ends -->
    </div>
  </div>
                      <!-- container fluid ends  -->


  <!-- End Page -->
  <script>
  var page = 1;
  var search = '';
  var selectedusers = [];
  </script>

  <?php include 'includes/footer.php' ?>
</body>
</html>
