<?php
error_reporting(0);
session_start();
include 'php/dbinfo.php';
include 'php/ajax/savecampaign.php';
include 'php/numberAbbreviation.php';
if(!isset($_SESSION['project_id'])){
    header('Location: /login.php');
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['profile'])) {
   include 'php/updateprofile.php';
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
   include 'php/changepassword.php';
}
$stmt = $conn->prepare("SELECT `email`,`firstname`,`lastname`,`company` FROM `login_information` WHERE `userid` = ?");
$stmt->bind_param('s',$_SESSION['userid']);
if(!$stmt->execute()){
  header('Location: /login.php');
}
$stmt->bind_result($email,$firstname,$lastname,$company);
$stmt->fetch();
$userid = $_SESSION['userid'];

?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <?php include 'php/head.php' ?>
    <title> Settings | Avocado & Toast</title>
<script src="/bootbox/bootbox.js"></script>
<script src="/global/vendor/bootstrap/bootstrap.js"></script>
<script src="/assets/wnumb/wNumb.js"></script>
<script src="/assets/uislider/nouislider.js"></script>
<link rel="stylesheet" href="/assets/uislider/nouislider.css">
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

<div class="col-xs-1 sidebar-left" style="position:absolute;">
<i class="icon fa-bars" aria-hidden="true" style="
    color: white;
    text-align: center;
    font-size: 21px;
    margin-left: 5px;
    height: 20px;
    padding-top: 15px;
"></i>
</div>
<div id="stuff"></div>
<div class="col-xs-3 small-col">
  <div class="settings-box">
  <div class="profile-sect settings"> <i class="icon wb-user" aria-hidden="true"></i> <span class="setting-title" id="getProfile"> Profile </span> </div>
  <div class="password-sect settings"> <i class="icon fa-lock" aria-hidden="true"></i> <span class="setting-title" id="getPassword"> Password </span> </div>
  <div class="user-settings-sect settings"> <i class="icon fa-users" aria-hidden="true"></i> <span class="setting-title"> User Settings </span> </div>
  <div class="email-notifications-sect settings"> <i class="icon fa-envelope" aria-hidden="true"></i> <span class="setting-title"> Email Notifications </span> </div>
  <!-- <div class="billing-subscription-sect settings"> <i class="icon fa-calendar" aria-hidden="true"></i> <span class="setting-title"> Billing & Subscriptions </span> </div> -->
  <!-- <div class="contact-sect settings">  <i class="icon fa-phone" aria-hidden="true"></i> <span class="setting-title"> Contact </span> </div> -->
</div>
</div>
<script src="/assets/js/sidebar-left.js"></script>
<script>
    var target2 = $('#stuff').offset().top;
</script>

<!-- <div class="container" style="">
  <div class="row"> -->



<div class="col-xs-9 settings-lg-col" id="setting-container">

<div class="input-container" style="width:45%;">

<form action="" method="POST" enctype= "multipart/form-data">

    <div class="user-profile-pic"> </div>
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

  <script>
  $(document).on('click','#getPassword',function(){
    $.ajax({
        type: 'POST',
        url: '/php/ajax/getPassword.html',
        data: {
            page: '0'
        },
        success: function (jqXHR, textStatus, errorThrown) {
            $('.input-container').empty();
            $('.input-container').append(jqXHR);
        }
    }); // end ajax request*/
  });
  $(document).on('click','#getProfile',function(){
    $.ajax({
        type: 'POST',
        url: '/php/ajax/getProfile.php',
        data: {
            page: '0'
        },
        success: function (jqXHR, textStatus, errorThrown) {
            $('.input-container').empty();
            $('.input-container').append(jqXHR);
        }
    }); // end ajax request*/
  });

  </script>
