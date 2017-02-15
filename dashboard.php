<?php
session_start();
//error_reporting(0);
include 'includes/dbinfo.php';
include 'includes/numberAbbreviation.php';

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
<style>
a:hover{
    text-decoration:none;
}
#allcampaigns{
    font-size: 22px;
    font-family: 'open sans';
    color: #515862;
    letter-spacing: 1px;
}

.divider-top{
    border-bottom:1px solid rgb(210,215,220);
    padding-bottom:20px;
    border-right:1px solid rgb(210,215,220);
}

#campaign-details{
    position: fixed;
    width: 21%;
    border-left: 1px solid rgb(210,215,220);
    margin-left: -14px;
    padding-left: 14px;
    margin-bottom: 20px;
    padding-bottom: 100%;
}

.stats{
    color: #73C48D;
    font-family: 'montserratsemibold';
    font-size: 3em;
    padding-right: 17px;
    font-weight: 600;
        padding-top: 20px;
}

.label-info{

    color: rgb(29, 40, 76);
    font-weight: 600;
    font-size: 15px;
    font-family: 'open sans';
    padding-bottom: 10px;

}

.campaign-block{
    border-bottom: 1px solid rgb(210,215,220);
    padding-bottom: 10px;
    padding-top: 0px;
    border-right:1px solid rgb(210,215,220);
}

#campaign-title{
color: rgb(29, 40, 76);
font-size: 20px;
font-family:'open sans';

}

.title{
    font-weight:600;
    font-family:'open sans';
    font-size:15px;
    color:rgb(29, 40, 76);
}

#summary{
    color:#515862;
    font-size:13px;
    width: 70%;
}

.option-button{
    border: 1px solid black;
    border-radius: 0px;
    background-color: white;
    font-size: 13px;
    font-family: 'montserratthin';
    padding-left: 1px;
    margin-right: 5px;
    height: 40px;
    width: 130px;
}
.campaign-block:hover{
    background-color:#eaeaea;
}
.other-nav{
    padding-bottom:21px;
}
</style>
</head>

<body class="col-xs-12" style="padding-left:0px;padding-right:0px;">

    <div class="col-xs-12" style="border-top: 1px solid rgb(210,215,220); border-bottom:1px solid rgb(210,215,220); height:66px;">
       <img src="/assets/images/at-logo-black.png" style="margin-top:-8px;">

    </div>
<!-- Content where the discover, communicatie, order management would be -->
<div class="mininav" style="margin-top:65px" >
    <p class="nav2"> <a href="" class="other-nav discover-nav"> DISCOVER </a> </p>
      <p class="nav2"> <a href="" class="other-nav create-nav"> CREATE </a> </p>
        <p class="nav2"> <a href="" class="other-nav price-nav">  PRICE CAMPAIGN </a></p>
          <p class="nav2"> <a href="" class="other-nav campaign-nav"> YOUR CAMPAIGNS </a>  </p>
</div>








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


<div class="col-xs-2 col-xl-2" style="padding-top: 75px;">
    <div id="campaign-details">
       <p id="campaign-title">T-shirt Spring Frenzy </p>
       <p class="title"> Campaign Summary</p>
       <p id="summary"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec imperdiet hendrerit turpis id consectetur. 
           Aliquam eget risus egestas, placerat leo non, tincidunt est. Aliquam fringilla ultrices vulputate. Nunc magna tellus, egestas ac posuere sit amet, sagittis vitae orci. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. </p>
       <p class="title">Campaign Schedule</p>
       <p id="schedule"> <strong> Start</strong> April 1 <strong> April 6 </strong>
       <div id="button-container"> 
           <button class="option-button"> Delete Campaign </button>
           <button class="option-button"> View Campaign </button>
        </div>











    </div>



    </div>


<div id="campaign-container">

    <div class="campaign-block col-xl-9">
        <table class="col-xl-12">
            <tbody style="border-top:0px;">
            <tr>
                <td style="font-size:17px; color:rgb(29, 40, 76); font-family:'open sans'; padding-top: 30px;"> T-shirt Spring Frenzy </td>
                <td style="font-size:15px; color:rgb(29, 40, 76); font-family:'open sans'; padding-top: 30px;">&#9679; Campaign in process </td>
                <td style="font-size:15px; color:rgb(29, 40, 76); font-family:'open sans'; padding-top: 30px;"> Created 6/22/2015</td>
            </tr>
            <tr>
                <td class="stats"> 107</td>
                <td class="stats"> 7 </td>
                <td class="stats"> 22,000 </td>
                <td class="stats">1,000</td>
                <td class="stats">23,000</td>
            </tr>
            <tr>
                <td class="label-info"># of Influencers invited</td>
                <td class="label-info"> Unread Messages </td>
                <td class="label-info"> Number of likes </td>
                <td class="label-info"> Number of comments </td>
                <td class="label-info"> Total Reach</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="campaign-block col-xl-9">
        <table class="col-xl-12">
            <tbody style="border-top:0px;">
            <tr>
                <td style="font-size:17px; color:rgb(29, 40, 76); font-family:'open sans'; padding-top: 30px;"> T-shirt Spring Frenzy </td>
                <td style="font-size:15px; color:rgb(29, 40, 76); font-family:'open sans'; padding-top: 30px;">&#9679; Campaign in process </td>
                <td style="font-size:15px; color:rgb(29, 40, 76); font-family:'open sans'; padding-top: 30px;"> Created 6/22/2015</td>
            </tr>
            <tr>
                <td class="stats"> 107</td>
                <td class="stats"> 7 </td>
                <td class="stats"> 22,000 </td>
                <td class="stats">1,000</td>
                <td class="stats">23,000</td>
            </tr>
            <tr>
                <td class="label-info"># of Influencers invited</td>
                <td class="label-info"> Unread Messages </td>
                <td class="label-info"> Number of likes </td>
                <td class="label-info"> Number of comments </td>
                <td class="label-info"> Total Reach</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="campaign-block col-xl-9">
        <table class="col-xl-12">
            <tbody style="border-top:0px;">
            <tr>
                <td style="font-size:17px; color:rgb(29, 40, 76); font-family:'open sans'; padding-top: 30px;"> T-shirt Spring Frenzy </td>
                <td style="font-size:15px; color:rgb(29, 40, 76); font-family:'open sans'; padding-top: 30px;">&#9679; Campaign in process </td>
                <td style="font-size:15px; color:rgb(29, 40, 76); font-family:'open sans'; padding-top: 30px;"> Created 6/22/2015</td>
            </tr>
            <tr>
                <td class="stats"> 107</td>
                <td class="stats"> 7 </td>
                <td class="stats"> 22,000 </td>
                <td class="stats">1,000</td>
                <td class="stats">23,000</td>
            </tr>
            <tr>
                <td class="label-info"># of Influencers invited</td>
                <td class="label-info"> Unread Messages </td>
                <td class="label-info"> Number of likes </td>
                <td class="label-info"> Number of comments </td>
                <td class="label-info"> Total Reach</td>
            </tr>
            </tbody>
        </table>
    </div>



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

</script>

