<?php 
session_start();
include '../class/editcampaign.php';
$campaignid = $_POST['campaignid'][0];
$influencersToRemove = $_POST['deletedInfluencers'];
$save = new editCampaign;
$checkCampaign = $save->checkCampaign($campaignid,$_SESSION['column_id']);
if($checkCampaign === false) return 0;
$saveNewState = $save->recalculate($campaignid,$influencersToRemove);
if($saveNewState === true){
    echo '1';
}



