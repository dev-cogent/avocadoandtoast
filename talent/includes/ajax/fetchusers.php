<?php 
include '../dbinfo.php';
include '../numberAbbreviation.php';
$stmt = $conn->prepare('SELECT `id`,`user`,`image_url`,`instagram_count`,`instagram_url`,`twitter_count`,`twitter_url`,`facebook_count`,`facebook_url`,`location` FROM `Influencer_Information` ORDER BY `total` DESC LIMIT 0,20');
$stmt->execute();
$stmt->bind_result($id,$user,$image,$instcount,$insturl,$twittercount,$twitterurl,$facebookcount,$facebookurl,$location);
while($stmt->fetch()){
    echo '<!-- Repeat all of this -->
    <div class="border col-lg-5 box p-b-25" style="display:flex; justify-content:center;">

      <div class="pull-left col-md-9" style="align-self:center; ">  
         <img class="img-circle influencerpic" src="https://project.social/'.$image.'">
         <div class="info">
            <div id="name">'.$user.'</div>
            <div class="location">'.$location.'</div>
         </div>
      </div>

            <div id="instagram" class="pull-right text-center col-md-2">
                <img src="https://goo.gl/QxSdUu" class="icon">
                <br/>
                <p class="followers">'.numberAbbreviation($instcount).'</p>
            </div>
      
      <div id="facebook" class="pull-right text-center col-md-2">
         <img src="https://goo.gl/QxSdUu" class="icon">
          <br/>
          <p class="followers">'.numberAbbreviation($facebookcount).'</p>
     </div>
      
      <div id="twitter" class="pull-right text-center col-md-2">
         <img src="https://goo.gl/QxSdUu" class="icon">
          <br/>
          <p class="followers">'.numberAbbreviation($twittercount).'</p>
     </div>
            <div class="pull-right">
              <div class="pull-right checkmark m-b-10" style="visibility:hidden; margin-top:80%;" data-check="false"></div>
            </div>
     </div>

     <!--end-->';


}

