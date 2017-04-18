<?php 
session_start();
error_reporting(0);
$campaignid = $_GET['id'];
include 'class/savecampaign.php';
$save = new saveCampaign;
$checkcampaign = $save->checkCampaign($campaignid, $_SESSION['column_id']);
if($checkcampaign === false) header('Location: /dashboard.php');