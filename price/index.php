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
$campaignname = $save->getCampaignName($campaignid);
if(isset($campaignstart)){
    $today = $campaignstart;
}
if(isset($campaignend)){
    $tomorrow = $campaignend;
}
$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];
$email = $_SESSION['email'];
$company = $_SESSION['company'];



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
    min-width:231.5px;
}

li{
    list-style:none;
    padding-top:3px;
}

.social{
    margin-right:10px;
}
.social-text{
    display:inline;
    font-size:14px;
    color: #515862;
    font-family:'Open Sans', sans-serif;
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
    <li class="item"><a class="side-link" href="dashboard.php"> DASHBOARD </a> </li>
    <li class="item"><a class="side-link" href="acdiscover.php"> DISCOVER </a></li>
    <li class="item"><a class="side-link" href="#"> ACCOUNT SETTINGS </a></li>
    <li class="item"><a class="side-link" href="#"> FAQ</a> </li>
    <li class="item"><a class="side-link" href="#"> CONTACT</a> </li>
    <li class="item"><a class="side-link" href="#"> LATEST UPDATES</a></li>
    <li class="item"><a class="side-link" href="#"> LOGOUT</a></li>
  </div>
</div>
<div id="stuff"></div>
<script src="/includes/javascript/sidebar-left.js"></script>
<script>
    var target2 = $('#stuff').offset().top;
</script>

<div class="container" style="margin-left:28.2%; padding-bottom:100px;">

<p class="desc-header" style="padding-top:30px;"> Price <?php echo $campaignname; ?></p>
<div class="input-container" style="width:45%;">
    <h3>Contact Information </h3>
        <label class="title">Email</label>
    <br/>
    <input type="text" class="form-control category avocado-focus" id="brand" value="<?php echo $_SESSION['email'] ?> " placeholder="required*">

    <label class="title">Name</label>
    <br/>
    <input type="text" class="form-control category avocado-focus" id="brand" value="<?php echo $firstname.' '.$lastname ; ?>" placeholder="required*">

    <label class="title">Company</label>
    <br/>
    <input type="text" class="form-control category avocado-focus" id="brand" value="<?php echo $company ; ?>" placeholder="required*">


    <label class="title">Title</label>
    <br/>
    <input type="text" class="form-control category avocado-focus" id="brand" value="" placeholder="required*">


    <label class="title">Phone Number</label>
    <br/>
    <input type="text" class="form-control category avocado-focus" id="brand" value="" placeholder="required*">

    <br/>
    <hr>
    <h3>Campaign Information</h3>

    <label class="title">Brand</label>
    <br/>
    <input type="text" class="form-control category avocado-focus" id="brand" value="" placeholder="required*">

    <label class="title">Budget</label>
    <br/>
    <input type="text" class="form-control category avocado-focus" id="brand" value="" placeholder="Required*">



    <label class="title">Offer Expiration Date</label>
    <br/>
    <input type= "text" class="form-control category avocado-focus" id="campaign-request">

    <label class="title">Campaign Details </label>
    <br/>
    <label>Overview, Launch Date, Duration etc </label>
    <textarea type="text" class="form-control category avocado-focus" id="campaign-details" style="height:150px;" ><?php echo $campaignsummary; ?></textarea> 

    <!--<label class="title">Launch Date</label>
    <br/>
    <input class="form-control category avocado-focus"type="date" value="<?php //echo $campaignstart;?>">-->


    <label class="title">Target Demographic</label>
    <br/>
    <input type="text" class="form-control category avocado-focus" id="payout" value="" placeholder="Required">
    <br/>

    <label class="title">Influencer Services</label>
    <br/>
    <li><input class="social" type="checkbox"><p class="social-text">Instagram</p></li>
    <li><input class="social" type="checkbox"><p class="social-text">Facebook</p></li>
    <li><input class="social" type="checkbox"><p class="social-text">Twitter</p></li>
    <li><input class="social" type="checkbox"><p class="social-text">Youtube</p></li>
    <br/>

    <div style="margin-top:50px;">
        <button class="search avocado-hover col-xs-4 submit" id="price-campaign" style="float:left;  width:40%;">SUBMIT FOR PRICING</button>
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
    $.ajax({
        type: 'POST',
        url: '/includes/ajax/updatecampaign.php',
        data: {
            campaignid : campaignid,
            campaignname: campaignname,
            campaignsummary: campaignsummary,
            campaignrequest:campaignrequest,
            campaignstart:campaignstart,
            campaignend:campaignend
        },
        success: function (jqXHR, textStatus, errorThrown) {
            dialog = bootbox.dialog({
                message: '<div class="bootbox-body">'+
            '<div class="icon-popup-div"> <img src="https://68.media.tumblr.com/0abd1f3bfd0a2594ea81787691cb6af2/tumblr_o33ti7IZMI1t4twpao1_500.gif" class="success-popup-icon"/> </div>'+
            '<div class="row"> <div class="col-xs-12 popup-detail success">   <span class="yay"> YAY! </span> <br/> Your campaign has been edited.  </div>'+
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
            console.log('success');

        }

    }); // end ajax request*/

});
</script>

<!--
1) Client: (Agency, Brand, Publisher) 
2) Contact: (Person running point)
4) What kind of campaign? ( would just make this click as many as they need) 
Social Only
Social, Personal Appearance
Social, Personal Appearance,PR
360 deal, social, PR, Personal Appearance,  production days 
7) What are your KPI’s?
Reach new audiences
Engament
Click throughs
-->