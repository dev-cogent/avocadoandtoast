<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
include 'php/registerinfo.php';
}


?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
    <?php include 'php/head.php' ?>
  <title>Register V2 | Remark Admin Template</title>
  
</head>
<body class="animsition page-register-v2 layout-full page-dark">
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
  <!-- Page -->
  <div class="page" data-animsition-in="fade-in" data-animsition-out="fade-out">
    <div class="page-content">
      <div class="page-brand-info">
        <div class="brand">
          <img class="brand-img" src="../../assets/images/logo@2x.png" alt="...">
          <h2 class="brand-text font-size-40">Remark</h2>
        </div>
        <p class="font-size-20">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua.</p>
      </div>
      <div class="page-register-main">
        <div class="brand hidden-md-up">
          <img class="brand-img" src="../../assets/images/logo-blue@2x.png" alt="...">
          <h3 class="brand-text font-size-40">Remark</h3>
        </div>
        <h3 class="font-size-24">Sign Up</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
        <form method="post" role="form">
          <div class="form-group">
            <label class="sr-only" for="inputName">Full Name</label>
            <input type="text" class="form-control" id="inputName" name="name" placeholder="Name">
          </div>
          <div class="form-group">
            <label class="sr-only" for="inputEmail">Email</label>
            <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email">
          </div>
          <div class="form-group">
            <label class="sr-only" for="inputPassword">Password</label>
            <input type="password" class="form-control" id="inputPassword" name="password"
            placeholder="Password">
          </div>
          <div class="form-group">
            <label class="sr-only" for="inputPasswordCheck">Retype Password</label>
            <input type="password" class="form-control" id="inputPasswordCheck" name="passwordCheck"
            placeholder="Confirm Password">
          </div>
          <div class="form-group clearfix">
            <div class="checkbox-custom checkbox-inline checkbox-primary pull-xs-left">
              <input type="checkbox" id="inputCheckbox" name="term">
              <label for="inputCheckbox"></label>
            </div>
            <p class="m-l-40">By clicking Sign Up, you agree to our <a href="#">Terms</a>.</p>
          </div>
          <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
        </form>
        <p>Have account already? Please go to <a href="login-v2.html">Sign In</a></p>
        <footer class="page-copyright">
          <p>WEBSITE BY amazingSurge</p>
          <p>© 2016. All RIGHT RESERVED.</p>
          <div class="social">
            <a class="btn btn-icon btn-round social-twitter" href="javascript:void(0)">
              <i class="icon bd-twitter" aria-hidden="true"></i>
            </a>
            <a class="btn btn-icon btn-round social-facebook" href="javascript:void(0)">
              <i class="icon bd-facebook" aria-hidden="true"></i>
            </a>
            <a class="btn btn-icon btn-round social-google-plus" href="javascript:void(0)">
              <i class="icon bd-google-plus" aria-hidden="true"></i>
            </a>
          </div>
        </footer>
      </div>
    </div>
  </div>
  <!-- End Page -->
   <?php include 'php/footer2.php' ?>
</body>
</html>