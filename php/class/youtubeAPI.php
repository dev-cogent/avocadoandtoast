<?php

class youtubeAPI
{

    const  YOUTUBE_API = 'AIzaSyAAANUEzxJ9RkLAZOoVxxgP5hrxmrzUOnc';
    public $username;
    public $channelID;

    function __construct($uName = NULL, $cID = NULL)
    {
        if ($uName == NULL) {
            return 0;
        }
        $this->username = $uName;
        if ($cID === NULL) {
            $this->setChannelID();
        }
        if ($cID === false) {
            return 0; // we'll use false incase you know you'll be getting the username later.
        }
    }


    /**
     * @About Getting the channelID for a specific username.
     * @params NONE
     * @return youtube Channel ID
     */
    public function setChannelID()
    {
        $key = self::YOUTUBE_API;
        $user = $this->username;
        $url = 'https://www.googleapis.com/youtube/v3/channels?part=statistics&forUsername=' . $user . '&key=' . $key;
        $apiData = $this->curl($url);
        $this->channelID = $apiData['items'][0]['id'];

    }

    /**
     * @param $uName
     */
    public function setUsername($uName)
    {
        $this->username = $uName;
    }

    /**
     * @return mixed
     */
    public function getChannelID()
    {
        return $this->channelID;
    }

    /**
     * @return null
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     *
     */
    public function getChannelTopicDetails(){
        $topicDetails = array();
        $key = self::YOUTUBE_API;
        $url = 'https://www.googleapis.com/youtube/v3/channels?part=topicDetails&forUsername=' . $this->username . '&key=' . $key;
        $apiData = $this->curl($url);
        $typeIds = $apiData['items'][0]['topicDetails']['topicIds'];
        $this->getYoutubeTypeId($typeIds);


    }

    /**
     * @about -Getting the users basic stats. This includes their view count, comment count, subscriber count etc.
     * @param $user
     *
     */
    public function getChannelStats($user){
        $basicInfo = new stdClass;
        $key = self::YOUTUBE_API;
        $url = 'https://www.googleapis.com/youtube/v3/channels?part=statistics&forUsername=' . $user . '&key=' . $key;
        $apiData = $this->curl($url);
        $basicInfo->channelID = $apiData['items'][0]['id'];
        $basicInfo->viewCount = $apiData['items'][0]['statistics']['viewCount'];
        $basicInfo->commentCount = $apiData['items'][0]['statistics']['commentCount'];
        $basicInfo->subscriberCount = $apiData['items'][0]['statistics']['subscriberCount'];
        $basicInfo->videoCount = $apiData['items'][0]['statistics']['videoCount'];
        $this->basicInfo = $basicInfo;
    }

    /**
     * @about - searches for users inside the system. Picks the first one as the user you're looking for.
     * @param $user
     *
     */
    public function searchInfluencer($user){
        $key = self::YOUTUBE_API;
        $user = str_replace(' ','',$user);
        $url = 'https://www.googleapis.com/youtube/v3/search?part=snippet&type=channel&q='.$user.'&maxResults=5&key='.$key;
        $apiData = $this->curl($url);
        $this->username = $apiData['items'][0]['snippet']['channelTitle'];
        $this->channelID = $apiData['items'][0]['id']['channelId'];
    }

    /**
     * @return mixed
     */
    public function getYoutubeVideos(){
        $channelID = $this->getChannelID();
        $key = self::YOUTUBE_API;
        $videoArr = array();
        $url = 'https://www.googleapis.com/youtube/v3/search?part=snippet,id&type=video&channelId=' . $channelID . '&maxResults=12&order=date&key=' . $key;
        $apiData = $this->curl($url);
        foreach ($apiData['items'] as $info) {
            $videoID = $info['id']['videoId'];
            array_push($videoArr, $videoID);
        }

        $this->videos = $videoArr;
        $this->totalVideos = count($this->videos);
    }

    /**
     *
     */
    public function getVideoEngagement(){
        if (!$this->videos) {
            $this->getYoutubeVideos();
        }
        $totalLikes = $totalComments = $totalEngagement =  $totalViews = 0;
        $videoArr = $this->videos;

        $key = self::YOUTUBE_API;
        if (gettype($videoArr) == 'array') {
            $videoArr = implode(',', $videoArr);
        }
        $url = 'https://www.googleapis.com/youtube/v3/videos?part=id,statistics&id=' . $videoArr . '&key=' . $key;
        $apiData = $this->curl($url);
        //Send API data to the following function to make the calculation.
        $this->calculateEngagement($apiData);
    }

    /**
     * @param $apiData
     */
    protected function calculateEngagement($apiData){
        $engagementObj = new stdClass;
        $totalLikes = $totalComments = $totalEngagement =  $totalViews = 0;
        foreach ($apiData['items'] as $key => $info) {
            $videoID = $info['id'];
            $engagementObj->$videoID = new stdClass;

            $engagementObj->$videoID->viewCount = $info['statistics']['viewCount'];
            $totalViews += $engagementObj->$videoID->viewCount;

            $engagementObj->$videoID->likes = $info['statistics']['likeCount'] + $info['statistics']['dislikeCount'];
            $totalLikes += $engagementObj->$videoID->likes;

            $engagementObj->$videoID->comments = $info['statistics']['commentCount'];
            $totalComments += $engagementObj->$videoID->comments;

            $engagementObj->$videoID->total = $engagementObj->$videoID->likes + $engagementObj->$videoID->comments;
            $totalEngagement += $engagementObj->$videoID->total;
        }
        $engagementObj->totalComments = $totalComments;
        $engagementObj->totalLikes = $totalLikes;
        $engagementObj->totalEngagement = $totalEngagement;
        $engagementObj->totalViews = $totalViews;
        $engagementObj->avgComments = $totalComments/$this->totalVideos;
        $engagementObj->avgLikes = $totalLikes/$this->totalVideos;
        $engagementObj->avgEngagement = $totalEngagement/$this->totalVideos;
        $engagementObj->avgViews = $totalViews/$this->totalVideos;
        $this->videoEngagement = $engagementObj;

    }

    /**
     * @param $typeIds
     */
    protected function getYoutubeTypeId($typeIds){
        $categories = array();
        foreach($typeIds as $id) {
            $file = file_get_contents('../../assets/files/youtubeTopic.txt');
            $parse = explode($id, $file);
            $parse = explode(',', $parse[1]);
            $category = str_replace(' ', '', $parse[0]);
            array_push($categories,$category);
        }
        $this->categories = $categories;
    }


    public function curl($url) {
        $curl_connection = curl_init($url);
        curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
        $json = json_decode(curl_exec($curl_connection), true);
        curl_close($curl_connection);
        return $json;

    } // end curl


}
//test youtube channel
 $youtube = new youtubeAPI('deadmau5');
$youtube->getChannelTopicDetails();

 //$youtube->getChannelTopicDetails();
 print_r($youtube);
