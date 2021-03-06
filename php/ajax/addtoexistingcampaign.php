<?php
session_start();
include '../class/addinfluencers.php';
$save = new addInfluencers;
$conn = $save->dbinfo();
$i = 0;
$arr = array();
$selectedusers = json_decode($_POST['info'], true);

foreach ($selectedusers as $user => $postnumber) {
    $stmt = $conn->prepare("SELECT `instagram_count`,`facebook_count`,`twitter_count`,`engagement` FROM `Influencer_Information` WHERE `id` = ?");
    $stmt->bind_param('s', $user);
    $stmt->execute();
    $stmt->bind_result($instagramcount, $facebookcount, $twittercount, $engagement);
    $stmt->fetch();
    $engagement = json_decode($engagement, true);
    $arr[$user]['instagrampost'] = $postnumber['instagramposts'];
    $arr[$user]['instagramimpressions'] =  $instagramcount * $postnumber['instagramposts'];
    $arr[$user]['instagramengagement'] = ($postnumber['instagramposts'] * $instagramcount) * ($engagement['instagram']['average_engagement']/$instagramcount);
    $totalinstagramimpressions += $instagramcount * $postnumber['instagramposts'];
    $totalinstagramengagement += $arr[$user]['instagramengagement'];


    $arr[$user]['facebookpost'] = $postnumber['facebookposts'];
    $arr[$user]['facebookimpressions'] = $facebookcount * $postnumber['facebookposts'];
    $arr[$user]['facebookengagement'] = ($postnumber['facebookposts'] * $facebookcount) * ($engagement['facebook']['average_engagement']/$facebookcount);
    $totalfacebookimpressions += $facebookcount * $postnumber['facebookposts'];
    $totalfacebookengagement += $arr[$user]['facebookengagement'];
    $arr[$user]['twitterpost'] = $postnumber['twitterposts'];
    $arr[$user]['twitterimpressions'] = $twittercount * $postnumber['twitterposts'];
    $arr[$user]['twitterengagement'] = ($postnumber['twitterposts'] * $twittercount) * ($engagement['twitter']['average_engagement']/$twittercount);
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
    $savecampaign = $save->addInfluencersToCampaign($_POST['campaignid'], $arr);
    echo $savecampaign;
