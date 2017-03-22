<?php
error_reporting(0);
include 'useroptions.php';
class campaignCalculator extends userOptions{



public function instagramCalculate($selectedusers,$posts){
    $conn = $this->dbinfo();
    $i = 0;
    $total;
    $influencersarr = implode("','",$selectedusers);
    $stmt = $conn->prepare("SELECT `id`,`instagram_count`,`engagement` FROM `Influencer_Information` WHERE `id` IN ('$influencersarr') ORDER BY FIELD(`id`, '$influencersarr') ");
    $stmt->execute();
    $stmt->bind_result($id,$count,$engagement);
    while($stmt->fetch()){
        $engagement = json_decode($engagement,true);
        $total +=  $posts[$i] * $count;
        $totalengagement += ($posts[$i] * $count) * ($engagement['instagram']['average_engagement']/$count);
        $arr['influencer'][$id]['impressions'] = $posts[$i] * $count;
        $arr['influencer'][$id]['engagement'] = ($posts[$i] * $count) * ($engagement['instagram']['average_engagement']/$count); 
        $i++;
    }
    $arr['total'] = $total;
    $arr['engagement'] = $totalengagement;
    $arr = json_encode($arr);
    unset($conn);
    return $arr;
}




public function facebookCalculate($selectedusers,$posts){
    $conn = $this->dbinfo();
    $i = 0;
    $total;
    $influencersarr = implode("','",$selectedusers);
    $stmt = $conn->prepare("SELECT `id`,`facebook_count`,`engagement` FROM `Influencer_Information` WHERE `id` IN ('$influencersarr') ORDER BY FIELD(`id`, '$influencersarr') ");
    $stmt->execute();
    $stmt->bind_result($id,$count,$engagement);
    while($stmt->fetch()){
        $engagement = json_decode($engagement,true);
        $total +=  $posts[$i] * $count;
        $totalengagement += ($posts[$i] * $count) * ($engagement['facebook']['average_engagement']/$count);
        $arr['influencer'][$id]['impressions'] = $posts[$i] * $count;
        $arr['influencer'][$id]['engagement'] = ($posts[$i] * $count) * ($engagement['facebook']['average_engagement']/$count); 
        $i++;
    }
    $arr['total'] = $total;
    $arr['engagement'] = $totalengagement;
    $arr = json_encode($arr);
    unset($conn);
    return $arr;
}


public function twitterCalculate($selectedusers,$posts){
    $conn = $this->dbinfo();
    $i = 0;
    $total;
    $influencersarr = implode("','",$selectedusers);
    $stmt = $conn->prepare("SELECT `id`,`twitter_count`,`engagement` FROM `Influencer_Information` WHERE `id` IN ('$influencersarr') ORDER BY FIELD(`id`, '$influencersarr')");
    $stmt->execute();
    $stmt->bind_result($id,$count,$engagement);
    while($stmt->fetch()){
        $engagement = json_decode($engagement,true);
        $total +=  $posts[$i] * $count;
        $engagement = ($posts[$i] * $count) * ($engagement['twitter']['average_engagement']/$count);
        if(is_nan($engagement)) $engagement = 0;
        $totalengagement += $engagement;
        $arr['influencer'][$id]['impressions'] = $posts[$i] * $count;
        $arr['influencer'][$id]['engagement'] = $engagement;
        $i++;

    }
    $arr['total'] = $total;
    $arr['engagement'] = $totalengagement;
    $arr = json_encode($arr);
    unset($conn);
    return $arr;
}



}





