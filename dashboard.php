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
</head>

<body class="col-xs-12" style="padding-left:0px;padding-right:0px;">

<?php include 'acnav.php'; ?>








<!-- Add side bar here -->

<div class="col-xs-1 sidebar-left" style="position:relative;">
<i class="icon fa-bars" aria-hidden="true" style="
    color: white;
    text-align: center;
    font-size: 21px;
    margin-left: 5px;
    height: 20px;
    padding-top: 15px;
"></i>
</div>


<!-- The third nav bar , we might be able to take this out. In the mean time, we'll keep it here -->

<div class="mininav col-xs-12" style="height:50px; position:absolute;">
    <p class="nav3">INFLUENCERS</p>
</div>


<!-- Start Campains here -->
<div class="col-xs-9 col-xl-9 divider-top" style="margin-top: 49px;padding-top: 16px;">
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
echo '<div class="campaign-block col-xs-9 data-id="'.$campaignid.'" data-desc="Nothing seems to be here." data-name="'.$name.'" ">
        <table class="col-xs-12">
            <tbody style="border-top:0px;">
            <tr>
                <td class="campaign-details name" >'.$name.'</td>
                <td class="campaign-details" > <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Campaign not in progress </td>
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
// for nav bar
$(document).on('mouseover', '.other-nav',function(){
$(this).css('box-shadow','inset 0 0px 0 white, inset 0 -3.5px 0 #73c48d');
});
$(document).on('mouseleave', '.other-nav',function(){
$(this).css('box-shadow','none');
});
$(document).on('click','.campaign-block',function(){
    $('#campaign-info').empty();
    var name = $(this).attr('data-name');
    var desc = $(this).attr('data-desc');
    var id = $(this).attr('data-id');
    $('#campaign-info').append('<div id="campaign-details">'+
       '<p id="campaign-title">'+name+'</p>'+
      ' <p class="title"> Campaign Summary</p>'+
       '<p id="summary">'+desc+'</p>'+
       '<p class="title">Campaign Schedule</p>'+
       '<p id="schedule"> <strong> Start</strong> April 1 <strong> April 6 </strong>'+
       '<div id="button-container">'+
           '<button class="option-button"> Delete Campaign </button>'+
           '<button class="option-button" id="'+id+'"> View Campaign </button>'+
    '</div>');
});
</script>
