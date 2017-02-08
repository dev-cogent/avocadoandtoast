<?php
//have to make a check to see if this is your list or not. 
session_start();
$columnid = $_SESSION['column_id'];
include 'includes/class/savecampaign.php';
include 'includes/numberAbbreviation.php';
$obj = new saveCampaign;
$influencers = array();
$campaignid = $_GET['q'];
$campaignconn = $obj->savedDB();
$conn = $obj->dbinfo();
$stmt = $conn->prepare('SELECT `campaign_id` FROM `campaign_save_link` WHERE `column_id` = ? AND `campaign_id` = ?');
$stmt->bind_param('ss',$columnid,$campaignid);
$stmt->execute();
$stmt->bind_result($check);
$stmt->fetch();
if($check === NULL) header('Location:/mylists.php');
//will need to be changed to 'mycampaigns'
unset($stmt);
$stmt = $campaignconn->prepare("SELECT `influencer_id` FROM `$campaignid` LIMIT 0,10");
$stmt->execute();
$stmt->bind_result($influencer);
while($stmt->fetch()){
array_push($influencers,$influencer);
}
unset($stmt);
$stmt = $conn->prepare('SELECT `campaign_name` FROM `campaign_save_link` WHERE `campaign_id` = ?');
$stmt->bind_param('s',$campaignid);
$stmt->execute();
$stmt->bind_result($campaignname);
$stmt->fetch();

?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <?php include 'includes/head.php' ?>
    <title><?php echo $campaignname;?> | Project Social</title>
<script src="/bootbox/bootbox.js"></script>
<script src="/includes/javascript/savecampaign.js"></script>
<script src="/includes/javascript/addtolist.js"></script>
<script src="/global/vendor/bootstrap/bootstrap.js"></script>
<style>
.overlay{
  height:173px;
  width:100%;
  position:absolute;
  z-index:100;
  background-color:pink;
}


</style>
</head>
<body>
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
   <?php include 'includes/nav.php' ?>

    <!-- Page -->
        <div class="row">
            <div class="overlay" style="display:none;">
                <div class="container">
                    <div style="margin-top:30px;">
                    <h3 style="display:inline;"> Edit Mode</h3> 
                    <a  style="color:white; display:inline; float:right;" class="btn btn-primary main-btn" role="button"> Submit </a>
                    <a  style="color:white; display:inline; float:right;" class="btn btn-primary main-btn" role="button" id="deletemultiple"> Delete Selected </a>
                    </div>
                <br>
                  <input  type="text" class="form-control list-create-form" name="" placeholder="List Name" style="display:inline; width:45%; margin-left:50px;">
                  <input  type="text" class="form-control list-create-form" name="" placeholder="Description" style="display:inline; width:46.5%; margin-left:50px;">
                  <div id="edit"> X </div>
                  </div>
              </div>
            <div class="col-xs-6">
          <div class="list-header">
            <div class="backtolist-title-div"> <a href="/mylists.php" class="backtolist-title">Back to my lists </a> </div>
                <div class="list-title-overlay"><h1 class="list-overlay header"><?php echo $campaignname; ?> </h1> </div>
              </div>
            </div>

            <div class="col-xs-6">
          <div class="list-name-buttons-pad ">
              <a href="#" class="btn btn-primary main-btn delete-btn" role="button" id="delete"> Delete List </a>
                <?php echo '<a href="/launchcampaign.php?q='.$campaignid.'"class="btn btn-primary main-btn delete-btn" role="button"  id="launch">Launch Campaign </a>'; ?>
                <a href="#" class="btn btn-primary main-btn" role="button" id="edit"> Edit Campaign </a>
                <?php echo' <a href="/campaigncalculator2.php?q='.$campaignid.'" class="btn btn-primary main-btn" role="button" id="edit"> Re-Calculate </a>';?>
                <a href="#" class="btn btn-primary main-btn pricing-btn" role="button"> Submit for pricing  </a>
        </div>


            </div>

              </div>
            </div>

    <div class="row campaignname-nav">
        <div class="col-xs-6">
          <div class="input-search list" style="padding-left:38.4%">
                        <button type="submit" class="input-search-btn"><i class="icon wb-search" aria-hidden="true"></i></button>
                        <input id="search" type="text" class="form-control list-create-form" name="" placeholder="+ Influencers">
                      </div>

        </div>

        <div class="col-xs-6">

          <div class="buttons-pad ">
            <div class="card-view-list" data-type="card"><i class="fa fa-1x fa-th" style=""></i><h5 style="display:inline;" class="card-h5" id="cardview">Card View</h5></div>
            <div class="list-view" data-type="list"><i class="fa fa-1x fa-bars" style=""></i><h5 style="display:inline;" class="card-h5" id="listview">List View</h5></div>

            <div class="sortby-div">
             <h7 class="sort-by list-sort"> SORT BY </h7>
            <div class="btn-group my-list">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            A TO Z <span class="caret"></span>
          </button>
          <ul class="dropdown-menu list">
            <li><a href="#" class="z-a"> Z TO A </a></li>
          </ul>
        </div>
      </div>
      </div>

    </div>
</div>


<div id="clearthis" class="container">
  <div class="row">
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
                <tbody id="table">

                  <?php 
                  /**stuff goes in here 👽
                  *👽
                  *👽
                  *👽
                  *👽
                  */


                  ?>
                  


                </tbody>

<script>
        //global variables
        var overlay = false;
        var page = 0;
        var type = "list";
        var selectedinfluencers = [];
        var list = getParameterByName('q');
        var influencers;
        function getParameterByName(name, url) {
        if (!url) {
          url = window.location.href;
        }
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
}
</script>
<script src="/includes/javascript/listpagination.js"></script>

</div>
  </div>
</div>
</div>
