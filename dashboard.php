<?php
session_start();
//error_reporting(-1);
include 'php/dbinfo.php';
 include 'php/numberAbbreviation.php';
include 'php/class/savecampaign.php';
$save = new saveCampaign;
$campaigninfo = $save->getSavedCampaigns($_SESSION['column_id']);
?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <?php include 'php/head.php' ?>
    <title>Dashboard</title>

<script src="/bootbox/bootbox.js"></script>
<script src="/global/vendor/bootstrap/bootstrap.js"></script>
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Open+Sans:400,700" rel="stylesheet">
<script src="/assets/wnumb/wNumb.js"></script>
<script src="/assets/uislider/nouislider.js"></script>
<script src="/assets/js/tokenfield/dist/bootstrap-tokenfield.js"></script>
<link rel="stylesheet" href="/assets/js/tokenfield/dist/css/bootstrap-tokenfield.css">
<link rel="stylesheet" href="/assets/uislider/nouislider.css">
<link rel="stylesheet" href="/global/fonts/brand-icons/brand-icons.css">
<link rel="stylesheet" href="/global/fonts/font-awesome/font-awesome.css">
<link rel="stylesheet" href="/assets/css/discover.css">
<link rel="stylesheet" href="/assets/css/dashboard.css">
<link rel="stylesheet" href="/assets/css/sidebar.css">
<style>
.campaign-block{
    background-color:#fcfcfc;

}

button:focus{
    outline:none;
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
  <div id="li-container" style="display:none;">
    <li class="item"><a class="side-link" href="dashboard.php"> DASHBOARD </a> </li>
    <li class="item"><a class="side-link" href="discover.php"> DISCOVER </a></li>
    <li class="item"><a class="side-link" href="#"> ACCOUNT SETTINGS </a></li>
    <li class="item"><a class="side-link" href="#"> FAQ</a> </li>
    <li class="item"><a class="side-link" href="#"> CONTACT</a> </li>
    <li class="item"><a class="side-link" href="#"> LATEST UPDATES</a></li>
    <li class="item"><a class="side-link" href="/logout.php"> LOGOUT</a></li>
  </div>
</div>
</div>
<div id="stuff"></div>
<script src="/assets/js/sidebar-left.js"></script>








<!-- Add side bar here -->




<!-- The third nav bar , we might be able to take this out. In the mean time, we'll keep it here -->

<div class="avo-nav col-xs-12" style="height:50px; position:absolute;">
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
$numberOfInfluencers = count($info['influencer']);
$name = $info['campaignname'];
$totalimpressions = $info['totalimpressions'];
$totalengagement = $info['totalengagement'];
$avgimpressions = $totalimpressions/$numberOfInfluencers;
$avgengagement = $totalengagement/$numberOfInfluencers;
$totalpost = $info['totalposts'];
$datecreated = $info['created'];
$description = $info['description'];
if(isset($info['campaignstart']) && isset($info['campaignend'])){
$start = date('m/d/Y',strtotime($info['campaignstart']));
$end = date('m/d/Y',strtotime($info['campaignend']));
$state = $save->check_in_range($start,$end);
if($state) $state = 'Campaign in progress';
else $state = 'Campaign not in progress';

}
else{
    unset($state);
    unset($start);
    unset($end);
    $end = 'Campaign has not been scheduled';
    $state = 'Campaign not in progress';
}
if(!isset($description)){
    $description = 'Nothing seems to be here!';
}
echo '<div class="campaign-block col-xs-9" data-id="'.$campaignid.'" data-desc="'.$description.'" data-name="'.$name.'" data-start="'.$start.'" data-end="'.$end.'" style="padding-left:75px;" >
        <table class="col-xs-12">
            <tbody style="border-top:0px;">
            <tr>
                <td class="campaign-details name" ><a class="campaign-details" href="/campaigns/?id='.$campaignid.'">'.$name.' </a></td>
                <td class="campaign-details" > '.$state.' </td>
                <td class="campaign-details date" > Created '.$datecreated.'</td>
            </tr>
            <tr>
                <td class="stats">'.$numberOfInfluencers.'</td>
                <td class="stats">'.$totalpost.'</td>
                <td class="stats">'.numberAbbreviation($avgimpressions).'</td>
                <td class="stats">'.numberAbbreviation($avgengagement).'</td>
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

<?php //include 'acfooter.php'; ?>


</div>

</body>
<script>
var target = $("#campaign-info").offset().top;
var target2 = $('#stuff').offset().top;
var sidebar = false;
$(document).on('click','.campaign-block',function(){
    $('#campaign-info').empty();
    var name = $(this).attr('data-name');
    var desc = $(this).attr('data-desc');
    var id = $(this).attr('data-id');
    var start = $(this).attr('data-start');
    var end = $(this).attr('data-end');
    
    
    $('#campaign-info').append(
        '<div id="campaign-details" style="max-width: 330px;">'+
       '<p id="campaign-title">'+name+'</p>'+
      ' <p class="title"> Campaign Summary</p>'+
       '<p id="summary">'+desc+'</p>'+
       '<p class="title">Campaign Schedule</p>'+
       '<p id="schedule"> '+start+' - '+end+ ''+
       '<div id="button-container">'+
           '<a style="color:#76838f;"href="/edit/?id='+id+'"><button class="option-button avocado-hover avocado-focus" id="'+id+'"> Edit Campaign </button></a>'+
           '<a style="color:#76838f;"href="/campaigns/?id='+id+'"><button class="option-button avocado-hover avocado-focus" name="campaign" value="'+id+'">View Campaign </button></a>'+
    '</div>');
});




</script>
