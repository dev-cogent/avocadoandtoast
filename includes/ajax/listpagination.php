<?php 
include '../class/savecampaign.php';
include '../numberAbbreviation.php';
$obj = new saveCampaign; 
$influencerlist = array();
$conn = $obj->dbinfo();
$campaignid = $_POST['list'];
$influencerlist = json_decode($_POST['influencers'],true);
if($influencerlist == NULL)
return 0;
if($_POST['type'] == 'list'){
        $page = $_POST['page'] * 10;
        $comma_separated = implode("','", $influencerlist);
        $stmt = $conn->prepare("SELECT `id`,`user`,`image_url`,`instagram_count`,`instagram_url`,`twitter_count`,`twitter_url`,`facebook_count`,`facebook_url`,`total` FROM `Influencer_Information` WHERE `id` IN ('$comma_separated') ORDER BY `total` DESC LIMIT $page,10");
        $stmt->execute();
        $stmt->bind_result($id,$user,$image,$instagramcount,$instagramurl,$twittercount,$twitterurl,$facebookcount,$facebookurl,$total);
        while($stmt->fetch()){
        echo '<tr data-id="'.$id.'" data-check="false" class="select influencer-list-table">
                      <td class="influencer-tablerow" style="width:20%;"><div class="influencer-det"> <img src="http://project.social/'.$image.'" class="influencerphoto img-circle">
                          <h4 class="influencer-onlist">'.$user.'</h4>
                    </div></td>

                    <td class="instagram-column" style="width:10%;"> <h4 class="instagram-follow">'.numberAbbreviation($instagramcount).'</h4> </td>
                    <td class="twitter-column" style="width:10%;"> <h4 class="twitter-follow"> '.numberAbbreviation($twittercount). '</h4> </td>
                    <td class="facebook-column" style="width:10%;"> <h4 class="facebook-follow">'.numberAbbreviation($facebookcount).'</h4> </td>
                    <td class="total-follow-column" style="width:10%;"> <h4 class="total-follow">'.numberAbbreviation($total).'</h4> </td>
                    <td class="remove-button-column" style="width:20%;"> <div class="remove remove-btn-div" data-id="'.$id.'" >   <a style="color:white;"class="btn btn-primary main-btn" role="button" > Remove </a> <div class="checkmark-squared" > </div>
                  </tr>';
        
    }

}
else{
        $page = $_POST['page'] * 12;
        $comma_separated = implode("','", $influencerlist);
        $stmt = $conn->prepare("SELECT `id`,`user`,`image_url`,`instagram_count`,`instagram_url`,`twitter_count`,`twitter_url`,`facebook_count`,`facebook_url`,`total` FROM `Influencer_Information` WHERE `id` IN ('$comma_separated') ORDER BY `total` DESC LIMIT $page,12");
        $stmt->execute();
        $stmt->bind_result($id,$user,$image,$instagramcount,$instagramurl,$twittercount,$twitterurl,$facebookcount,$facebookurl,$total);
        while($stmt->fetch()){
        $count = 4;
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
}