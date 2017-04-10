<?php
session_start();
require  "autoload.php";
include '../dbinfo.php';
include '../class/savecampaign.php';
include '../numberAbbreviation.php';
$today = date('m.d.Y');
$obj = new saveCampaign;
$columnid = $_SESSION['column_id'];
$campaignid = $_GET['id'];
$stmt = $conn->prepare('SELECT `campaign_name`,`campaign_desc`,`campaign_request`,`created_date`,`total_instagram_impressions`,`total_facebook_impressions`,`total_twitter_impressions`,`total_impressions`,`total_instagram_engagement`,`total_twitter_engagement`,`total_facebook_engagement`,`total_engagement`
                FROM `campaign_save_link` WHERE `campaign_id` = ? AND `column_id` = ? ');
$stmt->bind_param('ss',$campaignid,$columnid);
$stmt->execute();
$stmt->bind_result($name,$desc,$request,$createdate,$instimpressions,$faceimpressions,$twitimpressions,$totalimpressions,$instengagement,$twitterengagement,$facebookengagement,$totalengagement);
$stmt->fetch();
$html = '';
        $influencerinfo = $obj->getCampaign($campaignid);
        $campaigninfo = $obj->getCampaignInfo($campaignid);
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
        $handle = $insthandle;
        if($insthandle == NULL){
          $handle = $facebookhandle;
        }
        if($facebookhandle == NULL && $insthandle == NULL){
          $handle = $twitterhandle;
        }
      $html.='
        <tr class="influencer-row" style="">
       <td class="campaign-sect">
          <div class="influencer-info" style="">
             <img src="http://cogenttools.com/images/'.$id.'.jpg"  class="influencer-campaign-image">
                <div class="influencer-name">
                  <p class="influencer-handle"> @'.$handle.' </p>
                  <p class="influencer-loc"> Brooklyn, NY </p> 
                </div>
           </div>
       </td>

       <td class="instagram-col" style="">
      <div class="post-res-div">
    <div class="post-res">
    <div class="post-num">'.$instagrampost.'</div>
    <div class="post-name"> posts </div>
    </div>
    <div class="res-mini-col">
        <div class="impression-res">'.numberAbbreviation($instagramimpressions).'</div>
        <div class="engagement-res">'.numberAbbreviation($instagrameng).'</div>
        <div class="social-following">'.numberAbbreviation($info['instagram_count']).'</div>
    </div>
    </div>

       </td>

           <td class="facebook-col" style="">
      <div class="post-res-div">
    <div class="post-res">
    <div class="post-num"> '.$facebookpost.' </div>
    <div class="post-name"> posts </div>
    </div>
    <div class="res-mini-col">
        <div class="impression-res">'.numberAbbreviation($facebookimpressions).'</div>
        <div class="engagement-res"> '.numberAbbreviation($facebookeng).'</div>
        <div class="social-following"> '.numberAbbreviation($info['facebook_count']).'</div>
    </div>
    </div>

       </td>


         <td class="twitter-col" style="">
      <div class="post-res-div">
    <div class="post-res">
    <div class="post-num"> '.$twitterpost.' </div>
    <div class="post-name"> posts </div>
    </div>
    <div class="res-mini-col">
        <div class="impression-res">'.numberAbbreviation($twitterimpressions).'</div>
        <div class="engagement-res"> '.numberAbbreviation($twittereng).' </div>
        <div class="social-following">'.numberAbbreviation($info['twitter_count']).' </div>
    </div>
    </div>

       </td>


         <td class="total-influencer-col" style="">
      <div class="post-res-div total-col">
    <div class="post-res">
    <div class="post-num"> '.($instagrampost + $facebookpost + $twitterpost).' </div>
    <div class="post-name"> posts </div>
    </div>
    <div class="res-mini-col" style="position:relative; left:15px;">
        <div class="impression-res">'.numberAbbreviation($instagramimpressions+$facebookimpressions+$twitterimpressions).'</div>
        <div class="engagement-res"> '.numberAbbreviation($instagrameng+$facebookeng+$twittereng).'</div>
        <div class="social-following">'.numberAbbreviation($info['instagram_count']+$info['twitter_count']+$info['facebook_count']).'</div>
    </div>
    </div>

       </td>
    </tr>
<!-- end -->';
        }
$configuration = DocRaptor\Configuration::getDefaultConfiguration();
$configuration->setUsername("iLYpGOvi5Y02WmSLsI"); # this key works for test documents
$configuration->setSSLVerification(false);
//$configuration->setDebug(true);
$docraptor = new DocRaptor\DocApi();
  $doc = new DocRaptor\Doc();
  $doc->setTest(true);
  $count = 0;
                                            # test documents are free but watermarked
  $doc->setDocumentContent('
  <html>
  <head>
    <title>Cogent Influencer Deck</title>
    <link rel="shortcut icon" href="http://cogenttools.com/cogent-favicon.png">
    <link rel="stylesheet" href="http://avocadoandtoast.com/global/fonts/MontserrantFonts/stylesheet.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Open+Sans:400,700|Nothing+You+Could+Do|" rel="stylesheet">

<style type="text/css">

//* Set the content of an H1 to the identifier "doctitle" */
h3 { string-set: doctitle content(); }

@page {
margin: 20px;

}
@page {
margin-left:20px;
margin-right:20px;
}
body{
  font-family: "montserratlight";

}
img{
  margin-left:-20px;
}

#summary-text{
font-size:11px;

  }
#title{
  font-size:30px;
    margin-top:0px;
    color:#30363F;
    font-family: "montserratlight";
    letter-spacing:0px;
}

table {
  text-align: center;
}

#brand{
  padding-top:30px;
  font-size:18px;
  margin-bottom:0px;
  color:#30363F;
  font-family: "montserratlight";
  letter-spacing:1px;
}

#summary{
  width:550px;
  max-height: 150px;
}

#request{
  width:550px;
  max-height: 150px;
}

#key li{
  list-style-type:none;
}
#key{
  margin-top:-75px;
  margin-right: 14px;
}
.index-color{
  font-size: 11px;
}
.social-col{
  margin-top: 15px;
  margin-bottom: 15px;
  padding: 0;
}
.twitter-logo-pdf{
  width: 20px;
}
.ig-logo-pdf, .fb-logo-pdf{
  width: 16px;
}
 thead {
 padding-top: 10px;
 padding-bottom: 10px;
}

.social-col {
  text-align: center;
    border-top: 1px solid #1f232a;
  border-bottom: 1px solid #1f232a;
  padding-top: 15px;
  padding-bottom: 15px;
}
.post-res-div.total-col {
 padding-right: -80px;
 padding-left: 25px;
}
.post-res{
margin-left:-10px;
}

.ig-logo-pdf{
  padding-left: 0px;
}

.instagram-col, .facebook-col, .twitter-col, .total-influencer-col {
padding-right: 65px;
}
.instagram-col {
  background-color: #F6F6F6;
}

.facebook-col {
  background-color: transparent;
}
.twitter-col{
  background-color: #F6F6F6;
}
.campaign-sect {
  padding-right: 50px;
}
.total-col{
  margin-right: 36px;
  margin-left: 15px;
}

table  {
  border-left: hidden;
  border-right: hidden;
  border-collapse: collapse;
}
.influencer-row {
  border-bottom: 1px solid lightgrey;
  height: 100px;
}
.post-res-div{

}

.influencer-handle, .influencer-loc, .influencer-name {
  margin-top: -20px;
  font-family: "montserratlight";
  font-size:14px;
  display:inline;
  max-width:20px;
  width:20px;
  text-overlflow:ellipsis;
}

.influencer-name {
  font-size:13px;
  position: relative;
  left: 48px;
  top: -50px;
  padding-left: 10px;
  font-family: "montserratlight";
}
.influencer-info {
  margin-top: 20px;
  padding-right: 10px;
  max-width:115px;
  vertical-align:middle;
}
.total-influencer-col{
}

.post-num{
  font-size: 35px;
  color: #73c48d;
}
.post-name{
  margin-top: -7px;
  font-size: 11px;
  color: #1f232a;
}

.res-mini-col {
 float: right;
 margin-top: -53px;
 margin-right: -50px;
 font-size:13px;
}

.impression-res, .engagement-res, .social-following {
  padding-bottom: 5px;
}
.impression-res {
  color: rgb(50, 157, 223);
}
.engagement-res{
  color: rgb(255, 139, 104);
}
.social-following {
  color: rgb(231, 72, 69);
}

.influencer-loc {
  font-size: 12px;
}
.instagram-overall-res, .facebook-overall-res, .twitter-overall-res, .overall-grand-total {
  font-size: 30px;
  text-align: center;
  color: #73c48d;
}
.influencer-campaign-image {
  max-width: 50px;
  max-height: 50px;
  width: 100%;
  margin-top: 20px;
  float: left;
  margin-left: 0px;

}
.campaign-status, .campaign-date {
  text-transform: uppercase;
  display: inline-block;
  padding-top: 10px;
  font-size: 11px;
  font-weight:600;
  margin-left: 40px;
}

.summary-influencers , .summary-post , .summary-impressions, .summary-engagement {
  display: inline-block;
  font-size: 32px;
  margin-top: 25px;
  color: #73C48D;
  margin-bottom: 20px;
  margin-left: 30px;
  margin-right: 30px;
   line-height: 17px;
  letter-spacing: 0.7px;
}

.total-influencer-copy, .total-post-copy, .total-impressions-copy, .total-engagement-copy {
  font-size: 12px;
   color: #1f232a;
  font-weight: 600;
  letter-spacing: 0;
}

.campaign-date {
  float: right;
  padding-right: 30px;
}

</style>
<!-- New influencer display style -->
<!-- Starts here -->

<div class="header"><img src="http://avocadoandtoast.com/assets/images/at-logo-black.png">
<p style="float:right; margin-top:-60px; font-size:11px;">'.$today.'</p>
</div>



<div id="brand-name" style="margin-top:-30px;">
  <h2 id="brand">'.$campaigninfo['brandname'].'</h2>
  <h1 id="title">'.$name.'</h1>

</div>
<div class="campaign-descrip-container">
<div id="summary">
   <p id="summary-text">'.$desc.'</p>
</div>


</div>

<div style="float:right;" id="key">
  <li  class="index-color" style="color:#73c48d;">POSTS</li>
  <li  class="index-color" style="color:rgb(50, 157, 223);">IMPRESSION</li>
  <li  class="index-color" style="color:rgb(255, 139, 104);">ENGAGEMENT</li>
  <li class="index-color" style="color:rgb(231, 72, 69);">SOCIAL FOLLOWING</li>
</div>




<table style="margin-right:20px;">
  <thead class="table-options" style="">
  <tr class="social-platforms-icons" style="">


  <th class="" style="border-top: 1px solid #1f232a;border-bottom: 1px solid #1f232a;"> </th>
    <th class="social-col" style="width:130px;border-left: hidden; border-right:hidden;"> <img src="https://gallery.mailchimp.com/bb1e624c1a86ff7a7fe97f3b0/images/7582f32c-1dcc-4fb9-93e5-b00f45a2ca79.png" class="ig-logo-pdf" style="">  </th>
  <th class="social-col" style="width:130px;"> <img src="https://gallery.mailchimp.com/bb1e624c1a86ff7a7fe97f3b0/images/a340cde6-7a92-490d-997f-f9a16ef24cd1.png" class="fb-logo-pdf" style="">  </th>
  <th class="social-col" style="width:130px;"> <img src="https://gallery.mailchimp.com/bb1e624c1a86ff7a7fe97f3b0/images/fcb5fe9a-1c06-44c5-ad43-db73823cda7d.png" class="twitter-logo-pdf" style="">   </th>
  <th class="social-col total" style="width:130px;">  TOTAL </th>
</tr>


</thead>

  <tbody style="border:1px solid grey;">

  '.$html.'


       <tr class="influencer-row" style="">
       <td class="campaign-sect" style="border-bottom:none;">
         <div class="total-engagement" style="width:135px; font-size:13px;"> CAMPAIGN ENGAGEMENT </div>


       </td>

       <td class="instagram-col" style="background-color:transparent;">
      <div class="instagram-overall-res" style="position:relative; left:30px;">
        '.numberAbbreviation($instengagement).'
    </div>
       </td>

           <td class="facebook-col" style="background-color:transparent;">
      <div class="facebook-overall-res" style="position:relative; left:30px;">
              '.numberAbbreviation($facebookengagement).'
    </div>

       </td>


         <td class="twitter-col" style="background-color:transparent;">
      <div class="twitter-overall-res" style="position:relative; left:30px;">
            '.numberAbbreviation($twitterengagement).'
    </div>
       </td>


         <td class="total-influencer-col" style="background-color:transparent;">
      <div class="overall-grand-total" style="position:relative;left:30px;">
      '.numberAbbreviation($totalengagement).'
    </div>
       </td>
    </tr>

       <tr class="influencer-row" style="">
       <td class="campaign-sect" style="border-bottom:hidden;">
         <div class="total-engagement" style="width:135px; font-size:13px;"> CAMPAIGN IMPRESSIONS </div>

       </td>

       <td class="instagram-col" style="background-color:transparent;border-bottom:hidden;">
      <div class="instagram-overall-res" style="position:relative;left:30px;">
       '.numberAbbreviation($instimpressions).'
    </div>
       </td>

           <td class="facebook-col" style="background-color:transparent;border-bottom:hidden;">
      <div class="facebook-overall-res" style="position:relative;left:30px;">
              '.numberAbbreviation($faceimpressions).'
    </div>

       </td>


         <td class="twitter-col" style="background-color:transparent;border-bottom:hidden;">
      <div class="twitter-overall-res" style="position:relative;left:30px;">
            '.numberAbbreviation($twitimpressions).'
    </div>
       </td>


         <td class="total-influencer-col" style="background-color:transparent;border-bottom:hidden;">
      <div class="overall-grand-total" style="position:relative;left:30px;">
      '.numberAbbreviation($totalimpressions).'
    </div>
       </td>
    </tr>


  </tbody>
</table>

<div class="summary-container" style="width:750px;border:1px solid lightgrey;margin-left:20px;margin-right:20px;margin-top:50px;">
  <div class="summary-container"><div class="campaign-status" > Campaign not in progress </div>
  <div class="campaign-date">  CREATED '.$createdate.' </div>
  </div>

  <div class="summary-influencers">'.$influencerinfo['campaign_count'].'<br>  <span class="total-influencer-copy" style="font-size:11px;"> Influencers </span> </div>

    <div class="summary-post">'.$campaigninfo['totalposts'].'<br> <span class="total-post-copy total-bottom" style="font-size:11px;" > Total Post </span> </div>

      <div class="summary-impressions">'.numberAbbreviation($campaigninfo['totalimpressions']/$influencerinfo['campaign_count']).'<br> <span class="total-impressions-copy" style="font-size:11px;"> Avg Impressions </span> </div>

      <div class="summary-engagement">'.numberAbbreviation($campaigninfo['totalengagement']/$influencerinfo['campaign_count']).'<br> <span class="total-engagement-copy" style="font-size:11px;"> Avg Engagement </span> </div>


</div>


</div>
</body>
</html>
  ');     # supply content directly
  # $doc->setDocumentUrl("http://docraptor.com/examples/invoice.html");  # or use a url
  $doc->setName("docraptor-php.pdf");                                    # help you find a document later
  $doc->setDocumentType("pdf");                                          # pdf or xls or xlsx
  // $doc->setJavascript(true);                                           # enable JavaScript processing
   //$prince_options = new DocRaptor\PrinceOptions();                     # pdf-specific options
   //$doc->setPrinceOptions($prince_options);
   //$prince_options->setMedia("screen");                                 # use screen styles instead of print styles
   //$prince_options->setBaseurl("http://hello.com");                     # pretend URL when using document_content
$create_response = $docraptor->createAsyncDoc($doc);
$create_response = $docraptor->createDoc($doc);
//var_dump($create_response);
header('Content-Description: File Transfer');
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename='.$name.'.pdf');
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
header('Content-Length: ' . strlen($create_response));
ob_clean();
flush();
echo($create_response);
function generateRandomString($length = 5) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}




?>
