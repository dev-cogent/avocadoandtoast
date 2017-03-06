<?php 
session_start();
include '../class/savecampaign.php';
if(!isset($_SESSION['project_id'])){
    return 0;
}

$update = new saveCampaign;
$info = $update->updateCampaign($_POST['campaignid'],$_POST['campaignname'],$_POST['campaignsummary'],$_POST['campaignrequest'],$_POST['campaignstart'],$_POST['campaignend']);
var_dump($info);

