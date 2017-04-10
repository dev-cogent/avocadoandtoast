<?php
error_reporting(-1);
if(!isset($_SESSION['project_id'])) {
    header('Location:/login.php');
}

include 'class/usersettings.php';
$settings = new userSettings;
$oldpassword = $_POST['oldpassword'];
$newpassword = $_POST['newpassword'];
$update = $settings->changePassword($oldpassword,$newpassword,$_SESSION['userid']);
if($update == false){
    echo '<script> alert("Password incorrect");</script>';
}
else{
     echo '<script> alert("Password updated");</script>'; 
}