<?php 

include 'useroptions.php';
class userMedia extends userOptions{




/**
*
*@param {string} $instagramid - users instagram id 
*
*@param {string} $accesstoken - users access token 
*
*@return {bool}. If it returns false, then there was an error. 
*
*/
public function compareComments($instagramid,$accesstoken){
$conn = $this->dbinfo();
$media = $this->mediaDB();
$mediastmt = $media->prepare("SELECT `media_id`,`comment_count`,`comments` FROM `$instagramid`");
$mediastmt->execute();
$mediastmt->bind_result($mediaid,$commentcount,$oldcomments);
while($mediastmt->fetch()){

    $commentinfo = $this->curl('https://api.instagram.com/v1/media/'.$mediaid.'/comments?access_token='.$accesstoken);
    $newcomments = $this->jsonComments($commentinfo,true);
    if($oldcomments === $newcomments){
        //continue... 
    }
    else {
        $arr1 = array();
        $arr2 = array();
        $unreadcomments = array();
        
        $oldcomments = json_decode($oldcomments,true);
        $newcomments = json_decode($newcomments,true);

        foreach($oldcomments as $key =>$info){
            array_push($arr1, $key);
        }
        foreach($newcomments as $key =>$info){
            array_push($arr2, $key);
        }

        if(is_array($oldcomments) && is_array($newcomments)){

            $addedcomments = array_diff($arr2,$arr1);
            if(!empty($addedcomments)){
                foreach($newcomments as $commentid=>$info){
                   foreach($addedcomments as $comment){
                       if($comment === $commentid){
                        $unreadcomments[$commentid] = $info;
                        $newcomments[$commentid]['read'] = false;
                       }
                    } 
                }
            //Upload the comments to the db 
            $newcomments = json_encode($newcomments);
            $mediastmt->prepare("UPDATE `$instagramid` SET `comments` = ? WHERE `media_id` = ?");
            $mediastmt->bind_param('ss',$newcomments,$mediaid);
            if($mediastmt->execute()){
                //do nothing and continue.
            } 
            else
                return false;
            }
        }
        else
           return false;        
    }
} //end while loop. 

return true;

}





/**
*Finding users photos and getting all the comments and storing them in the database. 
*
*@param {string} $instagramid - users instagram id 
*
*@param {string} $accesstoken - users access token 
*
*@return {bool, NULL} can return true or false or null. NULL means nothing changed. False means error. 
*/
public function findPhotos($instagramid,$accesstoken){
$conn = $this->dbinfo();
$media = $this->mediaDB();
$mediastmt = $media->prepare("SELECT `media_id` FROM `$instagramid`");
$mediastmt->execute();
$mediastmt->bind_result($mediaid);
$mediaidarr = array();
while($mediastmt->fetch()){
    array_push($mediaidarr,$mediaid);
}
$newmediaidarr = array();
$url = 'https://api.instagram.com/v1/users/'.$instagramid.'/media/recent/?access_token='.$accesstoken;
$json = $this->curl($url);

foreach($json['data'] as $mediaid){
    array_push($newmediaidarr,$mediaid['id']);
}
array_reverse($newmediaidarr); //reverseing it because the old array stored in the database gets uploaded in reverse for some reason
$difference = array_diff($newmediaidarr,$mediaidarr);

if(!empty($difference)){
    //var_dump($difference);
// if there is a difference we will now add them to that users table.
    foreach($difference as $diffmediaid){
        foreach($json['data'] as $mediaid){
            if($mediaid['id'] === $diffmediaid)
                $commentcount = $mediaid['comments']['count'];
            else
                continue;
        }
        $url = 'https://api.instagram.com/v1/media/'.$diffmediaid.'/comments?access_token='.$accesstoken;
        $comments = $this->curl($url);
        $comments = $this->jsonComments($comments,false);
        $mediastmt->prepare("INSERT INTO `$instagramid` (`media_id`,`comment_count`,`comments`) VALUES (?,?,?)");
        $mediastmt->bind_param('sss', $diffmediaid,$commentcount,$comments);
        if(!$mediastmt->execute())
            return false; //means error 
      }
      return true; //means new media added 
    }
 return NULL; // means nothing changed     
}







/**
*
*@param {String} $instagramid - instagram id 
*
*@param {string} $accesstoken - users access token 
*
*@return {bool} true- table created false - table not created. 
*
*
*/
public function addData($instagramid,$accesstoken){
$userids = array();
$media = $this->mediaDB();
$conn = $this->dbinfo();
//Creating the table 
$mediastmt = $media->prepare("CREATE TABLE `$instagramid` (
                             `media_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL PRIMARY KEY,
                             `comment_count` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
                             `comments` varchar(6000) COLLATE utf8_unicode_ci 
                             ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
//if table exist it won't execute and will return false. 
if(!$mediastmt->execute())
    return false;
    
$url = 'https://api.instagram.com/v1/users/'.$instagramid.'/media/recent/?access_token='.$accesstoken;
$json = $this->curl($url);
foreach($json['data'] as $info){
    $comments = array();
    $mediaid = $info['id'];
    $commentcount = $info['comments']['count'];
    $commentinfo = $this->curl('https://api.instagram.com/v1/media/'.$mediaid.'/comments?access_token='.$accesstoken);
    $comments = $this->jsonComments($commentinfo, true);
    $mediastmt->prepare("INSERT INTO `$instagramid` (`media_id`,`comment_count`,`comments`) VALUES (?,?,?)");
    $mediastmt->bind_param('sss', $mediaid,$commentcount,$comments);
    if(!$mediastmt->execute())
        return false;
 }
 return true;
 } // end function. 




/**
*@param {array} $arr is an array of comments 
*
*@param {bool} $read notifies if read is true or false. 
*
*@return {string} json encoded string of an organized array. 
*/
private function jsonComments($arr, $read){
    $comments = array();
    foreach($arr['data'] as $comment){
        $commentuserid = $comment['from']['id'];
        $commentid = $comment['id'];
        $comments[$commentid]['picture'] = $comment['from']['profile_picture'];
        $comments[$commentid]['userid'] = $commentuserid;
        $comments[$commentid]['username'] = $comment['from']['username'];
        $comments[$commentid]['text'] = $comment['text'];
        $comments[$commentid]['read'] = $read;
    }
    return json_encode($comments);
}





/**
*
*@return {array} connection to media db 
*/
public function mediaDB(){
date_default_timezone_set('EST'); # setting timezone
$dbusername ='l5o0c8t4_blaze'; 
$password = 'Platinum1!'; 
$db = 'l5o0c8t4_user_media'; 
$servername = '162.144.181.131'; 
$conn = new mysqli($servername, $dbusername, $password, $db);
$date = new DateTime();
$last_updated = $date->getTimestamp();
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
return $conn;
}


} // end class. 










