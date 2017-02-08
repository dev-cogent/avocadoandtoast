<?php
if(isset($_POST['influencer'])){
  include 'includes/influencersignup.php';
}
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
include 'includes/registerinfo.php';
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
    <title>Register Page | Project Social</title>
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

   <h1 style="text-align:center;"> Sign Up </h1>
    <div id="centercontent" style="text-align:center;">
      <p style="text-align:center; display:inline; word-spacing:3px; font-size:15px;"> We have relationships with most celebrities and influencers and use our experiance to provide you with realistic pricing for working with your selected influencers.</p>
      <?php 
      if(isset($reg) && $reg !== true){
       echo '<br/><div style="text-align:center; display:inline; word-spacing:3px; font-size:15px; color:rgb(249,44,72);">'.$reg.'</div>';
      }
      if(isset($message)){
        echo '<br/><div style="text-align:center; display:inline; word-spacing:3px; font-size:15px; color:green">'.$message.'</div>';
      }
      ?>
      <br/>
        <div style="padding-top:20px; display:inline-block; width:100%;">
            <div class="type"id="agency" data-check="true" style="color:rgb(249,44,72);"><a >I'm an Agency</a></div>
            <div class="type"id="influencer" data-check="false"><a> I'm an influencer </a></div> 
        </div>



      <div id="agencycontent">
          <form method="POST" action="">
          <input style="width:72%; height:50px; margin-left:14%"type="text" class="form-control m-b-30 m-t-30" id="inputPlaceholder" name="firstname" placeholder="First Name">
          <input style="width:72%; height:50px; margin-left:14%" class="form-control m-b-30" id="inputPlaceholder" name="lastname" placeholder="Last Name">
          <input style="width:72%; height:50px; margin-left:14%"type="email" class="form-control m-b-30" id="inputPlaceholder" name="email"    placeholder="Email">
          <input data-placement="left" style="width:72%; height:50px; margin-left:14%"data-toggle="tooltip" title="Password Requires a minimum of 6 characters, 1 special charatcer, 1 numeric value."type="password" class="form-control m-b-30" id="inputPlaceholder" name="password" placeholder="Password" required>
          <input style="width:72%; height:50px; margin-left:14%"type="password" class="form-control m-b-30" id="inputPlaceholder" name="confirm"  placeholder="Confirm Password">
          <input style="width:72%; height:50px; margin-left:14%"type="text" class="form-control m-b-30" id="inputPlaceholder" name="company"  placeholder="Company Name">
          <p style="font-size:10px; float:left; margin-left:14%;">BY CLICKING SIGN UP, YOU AGREE TO OUR <strong style="text-decoration: underline;">TERMS & CONDITIONS</strong> </p>
          <br/>
          <button class="form-control" style="border:none; width:72%; height:50px; background-color:rgb(249,44,72); color:white; margin-bottom:30px; cursor:pointer; margin-left:14%; "> SIGN UP </button>
          </form>
          <a href="/login.php" style="text-decoration:none;"><button class="form-control" style="border:1px solid rgb(226,225,229); width:72%; height:50px; color:rgb(23,38,76); cursor:pointer; margin-left:14%;"> SIGN IN </button></a>
      </div>

      <div id="influencercontent" style="display:inline-block; display:none; padding-bottom:10px; padding-top:30px;">
        <form method="POST" action="">
        <input style="width:72%; height:50px; margin-left:14%"type="email" class="form-control m-b-30 m-t-30" id="inputPlaceholder" name="influenceremail" placeholder="Email">
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
