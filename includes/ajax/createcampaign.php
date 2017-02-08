<?php 
session_start();
include '../class/campaign.php';
$campaignname = $_POST['campaignname'];
$influencerids = $_POST['users'];
$userid = $_SESSION['userid'];
$campaign = new campaignCalculator;
$createcampaign = $campaign->createCampaign($influencerids,$userid,$campaignname);
if($createcampaign === true){
    array_push($_SESSION['campaigns'],$campaignname);
    echo $createcampaign;
}
elseif ($createcampaign === 'duplicate'){
    echo "300";
}
else 
    echo $createcampaign; 
