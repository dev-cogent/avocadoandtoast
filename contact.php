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

