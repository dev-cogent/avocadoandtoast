<?php 
include '../TwitterAPIexchange.php';
$settings = array(
        'oauth_access_token'        => "384983365-gLbEc6hVcsMWQJTuWf207sFRiGBZTk90c0quYuuR",
        'oauth_access_token_secret' => "mVWQuD8o8taJmz0auuembNnl33zeS6TjITTQTChKvSXhK",
        'consumer_key'              => "sVKOtGf2xTT7iHBgC4WJcgHAD",
        'consumer_secret'           => "vgpJcVDEzUR2a4SJ0hjAktHI4qYS9bgXlEhHD5fMUdE8IMIAMK"
     );
$twitterhandle = $_POST['twitter_handle'];
$ta_url='https://api.twitter.com/1.1/statuses/user_timeline.json';  
$getfield = '?screen_name='.$twitterhandle.'&count=10';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
$follow_count=$twitter->setGetfield($getfield)
->buildOauth($ta_url, $requestMethod)
->performRequest(); 
$json_twitter = json_decode($follow_count, true); 
$tweetid = array();
foreach($json_twitter as $tweet){
    array_push($tweetid,$tweet['id']);
}

foreach($tweetid as $id){
$ta_url='https://api.twitter.com/1.1/statuses/oembed.json';  
$getfield = '?id='.$id.'&width=300';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
$follow_count=$twitter->setGetfield($getfield)
->buildOauth($ta_url, $requestMethod)
->performRequest(); 
$json_twitter = json_decode($follow_count, true); 
echo $json_twitter['html'];
}

