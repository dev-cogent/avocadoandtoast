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
  <div class="user-settings-sect settings"> <i class="icon fa-users" aria-hidden="true"></i> <span class="setting-title"> User Settings </span> </div>
  <div class="email-notifications-sect settings"> <i class="icon fa-envelope" aria-hidden="true"></i> <span class="setting-title"> Email Notifications </span> </div>
  <!-- <div class="billing-subscription-sect settings"> <i class="icon fa-calendar" aria-hidden="true"></i> <span class="setting-title"> Billing & Subscriptions </span> </div> -->
  <!-- <div class="contact-sect settings">  <i class="icon fa-phone" aria-hidden="true"></i> <span class="setting-title"> Contact </span> </div> -->
</div>
</div>
<script src="/includes/javascript/sidebar-left.js"></script>
<script>
    var target2 = $('#stuff').offset().top;
</script>

<!-- <div class="container" style="">
  <div class="row"> -->



<div class="col-xs-9 settings-lg-col">

<div class="input-container" style="width:45%;">


    <div class="user-profile-pic"> </div>
      <div class="upload-img">
        <div class="uploaded-img-square"> </div>
        <div class="profile-title"> Your Avatar </div>
          <a class="upload-img-btn" href="">  Upload Image </a>
          </div>

          <form action="#">

    <label class="title"> Company Name </label>
    <br/>
    <input type="text" class="form-control category avocado-focus" value="ex. Avocado Johnson Co." maxlength="100" style="">
  </input>
    <label class="title"> First Name  </label>
    <br/>
    <input type="text" class="form-control category avocado-focus" value="Harry"  style="" maxlength="100">
  </input>

  <label class="title"> Last Name  </label>
  <br/>
  <input type="text" class="form-control category avocado-focus" value="Avocado"  style="" maxlength="100">
  </input>

    <label class="title"> Email </label>
    <br/>
    <input type="text" class="form-control category avocado-focus" value="harry@avocadojohnson.com"  style="" maxlength="100">
  </input>

    <button class="update-profile-btn avocado-hover col-xs-12"  style="margin-top:30px;" id="submit"> Update Profile </button>
  </div>
</div>
  </div>
