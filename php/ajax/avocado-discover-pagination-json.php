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
$engmin = $filters['eng-min'];
$engmax = $filters['eng-max'];
$max = intval($filters['max']);
$min = intval($filters['min']);
$platform = $filters['platform'];
$position = $_POST['page'] * 24;
$users = array();
$where = "";
$rownum = 0;
$arr = array();

if($bio !== NULL) $temparr = checkBio($bio, $searchoptions, $options, $where, $arr);
// if($searchuser !== NULL) $temparr = checkUser($searchuser, $where, $arr);
if($platform !== NULL) $temparr =checkPlatform($min,$max,$engmin,$engmax, $where, $arr,$platform);
$binding = array();
$params = $arr['term'];
if($position < 0) $position = 0;
unset($stmt);


$stmt = $conn->prepare("SELECT `id`, `image_url` , `instagram_count`, `instagram_url`, `twitter_url`, `twitter_count`, `facebook_count`,`facebook_url`,`facebook_handle`,`youtube_url`,`youtube_count`,`engagement` FROM `Influencer_Information` $where LIMIT $position, 24");
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
$stmt->bind_result($id,$image,$instagramcount,$instagramurl,$twitterurl,$twittercount,$facebookcount,$facebookurl, $facebookhandle,$youtubeurl,$youtubecount,$engagement);
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
                setArrayPlatform($jsonarr,$id,'youtube',$youtubeurl,$youtubecount,0,$youtubeurl);
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

         $tags = '`bio` LIKE ? OR `tags` LIKE ? OR `category` LIKE ? OR `sub_category` LIKE ? OR `user` LIKE ? OR `instagram_url` LIKE ? OR `facebook_url` LIKE ? OR `twitter_url` LIKE ? OR `full_name` LIKE ?';
         $arr['term'][] = '%'.$keyword.'%';
         $arr['term'][] = '%'.$keyword.'%';
         $arr['term'][] = '%'.$keyword.'%';
         $arr['term'][] = '%'.$keyword.'%';
         $arr['term'][] = '%'.$keyword.'%';
         $arr['term'][] = '%'.$keyword.'%';
         $arr['term'][] = '%'.$keyword.'%';
         $arr['term'][] = '%'.$keyword.'%';
         $arr['term'][] = '%'.$keyword.'%';


       if(checkWhere($where))
          $where .= "$options ($tags $names) ";
       else
          $where .= "WHERE (($tags $names ) ";

    }
    $where = $where.')';
    return $arr;
}



function checkPlatform($mininstagram,$maxinstagram,$mineng,$maxeng, &$where, &$arr,$platform){
    if(checkWhere($where))
    $where .= 'AND (`'.$platform.'_count` >= ? AND `'.$platform.'_count` <= ?) AND (`'.$platform.'_eng` >= ? AND `'.$platform.'_eng` <= ?)  ORDER BY `'.$platform.'_count` DESC ';
    else
    $where .= 'WHERE (`'.$platform.'_count` >= ? AND `'.$platform.'_count` <= ?) AND (`'.$platform.'_eng` >= ? AND `'.$platform.'_eng` <= ?)  ORDER BY `'.$platform.'_count` DESC ';
    $arr['term'][] = $mininstagram;
    $arr['term'][] = $maxinstagram;
    $arr['term'][] = $mineng;
    $arr['term'][] = $maxeng;
    return $arr;
}




/*function checkUser($user,&$where, &$arr){
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
*/



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
