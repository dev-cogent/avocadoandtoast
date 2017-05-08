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
$platforms = $filters['platform'];
$position = $_POST['page'] * 24;
$users = array();
$where = "";
$rownum = 0;
$arr = array();

if($bio !== NULL) $temparr = checkBio($bio, $searchoptions, $options, $where, $arr);
// if($searchuser !== NULL) $temparr = checkUser($searchuser, $where, $arr);
if($platforms !== NULL) $temparr =checkPlatform($min,$max,$engmin,$engmax, $where, $arr,$platforms);
$binding = array();
$params = $arr['term'];
if($position < 0) $position = 0;
unset($stmt);

$stmt = $conn->prepare("SELECT COUNT(*) FROM `Influencer_Information` $where");
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
$stmt->bind_result($influencerResults);
while($stmt->fetch()){
      $jsonarr = $influencerResults;

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



function checkPlatform($mincount,$maxcount,$mineng,$maxeng, &$where, &$arr,$platforms){
    $i = 1;
    foreach($platforms as $platform){

        $query = '`'.$platform.'_count` >= ? AND `'.$platform.'_count` <= ?) AND (`'.$platform.'_eng` >= ? AND `'.$platform.'_eng` <= ?';
        $arr['term'][] = $mincount;
        $arr['term'][] = $maxcount;
        $arr['term'][] = $mineng;
        $arr['term'][] = $maxeng;

       if(checkWhere($where)){
          if($i == 1){
            $where .= "AND (($query) ";
            $i = 0;
          }else{
            $where .= "AND ($query) ";
          }
       }else{
          $where .= "WHERE (($query) ";
          $i = 0;
       }

    }

    $where = $where.')';
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
