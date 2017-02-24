<?php
session_start();
//error_reporting(0);
include 'includes/dbinfo.php';
 include 'includes/numberAbbreviation.php';
include 'includes/class/savecampaign.php';
$save = new saveCampaign;
$campaigninfo = $save->getSavedCampaigns($_SESSION['column_id']);
?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <?php include 'includes/head.php' ?>
    <title>Dashboard</title>
<script src="/bootbox/bootbox.js"></script>
<script src="/global/vendor/bootstrap/bootstrap.js"></script>
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Open+Sans:400,700" rel="stylesheet">
<script src="/assets/wnumb/wNumb.js"></script>
<script src="/assets/uislider/nouislider.js"></script>
<script src="/includes/javascript/tokenfield/dist/bootstrap-tokenfield.js"></script>
<link rel="stylesheet" href="/includes/javascript/tokenfield/dist/css/bootstrap-tokenfield.css">
<link rel="stylesheet" href="/assets/uislider/nouislider.css">
<link rel="stylesheet" href="/global/fonts/brand-icons/brand-icons.css">
<link rel="stylesheet" href="/global/fonts/font-awesome/font-awesome.css">
<link rel="stylesheet" href="/includes/css/discover.css">
<link rel="stylesheet" href="/assets/css/dashboard.css">
<style>
.campaign-block{
    background-color:#fcfcfc;

}
</style>
</head>

<body class="col-xs-12" style="padding-left:0px;padding-right:0px;">

<?php include 'acnav.php'; ?>
<div class="col-xs-1 sidebar-left" style="position:absolute;">
<i class="icon fa-bars" aria-hidden="true" style="
    color: white;
    text-align: center;
    font-size: 21px;
    margin-left: 5px;
    height: 20px;
    padding-top: 15px;
"></i>
</div>
<div id="stuff"></div>
<script src="/includes/javascript/sidebar-left.js"></script>








<!-- Add side bar here -->




<!-- The third nav bar , we might be able to take this out. In the mean time, we'll keep it here -->

<div class="mininav col-xs-12" style="height:50px; position:absolute;">
    <p class="nav3">INFLUENCERS</p>
</div>


<!-- Start Campains here -->
<div class="col-xs-9 col-xl-9 divider-top" style="margin-top: 49px;padding-top: 16px; padding-left:75px;">
    <div id="allcampaigns" class="col-xs-12">
    All Campaigns
    </div>

</div>


<div class="col-xs-2" style="padding-top: 75px;" id="campaign-info">



</div>



    </div>


<div id="campaign-container">
<?php
foreach($campaigninfo as $campaignid => $info){
$comment = json_decode($info['comment'],true);
$numberOfInfluencers = count($info['influencer']);
$name = $info['campaignname'];
$totalimpressions = $comment['totalimpressions'];
$avgimpressions = $totalimpressions/$numberOfInfluencers;
$totalpost = $comment['totalposts'];
$datecreated = $comment['created'];
echo '<div class="campaign-block col-xs-9" data-id="'.$campaignid.'" data-desc="Nothing seems to be here." data-name="'.$name.'" style="padding-left:75px;" >
        <table class="col-xs-12">
            <tbody style="border-top:0px;">
            <tr>
                <td class="campaign-details name" ><a class="campaign-details" href="/campaigns/'.$campaignid.'">'.$name.' </a></td>
                <td class="campaign-details" > Campaign not in progress </td>
                <td class="campaign-details date" > Created '.$datecreated.'</td>
            </tr>
            <tr>
                <td class="stats">'.$numberOfInfluencers.'</td>
                <td class="stats">'.$totalpost.'</td>
                <td class="stats">'.numberAbbreviation($avgimpressions).'</td>
                <td class="stats">1,000</td>
                <td class="stats">'.numberAbbreviation($totalimpressions).'</td>
            </tr>
            <tr>
                <td class="label-info"># of Influencers</td>
                <td class="label-info">Total Post</td>
                <td class="label-info">Average Impressions</td>
                <td class="label-info"> Average Engagement</td>
                <td class="label-info"> Total Reach</td>
            </tr>
            </tbody>
        </table>
    </div>';
}
?>



</div>

</body>
<script>
var target = $("#campaign-info").offset().top;
var target2 = $('#stuff').offset().top;
$(document).on('click','.campaign-block',function(){
    $('#campaign-info').empty();
    var name = $(this).attr('data-name');
    var desc = $(this).attr('data-desc');
    var id = $(this).attr('data-id');
    $('#campaign-info').append(
        '<div id="campaign-details" style="max-width: 330px;">'+
       '<p id="campaign-title">'+name+'</p>'+
      ' <p class="title"> Campaign Summary</p>'+
       '<p id="summary">'+desc+'</p>'+
       '<p class="title">Campaign Schedule</p>'+
       '<p id="schedule"> <strong> Start</strong> April 1 <strong> April 6 </strong>'+
       '<div id="button-container">'+
           '<button class="option-button delete avocado-hover avocado-focus" id="'+id+'"> Delete Campaign </button>'+
           '<a style="color:#76838f;"href="/campaigns/'+id+'"><button class="option-button avocado-hover avocado-focus" name="campaign" value="'+id+'">View Campaign </button></a>'+
    '</div>');
});


$(document).on('click','.delete',function(){
alert("You're about to delete the campaign!... Rest of pop up goes here");
console.log($(this).attr('id'));
//Ajac will go here 

});
</script>
