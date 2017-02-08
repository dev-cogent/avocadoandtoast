<?php 
include '../dbinfo.php';

echo '
<div class="col-xs-12 info-container">

   <!-- <div class="col-xs-12 campaign-select"> 
        <p  id="campaign-select-text" class="col-xs-12 col-md-1">Select Campaign:</p>
            <select class="form-control category avocado-focus  campaign-dropdown col-xs-12">
                <option class="option" value="fitness">Campaign Name</option>
                <option class="option" value="music">Music</option>
                <option class="option" value="movie">Film/Movies</option>
                <option class="option" value="fashion">Fashion</option>
                <option class="option" value="beauty">Beauty</option>
                <option class="option" value=""> None</option>
            </select>
        -->
    <div class="col-md-12 col-lg-6" style="margin-top:59px;margin-left: 5%;">
    <label id="campaign-label">CAMPAIGN NAME:</label><input id="campaign-name" type="text" placeholder="Untitled Campaign">
    </div>
    <button class="col-md-6 col-lg-3 info-button secondary-button" style="margin-right: 100px;">SUBMIT FOR PRICING</button>
    <button class="col-md-6 col-lg-3 info-button main-button">CREATE CAMPAIGN </button>




</div>

<div class="post-container col-xs-12">

              <table summary="This table shows a list of influencers added to a campaign" style="width: 100%; max-width: 100%; margin-bottom: 1rem;"class="table-hover">
                <thead class="campaign-calc-table">
                  <tr class="cat-in-campaign-list-table">
                      <th class="text-center"><button class="secondary-button" id="apply">Apply Posts to All</button></th>
                      <th class="text-center"> <img src="assets/images/ig_black.png" class="insta-logo" />
                    <p class="number-posts-text"> Number of Posts </p>  </th>
                      <th class="text-center"> <img src="assets/images/fb_black.png" class="fb-logo" /> <p class="number-posts-text">  Number of Posts </p> </th>
                      <th class="text-center"> <img src="assets/images/twitter_black.png" class="twitter-logo2" /> <p class="number-posts-text"> Number of Posts </p> </th>
                    </tr>
                  </thead>
                  <tbody>';
                  foreach($_POST['influencers'] as $id){
                  $stmt = $conn->prepare('SELECT `instagram_url`,`location`,`image_url` FROM `Influencer_Information` WHERE `id` = ?');
                  $stmt->bind_param('s',$id);
                  $stmt->execute();
                  $stmt->bind_result($instagramurl,$location,$image);
                  $stmt->fetch();
                    $insthandle = explode('.com/',$instagramurl);
                    $insthandle = explode('/',$insthandle[1]);
                    $insthandle = explode('?',$insthandle[0]);
                    $insthandle = $insthandle[0];
                  echo'
                    <tr class="campaign-list-table">
                        <td class="campaign-tablerow" style="width:15%;">
                                <div class="information"> 
                            <img src="http://project.social/'.$image.'" class="influencer-campaign-image ">
                            <h4 class="influencer-handle-text handle">@'.$insthandle.'</h4>
                            <h4 class="influencer-handle-text location-text">'.$location.'</h4>
                      </div></td>

                      <td data-id="'.$id.'" class="insta-column" style="width:15%;"><input data-id="'.$id.'" data-platform="instagram" class="instagraminput campaignfocus" type="number" value="0" max="100"> </td>
                      <td data-id="'.$id.'" class="twit-column" style="width:15%;"> <input data-id="'.$id.'" data-platform="facebook" class="facebookinput campaignfocus" type="number" value="0" max="100"> </td>
                      <td data-id="'.$id.'" class="face-column" style="width:15%;"> <input data-id="'.$id.'" data-platform="twitter" class="twitterinput campaignfocus" type="number" value="0" max="100"> </td>
                    </tr>';
                    unset($stmt);
                  }
                  echo '
                       
                       <!-- results -->
                        <tr class="result-row campaign-list-table">
                        <td class="campaign-tablerow" style="width:15%;">
                            <div class="information"> 
                                <p class="result-name">TOTAL ENGAGEMENT</p>
                            </div>
                      <td  class="insta-column" style="width:15%;"><p class="instagram-posts results-text"> 0 </p> </td>
                      <td  class="twit-column" style="width:15%;"> <p class="facebook-posts results-text"> 0 </p> </td>
                      <td  class="face-column" style="width:15%;"> <p class="twitter-posts results-text"> 0 </p></td>
                    </tr>
                    

                        <tr class="result-row campaign-list-table">
                        <td class="campaign-tablerow" style="width:15%;">
                            <div class="information"> 
                            <p class="result-name">TOTAL IMPRESSIONS</p>
                            </div>
                      <td  class="insta-column" style="width:15%;"><p class="instagram-posts results-text"> 0 </p> </td>
                      <td  class="twit-column" style="width:15%;"> <p class="facebook-posts results-text"> 0 </p> </td>
                      <td  class="face-column" style="width:15%;"> <p class="twitter-posts results-text"> 0 </p></td>
                    </tr>


                    </tbody>
                </table>
</div>';