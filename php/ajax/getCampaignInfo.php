<?php
include '../class/savecampaign.php';
$save = new saveCampaign;
$campaigninfo = $save->getCampaignInfo($_POST['campaignid']);
echo $campaigninfo;