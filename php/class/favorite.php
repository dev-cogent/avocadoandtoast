<?php
error_reporting(0);
class favorite {



public function addToFavorite($influencers,$userid){
$conn = $this->dbinfo();
$favconn = $this->favoriteDB();
    if(is_array($influencers)){
        foreach($influencers as $influencer){
        $stmt = $favconn->prepare("INSERT INTO `$userid` (`influencer_id`) VALUES (?)");
        $stmt->bind_param('s',$influencer);
        if(!$stmt->execute()) return false;
        else return true;
        }
    }
    else{

        $stmt = $favconn->prepare("INSERT INTO `$userid` (`influencer_id`) VALUES (?)");
        $stmt->bind_param('s',$influencers);
        echo $stmt->error;
        if(!$stmt->execute()) return false;
        else return true;
    }

}


public function getFavorites($userid){
$conn = $this->dbinfo();
$favconn = $this->favoriteDB();
$influencers = array();
$stmt = $favconn->prepare("SELECT `influencer_id` FROM `$userid`");
$stmt->execute();
$stmt->bind_result($influencerid);
while($stmt->fetch()){
    array_push($influencers,$influencerid);
}

return $influencers;

}



/**
*
*
*/
protected function createFavoriteID(){
    return  hash_pbkdf2("sha256", $this->randomString(10), $this->randomString(10), 1000, 20);
}



/**
*@param none
*@return {array} $conn - database connection
*/
public function favoriteDB(){
date_default_timezone_set('EST'); # setting timezone
$dbusername ='USERNAME HERE';
$password = 'PASSWORD';
$db = 'DB NAME';
$servername = 'SERVER NAME OR IP ADDRESS';
$conn = new mysqli($servername, $dbusername, $password, $db);
$date = new DateTime();
$last_updated = $date->getTimestamp();
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
return $conn;
}


public function unFavorite($influencers,$userid){
$conn = $this->dbinfo();
$favconn = $this->favoriteDB();
if(is_array($influencers)){
    foreach($influencers as $influencer){
    $stmt = $favconn->prepare("DELETE FROM `$userid` WHERE `influencer_id` = ?");
    $stmt->bind_param('s',$influencer);
    if(!$stmt->execute()) return false;
    }
}
else{
    $stmt = $favconn->prepare("DELETE FROM `$userid` WHERE `influencer_id` = ?");
    $stmt->bind_param('s',$influencers);
    if(!$stmt->execute()) return false;
    else return true;



}

}

function randomString($length = 5) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}




/**
*@param none
*@return {array} $conn - database connection
*/
public function dbinfo(){
date_default_timezone_set('EST'); # setting timezone
$dbusername ='USERNAME';
$password = 'PASSWORD';
$db = 'DB NAME';
$servername = 'SERVERNAME'; 
$conn = new mysqli($servername, $dbusername, $password, $db);
$date = new DateTime();
$last_updated = $date->getTimestamp();
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
return $conn;
}



/**
*
*
*
*/
public function checkFavorite($influencerid,$favoriteinfluencers){
if(in_array($influencerid,$favoriteinfluencers))
    $html.='<i data-id="'.$influencerid.'" class="unfavorite icon fa-heart" style="font-size:20px" aria-hidden="true"></i>';
else
    $html.='<i data-id="'.$influencerid.'" class="favorite icon fa-heart-o" style="font-size:20px" aria-hidden="true"></i>';

return $html;
}





}
