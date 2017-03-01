<?php
session_start();
//error_reporting(0);
include 'includes/dbinfo.php';
include 'includes/class/savecampaign.php';
include 'includes/numberAbbreviation.php';
$url = $_SERVER['REQUEST_URI'];
$id = explode('/',$url);
$id = $id[2];
if($id == NULL){
$campaignid = $_SESSION['temp_campaign_id'];
}
else{
$campaignid = $id;
}


$save = new saveCampaign;
$checkcampaign = $save->checkCampaign($campaignid, $_SESSION['column_id']);
if($checkcampaign === false) header('Location: /dashboard.php');
$today = date('Y-m-d');
$tomorrow = date("Y-m-d", strtotime('tomorrow'));

//Checking for campaign validity

$campaigninfo = $save->getCampaignInfo($campaignid);
$campaigninfo = json_decode($campaigninfo,true);
$campaignsummary = $campaigninfo['description'];
$campaignstart = $campaigninfo['start'];
$campaignend = $campaigninfo['end'];
$campaignrequest = $campaigninfo['request'];
$campaignname = $save->getCampaignName($campaignid);



?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <?php include 'includes/head.php' ?>
    <title><?php echo $influencerinfo['campaign_name'];?> | Avocado & Toast</title>
<script src="/bootbox/bootbox.js"></script>
<script src="/global/vendor/bootstrap/bootstrap.js"></script>
<script src="/assets/wnumb/wNumb.js"></script>
<script src="/assets/uislider/nouislider.js"></script>
<script src="/includes/javascript/tokenfield/dist/bootstrap-tokenfield.js"></script>
<link rel="stylesheet" href="/includes/javascript/tokenfield/dist/css/bootstrap-tokenfield.css">
<link rel="stylesheet" href="/assets/uislider/nouislider.css">
<link rel="stylesheet" href="/global/fonts/brand-icons/brand-icons.css">
<link rel="stylesheet" href="/global/fonts/font-awesome/font-awesome.css">
<link rel="stylesheet" href="/includes/css/discover.css">
<style>
.form-control{
    letter-spacing:0px;
    color:#515862;
    font-size:15px;
}

.title{
    color:rgb(29, 40, 76);
    font-family: 'Open Sans', sans-serif;
    padding-top:20px;
    font-weight:600;
}

.settings{
  text-align: center;
  margin-top: 5%;
}
.settings-box {
  margin-top: 15%;
}
.input-container {
  margin-left: 3%;
}
.uploaded-img-square{
  background-color: lightgray;
  width: 150px;
  height: 150px;
}
.upload-img {
  display: -webkit-box;
  margin-top: 10%;
}
.profile-title{
  margin-left: 10%;
  font-family: 'Open Sans', sans-serif;
  display: -webkit-inline-box;
  color: rgb(29, 40, 76);
  text-transform: uppercase;
  font-weight:600;
}
.upload-img-btn {
  border: 1px solid #30363F;
  padding: 7px 20px;
  background-color: transparent;
  border-radius: 3px;
  display: -webkit-inline-box;
  color: rgb(29, 40, 76);
  margin-left: 10%;
  margin-top: 8%;
}
textarea.form-control.category.avocado-focus {
  height: 40px;
}

.small-col {
  height: 100%;
  border-right: 1px solid rgb(210,215,220);
}
.update-profile-btn{
  border-radius: 1px;
  border: 0px;
  color: white;
  height: 50px;
  font-size: 16px;
  font-family: 'Montserrat', sans-serif;
  background-color: #73C48D;
}

@media(min-width:900px) and (max-width:1100px){
  .settings-box{
    margin-left: 25%;
  }
}

@media(min-width:600px) and (max-width:899px){
  .settings-box{
    margin-left: 30%;
  }
  .settings{
    margin-top: 12%;
  }
}

@media(min-width:300px) and (max-width:599px){
  .settings-lg-col {
    width: 55%;
    margin-left: 5%;
    margin-top: 3%;
  }
  .small-col{
    width: 40%;
  }
  .settings {
    margin-top: 25%;
  }
  .settings-box{
    margin-left: 35%;
  }
  .uploaded-img-square{
    display: -webkit-inline-box;
  }
  .profile-title{
    font-size: 11px;
    float: right;
  }
  .update-profile-btn{
    height: 40px;
    width: 150px;
  }
  .title{
    width: 120px;
  }
  .sidebar-left {
    margin-top: 66px;
  }
  .mininav{
    display: none;
  }
}

@media(min-width:560px) and (max-width: 750px) and (orientation: landscape){
  .mininav {display: none;}
  .col-xs-1.sidebar-left{ margin-top: 65px;}
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
  <div class="profile-sect settings"> <i class="icon wb-user" aria-hidden="true"></i> <span class="setting-title"> Profile </span> </div>
  <div class="password-sect settings"> <i class="icon fa-lock" aria-hidden="true"></i> <span class="setting-title"> Password </span> </div>
  <!-- <div class="user-settings-sect settings"> <i class="icon fa-users" aria-hidden="true"></i> <span class="setting-title"> User Settings </span> </div> -->
  <div class="email-notifications-sect settings"> <i class="icon fa-envelope" aria-hidden="true"></i> <span class="setting-title"> Email Notifications </span> </div>
  <!-- <div class="billing-subscription-sect settings"> <i class="icon fa-calendar" aria-hidden="true"></i> <span class="setting-title"> Billing & Subscriptions </span> </div>
  <div class="contact-sect settings">  <i class="icon fa-phone" aria-hidden="true"></i> <span class="setting-title"> Contact </span> </div> -->
</div>
</div>
<script src="/includes/javascript/sidebar-left.js"></script>
<script>
    var target2 = $('#stuff').offset().top;
</script>


<div class="col-xs-9 settings-lg-col">

<div class="input-container" style="width:35%;">

          <form action="#">

    <label class="title"> Old Password </label>
    <br/>
    <input type="text" class="form-control category avocado-focus" value=""  style="" maxlength="100">
  </input>

  <label class="title"> New Password </label>
  <br/>
  <input type="text" class="form-control category avocado-focus" value=""  style="" maxlength="100">
  </input>

    <label class="title"> Confirm New Password  </label>
    <br/>
    <input type="text" class="form-control category avocado-focus" value=""  style="" maxlength="100">
  </input>

    <button class="update-profile-btn avocado-hover col-xs-12"  style="margin-top:30px;" id="submit"> Update </button>
  </div>
</div>
  </div>
