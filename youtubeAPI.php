<?php 

class youtubeAPI{

    protected $youtubeKey = 'AIzaSyAAANUEzxJ9RkLAZOoVxxgP5hrxmrzUOnc';


    protected function getYoutubeAPIKey(){
        return $this->youtubeKey;
    }



    public function getChannelTopicDetails($user){
        $topicDetails = array();
        $key = $this->getYoutubeAPIKey();
        $url = 'https://www.googleapis.com/youtube/v3/channels?part=topicDetails&forUsername='.$user.'&key='.$key;
        echo $url;
        $apiData = $this->curl($url);
        foreach($apiData['items']['topicDetails']['topicCategories'] as $topic){
            array_push($topicDetails,$topic);
        }
        print_r($topicDetails);

    }



    public function getChannelStats($user){
        $basicInfo = new stdClass;
        $key = $this->getYoutubeAPIKey();
        $url = 'https://www.googleapis.com/youtube/v3/channels?part=statistics&forUsername='.$user.'&key='.$key;
        $apiData = $this->curl($url);
        $basicInfo->channelID = $apiData['items'][0]['id'];
        $basicInfo->viewCount = $apiData['items'][0]['viewCount'];
        $basicInfo->commentCount = $apiData['items'][0]['commentCount'];
        $basicInfo->subscriberCount = $apiData['items'][0]['subscriberCount'];
        $basicInfo->videoCount = $apiData['items'][0]['videoCount'];
        return $channelID;
    }

    public function searchInfluencer($user){
        $key = $this->getYoutubeAPIKey();
        
    }




    public function getYoutubeVideos($channelID){
        $videoArr = array();
        $key = $this->getYoutubeAPIKey();
        $url = 'https://www.googleapis.com/youtube/v3/search?part=snippet&channelId='.$channelID.'&maxResults=12&order=date&key='.$key;
        $apiData = $this->curl($url);
        print_r($apiData);
        foreach ($apiData['items'] as $info){
            $videoID = $info['id']['videoId'];
            array_push($videoArr,$videoID);
        }
        //PLEASE REMOVE
        $this->getVideoEngagement($videoArr);
        return $videoArr;
        
    }


    public function getVideoEngagement($videoArr){
        $engagementObj = new stdClass;
        $key = $this->getYoutubeAPIKey();
        if(gettype($videoArr) == 'array' ){
            $videoArr = implode(',',$videoArr);
        }
        $url = 'https://www.googleapis.com/youtube/v3/videos?part=id,statistics&id='.$videoArr.'&key='.$key;
        $apiData = $this->curl($url);
        foreach($apiData['items'] as $key => $info ){
            $videoID = $info['id'];
            $engagementObj->$videoID = new stdClass;
            $engagementObj->$videoID->likes = $info['statistics']['likeCount'] + $info['statistics']['dislikeCount'];
            $engagementObj->$videoID->comments = $info['statistics']['commentCount'];
            $engagementObj->$videoID->total_engagement = $engagementObj->$videoID->likes  + $engagementObj->$videoID->comments;
            $engagementObj->$videoID->avg_engagement = $engagementObj->$videoID->total_engagement/(count($videoArr));
            
        }
        print_r($engagementObj);
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
// $youtube = new youtubeAPI();
// $meh = $youtube->getYoutubeVideos('UCYEK6xds6eo-3tr4xRdflmQ');
//$meh = $youtube->getChannelTopicDetails('biolayne');






