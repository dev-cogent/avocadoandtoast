<?php


include 'campaign.php';
class saveCampaign extends campaignCalculator{
 

/**
*@param {array} - influencers ids
*@param {string} - userid
*@param {string} - campaign name
*@param {String} - general information database connection
*@param {string} - campaign database connection.
*@return {bool}
*/
public function createSavedCampaign($arr,$userid,$stats,$campaignname = NULL, $description = NULL, $genconn = NULL,$saveconn = NULL){
if($genconn === NULL)
    $genconn = $this->dbinfo();
if($saveconn === NULL)
    $saveconn = $this->savedDB();
if($campaignname == NULL || $campaignname == "")
    $campaignname = 'Campaign Calculator '.time();

#Get the column id
$columnid = $this->getUserColumnID($userid);
#Insert into campaign link
$campaignid = $this->randomString(20);

//Inserting comments into mysql 
$genstmt = $genconn->prepare("INSERT INTO `campaign_save_link` (`campaign_name`,`column_id`,`campaign_id`,`created_date`,`total_instagram_impressions`,`total_twitter_impressions`
,`total_facebook_impressions`,`total_impressions`,`total_instagram_engagement`,`total_twitter_engagement`,`total_facebook_engagement`,`total_engagement`,`total_post`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?) ");
$genstmt->bind_param('ssssiiiiiiiii',$campaignname,$columnid,$campaignid,$stats['created'],$stats['totalinstagramimpressions'],$stats['totaltwitterimpressions'],
$stats['totalfacebookimpressions'],$stats['totalimpressions'],$stats['totalinstagramengagement'],$stats['totaltwitterengagement'],$stats['totalfacebookengagement'],$stats['totalengagement'],$stats['totalposts']);

if($genstmt->execute() === FALSE) return $genstmt->error;


#Now Create table in campaign database.
$camstmt = $saveconn->prepare("
   CREATE TABLE IF NOT EXISTS `$campaignid` (
  `influencer_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL PRIMARY KEY,
  `image_url` varchar(100) COLLATE utf8_unicode_ci  NULL,
  `instagram_post` varchar(10) COLLATE utf8_unicode_ci  NULL,
  `instagram_impressions` varchar(10) COLLATE utf8_unicode_ci  NULL,
  `twitter_post` varchar(10) COLLATE utf8_unicode_ci  NULL,
  `twitter_impressions` varchar(10) COLLATE utf8_unicode_ci  NULL,
  `facebook_post` varchar(10) COLLATE utf8_unicode_ci  NULL,
  `facebook_impressions` varchar(10) COLLATE utf8_unicode_ci  NULL
   ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");

if($camstmt->execute() === false) return false;

foreach($arr as $influencerid => $info){
    $camstmt->prepare("INSERT INTO `$campaignid` (`influencer_id`,`instagram_post`,`instagram_impressions`,`twitter_post`,`twitter_impressions`,`facebook_post`,`facebook_impressions`) VALUES (?,?,?,?,?,?,?)");
    $camstmt->bind_param('sssssss',$influencerid,$info['instagrampost'],$info['instagramimpressions'],$info['twitterpost'],$info['twitterimpressions'],$info['facebookpost'],$info['facebookimpressions']);
        if($camstmt->execute() === false)
            $check = false;
}
if(isset($check)) return false;

return $campaignid;

}



public function updateCampaignCalculations($arr,$userid,$stats,$campaignname,$description,$campaignid,$columnid){
if($genconn === NULL)
    $genconn = $this->dbinfo();
if($saveconn === NULL)
    $saveconn = $this->savedDB();
if($campaignname == NULL || $campaignname == "")
    $campaignname = 'Campaign Calculator '.time();

$check = updateCampaignName($campaignid,$columnid,$campaignname);
if (!$check) return false;

foreach($arr as $influencerid => $info){
    $camstmt->prepare("INSERT INTO `$campaignid` (`influencer_id`,`instagram_post`,`instagram_impressions`,`twitter_post`,`twitter_impressions`,`facebook_post`,`facebook_impressions`) VALUES (?,?,?,?,?,?,?)
    ON DUPLICATE KEY UPDATE
       instagram_id =  VALUES(instagram_post),
       instagram_impressions = VALUES(instagram_impressions),
       twitter_post = VALUES(twitter_post),
       twitter_impressions = VALUES(twitter_impressions),
       facebook_post = VALUES(facebook_post),
       facebook_impressions = VALUES(facebook_impressions)");
    $camstmt->bind_param('sssssss',$influencerid,$info['instagrampost'],$info['instagramimpressions'],$info['twitterpost'],$info['twitterimpressions'],$info['facebookpost'],$info['facebookimpressions']);
        if($camstmt->execute() === false)
            $check = false;
}
$camstmt->prepare("ALTER TABLE `$campaignid` COMMENT = '$stats'");
if(!$camstmt->execute()) return false;


}



public function updateCampaignName($campaignid,$columnid,$campaignname = NULL){
    $conn = $this->dbinfo();
    if($campaignname == NULL || $campaignname == "")
        $campaignname = 'Campaign Calculator '.time();
    $stmt = $conn->prepare("UPDATE `campaign_save_link` SET `campaign_name` = ? WHERE `campaign_id` = ? AND `column_id` = ?");
    $stmt->bind_param('sss',$campaignname,$campaignid,$columnid);
    if($stmt->execute()) return true;
    else return false;
}


public function updateCampaignDescription($campaignid,$columnid,$description = NULL){
    $saveconn = $this->savedDB();
    $stmt = $saveconn->prepare("SELECT table_comment FROM INFORMATION_SCHEMA.TABLES WHERE table_schema='l5o0c8t4_save_campaign' AND table_name='$campaignid'");
    $stmt->execute();
    $stmt->bind_result($comment);
    $stmt->fetch();
    $comment = json_decode($comment,true);
    $comment['description'] = $description;
    $comment = json_encode($comment);
    unset($stmt);
    $stmt->$saveconnprepare("ALTER TABLE `$campaignid` COMMENT = '$stats'");
    if($stmt->execute()) return true;
    else return false;
}



/**
*@About Function to update the campaign, this includes the name, summary, request, start and end date of the campaign
*@param {string} - campaignid
*@param {string} - campaign name 
*@param {string} - campaign summary default NULL
*@param {string} - campaign request  default NULL 
*@param {string} - campaignstart default NULL 
*@param {string} - campaignend default NULL
*@return {bool}
*/
public function updateCampaign($campaignid,$campaignname,$campaigndesc = NULL, $campaignrequest = NULL, $campaignstart = NULL, $campaignend = NULL){
    $conn = $this->dbinfo();
    $saveconn = $this->savedDB();
    //First we will change the name for the campaign name 
    $campaignname = trim($campaignname);
    $stmt = $conn->prepare("UPDATE `campaign_save_link` SET `campaign_name` = ?, `campaign_desc` = ?, `campaign_request` = ?, `start_date` = ?, `end_date` = ?  WHERE `campaign_id` = ?");
    $stmt->bind_param('ssssss',$campaignname,$campaigndesc,$campaignrequest,$campaignstart,$campaignend,$campaignid);
    if($stmt->execute()){
        return true;
    }
    else{
        return false;
    }
}





/**
*
*@return {array} - database connection.
*/
public function savedDB(){
date_default_timezone_set('EST'); # setting timezone
$dbusername ='l5o0c8t4_blaze';
$password = 'Platinum1!';
$db = 'l5o0c8t4_save_campaign';
$servername = '162.144.181.131';
$conn = new mysqli($servername, $dbusername, $password, $db);
$date = new DateTime();
$last_updated = $date->getTimestamp();
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
return $conn;
}



public function getSavedCampaigns($columnid){
    $arr = array();
    $generalconn = $this->dbinfo();
    $listconn = $this->savedDB();
    $stmt = $generalconn->prepare('SELECT `campaign_name`,`campaign_id`,`campaign_desc`,`campaign_request`,`created_date`,`start_date`,`end_date`,`total_impressions`,`total_engagement`,`total_post` FROM `campaign_save_link` WHERE `column_id` = ?');
    $stmt->bind_param('s',$columnid);
    $stmt->execute();
    $stmt->bind_result($campaignname,$campaignid,$campaigndesc,$campaignrequest,$created,$start,$end,$totalimpressions,$totalengagement,$totalpost);
    while($stmt->fetch()){
        $arr[$campaignid]['campaignname'] = $campaignname;
        $arr[$campaignid]['campaignid'] = $campaignid;
        $arr[$campaignid]['description'] = $campaigndesc;
        $arr[$campaignid]['created'] = $created;
        $arr[$campaignid]['totalposts'] = $totalpost;
        $arr[$campaignid]['totalimpressions'] = $totalimpressions;
        $arr[$campaignid]['totalengagement'] = $totalengagement;
        $arr[$campaignid]['campaignstart'] = $start;
        $arr[$campaignid]['campaignend'] = $end;
        $stmt2 = $listconn->prepare("SELECT `influencer_id` FROM $campaignid");
        $stmt2->execute();
        $stmt2->bind_result($influencerid);
        while($stmt2->fetch()){
            $arr[$campaignid]['influencer'][$influencerid] = $influencerid;
        }
    }
    unset($listconn);
    return $arr;
}

 

 public function getCampaign($campaignid, $position = 0, $influencernumber = 30){
    $influencerarr = array();
    $influencertemp = array();
    $infoarr = array();
    $conn = $this->dbinfo();
    $saved = $this->savedDB();
    $stmt = $saved->prepare("SELECT `influencer_id`,`facebook_post`,`instagram_post`,`twitter_post` FROM `$campaignid`");
    $stmt->execute();
    $stmt->bind_result($influencerid,$facebookpost,$instagrampost,$twitterpost);
    while($stmt->fetch()){
        $influencertemp[$influencerid]['facebook_post'] = $facebookpost;
        $influencertemp[$influencerid]['instagram_post'] = $instagrampost;
        $influencertemp[$influencerid]['twitter_post'] = $twitterpost;
        array_push($influencerarr,$influencerid);

    }
    unset($stmt);
    $influencerid = implode("','",$influencerarr);
    $stmt = $conn->prepare("SELECT `id`,`image_url` ,`instagram_count`, `instagram_url`, `twitter_url`, `twitter_count`, `facebook_count`,`facebook_url` FROM `Influencer_Information` WHERE `id` IN ('$influencerid') ORDER BY `total` DESC LIMIT $position, $influencernumber");
    $stmt->execute();
    $stmt->bind_result($id,$image,$instagramcount,$instagramurl,$twitterurl,$twittercount,$facebookcount,$facebookurl);
    while($stmt->fetch()){

        $insthandle = explode('.com/',$instagramurl);
        $insthandle = explode('/',$insthandle[1]);
        $insthandle = explode('?',$insthandle[0]);
        $insthandle = $insthandle[0];
        //Facebook handle
        $facebookhandle = explode('.com/',$facebookurl);
        $facebookhandle = explode('/',$facebookhandle[1]);
        $facebookhandle = explode('?',$facebookhandle[0]);
        $facebookhandle = $facebookhandle[0];
        //twitter handle
        $twitterhandle = explode('.com/',$twitterurl);
        $twitterhandle = explode('/',$twitterhandle[1]);
        $twitterhandle = explode('?',$twitterhandle[0]);
        $twitterhandle = $twitterhandle[0];

        $infoarr['influencer'][$id]['image'] = $image;
        $infoarr['influencer'][$id]['instagram_count'] = $instagramcount;
        $infoarr['influencer'][$id]['instagram_url'] = $instagramurl;
        $infoarr['influencer'][$id]['instagram_handle'] = $insthandle;
        $infoarr['influencer'][$id]['instagram_post'] = $influencertemp[$id]['instagram_post'];
        $infoarr['influencer'][$id]['facebook_count'] = $facebookcount;
        $infoarr['influencer'][$id]['facebook_url'] = $facebookurl;
        $infoarr['influencer'][$id]['facebook_handle'] = $facebookhandle;
        $infoarr['influencer'][$id]['facebook_post'] = $influencertemp[$id]['facebook_post'];
        $infoarr['influencer'][$id]['twitter_count'] = $twittercount;
        $infoarr['influencer'][$id]['twitter_url'] = $twitterurl;
        $infoarr['influencer'][$id]['twitter_handle'] = $twitterhandle;
        $infoarr['influencer'][$id]['twitter_post'] = $influencertemp[$id]['twitter_post'];
    }

    unset($stmt);
    $stmt = $conn->prepare("SELECT `campaign_name` FROM `campaign_save_link` WHERE `campaign_id` = ? ");
    $stmt->bind_param('s',$campaignid);
    $stmt->execute();
    $stmt->bind_result($campaignname);
    $stmt->fetch();
    $infoarr['campaign_name'] = $campaignname;
    unset($stmt);
    $stmt = $saved->prepare("SELECT COUNT(*) FROM `$campaignid`");
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $infoarr['campaign_count'] = $count;
    unset($saved);
    return $infoarr;



 }




public function checkCampaign($campaignid, $columnid){
$conn = $this->dbinfo();
$stmt = $conn->prepare("SELECT `campaign_id` FROM `campaign_save_link` WHERE `campaign_id` = ? AND `column_id` = ?");
$stmt->bind_param('ss',$campaignid,$columnid);
$stmt->execute();
$stmt->bind_result($check);
$stmt->fetch();
if($check === $campaignid)
    return true;
else
    return false;
}
 

public function getCampaignInfo($campaignid){
    $conn = $this->dbinfo();
    $stmt = $conn->prepare('SELECT `campaign_desc`,`campaign_request`,`created_date`,`start_date`,`end_date`,`total_impressions`,`total_engagement`,`total_post` FROM `campaign_save_link` WHERE `campaign_id` = ?');
    $stmt->bind_param('s',$campaignid);
    $stmt->execute();
    $stmt->bind_result($campaigndesc,$campaignrequest,$created,$start,$end,$totalimpressions,$totalengagement,$totalpost);
    while($stmt->fetch()){
        $arr['campaignname'] = $campaignname;
        $arr['campaignid'] = $campaignid;
        $arr['description'] = $campaigndesc;
        $arr['created'] = $created;
        $arr['totalposts'] = $totalpost;
        $arr['totalimpressions'] = $totalimpressions;
        $arr['totalengagement'] = $totalengagement;
        $arr['campaignstart'] = $start;
        $arr['campaignend'] = $end;
    return $arr;

}
}

public function getCampaignName($campaignid){
    $conn = $this->dbinfo();
    $stmt = $conn->prepare("SELECT `campaign_name` FROM `campaign_save_link` WHERE `campaign_id` = ?");
    $stmt->bind_param('s',$campaignid);
    $stmt->execute();
    $stmt->bind_result($campaignname);
    $stmt->fetch();
    unset($stmt);
    return $campaignname;

}


public function deleteCampaign($campaignid,$columnid){
    $conn = $this->dbinfo();
    $saveconn= $this->savedDB();
    $stmt = $conn->prepare("DELETE FROM `campaign_save_link` WHERE `column_id` = ? AND `campaign_id` = ?");
    $stmt->bind_param('ss',$columnid,$campaignid);
    if($stmt->execute()){
        unset($stmt);
        $stmt = $saveconn->prepare("DROP TABLE `$campaignid`");
        if($stmt->execute()){
            return true;
        }
        else return false;
    }
    return false;
}


public function check_in_range($start_date, $end_date)
{
  // Convert to timestamp
  $now = new DateTime();
  $start_ts = strtotime($start_date);
  $end_ts = strtotime($end_date);
  $user_ts = time();

  // Check that user date is between start & end
  return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
}











}
