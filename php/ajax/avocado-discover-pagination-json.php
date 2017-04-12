<?php
//TODO: CHANGE CHECKBIO TO SEARCH FOR TAGS FROM POSTS WHEN DATABASE IS UPDATED.
error_reporting(0);
include '../dbinfo.php';
include '../numberAbbreviation.php';
$jsonarr = new stdClass();
$type = $_POST['type'];
$filters = $_POST['filters'];
$bio = $filters['keywords'];
$options = $filters['options'];
$searchoptions = $filters['search'];
$searchuser = $filters['user'];

//checking if the user is filtering for followers and / or engagement.
if(isset($filters['max']) && isset($filters['min']) && isset($filters['platform'])){
    $engmin = $filters['eng-min'];
    $engmax = $filters['eng-max'];
    $max = intval($filters['max']);
    $min = intval($filters['min']);
    $platform = $filters['platform'];
}


$position = $_POST['page'] * 24;
$users = array();
$where = "";
$rownum = 0;
$arr = array();
if(isset($bio)) $temparr = checkBio($bio, $searchoptions, $options, $where, $arr);
if(isset($location)) $temparr = checkLocation($location, $where, $arr);
if(isset($searchuser)) $temparr = checkUser($searchuser, $where, $arr);
if(isset($platform) && $platform == 'total') $temparr =checkTotal($min,$max, $where, $arr);
if(isset($platform) && $platform == 'instagram') $temparr =checkInstagram($min,$max,$engmin,$engmax, $where, $arr);
if(isset($platform) && $platform =='twitter') $temparr =checkTwitter($min,$max,$engmin,$engmax, $where, $arr);
if(isset($platform) && $platform == 'facebook') $temparr =checkFacebook($min,$max,$engmin,$engmax, $where, $arr);
$binding = array();
$params = $arr['term'];
if($position < 0) $position = 0;
unset($stmt);
if($where != ''){
    if(strpos($where, 'ORDER BY') === FALSE)
        $where.=' ORDER BY `total` DESC ';
}
if($where == '')
    $default = 'ORDER BY `total` DESC';
else
    $default = '';

$stmt = $conn->prepare("SELECT `id`, `image_url` , `instagram_count`, `instagram_url`, `twitter_url`, `twitter_count`, `facebook_count`,`facebook_url`,`facebook_handle`,`engagement` FROM `Influencer_Information` $where $default LIMIT $position, 24");
if($where != ''){
$types = '';
foreach($params as $param) {
    if(is_int($param)) {
        $types .= 'i';              //integer
    } elseif (is_float($param)) {
        $types .= 'd';              //double
    } elseif (is_string($param)) {
        $types .= 's';              //string
    } else {
        $types .= 'b';              //blob and unknown
    }
}

array_unshift($params, $types);
call_user_func_array(array($stmt,'bind_param'),makeValuesReferenced($params));
}

$stmt->execute();
$stmt->bind_result($id,$image,$instagramcount,$instagramurl,$twitterurl,$twittercount,$facebookcount,$facebookurl, $facebookhandle,$engagement);
$count = 3;
while($stmt->fetch()){
                
                $insthandle = explode('.com/',$instagramurl);
                $insthandle = explode('/',$insthandle[1]);
                $insthandle = explode('?',$insthandle[0]);
                $insthandle = $insthandle[0];
                //Facebook handle
                if($facebookhandle == NULL){
                $facebookhandle = explode('.com/',$facebookurl);
                $facebookhandle = explode('/',$facebookhandle[1]);
                $facebookhandle = explode('?',$facebookhandle[0]);
                $facebookhandle = $facebookhandle[0];
                }
                //twitter handle
                $twitterhandle = explode('.com/',$twitterurl);
                $twitterhandle = explode('/',$twitterhandle[1]);
                $twitterhandle = explode('?',$twitterhandle[0]);
                $twitterhandle = $twitterhandle[0];
                $engagement = json_decode($engagement,true);
                $twitterengagement = number_format((($engagement['twitter']['average_engagement']/$twittercount)*100),2,'.','');
                $instagramengagement = number_format((($engagement['instagram']['average_engagement']/$instagramcount)*100),2,'.','');
                $facebookengagement = number_format((($engagement['facebook']['average_engagement']/$facebookcount)*100),2,'.','');
                $jsonarr->$id = new stdClass;
                //setting instagram information in array 
                setArrayPlatform($jsonarr,$id,'instagram',$insthandle,$instagramcount,$instagramengagement,$instagramurl);
                //setting facebook information in 
                setArrayPlatform($jsonarr,$id,'facebook',$facebookhandle,$facebookcount,$facebookengagement,$facebookurl);
                //setting twitter information 
                setArrayPlatform($jsonarr,$id,'twitter',$twitterhandle,$twittercount,$twitterengagement,$twitterurl);
                //at the end we set the image property 
                $jsonarr->$id->image = $image;
                

    }
$jsonarr = json_encode($jsonarr);
echo $jsonarr;
 





function setArrayPlatform(&$jsonarr,$id,$platform,$handle,$followers,$engagement,$url){
         $jsonarr->$id->$platform = new stdClass();
         $jsonarr->$id->$platform->handle = $handle;
         $jsonarr->$id->$platform->followers = $followers;
         $jsonarr->$id->$platform->url = $url;
         $jsonarr->$id->$platform->engagement = $engagement;
}


function checkBio($bio, $searchoptions, $options, &$where, &$arr){
    if($options === 'or') $options = 'OR';
    else  $options = 'AND';


    foreach($bio as $keyword){

         $tags = '`bio` LIKE ? OR `tags` LIKE ? OR `category` LIKE ? OR `sub_category` LIKE ?';
         $arr['term'][] = '%'.$keyword.'%';
         $arr['term'][] = '%'.$keyword.'%';
         $arr['term'][] = ''.$keyword.'';
         $arr['term'][] = ''.$keyword.'';

    /*if(in_array('names',$searchoptions)){
        if(isset($tags))
            $names = ' OR `user` LIKE ? ';
        else
            $names =' `user` LIKE ? ';

        $arr['term'][] = '%'.$keyword.'%';

    }*/
       if(checkWhere($where))
          $where .= "$options ($tags $names) ";
       else
          $where .= "WHERE (($tags $names ) ";

    }
    $where = $where.')';
    return $arr;
}


function checkTotal($mintotal,$maxtotal, &$where, &$arr){
    if(checkWhere($where))
    $where .= 'AND `total` >= ? AND `total` <= ? ';
    else
    $where .= 'WHERE `total` >= ? AND `total` <= ? ';
    $arr['term'][] = $mintotal;
    $arr['term'][] = $maxtotal;
    return $arr;
}


function checkInstagram($mininstagram,$maxinstagram,$mineng,$maxeng, &$where, &$arr){
    if(checkWhere($where))
    $where .= 'AND (`instagram_count` >= ? AND `instagram_count` <= ?) AND (`instagram_eng` >= ? AND `instagram_eng` <= ?)  ORDER BY `instagram_count` DESC ';
    else
    $where .= 'WHERE (`instagram_count` >= ? AND `instagram_count` <= ?) AND (`instagram_eng` >= ? AND `instagram_eng` <= ?)  ORDER BY `instagram_count` DESC ';
    $arr['term'][] = $mininstagram;
    $arr['term'][] = $maxinstagram;
    $arr['term'][] = $mineng;
    $arr['term'][] = $maxeng;
    return $arr;
}


function checkTwitter($mintwitter,$maxtwitter, $mineng,$maxeng, &$where, &$arr){
    if(checkWhere($where))
    $where .= 'AND (`twitter_count` >= ? AND `twitter_count` <= ?) AND (`twitter_eng` >= ? AND `twitter_eng` <= ?) ORDER BY `twitter_count` DESC ';
    else
    $where .= 'WHERE (`twitter_count` >= ? AND `twitter_count` <= ?) AND (`twitter_eng` >= ? AND `twitter_eng` <= ?)  ORDER BY `twitter_count` DESC ';
    $arr['term'][] = $mintwitter;
    $arr['term'][] = $maxtwitter;
    $arr['term'][] = $mineng;
    $arr['term'][] = $maxeng;
    return $arr;
}


function checkFacebook($minfacebook,$maxfacebook, $mineng,$maxeng, &$where, &$arr){
    if(checkWhere($where))
    $where .= 'AND (`facebook_count` >= ? AND `facebook_count` <= ?) AND (`facebook_eng` >= ? AND `facebook_eng` <= ?) ORDER BY `facebook_count` DESC ';
    else
    $where .= 'WHERE (`facebook_count` >= ? AND `facebook_count` <= ?) AND (`facebook_eng` >= ? AND `facebook_eng` <= ?) ORDER BY `facebook_count` DESC ';
    $arr['term'][] = $minfacebook;
    $arr['term'][] = $maxfacebook;
    $arr['term'][] = $mineng;
    $arr['term'][] = $maxeng;
    return $arr;
}


function checkLocation($location,&$where, &$arr){
    if(checkWhere($where))
    $where .= ' AND `location` LIKE ? ';
    else
    $where .= ' WHERE `location` LIKE ? ';
    $arr['term'][] = '%'.$location.'%';
    return $arr;
}


function checkUser($user,&$where, &$arr){
    if(checkWhere($where))
    $where .= ' AND (`user` LIKE ? OR `instagram_url` LIKE ? OR `facebook_url` LIKE ? OR `twitter_url` LIKE ? OR `full_name` LIKE ? )';
    else
    $where .= ' WHERE `user` LIKE ? OR `instagram_url` LIKE ? OR `facebook_url` LIKE ? OR `twitter_url` LIKE ? OR `full_name` LIKE ? ';
    $arr['term'][] = '%'.$user.'%';
    $arr['term'][] = '%'.$user.'%';
    $arr['term'][] = '%'.$user.'%';
    $arr['term'][] = '%'.$user.'%';
    $arr['term'][] = '%'.$user.'%';
    return $arr;
}




function checkWhere($check){
    if($check == '')
        return false;
    else
        return true;
}


function makeValuesReferenced($arr){
    $refs = array();
    foreach($arr as $key => $value)
        $refs[$key] = &$arr[$key];
    return $refs;
}


?>
