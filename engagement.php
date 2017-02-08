<?php 
include 'includes/getUserInfo.php';
include 'includes/class/engagement.php';
$engagementobj = new engagementCalculator;



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
              <p>Media Count: <?php echo $basicinfo['media_count']; ?></p>
              <p>Followers: <?php echo $basicinfo['followed_by'];?></p>
              <p>Following: <?php echo $basicinfo['follows'];?></p>
              <p><?php echo $basicinfo['full_name'].' - '.$basicinfo['bio']. ' Website: <a href="'.$basicinfo['website'].'" target="_blank">'.$basicinfo['website'].'</a>'; ?></p>
            </div>
          </div>
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
            <?php 
            $info = $engagementobj->calculateEngagement($_SESSION['instagram_id'],$_SESSION['access_token']);
            $percentage = $info['besthashtag']['avgengagement']/$info['avgengagement'];
            $realpercentage = $percentage/10;
            $guessEngagement = $realpercentage * $info['avgengagement'];
            $besttag = $info['besthashtag']['toptag'];
            echo 'Total Engagement: ' .$info['engagement'].' Average Engagement: '.$info['avgengagement'].' Best hashtag:#<a href="/media.php/?tag='.$besttag.'" target="_blank">'.$besttag.'</a> 
            Using your best hashtag in a photo can possibly increase your engagement by ' .number_format($percentage, 2, '.', ' ').'% or about '. number_format($guessEngagement, 2, '.', ' ') ;


            ?>
            </div>
          </div>
          <!-- End Example Heading With Desc -->
        </div>
      
      
      
    </div>
  </div>
  <!-- End Page -->

  <?php include 'includes/footer.php' ?>
</body>
</html>