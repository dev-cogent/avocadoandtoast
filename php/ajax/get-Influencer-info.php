<?php
include 'dbinfo.php';
$influencerId = $_POST['id'];
$influencer = new stdClass;
$influencer->facebook = new stdClass;
$influencer->instagram = new stdClass;
$influencer->twitter = new stdClass;

$stmt = $conn->prepare('SELECT `image_url`,`twitter_count`,`twitter_url`,`twitter_eng`,`facebook_count`,`facebook_url`,`facebook_handle`,`facebook_eng`,`instagram_count`,`instagram_url`,`instagram_eng`,`total`,`tags` WHERE `id` = ?');
$stmt->bind_param('s',$influencerId);
$stmt->execute();
$stmt->bind_result($id,$image,$twittercount,$twitterurl,$twittereng,$facebookcount,$facebookurl,$facebookhandle,$facebookeng,$instagramcount,$instagramurl,$instagrameng,$total,$tags);
$stmt->fetch();

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

$influencer->image = $image;
$influencer->instagram->engagement = $instagrameng;
$influencer->instagram->followers = $instagramcount;
$influencer->instagram->handle = $insthandle;
$influencer->instagram->url = $instagramurl;

//facebook
$influencer->facebook->engagement = $facebookeng;
$influencer->facebook->followers = $facebookcount;
$influencer->facebook->handle = $facebookhandle;
$influencer->facebook->url = $facebookurl;


$influencer->twitter->engagement = $twittereng;
$influencer->twitter->followers = $twittercount;
$influencer->twitter->handle = $twitterhandle;
$influencer->twitter->url = $twitterurl;

echo json_encode($influencer);
