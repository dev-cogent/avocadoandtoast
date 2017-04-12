<?php
session_start();
//error_reporting(0);
include 'php/dbinfo.php';
include 'php/class/savecampaign.php';
include 'php/numberAbbreviation.php';
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
  <?php include 'html/head.html' ?>
    <title><?php echo $influencerinfo['campaign_name'];?> | Avocado & Toast</title>
<script src="/bootbox/bootbox.js"></script>
<script src="/global/vendor/bootstrap/bootstrap.js"></script>
<script src="/assets/wnumb/wNumb.js"></script>
<script src="/assets/uislider/nouislider.js"></script>
<link rel="stylesheet" href="dist/switchery.css" />
<script src="dist/switchery.js"></script>
<link rel="stylesheet" href="/assets/uislider/nouislider.css">
<link rel="stylesheet" href="/global/fonts/brand-icons/brand-icons.css">
<link rel="stylesheet" href="/global/fonts/font-awesome/font-awesome.css">
<link rel="stylesheet" href="/assets/css/discover.css">
<style>


@media(min-width:560px) and (max-width: 750px) and (orientation: landscape){
  .avo-nav {display: none;}
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
<script src="/assets/js/sidebar-left.js"></script>
<script>
    var target2 = $('#stuff').offset().top;
</script>


<div class="col-xs-9 settings-lg-col ">

<div class="input-container email-setting" style="width:35%;">

<div class="switch-div">
<span class="switchery switchery-default" style="background-color: #73c48d; border-color:#73c48d; box-shadow: #73c48d 0px 0px 0px 13px inset; transition: border 0.4s, box-shadow 0.4s, background-color 1.2s;"><small style="left: 21px; transition: background-color 0.4s, left 0.2s; background-color: rgb(255, 255, 255);"></small></span>
  Notify me when campaign begins
</div>

<div class="switch-div">
<span class="switchery switchery-default" style="background-color: #73c48d; border-color:#73c48d; box-shadow: #73c48d 0px 0px 0px 13px inset; transition: border 0.4s, box-shadow 0.4s, background-color 1.2s;"><small style="left: 21px; transition: background-color 0.4s, left 0.2s; background-color: rgb(255, 255, 255);"></small></span>
 Notify me when campaign ends </div>

<div class="switch-div">
<span class="switchery switchery-default" style="background-color: #73c48d; border-color:#73c48d; box-shadow: #73c48d 0px 0px 0px 13px inset; transition: border 0.4s, box-shadow 0.4s, background-color 1.2s;"><small style="left: 21px; transition: background-color 0.4s, left 0.2s; background-color: rgb(255, 255, 255);"></small></span>
Notify cash me outside how about dah
</div>


  </div>
</div>
  </div>
