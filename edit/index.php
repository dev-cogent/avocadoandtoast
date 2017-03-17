<?php
session_start();
//error_reporting(0);
include '../includes/dbinfo.php';
include '../includes/class/savecampaign.php';
include '../includes/numberAbbreviation.php';
//$url = $_SERVER['REQUEST_URI'];
//$id = explode('/',$url);
$id = $_GET['id'];//$id[2];
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
$campaignsummary = $campaigninfo['description'];
$campaignrequest = $campaigninfo['request'];
$campaignstart = $campaigninfo['campaignstart'];
$campaignend = $campaigninfo['campaignend'];
$campaignrequest = $campaigninfo['campaignrequest'];
$campaignname = $campaigninfo['campaignname'];
$brandname = $campaigninfo['brandname'];
if(isset($campaignstart)){
    $today = $campaignstart;
}
if(isset($campaignend)){
    $tomorrow = $campaignend;
}




?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head> 
  <?php include '../includes/head.php' ?>
    <title><?php echo $campaignname;?> | Avocado & Toast</title>
<script src="/bootbox/bootbox.js"></script>
<script src="/global/vendor/bootstrap/bootstrap.js"></script>
<script src="/assets/wnumb/wNumb.js"></script>
<script src="/assets/uislider/nouislider.js"></script>
<script src="/includes/javascript/tokenfield/dist/bootstrap-tokenfield.js"></script>
<link rel="stylesheet" href="/includes/javascript/tokenfield/dist/css/bootstrap-tokenfield.css">
<link rel="stylesheet" href="/assets/uislider/nouislider.css">
<link rel="stylesheet" href="/global/fonts/brand-icons/brand-icons.css">
<link rel="stylesheet" href="/global/fonts/font-awesome/font-awesome.css">
<link rel="stylesheet" href="/assets/css/discover.css">
<link rel="stylesheet" href="/assets/css/sidebar.css">
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

.search{
    min-width:143.5px;
}
.delete{
float:left; 
margin-left: 4.2%; 
width:40%; 
background-color:white;
border:1px solid #30363C; 
color:#30363C;
height: 50px;
font-size: 16px;
font-family: 'Montserrat', sans-serif;
min-width:143.5px;
}

.delete:hover{
    box-shadow: 0 0 1px #30363C;
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
  <div id="li-container" style="display:none;">
    <li class="item"><a class="side-link" href="/dashboard.php"> DASHBOARD </a> </li>
    <li class="item"><a class="side-link" href="/acdiscover.php"> DISCOVER </a></li>
    <li class="item"><a class="side-link" href="/settings.php"> ACCOUNT SETTINGS </a></li>
    <li class="item"><a class="side-link" href="#"> FAQ</a> </li>
    <li class="item"><a class="side-link" href="#"> CONTACT</a> </li>
    <li class="item"><a class="side-link" href="#"> LATEST UPDATES</a></li>
    <li class="item"><a class="side-link" href="/logout.php"> LOGOUT</a></li>
  </div>
</div>
<div id="stuff"></div>
<script src="/includes/javascript/sidebar-left.js"></script>
<script>
    var target2 = $('#stuff').offset().top;
</script>

<div class="container" style="margin-left:28.2%; padding-bottom:100px;">

<p class="desc-header" style="padding-top:30px;"> Edit <?php echo $campaignname; ?></p>
<div class="input-container" style="width:45%;">

    <label class="title">Campaign Name </label>
    <input type="text" class="form-control category avocado-focus" id="name" value="<?php echo $campaignname; ?>">


    <label class="title">Brand Name </label>
    <input type="text" class="form-control category avocado-focus" id="brandname" value="<?php echo $brandname; ?>">

    <label class="title">Campaign Summary </label>
    <br/>
    <label>What is it you are trying to do? </label>
    <textarea type="text" class="form-control category avocado-focus" id="campaign-summary"   style="height:150px;"><?php echo $campaignsummary;?></textarea>
    <label class="title">Campaign Requests </label>
    <br/>
    <label>What type of content do you want? Be specific about what the influencer should be posting about.</label>
    <textarea type="text" class="form-control category avocado-focus" id="campaign-request" style="height:150px;"><?php echo $campaignrequest; ?></textarea>

    <label class="title">Campaign Schedule </label>
    <br/>
    <div class="col-xs-12" style="padding-left:0px; padding-right:0px;">
        <input type="date" class="form-control category avocado-focus" id="campaign-start" style="float:left; width:45%;" value="<?php echo $today;?>"><p style="float:left; padding-left:3%;padding-right:3%;">to</p> 
        <input type="date" class="form-control category avocado-focus"  id="campaign-end" style="float:left; width:45%;" value="<?php echo $tomorrow;?>">
    </div>
    <div style="margin-top:50px;">
        <button class="col-xs-4 delete" id="search-keyword" style="float:left; margin-left: 4.2%; width:40%; background-color:white; border:1px solid #30363C; color:#30363C;">DELETE</button>
        <button class="search avocado-hover col-xs-4 submit" id="search-keyword" style="float:left; margin-left:10%; width:40%;">SUBMIT</button>
    </div>


</div>

</div>

<script>
var sidebar = false;
const campaignid = '<?php echo $campaignid; ?>';

$(document).on('click','.submit',function(){
    const campaignname = $('#name').val();
    const campaignsummary = $('#campaign-summary').val();
    const campaignrequest = $('#campaign-request').val();
    const campaignstart = $('#campaign-start').val();
    const campaignend = $('#campaign-end').val();
    const brandname = $('#brandname').val();
    $.ajax({
        type: 'POST',
        url: '/includes/ajax/updatecampaign.php',
        data: {
            campaignid : campaignid,
            campaignname: campaignname,
            campaignsummary: campaignsummary,
            campaignrequest:campaignrequest,
            campaignstart:campaignstart,
            campaignend:campaignend,
            brandname:brandname
        },
        success: function (jqXHR, textStatus, errorThrown) {
            dialog = bootbox.dialog({
                message: '<div class="bootbox-body">'+
            '<div class="icon-popup-div"> <img src="https://68.media.tumblr.com/0abd1f3bfd0a2594ea81787691cb6af2/tumblr_o33ti7IZMI1t4twpao1_500.gif" class="success-popup-icon"/> </div>'+
            '<div class="row"> <div class="col-xs-12 popup-detail success"> <br/> Your campaign has been edited. </div><div class="popup-btn-div"> <a href="/campaigns/?id='+campaignid+'"><button id="applyall" class="submit-btn" style="margin-bottom: 50px;">VIEW CAMPAIGN </button></a></div>'+
            '</div> </div>',
                closeButton: true
            });
            dialog.modal();

        }

    }); // end ajax request*/

});


$(document).on('click','.delete',function(){
        $.ajax({
        type: 'POST',
        url: '/includes/ajax/deletecampaign.php',
        data: {
            campaignid : campaignid,
        },
        success: function (jqXHR, textStatus, errorThrown) {
            dialog = bootbox.dialog({
                message: '<div class="bootbox-body">'+
            '<div class="icon-popup-div"> <img src="https://68.media.tumblr.com/0abd1f3bfd0a2594ea81787691cb6af2/tumblr_o33ti7IZMI1t4twpao1_500.gif" class="success-popup-icon"/> </div>'+
            '<div class="row"> <div class="col-xs-12 popup-detail success"> <br/> Your campaign has been deleted. </div><div class="popup-btn-div"> <a href="/dashboard.php"><button id="applyall" class="submit-btn" style="margin-bottom: 50px;">VIEW CAMPAIGNS </button></a></div>'+
            '</div> </div>',
                closeButton: true
            });
            dialog.modal();

        }

    }); // end ajax request*/

});
</script>