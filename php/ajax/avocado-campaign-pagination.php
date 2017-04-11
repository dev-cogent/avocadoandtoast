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

                $instagrampost = $info['instagram_post'];
                $twitterpost = $info['twitter_post'];
                $facebookpost = $info['facebook_post'];

                $instagramimpressions = $info['instagram_impressions'];
                $twitterimpressions = $info['twitter_impressions'];
                $facebookimpressions = $info['facebook_impressions'];


                $instagrameng = $info['instagram_engagement'];
                $twittereng = $info['twitter_engagement'];
                $facebookeng = $info['facebook_engagement'];
                echo '
                    <div  class="influencer-box col-xs-12 col-md-6 col-lg-3 col-xl-2" data-id="'.$id.'" data-t-post="'.$twitterpost.'" data-f-post="'.$facebookpost.'"
                    data-i-post="'.$instagrampost.'" data-t-impressions="'.$twitterimpressions.'" data-f-impressions="'.$facebookimpressions.'" data-i-impressions="'.$instagramimpressions.'">
                            <div class="influencer-card-discover">

                                <img class="influencer-image-card" src="http://cogenttools.com/'.$info['image'].'" onerror="this.src=`/assets/images/default-photo.png`">
                                <div class="col-xs-12" style="height:170px; box-shadow: rgb(115, 196, 141) 0px -10px 0px;">
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
                                        
                                        <p class="instagram-follower-count follower-count" data-id="'.$id.'">'.numberAbbreviation($instagramimpressions).' Impressions</p>
                                        <p class="facebook-follower-count follower-count" style="display:none" data-id="'.$id.'">'.numberAbbreviation($facebookimpressions).' Impressions</p>
                                        <p class="twitter-follower-count follower-count" style="display:none" data-id="'.$id.'">'.numberAbbreviation($twitterimpressions).' Impressions</p>
                                        ';
                                        }
                                        elseif($facebookurl != NULL && $instagramurl == NULL){
                                            echo '
                                        <p class="instagram-follower-count follower-count" data-id="'.$id.'" style="display:none">'.numberAbbreviation($instagramimpressions).' Impressions</p>
                                        <p class="facebook-follower-count follower-count"  data-id="'.$id.'">'.numberAbbreviation($facebookimpressions).' Impressions</p>
                                        <p class="twitter-follower-count follower-count" style="display:none" data-id="'.$id.'">'.numberAbbreviation($twitterimpressions).' Impressions</p>
                                        ';
                                        }
                                        elseif($twitterurl != NULL && $facebookurl == NULL && $instagramurl == NULL){
                                            echo '
                                        <p class="instagram-follower-count follower-count" data-id="'.$id.'" style="display:none">'.numberAbbreviation($instagramimpressions).' Impressions</p>
                                        <p class="facebook-follower-count follower-count"  data-id="'.$id.'" style="display:none">'.numberAbbreviation($facebookimpressions).' Impressions</p>
                                        <p class="twitter-follower-count follower-count"  data-id="'.$id.'">'.numberAbbreviation($twitterimpressions).' Impressions</p>
                                        ';
                                        }
                                    echo '
                                    </div>
                                    <!-- Engagement ?-->
                                    <div class="col-xs-12">';
                                    if($instagramurl != NULL){
                                        echo '
                                        <p class="instagram-engagement engagement-count" data-id="'.$influencerid.'">'.numberAbbreviation($instagrameng).' Engagaement </p>
                                        <p class="facebook-engagement engagement-count" style="display:none"data-id="'.$influencerid.'">'.numberAbbreviation($facebookeng).' Engagaement</p>
                                        <p class="twitter-engagement engagement-count" style="display:none"data-id="'.$influencerid.'">'.numberAbbreviation($twittereng).' Engagement</p>';
                                    }
                                    elseif ($facebookurl != NULL && $instagramurl == NULL){
                                        echo '<p class="instagram-engagement engagement-count" style="display:none" data-id="'.$influencerid.'">'.numberAbbreviation($instagrameng).' Engagaement </p>
                                        <p class="facebook-engagement engagement-count" data-id="'.$influencerid.'">'.numberAbbreviation($facebookeng).' Engagaement</p>
                                        <p class="twitter-engagement engagement-count" style="display:none"data-id="'.$influencerid.'">'.numberAbbreviation($twittereng).' Engagement</p>';
                                    }
                                    elseif ($twitterurl != NULL && $facebookurl == NULL && $instagramurl == NULL){
                                    echo '<p class="instagram-engagement engagement-count" style="display:none" data-id="'.$influencerid.'">'.numberAbbreviation($instagrameng).' Engagaement </p>
                                        <p class="facebook-engagement engagement-count" style="display:none"data-id="'.$influencerid.'">'.numberAbbreviation($facebookeng).' Engagaement</p>
                                        <p class="twitter-engagement engagement-count" data-id="'.$influencerid.'">'.numberAbbreviation($twittereng).' Engagement</p>';
                                    }
                                    echo '
                                    </div>
                                    
                                    <div class="col-xs-12">
                                    <div style="display:inline; background-color:white; margin-top:1px; margin-bottom:4px; height:28px; padding-top:0px; width:100%;"class="col-xs-12 invite  avocado-focus" data-id="'.$influencerid.'" data-image="'.$info['image'].'">
                                    ';
                                    if($instagramurl != NULL){
                                      echo '   <p  class="instagram-total-post total-post" data-id="'.$id.'" style="text-align:center;padding-top: 3px; color:#73C48D;"> '.$instagrampost.' total post(s) </p>
                                               <p  class="facebook-total-post total-post" data-id="'.$id.'" style="text-align:center;padding-top: 3px; color:#73C48D; display:none;"> '.$facebookpost.' total post(s) </p>
                                               <p  class="twitter-total-post total-post" data-id="'.$id.'" style="text-align:center;padding-top: 3px; color:#73C48D; display:none;"> '.$twitterpost.' total post(s) </p>';
                                    }
                                    elseif($facebookurl != NULL && $instagramurl == NULL){
                                      echo '   <p  class="instagram-total-post total-post" data-id="'.$id.'" style="text-align:center;padding-top: 3px; color:#73C48D; display:none;"> '.$instagrampost.' total post(s) </p>
                                               <p  class="facebook-total-post total-post" data-id="'.$id.'" style="text-align:center;padding-top: 3px; color:#73C48D; "> '.$facebookpost.' total post(s) </p>
                                               <p  class="twitter-total-post total-post" data-id="'.$id.'" style="text-align:center;padding-top: 3px; color:#73C48D; display:none;"> '.$twitterpost.' total post(s) </p>';
                                    }
                                    elseif($twitterurl != NULL && $facebookurl == NULL && $instagramurl == NULL){
                                      echo '   <p  class="instagram-total-post total-post" data-id="'.$id.'" style="text-align:center;padding-top: 3px; color:#73C48D; display:none;"> '.$instagrampost.' total post(s) </p>
                                               <p  class="facebook-total-post total-post" data-id="'.$id.'" style="text-align:center;padding-top: 3px; color:#73C48D; display:none;"> '.$facebookpost.' total post(s) </p>
                                               <p  class="twitter-total-post total-post" data-id="'.$id.'" style="text-align:center;padding-top: 3px; color:#73C48D; "> '.$twitterpost.' total post(s) </p>';
                                    }
                                    echo '
                                              <i class="icon fa-check check" aria-hidden="true" style="text-align:center; width:100%; margin-left:0px;"></i>
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
