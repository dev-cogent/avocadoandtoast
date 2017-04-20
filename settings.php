<?php
  include 'php/settings-information.php';
?>

<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <?php include 'html/head.html' ?>
    <title> Settings | Avocado & Toast</title>
<script src="/bootbox/bootbox.js"></script>
<script src="/global/vendor/bootstrap/bootstrap.js"></script>
<script src="/assets/js/settings.js"></script>
<link rel="stylesheet" href="/global/fonts/brand-icons/brand-icons.css">
<link rel="stylesheet" href="/global/fonts/font-awesome/font-awesome.css">
<link rel="stylesheet" href="/assets/css/discover.css">
<link rel="stylesheet" href="/assets/css/settings.css">
<style>
button:focus{
    box-shadow: 0 0 10px #73C48D;
    outline:none;
}
a:focus{
  text-decoration:none;
  color:inherit;
}

</style>
</head>

<body class="col-xs-12" style="padding-left:0px;padding-right:0px;">

<?php include 'php/avocado-nav.php';?>

<div class="col-xs-3"></div>
<div class="col-xs-6 settings-lg-col" id="setting-container">

  <div class="input-container">

      <form action="" method="POST" enctype= "multipart/form-data">

        <div class="upload-img">
          <div class="uploaded-img-square"><img id="uploaded-img" src="http://avocadoandtoast.com/images/user/<?php echo $userid ;?>.jpg" onerror="this.src=`/assets/images/default-photo.png`"> </div>
          <div class="profile-title"> Your Avatar </div>
          <input type="file" class="upload-img-btn avocado-hover avocado-focus" name="image"></input> 
          <div class="image-title"> Upload Image </div>
        
        </div>

      <label class="title"> Company Name </label>
      <br/>
      <input type="text" id="company" name="company" class="form-control category avocado-focus" value="<?php echo $company;?>" maxlength="100">
      </input>
      <label class="title"> First Name  </label>
      <br/>
      <input name="firstname" type="text" class="form-control category avocado-focus" value="<?php echo $firstname;?>"   maxlength="100">
      </input>

    <label class="title"> Last Name  </label>
    <br/>
    <input  name="lastname" type="text" class="form-control category avocado-focus" value="<?php echo $lastname;?>" maxlength="100">
    </input>

      <label class="title"> Email </label>
      <br/>
      <input name="email" type="email" class="form-control category avocado-focus" value="<?php echo $email;?>" maxlength="100">
    </input>

      <button class="update-profile-btn col-xs-12"  style="margin-top:30px;" id="submit" type="submit" name="profile"> Update Profile </button>
       <button class="update-password-btn col-xs-12"  style="margin-top:30px;" id="getPassword" type="submit" name="profile"> Change Password </button>
      </form>
    </div>
    <div class="col-xs-3"></div>
  </div>
  </div>


 