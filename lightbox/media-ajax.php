<?php 
session_start();
$accesstoken = $_SESSION['access_token'];
$image = $_GET['id'];
$id = $_GET['media'];
$mediaInfo = curl('https://api.instagram.com/v1/media/'.$id.'?access_token='.$accesstoken);
$userLikesInfo = curl('https://api.instagram.com/v1/media/'.$id.'/likes?access_token='.$accesstoken);
$userCommentInfo = curl('https://api.instagram.com/v1/media/'.$id.'/comments?access_token='.$accesstoken);

#Following variables are all to get the media information 
if($mediaInfo['data']['type'] === 'video')
  $video = $mediaInfo['data']['videos']['standard_resolution']['url'];
$comments = $mediaInfo['data']['comments']['count'];
$likes = $mediaInfo['data']['likes']['count'];
$caption = $mediaInfo['data']['caption']['text'];
$username = $mediaInfo['data']['user']['username'];
$profilepicture = $mediaInfo['data']['user']['profile_picture'];
$userid = $mediaInfo['data']['user']['id'];
$hashtags = $mediaInfo['data']['tags'];
$createdtime = $mediaInfo['data']['created_time'];
#end media information variables. 

$userinfo = array();
$liked = "false";
//checking if the user liked the photo. 
foreach($userLikesInfo['data'] as $users){
  if($users['id'] === $_SESSION['instagram_id'])
     $liked = "true";
  
  $userinfo[$users['user']]['picture'] = $users['profile_picture'];
  $userinfo[$users['user']]['id'] = $users['id'];
}



function hashtagBreakdown($text){
  $string ="";
  $textwords = explode(' ',$text);
  foreach($textwords as $word){
    $hashtag = strpos($word,'#');
    $mention = strpos($word, '@');
    if($hashtag !== FALSE){
      $tempword = str_replace('#','',$word);
      $string .= '<a href="/media.php/?tag='.$tempword.'"> '.$word.' </a>';
    }
    elseif($mention !== FALSE){
      $tempword = str_replace('@','',$word);
      $string .= '<a href="/account.php/'.$tempword.'"> '.$word.' </a>';
    }
    else{
    $string .= $word.' ';
    }
  }
  return $string;
}











function curl($url) {
    $curl_connection = curl_init($url); 
    curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
    $json = json_decode(curl_exec($curl_connection), true); 
    curl_close($curl_connection);
    return $json;     
    
} // end curl 
function time_elapsed_string($datetime, $full = false) {
    date_default_timezone_set('EST');
    $now = new DateTime();
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
    
?>
<div class="ajax-text-and-image lightbox-block">
  <style scoped>

  li{
    list-style: none;
  }
    .ajax-text-and-image {
      max-width: 800px;
      padding: 0;
    }
    
    .ajax-col {
      width: 50%;
      float: left;
    }
    
    .ajax-col img {
      width: 100%;
      height: auto;
    }
    
    @media all and (max-width:30em) {
      .ajax-col {
        width: 100%;
        float: none;
      }
    }

.wrapper{
    position:relative;
}
.tooltip {
    transform: none;
    /*margin: 50px;    */
    opacity :1;
}

.tooltip:hover > .tooltip-text, .tooltip:hover > .wrapper {
    pointer-events: auto;
    opacity: 1.0;
}

.tooltip > .tooltip-text, .tooltip >.wrapper {
    display: block;
    position: absolute;
    z-index: 6000;
    overflow: visible;
    padding: 20px 20px;
    margin-top: 10px;
    line-height: 16px;
    border-radius: 4px;
    text-align: left;
    color: #fff;
    background: #F7F7F7;
    pointer-events: none;
    opacity: 0.0;
    -o-transition: all 0.3s ease-out;
    -ms-transition: all 0.3s ease-out;
    -moz-transition: all 0.3s ease-out;
    -webkit-transition: all 0.3s ease-out;
    transition: all 0.3s ease-out;
}

/* Arrow */
.tooltip > .tooltip-text:before, .tooltip > .wrapper:before  {
    display: inline;
    top: -5px;
    content: "";
    position: absolute;
    border: solid;
    border-color: #F7F7F7 transparent;
    border-width: 0 .5em .5em .5em;
    z-index: 6000;
    left: 20px;
}

/* Invisible area so you can hover over tooltip */
.tooltip > .tooltip-text:after, .tooltip > .wrapper:after  {
    top: -20px;
    content: " ";
    display: block;
    height: 20px;
    position: absolute;
    width: 60px;
    left: 20px;
}

.wrapper > .tooltip-text {
    overflow-y: auto;
    max-height: 100px;
    display: block;
}

.f-10 {
  font-size:10px;
}    

.hashtags {
    max-width:9%;
    float:left;
    display:inline-block;
    text-decoration: none;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    padding: 6px 12px;
    margin-right: 5px;
}



  </style>
  
  
  
  
  <div class="ajax-col">
   <?php
    if(!isset($video))echo' <img class="img-fluid" src="https://'.$image.'" alt="..." />';
      else echo '<video class="img-fluid" controls><source src="'.$video.'" type="video/mp4"></source> </video>';
      ?>
  </div> 
  <div class="ajax-col">
    <div class="p-20">
      
      <!-- IMAGE + USERNAME -->
      <section style="border-bottom:1px solid #ddd;padding-bottom:10px;float:left;width:100%;">
        
       <div style="float:left;width:20%;padding-right:10px;">
        <?php echo '<a href="/account.php/'.$userid.'"><img class="img-circle" width="50" height="50" src="'.$profilepicture.'" alt="..." style="width:50px !important;"></a>';?>
        </div>
      
        <div style="float:left;width:80%;padding-right:10px;">
         <span><?php echo '<a href="/account.php/'.$userid.'">'.$username.'</a> - '.time_elapsed_string('@'.$createdtime); ?> </span> 
          <br>
          <span>
          
          <?php 
          //This piece of code gets all the hashtags from the caption and hyperlinks it. 
          echo hashtagBreakdown($caption);
          ?>
          
          </span>
        </div>
        
      </section>
      
      <!-- END IMAGE + USERNAME -->
      
      
    <!-- likes section -->  
      
 <section style="float:left;height:30px;padding:5px 0 5px 0;display:block;position:relative;width:100%;">
        <i class="icon fa-heart" data-id="" aria-hidden="true" style="float:left;margin-right:10px;"></i>
        <span id="likecount" style="float:left; margin-right:5px;"><?php echo $likes; ?> Likes</span>
        <?php 
        $i = 0;
        foreach($userinfo as $username=>$info){
        if($i >= 4){
        break;
        }
        echo '
        <a href="/account.php/'.$info['id'].'"><img  class="img-circle" width="50" height="50" src="'.$info['picture'].'" alt="..." style="width:25px !important; float:left; margin-right:5px;"></a>
        ';
        $i++;
        }
        ?>
</section>
      
      <!-- end likes section -->
      
      
      <!-- tag section -->


      
      <section style="float:left;height:auto;padding:5px 0 5px 0;display:block;position:relative;width:100%;">

        <?php 
        $i = 0;
        $j = 0;
        $p = 0;
        $len = count($array);
        foreach($hashtags as $tag){
          if($i < 3){
            echo '<button type="button" class="btn btn-squared btn-outline btn-default btn-sm m-r-5" href="/media.php/?tag='.$tag.'">'.$tag.'</button>';
          }
          if($i >= 3){
            if($j === 0){
            echo '
            <div class="tooltip tooltip-scroll" style="display:inline-block !important;"><button type="button" class="btn btn-squared btn-outline btn-default btn-sm m-r-5" href="#">...</button>
              <div class="wrapper">   
                <span class="tooltip-text">
                <li class="f-10"><a href="/media.php/?tag='.$tag.'">'.$tag.'</a></li>';        
            $j = 1;
            }

            else{
            echo '<li><a href="/media.php/?tag='.$tag.'">'.$tag.'</a></li>';
            }
             
          }
        if ($p == $len - 1) {
              echo '
        </span>
        </div>
        </div>';
          }
        $p++;
        $i++;
        }
  
        ?>



      </section>
      
      <!-- end tag section -->
      
      
      
    <!-- Comment Section -->  
 <section style="float:left;padding:5px 0 5px 0;display:block;position;relative;width:100%;">
        <i class="icon fa-comment" aria-hidden="true" style="float:left;margin-right:10px;"></i>
        <span id="commentcount" style="float:left; margin-right:5px;"><?php echo $comments;?> Comments</span>      
</section>      



<!-- Commenters -->
       <section style="float:left;padding:5px 0 5px 0;display:block;position:relative;width:100%;">
         
         
             <div class="example">
                  <div class="h-100" data-plugin="scrollable" style="overflow:auto">
                    <div data-role="container">
                      <div id="comment-content" data-role="content">
        <?php 
        //put ajax here 
        foreach($userCommentInfo['data'] as $comment){
        $commentid = $comment['id'];
        echo'
        <article>
        <img class="img-circle" width="50" height="50" src="'.$comment['from']['profile_picture'].'" alt="..." style="width:25px !important; float:left; margin-right:5px;">
        - '.$comment['from']['username'].' - '.hashtagBreakdown($comment['text']).' - '.time_elapsed_string('@'.$comment['created_time']).' 
        - <i class="delete icon fa-trash" data-media= "'.$id.'" data-id="'.$commentid.'" aria-hidden="true"></i>
        </article>';
         
        }
        
      
      ?>
                      
                      </div>
                    </div>
               </div>
         </div>
         
         
            
         
      </section>
      <!-- End Commenters -->
      
      
      <!-- End Comment Section -->
      
  

      
      
      
    </div>
     <!-- Comment Box -->
<section style="float: left;width: 100%;display: inline-block;">
   <?php if($liked === 'false')
            echo '<i id="heart" class="icon fa-heart-o" data-id="'.$id.'" data-liked="'.$liked.'" aria-hidden="true" style="float: left;display: inline-block;font-size: 25px;padding: 10px;"></i>';
         else
            echo '<i id="heart" class="icon fa-heart" data-id="'.$id.'" data-liked="'.$liked.'" aria-hidden="true" style="float: left;display: inline-block;font-size: 25px;padding: 10px; color:red;"></i>';
   
   ;?>
   <?php  echo' <input id="comment" data-id="'.$id.'" style="position:inherit;bottom:0;width: 85%;height:48px;overflow:hidden;background-color:#fff;border-top:1px solide #ddd;/* float: right; */" name="comment" type="text" class="form-control" id="inputPlaceholder" placeholder="Comment here...">'; 
   ?>   
    </section>
      
  </div>
  <div class="clearfix"></div>
</div>
<script src="/includes/javascript/like.js"></script>
<script src="/includes/javascript/comment.js"></script>