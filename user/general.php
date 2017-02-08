<?php 
include '../includes/getUserInfo.php';
include '../includes/class/usersettings.php';
$usersettingsobj = new userSettings;
if(isset($_POST['submit'])){
unset($_POST['submit']);

  $check = true;

  $emailCheck = $usersettingsobj->checkEmail($_POST['email']);
  if(!$emailCheck){
  $check = false;
  $error = 'Please enter a valid email address.';
  }

  foreach($_POST as $item){
  if($item == "" || $item == NULL)
  $check = false;
  $error = 'Please make sure all fields are filled out.';
  }

  $verifypassword = $usersettingsobj->verifyPassword($_POST['password']);
  if(!$verifypassword){
  $check = false;
  $error = 'Password does not match';
  }

  if($check){
  $update = $usersettingsobj->updateGeneralInfo($_POST);
  var_dump($update);
  }


}

$basicinfo = $usersettingsobj->getBasicInstagramInfoDB($_SESSION['instagram_id']);
$userSettings = $usersettingsobj->getUserInformation($_SESSION['userid']);

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
      <h1 class="page-title">General Information</h1>
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

<form action="" method="POST">  
<!-- Full Name  -->
<div class="col-md-12">
                    <label class="control-label" for="inputGrid1">Full Name</label>
                    <?php echo '<input name="name" type="text" class="form-control" id="inputGrid1" name="inputGrid1" value="'.$userSettings['name'].'">';?>
</div>
<!-- end full name -->


<!-- Email -->
<div class="col-md-12">
                    <label class="control-label" for="inputGrid1">E-mail</label>
                    <?php echo '<input name="email" type="email" class="form-control" id="inputGrid1" name="inputGrid1" value="'.$userSettings['email'].'">';?>
</div>
<!-- end email -->


<!-- Company -->
<div class="col-md-12">
                    <label class="control-label" for="inputGrid1">Company</label>
                    <?php echo '<input name="company" type="text" class="form-control" id="inputGrid1" name="inputGrid1" value="'.$userSettings['company'].'">';?>
</div>
<!-- end company -->
  
<!-- option div Duplicate from here to end comment for each option dropdown  -->



<!-- end option div --> 
<div class="col-md-12">
<label class="control-label" for="inputGrid1">Account Type</label>
<div class="form-group">
                    <select name="accounttype"class="form-control" id="company" name="accounttype" required="" data-fv-field="company">
                      <?php echo'<option value="'.$userSettings['account_type'].'">'.$userSettings['account_type'].'</option>';?>
                      <option value="self-employed">Self-Employed</option>
                      <option value="small-business">Small Business</option>
                      <option value="agency">Agency</option>
                      <option value="brand">Brand</option>
                      <option value="enterprise">Enterprise</option>
                    </select>
                  <small class="help-block" data-fv-validator="notEmpty" data-fv-for="company" data-fv-result="NOT_VALIDATED" style="display: none;">Please company</small></div>
</div>


<!-- start password -->
<div class="col-md-12">
                    <label class="control-label" for="inputGrid1">Password</label>
                    <input name="password" type="password" class="form-control" id="inputGrid1" name="inputGrid1" >
</div>
<!-- end password -->

<div class="col-md-12">
<button name="submit"type="submit" class="btn btn-outline btn-default">Submit</button>
</div>

</form>
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
  
  
          
</div>
      
<!-- end test content are -->
      
            </div>
         </div>
       </div> 
    </div>
  </div>
  <!-- End Page -->
  <?php include '../includes/footer.php' ?>
</body>
</html>