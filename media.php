<?php 
include 'includes/getUserInfo.php';
include 'includes/class/useroptions.php';
$useroptionsobj = new userOptions;
$tag = $_GET['tag'];
$images = $useroptionsobj->hashtagMedia($tag);
//echo phpinfo(); 
?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <?php include 'includes/head.php' ?>

    <title>My Profile | Project Social</title>

    <script src="/jquery-3.0.0.min.js"></script>

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

      </div>

      
      <div class="col-xlg-12 col-md-12">
          <!-- Example Heading With Desc -->
          <div class="panel">
            <div class="panel-heading">
              <h3 class="panel-title">Media Featuring </h3>
            </div>
            <div class="panel-body">
             <?php 
             foreach($images as $id=>$image){
              $lightboximage = explode('https://',$image['image']);
              $lightboximage = $lightboximage[1];
             echo '
             <div class="col-xl-3"> <a href="/lightbox/media-ajax.php?id='.$lightboximage.'&media='.$id.'" class="examplePopupAjax"><img class="images img-responsive" src="'.$image['image'].'"/></a></div>';
             }
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