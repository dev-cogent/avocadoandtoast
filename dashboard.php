<?php
session_start();
//error_reporting(0);
include 'includes/dbinfo.php';
include 'includes/numberAbbreviation.php';

?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <?php include 'includes/head.php' ?>
    <title>Blank Page | Project Social</title>
<script src="/bootbox/bootbox.js"></script>
<script src="/global/vendor/bootstrap/bootstrap.js"></script>
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Open+Sans:400,700" rel="stylesheet">
<script src="/assets/wnumb/wNumb.js"></script>
<script src="/assets/uislider/nouislider.js"></script>
<script src="/includes/javascript/tokenfield/dist/bootstrap-tokenfield.js"></script>
<link rel="stylesheet" href="/includes/javascript/tokenfield/dist/css/bootstrap-tokenfield.css">
<link rel="stylesheet" href="/assets/uislider/nouislider.css">
<link rel="stylesheet" href="/global/fonts/brand-icons/brand-icons.css">
<link rel="stylesheet" href="/global/fonts/font-awesome/font-awesome.css">
<link rel="stylesheet" href="/includes/css/discover.css">

</head>

<body class="col-xs-12" style="padding-left:0px;padding-right:0px;">
    <div class="col-xs-12" style="border-top: 1px solid rgb(210,215,220); border-bottom:1px solid rgb(210,215,220); height:66px;">
       <img src="/assets/images/at-logo-black.png" style="margin-top:-8px;">

    </div>
<!-- Content where the discover, communicatie, order management would be -->
<div class="mininav" style="margin-top:65px" >
    <p class="nav2"> <a href="" class="discover-nav"> DISCOVER </a> </p>
      <p class="nav2"> <a href="" class="create-nav"> CREATE </a> </p>
        <p class="nav2"> <a href="" class="price-nav">  PRICE CAMPAIGN </a></p>
          <p class="nav2"> <a href="" class="campaign-nav"> YOUR CAMPAIGNS </a>  </p>
</div>








<!-- Add side bar here -->

<div class="col-xs-1 sidebar-left">
<i class="icon fa-bars" aria-hidden="true" style="
    color: white;
    text-align: center;
    font-size: 21px;
    margin-left: 5px;
    height: 20px;
    padding-top: 15px;
"></i>
</div>


<!-- The third nav bar , we might be able to take this out. In the mean time, we'll keep it here -->

<div class="mininav col-xs-12" style="height:50px;">
    <p class="nav3">INFLUENCERS</p>
</div>


<!-- Start Campains here -->
<div class="col-xs-8">
    <div id="allcampaigns" class="col-xs-12">
    ALL CAMPAIGNS
    </div>





</div>