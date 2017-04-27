<?php 
include '../class/savecampaign.php';
$save = new saveCampaign;
$influencerinfo = $save->getCampaign($_POST['campaignid']);
echo $influencerinfo;
