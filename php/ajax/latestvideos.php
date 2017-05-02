<?php
include '../class/youtubeAPI.php';
$youtubeVideos = new youtubeAPI;
//temp
$youtubeId = 'UCYEK6xds6eo-3tr4xRdflmQ';

$youtubeVideos->getYoutubeVideos($youtubeId);
$videos = $youtubeVideos;
foreach($youtubeVideos->videos as $video){
  echo '<iframe id="ytplayer" type="text/html" width="640" height="360"
  src="https://www.youtube.com/embed/'.$video.'"
  frameborder="0"></iframe>';
}
