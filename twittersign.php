<?php 
require "includes/twitteroauth/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

$CONSUMER_KEY = 'sVKOtGf2xTT7iHBgC4WJcgHAD';
$CONSUMER_SECRET = 'vgpJcVDEzUR2a4SJ0hjAktHI4qYS9bgXlEhHD5fMUdE8IMIAMK';
$OAUTH_CALLBACK = 'http://localhost:8000/twittersign.php';
$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET);
$request_token = $connection->oauth("oauth/request_token", array("oauth_callback" => "http://localhost:8000/twittersign.php"));
var_dump($request_token);
$_SESSION['oauth_token'] = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
$url = $connection->url("oauth/authorize", array("oauth_token" => $request_token['oauth_token']));
var_dump($url);


?>