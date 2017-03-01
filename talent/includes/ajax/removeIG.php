<?php 
session_start();
include '../class/usersettings.php';
$usersettingobj = new userSettings;
$user_id = $_SESSION['userid'];
$instagram_id = $_POST['instagram_id'];
$remove = $usersettingobj->removeInstagram($instagram_id,$user_id);











?>