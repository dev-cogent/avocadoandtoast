<?php
session_start();
include '../class/campaign.php';
$campaign = new campaignCalculator; 
$campaignname = $_POST['campaignname'];
$influencerids = $_POST['users'];
$userid = $_SESSION['userid'];
$addtocampaign = $campaign->addToCampaign($influencerids,$userid,$campaignname);
if($addtocampaign !== true && strpos($addtocampaign,'Duplicate entry') !== FALSE)
    echo 'User in campaign';
else
    echo $addtocampaign;




