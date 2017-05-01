<?php
session_start();
include '../class/savecampaign.php';
$columnid = $_SESSION['column_id'];
$save = new saveCampaign; 
$conn = $save->dbinfo();
$i = 0;
$arr = array();
$selectedusers = $_POST['selectedusers']; 
foreach($selectedusers as $user){
    $stmt = $conn->prepare("SELECT `instagram_count`,`facebook_count`,`twitter_count` FROM `Influencer_Information` WHERE `id` = ?");
    $stmt->bind_param('s',$user);
    $stmt->execute();
    $stmt->bind_result($instagramcount,$facebookcount,$twittercount);
    $stmt->fetch();
    $arr[$user]['instagrampost'] = checkNaN($_POST['instagramposts'][$i]); 
    $arr[$user]['instagramimpressions'] =  checkNaN($instagramcount * $_POST['instagramposts'][$i]);
    $arr[$user]['facebookpost'] = checkNaN($_POST['facebookposts'][$i]); 
    $arr[$user]['facebookimpressions'] = checkNaN($facebookcount * $_POST['facebookposts'][$i]);
    $arr[$user]['twitterpost'] = checkNaN($_POST['twitterposts'][$i]); 
    $arr[$user]['twitterimpressions'] = checkNaN($twittercount * $_POST['twitterposts'][$i]);
    unset($stmt);
    $i++;
}

    $instagramimpression = $save->instagramCalculate($selectedusers,checkNaN($_POST['instagramposts']));
    $twitterimpressions = $save->twitterCalculate($selectedusers,checkNaN($_POST['twitterposts']));
    $facebookimpressions = $save->facebookCalculate($selectedusers,checkNaN($_POST['facebookposts']));
    $stats['totalinstagramimpressions'] = $instagramimpression;
    $stats['totaltwitterimpressions'] = $twitterimpressions;
    $stats['totalfacebookimpressions'] = $facebookimpressions;
    $stats['totalimpressions'] =  $instagramimpression + $twitterimpressions + $facebookimpressions;
    $stats['description'] = $_POST['campaigndescription'];
    $stats = json_encode($stats);
    var_dump($stats);
    $savecampaign = $save->updateCampaignName($arr,$_SESSION['userid'],$stats,$_POST['campaignname'],$columnid);
    var_dump($savecampaign);


    function checkNaN($number){
        if(is_nan($number)){
            $number = 0;

        }
        return $number;

        
    } 