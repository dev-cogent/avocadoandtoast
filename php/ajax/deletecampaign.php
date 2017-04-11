<?php 
session_start();
include '../class/savecampaign.php';
if(!isset($_SESSION['project_id'])){
    return 0;
}

$update = new saveCampaign;
$info = $update->deleteCampaign($_POST['campaignid'],$_SESSION['column_id']);
var_dump($info);

