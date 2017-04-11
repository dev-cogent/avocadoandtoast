<?php 

include 'useroptions.php';

class engagementCalculator extends userOptions{





public function calculateEngagement($id,$accesstoken){
$images = $this->getPastImages($id,$accesstoken);
$besthashtag = $this->bestHashtag($images);
foreach($images as $image){
    $arr['engagement'] += $image['total'];
    $arr['likes'] += $image['likes'];
    $arr['comments'] += $image['comments'];

}
$arr['avgengagement'] = $arr['engagement']/10;
$arr['avglikes'] = $arr['likes']/10;
$arr['avgcomments'] = $arr['comments']/10;
$arr['besthashtag'] = $besthashtag;
$arr['besttime'] = $this->bestTime($images);
//$arr['images'] = $images;
return $arr;
}


private function bestHashtag($images){
$temparr = array();
    foreach($images as $image){
        foreach($image['hashtags'] as $hashtag){
            $arr[$hashtag] += $image['total'];

        }
    }
arsort($arr);
foreach($arr as $tag=>$info){
$toptag = $tag;
break;
}
foreach($images as $image){
    foreach($image['hashtags'] as $hashtag){
        if($hashtag === $toptag){
        array_push($temparr, $image['total']);
        }
    }
}
arsort($temparr);
foreach($temparr as $num){
$avgeng += $num;

}
$count = count($temparr);
$avgtopeng = $avgeng/$count; 
$avg['avgengagement'] = $avgtopeng; 
$avg['toptag'] = $toptag;
return $avg;
}



private function getPastImages($id,$accesstoken){
$url = 'https://api.instagram.com/v1/users/self/media/recent/?count=10&access_token='.$accesstoken;
$info = $this->curl($url);
$imageinfo = array();
foreach($info['data'] as $images){
    $mediaid = $images['id'];
    $imageinfo[$mediaid]['image'] = $images['images']['standard_resolution']['url'];
    $imageinfo[$mediaid]['likes'] = $images['likes']['count'];
    $imageinfo[$mediaid]['comments'] = $images['comments']['count'];
    $imageinfo[$mediaid]['hashtags'] = $images['tags'];
    $imageinfo[$mediaid]['total'] = $images['comments']['count'] + $images['likes']['count'];
    $imageinfo[$mediaid]['time'] = $images['created_time'];
    $imageinfo[$mediaid]['daytime'] = $this->getDayTime(getdate($images['created_time']));

    }
return $imageinfo;
}



public function bestTime($images){
    foreach($images as $image){
        $time[$image['daytime']] += $image['total'];
    }
    foreach($time as $time=>$engagement){
    $arr['time'] = $time;
    $arr['engagement'] = $engagement;
    break;
    }
return $arr;
    
}


private function getDayTime($time){
if($time['hours'] > 6 && $time['hours'] < 12)
    $day = 'Morning';
elseif($time['hours'] > 12 && $time['hours'] < 17)
    $day = 'Afternoon';
elseif($time['hours'] > 17 && $time['hours'] < 24)
    $day = 'Evening';
else
    $day = 'Late Night';
return $day;
}








}





























