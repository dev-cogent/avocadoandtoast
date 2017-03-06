<?php 
session_start(); 
include '../class/savecampaign.php';
$campaignname = $_POST['campaignname'];
$influencerids = $_POST['users'];
$userid = $_SESSION['userid'];

if($userid == NULL)
return 0;
$campaign = new saveCampaign;
$createcampaign = $campaign->createSavedCampaign($influencerids,$userid,$campaignname);
if($createcampaign === true){
    array_push($_SESSION['campaigns'],$campaignname);
    echo $createcampaign;
}
elseif ($createcampaign === 'duplicate'){
    echo "300";
}
else 
    echo $createcampaign; 
