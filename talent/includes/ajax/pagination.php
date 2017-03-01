<?php
include '../dbinfo.php';
include '../numberAbbreviation.php';
$c = 0;
$type = $_POST['type'];
$filters = $_POST['filters'];
$bio = $filters['bio'];
$options = $filters['options'];
$searchoptions = $filters['search'];
$searchuser = $filters['user'];
if(isset($filters['max']) && isset($filters['min']) && isset($filters['platform'])){
    $max = intval($filters['max']);
    $min = intval($filters['min']);
    $platform = $filters['platform'];
}

if(isset($filters['location'])){
    $location = $filters['location'];
}


$num = $_POST['page'];
$position = $num * 32;
$users = array();
$where = '';
$rownum = 0;
$arr = array();
if(isset($bio)) $temparr = checkBio($bio, $searchoptions, $options, $where, $arr);
if(isset($location)) $temparr = checkLocation($location, $where, $arr);
if(isset($searchuser)) $temparr = checkUser($searchuser, $where, $arr);
if(isset($platform) && $platform == 'total') $temparr =checkTotal($min,$max, $where, $arr);
if(isset($platform) && $platform == 'instagram') $temparr =checkInstagram($min,$max, $where, $arr);
if(isset($platform) && $platform =='twitter') $temparr =checkTwitter($min,$max, $where, $arr);
if(isset($platform) && $platform == 'facebook') $temparr =checkFacebook($min,$max, $where, $arr);
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
$stmt = $conn->prepare("SELECT `id`, `user`, `location`, `image_url` , `instagram_count`, `instagram_url`, `twitter_url`, `twitter_count`, `facebook_count`,`facebook_url` FROM `Influencer_Information` $where $default LIMIT $position, 32");
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
$stmt->bind_result($id,$user, $location,$image,$instagramcount,$instagramurl,$twitterurl,$twittercount,$facebookcount,$facebookurl);
$count = 4;
while($stmt->fetch()){

if($type == 'list'){
$html .='
	<!-- Repeat all of this -->
    <div class="border box p-b-25" style="float:left; width:48%;display:flex; justify-content:center;" data-image="'.$image.'" data-id="'.$id.'">

      <div class="pull-left col-lg-11">
         <img class="img-circle influencerpic" src="https://project.social/'.$image.'" style="display:inline;">
         <div class="info" style="display:inline;">
            <div id="name" style="display:inline;">'.$user.'</div>
            <div class="icon-btn" style="margin-right:25%; margin-top:-20px;"><a href="#!" class="btn plus-icon-btn dis-btn"  role="button"   data-id="'.$id.'" data-user="'.$user.'">
                   <i class="icon wb-plus list-icon dis-plus " aria-hidden="true"></i>
                   </a>

                   <a href="#!" class="btn fav-icon-btn dis-" role="button"   data-id="'.$id.'" data-user="'.$user.'">
                         <i class="fa fa-heart dis-fav" aria-hidden="true"></i>
                          </a>
                   </div>

            <div class="location" style="display:none;">'.$location.'</div>
         </div>
      </div>

            <div id="instagram" class="pull-right text-center col-md-5">
                <img src="assets/images/ig_grey.png" style="width:23px; padding-bottom:10%;" alt="instagram-logo">
                <br/>
                <p class="followers">'.numberAbbreviation($instagramcount).'</p>
            </div>

      <div id="facebook" class="pull-right text-center col-md-5">
         <img src="assets/images/fb_grey.png" style="width:23px; padding-bottom:10%;" alt="facebook-logo">
          <br/>
          <p class="followers">'.numberAbbreviation($facebookcount).'</p>
     </div>

      <div id="twitter" class="pull-right text-center col-md-5">
         <img src="assets/images/twitter_grey.png" style="width:23px; padding-bottom:10%;" alt="twitter-logo">
          <br/>
          <p class="followers">'.numberAbbreviation($twittercount).'</p>
     </div>


            <div class="pull-right">
              <div class="pull-right checkmark m-b-10" style="visibility:hidden; margin-top:80%;" data-check="false"></div>
            </div>
     </div>

     <!--end-->';
}
else{
        if($count == 4){
          $html .= '<div class="row card-row">';
          $count = 0;
        }
        $html .= '
         <div class="col-xs-6 col-sm-3">
          <div class="thumbnail add" data-id="'.$id.'" data-image="'.$image.'" data-check="false">
              <img src="http://project.social/'.$image.'" alt="influencer-picture" class="thumbnail-pic">
              <div class="name-info">
                <h5 class="influencer-name"> '.$user.' </h5>
                <h6 class="influencer-location"> '.$location.' </h6>

                  <div class="info">
                    <p class="social-info">



                      <img src="assets/images/ig_grey.png" alt="instagram-logo" class="instagram-logo "> <br>
                      <h7 class="numbers ig-following"> '.number_format($instagramcount).' </h7>

                    </p>

                    <p class="social-info">
                      <img src="assets/images/fb_grey.png" alt="facebook-logo" class="facebook-logo"> <br>
                      <h7 class="numbers fb-following"> '.number_format($facebookcount).' </h7>
                  </p>

                    <p class="social-info">
                      <img src="assets/images/twitter_grey.png" alt="twitter-logo" class="twitter-logo"> <br>
                      <h7 class="numbers twitter-following"> '.number_format($twittercount).' </h7>
                  </p>

                   <p class="icon-btn"><a class="addtolist btn plus-icon-btn" role="button" data-id="'.$id.'" data-user="'.$user.'" data-role="list">
                          <i class="icon wb-plus list-icon" aria-hidden="true"></i>
                          </a>

                    ';
                    if($check == true) $html .= '<a  class="favorite btn fav-icon-btn" role="button"  data-favorite="true"  data-id="'.$id.'" data-user="'.$user.'" style="color:red;">';
                    else $html .= '<a  class="favorite btn fav-icon-btn" role="button"  data-favorite="false"  data-id="'.$id.'" data-user="'.$user.'">';
                    $html .= '       <i class="fa fa-heart" aria-hidden="true"></i>
                                 </a>
                                 
                          </p>
                  </div>
              </div>
          </div>
        </div>';
        $count++;
        if($count == 4){
          $html .= '</div>';
        }
    }
}
echo $html;

function checkBio($bio, $searchoptions, $options, &$where, &$arr){
    if($options === 'or') $options = 'OR';
    else  $options = 'AND';


    $keywords = explode(' ',$bio);

    foreach($keywords as $keyword){
    if(in_array('tags',$searchoptions)){
         $tags = '`bio` LIKE ? OR `tags` LIKE ?';
         $arr['term'][] = '% '.$keyword.'%';
         $arr['term'][] = '%'.$keyword.'%';
    }

    if(in_array('names',$searchoptions)){
        if(isset($tags))
            $names = ' OR `user` LIKE ? ';
        else
            $names =' `user` LIKE ? ';

        $arr['term'][] = '%'.$keyword.'%';

    }
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


function checkInstagram($mininstagram,$maxinstagram, &$where, &$arr){
    if(checkWhere($where))
    $where .= 'AND `instagram_count` >= ? AND `instagram_count` <= ? ORDER BY `instagram_count` DESC ';
    else
    $where .= 'WHERE `instagram_count` >= ? AND `instagram_count` <= ? ORDER BY `instagram_count` DESC ';
    $arr['term'][] = $mininstagram;
    $arr['term'][] = $maxinstagram;
    return $arr;
}


function checkTwitter($mintwitter,$maxtwitter, &$where, &$arr){
    if(checkWhere($where))
    $where .= 'AND `twitter_count` >= ? AND `twitter_count` <= ? ORDER BY `twitter_count` DESC ';
    else
    $where .= 'WHERE `twitter_count` >= ? AND `twitter_count` <= ? ORDER BY `twitter_count` DESC ';
    $arr['term'][] = $mintwitter;
    $arr['term'][] = $maxtwitter;
    return $arr;
}


function checkFacebook($minfacebook,$maxfacebook, &$where, &$arr){
    if(checkWhere($where))
    $where .= 'AND `facebook_count` >= ? AND `facebook_count` <= ? ORDER BY `facebook_count` DESC ';
    else
    $where .= 'WHERE `facebook_count` >= ? AND `facebook_count` <= ? ORDER BY `facebook_count` DESC ';
    $arr['term'][] = $minfacebook;
    $arr['term'][] = $maxfacebook;
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
    $where .= ' AND `user` LIKE ? ';
    else
    $where .= ' WHERE `user` LIKE ? ';
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
