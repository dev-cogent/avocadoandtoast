<?php 
include '../includes/getUserInfo.php';
include '../includes/class/usersettings.php';
$usersettingsobj = new userSettings;
if($_GET['code']){
$check = $usersettingsobj->addInstagram($_GET['code'],$_SESSION['userid']);
}
$basicinfo = $usersettingsobj->getBasicInstagramInfoDB($_SESSION['instagram_id']);
$instagramaccounts = $_SESSION['instagram_accounts'];
?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <?php include '../includes/head.php' ?>
  <script src="https://project.social/jquery-3.0.0.min.js"></script>
    <title>Empty Page | Project Social Beta</title>
  <link rel="stylesheet" href="../global/vendor/bootstrap-select/bootstrap-select.min.css?">
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
        <li><a href="../account">My Account</a></li>
        <li class="active">Edit Information</li>
      </ol>
      <h1 class="page-title">Manage Instagram Accounts</h1>
      <div class="page-header-actions">
        <a class="btn btn-sm btn-inverse btn-round" href="#">
          <i class="icon wb-link" aria-hidden="true"></i>
          <span class="hidden-xs">Custom Link</span>
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
<div class="col-md-4">


<?php 
foreach($instagramaccounts as $account){
$basicinst = $usersettingsobj->getBasicInstagramInfoDB($account);
echo '   
        <div class="col-md-12" style="padding-top:10px; padding-bottom:10px;">
        <div class="col-xl-3">
         <img class="img-circle" width="100" height="100" src="'.$basicinst['profile_picture'].'" alt="...">
         </div>
         <div class="col-xl-9">
            <div class="col-xl-6">
            <p>'.$basicinst['full_name'].'</p>
            <p>'.$basicinst['username'].'</p> 
            </div>
            <div class="col-xl-6">
            <button id="'.$basicinst['instagram_id'].'" type="button" class="removeIG btn btn-floating btn-danger pull-right"><i class="icon wb-minus" aria-hidden="true"></i></button>
            </div>
         </div>
         </div>';

}


?>

        <div class="col-md-12" style="padding-top:10px; padding-bottom:10px;">
        <div class="col-xl-3">
         <img class="img-circle" width="100" height="100" src="https://project.social/images/default.png" alt="...">
         </div>
         <div class="col-xl-9">
            <div class="col-xl-6">
            <p>Add a new account</p>
            </div>
            <div class="col-xl-6">
            <a href="https://api.instagram.com/oauth/authorize/?client_id=72ecc575c986492282e238e6429798e7&redirect_uri=https://project.social/user/ighandles.php&response_type=code&scope=basic+public_content+follower_list+comments+relationships+likes"><button type="button" class="btn btn-floating btn-primary pull-right"><i class="icon wb-plus" aria-hidden="true"></i></button></a>
            </div>
         </div>
         </div>









<!-- option div Duplicate from here to end comment for each option dropdown  -->
<!--
<div class="col-md-12"> 
<h4 class="example-title">Account Type</h4>
<div class="example">
                  <div class="btn-group bootstrap-select">
                  <button type="button" class="btn dropdown-toggle btn-select" data-toggle="dropdown" title="Mustard" aria-expanded="false">
                  <span class="filter-option pull-left">Mustard</span>&nbsp;<span class="bs-caret"><span class="caret"></span></span></button><div class="dropdown-menu open" style="max-height: 181px; overflow: hidden; min-height: 0px;"><ul class="dropdown-menu inner" role="menu" style="max-height: 169px; overflow-y: auto; min-height: 0px;"><li data-original-index="0" class="selected"><a tabindex="0" class="" style="" data-tokens="null"><span class="text">Mustard</span><span class="icon wb-check check-mark"></span></a></li><li data-original-index="1"><a tabindex="0" class="" style="" data-tokens="null"><span class="text">Ketchup</span><span class="icon wb-check check-mark"></span></a></li><li data-original-index="2"><a tabindex="0" class="" style="" data-tokens="null"><span class="text">Relish</span><span class="icon wb-check check-mark"></span></a></li></ul></div><select data-plugin="selectpicker" class="" tabindex="-98">
                    <option></option>
                    <option>Self-Employed</option>
                    <option>Small Buisness</option>
                    <option>Agency</option>
                    <option>Brand</option>
                    <option>Enterprise</option>
                    </select></div>
</div>
</div>
<!-- end option div -->  
  
  <div style="display:none"><iframe src="https://instagram.com/accounts/logout/" width="0" height="0"></iframe></div>
          
</div>
      
<!-- end test content are -->
      
            </div>
         </div>
       </div> 
    </div>
  </div>
  <script src="../includes/javascript/removeIG.js"></script>
  <!-- End Page -->
  <?php include '../includes/footer.php' ?>
</body>
</html>