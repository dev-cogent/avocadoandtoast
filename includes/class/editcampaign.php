<?php 
include 'savecampaign.php';
class editCampaign extends saveCampaign{





public function saveUpdatedCampaign($totalstats,$campaignid){
$conn = $this->dbinfo();
$stmt = $conn->prepare("UPDATE `campaign_save_link` SET `total_instagram_impressions` = ?, `total_twitter_impressions` = ?, `total_facebook_impressions` = ?,
                        `total_impressions` = ?, `total_instagram_engagement` = ?, `total_twitter_engagement` = ?, `total_facebook_engagement` = ?, `total_engagement` = ?, `total_post` = ? WHERE `campaign_id` = ?");
$stmt->bind_param('ssssssssss',$totalstats['total_instagram_impressions'],$totalstats['total_twitter_impressions'], $totalstats['total_facebook_impressions'], $totalstats['total_impressions'], $totalstats['total_instagram_engagement'],
                               $totalstats['total_twitter_engagement'],$totalstats['total_facebook_engagement'], $totalstats['total_engagement'], $totalstats['total_post'],$campaignid);  
    if($stmt->execute()){
        unset($conn);
        return true;
    } 
    else{
        unset($conn);    
        return false; 
    }
}

public function removeInfluencers($influencersToRemove,$campaignid){
    $campaignconn = $this->savedDB();
    $influencerstosql = implode("','",$influencersToRemove);
    $stmt = $campaignconn->prepare("DELETE FROM `$campaignid` WHERE `influencer_id` IN ('$influencerstosql') ");
    if($stmt->execute()){
        unset($campaignconn);
        return true;
    } 
    else {
        unset($campaignconn);
        return false; 
    }
}



public function recalculate($campaignid,$influencersToRemove){
    $campaignconn = $this->savedDB();
    $totalstats = $this->getTotalNumbers($campaignid);
    $influencerstosql = implode("','",$influencersToRemove);
    $stmt = $campaignconn->prepare("SELECT `influencer_id`,`instagram_post`,`instagram_impressions`,`instagram_engagement`,`twitter_post`,`twitter_impressions`,`twitter_engagement`,`facebook_post`,`facebook_impressions`,`facebook_engagement` FROM `$campaignid` WHERE `influencer_id` IN ('$influencerstosql')");
    $stmt->execute();
    $stmt->bind_result($id,$instpost,$instimp,$insteng,$twitpost,$twitimp,$twiteng,$facepost,$faceimp,$faceeng);
    
    while($stmt->fetch()){
        $totalInfluencerPost = $instpost + $twitpost + $facepost;
        $totalImpressionsLost = $instimp + $twitimp + $faceimp;
        $totalEngagementLost = $insteng + $twiteng + $faceeng;
        $totalstats['total_instagram_impressions'] -= $instimp;
        $totalstats['total_twitter_impressions'] -= $twitimp;
        $totalstats['total_facebook_impressions'] -= $faceimp;
        $totalstats['total_impressions'] -= $totalImpressionsLost;
        $totalstats['total_instagram_engagement'] -= $insteng;
        $totalstats['total_twitter_engagement'] -= $twiteng;
        $totalstats['total_facebook_engagement'] -= $faceeng;
        $totalstats['total_engagement'] -= $totalEngagementLost;
        $totalstats['total_post'] -= $totalInfluencerPost;
    }
    
 $removeInfluencers = $this->removeInfluencers($influencersToRemove,$campaignid);
 if(!$removeInfluencers) return 'Error. Influencers Could not be removed';
 $updateCampaign = $this->saveUpdatedCampaign($totalstats,$campaignid);
 if(!$updateCampaign) return 'Error. There was a problem saving the camapign';
 else return true;
}



/**
*@param {string} campaignid
*@return {array} total numbers
*/
private function getTotalNumbers($campaignid){
    $totalstats = array();
    $conn = $this->dbinfo();
    $stmt = $conn->prepare("SELECT `total_instagram_impressions`,`total_twitter_impressions`,`total_facebook_impressions`,`total_impressions`,`total_instagram_engagement`,`total_twitter_engagement`,`total_facebook_engagement`,`total_engagement`,`total_post` FROM `campaign_save_link` WHERE `campaign_id` = ?");
    $stmt->bind_param('s',$campaignid);
    $stmt->execute();
    $stmt->bind_result($totalinstimp,$totaltwitimp,$totalfaceimp,$totalimp,$totalinsteng,$totaltwiteng,$totalfaceeng,$totaleng,$totalpost);
    $stmt->fetch();
    $totalstats['total_instagram_impressions'] = $totalinstimp;
    $totalstats['total_twitter_impressions'] = $totaltwitimp;
    $totalstats['total_facebook_impressions'] = $totalfaceimp;
    $totalstats['total_impressions'] = $totalimp;
    $totalstats['total_instagram_engagement'] = $totalinsteng;
    $totalstats['total_twitter_engagement'] = $totaltwiteng;
    $totalstats['total_facebook_engagement'] = $totalfaceeng;
    $totalstats['total_engagement'] = $totaleng;
    $totalstats['total_post'] = $totalpost;
    unset($conn);
    return $totalstats;
}












}