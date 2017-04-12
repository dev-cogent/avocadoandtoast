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

<?php include 'acnav.php';?>

<div class="col-xs-2 small-col">
  <div class="settings-box">
      <div class="profile-sect settings"> <i class="icon wb-user" aria-hidden="true"></i> <span class="setting-title" id="getProfile"> Profile </span> </div>
      <div class="password-sect settings"> <i class="icon fa-lock" aria-hidden="true"></i> <span class="setting-title" id="getPassword"> Password </span> </div>
      <div class="user-settings-sect settings" id="logout"> <i class="icon fa-users" aria-hidden="true"></i> <span class="setting-title"> Logout</span> </div>
  </div>
</div>



<div class="col-xs-10 settings-lg-col" id="setting-container">

  <div class="input-container" style="width:45%;">

      <form action="" method="POST" enctype= "multipart/form-data">

        <div class="upload-img">

          <div class="uploaded-img-square"><img src="http://avocadoandtoast.com/images/user/<?php echo $userid ;?>.jpg" onerror="this.src=`/assets/images/default-photo.png`" style="height:150px; width:150px;"> </div>
          <div class="profile-title"> Your Avatar </div>
          <input type="file" class="upload-img-btn avocado-hover avocado-focus" name="image" >  Upload Image
        
        </div>

      <label class="title"> Company Name </label>
      <br/>
      <input type="text" id="company" name="company" class="form-control category avocado-focus" value="<?php echo $company;?>" maxlength="100" style="">
      </input>
      <label class="title"> First Name  </label>
      <br/>
      <input name="firstname" type="text" class="form-control category avocado-focus" value="<?php echo $firstname;?>"  style="" maxlength="100">
      </input>

    <label class="title"> Last Name  </label>
    <br/>
    <input  name="lastname" type="text" class="form-control category avocado-focus" value="<?php echo $lastname;?>"  style="" maxlength="100">
    </input>

      <label class="title"> Email </label>
      <br/>
      <input name="email" type="email" class="form-control category avocado-focus" value="<?php echo $email;?>"  style="" maxlength="100">
    </input>

      <button class="update-profile-btn col-xs-12"  style="margin-top:30px;" id="submit" type="submit" name="profile"> Update Profile </button>
      </form>
    </div>
  </div>
  </div>


 