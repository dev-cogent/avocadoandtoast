<?php
include '../class/usersettings.php';
$usersettingsobj = new userSettings;
session_start();

if(isset($_POST['comments'])){
$userCommentInfo = $usersettingsobj->curl('https://api.instagram.com/v1/media/'.$_POST['mediaid'].'/comments?access_token='.$_SESSION['accesstoken']);
    foreach($userCommentInfo['data'] as $comment){
        echo'
        <article><img class="img-circle" width="50" height="50" src="'.$comment['from']['profile_picture'].'" 
        alt="..." style="width:25px !important; float:left; margin-right:5px;"> - '.$comment['from']['username'].' - '.$comment['text'].' - '.time_elapsed_string('@'.$comment['created_time']).'</article>
       ';
     }


}

















?>