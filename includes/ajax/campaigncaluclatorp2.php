<?php
include '../dbinfo.php';
$influencerlist = $_POST['influencers'];
$comma_separated = implode("','", $influencerlist);
$stmt = $conn->prepare("SELECT `id`,`image_url`,`user` FROM `User_Information` WHERE `id` IN('$comma_separated')");
$stmt->execute();
$stmt->bind_result($id,$image,$user);
while($stmt->fetch()){

} 
echo '

<div class="row">
        <div class="col-xs-12">
            <div class="table-responsive table-chosen-influencers">
              <table summary="This table shows a list of influencers added to a campaign" class="table table-bordered table-hover">
                <thead class="campaign-calc-table">
                  <tr class="cat-in-campaign-list-table">
                      <th class="text-center"> </th>
                      <th class="text-center"> <img src="assets/images/ig_black.png" class="insta-logo" />
                    <h6 class="posts-num"> Number of Posts </h6>  </th>
                      <th class="text-center"> <img src="assets/images/fb_black.png" class="fb-logo" /> <h6 class="posts-num">  Number of Posts </h6> </th>
                      <th class="text-center"> <img src="assets/images/twitter_black.png" class="twitter-logo2" /> <h6 class="posts-num"> Number of Posts </h6> </th>
                    </tr>
                  </thead>
                  <tbody id="table">';
                    $stmt = $conn->prepare("SELECT `id`,`image_url`,`user` FROM `User_Information` WHERE `id` IN('$comma_separated')");
                    $stmt->execute();
                    $stmt->bind_result($id,$image,$user);
                    while($stmt->fetch()){
                    echo ' <tr class="campaign-list-table">
                        <td class="campaign-tablerow" style="width:15%;"><div class="influencer-det"> <img src="http://project.social/'.$image.'" class="influencerphoto img-circle">
                            <h4 class="influencer-onlist">'.$user.'</h4>
                      </div></td>

                      <td data-id="'.$id.'" class="insta-column" style="width:15%;"> <h4 class="instagram-posts"> 0</h4> </td>
                      <td data-id="'.$id.'" class="twit-column" style="width:15%;"> <h4 class="twitter-posts"> 0 </h4> </td>
                      <td data-id="'.$id.'" class="face-column" style="width:15%;"> <h4 class="facebook-posts"> 0</h4> </td>
                    </tr>';       
                    }

                     
echo '  <p class="save"> SAVE CAMPAIGN </p>
                  </tbody>
    </div>
  </div>';