<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <?php include 'html/head.html' ?>
    <title>Avocado & Toast</title>
<script src="/bootbox/bootbox.js"></script>
<script src="/global/vendor/bootstrap/bootstrap.js"></script>
<script src="/assets/uislider/nouislider.js"></script>
<link rel="stylesheet" href="/assets/css/discover.css">
<link rel="stylesheet" href="/assets/css/edit-campaign.css">
</head>

<body class="col-xs-12" style="padding-left:0px;padding-right:0px;">
<?php include 'php/avocado-nav.php';?>



<div class="center-form-content" >
<style>

/* no results found error */ 
.no-results-body {
  text-align: center;
}
.no-results-icon {
  max-width: 425px;
}
.no-results-detail{
  font-size: 20px;
  color: black;
}

</style>

   <div class="no-results-body">
    <div class="no-results-icon-div"> <img src="/assets/images/error-page.gif" class="no-results-icon"/> </div>
    <div class="row"> <div class="no-results-detail"> <span class="delete-list-text"> SORRY! LOOKS LIKE NO RESULTS WERE FOUND  </span>
       <br>  PLEASE TRY AGAIN OR  <a href="#"> CONTACT US </a>   </div>
    </div>

<div class="desc-header" id="edit-campaign-name" style="font-family: 'montserratsemibold'; color:#515862;">CONTACT US</div>
<div  class="input-container">
    <form action="/thankyou.php"  method="POST" >
    <label class="title"> Email </label>
    <input type="email" class="form-control category avocado-focus" name="email"value="">


    <label class="title">Name </label>
    <input type="text" class="form-control category avocado-focus" name="name" value="">

    <label class="title"> </label>
    <br/>


    <label class="title">Message</label>
    <br/>
    <textarea type="text" class="form-control category avocado-focus" id="campaign-request" style="height:150px;" name="message"></textarea>
    <br/>
    <button class="col-xs-12 avo-btn-edit avo-btn-edit-primary" id="submit-campaign" type="submit" >SUBMIT</button>
    <br/>
    </form>

</div>

</div>
