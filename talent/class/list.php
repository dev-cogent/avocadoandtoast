<?php 

include 'useroptions.php';
class listOptions extends userOptions {

/**
*@param {array} - influencers ids 
*@param {string} - userid 
*@param {string} - campaign name 
*@param {String} - general information database connection 
*@param {string} - campaign database connection.
*@return {bool}
*/

public function createList($influencerids,$listname,$listdescription,$userid,$columnid,$generalconn = NULL,$listconn = NULL){
    if($generalconn === NULL)
        $generalconn = $this->dbinfo();
    if($listconn === NULL)
        $listconn = $this->listDB();

    $generalstmt = $generalconn->prepare("SELECT `list_name` FROM `list_link` WHERE `list_name` = ? AND `column_id` = ?");
    $generalstmt->bind_param('ss',$listname,$columnid);
    $generalstmt->execute();
    $generalstmt->bind_result($tempname);
    $generalstmt->fetch();

    if(isset($tempname)) return 'duplicate';
    unset($tempname);
    unset($generalstmt);

    $listid = $this->randomString(20);

    $generalstmt = $generalconn->prepare("INSERT INTO `list_link` (`list_name`,`description`,`column_id`,`list_id`) VALUES (?,?,?,?) ");
    $generalstmt->bind_param('ssss',$listname,$listdescription,$columnid,$listid);
    if($generalstmt->execute() === FALSE)
        return false; 
    unset($generalstmt);
    //Now Create table in campaign database. 

    $liststmt = $listconn->prepare("
    CREATE TABLE IF NOT EXISTS `$listid` (
    `influencer_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL PRIMARY KEY,
    `image_url` varchar(100) COLLATE utf8_unicode_ci  NULL
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
    if($liststmt->execute() === false)  return false;

    if(is_array($influencerids)){
        foreach($influencerids as $influencerid){
        $liststmt = $listconn->prepare("INSERT INTO $listid (`influencer_id`) VALUES (?)");
        $liststmt->bind_param('s',$influencerid);
            if($liststmt->execute() === false) $check = false;
        }
    }
    else{
        $influencerid = $influencerids;
        $liststmt = $listconn->prepare("INSERT INTO $listid (`influencer_id`) VALUES (?)");
        $liststmt->bind_param('s',$influencerid);
        if($liststmt->execute() === false) $check = false; 
    }
    if(!isset($check))  return true;
    else return false; 

}


/**
*@param {string} - userid
*@param {string} - listid
*@param {array} - generalconnection
*@param {array} - listconnection 
*/
public function deleteList($userid,$listid,$generalconn = NULL,$listconn = NULL){
if($generalconn === NULL) $generalconn = $this->dbinfo();
if($listconn === NULL)   $listconn = $this->listDB();

$liststmt->prepare("DROP TABLE $listid");
if($liststmt->execute() === false) return false;

$generalstmt = $generalconn->prepare("DELETE FROM `list_link` WHERE `list_id` = ?");
$generalstmt->bind_param('s',$listid);
if($generalstmt->execute() === false) return false;
else return true; 

}


public function addToList($influencerids,$columnid,$listid,$listconn = NULL){
    if($listconn === NULL) $listconn = $this->listDB();
    if(is_array($influencerids)){
        foreach($influencerids as $id){
            $stmt = $listconn->prepare("INSERT INTO `$listid` (`influencer_id`) VALUES (?)");
            $stmt->bind_param('s',$id);
            if(!$stmt->execute()){
                $failed = true;
                return $stmt->error;
                } 
            } //end of foreach 
    }
   else{
        $influencerid = $influencerids;
        $stmt = $listconn->prepare("INSERT INTO `$listid` (`influencer_id`) VALUES (?)");
        $stmt->bind_param('s',$influencerid);
        if(!$stmt->execute()){
            $failed = true;
            return $stmt->error;
        } 
   }

        if(isset($failed))
            return false;
        else
            return true;
}


public function deleteFromList($influencerids,$listid,$Listconn = NULL){
if($listconn === NULL) $listconn = $this->listDB();
if(is_array($influencerids)){

        foreach($influencerids as $influencerid){
            $stmt = $listconn->prepare("DELETE FROM `$listid` WHERE `influencer_id` = ? ");
            $stmt->bind_param('s',$influencerid);
            if(!$stmt->execute()){
                $failed = true;
                return $stmt->error;
                } 
                unset($stmt);
        } //end of foreach 
        return true;
    }
        else{
           $influencerid = $influencerids;
           $stmt = $listconn->prepare("DELETE FROM `$listid` WHERE `influencer_id` = ? ");
            $stmt->bind_param('s',$influencerid);
            if(!$stmt->execute()){
                $failed = true;
                return $stmt->error;
            }
            else return true; 
   }

   return false;


}


public function getCampaign($columnid,$campaignname){
    $influencers = array();
    $generalconn = $this->dbinfo();
    $listconn = $this->listDB();
    $stmt = $generalconn->prepare("SELECT `list_id` FROM `list_link` WHERE `list_name` = ? AND `column_id` = ? ");
    $stmt->bind_param('ss',$campaignname,$columnid);
    $stmt->execute();
    $stmt->bind_result($listid);
    $stmt->fetch();
    if(!isset($listid)) return false;
    unset($stmt);
    $stmt = $listconn->prepare("SELECT `influencer_id` FROM `$listid` ");
    $stmt->execute();
    $stmt->bind_result($influencerid);
    while($stmt->fetch()){
        array_push($influencers,$influencerid);
    }
    return $influencers;

}



public function getLists($columnid){
    $arr = array();
    $generalconn = $this->dbinfo();
    $listconn = $this->listDB();
    $stmt = $generalconn->prepare('SELECT `list_name`,`list_id` FROM `list_link` WHERE `column_id` = ?');
    $stmt->bind_param('s',$columnid);
    $stmt->execute();
    $stmt->bind_result($listname,$listid);
    while($stmt->fetch()){
        $arr[$listid]['listname'] = $listname;
        $arr[$listid]['listid'] = $listid;
        $stmt2 = $listconn->prepare("SELECT `influencer_id` FROM $listid");
        $stmt2->execute();
        $stmt2->bind_result($influencerid);
        while($stmt2->fetch()){
            $arr[$listid]['influencer'][$influencerid] = $influencerid;
        }

    }
    return $arr;
}


public function getListNames($columnid){
    $arr = array();
    $generalconn = $this->dbinfo();
    $stmt = $generalconn->prepare('SELECT `list_name`,`list_id` FROM `list_link` WHERE `column_id` = ?');
    $stmt->bind_param('s',$columnid);
    $stmt->execute();
    $stmt->bind_result($listname,$listid);
    while($stmt->fetch()){
    $arr[$listid] = $listname;
    }
    return $arr;
}




public function listDB(){
date_default_timezone_set('EST'); # setting timezone
$dbusername ='l5o0c8t4_blaze'; 
$password = 'Platinum1!'; 
$db = 'l5o0c8t4_list'; 
$servername = '162.144.181.131'; 
$conn = new mysqli($servername, $dbusername, $password, $db);
$date = new DateTime();
$last_updated = $date->getTimestamp();
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
return $conn;
}

function updateListSummary($list,$summary){
if($listconn == NULL) 
$listconn = $this->listDB();
$summary = $listconn->real_escape_string($summary);
$stmt = $listconn->prepare("ALTER TABLE `$list` COMMENT = '$summary'");
if($stmt->execute())
return true;
else
return false; 
}



}

?>