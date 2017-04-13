<?php
session_start();
include '../php/class/savecampaign.php';
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



?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head> 
  <?php include '../html/head.html' ?>
    <title>Avocado & Toast</title>
<script src="/bootbox/bootbox.js"></script>
<script src="/global/vendor/bootstrap/bootstrap.js"></script>
<script src="/assets/uislider/nouislider.js"></script>
<link rel="stylesheet" href="/assets/css/discover.css">
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






<div class="container" style="margin-left:28.2%; padding-bottom:100px;">

<p class="desc-header" id="edit-campaign-name" style="padding-top:30px;">Edit </p>
<div class="input-container" style="width:45%;">

    <label class="title">Campaign Name </label>
    <input type="text" class="form-control category avocado-focus" id="name" value="">


    <label class="title">Brand Name </label>
    <input type="text" class="form-control category avocado-focus" id="brand-name" value="">

    <label class="title">Campaign Summary </label>
    <br/>
    <label>What is it you are trying to do? </label>
    <textarea type="text" class="form-control category avocado-focus" id="campaign-summary"   style="height:150px;"></textarea>
    <label class="title">Campaign Requests </label>
    <br/>
    <label>What type of content do you want? Be specific about what the influencer should be posting about.</label>
    <textarea type="text" class="form-control category avocado-focus" id="campaign-request" style="height:150px;"></textarea>

    <label class="title">Campaign Schedule </label>
    <br/>
    <div class="col-xs-12" style="padding-left:0px; padding-right:0px;">
        <input type="date" class="form-control category avocado-focus" id="campaign-start" style="float:left; width:45%;" value=""><p style="float:left; padding-left:3%;padding-right:3%;">to</p> 
        <input type="date" class="form-control category avocado-focus"  id="campaign-end" style="float:left; width:45%;" value="">
    </div>
    <div style="margin-top:50px;">
        <button class="col-xs-4 delete" id="search-keyword" style="float:left; margin-left: 4.2%; width:40%; background-color:white; border:1px solid #30363C; color:#30363C;">DELETE</button>
        <button class="search avocado-hover col-xs-4 submit" id="search-keyword" style="float:left; margin-left:10%; width:40%;">SUBMIT</button>
    </div>


</div>

</div>

<script>
const campaignid = '<?php echo $campaignid; ?>';
</script>
<script src="/assets/js/editcampaign.js"></script>