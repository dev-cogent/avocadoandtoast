<?php

class filters {



public function __construct($filters){
  $bio = $filters['keywords'];

  $options = $filters['options'];
  $searchoptions = $filters['search'];
  $searchuser = $filters['user'];
  $engmin = $filters['eng-min'];
  $engmax = $filters['eng-max'];
  $max = intval($filters['max']);
  $min = intval($filters['min']);
  $platforms = $filters['platform']; //array
  $position = $_POST['page'] * 24;


  $users = array();
  $where = "";
  $rownum = 0;
  $arr = array();
}


function setBioQuery($bio, $searchoptions, $options, &$where, &$arr){

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



protected function dbinfo(){
  date_default_timezone_set('EST'); # setting timezone
  $dbusername ='l5o0c8t4_blaze';
  $password = 'Platinum1!';
  $db = 'l5o0c8t4_General_Information';
  $servername = '162.144.181.131';
  $conn = new mysqli($servername, $dbusername, $password, $db);
  $date = new DateTime();
  $last_updated = $date->getTimestamp();
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
}



}
