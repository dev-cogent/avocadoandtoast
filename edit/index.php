<?php
session_start();
//error_reporting(0);
include '../includes/dbinfo.php';
include '../includes/class/savecampaign.php';
include '../includes/numberAbbreviation.php';
$url = $_SERVER['REQUEST_URI'];
$id = explode('/',$url);
$id = $id[2];
if($id == NULL){
$campaignid = $_SESSION['temp_campaign_id'];
}
else{
$campaignid = $id;
}


$save = new saveCampaign;
$checkcampaign = $save->checkCampaign($campaignid, $_SESSION['column_id']);
if($checkcampaign === false) header('Location: /dashboard.php');
$today = date('Y-m-d');
$tomorrow = date("Y-m-d", strtotime('tomorrow'));

//Checking for campaign validity

$campaigninfo = $save->getCampaignInfo($campaignid);
$campaigninfo = json_decode($campaigninfo,true);
$campaignsummary = $campaigninfo['description'];
$campaignstart = $campaigninfo['start'];
$campaignend = $campaigninfo['end'];
$campaignrequest = $campaigninfo['request'];
$campaignname = $save->getCampaignName($campaignid);



?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head> 
  <?php include '../includes/head.php' ?>
    <title><?php echo $influencerinfo['campaign_name'];?> | Avocado & Toast</title>
<script src="/bootbox/bootbox.js"></script>
<script src="/global/vendor/bootstrap/bootstrap.js"></script>
<script src="/assets/wnumb/wNumb.js"></script>
<script src="/assets/uislider/nouislider.js"></script>
<script src="/includes/javascript/tokenfield/dist/bootstrap-tokenfield.js"></script>
<link rel="stylesheet" href="/includes/javascript/tokenfield/dist/css/bootstrap-tokenfield.css">
<link rel="stylesheet" href="/assets/uislider/nouislider.css">
<link rel="stylesheet" href="/global/fonts/brand-icons/brand-icons.css">
<link rel="stylesheet" href="/global/fonts/font-awesome/font-awesome.css">
<link rel="stylesheet" href="/includes/css/discover.css">
<style>
.form-control{
    letter-spacing:0px;
    color:#515862;
    font-size:15px;
}

.title{
    color:rgb(29, 40, 76);  
    font-family: 'Open Sans', sans-serif;
    padding-top:20px;
    font-weight:600;
}
</style>
</head>

<body class="col-xs-12" style="padding-left:0px;padding-right:0px;">
<?php include '../acnav.php';?>

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
<script>
    var target2 = $('#stuff').offset().top;
</script>

<div class="container" style="margin-left:28.2%; padding-bottom:100px;">

<p class="desc-header" style="padding-top:30px;"> Edit Campaign - Not functioning yet </p>
<div class="input-container" style="width:45%;">

    <label class="title">Campaign Name </label>
    <input type="text" class="form-control category avocado-focus" value="<?php echo $campaignname; ?>">

    <label class="title">Campaign Summary </label>
    <br/>
    <label>What is it you are trying to do? </label>
    <textarea type="text" class="form-control category avocado-focus" value="<?php echo $campaignsummary;?>"  style="height:150px;">
    </textarea>
    <label class="title">Campaign Requests </label>
    <br/>
    <label>What type of content do you want? Be specific about what the influencer should be posting about.</label>
    <textarea type="text" class="form-control category avocado-focus" value="<?php echo $campaignrequest; ?>"  style="height:150px;">
    </textarea>

    <label class="title">Campaign Schedule </label>
    <br/>
    <div class="col-xs-12" style="padding-left:0px; padding-right:0px;">
        <input type="date" class="form-control category avocado-focus" id="start" style="float:left; width:45%;" value="<?php echo $today;?>"><p style="float:left; padding-left:3%;padding-right:3%;">to</p> 
        <input type="date" class="form-control category avocado-focus"  id="end" style="float:left; width:45%;" value="<?php echo $tomorrow;?>">
    </div>

    <button class="search avocado-hover col-xs-12" id="search-keyword" style="margin-top:50px;" id="submit">SUBMIT</button>


</div>

</div>