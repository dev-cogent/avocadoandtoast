<?php


//error_reporting(0);
class search{
    public $instagramtoken = "TOKEN HERE";
    public $facebooktoken = 'TOKEN HERE';
    public $settings = array(
        'oauth_access_token'        => "TOKEN HERE",
        'oauth_access_token_secret' => "TOKEN HERE",
        'consumer_key'              => "TOKEN HERE",
        'consumer_secret'           => "TOKEN HERE"
     );

   public function setInstagram($instagram){
        $this->instagramtoken = $instagram;
    }
    public function getInstagram(){
        return $this->instagramtoken;
    }
       public function setFacebook($facebook){
        $this->facebooktoken = $facebook;
    }
    public function getFacebook(){
        return $this->facebooktoken;
    }
       public function setTwitter($settings){
        $this->settings = $settings;
    }
    public function getTwitter(){
        return $this->settings;
    }

function twitter($user){
    $twitterArray[] = array();

    $check = strstr($user, 'twitter.com');
    if($check == true)
    {
    $twittarr = explode('.com/' , $user);
    $twittarr = explode('?', $twittarr[1]);
    $user = str_replace('/','',$twittarr[0]);

    }

    $settings = $this->getTwitter();
    require_once('TwitterAPIExchange.php');
    $ta_url='https://api.twitter.com/1.1/users/show.json';
    $getfield = '?screen_name='.$user;
    $requestMethod = 'GET';
    $twitter = new TwitterAPIExchange($settings);
    $follow_count=$twitter->setGetfield($getfield)
    ->buildOauth($ta_url, $requestMethod)
    ->performRequest();
    $json_twitter = json_decode($follow_count, true);
    $followers = $json_twitter['followers_count'];
    $full_name = $json_twitter['name'];
    $image = $json_twitter['profile_image_url_https'];
    $location = $json_twitter['location'];
    $url = 'https://twitter.com/'.$user;
    $twitterArray[$user]['followers'] = $followers;
    $twitterArray[$user]['full_name'] = $full_name;
    $twitterArray[$user]['profile_pic'] = $image;
    $twitterArray[$user]['location'] = $location;
    $twitterArray[$user]['url'] = $url;
    return $twitterArray;




} // end twitter function

function twitterDataScrape($url, $justfollowers = false){
     if($url == NULL || $url == ""){
     return NULL;
     }
     $twitterarr = explode('.com/', $url);
     $user = $twitterarr[1];
     $user = trim($user);
     $html = file_get_contents('https://twitter.com/'.$user);
     $image = explode ('data-resolved-url-large', $html);
     $image = explode('"', $image[1]);
     $image = $image[1];
     $followers = explode('followers_count', $html);
     $followers = explode(':',$followers[1]);
     $followers = explode(',',$followers[1]);
     $twitterFollowers = $followers[0];
     $twitterinfo['image'] = $image;
     $twitterinfo['followers'] = $twitterFollowers;
     $twitterinfo['url'] = $url;
     if($justfollowers)
     return $twitterFollowers;
     else
     return $twitterinfo;
}

function facebook($url, $justlikes = false ){
    if($url == NULL || $url == ""){
     return NULL;
    }
    $facebooktoken = $this->getFacebook();
    $facebookArray[] = array();
    $arr = explode ('.com/',$url);
    $newarr = array();
    foreach($arr as $it){
        $newString = str_replace('pages/','',$it);
        $newString = str_replace('/','',$newString);
        array_push($newarr,$newString);

    }
    foreach($newarr as $it){
        $meh = false;
        $temp = explode('-', $it);
        foreach($temp as $check){
            if(is_numeric($check)){
                $user= $check;
                $meh = true;
                break;
            }
        }
        if($meh == false){
            foreach($newarr as $it){
                if($it != NULL){
                    $user = $it;
                }
            }
        }
    }

    $json_url_p2 = "https://graph.facebook.com/v2.7/".$user."?access_token=".$facebooktoken;
    $json_p2 = $this->curl($json_url_p2);
    if($json_p2['error']['type'] == "GraphMethodException"){
    return "The users facebook profile has restrictions, and can't be accessed!";
    }
    $p2_id = $json_p2['id'];

    $json_profile_picture = 'https://graph.facebook.com/v2.6/'.$p2_id.'?fields=picture.width(320).height(320)&access_token='.$facebooktoken;
    $json_profile_pic = $this->curl($json_profile_picture);
    $profile_picture = $json_profile_pic['picture']['data']['url'];
    $json_url_p2_profile = 'https://graph.facebook.com/v2.3/'.$p2_id.'?fields=likes,description&access_token='.$facebooktoken;
    $json_p2_new = $this->curl($json_url_p2_profile);
    $facebookLikes = $json_p2_new['likes'];
    $facebookDescription = $json_p2_new['description'];
    $url = 'https://www.facebook.com/'.$user;
    $facebookArray[$user]['likes'] = $facebookLikes;
    $facebookArray[$user]['url'] = $url;
    $facebookArray[$user]['picture'] = $profile_picture;
    $facebookArray[$user]['desc']= $facebookDescription;
    if($justlikes == false)
    return $facebookArray ;
    else
    return $facebookLikes;


} // end facebook function




function instagram ($url, $justfollowers = false) {
    if($url == NULL || $url == "")  return NULL;
    $array[] = array();
    $check = strstr($url, '.com/');
    if($check == true){
    $instarr = explode('.com/', $url);
    $instarr = explode('?',$instarr[1]);
    $user = str_replace('/','',$instarr[0]);
    }
    $quick = strstr($user, '/');
    if($quick == true){
    $user = substr($user, 0, -1);
    }

    $html = $this->instcurl('https://www.instagram.com/'.$user. '/');

    #html contains all the html content of the instagram account.
    #Start getting the followers for the user.
    $data = strstr($html, '"followed_by"'); #we find the word followed_by in the html and continue on from there
    $followers = explode("count", $data); #turn count into an array so it will all be broken up
    $newFollowers = explode(":", $followers[1]); #since it's a mess, we are going to explode it again
    $newFollowers = explode("}", $newFollowers[1]); # and again.
    $followers = $newFollowers[0]; #We now have the follower count in the exact number.
    $array[$user]['followers'] = $followers;
    #Start getting the bio for the user.
    $data = strstr($html, "biography"); #Find the word biography in the data
    $bio = explode("biography", $data); #Turn it into an array
    $newbio = explode('"', $bio[1]);# Turn it into an array again.
    $bio = $newbio[2]; # Now we have the bio.
    $array[$user]['bio'] = $bio;
    #Start getting the full_name
    $data = strstr($html, "full_name"); #Find the word biography in the data
    $full_name = explode("full_name", $data); #same rules apply from above.
    $full_name = explode('"', $full_name[1]);
    $full_name = $full_name[2];
    $array[$user]['full_name'] = $full_name;
    #get the profile picture
    $data = strstr($html, "profile_pic_url");
    $profile_pic = explode("profle_pic_url", $data);
    $profile_pic = explode('"' , $profile_pic[0]);
    $profile_pic = $profile_pic[2];
    $array[$user]['profile_pic'] = $profile_pic;
    $array[$user]['url'] = 'https://www.instagram.com/'.$user;
    if($justfollowers == false)
    return $array;
    else
    return $followers;




}




/**
*@param {string} - url
*@return {array}
*/
function curl($url) {
    $curl_connection = curl_init($url);
    curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
    $json = json_decode(curl_exec($curl_connection), true);
    curl_close($curl_connection);
    return $json;

}


/**
*@param{string} - url
*@about - function to return information when scraping.
*@return {string}
*/
 function instcurl($url){
        $ch = curl_init();  // Initialising cURL
        curl_setopt($ch, CURLOPT_URL, $url);    // Setting cURL's URL option with the $url variable passed into the function
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); // Setting cURL's option to return the webpage data
        $data = curl_exec($ch); // Executing the cURL request and assigning the returned data to the $data variable
        curl_close($ch);    // Closing cURL
        return $data;   // Returning the data from the function

 } // end instcurl




/**
*@param {string} $userurl
*@return {int} subscriber count.
*/
public function youtube($url){
   $user = explode('https://www.youtube.com/user/', $url);

   if($user[1] != NULL){
    $username = $user[1];
    $key ='TOKEN HERE';
    $url = 'https://www.googleapis.com/youtube/v3/channels?key='.$key.'&forUsername='.$username.'&part=id';
   }
   else{
    $user = explode('https://www.youtube.com/channel/', $user[0]);
    $channelID = $user[1];
    $key ='TOKEN HERE';
    $url = 'https://www.googleapis.com/youtube/v3/channels?key='.$key.'&id='.$channelID.'&part=id';
   }
   $json = $this->curl($url);
   $id = $json['items'][0]['id'];
   $url = 'https://www.googleapis.com/youtube/v3/channels?part=statistics&id='.$id.'&key='.$key;
   $json = $this->curl($url);
   $subscriberCount = $json['items'][0]['statistics']['subscriberCount'];
   return $subscriberCount;
}  // end youtube




/**
*@return {array} dbconnection
*/
public function dbinfo(){
    date_default_timezone_set('EST'); # setting timezone
    $dbusername ='DB INFO HERE';
    $password = 'DB INFO HERE';
    $db = 'DB INFO HERE';
    $servername = 'DB INFO HERE';
    $conn = new mysqli($servername, $dbusername, $password, $db);
    $date = new DateTime();
    $last_updated = $date->getTimestamp();
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}






function removeEmoji($text) {
      return preg_replace('/([0-9|#][\x{20E3}])|[\x{00ae}|\x{00a9}|\x{203C}|\x{2047}|\x{2048}|\x{2049}|\x{3030}|\x{303D}|\x{2139}|\x{2122}|\x{3297}|\x{3299}][\x{FE00}-\x{FEFF}]?|[\x{2190}-\x{21FF}][\x{FE00}-\x{FEFF}]?|[\x{2300}-\x{23FF}][\x{FE00}-\x{FEFF}]?|[\x{2460}-\x{24FF}][\x{FE00}-\x{FEFF}]?|[\x{25A0}-\x{25FF}][\x{FE00}-\x{FEFF}]?|[\x{2600}-\x{27BF}][\x{FE00}-\x{FEFF}]?|[\x{2900}-\x{297F}][\x{FE00}-\x{FEFF}]?|[\x{2B00}-\x{2BF0}][\x{FE00}-\x{FEFF}]?|[\x{1F000}-\x{1F6FF}][\x{FE00}-\x{FEFF}]?/u', '', $text);
}


} # end class search




?>
