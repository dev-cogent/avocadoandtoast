<?php
//TODO: CHANGE CHECKBIO TO SEARCH FOR TAGS FROM POSTS WHEN DATABASE IS UPDATED.
error_reporting(0);
include '../dbinfo.php';
include '../numberAbbreviation.php';
$c = 0;
$type = $_POST['type'];
$filters = $_POST['filters'];
$bio = $filters['keywords'];
$options = $filters['options'];
$searchoptions = $filters['search'];
$searchuser = $filters['user'];
if(isset($filters['max']) && isset($filters['min']) && isset($filters['platform'])){
    $engmin = $filters['eng-min'];
    $engmax = $filters['eng-max'];
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

$stmt = $conn->prepare("SELECT `id`, `image_url` , `instagram_count`, `instagram_url`, `twitter_url`, `twitter_count`, `facebook_count`,`facebook_url`,`facebook_handle`,`engagement` FROM `Influencer_Information` $where $default LIMIT $position, 32");
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
    echo '<div  class="influencer-box col-xs-12 col-md-6 col-lg-4 col-xl-3">
                            <div class="influencer-card-discover">
                                <a href="/profile.php?id='.$id.'"><img class="influencer-image-card" src="http://cogenttools.com/'.$image.'" onerror="this.src=`/assets/images/default-photo.png/`"></a>
                                <div class="col-xs-12 influ-bottom" style="height:170px; " data-id="'.$id.'">
                                    <!-- insthandle stuff -->
                                        <div class="icons col-xs-12">';

                                        if(strpos($where,'instagram_count') !== FALSE){
                                            echo checkDisplayInstagram($instagramurl,$id,true);
                                            echo checkDisplayFacebook($facebookurl,$id,false);
                                            echo checkDisplayTwitter($twitterurl,$id,false);
                                            buildCard('instagram',$id,$insthandle,$instagramcount,$instagramengagement,$facebookhandle,$facebookcount,$facebookengagement,$twitterhandle,$twittercount,$twitterengagement);
                                        }
                                        elseif(strpos($where,'facebook_count') !== FALSE){
                                            echo checkDisplayInstagram($instagramurl,$id,false);
                                            echo checkDisplayFacebook($facebookurl,$id,true);
                                            echo checkDisplayTwitter($twitterurl,$id,false);
                                            buildCard('facebook',$id,$insthandle,$instagramcount,$instagramengagement,$facebookhandle,$facebookcount,$facebookengagement,$twitterhandle,$twittercount,$twitterengagement);
                                        }

                                        elseif(strpos($where,'twitter_count') !== FALSE){
                                            echo checkDisplayInstagram($instagramurl,$id,false);
                                            echo checkDisplayFacebook($facebookurl,$id,false);
                                            echo checkDisplayTwitter($twitterurl,$id,true);
                                            buildCard('twitter',$id,$insthandle,$instagramcount,$instagramengagement,$facebookhandle,$facebookcount,$facebookengagement,$twitterhandle,$twittercount,$twitterengagement);
                                        }
                                        else{
                                            echo checkDisplayAll($instagramurl,$facebookurl,$twitterurl,$id);
                                            buildCardAll($id,$instagramurl,$insthandle,$instagramcount,$instagramengagement,$facebookurl,$facebookhandle,$facebookcount,$facebookengagement,$twitterurl,$twitterhandle,$twittercount,$twitterengagement);
                                        }

        $count++;
    }

echo $html;

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

function checkDisplayInstagram($url,$id, $filtered){
if($url == NULL || $url == '') return '<a> <i class="switch show-instagram inst-icon icon bd-instagram" data-id="'.$id.'" data-platform="instagram" style="display:none;" aria-hidden="true"></i></a>';
if(!$filtered) return '<a> <i class="switch show-instagram inst-icon icon bd-instagram" data-id="'.$id.'" data-platform="instagram" aria-hidden="true"></i></a>';
else return '<a> <i class="switch show-instagram inst-icon icon bd-instagram" data-id="'.$id.'" data-platform="instagram" aria-hidden="true"  style="color:#73C48D"></i></a>';
}

function checkDisplayFacebook($url,$id,$filtered){
if($url == NULL || $url == '') return '<a> <i class="switch show-facebook inst-icon icon bd-facebook" data-id="'.$id.'" data-platform="facebook" style="display:none;" aria-hidden="true"></i></a>';
if(!$filtered) return '<a> <i class="switch show-facebook inst-icon icon bd-facebook" data-id="'.$id.'" data-platform="facebook" aria-hidden="true" ></i></a>';
else return '<a> <i class="switch show-facebook inst-icon icon bd-facebook" data-id="'.$id.'" data-platform="facebook" aria-hidden="true" style="color:#73C48D"></i></a>';
}


function checkDisplayTwitter($url,$id,$filtered){
if($url == NULL || $url == '') return '<a> <i class="switch show-twitter inst-icon icon bd-twitter" data-id="'.$id.'" data-platform="twitter" aria-hidden="true" style="display:none;"></i></a>';
if(!$filtered)return '<a> <i class="switch show-twitter inst-icon icon bd-twitter" data-id="'.$id.'" data-platform="twitter" aria-hidden="true"></i></a>';
else return '<a> <i class="switch show-twitter inst-icon icon bd-twitter" data-id="'.$id.'" data-platform="twitter" aria-hidden="true" style="color:#73C48D"></i></a>';
}


function buildCard($platform,$id,$insthandle,$instagramcount,$instagramengagement,$facebookhandle,$facebookcount,$facebookengagement,$twitterhandle,$twittercount,$twitterengagement){
        if($platform == 'instagram'){
            echo '
                </div>
                <div class="col-xs-12 insthandle-info">
                <!--icon here -->
                <p class="instagram-handle insthandle-text" data-id="'.$id.'">'.$insthandle.'</p>
                <p class="facebook-handle insthandle-text" data-id="'.$id.'" style="display:none;">'.$facebookhandle.'</p>
                <p class="twitter-handle insthandle-text" data-id="'.$id.'" style="display:none;">'.$twitterhandle.'</p>
                </div>
                <!-- followers -->
                <div class="col-xs-12">
                <p class="instagram-follower-count follower-count" data-id="'.$id.'">'.numberAbbreviation($instagramcount).' Followers</p>
                <p class="facebook-follower-count follower-count" style="display:none" data-id="'.$id.'">'.numberAbbreviation($facebookcount).' Likes</p>
                <p class="twitter-follower-count follower-count" style="display:none" data-id="'.$id.'">'.numberAbbreviation($twittercount).' Followers</p>
                    </div>
                    <!-- Engagement ?-->
                    <div class="col-xs-12">
                            <p class="instagram-engagement engagement-count" data-id="'.$id.'">'.$instagramengagement.'% eng post</p>
                            <p class="facebook-engagement engagement-count" style="display:none"data-id="'.$id.'">'.$facebookengagement.'% eng post</p>
                            <p class="twitter-engagement engagement-count" style="display:none"data-id="'.$id.'">'.$twitterengagement.'% eng per post</p>
                    </div>
                    <div class="col-xs-12">
                            <div style="display:inline;"class="col-xs-12 invite avocado-focus" data-id="'.$id.'" data-image="images/'.$id.'.jpg"></div>
                        </div>
                    </div>
                </div>
        </div>
        <!-- Influencer box has ended -->';

        }
        if($platform == 'facebook'){
        echo '
            </div>
            <div class="col-xs-12 insthandle-info">
            <!--icon here -->     
            <p class="instagram-handle insthandle-text" data-id="'.$id.'" style="display:none;">'.$insthandle.'</p>
            <p class="facebook-handle insthandle-text" data-id="'.$id.'">'.$facebookhandle.'</p>
            <p class="twitter-handle insthandle-text" data-id="'.$id.'" style="display:none;">'.$twitterhandle.'</p>
            </div>
            <!-- followers -->
            <div class="col-xs-12">
            <p class="instagram-follower-count follower-count" data-id="'.$id.'" style="display:none">'.numberAbbreviation($instagramcount).' Followers</p>
            <p class="facebook-follower-count follower-count"  data-id="'.$id.'">'.numberAbbreviation($facebookcount).' Likes</p>
            <p class="twitter-follower-count follower-count" style="display:none" data-id="'.$id.'">'.numberAbbreviation($twittercount).' Followers</p>
            </div>
            <!-- Engagement ?-->
            <div class="col-xs-12">
                    <p class="instagram-engagement engagement-count" data-id="'.$id.'" style="display:none;">'.$instagramengagement.'% eng post</p>
                    <p class="facebook-engagement engagement-count" data-id="'.$id.'">'.$facebookengagement.'% eng post</p>
                    <p class="twitter-engagement engagement-count" style="display:none"data-id="'.$id.'">'.$twitterengagement.'% eng per post</p>
                </div>
                <div class="col-xs-12">
                    <div style="display:inline;"class="col-xs-12 invite avocado-focus" data-id="'.$id.'" data-image="images/'.$id.'.jpg"></div>
                </div>
                        </div>
                    </div>
            </div>
            <!-- Influencer box has ended -->';
        }
        if($platform == 'twitter'){
            echo '
                </div>
                <div class="col-xs-12 insthandle-info">
                <!--icon here -->
                <p class="instagram-handle insthandle-text" data-id="'.$id.'" style="display:none;">'.$insthandle.'</p>
                <p class="facebook-handle insthandle-text" data-id="'.$id.'" style="display:none;">'.$facebookhandle.'</p>
                <p class="twitter-handle insthandle-text" data-id="'.$id.'">'.$twitterhandle.'</p>
                </div>
                <!-- followers -->
                <div class="col-xs-12">
                <p class="instagram-follower-count follower-count" data-id="'.$id.'" style="display:none">'.numberAbbreviation($instagramcount).' Followers</p>
                <p class="facebook-follower-count follower-count"  data-id="'.$id.'" style="display:none">'.numberAbbreviation($facebookcount).' Likes</p>
                <p class="twitter-follower-count follower-count"  data-id="'.$id.'">'.numberAbbreviation($twittercount).' Followers</p>
                </div>
                    <!-- Engagement ?-->
                    <div class="col-xs-12">
                        <p class="instagram-engagement engagement-count" data-id="'.$id.'">'.$instagramengagement.'% eng post</p>
                        <p class="facebook-engagement engagement-count" style="display:none"data-id="'.$id.'">'.$facebookengagement.'% eng post</p>
                        <p class="twitter-engagement engagement-count" style="display:none"data-id="'.$id.'">'.$twitterengagement.'% eng per post</p>
                    </div>
                    <div class="col-xs-12">
                        <div style="display:inline;"class="col-xs-12 invite avocado-focus" data-id="'.$id.'" data-image="images/'.$id.'.jpg"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Influencer box has ended -->';
    }
}


function buildCardAll($id,$instagramurl,$insthandle,$instagramcount,$instagramengagement,$facebookurl,$facebookhandle,$facebookcount,$facebookengagement,$twitterurl,$twitterhandle,$twittercount,$twitterengagement){
                    echo '
                    </div>
                    <div class="col-xs-12 insthandle-info">
                        <!--icon here -->';
                                if($instagramurl  != NULL){
                                    echo '<p class="instagram-handle insthandle-text" data-id="'.$id.'">'.$insthandle.'</p>
                                        <p class="facebook-handle insthandle-text" data-id="'.$id.'" style="display:none;">'.$facebookhandle.'</p>
                                        <p class="twitter-handle insthandle-text" data-id="'.$id.'" style="display:none;">'.$twitterhandle.'</p>
                                        </div>
                                    <!-- followers -->
                                    <div class="col-xs-12">
                                    <p class="instagram-follower-count follower-count" data-id="'.$id.'">'.numberAbbreviation($instagramcount).' Followers</p>
                                    <p class="facebook-follower-count follower-count" style="display:none" data-id="'.$id.'">'.numberAbbreviation($facebookcount).' Likes</p>
                                    <p class="twitter-follower-count follower-count" style="display:none" data-id="'.$id.'">'.numberAbbreviation($twittercount).' Followers</p>
                                    </div>
                                        <!-- Engagement ?-->
                                        <div class="col-xs-12">
                                            <p class="instagram-engagement engagement-count" data-id="'.$id.'">'.$instagramengagement.'% eng post</p>
                                            <p class="facebook-engagement engagement-count" style="display:none"data-id="'.$id.'">'.$facebookengagement.'% eng post</p>
                                            <p class="twitter-engagement engagement-count" style="display:none"data-id="'.$id.'">'.$twitterengagement.'% eng per post</p>
                                        </div>
                                        <div class="col-xs-12">
                                            <div style="display:inline;"class="col-xs-12 invite avocado-focus" data-id="'.$id.'" data-image="images/'.$id.'.jpg"></div>
                                        </div>
                                        </div>
                                        </div>
                                    </div>
                                    <!-- Influencer box has ended -->';
                                }
                                elseif($facebookurl != NULL){
                                    echo '<p class="instagram-handle insthandle-text" data-id="'.$id.'" style="display:none;">'.$insthandle.'</p>
                                        <p class="facebook-handle insthandle-text" data-id="'.$id.'">'.$facebookhandle.'</p>
                                        <p class="twitter-handle insthandle-text" data-id="'.$id.'" style="display:none;">'.$twitterhandle.'</p>
                                        </div>
                                        <!-- followers -->
                                        <div class="col-xs-12">  
                                        <p class="instagram-follower-count follower-count" data-id="'.$id.'" style="display:none">'.numberAbbreviation($instagramcount).' Followers</p>
                                        <p class="facebook-follower-count follower-count"  data-id="'.$id.'">'.numberAbbreviation($facebookcount).' Likes</p>
                                        <p class="twitter-follower-count follower-count" style="display:none" data-id="'.$id.'">'.numberAbbreviation($twittercount).' Followers</p>  
                                        </div>
                                                <!-- Engagement ?-->
                                                <div class="col-xs-12">
                                                    <p class="instagram-engagement engagement-count" data-id="'.$id.'" style="display:none;">'.$instagramengagement.'% eng post</p>
                                                    <p class="facebook-engagement engagement-count" data-id="'.$id.'">'.$facebookengagement.'% eng post</p>
                                                    <p class="twitter-engagement engagement-count" style="display:none"data-id="'.$id.'">'.$twitterengagement.'% eng per post</p>
                                                </div>
                                                <div class="col-xs-12">

                                                    <div style="display:inline;"class="col-xs-12 invite avocado-focus" data-id="'.$id.'" data-image="images/'.$id.'.jpg"></div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <!-- Influencer box has ended -->   
                                        
                                        ';
                                }
                                elseif($twitterurl != NULL){
                                    echo '<p class="instagram-handle insthandle-text" data-id="'.$id.'" style="display:none;">'.$insthandle.'</p>
                                        <p class="facebook-handle insthandle-text" data-id="'.$id.'" style="display:none;">'.$facebookhandle.'</p>
                                        <p class="twitter-handle insthandle-text" data-id="'.$id.'">'.$twitterhandle.'</p>
                                        </div>
                                        <!-- followers -->
                                        <div class="col-xs-12">                
                                        <p class="instagram-follower-count follower-count" data-id="'.$id.'" style="display:none">'.numberAbbreviation($instagramcount).' Followers</p>
                                        <p class="facebook-follower-count follower-count"  data-id="'.$id.'" style="display:none">'.numberAbbreviation($facebookcount).' Likes</p>
                                        <p class="twitter-follower-count follower-count"  data-id="'.$id.'">'.numberAbbreviation($twittercount).' Followers</p>                              
                                        </div>
                                                        <!-- Engagement ?-->
                                                        <div class="col-xs-12">
                                                            <p class="instagram-engagement engagement-count" data-id="'.$id.'" style="display:none;">'.$instagramengagement.'% eng post</p>
                                                            <p class="facebook-engagement engagement-count" style="display:none"data-id="'.$id.'">'.$facebookengagement.'% eng post</p>
                                                            <p class="twitter-engagement engagement-count"  data-id="'.$id.'">'.$twitterengagement.'% eng per post</p>
                                                        </div>
                                                        <div class="col-xs-12">
                                                            <div style="display:inline;"class="col-xs-12 invite avocado-focus" data-id="'.$id.'" data-image="images/'.$id.'.jpg"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                        <!-- Influencer box has ended -->';
                                }

}


function checkDisplayAll($instagramurl,$facebookurl,$twitterurl,$id){
$html ='';
if($instagramurl == NULL || $instagramurl == ''){
    $html .= '<a> <i class="switch show-instagram inst-icon icon bd-instagram" data-id="'.$id.'" data-platform="instagram" style="display:none;" aria-hidden="true"></i></a>';
}
else{
    $html .='<a> <i class="switch show-instagram inst-icon icon bd-instagram" data-id="'.$id.'" data-platform="instagram" aria-hidden="true"  style="color:#73C48D"></i></a>';
}


//For facebook
if($facebookurl == NULL || $facebookurl == ''){
    $html .= '<a> <i class="switch show-facebook inst-icon icon bd-facebook" data-id="'.$id.'" data-platform="facebook" style="display:none;" aria-hidden="true"></i></a>';
}
elseif($instagramurl == NULL || $instagramurl == '' && $facebookurl != NULL){
    $html .= '<a> <i class="switch show-facebook inst-icon icon bd-facebook" data-id="'.$id.'" data-platform="facebook" aria-hidden="true" style="color:#73C48D"></i></a>';
}
else {
    $html .= '<a> <i class="switch show-facebook inst-icon icon bd-facebook" data-id="'.$id.'" data-platform="facebook" aria-hidden="true"></i></a>';
}

if($twitterurl == NULL || $twitterurl == ''){
    $html .= '<a> <i class="switch show-twitter inst-icon icon bd-twitter" data-id="'.$id.'" data-platform="twitter" aria-hidden="true" style="display:none;"></i></a>';
}
elseif((($facebookurl == NULL || $facebookurl) == '' && ($twitterurl == NULL || $twitterurl == '')) && ($twitterurl != NULL || $twitterurl !== '') ){
    $html .= '<a> <i class="switch show-twitter inst-icon icon bd-twitter" data-id="'.$id.'" data-platform="twitter" aria-hidden="true" style="color:#73C48D"></i></a>';
}
else{
    $html .= '<a> <i class="switch show-twitter inst-icon icon bd-twitter" data-id="'.$id.'" data-platform="twitter" aria-hidden="true"></i></a>';
}

return $html;


}
?>
