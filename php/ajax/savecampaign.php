<?php
session_start(); 
include '../class/savecampaign.php';

$save = new saveCampaign; 
$conn = $save->dbinfo();
$i = 0;
$arr = array();
$selectedusers = json_decode($_POST['info'],true);

foreach($selectedusers as $user => $postnumber){    
    $stmt = $conn->prepare("SELECT `instagram_count`,`facebook_count`,`twitter_count`,`engagement` FROM `Influencer_Information` WHERE `id` = ?");
    $stmt->bind_param('s',$user);
    $stmt->execute();
    $stmt->bind_result($instagramcount,$facebookcount,$twittercount,$engagement);
    $stmt->fetch();
    $engagement = json_decode($engagement,true);
    $instagramengagement = ($postnumber['instagramposts'] * $instagramcount) * ($engagement['instagram']['average_engagement']/$instagramcount);
    if(is_nan($instagramengagement)) $instagramengagement = 0;
    $arr[$user]['instagrampost'] = $postnumber['instagramposts']; 
    $arr[$user]['instagramimpressions'] =  $instagramcount * $postnumber['instagramposts'];
    $arr[$user]['instagramengagement'] =  $instagramengagement;
    $totalinstagramimpressions += $instagramcount * $postnumber['instagramposts'];
    $totalinstagramengagement += $arr[$user]['instagramengagement'];

    $facebookengagement = ($postnumber['facebookposts'] * $facebookcount) * ($engagement['facebook']['average_engagement']/$facebookcount); 
    if(is_nan($facebookengagement)) $facebookengagement = 0;
    $arr[$user]['facebookpost'] = $postnumber['facebookposts']; 
    $arr[$user]['facebookimpressions'] = $facebookcount * $postnumber['facebookposts'];
    $arr[$user]['facebookengagement'] = $facebookengagement;
    $totalfacebookimpressions += $facebookcount * $postnumber['facebookposts'];
    $totalfacebookengagement += $arr[$user]['facebookengagement'];

    $twitterengagement = ($postnumber['twitterposts'] * $twittercount) * ($engagement['twitter']['average_engagement']/$twittercount);
    if(is_nan($twitterengagement)) $twitterengagement = 0;
    $arr[$user]['twitterpost'] = $postnumber['twitterposts']; 
    $arr[$user]['twitterimpressions'] = $twittercount * $postnumber['twitterposts'];
    $arr[$user]['twitterengagement'] =  $twitterengagement;
    $totaltwitterimpressions += $twittercount * $postnumber['twitterposts'];
    $totaltwitterengagement += $arr[$user]['twitterengagement'];
    $totalpost += $postnumber['twitterposts'] + $postnumber['facebookposts'] + $postnumber['instagramposts'];

    unset($stmt);
    unset($instagramcount);
    unset($facebookcount);
    unset($twittercount);
    unset($engagement);
    $i++;
    
}
    
    $stats['totalinstagramimpressions'] = $totalinstagramimpressions;
    $stats['totaltwitterimpressions'] = $totaltwitterimpressions;
    $stats['totalfacebookimpressions'] = $totalfacebookimpressions;

    $stats['totalinstagramengagement'] = $totalinstagramengagement;
    $stats['totaltwitterengagement'] = $totaltwitterengagement;
    $stats['totalfacebookengagement'] = $totalfacebookengagement;

    $stats['totalimpressions'] =  $totalinstagramimpressions + $totaltwitterimpressions + $totalfacebookimpressions;
    $stats['totalengagement'] =  $totalinstagramengagement + $totaltwitterengagement + $totalfacebookengagement;
    $stats['totalposts'] = $totalpost;
    
    $stats['created'] = date('m/d/Y');
    $stats['description'] = $_POST['campaigndescription'];
    $savecampaign = $save->createSavedCampaign($arr,$_SESSION['userid'],$stats,$_POST['campaignname']);
    echo $savecampaign;
    