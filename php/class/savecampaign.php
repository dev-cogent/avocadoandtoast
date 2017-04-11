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
    return 0;

#Get the column id
$columnid = $this->getUserColumnID($userid);
#Insert into campaign link
$campaignid = $this->randomString(20);

//Inserting comments into mysql 
$genstmt = $genconn->prepare("INSERT INTO `campaign_save_link` (`campaign_name`,`column_id`,`campaign_id`,`created_date`,`total_instagram_impressions`,`total_twitter_impressions`
,`total_facebook_impressions`,`total_impressions`,`total_instagram_engagement`,`total_twitter_engagement`,`total_facebook_engagement`,`total_engagement`,`total_post`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?) ");
$genstmt->bind_param('sssssssssssss',$campaignname,$columnid,$campaignid,$stats['created'],$stats['totalinstagramimpressions'],$stats['totaltwitterimpressions'],
$stats['totalfacebookimpressions'],$stats['totalimpressions'],$stats['totalinstagramengagement'],$stats['totaltwitterengagement'],$stats['totalfacebookengagement'],$stats['totalengagement'],$stats['totalposts']);

if($genstmt->execute() === FALSE) return $genstmt->error;


#Now Create table in campaign database.
$camstmt = $saveconn->prepare("
   CREATE TABLE IF NOT EXISTS `$campaignid` (
  `influencer_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL PRIMARY KEY,
  `image_url` varchar(100) COLLATE utf8_unicode_ci  NULL,
  `instagram_post` varchar(10) COLLATE utf8_unicode_ci  NULL,
  `instagram_impressions` varchar(100) COLLATE utf8_unicode_ci  NULL,
  `instagram_engagement` varchar(100) COLLATE utf8_unicode_ci  NULL,
  `twitter_post` varchar(10) COLLATE utf8_unicode_ci  NULL,
  `twitter_impressions` varchar(100) COLLATE utf8_unicode_ci  NULL,
  `twitter_engagement` varchar(100) COLLATE utf8_unicode_ci  NULL,
  `facebook_post` varchar(10) COLLATE utf8_unicode_ci  NULL,
  `facebook_impressions` varchar(100) COLLATE utf8_unicode_ci  NULL,
  `facebook_engagement` varchar(100) COLLATE utf8_unicode_ci  NULL
   ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");

if($camstmt->execute() === false) return false;

foreach($arr as $influencerid => $info){
    $camstmt->prepare("INSERT INTO `$campaignid` (`influencer_id`,`instagram_post`,`instagram_impressions`,`instagram_engagement`,`twitter_post`,`twitter_impressions`,`twitter_engagement`,`facebook_post`,`facebook_impressions`,`facebook_engagement`) VALUES (?,?,?,?,?,?,?,?,?,?)");
    $camstmt->bind_param('ssssssssss',$influencerid,$info['instagrampost'],$info['instagramimpressions'],$info['instagramengagement'],$info['twitterpost'],$info['twitterimpressions'],$info['twitterengagement'],$info['facebookpost'],$info['facebookimpressions'],$info['facebookengagement']);
        if($camstmt->execute() === false)
            $check = false;
}
if(isset($check)) return false;

return $campaignid;

}


/**
*@param {array} - influencers ids
*@param {string} - userid
*@param {string} - campaign name
*@param {String} - general information database connection
*@param {string} - campaign database connection.
*@return {bool}
*/
public function updateCampaignCalculation($arr,$stats,$campaignid){
error_reporting(-1);
$genconn = $this->dbinfo();
$saveconn = $this->savedDB();
#Get the column id
foreach($arr as $influencerid => $info){
    $camstmt = $saveconn->prepare("UPDATE `$campaignid` SET
    `instagram_post` = ?,
    `instagram_impressions` = ?,
    `instagram_engagement` = ?,
    `twitter_post` = ?,
    `twitter_impressions` = ?,
    `twitter_engagement` = ?,
    `facebook_post` = ?,
    `facebook_impressions` = ?,
    `facebook_engagement` = ? 
     WHERE `influencer_id` = ?");
     $camstmt->bind_param('ssssssssss',$info['instagrampost'],$info['instagramimpressions'],$info['instagramengagement'],$info['twitterpost'],$info['twitterimpressions'],$info['twitterengagement'],$info['facebookpost'],$info['facebookimpressions'],$info['facebookengagement'],$influencerid);
        if($camstmt->execute() === false)
              $check = false;
    unset($camstmt);
}


$stmt = $genconn->prepare("UPDATE `campaign_save_link` SET
                           `total_instagram_impressions` = ?, 
                           `total_twitter_impressions` = ?,
                           `total_facebook_impressions` = ?,
                           `total_impressions` = ?,
                           `total_instagram_engagement` = ?,
                           `total_twitter_engagement` = ?,
                           `total_facebook_engagement` = ?,
                           `total_engagement` = ?,
                           `total_post` = ?
                            WHERE `campaign_id` = ?");
$stmt->bind_param('ssssssssis', $stats['totalinstagramimpressions'],$stats['totaltwitterimpressions'],$stats['totalfacebookimpressions'],$stats['totalimpressions'],$stats['totalinstagramengagement'],$stats['totaltwitterengagement'],$stats['totalfacebookengagement'],$stats['totalengagement'],$stats['totalposts'],$campaignid);
$stmt->execute();
return true;

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
public function updateCampaign($campaignid,$campaignname,$brandname,$campaigndesc = NULL, $campaignrequest = NULL, $campaignstart = NULL, $campaignend = NULL){
    $conn = $this->dbinfo();
    $saveconn = $this->savedDB();
    //First we will change the name for the campaign name 
    $campaignname = trim($campaignname);
    $stmt = $conn->prepare("UPDATE `campaign_save_link` SET `campaign_name` = ?, `brand_name` = ?, `campaign_desc` = ?, `campaign_request` = ?, `start_date` = ?, `end_date` = ?  WHERE `campaign_id` = ?");
    $stmt->bind_param('sssssss',$campaignname,$brandname,$campaigndesc,$campaignrequest,$campaignstart,$campaignend,$campaignid);
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
    $stmt = $saved->prepare("SELECT l5o0c8t4_save_campaign.$campaignid.influencer_id, l5o0c8t4_save_campaign.$campaignid.facebook_post,l5o0c8t4_save_campaign.$campaignid.instagram_post,l5o0c8t4_save_campaign.$campaignid.twitter_post,
                                    l5o0c8t4_save_campaign.$campaignid.instagram_impressions,l5o0c8t4_save_campaign.$campaignid.facebook_impressions,l5o0c8t4_save_campaign.$campaignid.twitter_impressions,
                                    l5o0c8t4_save_campaign.$campaignid.instagram_engagement,l5o0c8t4_save_campaign.$campaignid.facebook_engagement,l5o0c8t4_save_campaign.$campaignid.twitter_engagement,
                                    l5o0c8t4_General_Information.Influencer_Information.image_url, l5o0c8t4_General_Information.Influencer_Information.instagram_count, l5o0c8t4_General_Information.Influencer_Information.instagram_url,
                                    l5o0c8t4_General_Information.Influencer_Information.twitter_url,l5o0c8t4_General_Information.Influencer_Information.twitter_count, l5o0c8t4_General_Information.Influencer_Information.facebook_count,l5o0c8t4_General_Information.Influencer_Information.facebook_url,
                                    l5o0c8t4_General_Information.Influencer_Information.engagement FROM l5o0c8t4_save_campaign.$campaignid INNER JOIN l5o0c8t4_General_Information.Influencer_Information
                                    ON l5o0c8t4_save_campaign.$campaignid.influencer_id = l5o0c8t4_General_Information.Influencer_Information.id
                                    ORDER BY  l5o0c8t4_General_Information.Influencer_Information.total DESC LIMIT $position, $influencernumber");
    $stmt->execute();
    $stmt->bind_result($id,$facebookpost,$instagrampost,$twitterpost,$instagramimpressions,$facebookimpressions,$twitterimpressions,$instagramengagement,$facebookengagement,$twitterengagement,$image,$instagramcount,$instagramurl,$twitterurl,$twittercount,$facebookcount,$facebookurl,$engagement);
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
        $engagement = json_decode($engagement,true);
        $infoarr['influencer'][$id]['image'] = $image;
        $infoarr['influencer'][$id]['instagram_count'] = $instagramcount;
        $infoarr['influencer'][$id]['instagram_url'] = $instagramurl;
        $infoarr['influencer'][$id]['instagram_handle'] = $insthandle;
        $infoarr['influencer'][$id]['instagram_post'] = $instagrampost;
        $infoarr['influencer'][$id]['instagram_impressions'] = $instagramimpressions;
        $infoarr['influencer'][$id]['instagram_engagement'] = $instagramengagement;
        $infoarr['influencer'][$id]['facebook_count'] = $facebookcount;
        $infoarr['influencer'][$id]['facebook_url'] = $facebookurl;
        $infoarr['influencer'][$id]['facebook_handle'] = $facebookhandle;
        $infoarr['influencer'][$id]['facebook_post'] = $facebookpost;
        $infoarr['influencer'][$id]['facebook_impressions'] = $facebookimpressions;
        $infoarr['influencer'][$id]['facebook_engagement'] = $facebookengagement;
        $infoarr['influencer'][$id]['twitter_count'] = $twittercount;
        $infoarr['influencer'][$id]['twitter_url'] = $twitterurl;
        $infoarr['influencer'][$id]['twitter_handle'] = $twitterhandle;
        $infoarr['influencer'][$id]['twitter_post'] = $twitterpost;
        $infoarr['influencer'][$id]['twitter_impressions'] = $twitterimpressions;
        $infoarr['influencer'][$id]['twitter_engagement'] = $twitterengagement;
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
    error_reporting(-1);
    $conn = $this->dbinfo();
    $stmt = $conn->prepare('SELECT `campaign_name`,`campaign_desc`,`campaign_request`,`created_date`,`start_date`,`end_date`,`brand_name`,`total_instagram_impressions`,`total_twitter_impressions`,`total_facebook_impressions`,`total_impressions`,`total_instagram_engagement`,`total_twitter_engagement`,`total_facebook_engagement`,`total_engagement`,`total_post` FROM `campaign_save_link` WHERE `campaign_id` = ?');
    $stmt->bind_param('s',$campaignid);
    $stmt->execute();
    $stmt->bind_result($campaignname,$campaigndesc,$campaignrequest,$created,$start,$end,$brandname, $instimp,$twitimp,$faceimp,$totalimpressions,$insteng,$twiteng,$faceeng,$totalengagement,$totalpost);
    while($stmt->fetch()){
        $arr['campaignname'] = $campaignname;
        $arr['campaignrequest'] = $campaignrequest;
        $arr['campaignid'] = $campaignid;
        $arr['description'] = $campaigndesc;
        $arr['created'] = $created;
        $arr['brandname'] = $brandname;
        $arr['totalposts'] = $totalpost;
        $arr['total_instagram_impressions'] = $instimp;
        $arr['total_facebook_impressions'] = $faceimp;
        $arr['total_twitter_impressions'] = $twitimp;
        $arr['totalimpressions'] = $totalimpressions;
        $arr['total_instagram_engagement'] = $insteng;
        $arr['total_facebook_engagement'] = $faceeng;
        $arr['total_twitter_engagement'] = $twiteng;
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
