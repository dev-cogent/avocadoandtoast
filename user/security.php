<?php 
include '../includes/getUserInfo.php';
include '../includes/class/usersettings.php';
$usersettingsobj = new userSettings;
$basicinfo = $usersettingsobj->getBasicInstagramInfoDB($_SESSION['instagram_id']);
if(isset($_POST['submit'])){
unset($_POST['submit']);
$submit = true;
  foreach($_POST as $item){
    //Check if the fields are populated
    if($item == "" || $item == NULL){
      $submit = false; 
      $error = 'Make sure all input fields are filled out';
      }
    }
    // Check if passwords are the same 
    if($_POST['newpassword'] !== $_POST['confirmpassword']){
      $submit = false;
      $error = 'Passwords do not match';
    }
    //Check if old password is correct 
    $passwordcheck = $usersettingsobj->verifyPassword($_POST['oldpassword']);

    //if false error 
    if(!$passwordcheck){
      $submit = false;
      $error = 'The password you entered is incorrect';
    }

    $passwordcheck = $usersettingsobj->checkPassword($_POST['newpassword']);
    if(!$passwordcheck){
        $submit = false;
        $error = 'Password must have one character, one number, and one capital letter';
    }
    //If true we change password 
    if($submit){
      $check = $usersettingsobj->changePassword($_POST['newpassword']);
      if($check)
        var_dump($check);
    }
    else
      var_dump($error);
}

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
      <h1 class="page-title">Security</h1>
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
<!-- New Password -->
<div class="col-md-12">
                    <label class="control-label" for="inputGrid1">New Password</label>
                    <?php echo '<input name="newpassword" type="password" class="form-control" id="inputGrid1" name="inputGrid1">';?>
</div>
<!-- end new password -->


<!-- confirm password -->
<div class="col-md-12">
                    <label class="control-label" for="inputGrid1">Confirm Password</label>
                    <?php echo '<input name="confirmpassword" type="password" class="form-control" id="inputGrid1" name="inputGrid1" >';?>
</div>
<!-- end confirm password -->


<!-- Old password -->
<div class="col-md-12">
                    <label class="control-label" for="inputGrid1">Old password</label>
                    <?php echo '<input name="oldpassword" type="password" class="form-control" id="inputGrid1" name="inputGrid1">';?>
</div>
<!-- end old password -->


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