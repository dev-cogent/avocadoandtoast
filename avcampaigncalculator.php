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
    <title>Blank Page | Project Social</title>
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
<style>

.nav2{
    font-family: 'Montserrat', sans-serif;
    font-size: 18px;
    display: inline;
    color: #30363f;
    letter-spacing: 1px;
    font-weight: 400;
    line-height: 65px;
}


.nav3{
    font-family: 'Montserrat', sans-serif;
    display: inline;
    color: #30363f;
    font-weight: 600;
    font-size: 13px;
    line-height: 45px;
}

.mininav{
        height:66px;
        padding-left:125px;
        border-top: 1px solid rgb(210,215,220);
        border-bottom:1px solid rgb(210,215,220);
        
}

.sidebar-left{
    float:left;
    background-color: #30363f;
    height:120%;
    max-width:55px;
    min-width:50px;
    position:absolute;
    z-index:1;
    min-height: 100%;
    
}


.filter-container{
height:360px;
/*width:75%;*/
border: 1px solid rgb(210,215,220);
padding-left:75px;
padding-top:15px;
float:left;
}

.user-container{
border-top:1px solid rgb(210,215,220);
border-bottom:0px;
height:100%;    
padding-left:26px;
padding-right:25px;
min-height:100%;
float:right;
}

.desc-header{
    font-size: 25px;
    color: #515862;
    font-weight: 100;
    /*font-family: 'Open Sans', sans-serif;*/
    letter-spacing:0.5px;
    margin-left:-10px;
}

#searchA{
    /*width:44%;*/
    padding-left:10px;
    display:inline-block;
    float:left;
}

#searchB{
    display: inline-block;
    /*width: 44%;*/
    float: left;

}


.filter-text{
    font-size: 20px;
    color: #30363F;
    font-family: 'Open Sans', sans-serif;
    font-weight: 400;
    padding-left: 11px;
    min-width: 135px;

}
.category{
    border: 1px solid #30363F;
    border-radius: 1px;
    color: #1F232A;
    font-family: 'Open Sans', sans-serif;
    min-width:150px;
}



.search{
    width: 100%;
    border-radius: 1px; 
    border: 1px solid #1F232A;
    color:#1F232A;
    background-color:white;
    height:50px;
    font-size:16px;
    font-family: 'Montserrat', sans-serif;
}
.search:hover{
    border: 1px solid #73C48D;
    color:#73C48D;
}
.search:focus{
    outline: none !important;
    border: 1px solid #73C48D;
    color:#73C48D;
    box-shadow: 0 0 10px #73C48D;
}
#divider{
float: left;
padding-left: 0.2%;
}


#divider1{
    
    background-color: rgb(210,215,220);
    height: 104px;
    width: 2px;
    margin-left: 7px;
    margin-top: 12px;
}

#divider2{
    background-color: rgb(210,215,220);
    height: 104px;
    width: 2px;
    margin-left: 7px;
}

.description-text{
    color:#A2A8B1;
    /*font-family: 'Open Sans', sans-serif;*/
    font-weight:100;
    margin-top:1rem;
    font-size:14px;
    max-width:632px;

}
#count{
    color:#73C48D;
    font-size: 40px;
    font-family: 'Montserrat', sans-serif;
    font-weight: 600;
    display:inline;
    padding-left:15px;

}

#viewall{
    display: inline;
    float: right;
    height: 35px;
    margin-top: 12px;
    width: 100px;
    background-color: white;
    color: #1F232A;
    border: 1px solid #1F232A;
}

#viewall:focus{
    outline: none !important;
    border: 1px solid #73C48D;
    color:#73C48D;
    box-shadow: 0 0 10px #73C48D;

}
#viewall:hover{
    border: 1px solid #73C48D;
    color:#73C48D;
}

#added-influencers{

}
.influencer-add-image{
    height: 75px;
    width: 75px;
    padding-right: 1px;
    padding-bottom: 1px;

}

.noUi-connect {
	background: #30363F;
	box-shadow: inset 0 0 3px rgba(51,51,51,0.45);
-webkit-transition: background 450ms;
	transition: background 450ms;
}

.noUi-handle {
    border-radius: 30px;
    background: #A2A8B1;
    cursor: default;
    width:20px;
    height:20px;
    box-shadow:none;
    border:0px;
}

.noUi-base {
    width: 100%;
    height: 100%;
    position: relative;
    z-index: 1;
    border-radius:10px;
}

.influencer-card-discover{
    height: 65%;
    /*margin-right: 8%;*/
    border: 1px solid rgb(210,215,220);
    float:left;
    width:88%;
    margin-bottom:30px;
    padding-right:0px;
    padding-left:0px;
}

.influencer-card-discover:hover{
      border: 1px solid #73C48D;

}

.influencer-image-card{
    max-width: 100%;
    width:100%;
    object-fit: cover;
    object-position: 0 33%
    
}


.noUi-horizontal .noUi-handle {
    width: 20px;
    height: 20px;
    left: -17px;
    top: -6px;
    height: 1;
}
.divider-text{
color: black;
font-size: 18px; 
margin-bottom: 2px;
}


#search-influencer{
margin-top:120px;
width:110%;
}

#right-input-field{
width:110%;
}

.measure-text{
    font-size: 13px;
    font-family: 'Montserrat', sans-serif;
    color: #30363F;
    font-weight: 600;
    padding-left: 11px;
    min-width: 120px;
}

#text-container{
    padding-right:5.5%; 
    display:inline; 
    float:left;
    padding-left:0px;
}

#additional-influencers{
    margin-left: 30%;
    height: 40px;
    width: 100px;
    background-color: #73C48D;
    border: 0px solid black;
    color: white;
    margin-top: -10%;
}



#slider-instagram{

    height:12px;
    margin-top:5px;
    margin-left:-4%;
    padding-right:0px;
}

#slider-instagram-engagement{

    height:12px;
    margin-top:5px;
    margin-left:-4%;
    padding-right:0px;
}

#slider-twitter{

    height:12px;
    margin-top:5px;
    margin-left:-4%;
    padding-right:0px;
}

#slider-twitter-engagement{

    height:12px;
    margin-top:5px;
    margin-left:-4%;
    padding-right:0px;
}

#slider-facebook{
    height:12px;
    margin-top:5px;
    margin-left:-4%;
    padding-right:0px;
}

#slider-facebook-engagement{
    height:12px;
    margin-top:5px;
    margin-left:-4%;
    padding-right:0px;
}

#influ-result{
 margin-top:5px;
     color:#A2A8B1;
    font-weight:100;
    font-size:14px;
}

.influencer-box{
padding-left:0px;
padding-right:0px;
}


.insthandle-text{
    font-family: 'Montserrat';
    font-weight: 100;
    letter-spacing: 0px;
    text-align: center;
    padding-top: 15px;
    font-size: 20px;
    display: inline;
    max-width: 20px;
}

.follower-count{
    text-align: center;
    font-size: 15px;
    font-family: 'Montserrat';
    font-weight: 200;
    margin-top: -5px;
}

.engagement-count{
    text-align: center;
    font-size: 15px;
    font-family: 'Montserrat';
    font-weight: 200;
    margin-top: -17px;
    padding-bottom: 5px;
}

.invite{
    text-align: center;
    border: 1px solid #515862;
    height: 35px;
    padding-top:5px;
    color:#515862;
}


.insthandle-info{
    text-align: center;
    padding-bottom: 6px;
}

.inst-icon{
    height: 12px;
    width: 12px;
    display: inline;
    margin-right: 15px;
    margin-bottom: 5px;
}

.avocado-hover:hover{
    border:1px solid #73C48D;
    color:#73C48D;
}

.avocado-focus:focus{
    border:1px solid #73C48D;

}


.thumb-up{
    display: inline;
    width: 20px;
    height: 20px;
    margin-right: 14px;
    margin-left: -30px;
    margin-bottom: 7px;
}


.input-filter{
border:0px;
color:#30363F;
padding-left:0px;
padding-right:0px;

}

.input-filter:focus{
    outline: none;
    background-color:transparent;
}


.tokenfield{
position:inherit; 
margin-top:93px;
height:35px;
border: 1px solid #30363F;
border-radius: 1px;
color: #1F232A;
font-family: 'Open Sans', sans-serif;
min-width:150px;
}

.tokenfield.focus{
    outline: none !important;
    border: 1px solid #73C48D;

}


.token{
border:1px solid #30363F !important;
background-color:white !important;
color:#30363F;
font-family: 'Open Sans', sans-serif;
font-weight:600;
}
.token:hover{
border:1px solid #73C48D !important;
color:#73C48D;
}
.close{
margin-left: 5px;
padding-left: 10px;
border-left:1px solid #30363F;
}

.close:hover{
color:#73C48D;
}

#fixed-position{
    padding-right:29px;
    position: fixed;
    border-left: 1px solid rgb(210,215,220);
    margin-left: -27px;
    padding-left: 20px;
    height: 100%;
    overflow:scroll;
}

.hidden-influencers{
    display:none;
}

.icons{
    text-align:center;
    margin-left:8px;
    padding-top: 6px;
}

.filter-option{
    padding-bottom:2rem;
    font-size: 13px;
    font-family: 'Montserrat', sans-serif;
    color: #30363F;
    font-weight: 600;
    padding-left: 11px;
    background-color:#A2A8B1;
    border:1px;
    float:left;
    margin-bottom: 8px;
}

.filter-option-text{
    position: absolute;
    padding-left: 13%;
    color:white;
}

.filter-option-text:focus{
/* stuff */
}

.button-icon{
    padding-right:10px;
}


.engagement-slider{
    margin-top:13px;
}


.select-bar{
    height: 6px;
    width: 104px;
    background-color: #73C48D;
    /* display: inline; */
    /* padding-left: 103px; */
    /* padding-top: 20px; */
    margin-top: -7px;
}

.info-container{
border-bottom: 1px solid rgb(210,215,220);
height:150px;

}
.info-button{
    float: right;
    height: 30px;
    font-family: 'Montserrat', sans-serif;
    margin-top: 52px;
    height: 50px;
    margin-left: 20px;
    width: 200px;
    
}
.info-button:focus{

outline: none;
}

.secondary-button{
border:1px solid #30363F;
color:#30363F;
background-color:white;
}
.main-button{
color:white;
background-color:#73C48D;
border:0px;

}

.campaign-select{
    padding-left:75px;
    padding-top:20px;
}
.campaign-dropdown{
    display:inline;
    width:20%;
}

#campaign-select-text{
    color:#30363F;
    padding-left: 25px;
    display:inline; 
    padding-top:7px;
}


.post-container{
padding-left:6%;
padding-right:3%;
}

#apply{
    height: 40px;
    width: 180px;
    font-size:15px;
    font-family: 'Montserrat', sans-serif;
    float:left;
}
#apply:focus{
    outline: none;
}



.number-posts-text{
    color:#30363F;
    font-size:12px;
    display:inline;
    padding-left:10px;
}

.influencer-campaign-image{
    max-width: 65px;
    max-height: 65px;
    width: 100%;
    height: 100%;
    float:left;
}


.influencer-handle-text{
    font-size:15px;
    color:#30363F;
    font-weight:100;
    padding-left:12px;
}


 .campaignfocus:focus{
    outline: none;
    background-color:transparent;
    color: rgba(0, 0, 44, 0.37);
}
.campaignfocus{
background-color:transparent;
border:none; 
text-align:center; 
font-size:3em; 
width:200px;
color: #30363F;
font-family: 'Montserrat', sans-serif;
    }


.result-row{
    border-top:1px solid rgb(210,215,220);
}

.result-name{
    font-size:16px;
    font-family: 'Montserrat', sans-serif;
    color:#515862;
    
}

.handle{
    margin-right:-25px;
}

.information{
    max-width:180px;
}
.location-text{
    margin-right:-45px;
}

.results-text{
    color: #73C48D;
    font-family: 'Montserrat', sans-serif;
    font-size: 3em;
    padding-right: 17px;
}
tbody{
    border-top:1px solid rgb(210,215,220);
}







/*NEW STYLING */
#campaign-name{
    border: 0px;
    border-bottom: 1px solid #e5e5e5;
    width: 400px;
    font-size: 30px;
    color: #A2A8B1;
}

#campaign-name:focus{
    outline:none;
}

</style>

</head>

<body class="col-xs-12" style="padding-left:0px;padding-right:0px;">

<!-- Content where the discover, communicatie, order management would be -->
<div class="mininav" >
    <p class="nav2">DISCOVER</p>

    <div class="select-bar"></div>
</div>











<!-- Add side bar here -->

<div class="col-xs-1 sidebar-left"></div>


<div class="col-xs-11 info-container">

   <!-- <div class="col-xs-12 campaign-select"> 
        <p  id="campaign-select-text" class="col-xs-12 col-md-1">Select Campaign:</p>
            <select class="form-control category avocado-focus  campaign-dropdown col-xs-12">
                <option class="option" value="fitness">Campaign Name</option>
                <option class="option" value="music">Music</option>
                <option class="option" value="movie">Film/Movies</option>
                <option class="option" value="fashion">Fashion</option>
                <option class="option" value="beauty">Beauty</option>
                <option class="option" value=""> None</option>
            </select>
        -->
    <div class="col-md-12 col-lg-6" style="margin-top:59px;margin-left: 5%;">
    <label style="font-family: 'Montserrat', sans-serif;color: black; padding-right:10px;">CAMPAIGN NAME:</label><input id="campaign-name" type="text" placeholder="Untitled Campaign">
    </div>
    <button class="col-md-6 col-lg-3 info-button secondary-button" style="margin-right: 100px;">SUBMIT FOR PRICING</button>
    <button class="col-md-6 col-lg-3 info-button main-button">CREATE CAMPAIGN </button>




</div>

<div class="post-container col-xs-11">

              <table summary="This table shows a list of influencers added to a campaign" style="width: 100%; max-width: 100%; margin-bottom: 1rem;"class="table-hover">
                <thead class="campaign-calc-table">
                  <tr class="cat-in-campaign-list-table">
                      <th class="text-center"><button class="secondary-button" id="apply">Apply Posts to All</button></th>
                      <th class="text-center"> <img src="assets/images/ig_black.png" class="insta-logo" />
                    <p class="number-posts-text"> Number of Posts </p>  </th>
                      <th class="text-center"> <img src="assets/images/fb_black.png" class="fb-logo" /> <p class="number-posts-text">  Number of Posts </p> </th>
                      <th class="text-center"> <img src="assets/images/twitter_black.png" class="twitter-logo2" /> <p class="number-posts-text"> Number of Posts </p> </th>
                    </tr>
                  </thead>
                  <tbody>




                        <tr class="campaign-list-table">
                        <td class="campaign-tablerow" style="width:15%;">
                                <div class="information"> 
                            <img src="http://project.social/images/5AUgZ0C.jpg" class="influencer-campaign-image ">
                            <h4 class="influencer-handle-text handle">@Cristiano</h4>
                            <h4 class="influencer-handle-text location-text">Madrid, Spain</h4>
                      </div></td>

                      <td data-id="'.$id.'" class="insta-column" style="width:15%;"><input data-id="'.$id.'" data-platform="instagram" class="instagraminput campaignfocus" type="number" value="0" max="100"> </td>
                      <td data-id="'.$id.'" class="twit-column" style="width:15%;"> <input data-id="'.$id.'" data-platform="facebook" class="facebookinput campaignfocus" type="number" value="0" max="100"> </td>
                      <td data-id="'.$id.'" class="face-column" style="width:15%;"> <input data-id="'.$id.'" data-platform="twitter" class="twitterinput campaignfocus" type="number" value="0" max="100"> </td>
                    </tr>

                       
                       <!-- results -->
                        <tr class="result-row campaign-list-table">
                        <td class="campaign-tablerow" style="width:15%;">
                            <div class="information"> 
                                <p class="result-name">TOTAL ENGAGEMENT</p>
                            </div>
                      <td  class="insta-column" style="width:15%;"><p class="instagram-posts results-text"> 0 </p> </td>
                      <td  class="twit-column" style="width:15%;"> <p class="facebook-posts results-text"> 0 </p> </td>
                      <td  class="face-column" style="width:15%;"> <p class="twitter-posts results-text"> 0 </p></td>
                    </tr>
                    

                        <tr class="result-row campaign-list-table">
                        <td class="campaign-tablerow" style="width:15%;">
                            <div class="information"> 
                            <p class="result-name">TOTAL IMPRESSIONS</p>
                            </div>
                      <td  class="insta-column" style="width:15%;"><p class="instagram-posts results-text"> 0 </p> </td>
                      <td  class="twit-column" style="width:15%;"> <p class="facebook-posts results-text"> 0 </p> </td>
                      <td  class="face-column" style="width:15%;"> <p class="twitter-posts results-text"> 0 </p></td>
                    </tr>


                    </tbody>
                </table>
</div>










</body>
</html>