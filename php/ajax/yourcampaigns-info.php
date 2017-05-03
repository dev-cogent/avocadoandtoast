<?php
session_start();
include '../dbinfo.php';
include '../class/savecampaign.php';
$save = new saveCampaign;
$campaigninfo = $save->getSavedCampaigns($_SESSION['column_id']);
if($campaigninfo === false){
  echo '0';
}else{
  echo json_encode($campaigninfo);
}
