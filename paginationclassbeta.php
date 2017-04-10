<?php

class influencerPagination{



public function filterInfluencers($filters){
//Declaring all the variables from the filters variable. 
    $jsonarr = new stdClass();
    $binding = array();
    $arr = array();
    
    $position = $filters['page'] * 24;
    if ($position < 0) $position = 0;

    $filters = $filters['filters'];
    $bio = $filters['keywords'];
    $options = $filters['options'];
    $searchoptions = $filters['search'];
    $searchuser = $filters['user'];
    $engmin = $filters['eng-min'];
    $engmax = $filters['eng-max'];
    $max = intval($filters['max']);
    $min = intval($filters['min']);
    $platform = $filters['platform'];
    $where = "";

    
    if (isset($bio)) {
        $temparr = $this->checkBio($bio, $searchoptions, $options, $where, $arr);
    }
    if (isset($searchuser)) {
        $temparr = $this->checkUser($searchuser, $where, $arr);
    }
    if (isset($platform) && $platform == 'total') {
        $temparr = $this->checkTotal($min, $max, $where, $arr);
    }
    if (isset($platform) && $platform == 'instagram') {
        $temparr = $this->checkInstagram($min, $max, $engmin, $engmax, $where, $arr);
    }
    if (isset($platform) && $platform =='twitter') {
        $temparr = $this->checkTwitter($min, $max, $engmin, $engmax, $where, $arr);
    }
    if (isset($platform) && $platform == 'facebook') {
        $temparr = $this->checkFacebook($min, $max, $engmin, $engmax, $where, $arr);
    }
    $info = $this->sortDatabaseQuery($position,$where,$arr);



   
    /*if ($where != '') {
        $types = '';
        foreach ($params as $param) {
            if (is_int($param)) {
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
        call_user_func_array(array($stmt,'bind_param'), makeValuesReferenced($params));
    }*/












}


private function sortDatabaseQuery($position,$where,$arr){
    $conn = $this->dbinfo();
    $params = $arr['term'];
    
    if ($where != '') {
        if (strpos($where, 'ORDER BY') === false) {
            $where.=' ORDER BY `total` DESC ';
        }
    }
    if ($where == '') {
        $default = 'ORDER BY `total` DESC';
    } else {
        $default = '';
    }
     $stmt = $conn->prepare("SELECT `id`, `image_url` , `instagram_count`, `instagram_url`, `twitter_url`, `twitter_count`, `facebook_count`,`facebook_url`,`facebook_handle`,`engagement` FROM `Influencer_Information` $where $default LIMIT $position, 24");
     $influencerinformation = $this->getInfluencerInformation($stmt);
     return $influencerinformation;
}







private function getInfluencerInformation($stmt,$){




}


private function checkWhere($check){
    if($check == '')
        return false;
    else
        return true;
}


private function checkBio($bio, $searchoptions, $options, &$where, &$arr){
    if($options === 'or') $options = 'OR';
    else  $options = 'AND';
    foreach($bio as $keyword){
         $tags = '`bio` LIKE ? OR `tags` LIKE ? OR `category` LIKE ? OR `sub_category` LIKE ?';
         $arr['term'][] = '%'.$keyword.'%';
         $arr['term'][] = '%'.$keyword.'%';
         $arr['term'][] = ''.$keyword.'';
         $arr['term'][] = ''.$keyword.'';
       if($this->checkWhere($where))
          $where .= "$options ($tags $names) ";
       else
          $where .= "WHERE (($tags $names ) ";
    }
    $where = $where.')';
    return $arr;
}


private function checkTotal($mintotal,$maxtotal, &$where, &$arr){
    if(checkWhere($where))
    $where .= 'AND `total` >= ? AND `total` <= ? ';
    else
    $where .= 'WHERE `total` >= ? AND `total` <= ? ';
    $arr['term'][] = $mintotal;
    $arr['term'][] = $maxtotal;
    return $arr;
}

private function checkInstagram($mininstagram,$maxinstagram,$mineng,$maxeng, &$where, &$arr){
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

private function checkTwitter($mintwitter,$maxtwitter, $mineng,$maxeng, &$where, &$arr){
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


private function checkFacebook($minfacebook,$maxfacebook, $mineng,$maxeng, &$where, &$arr){
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


private function checkUser($user,&$where, &$arr){
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





private function makeValuesReferenced($arr){
    $refs = array();
    foreach($arr as $key => $value)
        $refs[$key] = &$arr[$key];
    return $refs;
}





}

