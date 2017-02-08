<?php
include 'includes/class/usermedia.php';
$mediaoptions = new userMedia;
$conn = $mediaoptions->dbinfo();
/*$stmt = $conn->prepare("SELECT `instagram_id`,`access_token` FROM `user_instagram_information`");
$stmt->execute();
$stmt->bind_result($instagramid,$accesstoken);
while($stmt->fetch()){*/
    /*$adddata = $mediaoptions->addData($_SESSION['instagram_id'],$_SESSION['access_token']);
    if($adddata)
        continue;*/
    $findphotos = $mediaoptions->findPhotos($_SESSION['instagram_id'],$_SESSION['access_token']);
    if($findphotos === false){
        //echo 'An error has occured for the user id '.$instagramid;
    }
    $comparecomments = $mediaoptions->compareComments($_SESSION['instagram_id'],$_SESSION['access_token']);

//}

