<?php
include '../class/list.php';
include '../numberAbbreviation.php';
$obj = new listOptions;
$influencerlist = array();
$listconn = $obj->listDB();
$conn = $obj->dbinfo();
$listid = $_POST['list'];
$influencerlist = json_decode($_POST['influencers'],true);

        $count = 4;
        $comma_separated = implode("','", $influencerlist);
        $stmt = $conn->prepare("SELECT `id`,`user`,`image_url`,`instagram_count`,`instagram_url`,`twitter_count`,`twitter_url`,`facebook_count`,`facebook_url`,`total` FROM `Influencer_Information` WHERE `id` IN ('$comma_separated') ORDER BY `total` DESC LIMIT 0,12");
        $stmt->execute();
        $stmt->bind_result($id,$user,$image,$instagramcount,$instagramurl,$twittercount,$twitterurl,$facebookcount,$facebookurl,$total);
        while($stmt->fetch()){
        if($count == 4){
          echo '<div class="row card-row">';
          $count = 0;
        }
        echo '
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
                    if($check == true) echo '<a  class="favorite btn fav-icon-btn" role="button"  data-favorite="true"  data-id="'.$id.'" data-user="'.$user.'" style="color:red;">';
                    else echo '<a  class="favorite btn fav-icon-btn" role="button"  data-favorite="false"  data-id="'.$id.'" data-user="'.$user.'">';
                    echo '       <i class="fa fa-heart" aria-hidden="true"></i>
                                 </a>
                                 
                          </p>
                  </div>
              </div>
          </div>
        </div>';
        $count++;
        if($count == 4){
          echo '</div>';
        }
        }