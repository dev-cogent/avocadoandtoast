<?php
include '../class/savecampaign.php';
$save = new saveCampaign;
$influencernumber = $_POST['page'] * 30;
$campaigninfo = $save->getCampaign($_POST['campaignid'],$influencernumber);
echo $campaigninfo;
