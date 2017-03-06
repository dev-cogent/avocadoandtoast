<?php 
session_start();
include '../class/useroptions.php';
$useroptionsobj = new userOptions;
//first we will check if this user has access to that account. 
$instagramaccounts = $useroptionsobj->getInstagramAccounts($_SESSION['userid']);
$check = false;
foreach($instagramaccounts as $id){
if($_POST['instagram_id'] == $id)
$check = true;
}
if(!$check)
return 'false';
else{
$_SESSION['instagram_id'] = $_POST['instagram_id'];
$_SESSION['basic_info'] = $useroptionsobj->getBasicInstagramInfoDB($_SESSION['instagram_id']);
$_SESSION['access_token'] = $_SESSION['basic_info']['access_token'];
}

















?>