<?php 
include '../class/list.php';
include '../numberAbbreviation.php';
$obj = new listOptions;
$influencerlist = array(); 
$conn = $obj->dbinfo();
$listid = $_POST['list'];
$influencerlist = json_decode($_POST['influencers'],true);

echo '<div class="row">
      <div class="col-xs-12">
          <div class="table-responsive table-chosen-influencers" style="margin-top:0%;">
            <table summary="This table shows a list of influencers added to a campaign" class="table table-bordered table-hover">
              <thead>
                <tr class="cat-in-campaign-list-table">
                    <th class="text-center"> Name </th>
                    <th class="text-center"> Instagram </th>
                    <th class="text-center"> Twitter </th>
                    <th class="text-center"> Facebook </th>
                    <th class="text-center"> Total Followers </th>
                    <th> </th>
                  </tr>
                </thead>
                <tbody id="table">';
        $comma_separated = implode("','", $influencerlist);
        $stmt = $conn->prepare("SELECT `id`,`user`,`image_url`,`instagram_count`,`instagram_url`,`twitter_count`,`twitter_url`,`facebook_count`,`facebook_url`,`total` FROM `Influencer_Information` WHERE `id` IN ('$comma_separated') ORDER BY `total` DESC LIMIT 0,10");
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
echo '</tbody></table>';
unset($conn);

