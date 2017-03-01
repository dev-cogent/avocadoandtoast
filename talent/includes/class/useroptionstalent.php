<?php 
class userOptionsTalent{
/**
*@author Bashir Murtaza Version 1.0 
*@about instagramOptions is mean't to do anything regarding instagram. Mainly getting instagram information. 
*Class
*
*/
    protected $client_id = '72ecc575c986492282e238e6429798e7';
    protected $client_secret ='705ea6ddf42347bb800baa0129b6f31a';
    protected $redirect_uri = 'https://project.social/user/ighandles.php';


    protected function getClientID(){
    $client_id = $this->client_id;
    return $client_id;
    }
    protected function getClientSecret(){
    $client_secret = $this->client_secret;
    return $client_secret;
    }
    protected function getRedirectUrl(){
    $redirect_uri = $this->redirect_uri;
    return $redirect_uri;
    }


/**
*@param {string} - id
*@return {array} $conn
*
*/
public function getNavBarUsers($id,$conn = NULL){
if($conn === NULL)
$conn = $this->dbinfo();
$stmt = $conn->prepare("SELECT `profile_picture`,`username` FROM `user_instagram_information` WHERE `instagram_id` = ?"); //will switch later to the userid
$stmt->bind_param('s',$id);
$stmt->execute();
$stmt->bind_result($profilepicture,$user);
$stmt->fetch();
$arr['profile_picture'] = $profilepicture;
$arr['user'] = $user;
return $arr;
}



/**
*@param {String} $id - instagram id 
*@return {string} $accesstoken - instagram users access token
*/
public function getAccessToken($id, $conn = NULL){
if($conn === NULL)
$conn = $this->dbinfo();
$stmt = $conn->prepare("SELECT `access_token` FROM `user_instagram_information` WHERE `instagram_id` = ?"); //will switch later to the userid
$stmt->bind_param('s',$id);
$stmt->execute();
$stmt->bind_result($accesstoken);
$stmt->fetch();
return $accesstoken;
}

/**
*@param {string} $id - instagram id 
*@param {array} $conn - connection to database optional 
*@return {array} user information. 
*/
public function getBasicInstagramInfoDB($id,$conn = NULL){
if($conn === NULL)
$conn = $this->dbinfo();
$arr = array();
$stmt = $conn->prepare("SELECT `username`,`full_name`,`instagram_id`,`profile_picture`,`access_token`,`bio`,`website`,`media_count`,`follows`,`followed_by` FROM `user_instagram_information` WHERE `instagram_id` = ?"); //will switch later to the userid
$stmt->bind_param('s',$id);
$stmt->execute();
$stmt->bind_result($arr['username'],$arr['full_name'],$arr['instagram_id'],$arr['profile_picture'],$arr['access_token'],$arr['bio'], $arr['website'], $arr['media_count'], $arr['follows'], $arr['followed_by']);
$stmt->fetch();
if(empty($arr))
    return NULL;
else 
    return $arr;
}

/**
*@param {string} $accesstoken - users access token 
*@return {array} $images - returns images in standard resolution with the media id as key. 
*
*/
public function getRecentImages($accesstoken, $maxid = NULL){
$images = array();
if(!isset($accesstoken)){
return NULL;
}
$url = 'https://api.instagram.com/v1/users/self/media/recent/?access_token='.$accesstoken;
$imagesinfo = $this->curl($url);
if(is_array($imagesinfo)){
    foreach($imagesinfo['data'] as $image){
        $id = $image['id'];
        $images[$id] = $image['images']['standard_resolution']['url'];
    }
    return 
        $images;
}

else
    return NULL;
}


/**
*@param {string} $accesstoken - users access token 
*@return {array} $arr - instagram basic inforation 
* - getting the users basic instagram information and returning it in an array
*/
public function getBasicInstagramInfo($accesstoken){
$url = 'https://api.instagram.com/v1/users/self/?access_token='.$accesstoken;
$json = $this->curl($url);
$arr['id'] = $json['data']['id'];
$arr['username'] = $json['data']['username'];
$arr['full_name'] = $json['data']['full_name'];
$arr['profile_picture'] = $json['data']['profile_picture'];
$arr['bio'] = $json['data']['bio'];
$arr['website'] = $json['data']['website'];
$arr['media_count'] = $json['data']['counts']['media'];
$arr['follows'] = $json['data']['counts']['follows'];
$arr['followed_by'] = $json['data']['counts']['followed_by'];
return $arr;
}


/**
*@param {string} $userid - user id 
*@param {array} $conn - connection to the database. 
*@return {array} each instagram account user is connected to. 
*/
public function getInstagramAccounts($userid,$conn = NULL){
if($conn === NULL)
$conn = $this->dbinfo();
$stmt = $conn->prepare("SELECT `instagram_accounts` FROM `login_information` WHERE `userid` = ?");
$stmt->bind_param("s",$userid);
$stmt->execute();
$stmt->bind_result($instagramaccounts);
$stmt->fetch();
if($instagramaccounts === NULL || $instagramaccounts == "")
return NULL;
$instagramaccounts = unserialize($instagramaccounts);
return $instagramaccounts;
}


/**
*@param none
*@return {array} $conn - database connection  
*/
public function dbinfo(){
date_default_timezone_set('EST'); # setting timezone
$dbusername ='l5o0c8t4_blaze'; 
$password = 'Platinum1!'; 
$db = 'l5o0c8t4_talent'; 
$servername = '162.144.181.131'; 
$conn = new mysqli($servername, $dbusername, $password, $db);
$date = new DateTime();
$last_updated = $date->getTimestamp();
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
else{
    return $conn;
}

}


/**
*@param {string} $url - url that needs to be curled
*@return {array} $json json returned from url. 
*/
public function curl($url) {
    $curl_connection = curl_init($url); 
    curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
    $json = json_decode(curl_exec($curl_connection), true); 
    curl_close($curl_connection);
    return $json;     
    
} // end curl 



public function addInstagram($code,$userid){
$url = "https://api.instagram.com/oauth/access_token";
$client_id = $this->getClientID();
$client_secret = $this->getClientSecret();
$redirect_uri = $this->getRedirectUrl();

$access_token_parameters = array(
    'client_id'                =>     $client_id,
    'client_secret'            =>     $client_secret,
    'grant_type'               =>     'authorization_code',
    'redirect_uri'             =>     $redirect_uri,
    'code'                     =>     $code
);

//cant use the curl function because of the access token parameters. 
$curl = curl_init($url);    // we init curl by passing the url
curl_setopt($curl,CURLOPT_POST,true);   // to send a POST request
curl_setopt($curl,CURLOPT_POSTFIELDS,$access_token_parameters);   // indicate the data to send
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);   // to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);   // to stop cURL from verifying the peer's certificate.
$json = json_decode(curl_exec($curl), true);   // to perform the curl session
curl_close($curl);   // to close the curl session_cache_expire
$instagramaccounts = $_SESSION['instagram_accounts'];
$accesstoken = $json['access_token'];
$json = $this->getBasicInstagramInfo($accesstoken);
//We now have the instagram information. Time to add it to the database. 
  if($json['username'] !== NULL || $json['username'] != ""){
    $conn = $this->dbinfo();
    $stmt = $conn->prepare("INSERT INTO `user_instagram_information` (username, full_name, instagram_id, access_token, profile_picture, bio, website, media_count, follows, followed_by) VALUES (?,?,?,?,?,?,?,?,?,?)
    ON DUPLICATE KEY UPDATE 
    `username` = VALUES(username),
    `full_name` = VALUES(full_name),
    `instagram_id` = VALUES(instagram_id),
    `access_token` = VALUES(access_token),
    `profile_picture` = VALUES(profile_picture),
    `bio` = VALUES(bio),
    `website` = VALUES(website),
    `media_count` = VALUES(media_count),
    `follows` = VALUES(follows),
    `followed_by` = VALUES(followed_by)");
    $stmt->bind_param('sssssssiii',$json['username'],$json['full_name'],$json['id'],$accesstoken,$json['profile_picture'],$json['bio'],$json['website'],$json['media_count'],$json['follows'],$json['followed_by']);
    if($stmt->execute()){
        array_push($instagramaccounts,$json['id']);
        $instagramaccounts = array_unique($instagramaccounts);
        $_SESSION['instagram_accounts'] = $instagramaccounts;
        $instagramaccounts = serialize($instagramaccounts);
        $stmt->prepare("UPDATE `login_information` SET `instagram_accounts` = ? WHERE `userid` = ? ");
        $stmt->bind_param('ss',$instagramaccounts,$_SESSION['userid']);
        if($stmt->execute()){
            $instagramconnected = true;
            return true;
        }// end if username
        else
            return false;
    } 
    else
        return false; 
 }
  else
     return false; 

}



public function hashtagMedia($tag ,$conn = NULL){
if($conn == NULL)
$conn = $this->dbinfo();
$url = 'https://api.instagram.com/v1/tags/'.$tag.'/media/recent?count=20&access_token='.$_SESSION['access_token'];
$json = $this->curl($url);
$images = array();

if(is_array($json['data'])){
    foreach($json['data'] as $info){
        $images[$info['id']]['image'] = $info['images']['standard_resolution']['url'];
        $images[$info['id']]['likes'] = $info['likes']['count'];
        $images[$info['id']]['comments'] = $info['comments']['count'];
    }
}
return $images;



}




/**
*
*@param {string} mediaid - the mediaid- or image id 
*@param {string} text - users comment 
*@param {accesstoken} - accesstoken for instagram account 
*@return {bool}
*/
public function addComment($mediaid,$text,$accesstoken){
    $access_token_parameters = array(
    'access_token'  => $accesstoken,
    'text' => $text                        
    );
    $url ='https://api.instagram.com/v1/media/'.$mediaid.'/comments';
    $curl = curl_init($url);    // we init curl by passing the url
    curl_setopt($curl,CURLOPT_POST,true);   // to send a POST request
    curl_setopt($curl,CURLOPT_POSTFIELDS,$access_token_parameters);   // indicate the data to send
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);   // to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);   // to stop cURL from verifying the peer's certificate.
    $json = json_decode(curl_exec($curl), true);   // to perform the curl session
    curl_close($curl);   // to close the curl session_cache_expire

    if($json['meta']['code'] === 200)
        return true;
    else
        return false;
}



/**
*
*@param {string} mediaid - the mediaid- or image id 
*@param {string} text - users comment 
*@param {accesstoken} - accesstoken for instagram account 
*@return {bool}
*/
public function deleteComment($mediaid,$commentid,$accesstoken){
    $url = 'https://api.instagram.com/v1/media/'.$mediaid.'/comments/'.$commentid.'?access_token='.$accesstoken;
    $curl = curl_init($url);    // we init curl by passing the url
    curl_setopt($curl,CURLOPT_POST,true);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);   // to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);   // to stop cURL from verifying the peer's certificate.
    $json = json_decode(curl_exec($curl), true); 
    if($json['meta']['code'] === 200)
        return true;
    else
        return false;
       
}

/**
*
*@param {string} mediaid -  the image or mediaid 
*@param {string} accesstoken - the users accesstoken. 
*@return {bool}
*/
public function likePhoto($mediaid,$accesstoken){
    $access_token_parameters = array(
    'access_token'                =>     $accesstoken,
    );
    $url ='https://api.instagram.com/v1/media/'.$mediaid.'/likes';
    //cant use the curl function because of the access token parameters. 
    $curl = curl_init($url);    // we init curl by passing the url
    curl_setopt($curl,CURLOPT_POST,true);   // to send a POST request
    curl_setopt($curl,CURLOPT_POSTFIELDS,$access_token_parameters);   // indicate the data to send
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);   // to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);   // to stop cURL from verifying the peer's certificate.
    $json = json_decode(curl_exec($curl), true);   // to perform the curl session
    curl_close($curl);   // to close the curl session_cache_expire
    if($json['meta']['code'] === 200)
        return true;
    else 
        return false; 
}



/**
*
*@param {string} mediaid -  the image or mediaid 
*@param {string} accesstoken - the users accesstoken. 
*@return {bool}
*/
public function unlikePhoto($mediaid,$accesstoken){

    $url = 'https://api.instagram.com/v1/media/'.$mediaid.'/likes?access_token='.$accesstoken;
    $curl = curl_init($url);    // we init curl by passing the url
    curl_setopt($curl,CURLOPT_POST,true);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);   // to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);   // to stop cURL from verifying the peer's certificate.
    $json = json_decode(curl_exec($curl), true); 
    if($json['meta']['code'] === 200)
        return true;
    else
        return false; 
}




/**
*@param {string} - user id - the users id 
*
*@param {string} - column id the users campaignid/key 
*
*@param {array} - conn - database connection 
*
*@return {array} - all the users campaigns 
*/
public function getCampaigns($userid,$columnid = NULL, $conn = NULL){
$campaigns = array();
if($columnid === NULL) $columnid = $this->getUserColumnID($userid);
if($conn === NULL) $conn = $this->dbinfo();
$stmt = $conn->prepare("SELECT `list_id`,`list_name` FROM `list_link` WHERE `column_id` = ?");
$stmt->bind_param('s',$columnid);
$stmt->execute();
$stmt->bind_result($campaignid,$campaignname);
while($stmt->fetch()){
 array_push($campaigns,$campaignname);
}

return $campaigns;

}


/**
*@param {string} - user id - the users id 
*
*@param {string} - column id the users campaignid/key 
*
*@param {array} - conn - database connection 
*
*@return {array} - all the users campaigns 
*/
public function getCampaignsWithID($userid,$columnid = NULL, $conn = NULL){
$campaigns = array();
if($columnid === NULL) $columnid = $this->getUserColumnID($userid);
if($conn === NULL) $conn = $this->dbinfo();
$stmt = $conn->prepare("SELECT `list_id`,`list_name` FROM `list_link` WHERE `column_id` = ?");
$stmt->bind_param('s',$columnid);
$stmt->execute();
$stmt->bind_result($campaignid,$campaignname);
while($stmt->fetch()){
 $campaigns[$campaignid] = $campaignname;
}

return $campaigns;

}



/**
*
*@param {string} userid - the users id 
*@return {string} column id - the users campaign id/key
*/
public function getUserColumnID($userid){
$conn = $this->dbinfo();
$genstmt = $conn->prepare("SELECT `column_id` FROM `login_information` WHERE `userid` = ?");
$genstmt->bind_param('s',$userid);
$genstmt->execute();
$genstmt->bind_result($columnid);
$genstmt->fetch();
return $columnid;
}

/**
*@param {int} length of string 
*@return {string} random string 
*/
function randomString($length = 5) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}



public function numberAbbreviation($number) {
        if($number == NULL || $number == 0){
          $number = "0";
          return $number;
        }
        $abbrevs = array(12 => "T", 9 => "b", 6 => "m", 3 => "k", 0 => "");
          foreach($abbrevs as $exponent => $abbrev) {
        if($number >= pow(10, $exponent)) {
            $display_num = $number / pow(10, $exponent);
            $decimals = ($exponent >= 3 && round($display_num) < 100) ? 1 : 0;
            return number_format($display_num,$decimals) . $abbrev;
        }}}






}
?>
