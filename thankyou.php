<?php 
$message = 'Name:'.$_POST['name']. ' Email:' .$_POST['email']. ' Message:'.$_POST['message'];
mail('bashir@cogentworld.com','Contact Form',$message);

?>
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

<h1> Thank you </h1>

</div>

