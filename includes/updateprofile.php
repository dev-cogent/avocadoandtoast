<?php 
if(!isset($_SESSION['project_id'])) {
    header('Location:/login.php');
}

include 'class/usersettings.php';
$settings = new userSettings;
$update = $settings->updateGeneralInfo($_POST,$_FILES,$_SESSION['userid']);



