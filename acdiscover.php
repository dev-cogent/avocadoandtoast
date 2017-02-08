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


#calculate{
    display: inline;
    float: right;
    height: 35px;
    margin-top: 12px;
    width: 150px;
    background-color: #73C48D;
    color: white;
    border: 0px;
    margin-right: 10px;
    
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
    padding-top:5px;
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

#campaign-label{
font-family: 'Montserrat', sans-serif;
color: #30363F; 
padding-right:10px;

}
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
</div>








<!-- Add side bar here -->

<div class="col-xs-1 sidebar-left"></div>


<!-- The third nav bar , we might be able to take this out. In the mean time, we'll keep it here -->

<div class="mininav col-xs-12" style="height:50px;">
    <p class="nav3">INFLUENCERS</p>
</div>
<div id="stuff">

<!--Filter content -->

    <div class="filter-container col-xs-9">
            <p class="desc-header col-xs-12">Discover Influencers by Selecting the Audience You Seek</p>
            <div class="col-xs-6"id="searchA">
                <p class="filter-text col-xs-12"> Search by Industry or Hashtags</p>
                    <select class="form-control category avocado-focus col-xs-6 col-sm-12 dropdown">
                        <option class="option" value="fitness">Fitness</option>
                        <option class="option" value="music">Music</option>
                        <option class="option" value="movie">Film/Movies</option>
                        <option class="option" value="fashion">Fashion</option>
                        <option class="option" value="beauty">Beauty</option>
                        <option class="option" value=""> None</option>
                    </select>
                    <input type="text" class="form-control category avocado-focus col-xs-6 col-sm-12" style="margin-top:12px;" id="tokenfield"/>
                    <p class="description-text col-xs-12">Seperate tags with commas or by pressing "tab". Use double quotes for multi-word tags (e.g. "avocado toast")</p>
                    <button class="search avocado-hover col-xs-12" id="search-keyword">SEARCH</button>
            </div>

<!-- Divider goes  here -->
            <div id="divider">
                <div id="divider1"> </div>
                <p class="divider-text">or</p>
                <div id="divider2"> </div>
            </div>


            <div class="col-xs-5"id="searchB">
                    <p class="filter-text"> Search Specific Influencer by Name </p>
                    <input id="right-input-field" type="text" class="form-control category avocado-focus" value="@blobdoesnotexist"/>
                    <button id="search-influencer" class="search avocado-hover">SEARCH</button>
            </div>
            

    </div>

<div class="user-container col-xs-3" id="test-height"> 
    <div id="fixed-position">
    <p style="margin-top:1rem; font-weight:600;" class="filter-text"> Influencers Inside this Campaign </p>
    <p id="count">0</p>
    
    <button id="viewall" >View All </button>
    <button id="calculate" class="show-hidden">Calculate Campaign </button>


<!-- Eventually items will be appened here -->
    <div id="added-influencers">
        <!-- Influencers go here -->
    </div>
        <button id="additional-influencers" class="show-hidden" style="visibility:hidden" data-number="0">+0 More</button>
    </div>
</div>

<div class="filter-container col-xs-9" style="height:100%; border-bottom:0px;">
    <p class="desc-header col-xs-12">Influencer Results</p>

        <div class="col-xs-12 col-md-12 col-lg-3 col-xl-2" id="button-filter">
            <button class="col-xs-12 filter-option" data-platform="instagram" style="    background-color: rgb(115, 196, 141);"><div class="filter-option-text"> <i class="button-icon icon bd-instagram"  data-platform="instagram" aria-hidden="true"></i> INSTAGRAM</div></button>
            <button class="col-xs-12 filter-option" data-platform="facebook"><div class="filter-option-text"> <i class="button-icon icon bd-facebook"  data-platform="facebook" aria-hidden="true"></i> FACEBOOK</div></button>
            <button class="col-xs-12 filter-option" data-platform="twitter"><div class="filter-option-text"> <i class="button-icon icon bd-twitter"  data-platform="twitter" aria-hidden="true"></i> TWITTER</div></button>
            

        </div>


        <div class="col-xs-12 col-md-4 col-lg-3 col-xl-2" id="text-container" style="padding-bottom:25px;"> 
                <p class="filter-text">Filter Results</p> 
                <p class="measure-text">FOLLOWERS</p> 
                <p class="measure-text">LIKES PER POST </p>
        </div>
        <div class="col-xs-12 col-md-8 col-lg-6 col-xl-8" id="slider-container">
            <p id="influ-result"> Use the filters below to fine-tune your influencer results. </p>
            <!-- Instagram slider -->
            <div class="sliders" data-platform="instagram">
                <input  class="col-xs-1 input-filter " type="text" id="min-instagram">
                <div id="slider-instagram" class="col-xs-10"></div>
                <input id="max-instagram" class="col-xs-1 input-filter"style="display:inline; padding-left:2%; padding-right:0px;" type="text">
            </div>
            <div class="sliders" data-platform="instagram-engagement">
                <input  class="col-xs-1 input-filter engagement-slider " type="text" id="min-instagram-engagement">
                <div style="margin-top:20px;" id="slider-instagram-engagement" class="col-xs-10"></div>
                <input id="max-instagram-engagement" class="col-xs-1 input-filter engagement-slider"style="display:inline; padding-left:2%; padding-right:0px;" type="text">
            </div>
            <!-- end instagram slider -->


            <!-- Start Facebook slider -->
            <div class="sliders" data-platform="facebook" style="display:none;">
                <input  class="col-xs-1 input-filter" type="text" id="min-facebook">
                <div  id="slider-facebook" class="col-xs-10"></div>
                <input id="max-facebook" class="col-xs-1 input-filter"style="display:inline; padding-left:2%; padding-right:0px;" type="text">
            </div>
            <div class="sliders" data-platform="facebook-engagement" style="display:none;">
                <input  class="col-xs-1 input-filter engagement-slider" type="text" id="min-facebook-engagement">
                <div  style="margin-top:20px;" id="slider-facebook-engagement" class="col-xs-10"></div>
                <input id="max-facebook-engagement" class="col-xs-1 input-filter engagement-slider"style="display:inline; padding-left:2%; padding-right:0px;" type="text">
            </div>
            <!--end facebook slider-->




            <!-- Start Twitter slider -->
            <div class="sliders" data-platform="twitter" style="display:none;">
                <input  class="col-xs-1 input-filter" type="text" id="min-twitter">
                <div id="slider-twitter" class="col-xs-10"></div>
                <input id="max-twitter" class="col-xs-1 input-filter"style="display:inline; padding-left:2%; padding-right:0px;" type="text">
            </div>
            <div class="sliders" data-platform="twitter-engagement" style="display:none;">
                <input  class="col-xs-1 input-filter engagement-slider" type="text" id="min-twitter-engagement">
                <div style="margin-top:20px;" id="slider-twitter-engagement" class="col-xs-10"></div>
                <input id="max-twitter-engagement" class="col-xs-1 input-filter engagement-slider"style="display:inline; padding-left:2%; padding-right:0px;" type="text">
            </div>
            <!--end Twitter slider-->
            
        </div>




        <div class="found-influencers col-xs-12">
            <?php
                $count = 3;
                $stmt = $conn->prepare('SELECT `id`,`image_url`,`instagram_url`,`instagram_count`,`facebook_url`,`facebook_count`,`twitter_count`,`twitter_url` FROM `Influencer_Information` ORDER BY `instagram_count` DESC LIMIT 0,32');
                $stmt->execute();
                $stmt->bind_result($id,$image,$instagramurl,$instagramcount,$facebookurl,$facebookcount,$twittercount,$twitterurl);
                while($stmt->fetch()){
                $insthandle = explode('.com/',$instagramurl);
                $insthandle = explode('/',$insthandle[1]);
                $insthandle = explode('?',$insthandle[0]);
                $insthandle = $insthandle[0];
                //Facebook handle
                $facebookhandle = explode('.com/',$facebookurl);
                $facebookhandle = explode('/',$facebookhandle[1]);
                $facebookhandle = explode('?',$facebookhandle[0]);
                $facebookhandle = $facebookhandle[0];
                //twitter handle 
                $twitterhandle = explode('.com/',$twitterurl);
                $twitterhandle = explode('/',$twitterhandle[1]);
                $twitterhandle = explode('?',$twitterhandle[0]);
                $twitterhandle = $twitterhandle[0];

                echo '
                    <div  class="influencer-box col-xs-12 col-md-6 col-lg-4 col-xl-3">
                            <div class="influencer-card-discover">
                                <img class="influencer-image-card" src="https://project.social/'.$image.'">
                                <div class="col-xs-12" style="height:170px;">
                                    <!-- insthandle stuff -->
                                        <div class="icons col-xs-12">
                                            <i class="switch show-instagram inst-icon icon bd-instagram" data-id="'.$id.'" data-platform="instagram" style="color:#73C48D" aria-hidden="true"></i>
                                            <i class="switch show-facebook inst-icon icon bd-facebook" data-id="'.$id.'" data-platform="facebook" aria-hidden="true"></i>
                                            <i class="switch show-twitter inst-icon icon bd-twitter" data-id="'.$id.'" data-platform="twitter" aria-hidden="true"></i>
                                        </div>
                                        <div class="col-xs-12 insthandle-info">
                                            <!--icon here -->
                                            
                                            <p class="instagram-handle insthandle-text" data-id="'.$id.'">'.$insthandle.'</p>
                                            <p class="facebook-handle insthandle-text" data-id="'.$id.'" style="display:none;">'.$facebookhandle.'</p>
                                            <p class="twitter-handle insthandle-text" data-id="'.$id.'" style="display:none;">'.$twitterhandle.'</p>
                                        </div>
                                    <!-- followers -->
                                    <div class="col-xs-12">
                                        <p class="instagram-follower-count follower-count" data-id="'.$id.'">'.numberAbbreviation($instagramcount).' Followers</p>
                                        <p class="facebook-follower-count follower-count" style="display:none" data-id="'.$id.'">'.numberAbbreviation($facebookcount).' Likes</p>
                                        <p class="twitter-follower-count follower-count" style="display:none" data-id="'.$id.'">'.numberAbbreviation($twittercount).' Followers</p>
                                    </div>
                                    <!-- Engagement ?-->
                                    <div class="col-xs-12">
                                        <p class="instagram-engagement engagement-count" data-id="'.$id.'">1.5K Likes per post</p>
                                        <p class="facebook-engagement engagement-count" style="display:none"data-id="'.$id.'">1.5K Likes per post</p>
                                        <p class="twitter-engagement engagement-count" style="display:none"data-id="'.$id.'">1.5K Likes per post</p>
                                    </div>
                                    <div class="col-xs-12">
                                        
                                        <div style="display:inline;"class="col-xs-12 invite avocado-hover avocado-focus" data-id="'.$id.'" data-image="'.$image.'">
                                              <i class="thumb-up icon fa-plus" aria-hidden="true"></i>
                                                 INVITE</div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <!-- Influencer box has ended -->';
                    $count++;
                }
                    ?>
        </div>
</div>

</div>


</body>
</html>
<script>
var calculate = false;
var page = 0;
var selectedusers = [];
var filters = {};
var target = $("#test-height").offset().top;
function abbrNum(number, decPlaces = 2) {
    var orig = number;
    var dec = decPlaces;
    // 2 decimal places => 100, 3 => 1000, etc
    decPlaces = Math.pow(10, decPlaces);

    // Enumerate number abbreviations
    var abbrev = ["k", "m", "b", "t"];

    // Go through the array backwards, so we do the largest first
    for (var i = abbrev.length - 1; i >= 0; i--) {

        // Convert array index to "1000", "1000000", etc
        var size = Math.pow(10, (i + 1) * 3);

        // If the number is bigger or equal do the abbreviation
        if (size <= number) {
            // Here, we multiply by decPlaces, round, and then divide by decPlaces.
            // This gives us nice rounding to a particular decimal place.
            var number = Math.round(number * decPlaces / size) / decPlaces;

            // instHandle special case where we round up to the next abbreviation
            if((number == 1000) && (i < abbrev.length - 1)) {
                number = 1;
                i++;
            }

            // console.log(number);
            // Add the letter for the abbreviation
            number += abbrev[i];

            // We are done... stop
            break;
        }
    }

    return number;
}

$('#tokenfield').tokenfield();
</script>
<script src="/acslider.js"></script>
<script src="/includes/javascript/avocado-discover.js"></script>
