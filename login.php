<?php
session_start();
session_destroy();
unset($_SESSION);
if(isset($_POST['influencer'])){
  include 'includes/influencersignup.php';
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
include 'includes/verify.php';
}





?>



<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <?php include 'includes/head.php' ?>
  <style>
  @media (max-width:960px){
  #centercontent{
    padding-right: 0% !important; 
    padding-left: 0% !important;
  }
}
  #centercontent{
    padding-right:27%; 
    padding-left:27%;
  }
  #footer {
   position:absolute;
   bottom:0;
   width:100%;
   height:60px;   /* Height of the footer */
   background:#6cf;
}
#agency{
    display: inline;
    border-right: 1px solid rgb(226,225,229);
    border-left: 1px solid rgb(226,225,229);
    border-top: 1px solid rgb(226,225,229);
    border-radius:2px;
    padding-right: 9.5%;
    padding-left: 9.5%;
    padding-top: 1.7%;
    padding-bottom:1.7%;
  
}
#influencer{
    display: inline;
    border-right: 1px solid rgb(226,225,229);
    border-top: 1px solid rgb(226,225,229);
    border-left:1px solid rgb(226,225,229);
    border-radius:2px;
    padding-right: 9.5%;
    padding-left: 9.5%;
    padding-top: 1.7%; 
    padding-bottom:1.7%;
}
::-webkit-input-placeholder { /* Chrome/Opera/Safari */
  color: #c4c4c4 !important;
}
</style>
    <title>Login | Project Social</title>
<script src="/bootbox/bootbox.js"></script>
<script src="/includes/javascript/savecampaign.js"></script>
<script src="/includes/javascript/addtolist.js"></script>
<script src="/global/vendor/bootstrap/bootstrap.js"></script>
</head>
<body class=" ">
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
   <?php include 'includes/nav.php' ?>
   <div class="p-b-50"></div>
   <div class="container"> 

   <h1 style="text-align:center;"> Sign In </h1>
    <div id="centercontent" style="text-align:center;">
       <p style="text-align:center; display:inline; word-spacing:3px; font-size:15px;"> We have relationships with most celebrities and influencers and use our experiance to provide you with realistic pricing for working with your selected influencers.</p>
      <?php 
      if(isset($error)){
       echo '<br/><div style="text-align:center; display:inline; word-spacing:3px; font-size:15px; color:rgb(249,44,72);">'.$error.'</div>';
      }
      ?>
      <br/>
        <div style="padding-top:20px; display:inline-block; width:100%; padding-bottom:30px;">
            <div class="type"id="agency" data-check="true" style="color:rgb(249,44,72);"><a >I'm an Agency</a></div>
            <div class="type"id="influencer" data-check="false"><a> I'm an influencer </a></div> 
        </div>



      <div id="agencycontent" style="padding-bottom:10px; ">
          <form method="POST" action="">
          <input style="width:72%; height:50px; margin-left:14%"type="email" class="form-control m-b-30" id="inputPlaceholder" name="email"    placeholder="Email">
          <input style="width:72%; height:50px; margin-left:14%"type="password" class="form-control m-b-30" id="inputPlaceholder" name="password" placeholder="Password">
          <p style="font-size:10px; float:left; margin-left:14%;"><strong style="text-decoration: underline;">FORGOT PASSWORD</strong> </p>
          <br/>
          <button class="form-control" style="border:none; width:72%; height:50px; background-color:rgb(249,44,72); color:white; margin-bottom:30px; cursor:pointer; margin-left:14%; "> SIGN IN </button>
          </form>
          <a href="/register.php" style="text-decoration:none;"><button class="form-control" style="border:1px solid rgb(226,225,229); width:72%; height:50px; color:rgb(23,38,76); cursor:pointer; margin-left:14%;"> REGISTER </button></a>
      </div>

      <div id="influencercontent" style="display:inline-block; display:none; padding-bottom:10px;">
        <p> Coming soon! Sign up now to be notified first when our influencer program is ready! </p>
        <form method="POST" action="">
        <input style="width:72%; height:50px; margin-left:14%"type="email" class="form-control m-b-30" id="inputPlaceholder" name="influenceremail" placeholder="Email">
        <input style="width:72%; height:50px; margin-left:14%"type="text" class="form-control m-b-30" id="inputPlaceholder" name="influencername" placeholder="Name">
        <a href="#" style="text-decoration:none;"><button class="form-control" style="background-color:rgb(249,44,72); color:white; width:72%; height:50px;  cursor:pointer; margin-left:14%; " name="influencer"> SUBMIT </button></a>
        </form>
      </div>


   </div>
   

   </div>

   <div style="padding-bottom:100px;"></div>


     <?php include 'includes/footer.php' ?>


<script>
$(document).on('click','.type',function(){

var type = $(this).attr('data-check');
var id = $(this).attr('id');
if(type == 'true')
  return 0;
else  
  console.log(id);
if(id === 'influencer'){
   $('#agency').attr('data-check','false');
   $('#agency').css('color','#76838f');
   $('#agencycontent').css('display','none');
   $('#influencercontent').css('display','unset');
   $('#influencer').css('color','rgb(249,44,72)');
   

}
else{
   $('#influencer').attr('data-check','false');
   $('#influencer').css('color','#76838f');
   $('#influencercontent').css('display','none');
   $('#agencycontent').css('display','unset');
   $('#agency').css('color','rgb(249,44,72)');
}




});
</script>
</body>
</html>
