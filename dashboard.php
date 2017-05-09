<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <?php include 'html/head.html' ?>
    <title>Dashboard</title>
<script src="/global/vendor/bootstrap/bootstrap.js"></script>
<script src="/bootbox/bootbox.js"></script>
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Open+Sans:400,700" rel="stylesheet">
<link rel="stylesheet" href="/global/fonts/brand-icons/brand-icons.css">
<link rel="stylesheet" href="/assets/css/discover.css">
<link rel="stylesheet" href="/assets/css/dashboard.css">
<link rel="stylesheet" href="/assets/css/footer.css">

</head>

<?php include 'php/avocado-nav.php'; ?>
<body class="col-xs-12" style="padding-left:0px;padding-right:0px;">


  <div class="bootbox-body">
  <div class="delete-icon-popup-div"> <img src="/assets/images/delete.png" class="trash-icon"/> </div>
  <div class="row"> <div class="delete-popup-detail">   <span class="delete-list-text"> DELETE LIST?  </span> <br/> Once deleted this action cannot be undone </div>
  <div class="delete-btn-div"> <button class="delete-yes primary-button" type="button" formaction="/campaigns/?id=' + campaignid + '"> DELETE </button> <button class="delete-no secondary-button" type="button" formaction="/campaigns/?id=' + campaignid + '"> NOPE </button></div>
  </div>


    <!-- Start Campains here -->


    <div id="campaign-container">
         <!-- All campaigns go in here -->
         <!-- Information here is appened in javascript -->
    </div>

    <?php include 'footer.php'; ?>

</body>

<script src="/assets/js/avocado-dashboard.js"></script>
