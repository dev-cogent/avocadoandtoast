<?php
error_reporting(0);
//TODO: CHANGE CHECKBIO TO SEARCH FOR TAGS FROM POSTS WHEN DATABASE IS UPDATED.
include '../class/savecampaign.php';
include '../numberAbbreviation.php';
$save = new saveCampaign;
$conn = $save->savedDB();
$campaignid = $_POST['campaignid'];
$position = $_POST['page'] * 30;
$influencerinfo = $save->getCampaign($campaignid,$position);
                foreach($influencerinfo['influencer'] as $influencerid => $info){
                $id = $influencerid;
                $instagramurl = $info['instagram_url'];
                $facebookurl = $info['facebook_url'];
                $twitterurl = $info['twitter_url'];
                $insthandle = $info['instagram_handle'];
                $facebookhandle = $info['facebook_handle'];
                $twitterhandle = $info['twitter_handle'];
                $insthandle = $info['instagram_handle'];
                $instagramcount = $info['instagram_count'];
                $facebookcount = $info['facebook_count'];
                $twittercount = $info['twitter_count'];
                echo '
                    <div  class="influencer-box col-xs-12 col-md-6 col-lg-3 col-xl-2">
                            <div class="influencer-card-discover">
                                <img class="influencer-image-card" src="https://project.social/'.$info['image'].'">
                                <div class="col-xs-12" style="height:170px;">
                                    <!-- insthandle stuff -->
                                        <div class="icons col-xs-12">';

                                            echo checkDisplayAll($instagramurl,$facebookurl,$twitterurl,$id);
                                        
                                        echo '
                                        </div>
                                        <div class="col-xs-12 insthandle-info">';
                                            if($instagramurl != NULL){
                                                echo '<p class="instagram-handle insthandle-text" data-id="'.$id.'">'.$insthandle.'</p>
                                                      <p class="facebook-handle insthandle-text" data-id="'.$id.'" style="display:none;">'.$facebookhandle.'</p>
                                                      <p class="twitter-handle insthandle-text" data-id="'.$id.'" style="display:none;">'.$twitterhandle.'</p>';
                                            }
                                            elseif($facebookurl != NULL && $instagramurl == NULL){
                                                echo '<p class="instagram-handle insthandle-text" data-id="'.$id.'" style="display:none;">'.$insthandle.'</p>
                                                      <p class="facebook-handle insthandle-text" data-id="'.$id.'">'.$facebookhandle.'</p>
                                                      <p class="twitter-handle insthandle-text" data-id="'.$id.'" style="display:none;">'.$twitterhandle.'</p>';
                                            }
                                            elseif($twitterurl != NULL && $facebookurl == NULL && $instagramurl == NULL){
                                                echo '<p class="instagram-handle insthandle-text" data-id="'.$id.'" style="display:none;">'.$insthandle.'</p>
                                                      <p class="facebook-handle insthandle-text" data-id="'.$id.'" style="display:none;">'.$facebookhandle.'</p>
                                                      <p class="twitter-handle insthandle-text" data-id="'.$id.'">'.$twitterhandle.'</p>';
                                            }

                                            echo '
                                            </div>
                                    <!-- followers -->
                                    <div class="col-xs-12">';
                                    
                                        if($instagramurl != NULL){
                                            echo '
                                        <p class="instagram-follower-count follower-count" data-id="'.$id.'">'.numberAbbreviation($instagramcount).' Followers</p>
                                        <p class="facebook-follower-count follower-count" style="display:none" data-id="'.$id.'">'.numberAbbreviation($facebookcount).' Likes</p>
                                        <p class="twitter-follower-count follower-count" style="display:none" data-id="'.$id.'">'.numberAbbreviation($twittercount).' Followers</p>
                                        ';
                                        }
                                        elseif($facebookurl != NULL && $instagramurl == NULL){
                                            echo '
                                        <p class="instagram-follower-count follower-count" data-id="'.$id.'" style="display:none">'.numberAbbreviation($instagramcount).' Followers</p>
                                        <p class="facebook-follower-count follower-count"  data-id="'.$id.'">'.numberAbbreviation($facebookcount).' Likes</p>
                                        <p class="twitter-follower-count follower-count" style="display:none" data-id="'.$id.'">'.numberAbbreviation($twittercount).' Followers</p>
                                        ';
                                        }
                                        elseif($twitterurl != NULL && $facebookurl == NULL && $instagramurl == NULL){
                                            echo '
                                        <p class="instagram-follower-count follower-count" data-id="'.$id.'" style="display:none">'.numberAbbreviation($instagramcount).' Followers</p>
                                        <p class="facebook-follower-count follower-count"  data-id="'.$id.'" style="display:none">'.numberAbbreviation($facebookcount).' Likes</p>
                                        <p class="twitter-follower-count follower-count"  data-id="'.$id.'">'.numberAbbreviation($twittercount).' Followers</p>
                                        ';
                                        }
                                    echo '
                                    </div>
                                    <!-- Engagement ?-->
                                    <div class="col-xs-12">
                                        <p class="instagram-engagement engagement-count" data-id="'.$influencerid.'">1.5K Likes per post</p>
                                        <p class="facebook-engagement engagement-count" style="display:none"data-id="'.$influencerid.'">1.5K Likes per post</p>
                                        <p class="twitter-engagement engagement-count" style="display:none"data-id="'.$influencerid.'">1.5K Likes per post</p>
                                    </div>
                                    <div class="col-xs-12">

                                        <div style="display:inline; background-color:white; color:#e0e0e0;"class="col-xs-12 invite  avocado-focus" data-id="'.$influencerid.'" data-image="'.$info['image'].'">
                                              <i class="icon fa-check check" aria-hidden="true"></i>
                                                 </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <!-- Influencer box has ended -->';
                //    $count++;
                }


echo $html;



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
