<?php 
include '../getUserInfo.php';
include '../class/usermedia.php';
$useroptionsobj = new userOptions;
$mediaoptions = new userMedia;
$mediaconn = $mediaoptions->mediaDB();
$mediaid = $_POST['mediaid'];
$accesstoken = $_SESSION['access_token'];
$instagramid = $_SESSION['instagram_id'];
$mediastmt = $mediaconn->prepare("SELECT `comments` FROM `$instagramid` WHERE `media_id` = ?");
$mediastmt->bind_param('s',$mediaid);
$mediastmt->execute();
$mediastmt->bind_result($commentsdb);
$mediastmt->fetch();
$commentsdb = json_decode($commentsdb,true);


$url = 'https://api.instagram.com/v1/media/'.$mediaid.'/comments?access_token='.$accesstoken;
$comments  = $useroptionsobj->curl($url);
$arr = array();
foreach ($comments['data'] as $comment){
    $id = $comment['id'];
    if($commentsdb[$id]['read'] === false){
     echo 'THIS HAS NOT BEEN READ YET';
    }
    $arr[$id]['text'] = $comment['text']; 
    $arr[$id]['picture'] = $comment['from']['profile_picture'];
    $arr[$id]['user'] = $comment['from']['username'];
    $arr[$id]['id'] = $id;
    $arr[$id]['displaytext'] = '<div style="padding-bottom:25px;"><article>
        <img class="img-circle" width="50" height="50" src="'.$arr[$id]['picture'].'" alt="..." style=" float:left; margin-right:5px;">
        - <a href="/account.php/'.$arr[$id]['user'].'">'.$arr[$id]['user'].'</a> - '.hashtagBreakdown($comment['text']).' - '.time_elapsed_string('@'.$comment['created_time']).' 
        - <i id="test" class="delete icon fa-trash" data-media= "'.$mediaid.'" data-id="'.$id.'" aria-hidden="true"></i>
        </article></div>
        <br/>';

}
$json = json_encode($arr);
echo $json;


function hashtagBreakdown($text){
  $string ="";
  $textwords = explode(' ',$text);
  foreach($textwords as $word){
    $hashtag = strpos($word,'#');
    $mention = strpos($word, '@');
    if($hashtag !== FALSE){
      $tempword = str_replace('#','',$word);
      $string .= '<a href="/media.php/?tag='.$tempword.'"> '.$word.' </a>';
    }
    elseif($mention !== FALSE){
      $tempword = str_replace('@','',$word);
      $string .= '<a href="/account.php/'.$tempword.'"> '.$word.' </a>';
    }
    else{
    $string .= $word.' ';
    }
  }
  return $string;
}


function time_elapsed_string($datetime, $full = false) {
    date_default_timezone_set('EST');
    $now = new DateTime();
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}