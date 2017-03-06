<?php

include 'useroptions.php';
class campaignCalculator extends userOptions{



public function instagramCalculate($selectedusers,$posts){
    $conn = $this->dbinfo();
    $i = 0;
    $total;
    $influencersarr = implode("','",$selectedusers);
    $stmt = $conn->prepare("SELECT `instagram_count` FROM `Influencer_Information` WHERE `id` IN ('$influencersarr') ");
    $stmt->execute();
    $stmt->bind_result($count);
    while($stmt->fetch()){
        $total +=  $posts[$i] * $count;
        $i++;
    }
    unset($conn);
    return $total;
}




public function facebookCalculate($selectedusers,$posts){
    $conn = $this->dbinfo();
    $i = 0;
    $total;
    $influencersarr = implode("','",$selectedusers);
    $stmt = $conn->prepare("SELECT `facebook_count` FROM `Influencer_Information` WHERE `id` IN ('$influencersarr') ");
    $stmt->execute();
    $stmt->bind_result($count);
    while($stmt->fetch()){
        $total +=  $posts[$i] * $count;
        $i++;
    }
    unset($conn);
    return $total;
}


public function twitterCalculate($selectedusers,$posts){
    $conn = $this->dbinfo();
    $i = 0;
    $total;
    $influencersarr = implode("','",$selectedusers);
    $stmt = $conn->prepare("SELECT `twitter_count` FROM `Influencer_Information` WHERE `id` IN ('$influencersarr') ");
    $stmt->execute();
    $stmt->bind_result($count);
    while($stmt->fetch()){
        $total +=  $posts[$i] * $count;
        $i++;
    }
    unset($conn);
    return $total;
}



}





