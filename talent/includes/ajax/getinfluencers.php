<?php 
include '../class/savecampaign.php';
$obj = new saveCampaign;
$influencerlist = array();
$campaignconn = $obj->savedDB();
$campaignid = $_POST['list'];

$stmt = $campaignconn->prepare("SELECT `influencer_id` FROM `$campaignid`");
$stmt->execute();
$stmt->bind_result($id);
while($stmt->fetch()){
    array_push($influencerlist,$id);
}
echo json_encode($influencerlist);