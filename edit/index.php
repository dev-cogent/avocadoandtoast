<?php include '../php/verify-campaign.php';?>


<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <?php include '../html/head.html' ?>
    <title>Avocado & Toast</title>
<script src="/bootbox/bootbox.js"></script>
<script src="/global/vendor/bootstrap/bootstrap.js"></script>
<script src="/assets/uislider/nouislider.js"></script>
<link rel="stylesheet" href="/assets/css/dashboard.css">
<link rel="stylesheet" href="/assets/css/edit-campaign.css">
<link rel="stylesheet" href="/assets/css/footer.css">
</head>
<?php include '../php/avocado-nav.php';?>
<body class="col-xs-12 col-s-6"style="padding-left:0px;padding-right:0px;">


<div class="center-form-content">
<div class="white-space"></div>
<div class="desc-header" id="edit-campaign-name">Edit </div>
<div  class="input-container">

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

        <input type="date" class="col-xs-5 category avocado-focus avo-date" id="campaign-start" value="">
        <div id="date-seperate" class="col-xs-2">TO</div>
        <input type="date" class="col-xs-5 category avocado-focus avo-date"  id="campaign-end"  value="">
        <br/>

    <label class="title" style="visibility:hidden;">Buttons</label>

     <div class="col-xs-12 edit-buttons">
        <button class="col-xs-5 avo-btn-edit avo-btn-edit-secondary" id="delete-campaign" >DELETE</button>
        <button class="col-xs-5 avo-btn-edit avo-btn-edit-primary" id="submit-campaign" >SUBMIT</button>
        </div>

    </div>
 </div>
    <?php include '../footer.php'; ?>
</body class="col-s-6">

<script>
const campaignid = '<?php echo $campaignid; ?>';
</script>
<script src="/assets/js/editcampaign.js"></script>
