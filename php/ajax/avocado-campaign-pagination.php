<?php
include '../class/savecampaign.php';
$save = new saveCampaign;
$influencernumber = $_POST['page'] * 32;
$campaigninfo = $save->getCampaign($_POST['campaignid'],$influencernumber);
echo $campaigninfo;
