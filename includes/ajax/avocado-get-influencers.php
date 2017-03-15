<?php
include '../dbinfo.php';
include '../numberAbbreviation.php';

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

        <div class="row">
    <div class="col-sm-12 col-lg-6 campaign-info" style="margin-left:20px;">
    <div class="camapaign-label-container">
    <div class="campaign-label-div">
    <label id="campaign-label" class="campaign-label">CAMPAIGN NAME:</label><input id="campaign-name" type="text" placeholder="Untitled Campaign"> </div>

    <div class="campaign-desc-div"> <div class="campaign-desc-container"> </div>
    </div></div>
    </div>


    <button class="col-md-6 col-lg-2 col-xs-12 info-button secondary-button" style="">SUBMIT FOR PRICING</button>
    <button class="col-md-6 col-lg-2 col-xs-12 info-button main-button" id="createcampaign">CREATE CAMPAIGN </button>

    </div>


    <div class="row name-index-row">
    <div class="col-lg-8 col-md-6 col-xs-12">

   </div>


    <div class="col-md-6 col-lg-4  col-xs-12 campaign-info-index">
      <div class="posts-green index-name"> POSTS </div>
      <div class="impression-blue index-name"> IMPRESSION </div>
      <div class="engagement-orange index-name"> ENGAGEMENT </div>
      <div class="social-following-red index-name"> SOCIAL FOLLOWING </div>
    </div>

  </div>



</div>

<div class="post-container col-xs-12">

              <table summary="This table shows a list of influencers added to a campaign" style="width: 100%; max-width: 100%; margin-bottom: 1rem;"class="table-hover">
                <thead class="campaign-calc-table">
                  <tr class="cat-in-campaign-list-table">
                      <th class="text-center"><button class="secondary-button" id="apply">Apply Posts to All</button></th>
                      <th class="text-center"> <img src="assets/images/ig_black.png" class="insta-logo" />
                   </th>
                      <th class="text-center"> <img src="assets/images/fb_black.png" class="fb-logo" /> <p class="number-posts-text"> </p> </th>
                      <th class="text-center"> <img src="assets/images/twitter_black.png" class="twitter-logo2" />  </th>
                        <th class="text-center total-heading">  TOTAL  </th>
                    </tr>
                  </thead>
                  <tbody>';
                  foreach($_POST['influencers'] as $id){
                  $stmt = $conn->prepare('SELECT `facebook_count`,`twitter_count`,`instagram_count`,`total`,`instagram_url`,`twitter_url`,`facebook_url`,`location`,`image_url` FROM `Influencer_Information` WHERE `id` = ?');
                  $stmt->bind_param('s',$id);
                  $stmt->execute();
                  $stmt->bind_result($facebookcount,$twittercount,$instagramcount,$total,$instagramurl,$facbookurl,$twitterurl,$location,$image);
                  $stmt->fetch();
                  if($instagramurl !== NULL || $instagramurl != ''){
                    $insthandle = explode('.com/',$instagramurl);
                    $insthandle = explode('/',$insthandle[1]);
                    $insthandle = explode('?',$insthandle[0]);
                    $displayhandle = $insthandle[0];
                  }
                //Facebook handle
                  elseif($facebookhandle !== NULL || $twitterurl != ''){
                  $facebookhandle = explode('.com/',$facebookurl);
                  $facebookhandle = explode('/',$facebookhandle[1]);
                  $facebookhandle = explode('?',$facebookhandle[0]);
                  $displayhandle = $facebookhandle[0];
                  }
                //twitter handle
                else{
                $twitterhandle = explode('.com/',$twitterurl);
                $twitterhandle = explode('/',$twitterhandle[1]);
                $twitterhandle = explode('?',$twitterhandle[0]);
                $twitterhandle = $twitterhandle[0];
                }

                  echo'
                    <tr class="campaign-list-table">
                        <td class="campaign-tablerow" style="width:15%; padding-left:0%;">
                                <div class="information">
                            <img src="http://cogenttools.com/'.$image.'" onerror="this.src=`/assets/images/default-photo.png`" class="influencer-campaign-image ">
                            <h4 class="influencer-handle-text handle">@'.$displayhandle.'</h4>
                            <h4 class="influencer-handle-text location-text">'.$location.'</h4>
                      </div></td>

                      <td data-id="'.$id.'" class="insta-column" style="width:15%;">
                          <div class="posts-res-div">
                            <input data-id="'.$id.'" data-platform="instagram" class="instagraminput campaignfocus" type="number" value="0" max="100" min="0">
                            <div class="post-results">posts</div>
                          </div>
                          <div class="results-mini-col">
                            <div class="impression-res impression-blue impression-instagram-blue" data-id="'.$id.'" data-number="0">0</div>
                            <div class="engagement-res engagement-orange engagement-orange-instagram" data-id="'.$id.'" data-number="0" >0</div>
                            <div class="social-following-res social-following-red">'.numberAbbreviation($instagramcount).'</div>
                          </div>
                      </td>

                      <td data-id="'.$id.'" class="twit-column" style="width:15%;">
                        <input data-id="'.$id.'" data-platform="facebook" class="facebookinput campaignfocus" type="number" value="0" max="100" min="0">
                        <div class="post-results"> posts</div>
                        <div class="results-mini-col">
                          <div class="impression-res impression-blue impression-facebook-blue" data-id="'.$id.'" data-number="0">0</div>
                          <div class="engagement-res engagement-orange engagement-orange-facebook"  data-id="'.$id.'" data-number="0" >0</div>
                          <div class="social-following-res social-following-red">'.numberAbbreviation($facebookcount).'</div>
                        </div>
                      </td>

                      <td data-id="'.$id.'" class="face-column" style="width:15%;">
                        <input data-id="'.$id.'" data-platform="twitter" class="twitterinput campaignfocus" type="number" value="0" max="100" min="0">
                        <div class="post-results"> posts</div>
                        <div class="results-mini-col">
                          <div class="impression-res impression-blue impression-twitter-blue" data-id="'.$id.'" data-number="0">0</div>
                          <div class="engagement-res engagement-orange engagement-orange-twitter" data-id="'.$id.'" data-number="0">0</div>
                          <div class="social-following-res social-following-red">'.numberAbbreviation($twittercount).'</div>
                        </div>
                      </td>

                      <td data-id="'.$id.'" class="overall-inf-total-column" style="width:15%;">
                          <input data-id="'.$id.'" data-platform="total" class="totalinput campaignfocus" type="number" value="0" max="100" disabled>
                          <div class="post-results"> posts</div>
                          <div class="results-mini-col">
                            <div class="impression-res impression-blue impression-total-blue" data-id="'.$id.'" data-number="0" >0</div>
                            <div class="engagement-res engagement-orange engagement-orange-total"  data-id="'.$id.'" data-number="0" >0</div>
                            <div class="social-following-res social-following-red"> '.numberAbbreviation($total).' </div>
                          </div>
                      </td>
                    </tr>';
                    unset($stmt);
                  }
                  echo '

                       <!-- results -->
                        <tr class="result-row campaign-list-table">
                        <td class="campaign-tablerow" style="width:15%;">
                            <div class="information">
                                <p class="result-name" style="width:210px;">  CAMPAIGN ENGAGEMENT</p>
                            </div>
                      <td  class="insta-column" style="width:15%;"> <p class="instagram-posts results-text" id="instagram-engagement" data-number="0"> 0 </p> </td>
                      <td  class="twit-column" style="width:15%;"> <p class="facebook-posts results-text" id="facebook-engagement" data-number="0"> 0 </p> </td>
                      <td  class="face-column" style="width:15%;"> <p class="twitter-posts results-text" id="twitter-engagement" data-number="0"> 0 </p></td>
                      <td  class="face-column" style="width:15%;"> <p class="total-posts results-text" id="total-engagement" data-number="0" > 0</p>  </td>
                    </tr>


                        <tr class="result-row campaign-list-table">
                        <td class="campaign-tablerow" style="width:15%;">
                            <div class="information">
                            <p class="result-name" style="width:210px;"> CAMPAIGN IMPRESSIONS</p>
                            </div>
                      <td  class="insta-column" style="width:15%;"><p class="instagram-posts results-text" id="instagram-impressions" data-number="0"> 0 </p> </td>
                      <td  class="twit-column" style="width:15%;"> <p class="facebook-posts results-text" id="facebook-impressions" data-number="0"> 0 </p> </td>
                      <td  class="face-column" style="width:15%;"> <p class="twitter-posts results-text" id="twitter-impressions" data-number="0"> 0 </p></td>
                      <td  class="total-column" style="width:15%;"> <p class="total-posts results-text" id="total-impressions" data-number="0" > 0 </p></td>

                    </tr>


                    </tbody>
                </table>
</div>';
