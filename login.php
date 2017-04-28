<?php
session_start();
session_destroy();
unset($_SESSION);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
include 'php/verify.php';

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
<link rel="stylesheet" href="/assets/uislider/nouislider.css">
<link rel="stylesheet" href="/global/fonts/brand-icons/brand-icons.css">
<link rel="stylesheet" href="/global/fonts/font-awesome/font-awesome.css">
<link rel="stylesheet" href="/assets/css/login.css">

</head>

<body class="col-xs-12" style="padding-left:0px;padding-right:0px;">
    <div class="col-xs-12" style="border-top: 1px solid rgb(210,215,220); border-bottom:1px solid white; height:66px; background-color:#f7f7f7;">
       <img src="/assets/images/at-logo-black.png" style="margin-top:-8px;">

</div>


<!-- logo goes here -->
<div id="spacing"></div>
<div class="col-xs-1 col-xl-4"></div>
<div class="col-xs-10 col-xl-4">

<div style="text-align:center;"> <img id="icon" src="/assets/images/avocado.png"></div>
  <h1 id="header-text"> SIGN IN </h1>
    <div style="text-align:center;">
      <form method="POST" action="">
      <input style="width:72%; height:50px; margin-left:14%; text-transform:none; "type="email" class="avocado-focus form-control m-b-30"  name="email"    placeholder="Email">
      <input style="width:72%; height:50px; margin-left:14%; text-transform:none; "type="password" class="avocado-focus form-control m-b-30"  name="password" placeholder="Password">
      <div style="font-size:10px; float:left; margin-left:14%;"><strong style="text-decoration: underline; color:#1F232A">FORGOT PASSWORD</strong> </div>
      <br/>
      <button class="form-control" id="login-button"> SIGN IN </button>
      </form>
      <a href="/signup.php" style="text-decoration:none;"><button class="form-control" id="register-button" > REGISTER </button></a>
    </div>
</div>

<div class="col-xs-1 col-xl-4" style="height: 100%;margin-top: -35px;background-color: #f7f7f7;"></div>




</body>
</html>
