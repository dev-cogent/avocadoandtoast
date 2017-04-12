<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <?php include 'html/head.html' ?>
    <title>Dashboard</title>
<script src="/global/vendor/bootstrap/bootstrap.js"></script>
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Open+Sans:400,700" rel="stylesheet">
<link rel="stylesheet" href="/global/fonts/brand-icons/brand-icons.css">
<link rel="stylesheet" href="/assets/css/discover.css">
<link rel="stylesheet" href="/assets/css/dashboard.css">
<style>
.campaign-block{
    background-color:#fcfcfc;

}
button:focus{
    outline:none;
}

</style>
</head>

<body class="col-xs-12" style="padding-left:0px;padding-right:0px;">
    <?php include 'acnav.php'; ?>




    <!-- Start Campains here -->
    <div class="col-xs-9 col-xl-9 divider-top" style="padding-top: 16px; padding-left:75px;">
        <div id="allcampaigns" class="col-xs-12"> All Campaigns </div>

    </div>


    <div class="col-xs-2" style="padding-top: 75px;" id="campaign-info">
        <!-- Right side bar --> 
        <!-- Information here is appened in javascript -->
    </div>

    <div id="campaign-container">
         <!-- All campaigns go in here -->
         <!-- Information here is appened in javascript --> 
    </div>

</body>
<script src="/assets/js/dashboard.js"></script>
