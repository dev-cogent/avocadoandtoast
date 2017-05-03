<?php
session_start();
error_reporting(0);
include '../dbinfo.php';
include '../numberAbbreviation.php';

$stmt = $conn->prepare("SELECT `campaign_name`,`campaign_id` FROM `campaign_save_link` WHERE `column_id` = ?");
$stmt->bind_param('s',$_SESSION['column_id']);
$stmt->execute();
$stmt->bind_result($campaignname,$campaignid);
while($stmt->fetch()){
  $options .= '<option class="option" value="'.$campaignid.'">'.$campaignname.'</option>';
}
unset($stmt);

echo '
 <link rel="stylesheet" href="/assets/css/campaign-calculator.css">
 <div class="container-fluid">
<div class="info-container">



        <div class="row">

    <div class="col-sm-12 col-md-6 col-lg-6 campaign-info" style="">
    <div class="camapaign-label-container mobile">
    <div class="campaign-label-div">
    <label id="campaign-label" class="campaign-label">CAMPAIGN NAME:</label><input id="campaign-name" class="mobile" type="text" placeholder="Untitled Campaign"> </div>


     <div class="select-campaign-container small">
            <div id="campaign-select-text" class="col-xs-12 col-md-1">ADD TO EXISTING: </div>
            <div class="add-to-existing-container">
            <select class="form-control category avocado-focus  campaign-dropdown col-xs-12">
                <option class="option" value=""> None</option>
                '.$options.'
            </select>
            <button class="save-btn" id="add-existing"> <i class="icon ti-plus black-plus" aria-hidden="true"></i> </button>

      </div>
            </div>

    </div></div>



<div class="col-xs-12 col-sm-10 col-md-6 col-lg-6 campaign-select">


  <div class="campaign-calc-btn-container tablet">
    <button class="info-button secondary-button mobile sm-mobile" id="price-campaign" style="">SUBMIT FOR PRICING</button>
    <button class="info-button main-button primary-button mobile sm-mobile" id="createcampaign">CREATE CAMPAIGN </button>
    </div>


            </div>
            </div>
    </div>

    <div class="row">


        <div class="campaign-info-index col-xs-12">
      <div class="posts-green index-name"> POSTS </div>
      <div class="impression-blue index-name"> IMPRESSION </div>
      <div class="engagement-orange index-name"> ENGAGEMENT </div>
      <div class="social-following-red index-name"> SOCIAL FOLLOWING </div>
    </div>

    </div>


<div class="post-container col-xs-12 tablet mobile">

              <table summary="This table shows a list of influencers added to a campaign" class="table-hover">
                <thead class="campaign-calc-table">
                  <tr class="cat-in-influencer-result-row">
                      <th class="text-center" scope="col"><button class="secondary-button mobile-apply small" id="apply">Apply Posts to All</button></th>
                      <th class="text-center" scope="col"> <img src="assets/images/ig_black.png" class="insta-logo" />
                   </th>
                      <th class="text-center" scope="col"> <img src="assets/images/fb_black.png" class="fb-logo" /> <p class="number-posts-text"> </p> </th>
                      <th class="text-center" scope="col"> <img src="assets/images/twitter_black.png" class="twitter-logo2" />  </th>
                        <th class="text-center total-heading" scope="col">  TOTAL  </th>
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
                    <tr class="influencer-result-row">
                        <td class="influencer-column" data-label="Name" style="width:15%; padding-left:0%;">
                                <div class="influencer-info-container mobile">
                            <img src="http://cogenttools.com/'.$image.'" onerror="this.src=`/assets/images/default-photo.png`" class="influencer-campaign-image ">
                            <div class="influencer-handle-text handle">@'.$displayhandle.'</div>
                            <div class="influencer-handle-text location-text">'.$location.'</div>
                      </div></td>

                      <td data-id="'.$id.'" class="insta-column" data-label="Instagram" style="width:15%;">
                          <div class="posts-res-div">
                            <input data-id="'.$id.'" data-platform="instagram" class="instagraminput campaignfocus mobile" type="number" value="0" max="100" min="0">
                            <div class="post-results-container tablet tm mobile ">posts</div>
                          </div>
                          <div class="results-mini-col tablet mobile">
                            <div class="impression-res impression-blue impression-instagram-blue" data-id="'.$id.'" data-number="0">0</div>
                            <div class="engagement-res engagement-orange engagement-orange-instagram" data-id="'.$id.'" data-number="0" >0</div>
                            <div class="social-following-res social-following-red">'.numberAbbreviation($instagramcount).'</div>
                          </div>
                      </td>

                      <td data-id="'.$id.'" class="twit-column" data-label="Twitter" style="width:15%;">
                        <input data-id="'.$id.'" data-platform="facebook" class="facebookinput campaignfocus" type="number" value="0" max="100" min="0">
                        <div class="post-results-container tablet tm mobile"> posts</div>
                        <div class="results-mini-col tablet mobile">
                          <div class="impression-res impression-blue impression-facebook-blue" data-id="'.$id.'" data-number="0">0</div>
                          <div class="engagement-res engagement-orange engagement-orange-facebook"  data-id="'.$id.'" data-number="0" >0</div>
                          <div class="social-following-res social-following-red">'.numberAbbreviation($facebookcount).'</div>
                        </div>
                      </td>

                      <td data-id="'.$id.'" class="face-column" data-label="Facebook" style="width:15%;">
                        <input data-id="'.$id.'" data-platform="twitter" class="twitterinput campaignfocus" type="number" value="0" max="100" min="0">
                        <div class="post-results-container tablet tm mobile"> posts</div>
                        <div class="results-mini-col tablet mobile">
                          <div class="impression-res impression-blue impression-twitter-blue" data-id="'.$id.'" data-number="0">0</div>
                          <div class="engagement-res engagement-orange engagement-orange-twitter" data-id="'.$id.'" data-number="0">0</div>
                          <div class="social-following-res social-following-red">'.numberAbbreviation($twittercount).'</div>
                        </div>
                      </td>

                      <td data-id="'.$id.'" class="overall-inf-total-column" data-label="Total" style="width:15%;">
                          <input data-id="'.$id.'" data-platform="total" class="totalinput campaignfocus" type="number" value="0" max="100" disabled>
                          <div class="post-results-container tablet tm mobile"> posts</div>
                          <div class="results-mini-col tablet mobile">
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
                        <tr class="result-row influencer-result-row">
                        <td class="influencer-column" scope="row" data-label="Name" style="width:15%;">
                            <div class="influencer-info-container">
                                <p class="result-name mobile">  CAMPAIGN ENGAGEMENT</p>
                            </div>
                      <td  class="insta-column"  data-label="Instagram" style="width:15%;" > <p class="instagram-posts results-text mobile" id="instagram-engagement" data-number="0"> 0 </p> </td>
                      <td  class="twit-column" data-label="Twitter" style="width:15%;"> <p class="facebook-posts results-text mobile" id="facebook-engagement" data-number="0"> 0 </p> </td>
                      <td  class="face-column" data-label="Facebook" style="width:15%;"> <p class="twitter-posts results-text mobile" id="twitter-engagement" data-number="0"> 0 </p></td>
                      <td  class="face-column" data-label="Total" style="width:15%;"> <p class="total-posts results-text mobile" id="total-engagement" data-number="0" > 0</p>  </td>
                    </tr>


                        <tr class="result-row influencer-result-row">
                        <td class="influencer-column" style="width:15%;" scope="row" data-label="Name">
                            <div class="influencer-info-container">
                            <p class="result-name mobile"> CAMPAIGN IMPRESSIONS</p>
                            </div>
                      <td  class="insta-column" data-label="Instagram" style="width:15%;"><p class="instagram-posts results-text mobile" id="instagram-impressions" data-number="0"> 0 </p> </td>
                      <td  class="twit-column" data-label="Twitter" style="width:15%;"> <p class="facebook-posts results-text mobile" id="facebook-impressions" data-number="0"> 0 </p> </td>
                      <td  class="face-column" data-label="Facebook"  style="width:15%;"> <p class="twitter-posts results-text mobile" id="twitter-impressions" data-number="0"> 0 </p></td>
                      <td  class="total-column" data-label="Total"  style="width:15%;"> <p class="total-posts results-text mobile" id="total-impressions" data-number="0" > 0 </p></td>

                    </tr>


                    </tbody>
                </table>
</div> </div>';
