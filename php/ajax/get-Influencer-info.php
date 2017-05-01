<?php
include 'dbinfo.php';
$influencerId = $_POST['id'];
$stmt = $conn->prepare('SELECT `image_url`,`twitter_count`,`twitter_url`,`twitter_eng`,`facebook_count`,`facebook_url`,`facebook_handle`,`facebook_eng`,`instagram_count`,`instagram_url`,`instagram_eng`,`total`,`tags` WHERE `id` = ?');
$stmt->bind_param('s',$influencerId);
$stmt->execute();
$stmt->bind_result($id,$image,$twittercount,$twitterurl,$twittereng,$facebookcount,$facebookurl,$facebookhandle,$facebookeng,$instagramcount,$instagramurl,$instagrameng,$total,$tags);
$stmt->fetch();
