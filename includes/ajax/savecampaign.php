<?php
session_start();
include '../class/savecampaign.php';

$save = new saveCampaign; 
$conn = $save->dbinfo();
$i = 0;
$arr = array();
$selectedusers = json_decode($_POST['info'],true);

foreach($selectedusers as $user => $postnumber){
    
    $stmt = $conn->prepare("SELECT `instagram_count`,`facebook_count`,`twitter_count` FROM `Influencer_Information` WHERE `id` = ?");
    $stmt->bind_param('s',$user);
    $stmt->execute();
    $stmt->bind_result($instagramcount,$facebookcount,$twittercount);
    $stmt->fetch();
    $arr[$user]['instagrampost'] = $postnumber['instagramposts']; 
    $arr[$user]['instagramimpressions'] =  $instagramcount * $postnumber['instagramposts'];
    $totalinstagramimpressions += $instagramcount * $postnumber['instagramposts'];

    $arr[$user]['facebookpost'] = $postnumber['facebookposts']; 
    $arr[$user]['facebookimpressions'] = 
    $totalfacebookimpressions += $facebookcount * $postnumber['facebookposts'];


    $arr[$user]['twitterpost'] = $postnumber['twitterposts']; 
    $arr[$user]['twitterimpressions'] = $twittercount * $postnumber['twitterposts'];
    $totaltwitterimpressions += $twittercount * $postnumber['twitterposts'];
    $totalpost += $postnumber['twitterposts'] + $postnumber['facebookposts'] + $postnumber['instagramposts'];
    unset($stmt);
    $i++;
    
}
    
    $stats['totalinstagramimpressions'] = $totalinstagramimpressions;
    $stats['totaltwitterimpressions'] = $totaltwitterimpressions;
    $stats['totalfacebookimpressions'] = $totalfacebookimpressions;
    $stats['totalimpressions'] =  $totalinstagramimpressions + $totaltwitterimpressions + $totalfacebookimpressions;
    $stats['totalposts'] = $totalpost;
    $stats['created'] = date('m/d/Y');
    $stats['description'] = $_POST['campaigndescription'];
    $stats = json_encode($stats);    
    $savecampaign = $save->createSavedCampaign($arr,$_SESSION['userid'],$stats,$_POST['campaignname']);
    echo $savecampaign;