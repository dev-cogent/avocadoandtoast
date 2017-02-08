<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
include 'includes/registerinfo.php';
}


?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <?php include '../../includes/head.php' ?>
    <title>Blank Page | Project Social</title>
</head>
<body class="animsition site-navbar-small ">
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
   <?php include '../../includes/nav.php' ?>

  <?php include '../../includes/sidebar.php' ?>
  <!-- Page -->
  <div class="page">
    <div class="page-content">
      <h2>Blank</h2>
      <p>Page content goes here</p>
    </div>
  </div>
  <!-- End Page -->
  <?php include '../../includes/footer.php' ?>
</body>
</html>