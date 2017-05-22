<?php
$handle = $_POST['youtube_handle'];
include '../class/youtubeAPI.php';
$youtubeVideos = new youtubeAPI;
$youtubeStats = new youtubeAPI;
$youtubeStats->getChannelStats($handle);
$youtubeId = $youtubeStats->basicInfo->channelID;

$youtubeVideos->getYoutubeVideos($youtubeId);
$videos = $youtubeVideos;
$i = 0;
$rowBreak = 0;
foreach($youtubeVideos->videos as $video){
  if($i == 6) break;

  if($rowBreak == 0){
    echo '
    <div class="row m-b-20">';
  }
  echo '
    <div class="col-lg-6">
      <iframe id="ytplayer" type="text/html"
      src="https://www.youtube.com/embed/'.$video.'"
      frameborder="0" style="width:100%; height:400px;"></iframe>
    </div>';

  $rowBreak++;
  if($rowBreak == 2){
    echo '</div>';
    $rowBreak = 0;
  }
  $i++;
}
