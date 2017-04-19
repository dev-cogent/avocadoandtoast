<?php 
include '../class/savecampaign.php';
$campaignid = $_POST['campaignid'];
$save = new saveCampaign;
$influencerinfo = $save->getCampaign($campaignid,0,100);
echo $influencerinfo;