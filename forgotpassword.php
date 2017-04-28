<?php
session_start();
session_destroy();
error_reporting(0);
unset($_SESSION);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
include 'php/forgot.php';
}
?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <?php include 'html/head.html' ?>
    <title>Login | Avocado & Toast</title>
<script src="/bootbox/bootbox.js"></script>
<script src="/global/vendor/bootstrap/bootstrap.js"></script>
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Open+Sans:400,700" rel="stylesheet">
<script src="/assets/wnumb/wNumb.js"></script>
<script src="/assets/uislider/nouislider.js"></script>
<script src="/assets/js/tokenfield/dist/bootstrap-tokenfield.js"></script>
<link rel="stylesheet" href="/assets/js/tokenfield/dist/css/bootstrap-tokenfield.css">
<link rel="stylesheet" href="/assets/uislider/nouislider.css">
<link rel="stylesheet" href="/global/fonts/brand-icons/brand-icons.css">
<link rel="stylesheet" href="/global/fonts/font-awesome/font-awesome.css">
<link rel="stylesheet" href="/assets/css/discover.css">
<link rel="stylesheet" href="/assets/css/forgot-password.css">

</head>

<body class="col-xs-12" style="padding-left:0px;padding-right:0px;">
    <div class="col-xs-12" style="border-top: 1px solid rgb(210,215,220); border-bottom:1px solid white; height:66px; background-color:#f7f7f7;">
       <img src="/assets/images/at-logo-black.png" style="margin-top:-8px;">

</div>


<!-- logo goes here -->
<div id="spacing"></div>
<div class="col-xs-1 col-xl-4"></div>
<div class="col-xs-10 col-xl-4"> 

<div style="text-align:center; padding-top:30px;"> <img id="icon" src="/assets/images/avocado.png"></div>
    <h1 id="header-text"> FORGOT PASSWORD </h1>
        <div style="text-align:center;">
                <form method="POST" action="">
                <input style="width:72%; height:50px; margin-left:14%; text-transform:none; "type="email" class="avocado-focus form-control m-b-30"  name="email"    placeholder="Email">
                <br/>
                <button class="form-control" id="login-button"> SUBMIT </button>
                </form>
                <a href="/login.php" style="text-decoration:none;"><button class="form-control" id="register-button" > Login </button></a>
    </div>
</div>

<div class="col-xs-1 col-xl-4" style="height: 100%;margin-top: -35px;background-color: #f7f7f7;"></div>




</body>


