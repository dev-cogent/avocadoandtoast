<?php
session_start(); 
error_reporting(-1);
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
    if(!$instagramcount){
        $arr[$user]['instagrampost'] = 0; 
        $arr[$user]['instagramimpressions'] =  0;
        $arr[$user]['instagramengagement'] = 0;      
    }else{
        $arr[$user]['instagrampost'] = $postnumber['instagramposts']; 
        $arr[$user]['instagramimpressions'] =  $instagramcount * $postnumber['instagramposts'];
        $arr[$user]['instagramengagement'] = ($postnumber['instagramposts'] * $instagramcount) * ($engagement['instagram']['average_engagement']/$instagramcount); 
        $totalinstagramimpressions += $instagramcount * $postnumber['instagramposts'];
        $totalinstagramengagement += $arr[$user]['instagramengagement'];
    }



    //Facebook
    if(!$facebookcount){
        $arr[$user]['facebookpost'] = 0;
        $arr[$user]['facebookimpressions'] = 0;
        $arr[$user]['facebookengagement'] = 0;

    }else{
        $arr[$user]['facebookpost'] = $postnumber['facebookposts']; 
        $arr[$user]['facebookimpressions'] = $facebookcount * $postnumber['facebookposts'];
        $arr[$user]['facebookengagement'] = ($postnumber['facebookposts'] * $facebookcount) * ($engagement['facebook']['average_engagement']/$facebookcount); 
        $totalfacebookimpressions += $facebookcount * $postnumber['facebookposts'];
        $totalfacebookengagement += $arr[$user]['facebookengagement'];
    }

    //twitter
    if(!$twittercount){
        $arr[$user]['twitterpost'] = 0; 
        $arr[$user]['twitterimpressions'] = 0;
        $arr[$user]['twitterengagement'] = 0;

    }else{
        $arr[$user]['twitterpost'] = $postnumber['twitterposts']; 
        $arr[$user]['twitterimpressions'] = $twittercount * $postnumber['twitterposts'];
        $arr[$user]['twitterengagement'] = ($postnumber['twitterposts'] * $twittercount) * ($engagement['twitter']['average_engagement']/$twittercount); 
        $totaltwitterimpressions += $twittercount * $postnumber['twitterposts'];


    }
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
    $savecampaign = $save->updateCampaignCalculation($arr,$stats,$_POST['campaignid']);
    echo $savecampaign;
    



    function checkNaN($number){
        if(is_nan($number)){
            $number = 0;

        }
        return $number;

        
    }